<?php

namespace frontend\controllers;

use Yii;
use common\models\User;
use yii\web\Controller;
use frontend\models\SignupForm;
use common\models\LoginForm;
use yii\web\Session;
use linslin\yii2\curl;
use stdClass;
use frontend\controllers\CabinetController;

class UserController extends Controller {

    public function beforeAction($action) {
    	if ($action->id === 'add-role-cookie') {
            $this->enableCsrfValidation = false;
        }

        if ($action->id === 'reset-session-reg') {
            $this->enableCsrfValidation = false;
        }

        if ($action->id === 'change') {
            $this->enableCsrfValidation = false;
        }

        if ($action->id === 'send-phone-code') {
            $this->enableCsrfValidation = false;
        }

        if ($action->id === 'register') {
            $this->enableCsrfValidation = false;
        }

        if ($action->id === 'auth') {
            $this->enableCsrfValidation = false;
        }

        if ($action->id === 'activation-phone') {
            $this->enableCsrfValidation = false;
        }

    	return parent::beforeAction($action);
    }

    public static function actionRegister() {
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();

            $userReg = User::findOne(['email' => $post['email']]);

            if (!empty($userReg)) {
                $userReg->phone = $post['phone'];
                $userReg->phone_sent = date('Y-n-d H:i:s');
                $userReg->phone_approved = date('Y-n-d H:i:s');

                if ($userReg->save(false)){
                    if ($post['phone_approved']) {
                        echo "phone_approved";
                    } else {
                        echo "Success!";
                    }
                }
            } else {
                $model = new SignupForm();
                $model->username = $post['username'];
                $model->email = $post['email'];
                $model->password = Yii::$app->security->generateRandomString(6);
                $model->role = $post['role'];
                if (isset($post['phone'])) $model->phone = $post['phone'];
                $model->emailCode = Yii::$app->security->generateRandomString(32);
                $model->email_sent = date('Y-n-d H:i:s');

                $user = new User();
                $user->setUsername($model->username);
                $user->setEmail($model->email);
                $user->setPassword($model->password);
                $user->role = $model->role;
                if (isset($post['phone'])) $user->phone = $model->phone;
                if (isset($post['phone'])) $user->phone_sent = date('Y-n-d H:i:s');
                if (isset($post['phone'])) $user->phone_approved = date('Y-n-d H:i:s');
                $user->emailCode = $model->emailCode;
                $user->email_sent = $model->email_sent;

                $userDb = User::findOne(['email' => $model->email]);
                $model->userSendEmail($user, $model->password);

                if (!$userDb) {
                    if ($user->save(false)) {
                        if ($model->userSendEmail($user, $model->password)) {
                            echo "Success!";
                        }
                    }
                }
            }
        }
    }

    public static function actionSendPhoneCode() {
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $randNumber = rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9);

            $jsonValue = new stdClass();
            $jsonValue->from = 'reklama';
            $jsonValue->text = Yii::t('app', 'BlaBlaPrice.com код підтвердження : ') . $randNumber;
            $jsonValue->phoneNumbers = [$post['phone']];

            //   send sms request to esputnik service
            $creditionals = Yii::$app->params['esputnik']['user'] . ':' . Yii::$app->params['esputnik']['password'];
            $endpoint = Yii::$app->params['esputnik']['apiUrl'] . '/v1/message/sms';
            $curl = new curl\Curl();

            $response = $curl->setRequestBody(json_encode($jsonValue))
                ->setOption(CURLOPT_HEADER, 1)
                ->setHeaders([
                    'Accept: application/json',
                    'Content-Type' => 'application/json'
                ])
                ->setOption(CURLOPT_USERPWD, $creditionals)
                ->setOption(CURLOPT_RETURNTRANSFER, 1)
                ->post($endpoint);

            $response = json_decode($response);

            $result = (isset($response->results->status) && $response->results->status == 'OK') ? true : false;

            if ($result) {
                return $randNumber;
            } else {
                return 0;
            }
        }
    }

    /**
     * activation phone
     */
    public function actionActivationPhone() {
        if (!empty($_POST)) {
            $email = $_POST['email'];
            $phone = $_POST['phone'];

            $user = User::find()->where(['email' => $email])->one();
            $user->phone = $phone;
            $user->phone_sent = date('Y-n-d H:i:s');
            $user->phone_approved = date('Y-n-d H:i:s');
            
            if ($user->save(false)) return true;
        }
    }

    public static function actionRole() {
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();

            $user = User::findOne(['email' => $post['email']]);
            $user->role = $post['role'];

            if ($user->save(false)) {
                echo "Success!";
                $session = Yii::$app->session;
                $session->remove('popup_regsiter_social');
                $session->remove('email_social');
            }
        }
    }

    public static function actionAddRole() {
        $email = $_POST['email'];
        $role = $_POST['role'];
        $user = User::findOne(['email' => $email]);
        $user->role = $role;
        $user->save(false);
    }

    public static function actionAddRoleCookie() {
        $session = Yii::$app->session;
        $session->set('role', $_POST['role']);
    }

    public function actionResetSessionReg() {
        $session = Yii::$app->session;
        $session->remove('popup_regsiter_social');
        $session->remove('email_social');
        $session->remove('register_social');
        $session->remove('success_seller');
        $session->remove('email');
        $session->remove('role');
    }

    public function actionChange() {
        $post = Yii::$app->request->post();

        $userReg = User::findOne(['email' => $post['email']]);
        if ($userReg) return true;
        
        return false;
    }

    public static function actionAuth() {
        $email = $_POST['email'];
        $role = $_POST['role'];

        $user = User::findOne(['email' => $email]);
        $user->role = $role;
        $user->save();

        $model = new LoginForm();
        $model->email = $email;

        if ($model->login(false)) {
            $user = User::findOne(['email' => $email]);
        }
    }
}

?>
