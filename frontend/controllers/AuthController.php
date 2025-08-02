<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\authclient\AuthAction;
use common\models\User;

class AuthController extends Controller
{
    public function actions()
    {
        return [
            'auth' => [
                'class' => AuthAction::class,
                'successCallback' => [$this, 'onAuthSuccess'],
            ],
        ];
    }

    public function onAuthSuccess($client)
    {
        $attributes = $client->getUserAttributes();

        $provider = $client->getId();

        switch ($provider) {
            case 'google':
                $email = $attributes['email'] ?? null;
                $socialId = $attributes['sub'] ?? null;
                $name = $attributes['name'] ?? null;
                break;

            case 'facebook':
                $email = $attributes['email'] ?? null;
                $socialId = $attributes['id'] ?? null;
                $name = $attributes['name'] ?? null;
                break;

            case 'instagram':
                $email = null;
                $socialId = $attributes['id'] ?? null;
                $name = $attributes['username'] ?? null;
                break;

            default:
                $email = null;
                $socialId = null;
                $name = null;
        }

        $user = User::findOne(['social_id' => $socialId, 'provider' => $provider]);

        if (!$user) {
            $user = new User();
            $user->social_id = $socialId;
            $user->provider = $provider;
            $user->email = $email;
            $user->name = $name;
            $user->save(false);
        }

        Yii::$app->user->login($user);

        return $this->goHome();
    }
}