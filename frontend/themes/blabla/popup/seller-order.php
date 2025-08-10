<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\User;
use frontend\models\Category;
use yii\helpers\Url;
use frontend\models\SignupForm;

// Set current user phone :
if (Yii::$app->user->isGuest) {
    $user = new \common\models\User();
} else {
    $user = Yii::$app->user->identity;
}

// generate regions
$user = User::findOne(['ID' => Yii::$app->user->id]);

/**
 * @var \yii\web\View $this
 * @var \common\models\Order $order
 * @var \common\models\Offer $offer
 */
?>

<div class="popup-container wide">
    <?= $this->render('@appTheme/components/request-head', [
        'title' => $order->category->name.' ('.$order->category->price.'$)',
		'button' => false
    ]); ?>

    <div class="request-body seller-order">
        <div class="request-body_inner">
    		<div class="request-info">
    			<?php echo Yii::t('app', 'Запит від') . ' ' . $order->user->userName; ?>
    	    </div>
            <!-- USER -->
            <?= $this->render('@appTheme/components/message', [
                    'avatar' => $order->user->username,
                    'title' => $order->category->name,
                    'nameReviews' => $order,
                    'comment' => (!empty($order->comment)) ? $order->comment : false,
                    'deadline' => $order->deadLine,
                    'region' => $order->regionID,
                    'date' => $order->getCreatedAt(),
                   
                ]);
    		?>

            <?php if ($user->bal <= 0) : ?>
				<div class="blabla-comment dark first">
                    <div class="text shadow-pulse-black">
                         <p><?= Yii::t('app', 'Відповідайте на запити покупців — це повністю безкоштовно.'); ?><br><br>
							<?= Yii::t('app', 'Якщо покупець обере саме вашу пропозицію — ви і клієнт обміняєтесь контактами для узгодження деталей замовлення.'); ?><br>
						</p>
                    </div>
                </div>
                <div class="blabla-comment dark not-first last">
					<div class="text shadow-pulse-black">
						
						<?= Yii::t('app', 'Щоб обмінюватись контактами — ваш баланс має бути поповнений.'); ?><br><br>
                        <a href="/cabinet/payment" class="menu-button blue" style="margin-top:10px">
                            <?= Yii::t('app', 'Поповнити баланс'); ?>
                        </a>
					</div>
				</div>
			<?php else : ?>
				<div class="blabla-comment dark ">
					<div class="text shadow-pulse-black">
						
						<?= Yii::t('app', 'Надай відповідь клієнту, або видали запит'); ?>
							
						</div>
				</div>
				<div class="drop-menu active">
					<a href="#">
						<span><?= Yii::t('app', 'Твої дії'); ?></span>	 <svg><use xlink:href="#dot"></use></svg>
					</a>

					<ul class="drop active">
						<li>
							<a href="#" data-tab="tab-answer" class="js-answer" >
								<svg><use xlink:href="#offers"></use></svg>
								<?= Yii::t('app', 'Відповісти клієнту'); ?>	
							</a>
						</li>
						<li>
							<a href="#" data-tab="tab-spam" class="js-spam" style=" color:#d62a2b" >
								<svg><use xlink:href="#delete"></use></svg>
								<?= Yii::t('app', 'Видалити чат'); ?>	
							</a>
						</li>
						<li>
						<a href="#" class="js-close-popup">
							<svg class="close-chat"><use xlink:href="#close-layer"></use></svg>
								<?= Yii::t('app', 'Закрити вікно чату'); ?>
								
						</a>
					</li>
					
					</ul>
				</div>	
			<?php endif; ?>
        </div>
    </div>

   
        <?php if ($user->bal <= 0) : ?>
		  
        <?php else : ?>
            <div class="tabs-block">
                <div class="tab-entry tab-answer" style="display: block;">
                    <?php 
                        $form = ActiveForm::begin([
                            'action' => ['cabinet/order'],
                            'options' => [
                                'class' => 'validate-form'
                            ],
                            'fieldConfig' => [
                                'template' => "{input}",
                                'options' => [
                                    'enctype' => 'multipart/form-data',
                                    'tag' => false,
                                ]
                            ],
                        ]);

                        echo $form->field($offer, 'orderUserEmail')->hiddenInput(['value' => $order->user->email])->label(false);
                        echo $form->field($offer, 'userID')->hiddenInput(['value' => Yii::$app->user->id])->label(false);
                        echo $form->field($offer, 'categoryID')->hiddenInput(['value' => $order->categoryID])->label(false);
                        echo $form->field($offer, 'orderID')->hiddenInput(['value' => $order->ID])->label(false);
                    ?>

                    <div class="input-group align-center">
                        <div class="list-files-uploaded">
                            <label class="button input-file">
                                <svg><use xlink:href="#file"></use></svg>

                                <?php if(!empty($offer->logo)){
                                    echo Html::img($offer->logo, $options = ['class' => 'postImg', 'style' => ['width' => '180px']]);
                                } ?>

                                <input type="hidden" name="MAX_FILE_SIZE" value="1000">

                                <?= $form->field($offer, 'offerImage')->fileInput([
                                    'class' => 'file-upload',
                                    // 'multiple' => true,
                                    'accept' => 'image/*'
                                ])->label(false); ?>
                            </label>
                            <div class="wrap"></div>
                        </div>

                        <?= $form->field($offer, 'price')->input('number', [
                            'class' => 'input',
                            'placeholder' => Yii::t('app', 'Вкажи ціну') . ' (' . Yii::t('app', 'грн') . ')',
                            'style' => '',
                            'required' => true,
                        ])->label(false); ?>

                        <?= $form->field($offer, 'comment')->textarea([
                            'class' => 'input',
                            'placeholder' => Yii::t('app', 'Вкажи деталі пропозиції')
                        ])->label(false); ?>

                        <?php 
                            $category = Category::findOne(['ID' => $order->categoryID]);
                            if ($user->phone_approved  == '0000-00-00 00:00:00') : 
                        ?>
                            <button type="submit" class="no-active popup-send blue">
                                <svg><use xlink:href="#send"></use></svg>  
                            </button>
                        <?php else : ?>
                            <button type="submit" class="popup-send blue" >
                                <svg><use xlink:href="#send"></use></svg> 
                            </button>
                        <?php endif; ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>

                <div class="tab-entry tab-spam">
                    <?php
                        $form = ActiveForm::begin([
                            'action' => ['cabinet/order'],
                            'fieldConfig' => ['template' => "{input}", 'options' => ['tag' => false]]
                        ]);

                        echo $form->field($comment,
                                'userFromID')->hiddenInput(['value' => Yii::$app->user->id])->label(false);
                        echo $form->field($comment, 'userToID')->hiddenInput(['value' => $order->userID])->label(false);
                        echo $form->field($comment, 'orderID')->hiddenInput(['value' => $order->ID])->label(false);
                    ?>

                    <div class="input-group align-center">
                       

                        <?php foreach (Yii::$app->params['refuse'] as $key => $refuse_item) : ?>
                            <label class="input-radio label-spam">
                                <?php
                                    echo \yii\helpers\Html::radio('Comment[refuseID]', 
                                        $comment->refuseID == $key ? true : false, [
                                            'value' => $key
                                        ]);
                                ?>
                                <div class="radio"></div>
                                <span><?php echo $refuse_item ?></span>
                            </label>
                        <?php endforeach; ?>
						 <label class="label-comment">
                            <?php
                                echo \yii\helpers\Html::radio('Comment[refuseID]', false, [
                                    'value' => 0,
                                    'class' => 'radio-comment'
                                ]);

                                echo $form->field($comment, 'comment')->textarea([
                                        'class' => 'input',
                                        'placeholder' => Yii::t('app', 'Інше')
                                    ])->label(false);
                            ?>
                        </label>

                        <?php if ($user->phone_approved  == '0000-00-00 00:00:00') : ?>
                            <button type="submit" class="popup-send no-active">
                                <svg><use xlink:href="#send"></use></svg> 
                            </button>
                        <?php else : ?> 
                            <button type="submit" class="popup-send" style="background: #d62a2b;">
                                <svg><use xlink:href="#send"></use></svg> 
                            </button>
                        <?php endif; ?>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        <?php endif; ?>
    
</div>