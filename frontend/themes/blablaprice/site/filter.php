<?php

use yii\helpers\Html;
use yii\helpers\Url;
use common\models\User;
use common\models\Order;
use yii\widgets\ActiveForm;

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
$regionList = array_merge($regionList, Yii::$app->params['region'][$_SESSION['language']]);

$lastRegion = Order::find()->where(['userID' => Yii::$app->user->id])->orderBy(['created_at' => SORT_DESC])->one();

?>

    <div id="content-block">



    <?php if (Yii::$app->user->identity->role == User::ROLE_USER) : ?>
	<div class="sidebar visible-lg">
		<div class="empty-space col-xs-b35 col-sm-b35"></div>

		<div class="container sidebar-container">
			<div class="sidebar-title menu-button-style hidden-lg"><?= $menu ?></div>


			<div class="sidebar-toggle">
				<div class="sidebar-menu">



				<a class="sidebar-menu-item <?= $active == 'product' ? 'active' : '' ?>"
                   href="<?= Url::to(['cabinet/order']) ?>">
                    <span class="icon">
                       <i class="icon-bullhorn"></i>
                    </span>
                    <span class="description">
                        <span class="align"><?= Yii::t('app', 'Мої запити') ?></span>
                    </span>
                    <?php if ($this->context->count_orders > 0): ?>
                        <span class="button style-11 size-4 ">
                            <span><?= $this->context->count_orders ?></span>
                        </span>
                    <?php endif; ?>
                </a>
                <a class="sidebar-menu-item <?= $active == 'accepted' ? 'active' : '' ?>"
                   href="<?= Url::to(['cabinet/accepted']) ?>">
                    <span class="icon">
                       <i class="icon-users-outline"></i>
                    </span>
                    <span class="description">
                        <span class="align">
                            <?= Yii::t('app', 'Контакти компаній') ?> <br/>

                        </span>
                    </span>
                    <?php if ($this->context->accepted_offers > 0): ?>
                        <span class="button style-11 size-4 ">
                            <span><?= $this->context->accepted_offers ?></span>
                        </span>
                    <?php endif; ?>
                </a>
                <a class="sidebar-menu-item <?= ($active == 'comment') ? 'active' : '' ?>" href="<?= Url::to(['cabinet/comment']) ?>">
                    <span class="icon">
						<i class="icon-chat-alt"></i>

                    </span>
                    <span class="description">
                        <span class="align">
                            <?= Yii::t('app', 'Відгуки про мене') ?>
                        </span>
                    </span>
                    <?php if ($this->context->count_feedback > 0): ?>
                        <span class="button style-11 size-4 ">
                            <span><?= $this->context->count_feedback ?></span>
                        </span>
                    <?php endif; ?>
                </a>

                <div class="clear"></div>
            </div>
        </div>


    </div>
</div>
<div class="float-container-bottom hidden-lg" >
            <div class="footer-main-link" style="left:12%;">

               <a href="/cabinet/order" class="link-footer"><i class="icon-logout"></i><span><?= Yii::t('app', 'Запити'); ?></a>
               <a href="/cabinet/accepted" class="link-footer "><i class="icon-users-outline"></i><span><?= Yii::t('app', 'Контакти'); ?></span></a>
               <a href="/cabinet/comment" class="link-footer "><i class="icon-chat-alt"></i><span><?= Yii::t('app', 'Відгуки'); ?></span></a>




        </div>
        </div>
