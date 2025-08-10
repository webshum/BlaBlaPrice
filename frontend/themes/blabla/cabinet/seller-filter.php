<?php

use yii\helpers\Html;
use yii\helpers\Url;
use frontend\models\UserFilter;
use common\models\Category;

// generate regions
$regionList = [];
$regionList = array_merge($regionList, Yii::$app->params['region'][Yii::$app->language]);

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

<div class="center seller-filter pb100">
	<?= Html::beginForm('/site/fill', 'post', ['class' => 'category-form']) ?>
		<div class="request request-main">
			<div class="request-head">
			    <header id="header">
					<div class="filter-controls">
			            <div>
				            <a class="popup-button gray" href="<?= Url::to(['site/filter-delete']) ?>">
							   	<svg width="14" height="18"><use xlink:href="#delete"></use></svg>
				               	<span><?= Yii::t('app', 'Очистити'); ?></span>
				            </a>

				            <button type="submit" class="popup-button blue">
							   	<svg width="18" height="18"><use xlink:href="#save"></use></svg>
				                <span>
				                	<?= Yii::t('app', 'Зберегти'); ?>
			                	</span>
				            </button>  
			          	</div>
				  	</div>
		        </header>
			</div>
		</div>

		<ul class="accordeon">
		    <!-- FILTER REGION -->
		    <li class="item-accordeon">
		    	<div class="btn-accordeon">
		    		<span><?= Yii::t('app', 'Регіон клієнтів'); ?></span>
		    		<svg width="11" height="7"><use xlink:href="#arrow"></use></svg>
		    	</div>

		    	<div class="content-accordeon">
		            <div class="inner-accordeon"> 
						<?php $i = 0; foreach ($regionList as $key => $region) : ?>
							<?php 
								$checked = false;

								if (!empty($filters->region)) {
									$checked = in_array($key, $filters->region) ? 'checked' : ''; 
								}
							?>
		                    <label class="input-radio">
		                        <input 
		                        	type="checkbox" 
		                        	class="category-submit" 
		                        	value="<?= $key; ?>"
		                            name="region[]"
		                            <?= ($checked) ? 'checked' : ''; ?>>

		                        <div class="radio"></div>
		                        <span><?= $region; ?></span>
		                    </label>
			            <?php $i++; endforeach; ?>
		            </div>
		        </div>
		    </li>
		    <!-- // FILTER REGION -->

		    <!-- FILTER CATEGORY -->
			<?php $i = 0; foreach ($this->context->category as $categoryItem) : ?>
                <?php if ($categoryItem->getParentId() == 0) : ?>
                    <li class="item-accordeon">
                    	<div class="btn-accordeon">
							<?php $checked = in_array($categoryItem->getId(), $userCategoriesIds) ?>
                            <span data-parentID="<?= $categoryItem->getId(); ?>">
                            	<?= $categoryItem->getName() ?>
                            </span>	
                            <svg width="11" height="7"><use xlink:href="#arrow"></use></svg>
				    	</div>

				    	<div class="content-accordeon">
		            		<div class="inner-accordeon">
		            			<?php 
		            				$checked = false;

		            				if (!empty($filters->primary_categoryID)) {
		            					$checked = in_array($categoryItem->getId(), $filters->primary_categoryID);
		            				}
		            			?>

		            			<label class="input-radio">
		            				<input 
		            					name="primary_categoryID[]"
		            					type="checkbox" 
		            					value="<?php echo $categoryItem->getId(); ?>"
		            					<?= ($checked) ? 'checked' : ''; ?>>
		            				<div class="radio"></div>
		            				<span>Все</span>
		            			</label>

		            			<?php 
		            				$subCategory = Category::find()->where(['parentID' => $categoryItem->getId()])->all();
		            			?>

		            			<?php foreach ($subCategory as $categorySubItem): ?>
		            				<?php 
		            					$name = (!empty($categorySubItem->subCategory)) ? 'parent_category[]' : 'category[]'; 

		            					if (!empty($categorySubItem->subCategory)) {
		            						$checked = false;
		            						$name = 'parent_category[]';
		            						if (!empty($filters->parent_category)) {
		            							$checked = in_array($categorySubItem->ID, $filters->parent_category);
		            						}
		            					} else {
		            						$name = 'category[]';
		            						$checked = false;
		            						if (!empty($filters->category)) {
		            							$checked = in_array($categorySubItem->ID, $filters->category);
		            						}
		            					}
		            				?>

		            				<label class="input-radio">
										<input 
											name="<?php echo $name ?>" 
											type="checkbox"
											class="category-submit" 
											value="<?= $categorySubItem->getId() ?>" 
											<?= ($checked) ? 'checked' : ''; ?>>

										<div class="radio"></div>
										<span><?= $categorySubItem->getName() ?></span>
                                    </label>
		            			<?php endforeach; ?>
		            		</div>
		            	</div>
                    </li>    
                <?php endif; ?>
            <?php endforeach; ?>
		    <!-- // FILTER CATEGORY -->
		</ul>	
	<?= Html::endForm() ?>
</div>

<div class="popup-wrapper">
	<div class="close-layer"></div>

  	<?= $this->render('@appTheme/popup/language'); ?>
</div>