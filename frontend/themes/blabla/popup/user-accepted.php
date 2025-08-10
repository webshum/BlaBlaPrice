<?php

use yii\helpers\Html;
use common\models\Comment;
use yii\widgets\ActiveForm;
use common\models\User;
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
 * @var \common\models\Offer $offer
 * @var Comment $comments
 */
?>

<div class="popup-container wide">
	<?php
		$title = '';

		if (!empty($offer) && !empty($offer->order)) {
			if (!empty($offer->order->product) && !empty($offer->order->product->name)) {
				$title = $offer->order->product->name;
			} elseif (!empty($offer->order->category) && !empty($offer->order->category->name)) {
				$title = $offer->order->category->name;
			}
		}

		echo $this->render('@appTheme/components/request-head', [
			'title' => $title,
			'button' => false
		]);
	?>

	<div class="request-body">
		<div class="request-body_inner">
			<!-- USER -->
			<div class="request-info">
				<?php echo Yii::t('app', 'Твій запит'); ?>
			</div>
			<?= $this->render('@appTheme/components/message', [
					
					'comment' => (!empty($offer->order->comment)) ? $offer->order->comment : false,
					'deadline' => $offer->order->deadLine,
					'region' => $offer->order->regionID,
					'date' => $offer->order->getCreatedAt(),
					'direction' => 'right'
				]); 
			?>	

			<!-- SELLER -->
			<div class="request-info">
				<?php echo Yii::t('app', 'Пропозиція продавця'); ?>
			</div>
			<?= $this->render('@appTheme/components/message', [
			    	'nameReviews' => $offer,
		    		'avatar' => $offer->user->username,
		    		'budget' => $offer->price,
		    		'comment' => (!empty($offer->comment)) ? $offer->comment : false,
		    		'date' => $offer->getCreatedAt(),
		    		'class' => !empty($rating['class']) ? $rating['class'] : '',
		    		'images' => $offer->image
		    	]);
			?>
			<div class="request-info">
				<?php echo Yii::t('app', 'Контакти продавця'); ?>
			</div>
			<?= $this->render('@appTheme/components/message', [
				'nameReviews' => $offer,
				'avatar' => $offer->user->username,
				'title' => Yii::t('app', 'Контакти:'),
				'phone' => $offer->user->phone,
				'email' => $offer->user->email,
			]); ?>
	        
			<div class="request-info">
				<?php echo Yii::t('app', 'Обмін відгуками'); ?>
			</div>
			
			<?php if ($offer->getRefuse($offer->order->userID)->one()) : 
				$refuse = $offer->getRefuse($offer->order->userID)->one();?>
					 
				<?php if ($refuse->comment ) : ?>
					<?= $this->render('@appTheme/components/message', [
						
						'title' => Yii::t('app', 'Я відмовився'),
						'name' => $refuse->comment,
						'date' => $refuse->updated_at,
						'direction' => 'right'
					]); ?>  
				<?php else : ?>
					<div class="text-right">
						<div class="message ">
							<div class="box">
								<div class="inner">
									<div class="title"><?= Yii::t('app', 'Я відмовився'); ?></div>
									<div class="name"><?php echo  Yii::$app->params['refuse'][$refuse->refuseID]  ?></div>
									<div class="date"><?php echo $refuse->updated_at; ?></div>
						        </div>
						    </div>
						</div>			
		            </div>
				<?php endif;?>

				<div class="blabla-comment dark ">
					<div class="text shadow-pulse-black">
						<strong>
							<?= Yii::t('app', 'Після відмови від пропозиції, ти можеш обрати іншого продавця, знайди свій запит та переглянь пропозиції інших продавців'); ?>
						</strong>
					</div>
				</div>
			<?php endif; ?>	

			<!-- USER -->
			<?php 
				if ($offer->getComment($offer->order->userID)->one()) {
				    $comments = $offer->getAnswer($offer->userID)->one();
				    $rating = Comment::Rating($comments->rating);
				    
				    echo $this->render('@appTheme/components/message', [
				    	
			    		'title' => $rating['name'] . ' ' . Yii::t('app', 'продавець'),
			    		'name' => (!empty($comments->comment)) ? $comments->comment : false,
			    		'date' => $comments->getUpdatedAt(),
			    		'class' => $rating['class'],
			    		'direction' => 'right'
			    	]);
				}
			?>

			<!-- SELLER -->
			<?php 
				if (!empty($offer->getComment($offer->userID)->one())) {
					$commentSeller = $offer->getComment($offer->userID)->one();

	            	echo $this->render('@appTheme/components/message', [
	            		'avatar' => $offer->user->username,
	            		'nameReviews' => $offer,
	            		'title' => $commentSeller['name'] . ' ' . Yii::t('app', 'покупець'),
	            		'name' => $commentSeller['comment'],
	            		'date' => $commentSeller->getUpdatedAt(),
	            		'class' => $commentSeller['class']
	            	]);
				} 
			?>

			<?php if (!$offer->getRefuse($offer->order->userID)->one()) : ?>
		
				<?php if (empty($rating)) : ?>
					<div class="blabla-comment dark first">
							<div class="text shadow-pulse-black">
								<strong>
									<?= Yii::t('app', 'Якщо тобі все підходить і не потрібно звертатись до іншого продавця - залиш відгук. Якщо потрібно відкрити контакти іншого продавця - відмовся від пропозиції.'); ?>
								</strong>
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
									<?= Yii::t('app', 'Залишити відгук'); ?>	
								</a>
							</li>
							<li>
								<a href="#" data-tab="tab-spam" class="js-spam" >
									<svg><use xlink:href="#delete"></use></svg>
									<?= Yii::t('app', 'Відмовитись від пропозиції'); ?>	
								</a>
							</li>
							<li>
								<a href="#" data-tab="tab-share" class="js-share" >
									<svg><use xlink:href="#soc"></use></svg>
									<?= Yii::t('app', 'Поширити'); ?>	
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
				<?php else : ?>	
					<div class="blabla-comment dark first">
							<div class="text shadow-pulse-black">
								<strong>
									<?= Yii::t('app', 'Ти можеш змінити свій відгук. Також не забудь розказати про BlaBlaPrice друзям і знайомим'); ?>
								</strong>
							</div>
					</div>
					<div class="drop-menu active">
						<a href="#">
							<span><?= Yii::t('app', 'Твої дії'); ?></span>	 <svg><use xlink:href="#dot"></use></svg>
						</a>

						<ul class="drop active">
							<li>
								<a href="#" data-tab="tab-share" class="js-share" >
									<svg><use xlink:href="#soc"></use></svg>
									<?= Yii::t('app', 'Поширити'); ?>	
								</a>
							</li>
							<li>
								<a href="#" data-tab="tab-answer" class="js-answer" >
									<svg><use xlink:href="#offers"></use></svg>
									<?= Yii::t('app', 'Змінити відгук'); ?>	
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

	<div class="tabs-block">
        <div class="tab-entry tab-answer" <?php if (empty($rating)) : ?> style="display: block;" <?php endif; ?>	>
			<div class="request-foot">
				<?php
					echo Html::beginForm(['cabinet/accepted-with-ans']);
					echo Html::hiddenInput('Comment[userFromID]', $offer->order->userID);
					echo Html::hiddenInput('Comment[userToID]', $offer->userID);
					echo Html::hiddenInput('Comment[offerID]', $offer->ID);
					if ($offer->getAnswer($offer->userID)->one()) {
						echo Html::hiddenInput('Comment[ID]', $offer->getAnswer($offer->userID)->one()->ID);
					} else {
						echo Html::hiddenInput('Comment[ID]', '');
					}
					echo Html::hiddenInput('Comment[rating]', Comment::RATING_GOOD);
				?>
					<div class="form-wrap">
						<?= $this->render('@appTheme/components/button-reviews'); ?>

						<div class="input-reviews">
							<div class="text"></div>
							<?php
								echo Html::textarea('Comment[comment]', 
									$offer->getAnswer($offer->userID)->one() ? strip_tags($offer->getAnswer($offer->userID)->one()->comment) : '',
									[
										'class' => 'input',
										'placeholder' => Yii::t('app', 'Залиш відгук тут')
									]);
							?>
						</div>

						<button type="submit" class="popup-send blue">
							<svg><use xlink:href="#send"></use></svg> 
						</button>
					</div>
				<?= Html::endForm(); ?>
			</div>	
		</div>	

		<div class="tab-entry tab-spam">
			<div class="request-foot">
			  	<?php
					if (!empty($offer_comment)) $comment_item = $offer_comment;
					else $comment_item = $comment;

	                $form = ActiveForm::begin([
	                    'action' => ['cabinet/accepted-without-ans'],
	                    'fieldConfig' => ['template' => "{input}", 'options' => ['tag' => false]]
	                ]);
	                echo $form->field($comment_item,
	                    'userFromID')->hiddenInput(['value' => Yii::$app->user->id])->label(false);
	                echo $form->field($comment_item,
	                    'userToID')->hiddenInput(['value' => $offer->userID])->label(false);
	                echo $form->field($comment_item, 'offerID')->hiddenInput(['value' => $offer->ID])->label(false);

	                if (!empty($offer_comment)) {
	                    echo $form->field($comment_item,
	                        'ID')->hiddenInput(['value' => $offer_comment->ID])->label(false);
	                }
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
						<button type="submit" class="popup-send">
                                <svg><use xlink:href="#send"></use></svg> 
                            </button>

                       
                    </div>  
	            <?php ActiveForm::end(); ?>
	        </div>
		</div>	

		<div class="tab-entry tab-share" <?php if (!empty($rating)) : ?> style="display: block;" <?php endif; ?>>
			<div class="request-foot">
				<?= $this->render('@appTheme/components/social'); ?>
			</div>
		</div>	
	</div>
	<?php endif; ?>	
</div>