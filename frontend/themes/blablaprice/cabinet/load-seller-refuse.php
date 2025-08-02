<?php foreach ($refuses as $refuse_item) : ?>
    <div class="grey-line"></div>
    <div class="popup-paddings-wide">
                                            <div class="empty-space col-xs-b20 col-sm-b40"></div>
                                           
											
											
                                            <div class="empty-space col-xs-b20 col-sm-b40"></div>
                                            <div class="row m45 column-line">
                                                <div class="col-sm-6 col-xs-b20 col-sm-b0">

                                                    <div class="no-visited ">
                                                <a class="open-popup" data-param="<?php echo $refuse_item->offerID; ?>"
                                                   data-rel="seller-accepted">
                                                    <b><?php echo $refuse_item->product ? $refuse_item->product : $refuse_item->category ?></b>
                                                </a>
                                            </div>
											<div class="empty-space col-xs-b10 col-sm-b10"></div>
											<span class="table-grey"><b><?php echo $refuse_item->offerPrice ?><?php echo Yii::t('app',
                                                                        'грн '); ?></b>
                                                            
                                                        </span>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="neutral text-right">
                                                        <div class="cloud">
                                                        <div class="cust-tooltip ">
														 <span class="title"><?php echo Yii::t('app',
                                                                'Відмовився'); ?> <i class="icon-help-circled-alt "></i> </span>
														
					   
			                                              <div class="tooltip-content left-best-price ">
					                                     <?php echo $refuse_item->answerUsername; ?><?php echo Yii::t('app',' відмовився від вашої пропозиції і вказав причину відмови'); ?>  
                                                          </div> 
					                                    </div>

                                                            <span class="description"><?php echo $refuse_item->answerRefuse <> 0 ? Yii::$app->params['refuse'][$refuse_item->answerRefuse] : $refuse_item->answerComment ?></span>
                                                        </div>
                                                        <div class="empty-space col-xs-b15"></div>
                                                        <div class="simple-article small lightgrey"><span
                                                                    class="testimonial-title"><b><?php echo $refuse_item->answerUsername; ?></b></span> <?php echo $refuse_item->answerUpdated; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="empty-space col-xs-b20 col-sm-b40"></div>
                                        </div>
    <div class="grey-line"></div>
<?php endforeach; ?>