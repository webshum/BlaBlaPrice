<?php

namespace app\controllers\api;

use yii\web\Controller;
use yii\web\Response;

class WebhookController extends Controller
{
    public function actionFastspringOrderCompleted()
    {
        // Перевірка secret key (якщо використовується)
        $secretKey = 'mysupersecrethmackey123'; // Замініть на свій secret key
        $requestSignature = $_SERVER['HTTP_X_FASTSPRING_SIGNATURE'] ?? '';
        $calculatedSignature = hash_hmac('sha256', file_get_contents('php://input'), $secretKey);

        if ($requestSignature !== $calculatedSignature) {
            error_log("Invalid signature: " . json_encode($_POST));
            http_response_code(403);
            return ['status' => 'error', 'message' => 'Invalid signature'];
        }

        // Отримання даних webhook-а
        $data = Yii::$app->request->post();

        // Перевірка типу події
        if (!isset($data['event']['type']) || $data['event']['type'] !== 'order.completed') {
            error_log("Not an order.completed event");
            http_response_code(400);
            return ['status' => 'error', 'message' => 'Not an order.completed event'];
        }

        // Отримання інформації про замовлення
        $orderData = $data['event']['payload']['order'];
        $customerEmail = $orderData['customer']['email'];
        $products = $orderData['products'];

        // Обробка продуктів
        foreach ($products as $product) {
            $productId = $product['product'];
            $quantity = (int)$product['quantity'];

            // Визначення кількості балів
            switch ($productId) {
                case 'points-for-contact-exchange-mini':
                    $pointsToAdd = 10 * $quantity;
                    break;
                case 'points-for-contact-exchange-standard':
                    $pointsToAdd = 30 * $quantity;
                    break;
                case 'points-for-contact-exchange-max':
                    $pointsToAdd = 100 * $quantity;
                    break;
                default:
                    error_log("Unknown product ID: " . $productId);
                    continue;
            }

            // Додавання балів користувачеві
            addPointsToUser($customerEmail, $pointsToAdd);
        }

        // Повертаємо успішну відповідь
        return ['status' => 'success'];
    }

    // Функція для додавання балів користувачеві
    private function addPointsToUser($email, $points)
    {
        // Підключення до БД
        $db = \Yii::$app->db;

        // Пошук користувача за email
        $user = $db->createCommand("SELECT id, bal FROM user WHERE email = :email")
            ->bindValue(':email', $email)
            ->queryOne();

        if (!$user) {
            error_log("User not found with email: " . $email);
            return false;
        }

        // Оновлення балів
        $newBalance = $user['bal'] + $points;

        $db->createCommand()
            ->update('user', [
                'bal' => $newBalance,
                'updated_at' => date('Y-m-d H:i:s')
            ], 'id = ' . $user['id'])
            ->execute();

        error_log("Added {$points} points to user {$email}. New balance: {$newBalance}");
    }
}