<?php elseif (Yii::$app->user->identity->role == User::ROLE_SELLER) : ?>
<div class="sidebar visible-lg">
 <div class="empty-space col-xs-b35 col-sm-b35"></div>
    <div class="container sidebar-container">
        <div class="sidebar-title menu-button-style hidden-lg"><?php echo $menu ?></div>
        <div class="sidebar-toggle">
            <div class="sidebar-menu">
                <a class="sidebar-menu-item <?php echo $active == 'order' ? 'active' : '' ?>"
                   href="<?php echo Url::to(['cabinet/order']) ?>">
                            <span class="icon">
                               <i class="icon-mail"></i>
                            </span>
                    <span class="description">
                                <span class="align"><?php echo Yii::t('app', 'Отримані запити'); ?></span>
                            </span>
                    <span class="button style-11 size-4"><span><?php echo $this->context->count_orders ?></span>
                </a>
                <a class="sidebar-menu-item <?php echo $active == 'offer' ? 'active' : '' ?>"
                   href="<?php echo Url::to(['cabinet/offer']) ?>">
                            <span class="icon">
                               <i class="icon-article"></i>
                            </span>
                    <span class="description">
                                <span class="align"><?php echo Yii::t('app', 'Мої пропозиції'); ?></span>
                            </span>
                    <?php if ($this->context->send_offers > 0): ?>
                        <span class="button style-11 size-4"><span><?php echo $this->context->send_offers ?></span></span>
                    <?php endif; ?>
                </a>
                <a class="sidebar-menu-item <?php echo $active == 'accepted' ? 'active' : '' ?>"
                   href="<?php echo Url::to(['cabinet/accepted']) ?>">
                            <span class="icon">
                               <i class="icon-users-outline"></i>
                            </span>
                    <span class="description">
                                <span class="align"><?php echo Yii::t('app', 'Контакти клієнтів'); ?></span>
                            </span>
                    <?php if ($this->context->accepted_offers > 0): ?>
                        <span class="button style-11 size-4"><span><?php echo $this->context->accepted_offers ?></span></span>
                    <?php endif; ?>
                </a>
                <a class="sidebar-menu-item <?php echo $active == 'comment' ? 'active' : '' ?>"
                   href="<?php echo \yii\helpers\Url::to(['cabinet/comment']) ?>">
                            <span class="icon">
                               <i class="icon-chat-alt"></i>
                            </span>
                    <span class="description">
                                <span class="align"><?php echo Yii::t('app', 'Відгуки'); ?></span>
                            </span>
                    <?php if ($this->context->count_feedback > 0): ?>
                        <span class="button style-11 size-4"><span><?php echo $this->context->count_feedback ?></span></span>
                    <?php endif; ?>
                </a>




                <div class="clear"></div>
            </div>
        </div>
    </div>

</div>
<div class="float-container-bottom hidden-lg" >
            <div class="footer-main-link">

               <a href="/cabinet/order" class="  link-footer"><i class="icon-login"></i><span> <?= Yii::t('app', 'Запити'); ?></a>
               <a href="/cabinet/offer" class=" link-footer  "><i class="icon-logout"></i><span> <?= Yii::t('app', 'Пропозиції'); ?></span></a>
               <a href="/cabinet/accepted" class="link-footer "><i class="icon-users-outline"></i><span> <?= Yii::t('app', 'Контакти'); ?></span></a>
               <a href="/cabinet/comment" class="link-footer "><i class="icon-chat-alt"></i><span> <?= Yii::t('app', 'Відгуки'); ?></span></a>




        </div>
    </div>
<?php elseif (Yii::$app->user->identity->role !== User::ROLE_SELLER and Yii::$app->user->identity->role !== User::ROLE_USER) : ?>

 <div class="inner-block  fixed-desktop fixed-desktop-left " >

               <div class="container circle">
			     <div class="h3-produkt"><?= Yii::t('app', 'Для продавців'); ?></div>

				   <div class="text-how-it-works " >
				   <?= Yii::t('app', 'Приєднайся до 13000 продавців з України, та пропонуй свої ціни '); ?>
				  
				   </div>
				    <div class="empty-space col-xs-b5 col-sm-b5"></div>
				   <a class="link-how-it-works-2  open-static-popup " data-rel="account-login" >
                        <?= Yii::t('app', '+ Стати продавцем в Україні'); ?>
                      </a>
					   <div class="text-how-it-works " >
				  
				   </div>
			    </div>

  </div>
