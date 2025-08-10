<?php

namespace frontend\controllers;

use common\components\AuthHandler;
use common\models\Category;
use common\models\Synonym;
use common\models\Filter;
use common\models\LoginForm;
use common\models\Messages;
use common\models\Order;
use common\models\Product;
use common\models\User;
use common\models\User2category;
use frontend\models\ContactForm;
use frontend\models\UserFilter;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use Yii;
use yii\authclient\AuthAction;
use yii\base\InvalidParamException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\BadRequestHttpException;
use yii\web\Session;
use yii\web\Cookie;

/**
 * Site controller
 */
class SiteController extends MenuController
{
    public function beforeAction($action) {
    	if ($action->id === 'set-role-user') {
            $this->enableCsrfValidation = false;
        }

    	return parent::beforeAction($action);
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup', 'RequestPasswordReset'],
                'rules' => [
                    [
                        'actions' => ['signup', 'RequestPasswordReset'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
            'authAjax' => [
                'class' => AuthAction::class,
                'successCallback' => [$this, 'onAuthAjaxSuccess'],
            ],
            'registration' => [
                'class' => AuthAction::class,
                'successCallback' => [$this, 'onRegistrationSuccess'],
            ]
        ];
    }

    public function actionSaveSession()
    {
        Yii::$app->session->set('filter-session', Yii::$app->request->post());
        $this->redirect(['site/auth', 'authclient' => 'facebook']);
    }

    /**
     * Register Google
     */
    public function actionAuthGoogle() {
        define('ID', $_ENV['GOOGLE_CLIENT_ID']);
        define('SECRET', $_ENV['GOOGLE_CLIENT_SECRET']);
        define('URL', $_ENV['GOOGLE_REDIRECT_URL']);

        if (!isset($_GET['code'])) {
            header("Location: https://accounts.google.com/o/oauth2/auth?client_id=" . ID . "&redirect_uri=" . URL . "&access_type=offline&response_type=code&scope=email");
        } else {
            $post = [
                'code' => $_GET['code'],
                'client_id' => ID,
                'client_secret' => SECRET,
                'redirect_uri' => URL,
                'grant_type' => 'authorization_code',
            ];

            $ch = curl_init('https://accounts.google.com/o/oauth2/token');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
            $response = json_decode(curl_exec($ch));
            curl_close($ch);

            if (!empty($response->access_token)) {
                $post = ["access_token" => $response->access_token];
                $userInfo = json_decode(file_get_contents('https://www.googleapis.com/oauth2/v1/userinfo' . '?' . urldecode(http_build_query($post))), true);

                $name = (isset($userInfo['name'])) ? $userInfo['name'] : $userInfo['email'];
				        $name = str_replace('@gmail.com', '', $name);
                $email = $userInfo['email'];
                $generatePassword = md5($name);

                $this->addUserSocial($name, $email, $generatePassword);
            }
        }
    }

    /**
     * Register Facebook
     */
    public function actionAuthFacebook() {
        define('ID', '1786975484694871');
        define('SECRET', 'c254dee4ffdecb5dffb198ddeab7df98');
        define('URL', 'https://blablaprice.com/site/auth-facebook');
        $cookies = Yii::$app->session;

        if (!isset($_GET['code'])) {
            header("Location: https://www.facebook.com/dialog/oauth?client_id=" . ID . "&redirect_uri=" . URL . "&scope=email&response_type=code");
        } else {
            $params = array(
                'client_id'     => ID,
                'client_secret' => SECRET,
                'redirect_uri'  => URL,
                'code'          => $_GET['code']
            );
            
            $data = file_get_contents('https://graph.facebook.com/oauth/access_token?' . urldecode(http_build_query($params)));
            $data = json_decode($data, true);
        
            if (!empty($data['access_token'])) {
                $params = array(
                    'access_token' => $data['access_token'],
                    'fields'       => 'id,email,first_name,last_name,picture'
                );
        
                $userInfo = file_get_contents('https://graph.facebook.com/me?' . urldecode(http_build_query($params)));
                $userInfo = json_decode($userInfo, true);

                $name = (isset($userInfo['first_name'])) ? $userInfo['first_name'] . ' ' . $userInfo['last_name'] : $userInfo['email'];
                $email = $userInfo['email'];
                $generatePassword = md5($id . $name);

                $this->AddUserSocial($name, $email, $generatePassword);
            }
        }
    }

    /**
     * Add user social
     */
    public function addUserSocial($name, $email, $generatePassword) {
        if (!empty($email)) {
            if (!User::find()->where(['email' => $email])->exists()) {
                $model = new SignupForm();
                $model->username = $name;
                $model->email = $email;
                $model->password = $generatePassword;
                $model->emailCode = Yii::$app->security->generateRandomString(32);
                $model->email_sent = date('Y-n-d H:i:s');
    
                $user = new User();
                $user->setUsername($model->username);
                $user->setEmail($model->email);
                $user->setPassword($model->password);
                $user->emailCode = $model->emailCode;
                $user->email_sent = $model->email_sent;
                $user->role = 0;
    
                if ($user->save(false)) {
                    $model->userSendEmail($user, $model->password);
                    
                    $cookie = new Cookie([
                        'name' => 'register_social',
                        'value' => 'active',
                        'expire' => time() + 3600*24,
                    ]);
                    \Yii::$app->getResponse()->getCookies()->add($cookie);
    
                    $cookie = new Cookie([
                        'name' => 'email',
                        'value' => $email,
                        'expire' => time() + 3600*24,
                    ]);
                    \Yii::$app->getResponse()->getCookies()->add($cookie);

                    $this->redirect(['/']);
                }
            } else {
                $model = new LoginForm();
                $model->email = $email;

                if ($model->login(false)) {
                    $user = Yii::$app->user->identity;

                    if ($user->role === 1 && isset($_COOKIE['filter'])) {
                        $this->actionFilterArguments($user->id, $_COOKIE['filter']);
                    }

                    $this->redirect(['cabinet/order']);
                }
            }
        } else {
            Yii::$app->session->setFlash('error', Yii::t('app', 'Доведеться вибрати інший спосіб авторизації'));
            $this->redirect('/');
        }        
    }

    /**
     * Set role user
     */
    public function actionSetRoleUser() {
        
        if (!empty($_POST)) {
            $email = $_POST['email'];
            $role = $_POST['role'];

            $user = User::find()->where(['email' => $email])->one();
            $user->setRole($role);
            $user->save(false);

            $model = new LoginForm();
            $model->email = $email;

            if ($model->login(false)) {
                $cookies = Yii::$app->response->cookies;
                unset($cookies['email']);
                unset($cookies['register_social']);

                if ($role == 1) {
                    echo $_COOKIE['filter'];
                } else {
                    return false;
                }                
            } 
        }
    }

    public function productOrderAdd($id, $post) {
        $product = Product::findOne(['ID' => $id]);
        $order = new Order();

        if (isset($post['Order'])) {

            $send_user = ArrayHelper::map(User2category::findAll(['categoryID' => $post['Order']['category']]), 'ID',
            'user');
            $send_user = ArrayHelper::map($send_user, 'ID', 'email');

            $filter_text = '';

            $order->categoryID = $post['Order']['categoryID'];
            $order->userID = Yii::$app->user->id;
            $order->productID = $post['Order']['productID'];
            $order->comment = $post['Order']['comment'];
            $order->priceFrom = $post['Order']['priceFrom'];
            $order->regionID = $post['regionID'];
            $order->send = count($send_user);
            if ($post['Order']['deadLine'] <> '') {
                $order->deadLine = date('Y-m-d H:i:s', strtotime($post['Order']['deadLine']));
            }

            $order->status = 1;

            if ($order->validate() && $order->save()) {

                foreach ($send_user as $email) {
                    Yii::$app->mailer->compose()
                        ->setFrom('from@domain.com')
                        ->setTo($email)
                        ->setSubject(Yii::t('app', 'Нові замовлення'))
                        ->setHtmlBody('<b>' . Yii::t('app',
                                'У Вас є нові замовлення') . '</b> ' . $order->product->name)
                        ->send();
                }

                return $this->redirect(['cabinet/order']);
            } else {
                Yii::$app->session->setFlash('error', 'Помилка');
                return $this->redirect(['site/product', 'id' => $id]);
            }
        } else {
            $send_user = ArrayHelper::map(User2category::findAll(['categoryID' => $post['category']]), 'ID',
                'user');
            $send_user = ArrayHelper::map($send_user, 'ID', 'email');

            $filter_text = '';

            if (isset($post['filter']) && !empty($post['filter']) && is_array($post['filter'])) {
                foreach ($post['filter'] as $key => $value) {
                    if (isset($value['other'])) {
                        unset($value['other']);
                    } else {
                        if (isset($value['other_input'])) {
                            unset($value['other_input']);
                        }
                    }

                    if (count($value) > 0) {
                        $filter_text .= $key . ': ' . implode(', ', $value) . '; ';
                    }
                }
            }

            $order->categoryID = $post['category'];
            $order->userID = Yii::$app->user->id;
            $order->regionID = Yii::$app->user->identity->address;
            $order->filter = strip_tags($filter_text);
            $order->comment = $post['comment'];
            $order->priceFrom = $post['priceFrom'];
            $order->regionID = $post['regionID'];
            $order->send = count($send_user);
            if ($post['deadLine'] <> '') {
                $post['deadLine'] = str_replace(',', '', $post['deadLine']);
                $order->deadLine = date('Y-m-d H:i:s', strtotime($post['deadLine']));
            }

            $order->status = 1;

            if ($order->validate() && $order->save()) {

                foreach ($send_user as $email) {
                    Yii::$app->mailer->compose()
                        ->setFrom('from@domain.com')
                        ->setTo($email)
                        ->setSubject(Yii::t('app', 'Нові замовлення'))
                        ->setHtmlBody('<b>' . Yii::t('app',
                                'У Вас є нові замовлення') . '</b> ' . $order->category->name . ': ' . $filter_text)
                        ->send();
                }

                return $this->redirect(['cabinet/order']);
            } else {
                foreach ($order->getErrors() as $error) {
                    Yii::$app->session->setFlash('error', $error);
                }
                return $this->redirect(['site/filter', 'id' => $id]);
            }
        }
    }

    /**
     * Social network registration
     *
     * @param $client
     */
    public function onRegistrationSuccess($client)
    {
        $email = $name = null;

        switch ($client->getName()) {
            case 'google' :
                $email = $client->getUserAttributes()['emails'][0]['value'];
                $name = $client->getUserAttributes()['displayName'];
                break;
            case 'facebook' :
                $email = $client->getUserAttributes()['email'];
                $name = $client->getUserAttributes()['name'];
                break;
        }

        if (!is_null($email) && !is_null($name)) {
            $this->redirect('index?email=' . $email . '&name=' . $name);
        } else {
            $this->redirect('index');
        }
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $user = Yii::$app->user;
        
		if (!$user->isGuest && ($user->identity->role == User::ROLE_USER || $user->identity->role == User::ROLE_SELLER)) {
			return $this->redirect(['cabinet/order']);
		}
		else {
			return $this->render('index', [
				'category' => Category::findAll(['parentID' => '0'])
			]);
		}
    }

    public function actionSubCategory($id)
    {
        $this->layout = false;
        $breadcrumb = $this->categoryBreadcrumb($id);
        return $this->render('sub-category', [
            'id' => $id,
            'breadcrumb' => $breadcrumb
        ]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        $model->load(Yii::$app->request->post());

        if (Yii::$app->request->isAjax) {
            if ($model->login()) {
                return true;
            } else {
                return false;
            }
        }

        if ($model->login()) {
            $user = Yii::$app->user->identity;

            if ($user->role === 1 && isset($_COOKIE['filter'])) {
                $this->actionFilterArguments($user->id, $_COOKIE['filter']);
            }

            $this->redirect(['cabinet/order']);
        } else {
            $er = '';
            foreach ($model->getErrors() as $errors) {
                $er .= $errors[0] . PHP_EOL;
            }
            Yii::$app->session->setFlash('error', $er);
            return $this->goHome();
        }
    }

    /**
     * Product page.
     *
     * @param integer $id
     *
     * @return mixed
     */
    public function actionProduct($id, $post = null)
    {

        $product = Product::findOne(['ID' => $id]);
        $order = new Order();

        $free_user = User::find()
            ->leftJoin('{{%user2category}}', '{{%user}}.ID = {{%user2category}}.userID')
            ->where('{{%user2category}}.userID IS NULL')
            ->andWhere(['{{%user}}.role' => User::ROLE_SELLER])
            ->count();

        $free_user = $free_user + User2category::find()->where(['categoryID' => $id])->count();

        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();

            if (Yii::$app->user->identity->role == User::ROLE_USER) {
                $send_user = ArrayHelper::map(User2category::findAll(['categoryID' => $post['Order']['category']]), 'ID',
                    'user');
                $send_user = ArrayHelper::map($send_user, 'ID', 'email');

                $filter_text = '';

                $category = Category::find()->where(['ID' => $post['Order']['categoryID']])->one();

                $order->primary_categoryID = $category->primary_category_id;
                $order->parentID = $category->parentID;
                $order->categoryID = $post['Order']['categoryID'];
                $order->userID = Yii::$app->user->id;
			          $order->productID = $post['Order']['productID'];
                $order->comment = $post['Order']['comment'];
                $order->priceFrom = $post['Order']['priceFrom'];
                $order->regionID = $post['regionID'];
                $order->send = count($send_user);
                if ($post['Order']['deadLine'] <> '') {
                    $order->deadLine = date('Y-m-d H:i:s', strtotime($post['Order']['deadLine']));
                }

                $order->status = 1;

                if ($order->validate() && $order->save()) {

                    foreach ($send_user as $email) {
                        Yii::$app->mailer->compose()
                            ->setFrom('from@domain.com')
                            ->setTo($email)
                            ->setSubject(Yii::t('app', 'Нові замовлення'))
                            ->setHtmlBody('<b>' . Yii::t('app',
                                    'У Вас є нові замовлення') . '</b> ' . $order->product->name)
                            ->send();
                    }

                    return $this->redirect(['cabinet/order']);
                }
            } else {
                Yii::$app->session->setFlash('error', 'Потрібно зареєструватися як продавець');
                return $this->redirect(['site/product', 'id' => $id]);
            }
        }

		if (!empty($post)) {
            if (Yii::$app->user->identity->role == User::ROLE_USER) {
                $send_user = ArrayHelper::map(User2category::findAll(['categoryID' => $post['Order']['category']]), 'ID',
                    'user');
                $send_user = ArrayHelper::map($send_user, 'ID', 'email');

                $filter_text = '';

                $category = Category::find()->where(['ID' => $post['Order']['categoryID']])->one();

                $order->primary_categoryID = $category->primary_category_id;
                $order->parentID = $category->parentID;
                $order->categoryID = $post['Order']['categoryID'];
                $order->userID = Yii::$app->user->id;
			    $order->productID = $post['Order']['productID'];
                $order->comment = $post['Order']['comment'];
                $order->priceFrom = $post['Order']['priceFrom'];
                $order->regionID = $post['regionID'];
                $order->send = count($send_user);
                if ($post['Order']['deadLine'] <> '') {
                    $order->deadLine = date('Y-m-d H:i:s', strtotime($post['Order']['deadLine']));
                }

                $order->status = 1;


                if ($order->validate(false) && $order->save(false)) {

                    foreach ($send_user as $email) {
                        Yii::$app->mailer->compose()
                            ->setFrom('from@domain.com')
                            ->setTo($email)
                            ->setSubject(Yii::t('app', 'Нові замовлення'))
                            ->setHtmlBody('<b>' . Yii::t('app',
                                    'У Вас є нові замовлення') . '</b> ' . $order->product->name)
                            ->send();
                    }

                    return $this->redirect(['cabinet/order']);
                }
            } else {
                Yii::$app->session->setFlash('error', 'Потрібно зареєструватися як продавець');
                return $this->redirect(['site/product', 'id' => $id]);
            }
        }

        return $this->render('product', [
            'product' => $product,
            'order' => $order,
            'free_user' => $free_user
        ]);
    }


    public function actionSubcat($categories)
    {
        return $this->render('subcat2', [
            'categories' => $categories
        ]);
    }

    /**
     * Filter page
     *
     * @param integer $id
     *
     * @return mixed
     */
    public function actionFilter($id)
    {
        $filter = Filter::findAll(['categoryID' => $id]);
        $order = new Order();
        $category = Category::findOne(['ID' => $id]);
        $breadcrumb = (new Category())->getBreadcrumb($id);
        $price = '';

        $free_user = User::find()
            ->leftJoin('{{%user2category}}', '{{%user}}.ID = {{%user2category}}.userID')
            ->where('{{%user2category}}.userID IS NULL')
            ->andWhere(['{{%user}}.role' => User::ROLE_SELLER])
            ->count();

        $free_user = $free_user + User2category::find()->where(['categoryID' => $id])->count();


        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();

            if (Yii::$app->user->identity->role == User::ROLE_USER) {
                $send_user = ArrayHelper::map(User2category::findAll(['categoryID' => $post['category']]), 'ID', 'user');
                $send_user = ArrayHelper::map($send_user, 'ID', 'email');

                $filter_text = '';

                if (isset($post['filter']) && !empty($post['filter']) && is_array($post['filter'])) {
                    foreach ($post['filter'] as $key => $value) {
                        if (isset($value['other'])) {
                            unset($value['other']);
                        } else {
                            if (isset($value['other_input'])) {
                                unset($value['other_input']);
                            }
                        }
                        if(count($value)==0) {continue; }
                        if(isset($value['from']) && $value['from']=='' && isset($value['to']) && $value['to']=='') {continue; }

                        if (isset($value['from']) && isset($value['to'])) {
                            $filter_text.=$key.': ';
                            if ($value['from'] != '') $filter_text.=' min '.$value['from'];
                            if ($value['to'] != '') $filter_text.=' max '.$value['to'];
                            $filter_text.='; ';
                        }
                        elseif (count($value) > 0) {
                            $filter_text .= $key . ': ' . implode(', ', $value) . '; ';
                        }
                    }
                }

                $primary_category_id = (!empty($post['primary_category_id'])) ? $post['primary_category_id'] : 0;
                $parent_id = (!empty($post['parent_id'])) ? $post['parent_id'] : 0;
                $category = (!empty($post['category'])) ? $post['category'] : 0;

                $order->primary_categoryID = $primary_category_id;
                $order->parentID = $parent_id;
                $order->categoryID = $category;
                $order->userID = Yii::$app->user->id;
                $order->regionID = Yii::$app->user->identity->address;
                $order->filter = strip_tags($filter_text);
                $order->comment = $post['comment'];
                $order->priceFrom = $post['priceFrom'];
                $order->regionID = $post['regionID'];
                $order->send = count($send_user);
                
                if (!empty($post['deadLine_submit'])) {
                    if ($post['deadLine_submit'] <> '') {
                        $order->deadLine = date('Y-m-d H:i:s', strtotime($post['deadLine_submit']));
                    }
                }

                $order->status = 1;

                if ($order->validate() && $order->save()) {

                    foreach ($send_user as $email) {
                        Yii::$app->mailer->compose()
                            ->setFrom('from@domain.com')
                            ->setTo($email)
                            ->setSubject(Yii::t('app', 'Нові замовлення'))
                            ->setHtmlBody('<b>' . Yii::t('app',
                                    'У Вас є нові замовлення') . '</b> ' . $order->category->name . ': ' . $filter_text)
                            ->send();
                    }

                    return $this->redirect(['cabinet/order']);
                } else {
                    foreach ($order->getErrors() as $error) {
                        Yii::$app->session->setFlash('error', $error);
                    }
                    return $this->redirect(['site/filter', 'id' => $id]);
                }
            } else {
                Yii::$app->session->setFlash('error', 'Потрібно зареєструватися як продавець');
                return $this->redirect(['site/filter', 'id' => $id]);
            }
        }

        if (!empty($post)) {
            $post = json_decode($post, true);

            if (Yii::$app->user->identity->role == User::ROLE_USER) {
                $send_user = ArrayHelper::map(User2category::findAll(['categoryID' => $post['category']]), 'ID',
                    'user');
                $send_user = ArrayHelper::map($send_user, 'ID', 'email');

                $filter_text = '';

                if (isset($post['filter']) && !empty($post['filter']) && is_array($post['filter'])) {
                    foreach ($post['filter'] as $key => $value) {
                        if (isset($value['other'])) {
                            unset($value['other']);
                        } else {
                            if (isset($value['other_input'])) {
                                unset($value['other_input']);
                            }
                        }

                        if (count($value) > 0) {
                            $filter_text .= $key . ': ' . implode(', ', $value) . '; ';
                        }
                    }
                }

                $order->primary_categoryID = $post['primary_category_id'];
                $order->parentID = $post['parent_id'];
                $order->categoryID = $post['category'];
                $order->userID = Yii::$app->user->id;
                $order->regionID = Yii::$app->user->identity->address;
                $order->filter = strip_tags($filter_text);
                $order->comment = $post['comment'];
                $order->priceFrom = $post['priceFrom'];
                $order->regionID = $post['regionID'];
                $order->send = count($send_user);

                if ($post['deadLine_submit'] <> '') {
                    //$post['deadLine'] = str_replace(',', '', $post['deadLine']);
                    $order->deadLine = date('Y-m-d H:i:s', strtotime($post['deadLine_submit']));
                }

                $order->status = 1;

                if ($order->validate() && $order->save()) {

                    foreach ($send_user as $email) {
                        Yii::$app->mailer->compose()
                            ->setFrom('from@domain.com')
                            ->setTo($email)
                            ->setSubject(Yii::t('app', 'Нові замовлення'))
                            ->setHtmlBody('<b>' . Yii::t('app',
                                    'У Вас є нові замовлення') . '</b> ' . $order->category->name . ': ' . $filter_text)
                            ->send();
                    }

                    return $this->redirect(['cabinet/order']);
                } else {
                    foreach ($order->getErrors() as $error) {
                        Yii::$app->session->setFlash('error', $error);
                    }
                    return $this->redirect(['site/filter', 'id' => $id]);
                }
            } else {
                Yii::$app->session->setFlash('error', 'Потрібно зареєструватися як продавець');
                return $this->redirect(['site/filter', 'id' => $id]);
            }
        }

        /*$subcat = $category->getSubCategory();
        
        if($subcat->count() != 0) {
            return $this->render('subcat', [
                'categories' => $subcat
            ]);
        } */

        return $this->render('filter', [
            'filter' => $filter,
            'category' => $category,
            'id' => $id,
            'breadcrumb' => $breadcrumb,
            'price' => $price,
            'free_user' => $free_user,
            'order' => $order
        ]);
    }

    public function actionFilterArguments($id, $post = null)
    {

        $filter = Filter::findAll(['categoryID' => $id]);
        $order = new Order();
        $category = Category::findOne(['ID' => $id]);
        $breadcrumb = (new Category())->getBreadcrumb($id);
        $price = '';

        $free_user = User::find()
            ->leftJoin('{{%user2category}}', '{{%user}}.ID = {{%user2category}}.userID')
            ->where('{{%user2category}}.userID IS NULL')
            ->andWhere(['{{%user}}.role' => User::ROLE_SELLER])
            ->count();

        $free_user = $free_user + User2category::find()->where(['categoryID' => $id])->count();

        if (!empty($post)) {
            $post = json_decode($post, true);

            if (Yii::$app->user->identity->role == User::ROLE_USER) {
                $send_user = ArrayHelper::map(User2category::findAll(['categoryID' => $post['category']]), 'ID',
                    'user');
                $send_user = ArrayHelper::map($send_user, 'ID', 'email');

                $filter_text = '';

                if (isset($post['filter']) && !empty($post['filter']) && is_array($post['filter'])) {
                    foreach ($post['filter'] as $key => $value) {
                        if (isset($value['other'])) {
                            unset($value['other']);
                        } else {
                            if (isset($value['other_input'])) {
                                unset($value['other_input']);
                            }
                        }

                        if (count($value) > 0) {
                            $filter_text .= $key . ': ' . implode(', ', $value) . '; ';
                        }
                    }
                }

                $order->primary_categoryID = $post['primary_category_id'];
                $order->parentID = $post['parent_id'];
                $order->categoryID = $post['category'];
                $order->userID = Yii::$app->user->id;
                $order->regionID = Yii::$app->user->identity->address;
                $order->filter = strip_tags($filter_text);
                $order->comment = $post['comment'];
                $order->priceFrom = $post['priceFrom'];
                $order->regionID = $post['regionID'];
                $order->send = count($send_user);

                if ($post['deadLine_submit'] <> '') {
                    //$post['deadLine'] = str_replace(',', '', $post['deadLine']);
                    $order->deadLine = date('Y-m-d H:i:s', strtotime($post['deadLine_submit']));
                }

                $order->status = 1;

                if ($order->validate() && $order->save()) {

                    foreach ($send_user as $email) {
                        Yii::$app->mailer->compose()
                            ->setFrom('from@domain.com')
                            ->setTo($email)
                            ->setSubject(Yii::t('app', 'Нові замовлення'))
                            ->setHtmlBody('<b>' . Yii::t('app',
                                    'У Вас є нові замовлення') . '</b> ' . $order->category->name . ': ' . $filter_text)
                            ->send();
                    }

                    return $this->redirect(['cabinet/order']);
                } else {
                    foreach ($order->getErrors() as $error) {
                        Yii::$app->session->setFlash('error', $error);
                    }
                    return $this->redirect(['site/filter', 'id' => $id]);
                }
            } else {
                Yii::$app->session->setFlash('error', 'Потрібно зареєструватися як продавець');
                return $this->redirect(['site/filter', 'id' => $id]);
            }
        }

        $subcat = $category->getSubCategory();

        if($subcat->count() != 0) return $this->render('subcat', [
            'categories' => $subcat
        ]);

        return $this->render('filter', [
            'filter' => $filter,
            'category' => $category,
            'id' => $id,
            'breadcrumb' => $breadcrumb,
            'price' => $price,
            'free_user' => $free_user,
            'order' => $order
        ]);
    }


    /**
     * Search product method.
     *
     * @return mixed
     */
    public function actionSearch()
    {
        $result = '';
        if (Yii::$app->request->isPost) {
            if (mb_strlen(Yii::$app->request->post('search')) > 1) {
                $product = Category::find()->select([
                        'ID',
                        'name',
                    ])
                        ->where('`name` LIKE \'%' . Yii::$app->request->post('search') . '%\'')
                        ->limit(10)
                        ->distinct()
                        ->all();


                foreach ($product as $product_item) {
                        $result .= '<li>' .
                            Html::a($product_item->name, ['site/filter', 'id' => $product_item->ID],
                                ['class' => 'title']) . '</li>' ;
                    }

                    // $query = (new \yii\db\Query())->select(['synonym'])->from('synonym')->where(['like', 'synonym', Yii::$app->request->post('search')])->all();
                        // $result='<li>' .
                            // Html::a('Синоним '.$query[0]['synonym'], ['site/filter', 'id' => '0'],
                                 // ['class' => 'title']) . '</li>' ;
                $synonym = Synonym::find()
                        ->where('`synonym` LIKE \'%' . Yii::$app->request->post('search') . '%\'')
                        ->limit(10-count($product))
                        ->distinct()
                        ->all();

                foreach ($synonym as $item) {
                        $result .= '<li>' .
                            Html::a('Синоним '.$item->synonym, ['site/filter', 'id' => $item->category->ID],
                                ['class' => 'title']) . '</li>' ;
                    }

                // $product = Product::find()->select([
                        // 'ID',
                        // 'name',
                    // ])
                        // ->where('`name` LIKE \'%' . Yii::$app->request->post('search') . '%\'')
                        // ->orderBy('USD DESC')
                        // ->limit(10-count($product))
                        // ->all();

                    // foreach ($product as $product_item) {
                        // $result .= '<li>' .
                            // Html::a($product_item->name, ['site/product', 'id' => $product_item->ID],
                                // ['class' => 'title']) . '</li>' ;
                    // }
            }
        }
        return $result;
    }


    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {

        $session = Yii::$app->session;
        $_GET['lang'] = $session->get('language');

        Yii::$app->user->logout();
        return $this->redirect(['/', 'lang' => $_GET['lang']]);
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success',
                    Yii::t('app', 'Дякуємо, що звернулися до нас. Ми відповімо Вам якомога швидше.'));
            } else {
                Yii::$app->session->setFlash('error', Yii::t('app', 'Помилка надсилання електронної пошти.'));
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        if (Yii::$app->request->isPost) {
            $model = new SignupForm();
            $model->load(Yii::$app->request->post());
            $model->password = Yii::$app->security->generateRandomString(6);
            $model->emailCode = Yii::$app->security->generateRandomString(32);
            $model->email_sent = date('Y-n-d H:i:s');

            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    Yii::$app->session->setFlash('success', Messages::findOne(['slug' => 'password_send'])->name);
                    return $this->redirect(['cabinet/settings']);
                } else {
                    Yii::$app->session->setFlash('error', Yii::t('app', 'Помилка авторизації користувача'));
                }
            } elseif ($model->hasErrors()) {
                foreach ($model->getErrors() as $modelErrorCode => $modelError) {
                    Yii::$app->session->setFlash('error', Yii::t('app', array_pop($modelError)));
                }
            } else {
                Yii::$app->session->setFlash('error', Yii::t('app', 'Помилка реєстрації користувача'));
            }
        } else {
            Yii::$app->session->setFlash('error', Yii::t('app', 'Трапилась помилка.'));
        }
        return $this->goHome();
    }

    public function actionActivation($code)
    {
        $user = User::findOne([
            'emailCode' => $code
        ]);

        if ($user) {
            $user->status = User::STATUS_ACTIVE;
            $user->setEmailApproved(date('Y-m-d H:i:s'));
            $user->save(false);

            if (Yii::$app->getUser()->login($user)) {
                return $this->redirect(['cabinet/settings']);
            }
        }
        return $this->redirect(['site/index']);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        if (Yii::$app->request->isPost) {
            $model = new PasswordResetRequestForm(['email' => Yii::$app->request->post('email')]);
            if ($model->validate()) {
                if ($model->sendEmail()) {
                    Yii::$app->session->setFlash('success',
                        Yii::t('app', 'Перевірте свою електронну пошту для подальших інструкцій.'));

                    return $this->goHome();
                } else {
                    Yii::$app->session->setFlash('error',
                        Yii::t('app', 'На жаль, ми не можемо скинути пароль для даної поштової скриньки.'));
                    return $this->goHome();
                }
            } else {
                Yii::$app->session->setFlash('error',
                    Yii::t('app', 'Трапилась помилка. Будь ласка, зв\'яжіться з адміністрацією сайту.'));
                return $this->goHome();
            }
        }
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', Yii::t('app', 'Новий пароль був збережений.'));
            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model
        ]);
    }

    public function actionHowitworks()
    {
        return $this->render('howitworks');
    }

    public function actionTermsofuse()
    {
        return $this->render('termsofuse');
    }

    public function actionPrivacypolicy()
    {
        return $this->render('privacypolicy');
    }

    public function actionPricing()
    {
        return $this->render('pricing');
    }

    public function actionRefund() {
        return $this->render('refund');
    }

    public function actionFill() {
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $countFilters = 0;
            $count = 0;

            if (!empty($post['region'])) {
                foreach ($post['region'] as $region) {
                    $countFilters++;
                }
            }

            if (!empty($post['parent_category'])) {
                $category_arr = [];
                $count++;
                $count_sub = 0;
                $category = Category::find()->where(['in', 'parentID', $post['parent_category']])->all();

                foreach ($post['parent_category'] as $parent_category) {
                    $countFilters++;
                }

                if (!empty($category) && count($category)) {
                    foreach ($category as $key => $cat) {
                        $post['third_level_category'][$key] = $cat->ID;

                        if ($cat->subCategory) {
                            foreach ($cat->subCategory as $key => $val) {
                                $post['fourth_level_category'][$count_sub] = $val->ID;
                                $count_sub++;
                            }
                        }
                    }
                }
            }

            if (!empty($post['category'])) {
                foreach ($post['category'] as $category) {
                    $countFilters++;
                }
            }

            if (empty($post['min_price'])||$post['min_price']<0) {$post['min_price']=0;}
            if (empty($post['max_price'])||$post['max_price']<0) {$post['max_price']=999999;}

            $json = json_encode($post);

            $query = UserFilter::find()->where(['userID' => Yii::$app->user->id])->one();

            if ($query) {
                $query->userID = Yii::$app->user->id;
                $query->count = $countFilters;
                $query->filter = $json;
                $query->save();
            } else {
                $userFilter = new UserFilter();
                $userFilter->userID = Yii::$app->user->id;
                $userFilter->count = $countFilters;
                $userFilter->filter = $json;
                $userFilter->save();
            }

            return $this->redirect(['cabinet/order']);
        }
    }

    public function actionFilterAddSession() {
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();

            $session = Yii::$app->session;

            if ($session->has('filter')) {
                $session->remove('filter');
                $session->set('filter', $post);
            } else {
                $session->set('filter', $post);
            }
        }
    }

    public function actionFilterDelete() {
        $query = UserFilter::find()->where(['userID' => Yii::$app->user->id])->one();

        if ($query) {
            if ($query->delete()) {
                return $this->redirect(['cabinet/order']);
            }
        } else {
            return $this->redirect(['cabinet/order']);
        }
    }

    public function actionDeleteFile() {
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();;
            if (unlink($post['path'])) {
                echo "Success";
            }
        }
    }

    public function actionContactAjaxSend() {
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();

            $subject = $post['title'];
            $message = '';

            if (!empty($post['email'])) $message .= '<b>E-mail:</b> ' . $post['email'] . '<br>';
            if (!empty($post['phone'])) $message .= '<b>Телефон:</b> ' . $post['phone'] . '<br>';
            if (!empty($post['select'])) $message .= $post['select'] . '<br>';
            if (!empty($post['descr'])) $message .= '<b>Повідомлення:</b><br>' . $post['descr'] . '<br>';

            Yii::$app->mailer->compose()
                ->setFrom(Yii::$app->params['adminEmail'])
                ->setTo(Yii::$app->params['adminEmail'])
                ->setSubject($subject)
                ->setHtmlBody($message)
                ->send();
        }
    }
}
