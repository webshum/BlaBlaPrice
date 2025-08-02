<?php

use yii\db\Migration;

class m000000_100000_set_foreign_keys extends Migration
{
    public function up()
    {

    // table `user2category`
        $this->addForeignKey(
            'fk-user2category-to-user',
            '{{%user2category}}',
            'userID',
            '{{%user}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-user2category-to-category',
            '{{%user2category}}',
            'categoryID',
            '{{%category}}',
            'ID',
            'CASCADE',
            'CASCADE'
        );


    //  table `order`
        $this->addForeignKey(
            'fk-order-to-category',
            '{{%order}}',
            'categoryID',
            '{{%category}}',
            'ID',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-order-to-user',
            '{{%order}}',
            'userID',
            '{{%user}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-order-to-product',
            '{{%order}}',
            'productID',
            '{{%product}}',
            'id',
            'CASCADE',
            'CASCADE'
        );


    // table `product`
        $this->addForeignKey(
            'fk-product-to-category',
            '{{%product}}',
            'categoryID',
            '{{%category}}',
            'ID',
            'CASCADE',
            'CASCADE'
        );


    // table `notification`
        $this->addForeignKey(
            'fk-notification-to-user',
            '{{%notification}}',
            'userID',
            '{{%user}}',
            'id',
            'CASCADE',
            'CASCADE'
        );


    //  table `offer`
        $this->addForeignKey(
            'fk-offer-to-user',
            '{{%offer}}',
            'userID',
            '{{%user}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-offer-to-order',
            '{{%offer}}',
            'orderID',
            '{{%order}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

    //table `offer_image`
        $this->addForeignKey(
            'fk-offer_image-to-offer',
            '{{%offer_image}}',
            'offerID',
            '{{%offer}}',
            'id',
            'CASCADE',
            'CASCADE'
        );


    // table `comment`
        $this->addForeignKey(
            'fk-comment-to-user-from',
            '{{%comment}}',
            'userFromID',
            '{{%user}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-comment-to-user-to',
            '{{%comment}}',
            'userToID',
            '{{%user}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-comment-to-offer',
            '{{%comment}}',
            'offerID',
            '{{%offer}}',
            'id',
            'CASCADE',
            'CASCADE'
        );


    //  table `payment`
        $this->addForeignKey(
            'fk-payment-to-user',
            '{{%payment}}',
            'userID',
            '{{%user}}',
            'id',
            'CASCADE',
            'CASCADE'
        );


    //  table `filter`
        $this->addForeignKey(
            'fk-filter-to-category',
            '{{%filter}}',
            'categoryID',
            '{{%category}}',
            'ID',
            'CASCADE',
            'CASCADE'
        );
    }

    public function down()
    {

    }
}
