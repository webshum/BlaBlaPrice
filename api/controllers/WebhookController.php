<?php

namespace api\controllers;

use yii\web\Controller;
use yii\web\Response;
use Yii;

class WebhookController extends Controller
{
    public $enableCsrfValidation = false;

    public function actionFastspringOrderCompleted()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        return ['status' => 'ok', 'data' => Yii::$app->request->post()];
    }

    public function actionTest() {
        dd('Hello');
        return 'Hello API';
    }
}
