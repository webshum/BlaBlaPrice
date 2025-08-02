<?php

use yii\helpers\Html;
use yii\helpers\Url;
use frontend\models\UserFilter;

// generate regions
$regionList = [];
$regionList = array_merge($regionList, Yii::$app->params['region'][$_SESSION['language']]);

$filters = json_decode($filters);

$userFilters = UserFilter::find()->where(['userID' => Yii::$app->user->id])->one();

/**
 * @var \yii\web\View $this
 * @var \common\models\Category[] $category
 * @var \common\models\Category $categoryItem
 * @var \common\models\Category $categorySubItem
 * @var \common\models\User $user
 */
?>

<div id="content-block">

    <?= $this->render('seller-sidebar', ['active' => 'filter']) ?>

    <div class="sidebar-content">
	   <?= Html::beginForm('/site/fill', 'post', ['class' => 'category-form']) ?>
        <div class="float-container " style="background: #f4f5f4;">
            <div class="container">
                 <div class="empty-space col-xs-b60 col-sm-b60"></div>

                   
                        
                <div class="row ">
                    
                   
                  
					
					
	<!-- FILTER PRICE -->				
					
					 <div class="row"> 
							 <div class="col-sm-12 ">
                             <div class="accordeon-entry">
                                
                              
                                    <div class="accordeon style-1">
                                        <div class="accordeon-entry ">
											
                                                <div class="accordeon-title checked-filter"><span><?= Yii::t('app', 'Цінова категорія запитів:'); ?></span></div>
												
												
												  
												  
                                                <div class="accordeon-toggle " >

                                                    <div class="filter-price">
														<div class="row ">
															<div class="col-sm-6 ">
															 <div class="empty-space col-xs-b30 col-sm-b30"></div>
																<div class="cust-tooltip ">
																	<input type="number" class="simple-input size-5" name="min_price" value="<?php echo (!empty($filters->min_price)) ? $filters->min_price : '0'; ?>">
																	<div class="tooltip-content left-password" ">
																		<?= Yii::t('app', 'Мінімальна ціна'); ?>
																	</div>
																	<div class="up-label"><?= Yii::t('app', 'Від'); ?> </div>
																</div>
															</div>
													 
															<div class="col-sm-6 ">
															<div class="empty-space col-xs-b30 col-sm-b30"></div>
																<div class="cust-tooltip ">
																	<input type="number" class="simple-input size-5" name="max_price" value="<?php echo (!empty($filters->max_price)) ? $filters->max_price : '999999'; ?>">
																	<div class="tooltip-content left-password" ">
																		<?= Yii::t('app', 'Мінімальна ціна'); ?>
																	</div>
																	<div class="up-label"><?= Yii::t('app', 'До'); ?> </div>
																</div>
															</div>
														</div>
													</div>
                                                    
                                                 </div>
                                        </div>
                                                                                        
                                    </div>
                                
                             </div>    
						    </div> 
                           </div> 
					
<!-- END FILTER PRICE -->				
  <div class="empty-space col-xs-b10 col-lg-b10"></div>
   <!-- FILTER REGION -->
                     
					 <div class="row"> 
							 <div class="col-sm-12 ">
                             <div class="accordeon-entry">
                                
                             
                                    <div class="accordeon style-1">
                                        <div class="accordeon-entry">
											
                                                <div class="accordeon-title "><span><?= Yii::t('app', 'Регіон клієнтів'); ?></span></div>
												
												
												  
												  
                                                <div class="accordeon-toggle " style="display: none;">
											
                                                  
                                                        <div class="row filter-entry">  
														   <?php $i = 0; foreach ($regionList as $key => $region) : ?>
                              
	 <div class="col-sm-6 ">
                                
								
						
                                    <label class="checkbox-entry">
                                        <input type="checkbox" class="category-submit" value="<?= $key; ?>"
                                               name="region[]" <?php echo (in_array($key, $filters->region)) ? 'checked' : ''; ?>><span><?= $region; ?></span>
                                    </label>
                              
								 </div>
								

                               

                            <?php $i++; endforeach; ?>
							  </div>
									                    
                                                  
                                                 </div>
                                        </div>
                                                                                        
                                    </div>
                              
                             </div>    
						    </div> 
                           </div> 
				
<!-- END FILTER REGION -->