<?php endif;?>


        <div class="sidebar-content">
		<div class="float-container-min ">
			<div class="container-min">
				<div class="h3-float-container">
					<?= Yii::t('app', 'Новий запит'); ?>	
				</div>
			</div>
		</div>
		 <div class="float-container">
           <div class="container">










			 <?php if (Yii::$app->user->identity->role == User::ROLE_SELLER or Yii::$app->user->identity->role == User::ROLE_USER) : ?>
                <div class="empty-space col-xs-b60 col-sm-b60"></div>



				<div class="blabla-comment">
				 <div class="user-photo-left icon-logo">
					<img src="/img/icon-logo.png" alt="">
				 </div>
				 <?= Yii::t('app', 'Вкажи що тобі потрібно і твій запит отримають продавці з потрібної категорії. В Україні їх 13000 '); ?>
		     	</div>
			
			<div class="empty-space col-xs-b25 col-sm-b25"></div>
			<div class="blabla-comment">
				
				 <?= Yii::t('app', ' Якщо тобі підійдуть умови отриманої пропозиції та ціна - обміняєшся контактами. Рішення купляти чи не купляти приймеш після консультації обаного продавця.'); ?>
		     	</div>
			
			<div class="empty-space col-xs-b25 col-sm-b25"></div>
	
			
			





			<div class="empty-space col-xs-b15 col-sm-b15"></div>
			
			 <?php elseif (Yii::$app->user->identity->role !== User::ROLE_SELLER or Yii::$app->user->identity->role !== User::ROLE_USER) : ?>
                <div class="empty-space col-xs-b60 col-sm-b60"></div>
				<div class="blabla-comment">
				<div class="user-photo-left icon-logo">
					
				</div>
				<?= Yii::t('app', 'BlaBlaPrice - сервіс пошуку найкращої ціни на товари та послуги '); ?>
			</div>
			<div class="empty-space col-xs-b5 col-sm-b5"></div>
			<div class="blabla-comment">
				<div class="user-photo-left icon-logo">
					
				</div>
				<?= Yii::t('app', 'Оберіть країну:'); ?>
				  <a href="#" id="lang" class="blabla_country open-static-popup" data-rel="language"><?php echo (isset($_SESSION['language'])) ? Yii::$app->params['lang'][$_SESSION['language']] : Yii::t('app', 'Мови'); ?></a>
    
			</div>
			<div class="empty-space col-xs-b5 col-sm-b5"></div>
				<div class="blabla-comment">
				<div class="user-photo-left icon-logo">
				<img src="/img/icon-logo.png" alt="">
				</div>
				<div class="empty-space col-xs-b15 col-sm-b15"></div>
				<?= Yii::t('app', 'ЯК ЦЕ ПРАЦЮЄ ?'); ?>
				<ul type="disc" style="list-style: disc; margin-left: 20px">
					<li style="margin-top: 10px"><?= Yii::t('app', 'Створи запит, вказавши вказавши бажану ціну та інші характеристики товару чи послуги'); ?></li>
					<li style="margin-top: 10px"><?= Yii::t('app', 'Отримай пропозиції від зацікавлених продавців'); ?></li>
					<li style="margin-top: 10px"><?= Yii::t('app', 'Обміняйся контактами з продавцем, та уточни деталі'); ?></li>
				</ul>
				<div class="empty-space col-xs-b15 col-sm-b15"></div>
			</div>
			<div class="empty-space col-xs-b25 col-sm-b25"></div>
	
			
			





			
			<?php endif;?>


		
              <div class="inner-block-2 ">
                <div class="container">
                    <?php
                    echo Html::beginForm('', 'post', ['class' => 'filter-form validate-form', name => 'filter']);
                    echo Html::hiddenInput('category', $category->ID);
                    ?>

                    <input type="hidden" name="primary_category_id" value="<?php echo $category->primary_category_id; ?>">
                    <input type="hidden" name="parent_id" value="<?php echo $category->parentID; ?>">




                    <div class="empty-space col-xs-b10 col-sm-b10"></div>
                            <h1><?= Yii::t('app', 'Заявка на '); ?>
                                <?php echo $category->name ?>
                            </h1>



                       <div class="empty-space col-xs-b40 col-sm-b40"></div>
                        <div class="row m12">
                           <div class="col-md-12">


                                        <div class="price-input">
                                            <div class="cust-tooltip ">

                                                <?= Html::input('number', 'priceFrom',
                                                    $session ? $session['priceFrom'] : $price,
                                                    ['class' => 'simple-input size-5 must-be must-be-blue',
													'id'=>'alert',
													'placeholder' => Yii::t('app', 'Введи ціну'),

                                                    'required' => true]) ?>


                                                <div class="tooltip-content left-price-2">
                                                     <?= Yii::t('app', 'Вкажи максимальну ціну яку ти готовий заплатити. Якщо ціна буде заниженою ніхто не зацікавиться'); ?>
													 </br>
													 <?= Yii::t('app', 'P. S. Продавці конкуруючи між собою будуть постійно понижувати ціну. '); ?>
                                                </div>
												<div class="up-label">
                                                     <?= Yii::t('app', 'Макс. ціна '); ?>
                                                </div>
                                            </div>
											 <span class="price-val"><?= Yii::t('app', 'грн'); ?></span>
                                        </div>



                            </div>
                        </div>
						 <div class="empty-space col-xs-b40 col-sm-b40"></div>
                        <div class="row m12">
                            <div class="col-sm-12">
                                <div class="cust-tooltip">
                                    <?php
                                    echo Html::textarea('comment', $session ? $session['comment'] : null,
                                        ['class' => 'simple-input', 'placeholder' => Yii::t('app', 'Коментар')]);
                                    ?>

                                    <div class="tooltip-content left-price">
                                        <?= Yii::t('app', 'Продавці повинні зрозуміти що тобі потрібно'); ?>
                                    </div>
									 <div class="up-label">
                                                     <?= Yii::t('app', 'Опиши деталі'); ?>
                                     </div>
                                </div>
                            </div>
                        </div>

                       
                        <div class="row m12">
						 <div class="col-sm-12">
                         <?php if (!empty($filter)) : ?>
						 
						 	 <div class="row m12">

                            <div class="col-md-6">
                            <div class="empty-space col-xs-b40 col-sm-b40"></div>

                                        <div class="datepicker-wrapper full-width">
                                            <div class="cust-tooltip ">
                                                <?= Html::input('text', 'deadLine', $session ? $session['deadLine'] : null,
                                                    [
                                                        'class' => 'simple-input size-6 datepicker',
                                                        'id' => 'datepicker',
                                                        'placeholder' => Yii::t('app', 'Обери дату'),
                                                        'data-rel' => '1',
                                                        'required' => true
                                                    ]); ?>


                                                    <div class="tooltip-content left-data">
                                                       <?= Yii::t('app', 'Доки ти готовий чекати на пропозиції'); ?>
                                                    </div>
													 <div class="up-label">

                                                     <?= Yii::t('app', 'Готовий чекати'); ?>
													 <div class="time-entry" data-rel="1">
                                            <div class="entry"><span class="days"></span><?= Yii::t('app', ' днів'); ?>
                                            </div>
                                            

                                        </div>
                                                     </div>
                                                </div>

                                        </div>



                            </div>


                            <div class="col-md-6">
							<div class="empty-space col-xs-b40 col-sm-b40"></div>


                                        <div class="select-wrapper size-5">

                                            <div class="cust-tooltip ">
                                               <select name="regionID" class="SlectBox SumoUnder">
                                                   <?php foreach ($regionList as $key => $region) : ?>
                                                       <option value="<?php echo $key; ?>" <?php if ($key == $lastRegion->regionID) echo "selected"; ?>><?php echo $region; ?></option>
                                                   <?php endforeach; ?>
                                               </select>

                                                <div class="tooltip-content left-region">
                                                 <?= Yii::t('app', 'Твій запит отримають продавці з обраного регіону '); ?>

                                                </div>
											  <div class="up-label">
                                                     <?= Yii::t('app', 'Регіон продавців'); ?>
                                              </div>
                                            </div>

                                        </div>



                            </div>

                        </div>
						 
						 
						 
						 
						 
						 		<div class="empty-space col-xs-b20 col-sm-b20"></div>
                            <div class="accordeon-entry">
                                <div class="accordeon-title no-down no-padding">
								 <span>
								    <div class="cust-tooltip " style="cursor:pointer;">
                                               <span class="filter-down"><?= Yii::t('app', 'Вибрати характеристики'); ?> </span>   <i class="icon-angle-down "></i>
                                                <div class="tooltip-content left-data">
                                                    <?= Yii::t('app', 'Можете вказати необхідні характеристики'); ?>
                                                </div>
                                    </div>
								 </span>




                                </div>
                                <div class="accordeon-toggle">
                                    <div class="accordeon style-1">
									
								
						<div class="empty-space col-xs-b40 col-sm-b40"></div>			
									
									
									
									
									
									
									
                                        <?php
                                        foreach ($filter as $filter_item) :
                                            $filter_opt = explode(';', $filter_item->item);
                                            $filter_range = explode('-', $filter_item->item);

                                            ?>
                                            <div class="accordeon-entry">
                                                <div class="accordeon-title">
                                                    <?php if(strlen($filter_item->unt)==0):
                                                            echo $filter_item->name;
                                                          else:
                                                            echo $filter_item->name.', '.$filter_item->unt;
                                                          endif;
                                                     ?>
                                                </div>
                                                <div class="accordeon-toggle">
                                                    <div class="checkboxes-margin">
                                                       
                                                               
                                                               
                                                              
                                                                

                                                              
                                                              
                                                        <div class="row">
                                                            
                                                                <div class="col-sm-6 col-xs-b20">
                                                                    <label class="checkbox-entry">
                                                                        <input type="checkbox" value="1"
                                                                               name="filter[<?php echo $filter_item->name; ?>][other]"><span><input
                                                                                    type="text"
                                                                                    name="filter[<?php echo $filter_item->name; ?>][other_input]"
                                                                                    class="simple-input size-3" value=""
                                                                                    placeholder="<?php echo Yii::t('app',
                                                                                        'Вкажи'); ?>"></span>
                                                                    </label>
                                                                </div>
                                                           
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        endforeach;
                                        ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
							</div>
						</div>


                    <div id="login-area" class="text-right">

                        <div class="inline-align-middle">
						<div class="empty-space col-xs-b20 col-lg-b20"></div>
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


                        echo Html::a('<span>' . Yii::t('app', 'Надіслати ') . Yii::t('app', ' продавцям') . '</span>', null, [
                            'class' => 'button style-1 size-1 shadow ' . $linkClass,
                            'data-rel' => $linkDataRel
                        ]);
                        ?>
                    </div>
                    </div>
                    <div class="empty-space col-xs-b20 col-lg-b20"></div>
                    <?php
                    echo Html::endForm();
                    ?>
                </div>
	</div>

  <div class="empty-space col-xs-b50 col-sm-b50"></div>










		 <div class="inner-block fixed-desktop fixed-desktop-right " >
					<div class="user-photo-left icon-logo">
						<img src="/img/icon-logo.png" alt="">
					</div>
                   <div class="container">
                        <div class="title-how-it-works"><?= Yii::t('app', 'Популярні питання'); ?></div>
						<div class="cust-tooltip ">
						   <div  class="link-how-it-works "  <span>  <?= Yii::t('app', 'Це безкоштовно ?'); ?></span></div>
						   <div class="tooltip-content-2 how-it-works-tooltip">
                              <?= Yii::t('app', 'Так. Ти можеш безкоштовно надсилати запити і обмінюватись контактами з обраними продавцями. '); ?>
                           </div>
						</div >
						<div class="cust-tooltip ">
						   <div  class="link-how-it-works "  <span>  <?= Yii::t('app', 'Хто бачить мої контакти?'); ?></span></div>
						   <div class="tooltip-content-2 how-it-works-tooltip">
                             <?= Yii::t('app','Ти сам обираєш з ким обмінятись контактами. '); ?>
                           </div>
						</div >
						<div class="cust-tooltip ">
						   <div  class="link-how-it-works "  <span><?= Yii::t('app', 'Чи обовязково обирати продавця? '); ?></span></div>
						   <div class="tooltip-content-2 how-it-works-tooltip">
                              <?= Yii::t('app','Не обовязково. Якщо тобі не підійшли умови ти можеш проігноравати пропозиції , або обмінятись контактами і ще поторгуватись з обраним продавцем.'); ?>
                           </div>
						</div >
						 <div class="empty-space col-xs-b20 col-lg-b20"></div>
						 <div class="title-how-it-works"><?= Yii::t('app', 'Пошир BlaBlaPrice'); ?></div>
					<div class="cust-tooltip ">
					     <div class="social-entry">

                        <a href="#">
                            <img src="/img/icon-4.png" alt="">                        </a>
                        <a href="#">
                            <img src="/img/icon-5.png" alt="">                        </a>
                        <a href="#">
                            <img src="/img/icon-6.png" alt="">                        </a>
                        <a href="#">
                            <img src="/img/icon-7.png" alt="">                        </a>
                       </div>
					   <div class="tooltip-content-2 how-it-works-tooltip">
                              <?= Yii::t('app','Пошир BlaBlaPrice щоб отримувати більше запитів '); ?>
                           </div>
					</div >
					 <div class="empty-space col-xs-b20 col-lg-b20"></div>
					 <a class="link-right-block" href="/site/howitworks"><?= Yii::t('app', 'Як це працює? '); ?></a>  ·
					 <a class="link-right-block" href="/site/contact"><?= Yii::t('app', 'Контакти '); ?></a>
                     <div  class="blabla-right-block "  <span> BlaBlaPrice © 2018 </span></div>


     </div>
	</div>
	 <div class="empty-space col-xs-b50 col-sm-b50"></div>
		</div>
		</div>
		</div>





    </div>

    <?= $this->render('footer') ?>

