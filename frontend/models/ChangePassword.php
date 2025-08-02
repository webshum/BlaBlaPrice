<?php
/**
 * Created by PhpStorm.
 * User: Bogdan
 * Date: 27.07.2016
 * Time: 12:06
 */

namespace frontend\models;


use common\models\User;
use yii\base\Model;
use Yii;

/**
 * Class ChangePassword
 * @package frontend\models
 *
 * @property string $email
 * @property string $old_password
 * @property string $new_password
 * @property string $confirm_password
 */
class ChangePassword extends Model
{
    //public $email;
    public $old_password;
    public $new_password;
    public $confirm_password;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //['email', 'trim'],
            [['old_password', 'new_password', 'confirm_password'], 'required'],
            //['email', 'email'],
            //['email', 'validateEmail'],
            ['old_password', 'validatePassword'],
            ['new_password', 'validateNewPassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = User::findOne(['ID' => Yii::$app->user->id]);
            if (!$user || !$user->validatePassword($this->old_password)) {
                $this->addError($attribute, Yii::t('app', 'Неправильний старий пароль.'));
            }
        }
    }

    /**
     * Validates new password.
     * This method serves as the inline validation for new password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validateNewPassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            if ($this->new_password !== $this->confirm_password) {
                $this->addError($attribute, Yii::t('app', 'Невірний новий пароль.'));
            }
        }
    }

    /**
     * Validates the email.
     * This method serves as the inline validation for email.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validateEmail($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = User::findOne(['ID' => Yii::$app->user->id]);
            if ($user->email != $this->email) {
                $find = User::findByEmail($this->email);
                if ($find) {
                    $this->addError($attribute, Yii::t('app', 'Невірний email.'));
                }
            }
        }
    }

    /**
     *Change password
     * This method chang user password
     */
    public function changePassword()
    {
        $user = User::findOne(['ID' => Yii::$app->user->id]);

        $user->setPassword($this->new_password);
        $user->generateAuthKey();
        $user->save();
    }
}