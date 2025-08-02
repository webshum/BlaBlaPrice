<?php

use yii\helpers\Html;
use common\models\Comment;

if ($user->role == \common\models\User::ROLE_USER) :
    foreach ($models as $comment) :
        ?>
        <div class="popup-paddings-wide">
            <div class="empty-space col-xs-b20 col-sm-b40"></div>
            <div class="simple-article dark large ">
                <a class="open-popup no-visited" data-param="<?php echo $comment->offerID; ?>" data-rel="user-comment">
                    <?php echo $comment->product ? $comment->product : $comment->category ?>
                </a>
            </div>
            <div class="empty-space col-xs-b20 col-sm-b40"></div>


            <div class="row m45 column-line">
                <div class="col-sm-6 col-xs-b20 col-sm-b0">
                    <?php
                    if ($comment->answerID) :
                        $rating = Comment::Rating($comment->answerRating)
                        ?>
                        <div class="<?php echo $rating['class']; ?>">
                               <div class="cloud">
							
                                <span class="title"><?php echo $rating['name'] . ' ' . Yii::t('app',
                                            ' покупець'); ?></span>
								
                                <span class="description"><?php echo mb_substr(strip_tags($comment->answerComment),0,300) ?></span>
								<span class="icon left"></span>
                            </div>
                            <div class="empty-space col-xs-b15"></div>
                            <div class="simple-article small lightgrey"><span
                                        class="testimonial-title"><b><?php echo $comment->answerUsername; ?></b></span> <?php echo $comment->answerUpdated ?>
                            </div>
                        </div>
                        <?php
                    endif;
                    ?>
                </div>

                <div class="col-sm-6">
                    <?php
                    if ($comment->ID) :
                        $rating = Comment::Rating($comment->commentRating);
                        ?>
                        <div class="cloud-save-wrapper"
                             style="display: none <?php //echo $comment['ID'] ? 'none' : 'block'
                             ?>">
                            <?php
                            echo Html::beginForm(['cabinet/comment']);
                            echo Html::hiddenInput('Comment[userFromID]', $user->ID);
                            echo Html::hiddenInput('Comment[userToID]', $comment->answerUserFromID);
                            echo Html::hiddenInput('Comment[offerID]', $comment->offerID);
                            echo Html::hiddenInput('Comment[ID]', $comment->ID);
                            echo Html::hiddenInput('Comment[rating]', Comment::RATING_GOOD);
                            ?>
                            <div class="testimonial-edit tabs-block">
                                <div class="smile-entry smile-button tab-menu active inline-align-middle align-1">
                                    <span value="<?php echo Comment::RATING_GOOD ?>" class="positive icon"></span>
                                </div>
                                <div class="smile-entry smile-button tab-menu inline-align-middle align-1">
                                    <span value="<?php echo Comment::RATING_NEUTRAL ?>" class="neutral icon"></span>
                                </div>
                                <div class="smile-entry smile-button tab-menu inline-align-middle">
                                    <span value="<?php echo Comment::RATING_BAD ?>" class="negative icon"></span>
                                </div>
                                <div class="inline-align-middle align-1">
                                    <a class="button style-1 size-2 shadow cloud-save submit-form"><span><?php echo Yii::t('app',
                                                'Залишити'); ?></span></a>
                                </div>
                                <div class="testimonial-edit-title tab-entry positive"
                                     style="display: <?php echo $comment['ID'] ? 'none' : 'block' ?>;"><?php echo Yii::t('app',
                                        'Надійний продавець'); ?></div>
                                <div class="testimonial-edit-title tab-entry neutral"><?php echo Yii::t('app',
                                        'Нейтральний продавець'); ?></div>
                                <div class="testimonial-edit-title tab-entry negative"><?php echo Yii::t('app',
                                        'Ненадійний продавець'); ?></div>
                                <?php
                                echo Html::textarea('Comment[comment]', strip_tags($comment->comment), [
                                    'class' => 'simple-input',
                                    'placeholder' => Yii::t('app', 'Залиште відгук (необов\'язково)')
                                ]);
                                ?>
                            </div>
                            <?php
                            echo Html::endForm();
                            ?>
                        </div>

                        <div class="cloud-edit-wrapper">
                            <div class="<?php echo $rating['class']; ?> text-right">
                                <div class="cloud">
							
                                    <span class="title"><?php echo $rating['name'] . ' ' . Yii::t('app',
                                                ' продавець'); ?></span>
                                    <span class="description"><?php echo mb_substr(strip_tags($comment->commentt),0,300) ?></span>
									<span class="icon right"></span>
                                </div>
                                <div class="cloud-edit"><?php echo Yii::t('app', 'редагувати'); ?></div>
                            </div>
                        </div>

                        <div class="empty-space col-xs-b15"></div>
                      
                        <?php
                    endif;
                    ?>
                </div>
            </div>
            <div class="empty-space col-xs-b20 col-sm-b40"></div>
        </div>
        <div class="grey-line"></div>
        <?php
    endforeach;

