<?php

use yii\helpers\Html;
use yii\helpers\Url;
use common\models\User;
use common\models\Order;
use yii\widgets\ActiveForm;
use frontend\models\Category;

/**
 * @var \yii\web\View $this
 * @var \common\models\Filter[] $filter
 * @var \common\models\Offer $offer
 * @var \common\models\Order $order
 */
$session = null;
if (Yii::$app->session->has('filter-session')) {
    $session = Yii::$app->session->get('filter-session');
    Yii::$app->session->destroy();
}

// generate regions
$user = User::findOne(['ID' => Yii::$app->user->id]);
$regionList = [];
$regionList = array_merge($regionList, Yii::$app->params['region'][Yii::$app->language]);

$lastRegion = Order::find()->where(['userID' => Yii::$app->user->id])->orderBy(['created_at' => SORT_DESC])->one();

$firstLevel = Category::find()
    ->where(['ID' => $category->primary_category_id])
    ->andWhere(['parentID' => 0])
    ->andWhere(['primary_category_id' => 0])
    ->one();

$secondLevel = Category::find()
    ->where(['ID' => $category->parentID])
    ->andWhere(['parentID' => $category->primary_category_id])
    ->one();
?>

<div class="center page-filter">
	
    <div class="request-head">
        <?= $this->render('@appTheme/layouts/header'); ?>
    </div>

    <div class="request request-main">
        <?php
            echo Html::beginForm('', 'post', [
                'class' => 'filter-form validate-form', 
                'name' => 'filter'
            ]);

            if ($category->primary_category_id != 0) {
                echo Html::hiddenInput('primary_category_id', $category->primary_category_id);
            } else {
                echo Html::hiddenInput('primary_category_id', $category->ID);
            }

            if (empty($category->subCategory)) {
                if ($category->parentID != $category->primary_category_id) {
                    echo Html::hiddenInput('parent_id', $category->parentID);
                } else {
                    echo Html::hiddenInput('parent_id', $category->ID);
                }
            } else if ($category->primary_category_id != 0) {
                echo Html::hiddenInput('parent_id', $category->ID);
            }  else {
                echo Html::hiddenInput('parent_id', 0);
            }

            echo Html::hiddenInput('category', $category->ID);
        ?>
		
        <div class="request-body">
		<div class="request-info">
			<?php echo Yii::t('app', 'Новий запит'); ?>
		</div>
            <div class="text-right">
                <div class="message">
                    <div class="box">
                        <div class="inner">

                           <?php 
                                if (!empty($firstLevel->name)) {
                                    echo "<a href='/site/filter?id={$firstLevel->ID}'>{$firstLevel->name }</a> > ";
                                }

                                if (!empty($secondLevel->name)) {
                                    echo "<a href='/site/filter?id={$secondLevel->ID}'>{$secondLevel->name}</a> <br> ";
                                }

                                echo "<b>{$category->name}</b>";
                           ?>
						   <div class="date"><?= Yii::t('app', 'Зараз'); ?></div>
                        </div>
                    </div>
                </div>
			</div>

            <?php if (!empty($category->subCategory)) : ?>
			<div class="blabla-comment  dark first" >
        	        <div class="text">
    				   
    					
        	        	<?php echo Yii::t('app', 'Вкажи детальніше що ти шукаєш'); ?>
						
    				      <ul class="text-right sub-filter">
                    <?php foreach ($category->subCategory as $subCategory) : ?>
                        <li>
                            <a href="/site/filter?id=<?php echo $subCategory->ID; ?>">
                                <?php echo $subCategory->name; ?>   
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
    		        </div>
                </div>
            <?php endif; ?>
			
            <?php if (empty($category->subCategory)) : ?>
    			<div class="blabla-comment  dark first" >
        	        <div class="text">
    				   
        	        	<?= Yii::t('app', 'Ти відправляєш свій запит продавцям з категорії'); ?>
    				      <b><?= $category->name; ?></b>
    		        </div>
                </div>
    			
    			<div class="blabla-comment  dark not-first middle" >
        	        <div class="text">
    				    <?= Yii::t('app', 'Напиши що тобі потрібно та отримай персональні пропозиції.') ?>
    					</br> 
    					<?= Yii::t('app', 'Якщо ціна влаштує обміняєшся контактами') ?>
    		        </div>
                </div>

    			<div class="blabla-comment  dark not-first last" >
        	        <div class="text">
        	        	<b><?= Yii::t('app', 'Регіон запиту:'); ?></b>   
                                   
                        <select name="regionID" class="input">
                            <?php foreach ($regionList as $key => $region) : ?>
                                <option value="<?php echo $key; ?>" <?php if ($key == $lastRegion->regionID) echo "selected"; ?>> <?= $region; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
    		        </div>
    			</div>
            <?php endif; ?>
        </div>

        <?php if (empty($category->subCategory)) : ?>
            <div class="request-foot">
                <input type="hidden" name="priceFrom" value="0">
                <div class="d-none">
                    <!-- <?= Html::input('text', 'deadLine', 
                        $session ? $session['deadLine'] : null,
                        [
                            'class' => 'input datepicker',
                            'id' => 'datepicker',
                            'placeholder' => Yii::t('app', 'Обери дату'),
                            'data-rel' => '1',
                            'required' => true
                        ]); 
                    ?>     -->               
                </div> 

                <div class="form-wrap">
                    <?= Html::textarea(
                        'comment', $session ? $session['comment'] : null,
                        [
                            'class' => 'input mt20', 
                            'placeholder' => Yii::t('app', 'Напиши деталі запиту')
                        ]
                    ); ?>                

                    <div id="login-area">
                        <?php
                            $linkClass = 'open-static-popup js-add-cookie-phone';
                            $linkDataRel = 'registration-user-phone';

                            if ($user->phone_approved !== '0000-00-00 00:00:00') {
                                $linkClass = 'submit-form';
                                $linkDataRel = '';
                            }

                            if (Yii::$app->user->isGuest) {
                                $linkClass = 'open-static-popup';
                                $linkDataRel = 'account-login';
                            }
                        ?>

                        <button type="submit" class="popup-send <?= $linkClass ?>" data-rel="<?= $linkDataRel ?>">
                            <svg><use xlink:href="#send"></use></svg> 
                        </button>
                    </div>
                </div>
            </div>
        <?php endif; ?>
		
        <?= Html::endForm(); ?>
    </div>
	
	 <?php if (!Yii::$app->user->identity->role == User::ROLE_SELLER) : ?>
	
		<div class="blabla-comment  dark " >
    	        <div class="text">
				  
				
    	        	<?= Yii::t('app', 'Якщо ти хочеш відповідати на запити з категорії'); ?>
				    <b><?= $category->name; ?></b>
					</br>
					<a class="popup-button dark mt10 open-static-popup " data-rel="account-login">
						<?= Yii::t('app', 'Реєструйся як продавець'); ?>
                    </a>
				</div>
        </div>
	<?php endif; ?>
</div>

<div class="popup-wrapper">
    <div class="close-layer"></div>

    <?php if (Yii::$app->user->isGuest) : ?>
        <?= $this->render('@appTheme/popup/popup-account-login') ?>
        <?= $this->render('@appTheme/popup/popup-account-registration') ?>
        <?= $this->render('@appTheme/popup/popup-account-reset-password') ?>
    <?php else : ?>
        <?= $this->render('@appTheme/popup/popup-phone-verification') ?>
    <?php endif; ?>

    <?= $this->render('@appTheme/popup/language'); ?>
</div>
