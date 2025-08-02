<?php
/**
 * Popup controller
 *
 **/

namespace frontend\controllers;

use common\models\Comment;
use common\models\Notification;
use common\models\Product;
use common\models\User;
use frontend\models\UserFilter;
use Yii;
use common\models\Offer;
use common\models\Order;
use common\models\Category;
use yii\web\Controller;

class PopupController extends MenuController
{
    public $layout = false;

    public function actionSellerFilter()
    {
        $category = Category::findAll(['parentID' => Yii::$app->request->post('id')]);
        $breadcrumb = $this->categoryBreadcrumb(Yii::$app->request->post('id'));
        $filters = UserFilter::find()->where(['userID' => Yii::$app->user->id])->one();
        
        return $this->render('seller-filter', ['category' => $category, 'breadcrumb' => $breadcrumb, 'filters' => $filters->filter]);
    }

    public function actionUserOrder()
    {
        $free_user = User::find()
            ->leftJoin('{{%user2category}}', '{{%user}}.ID = {{%user2category}}.userID')
            ->where('{{%user2category}}.userID IS NULL')
            ->andWhere(['{{%user}}.role' => User::ROLE_SELLER])
            ->count();

        $order = Order::findOne(['ID' => Yii::$app->request->post('id')]);

        foreach ($order->offers as $offer_item) {
            if (!$offer_item->notification) {
                $notification = new Notification();
                $notification->objectID = $offer_item->ID;
                $notification->type = Notification::TYPE_OFFER;
                $notification->view = Notification::TYPE_VIEWED;

                if ($notification->validate()) {
                    $notification->save();
                } else {
                    //print_r($notification->getErrors());
                }
            }
        }

        return $this->render('user-order', [
            'order' => $order,
            'free_user' => $free_user
        ]);
    }

    public function actionUserDesibledOrder()
    {
        $free_user = User::find()
            ->leftJoin('{{%user2category}}', '{{%user}}.ID = {{%user2category}}.userID')
            ->where('{{%user2category}}.userID IS NULL')
            ->andWhere(['{{%user}}.role' => User::ROLE_SELLER])
            ->count();
        $order = Order::findOne(['ID' => Yii::$app->request->post('id')]);

        foreach ($order->offers as $offer_item) {
            if (!$offer_item->notification) {
                $notification = new Notification();
                $notification->objectID = $offer_item->ID;
                $notification->type = Notification::TYPE_OFFER;
                $notification->view = Notification::TYPE_VIEWED;
                $notification->save();
            }
        }
        return $this->render('user-desibled-order', ['order' => $order, 'free_user' => $free_user]);
    }

    public function actionUserOffer()
    {
        $offer = Offer::findOne(['ID' => Yii::$app->request->post('id')]);
        return $this->render('user-offer', ['offer' => $offer]);
    }

    public function actionUserViewContact()
    {
        $offer = Offer::findOne(['ID' => Yii::$app->request->post('id')]);
        if (!$offer->accepted) {
            $offer->order->status = Order::STATUS_DISABLE;
            $offer->order->save();
            $offer->accepted = date('Y-m-d H:i:s', time());
            $offer->save();
        }
        return $this->render('user-view-contact', ['user' => $offer->user]);
    }

    public function actionSellerOrder()
    {
        $offer = new Offer();
        $comment = new Comment();
        $order = Order::findOne(['ID' => Yii::$app->request->post('id')]);
        if (!$order->notification) {
            $notification = new Notification();
            $notification->objectID = $order->ID;
            $notification->type = Notification::TYPE_ORDER;
            $notification->view = Notification::TYPE_VIEWED;
            $notification->userID = Yii::$app->user->id;
            $notification->save();
        }
        return $this->render('seller-order', ['offer' => $offer, 'order' => $order, 'comment' => $comment]);
    }

    public function actionSellerOffer()
    {
        $comment = new Comment();
        if (Yii::$app->request->post() && isset(Yii::$app->request->post()['Comment'])) {
            if (isset(Yii::$app->request->post('Comment')['ID'])) {
                Comment::deleteAll(['ID' => Yii::$app->request->post('Comment')['ID']]);
            }
            $comment->load(Yii::$app->request->post());
            $comment->save();
            return $this->redirect(['cabinet/accepted']);
        }

        $userID = (!empty(Yii::$app->user->id)) ? Yii::$app->user->id : 0;

        $offerByUserID = Offer::findOne(['userID' => $userID]);
        $offer = Offer::findOne(['ID' => Yii::$app->request->post('id')]);

        return $this->render('seller-offer', [
            'offer' => $offer, 
            'offerByUserID' => $offerByUserID
        ]);
    }

    public function actionSellerPriceDown()
    {
        $offer = Offer::findOne(['ID' => Yii::$app->request->post('id')]);
        return $this->render('seller-price-down', ['offer' => $offer]);
    }

    public function actionSellerAccepted()
    {
        $offer = Offer::findOne(['ID' => Yii::$app->request->post('id')]);
        return $this->render('seller-accepted', ['offer' => $offer]);
    }

    public function actionSellerAccepted2()
    {
        $offer = Offer::findOne(['ID' => Yii::$app->request->post('id')]);
        return $this->render('seller-accepted2', ['offer' => $offer]);
    }

    public function actionUserComment()
    {
        $offer = Offer::findOne(['ID' => Yii::$app->request->post('id')]);
        return $this->render('user-comment', ['offer' => $offer]);
    }

    public function actionSellerViewComment()
    {
        $user = User::findOne(['ID' => Yii::$app->request->post('id')]);
        return $this->render('seller-view-comment', ['user' => $user]);
    }

    public function actionUserAccepted()
    {
        $comment = new Comment();
        $offer = Offer::findOne(['ID' => Yii::$app->request->post('id')]);
        return $this->render('user-accepted', [
            'offer' => $offer,
            'comment' => $comment
        ]);
    }

    public function actionSellerComment()
    {
        $user = User::findOne(['ID' => Yii::$app->request->post('id')]);
        return $this->render('seller-comment', ['user' => $user]);
    }

    public function actionDetail()
    {
        $product = Product::findOne(['ID' => Yii::$app->request->post('id')]);

        return $this->render('detail', ['product' => $product]);
    }

    public function actionGallery()
    {
        $type = Yii::$app->request->post('type');
        $id = Yii::$app->request->post('id');
        $arr = array();

        switch ($type) {
            case 'product' :
                $product = Product::findOne(['ID' => $id]);
                $arr[] = $product->image;
                break;
            case 'offer' :
                $offer = Offer::findOne(['ID' => $id]);
                $arr = $offer->getGalleryImage();
                break;
        }

        return $this->render('gallery', ['arr' => $arr]);
    }

    public function actionSubFilter($id)
    {
        return $this->renderPartial('sub-filter', ['categoryID' => $id, 'user' => Yii::$app->user->identity]);
    }
}