elseif ($user->role == \common\models\User::ROLE_SELLER) :
    foreach ($models as $comment) :
        ?>
        <div class="popup-paddings-wide">
            <div class="empty-space col-xs-b20 col-sm-b40"></div>
            <div class="simple-article dark large ">
                <a class="open-popup no-visited" data-param="<?php echo $comment->offerID; ?>" data-rel="seller-accepted">
                    <?php echo $comment->product ? $comment->product : $comment->category ?>
                </a>
            </div>
            <div class="empty-space col-xs-b20 col-sm-b40"></div>
            <div class="row m45 column-line">
                <div class="col-sm-6 col-xs-b20 col-sm-b0">

                    <div class="cloud-save-wrapper" style="display: <?php echo $comment->ID ? 'none' : 'block' ?>">
                        <?php
                        echo Html::beginForm(['cabinet/comment']);
                        echo Html::hiddenInput('Comment[userFromID]', $user->ID);
                        echo Html::hiddenInput('Comment[userToID]', $comment->answerUserFromID);
                        echo Html::hiddenInput('Comment[offerID]', $comment->offerID);
                        echo Html::hiddenInput('Comment[ID]', $comment->ID);
                        echo Html::hiddenInput('Comment[rating]', Comment::RATING_GOOD);
                        ?>
                        <div class="testimonial-edit tabs-block">
                            <div class="smile-entry smile-button tab-menu active inline-align-middle align-1">
                                <span value="<?php echo Comment::RATING_GOOD ?>" class="positive icon"></span>
                            </div>
                            <div class="smile-entry smile-button tab-menu inline-align-middle align-1">
                                <span value="<?php echo Comment::RATING_NEUTRAL ?>" class="neutral icon"></span>
                            </div>
                            <div class="smile-entry smile-button tab-menu inline-align-middle">
                                <span value="<?php echo Comment::RATING_BAD ?>" class="negative icon"></span>
                            </div>
                            <div class="inline-align-middle align-1">
                                <a class="button style-1 size-2 shadow cloud-save submit-form"><span><?php echo Yii::t('app',
                                            'Залишити'); ?></span></a>
                            </div>
                            <div class="testimonial-edit-title tab-entry positive"
                                 style="display: block;"><?php echo Yii::t('app', 'Надійний покупець'); ?></div>
                            <div class="testimonial-edit-title tab-entry neutral"><?php echo Yii::t('app',
                                    'Нейтральний покупець'); ?></div>
                            <div class="testimonial-edit-title tab-entry negative"><?php echo Yii::t('app',
                                    'Ненадійний покупець'); ?></div>
                            <?php
                            echo Html::textarea('Comment[comment]', $comment->comment, [
                                'class' => 'simple-input',
                                'placeholder' => Yii::t('app', 'Залиште відгук (необов\'язково)')
                            ]);
                            ?>
                        </div>
                        <?php
                        echo Html::endForm();
                        ?>
                    </div>
                    <?php
                    if ($comment->ID) :
                        $rating = Comment::Rating($comment->commentRating);
                        ?>
                        <div class="cloud-edit-wrapper">
                            <div class="<?php echo $rating['class']; ?>">
                                <div class="cloud">
								
                                    <span class="title"><?php echo $rating['name']; ?><?php echo Yii::t('app',
                                            ' покупець'); ?></span>
                                    <span class="description"><?php echo mb_substr(strip_tags($comment->commentt),0,300) ?></span>
									<span class="icon left"></span>
                                </div>
                                <div class="cloud-edit"><?php echo Yii::t('app', 'редагувати'); ?></div>
                            </div>
                        </div>
                        <div class="empty-space col-xs-b15"></div>
                       
                        <?php
                    endif;
                    ?>
                </div>
                <?php
                if ($comment->answerID) :
                    $rating = Comment::Rating($comment->answerRating)
                    ?>
                    <div class="col-sm-6">
                        <div class="<?php echo $rating['class']; ?> text-right">
                            <div class="cloud">
							
                                <span class="title"><?php echo $rating['name']; ?><?php echo Yii::t('app',
                                        ' продавець'); ?></span>
                                <span class="description"><?php echo mb_substr(strip_tags($comment->answerComment),0,300) ?></span>
								<span class="icon right"></span>
                            </div>
                            <div class="empty-space col-xs-b15"></div>
                            <div class="simple-article small lightgrey">
                                <span class="testimonial-title"><b><?php echo $comment->answerUsername ?></b></span>
                                <?php echo $comment->answerUpdated ?>
                            </div>
                        </div>
                    </div>
                    <?php
                endif;
                ?>
            </div>
            <div class="empty-space col-xs-b20 col-sm-b40"></div>
        </div>
        <div class="grey-line"></div>
        <?php
    endforeach;
endif;