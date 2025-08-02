<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Password reset request form
 */
class PasswordResetRequestForm extends Model
{
    public $email;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            [
                'email',
                'exist',
                'targetClass' => '\common\models\User',
                //'filter' => ['status' => User::STATUS_ACTIVE],
                'message' => Yii::t('app', 'Користувача з такою адресою немає.')
            ],
        ];
    }

    /**
     * Sends an email with a link, for resetting the password.
     *
     * @return boolean whether the email was send
     */
    /*    public function sendEmail()
        {
            /* @var $user User
            $user = User::findOne([
                'status' => User::STATUS_ACTIVE,
                'email' => $this->email,
            ]);

            if (!$user) {
                return false;
            }

            if (!User::isPasswordResetTokenValid($user->passwordResetToken)) {
                $user->generatePasswordResetToken();
                if (!$user->save()) {
                    return false;
                }
            }

            return Yii::$app
                ->mailer
                ->compose(
                    ['html' => 'passwordResetToken-html', 'text' => 'passwordResetToken-text'],
                    ['user' => $user]
                )
                ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
                ->setTo($this->email)
                ->setSubject('Password reset for ' . Yii::$app->name)
                ->send();
        }*/

    public function sendEmail()
    {
        /* @var $user User */
        $user = User::findOne([
            'email' => $this->email
        ]);

        $password = Yii::$app->security->generateRandomString(6);
        $user->setPassword($password);
        if ($user->save()) {
            return Yii::$app->mailer->compose()
                ->setFrom(Yii::$app->params['noreplyEmail'])
                ->setTo($user->getEmail())
                ->setSubject(Yii::t('app', 'Зміна пароля на сайті BlaBlaPrice.com'))
                ->setTextBody(Yii::t('app', 'Ви успішно скинули свій пароль'))
                ->setHtmlBody('<b>'.Yii::t('app', 'Пароль: ').'</b> ' . $password)
                ->send();
        } else {
            return false;
        }
    }
}
