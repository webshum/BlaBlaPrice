<?php
namespace common\components;

use common\models\Social;
use common\models\User;
use common\models\UserSetting;
use Yii;
use yii\authclient\ClientInterface;
use yii\helpers\ArrayHelper;

/**
 * AuthHandler handles successful authentification via Yii auth component
 */
class AuthHandler
{
    /**
     * @var ClientInterface
     */
    private $client;
    private $rememberMe = true;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    public function handle()
    {
        $attributes = $this->client->getUserAttributes();

        $client = $this->client->getName();
        switch ($client) {
            case 'facebook' :
                $email = ArrayHelper::getValue($attributes, 'email');
                $id = ArrayHelper::getValue($attributes, 'id');
                $nickname = ArrayHelper::getValue($attributes, 'name');
                $user_model = User::findOne(['email' => $email]);
                break;
            case 'google' :
                $email = ArrayHelper::getValue($attributes, 'emails')[0]['value'];
                $id = ArrayHelper::getValue($attributes, 'id');
                $nickname = ArrayHelper::getValue($attributes, 'displayName');
                $user_model = User::findOne(['email' => $email]);
                break;
            case 'vkontakte' :
                $email = ArrayHelper::getValue($attributes, 'email');
                $id = ArrayHelper::getValue($attributes, 'id');
                $nickname = ArrayHelper::getValue($attributes, 'first_name') . ' ' . ArrayHelper::getValue($attributes,
                        'last_name');
                $user_model = User::findOne(['email' => $email]);
                break;
        }


        if (Yii::$app->user->isGuest) {
            if ($user_model) { // login

                Yii::$app->user->login($user_model, $this->rememberMe ? 3600 * 24 * 30 : 0);
            } else { // signup
                if ($email !== null && User::find()->where(['email' => $email])->exists()) {
                    Yii::$app->getSession()->setFlash('error', [
                        Yii::t('app',
                            "User with the same email as in {client} account already exists but isn't linked to it. Login using email first to link it.",
                            ['client' => $this->client->getTitle()]),
                    ]);
                } else {
                    $password = Yii::$app->security->generateRandomString(6);
                    $user = new User([
                        'username' => $nickname,
                        'email' => $email,
                        'password' => $password,
                        'role' => User::ROLE_USER,
                        'smsCode' => Yii::$app->security->generateRandomString(4),
                        //'socialUsername' => $id,
                    ]);
                    $user->generateAuthKey();
                    $user->generatePasswordResetToken();

                    $transaction = User::getDb()->beginTransaction();

                    if ($user->save()) {

                        $transaction->commit();
                        Yii::$app->user->login($user, $this->rememberMe ? 3600 * 24 * 30 : 0);
                    } else {
                        Yii::$app->getSession()->setFlash('error', [
                            Yii::t('app', 'Unable to save user: {errors}', [
                                'client' => $this->client->getTitle(),
                                'errors' => json_encode($user->getErrors()),
                            ]),
                        ]);
                    }
                }
            }
        } else { // user already logged in
            if (!$user_model) { // add auth provider
                $user_model = new User([
                    'ID' => Yii::$app->user->id,
                ]);
                if ($user_model->save()) {
                    Yii::$app->getSession()->setFlash('success', [
                        Yii::t('app', 'Linked {client} account.', [
                            'client' => $this->client->getTitle()
                        ]),
                    ]);
                } else {
                    Yii::$app->getSession()->setFlash('error', [
                        Yii::t('app', 'Unable to link {client} account: {errors}', [
                            'client' => $this->client->getTitle(),
                            'errors' => json_encode($auth->getErrors()),
                        ]),
                    ]);
                }
            } else { // there's existing auth
                Yii::$app->getSession()->setFlash('error', [
                    Yii::t('app',
                        'Unable to link {client} account. There is another user using it.',
                        ['client' => $this->client->getTitle()]),
                ]);
            }
        }
    }

    /**
     * @param User $user
     */
    private function updateUserInfo(User $user)
    {
        echo 'updateUserInfo';
        exit;
        /*        $attributes = $this->client->getUserAttributes();
                $github = ArrayHelper::getValue($attributes, 'login');
                if ($user->github === null && $github) {
                    $user->github = $github;
                    $user->save();
                }*/
    }
}
