<?php

namespace frontend\models;

use common\models\User;
use common\models\Order;
use common\models\Payment;
use linslin\yii2\curl;
use stdClass;
use Yii;
use yii\base\Model;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\db\ActiveRecord;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $emailCode;
    public $phone;
    public $password;
    public $role;
    public $region_id;
    public $email_sent;
    public $code;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            [
                'email',
                'unique',
                'targetClass' => User::class,
                'message' => Yii::t('app', 'Така email адреса вже використовується.')
            ],

            ['phone', 'trim'],
            ['phone', 'required'],
            [
                'phone',
                'unique',
                'targetClass' => User::class,
                'message' => Yii::t('app', 'Цей телефонний номер вже використовується.')
            ],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            ['role', 'required'],

            ['region_id', 'safe'],
            ['role', 'safe'],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|boolean the saved model or null if saving fails
     */
    public function signup()
    {


        if (!$this->validate()) {
            return false;
        }

        $inactiveUser = User::findOne([
            'email' => $this->email,
            'status' => User::STATUS_INACTIVE
        ]);

        if ($inactiveUser) {
            $inactiveUser->setUsername($this->username);
            $inactiveUser->setRegionID($this->region_id);
            $inactiveUser->setPhone($this->phone);
            $inactiveUser->setRole($this->role);
            $inactiveUser->setPassword($this->password);
            $inactiveUser->generateAuthKey();
            $inactiveUser->setEmailCode($this->emailCode);
            $inactiveUser->setStatus(User::STATUS_INACTIVE);

            //  delete all previous inactive user orders
            Order::deleteAll(['userID' => $inactiveUser->ID]);

            return $inactiveUser->save() ? $inactiveUser : false;
        }

        $user = new User();

        $user->setUsername($this->username);
        $user->setRegionID($this->region_id);
        $user->setEmail($this->email);
        $user->setPhone($this->phone);
        $user->setRole($this->role);
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->setEmailCode($this->emailCode);
        $user->setSmsCode(Yii::$app->security->generateRandomString(4));
        $user->setStatus(User::STATUS_INACTIVE);



        if ($user->save() && !$currUserDb) {

            // register user in esputnik system
            $this->userRegisterEsputnik($user);

            // send confirmation sms
            //$this->userSendSms($user);

            // send confirmation e-mail
            $this->userSendEmail($user, $this->password);

            if ($user->role == User::ROLE_SELLER) {
                $payment = new Payment();
                $payment->userID = $user->ID;
                $payment->amount = Yii::$app->params['bonus_amount'];
                $payment->transaction = 'Registration bonus added';
                $payment->save();
            }

            return $user;
        } elseif ($user->hasErrors()) {
            foreach ($user->getErrors() as $modelErrorCode => $modelError) {
                Yii::$app->session->setFlash('error', Yii::t('app', array_pop($modelError)));
            }
            return false;
        }

        return false;
    }

    /**
     * @param User $user
     *
     * @return boolean
     */
    public static function userRegisterEsputnik(User $user)
    {
        $result = false;

        //  create new contact for Esputnik service
        $contact = new stdClass();
        $contact->firstName = $user->getUsername();
        $contact->lastName = null;
        $contact->channels = [
            [
                'type' => 'email',
                'value' => $user->getEmail()
            ],
            [
                'type' => 'sms',
                'value' => $user->getPhone()
            ]
        ];

        $requestEntity = new stdClass();
        $requestEntity->contacts = [$contact];
        $requestEntity->dedupeOn = 'email';
        $requestEntity->contactFields = ['firstName', 'lastName', 'email', 'sms'];
        $requestEntity->groupNames = ['blablaprice'];

        //   send registration request to esputnik service
        $curl = new curl\Curl();
        $response = $curl->setRequestBody(json_encode($requestEntity))
            ->setOption(CURLOPT_HEADER, 1)
            ->setHeaders([
                'Accept: application/json',
                'Content-Type' => 'application/json'
            ])
            ->setOption(CURLOPT_USERPWD,
                Yii::$app->params['esputnik']['user'] . ':' . Yii::$app->params['esputnik']['password'])
            ->setOption(CURLOPT_RETURNTRANSFER, 1)
            ->post('https://esputnik.com.ua/api/v1/contacts');

        $response = json_decode($response);

        if ($curl->responseCode == 200 && isset($response->id) && !empty($response->id)) {
            $user->setAddressBookId($response->id);
            $user->save();
            $result = true;
        }

        return $result;
    }

    /**
     * @param User $user
     *
     * @return boolean
     */
    public static function userSendSms(User $user)
    {
        $jsonValue = new stdClass();
        $jsonValue->from = 'reklama';
        $jsonValue->text = Yii::t('app', 'BlaBlaPrice.com код підтвердження : ') . $user->smsCode;
        $jsonValue->phoneNumbers = [$user->phone];

        //   send sms request to esputnik service
        $curl = new curl\Curl();
        $response = $curl->setRequestBody(json_encode($jsonValue))
            ->setOption(CURLOPT_HEADER, 1)
            ->setHeaders([
                'Accept: application/json',
                'Content-Type' => 'application/json'
            ])
            ->setOption(CURLOPT_USERPWD,
                Yii::$app->params['esputnik']['user'] . ':' . Yii::$app->params['esputnik']['password'])
            ->setOption(CURLOPT_RETURNTRANSFER, 1)
            ->post('https://esputnik.com/api/v1/message/sms');

        $response = json_decode($response);

        return (isset($response->results->status) && $response->results->status == 'OK') ? true : false;
    }

    /**
     * @param User $user
     *
     * @return boolean
     */
    public static function userSendEmail(User $user, string $password = '')
    {
        $result = true;

        try {
            $registrationMessage = Yii::t('app', 'Вітаємо Вас!');
            $registrationMessage .= "<p>" . Yii::t('app', 'Ви успішно зареєструвалися на сайті') . " " .
                Html::a('BlaBlaPrice.com', $_SERVER['HTTP_HOST'], ['target' => '_blank']) . "</p>";

            if (!empty($password)) {
                $registrationMessage .= "<p><b>" . Yii::t('app', 'Ваш пароль:') . "</b> " . $password . PHP_EOL . "</p>";
            }

            $registrationMessage .= "<p><b>" . Yii::t('app', 'Підтвердження реєстрації:') . "</b> " .
                Html::a(
                    Yii::t('app', 'Підтвердження реєстрації'),
                    Url::to(['site/activation', 'code' => $user->getEmailCode()], true)
                ) . "</p>";

            Yii::$app->mailer->compose()
                ->setFrom(Yii::$app->params['noreplyEmail'])
                ->setTo($user->getEmail())
                ->setSubject(Yii::t('app', 'Реєстрація на BlaBlaPrice.com'))
                ->setTextBody(Yii::t('app', 'Ви успішно зареєструвалися на сайті'))
                ->setHtmlBody($registrationMessage)
                ->send();

            $user->setEmailSent(date('Y-m-d H:i:s'));
            $user->save();
        } catch (Exception $e) {
            $result = $e->getMessage();
        }

        return $result;
    }
}