<!-- FILTER CATEGORY -->
                    <div class="filter-category-wrap">
						
					
					
					
					
					
					
					<?php foreach ($this->context->category as $categoryItem) : ?>
                            <?php $i = 0; ?>
                            <?php if ($categoryItem->getParentId() == 0) : ?>
                                
                                   
                                    <div class="empty-space col-xs-b10"></div>
                                   

                                        
                            <div class="row"> 
							 <div class="col-sm-12 ">
                             <div class="accordeon-entry accordeon-entry-elem">
                                
                              
                                    <div class="accordeon style-1">
                                        <div class="accordeon-entry">
											 <?php $checked = in_array($categoryItem->getId(), $userCategoriesIds) ?>
                                                <div class="accordeon-title" data-parentID="<?php echo $categoryItem->getId(); ?>">
                                                  <span><?= $categoryItem->getName() ?></span>
                                                </div>											
												
												  
												  
                                                <div class="accordeon-toggle " style="display: none;">
											
                                                    <div class=" row filter-entry">
                                                       
														 <?php foreach ($categoryItem->subCategory as $categorySubItem) : ?>

                                                             <?php $subCategoryCount = count($categoryItem->subCategory) ?>
														   <div class="col-sm-6">

                                <?php if ($categorySubItem->subCategory) : ?>
<label class="checkbox-entry">
                                                                         <?php $checked = in_array($categorySubItem->ID, $userCategoriesIds) ?>
   <input name="parent_category[]" type="checkbox" <?= $checked ? 'checked="checked"' : '' ?> class="category-submit" value="<?= $categorySubItem->getId() ?>" <?php echo (in_array($categorySubItem->ID, $filters->parent_category)) ? 'checked' : ''; ?>><span><?= $categorySubItem->getName() ?></span>
                                            
                                                                    </label>
                                <?php else : ?>
<label class="checkbox-entry">
                                                                         <?php $checked = in_array($categorySubItem->ID, $userCategoriesIds) ?>
   <input name="category[]" type="checkbox" <?= $checked ? 'checked="checked"' : '' ?> class="category-submit" value="<?= $categorySubItem->getId() ?>" <?php echo (in_array($categorySubItem->ID, $filters->category)) ? 'checked' : ''; ?>><span><?= $categorySubItem->getName() ?></span>
                                            
                                                                    </label>
                                <?php endif; ?>
														   	
                                                                    
																	
                                                            </div>
                                                            <?php $i++; ?>

                                                          <?php endforeach; ?>
									                   
                                                    </div>
                                                 </div>
                                        </div>
                                                                                        
                                    </div>
                            
                             </div>    
						    </div> 
                           </div>    
                            <?php endif; ?>
                        <?php endforeach; ?>
					
					 
                    </div>
                    <!-- END FILTER CATEGORY -->

                    <div class="popup-wrapper">
                        <div class="close-layer"></div>

                        <div class="popup-content" data-rel="seller-filter"></div>
                    </div>

                  
                </div>
                <div class="empty-space col-xs-b20 col-lg-b20"></div>
				
            </div>
			
        </div>
		<div class="float-container-min-filter  filter-info-fixed">
            <div class="container-min">

                
                    <div class="filter-button-count active ">
                        <?php $count = (isset($userFilters->count)) ? $userFilters->count : 1; ?>
                        <input type="hidden" class="count-filter" name="count_filter" value="<?php echo $count; ?>">
						
                        <?= Yii::t('app', "<b><span>{$count}</span></b> фільтрів ") ?>
						
                    </div>
					
					
					
				 <div class="buttons-block">
                <a class="button-clear" 
				
                           href="<?= Url::to(['site/filter-delete']) ?>">
						   <i class="icon-trash-1"></i>
                           <?= Yii::t('app', 'Очистити '); ?>
                        </a>
                  
                        <button type="submit" class="button-save" "
                           href="<?= Url::to(['cabinet/order']) ?>">
						   <i class="icon-sliders"></i>
                            <?= Yii::t('app', 'Зберегти '); ?>
                        </button>
					</div>	
				
                  </div>
        </div>
		
	
		  <?= Html::endForm() ?>
        <div class="clear"></div>
    </div>
</div>

<div class="popup-wrapper">
  <div class="close-layer"></div>

  <?= $this->render('@app/themes/blablaprice/popup/language'); ?>
</div>

<?= $this->render('/site/footer') ?>