<div class="popup-wrapper">
    <div class="close-layer"></div>



    <div class="popup-content" data-rel="11">
        <div class="popup-container text">
            <a class="button style-3 size-3 shadow close-popup" href="#">
                <span>
                    <?= Html::img('/img/icon-1.png') ?>
                </span>
            </a>
            <div class="popup-paddings">
                <img class="text-popup-image hidden-xs" src="/img/icon-65.png" alt=""/>
                <div class="row">
                    <div class="col-sm-7 col-sm-offset-5">
                        <div class="empty-space col-xs-b40 col-sm-b80"></div>
                        <div class="h3"><b><?= Yii::t('app', 'Вашу заявку прийнято!'); ?></b></div>
                        <div class="empty-space col-xs-b20"></div>
                        <div class="simple-article large">
                            <?= Yii::t('app', 'Ваше оголошення додано у нашу базу і надіслано усім
                            продавцям. Найближчим часом Ви отримаєте пропозиції на пошту та в кабінеті'); ?>
                        </div>
                        <div class="empty-space col-xs-b20"></div>
                        <div class="button style-1 size-1 shadow">
                            <span>
                                <?= Yii::t('app', 'ПРОДОВЖИТИ ПОШУК'); ?>
                            </span>
                            <input type="submit"/>
                        </div>
                        <div class="empty-space col-xs-b40 col-sm-b80"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php if (Yii::$app->user->isGuest) : ?>

        <?= $this->render('@app/themes/blablaprice/popup/popup-account-login') ?>

        <?= $this->render('@app/themes/blablaprice/popup/popup-account-registration') ?>

        <?= $this->render('@app/themes/blablaprice/popup/popup-account-reset-password') ?>

    <?php else : ?>

        <?= $this->render('@app/themes/blablaprice/popup/popup-phone-verification') ?>

    <?php endif; ?>

    <?= $this->render('@app/themes/blablaprice/popup/language'); ?>
</div>
