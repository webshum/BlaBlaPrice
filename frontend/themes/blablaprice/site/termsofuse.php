<?php

use yii\helpers\Html;
use common\models\User;
use yii\helpers\Url;
use common\models\Order;
use yii\widgets\ActiveForm;

$this->title = 'Terms of use';
//$this->params['breadcrumbs'][] = $this->title;

$loremIpsum = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc posuere finibus suscipit. Quisque eleifend
et sem nec vehicula. Vivamus fringilla arcu urna, laoreet aliquet.';
?>
    <!--<div class="header-empty-space"></div>-->

    <div id="content-block">
		    
                 <?php if (Yii::$app->user->identity->role == User::ROLE_USER) : ?>             
                 <div class="sidebar visible-lg">
				    <div class="empty-space col-xs-b40 col-sm-b40"></div>
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
<?php elseif (Yii::$app->user->identity->role == User::ROLE_SELLER) : ?>

<div class="sidebar visible-lg">
   <div class="empty-space col-xs-b40 col-sm-b40"></div>
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
<?php elseif (Yii::$app->user->identity->role !== User::ROLE_SELLER and Yii::$app->user->identity->role !== User::ROLE_USER) : ?>

   <div class="inner-block fixed-desktop fixed-desktop-left " >
               <div class="container circle">
			   <div class="h3-produkt"><?= Yii::t('app', 'Хто продає'); ?></div>
			 
				   <div class="text-how-it-works " >
				     <?= Yii::t('app', 'BlaBlaPrice працює у 6 країнах. Вже зареєстровано понад 200 тис продавців з 456 категорій товарів і послуг '); ?>
                    </div>
					<div class="empty-space col-xs-b10 col-sm-b10"></div>
					 <a class="link-how-it-works-2  open-static-popup " data-rel="registration-seller" >
                        <?= Yii::t('app', '+ Стати продавцем в Україні'); ?>
                      </a>    
				   
			   </div>
		     </div>	
<?php endif;?>


     <div class="sidebar-content"> 
	 <div class="float-container-min ">
			<div class="container-min">
				<div class="h3-float-container">
					  <?= Yii::t('app', 'Публічний договір (оферта) від 01.11.2019'); ?>
				</div>
			</div>
		</div>
	  <div class="float-container" style="background-color: #fff;">
	      <div class="empty-space col-xs-b45 col-sm-b45"></div>
      <div class="container">
	  
	  <div class="simple-article">
        <div class="terms__section">
            <ul class="decimal-list decimal-list_type_big">
                <li class="decimal-list__item">
                    <div class="terms__title">Public contract (Offer) from 1.11.2019</div>
                    <ul class="decimal-list decimal-list_type_fractional">
                        <li class="decimal-list__item">
                            
                                The document represents itself an open proposal (further -“Offer”). Limited liability companies“----------”, legal entity in accordance with the legislation of Ukraine, an identification code ----------- (further “Company”) which is addressed to an indefinite number of persons, to conclude an agreement on the provision of services and / or the acquisition of goods (next  “Contract”) on the stated conditions in this offer, including all its applications.
                            
                        </li>
                        <li class="decimal-list__item">
                            
								The company publishes  this public contract (offer) on the website blablaprice.com. The offer is valid  from the moment it is posted on the website: blablaprice.com.                            
                        </li>
                        <li class="decimal-list__item">
                            
                                In accordance with articles 633, 638, 641 of the Civil Code of Ukraine, this agreement is a public contract and in the case of acceptance (acceptance) of the following conditions any capable individual or legal entity (user) undertakes to comply with the terms of this agreement, additions and applications to it.
                            
                        </li>
                        <li class="decimal-list__item">
                            
                                The company reserves the right to make changes in the offer (including the description of services, tariffs, payment procedures) and / or to withdraw the offer at any time at its discretion. In case of changes, those changes shall enter into force since the placement of the updated edition of the offer on the website in accordance with the provisions of paragraph 1.2. of this offer, unless the others is indicated in the offer.
                            
                        </li>
                        <li class="decimal-list__item">
                            
                                In this Offer, unless the context requires the others, the following terms have the following meanings:
                            
                            <ul class="b-dash-marked">
                                <li class="b-dash-marked__item">
                                    <b>The company</b>&nbsp;—&nbsp;
                                    
                                        a limited liability company “------------”, an identification code ----------------, location : -----------------.
                                    
                                </li>
                                <li class="b-dash-marked__item">
                                    <b>Website (Portal)</b>&nbsp;—&nbsp;
                                    
                                        blablaprice.com internet resource - a collection of software and hardware, the result of computer programming in the form of the online service blablaprice.com which is posted on the Internet at https://blablaprice.com/ and is in the possession and use of the company on the basis of a license agreement with the owner of the site. The portal is protected by copyright, trademark law, as well as other intellectual property rights and the legislation of Ukraine of unfair competition.
                                    
                                </li>
                                <li class="b-dash-marked__item">
                                    <b>The site administration</b>&nbsp;—&nbsp;
                                    
                                        a limited liability company “---------------------” and / or other persons (subcontractors) who are authorized by the company to manage the site and  provision of services to users when using the site in accordance with this agreement.

                                    
                                </li>
                                <li class="b-dash-marked__item">
                                    <b>The company services</b>&nbsp;—&nbsp;
                                    
                                        The company services is the totality of services provided by the company in accordance with this agreement for users including on a paid or free basis but not exclusively:  users registration services , creating an account (personal account), access to the service of personal messages, access to the site for posting on the site for customs  goods or services requests, sellers advertisements and offers, as well as the performance of actions of the site which is associated with providing opportunities to customers to make a choice of the seller to provide / perform services, work in a certain category or selling products in a specific category.
                                    
                                </li>
                                
                                <li class="b-dash-marked__item">
                                    <b>The user</b>&nbsp;—&nbsp;
                                    
                                         is any efficient individual entity, individual entity - an entrepreneur or legal entity that has accepted the terms of this agreement and company services use.
										 The user can register on the site as a customer and / or a seller.
                                    
                                </li>
                                <li class="b-dash-marked__item">
                                    <b>The registration</b>&nbsp;—&nbsp;
                                    
                                         is the procedure for the user to fill out the registration form on the site, after the approval of which by the company, such person is assigned the appropriate login and password to access the company and personal page (seller’s public profile) of the registered user.
                                    
                                </li>
                                <li class="b-dash-marked__item">
                                    <b>The authorization</b>&nbsp;—&nbsp;
                                    
                                         is the introduction by the registered user of their username and password to access the seller’s services or the services of the customer and enter the personal account.
                                    
                                </li>
                                <li class="b-dash-marked__item">
                                    <b>Seller’s personal account</b>&nbsp;—&nbsp;
                                    
                                         is the page of the registered user on the site, through which the registered user manages his account and balance (if applicable) and contains the following information: general profile settings, changes of mail, phone , password, change of categories and cities of fulfillment of the request or sale of goods, viewing of requests from customers, viewing of feedback from customers and balance replenishment.

                                    
                                </li>
								 <li class="b-dash-marked__item">
                                    <b>Customer’s personal account</b>&nbsp;—&nbsp;
                                    
                                         is the page of the registered user on the site, through which the registered user manages his account and contains the following information: general profile settings, mail, phone ,password changes, viewing offers from sellers, viewing reviews from sellers.
                                    
                                </li>
                                <li class="b-dash-marked__item">
                                    <b>Login</b>&nbsp;—&nbsp;
                                    
                                         is the identifier of the user during authorization on the site, used by him in the process of using the company's services in accordance with this agreement. The login is used as the e-mail address of the user. It is forbidden to register and use multiple logins by the same user. At the same time, the user is not allowed to use the login, which is already used by another user.
                                    
                                </li>
                                <li class="b-dash-marked__item">
                                    <b>Password</b>&nbsp;—&nbsp;
                                    
                                         is a symbolic combination automatically assigned by the site software at the time of registration ( the user can change the password himself in the future) provides together with login, the identification of the user when using the company services which are  provided in accordance with this agreement.
                                    
                                </li>
                                <li class="b-dash-marked__item">
                                    <b>Seller</b>&nbsp;—&nbsp;
                                    
                                         a user who has passed the registration and verification procedure on the website in accordance with the terms of this agreement, posting offers on the website in accordance with the terms of this agreement.
                                    
                                </li>
                                
                               
                                <li class="b-dash-marked__item">
                                    <b>Images</b>&nbsp;—&nbsp;
                                    
                                         - photos of users are attached photos to requests, attached photos, images to advertisements, added photos, images, as an example of work performed in the seller’s portfolio.
                                    
                                </li>
                                <li class="b-dash-marked__item">
                                    <b>Feedback</b>&nbsp;—&nbsp;
                                    
                                         is the user’s comments on the site regarding his relationship with another user in the process of providing services, performing work or purchasing goods.
                                    
                                </li>
                                <li class="b-dash-marked__item">
                                    <b>An offer</b>&nbsp;—&nbsp;
                                    
                                         is placed on the seller's website offer to the address of the customers to conclude an agreement with him for the provision of services, performance of work or the acquisition of goods in accordance with the customer request.
                                    
                                </li>
                               
                                <li class="b-dash-marked__item">
                                    <b>A customer</b>&nbsp;—&nbsp;
                                    
                                         is the user who has passed the registration procedure on the website and places a request on the website in accordance with the terms of this agreement and independently chooses the seller to receive services or purchase goods.
                                    
                                </li>
                                <li class="b-dash-marked__item">
                                    <b>A request</b>&nbsp;—&nbsp;
                                    
                                         is an information which is posted by the customer on the site and addressed to interested sellers, which contains a request for the provision, performance of services and work in a specific category or the purchase of goods in a specific category.
                                    
                                </li>
                               
                               
                                
                                <li class="b-dash-marked__item">
                                    <b>The balance</b>&nbsp;—&nbsp;
                                    
                                         is the user’s account on the site that displays the amount of funds that transferred by the company user as a guarantee payment, which can be used to pay for the services provided by the company to the user.
                                    
                                </li>
                                <li class="b-dash-marked__item">
                                    <b>The guarantee payment</b>&nbsp;—&nbsp;
                                    
                                         is the amount of money that is transferred by the seller to the bank account of the company and is reflected in the balance of the seller and is agreed by the parties (a seller and the company) in accordance with the provisions of part 2 of article 546 of the civil code of Ukraine, in a way to ensure the fulfillment of monetary obligations by the seller to the company with regard to payment to the company of the provided access and services.
                                    
                                </li>
                                <li class="b-dash-marked__item">
                                    <b>The bonuses</b>&nbsp;—&nbsp;
                                    
										 are a conditional accounting unit, which is calculated on the seller’s bonus account by the company in accordance with the bonus program established by the company and the conditions of which are posted on the website. The bonuses can only be used to pay for the services of the company, unless the others is specified in the bonus program.                                    
                                </li>
                                
                                <li class="b-dash-marked__item">
                                    <b>A seller’s bonus account</b>&nbsp;—&nbsp;
                                    
                                         is a set of registration and information data in the seller’s personal account on which bonuses are accumulated and stored.
                                    
                                </li>
                               
                              
                               
                                <li class="b-dash-marked__item">
                                    <b>An accounting time</b>&nbsp;—&nbsp;
                                    
                                         is Kiev time. All dates indicated when using the site and the services of the company are recorded to Kiev time.
                                    
                                </li>
                                <li class="b-dash-marked__item">
                                    <b>onfidentiality rules</b>&nbsp;—&nbsp;
                                    
                                        C are the conditions for the company to work with confidential information on the site. The current version is posted on the site at:  <a target="_blank" href="https://blablaprice.com/site/privacypolicy">https://blablaprice.com/site/privacypolicy</a>.
                                        Confidentiality rules are an integral part of the agreement.
                                    
                                </li>
                                <li class="b-dash-marked__item">
                                    <b>Rules for the service provision</b>&nbsp;—&nbsp;
                                    
                                        are a detailed description of the company's services, including their cost, as well as the rules for working with the service by the seller and the customer. Rules for the provision of services are an integral part of the agreement.
                                    
                                </li>
                               
                               
                            </ul>
                        </li>
                    </ul>
                    <p class="terms__paragraph">
                        
                            In the absence of an unambiguous interpretation of the terms in this offer, the parties will be guided by the interpretation of the terms that are used on the site in accordance with the current legislation of Ukraine
                        
                    </p>
                    <p class="terms__paragraph">
                        
                            All agreements on the provision of services and / or the purchase of goods are concluded directly between the users (the seller and the customer). Thus, the company is not a participant (party) to such agreements, but only provides a communication platform. The rights and obligations of the users are determined by the current legislation of Ukraine, including the law of Ukraine “ E-Commerce” and the law of Ukraine “Consumer protection”
                        
                    </p>
                </li>
                <li class="decimal-list__item">
                    <div class="terms__title">Subject of the contract</div>
                    <ol class="decimal-list decimal-list_type_fractional">
                        <li class="decimal-list__item">
                            
                                In accordance with the procedure and under the conditions specified in this agreement, the company provides the internet access to software products in the form of the online service blablaprice.com, which is available on the company's website: <a target="_blank" href="https://blablaprice.com/">https://blablaprice.com/</a>, and ensures the creation and placement of the seller's profile, as well as the creation and placement of the offer from the seller. Seller agrees to accept and pay for such provided services.
                            
                        </li>
                        <li class="decimal-list__item">
                            
                                Acceptance (the moment of full confirmation and unconditional acceptance of all the conditions of the offer agreement, its apps, rules, additions, which are its integral parts and is the moment of any interaction of the user with the site including, but not exclusively: registration on the site, making and / or replenishment of the guarantee payment and actual use of the site services.
                            
                        </li>
                        <li class="decimal-list__item">
                            
                                The fact of any interaction on the Site means that the user is familiar with it, understands and unconditionally accepts the terms of this offer agreement in full amount without reservations and restrictions.
                            
                        </li>
                        <li class="decimal-list__item">
                            
                                In case of disagreement of the user with any of the provisions of this agreement, the user is not entitled to use the company services and the company requests him to leave the site.
                            
                        </li>
                        <li class="decimal-list__item">
                            
                                The parties recognize the location of the company as the place of conclusion of this agreement.
                            
                        </li>
                        <li class="decimal-list__item">
                            
                                In addition to the text of this agreement, the procedure for the provision of services by the company is determined
                                <a target="_blank" href="https://blablaprice.com/privacy-policy">by the privacy rules </a> and the rules for the provision of services, which are an integral part of the agreement.
                            
                        </li>
                        <li class="decimal-list__item">
                            
                                The seller independently chooses the company services access to which and / or services of which he intends to receive or use.
                            
                        </li>
                        <li class="decimal-list__item">
                            
                                The company has the right to attract third parties (subcontractors) to provide users with all or part of the services for the use and / or access to the site.
                            
                        </li>
                    </ol>
                </li>
                <li class="decimal-list__item">
                    <div class="terms__title">The procedure for the provision and use of company services</div>
                    <ol class="decimal-list decimal-list_type_fractional">
                        <li class="decimal-list__item">
                            Services are provided by the company only for users.
                        </li>
                        <li class="decimal-list__item">
                            
                                A person who wants to become a user is obliged to go through the registration procedure on the corresponding page of the site. By registration the user undertakes to provide in the registration form (questionnaire) reliable, complete and accurate information about him and ensure its relevance and completeness. The user undertakes not to mislead the company and / or other users regarding their identity or name and also not to place on the site the addresses, telephone numbers, e-mail addresses, passport and registration data and other information of any third parties. In the case that the administration of the site detects inaccurate information posted by the user, the administration of the site has the right to mark such registration and / or suspend it and / or to terminate the access to the services of the site and the provision of services for the use of the services and / or to request additional documents for verification of such posted user information. In such case, the site administration shall send the corresponding notification to the user.
                            
                        </li>
                        <li class="decimal-list__item">
                            
                                The User is responsible for the observance of the rights (tangible and intangible) of third parties with respect to the information transmitted (provided) to the company by registration the user, using the site and receiving the company services. From the moment of registration on the site, the user gives his agreements  to processing the personal data of the user by the company specified by him during the registration (collection, registration, accumulation, storage, adaptation, change, renewal, clarification, use and distribution, realization, transfer, depersonalization, destruction ) in order  to provide provision of services, as well as for information services of the user.
                            
                        </li>
                        <li class="decimal-list__item">
                            
                                The user agrees that actions performed on the site after registration of the user that are recognized as actions of the user. The user is solely responsible for maintaining the confidentiality of his account (including the login and password) and for the activities that occur with his account.
                            
                        </li>
                        <li class="decimal-list__item">
                            
                                The user has no right to transfer, concede, sell, transfer the use of his login and password to access the company's site and services to third parties without the company's agreement. In case of transfer of the login and password to any third party, the user shall be solely responsible for the actions of such third party.
                            
                        </li>
                        <li class="decimal-list__item">
                            
                                In the case of security breach and unauthorized use of the user's account, he immediately has to notify the company. The company shall not be responsible for any damages caused by unauthorized use of the user's account.
                            
                        </li>
                        <li class="decimal-list__item">
                            
                                By registering, the user agrees to receive information messages at the email address or mobile phone number specified at registration. The company undertakes not to transmit the e-mail address or mobile number of the user to third parties without the user's agreement (except in cases provided by the current legislation of Ukraine).
                            
                        </li>
                       
                        <li class="decimal-list__item">
                            
                                The user immediately gains access to the personal account after registration and is assigned a unique ID number.
                            
                        </li>
						
                        <li class="decimal-list__item">
                            
                                The user has the right to terminate the company's services at any time by notifying the company by sending a corresponding notification.
                            
                        </li>
                        <li class="decimal-list__item">
                            
                                The company does not guarantee the availability of the site and services around the clock. The company has the right at any time to refuse any user to use the services in violation of this agreement.
                            
                        </li>
                        <li class="decimal-list__item">
                            
                                Users are prohibited from posting and downloading files that:
                            
                            <ul class="b-dash-marked">
                                <li class="b-dash-marked__item">
                                    to violate the current legislation of Ukraine; 
                                </li>
                                <li class="b-dash-marked__item">
                                    to contain spam, pyramid schemes;
                                </li>
                                <li class="b-dash-marked__item">
                                    
                                        to be unlawful, malicious, threatening, abusive, defamatory, copyrights infringing or other intellectual property rights of third parties, promoting hatred or discrimination against people on racial, ethnic, gender, or social grounds;
                                    
                                </li>
                                <li class="b-dash-marked__item">
                                    to contain links to internet resources owned by users or third parties;
                                </li>
                                <li class="b-dash-marked__item">
                                    
                                        to contain contact information of the user (phone number, social network accounts or instant messaging services);
                                    
                                </li>
                                <li class="b-dash-marked__item">
                                    to violate the rights of third parties.
                                </li>
                            </ul>
                            <p class="terms__paragraph">
                                
                                    The company has the right to familiarize with the history of messages and at any time to delete a personal message which is not compiled the requirements of this agreement.
                                
                            </p>
                        </li>
                        <li class="decimal-list__item">
                            User agrees:

                            <ul class="b-dash-marked">
                                <li class="b-dash-marked__item">
                                    
                                        do not take any action that could lead to a disproportionately large load on the infrastructure of the site;
                                    
                                </li>
                                <li class="b-dash-marked__item">
                                    
                                        do not use automatic programs to gain access to the site without the written permission of the company;
                                    
                                </li>
                                <li class="b-dash-marked__item">
                                    
                                        do not copy, reproduce, modify, distribute or make available to the public any information contained on the site (other than information provided by the user himself) without the prior written permission of the company;
                                    
                                </li>
                                <li class="b-dash-marked__item">
                                    
                                        do not interfere or try to interfere the work and other activities on the site and also not to impede the operation of automatic systems or processes, as well as other events, in order to prevent or restrict access to the site;
                                    
                                </li>
                                <li class="b-dash-marked__item">
                                    
                                        do not use the information provided by other users for other purposes, other than to make a transaction directly with this user, without the written permission of another user;
                                    
                                </li>
                            </ul>              
                        </li>
                        <li class="decimal-list__item">
                            
                                Customers place a request on the site, based on the principles of good faith and their interest in the performance or provision by the seller of work or services for the customer or the purchase of goods in the seller in a certain category. At the same time, it is prohibited for customers to place requests aimed at studying the demand for the provision, performance of services , work or the sale of goods and other purposes that are not related to the need for the actual performance, provision of work, services or the acquisition of goods.
                            
                        </li>
                        <li class="decimal-list__item">
                            
                                Sellers search for new inquiries themselves and place their offers on requests published by customers.  Seller placing of the offer is not a guarantee that the customer will choose the seller who has placed such an offer. 
                            
                        </li>
                        
                        <li class="decimal-list__item">
                            
                                The customer makes the choice of the seller within the time period specified when creating the request. After choosing a seller, the company provides the customer and the seller with contact information of each other, namely the phone numbers and email addresses specified by the users during registration. If the customer does not make a seller’s choice within the time period specified when creating the request, the request is canceled.
                            
                        </li>
                        <li class="decimal-list__item">
                            
                                After the selection of the seller, the customer and the seller enter into an agreement between themselves for the provision of services, work or the acquisition of goods.
                            
                        </li>
                        
                    </ol>
                </li>

                <li class="decimal-list__item">
                    <div class="terms__title">User’s services payment procedure</div>
                    <ol class="decimal-list decimal-list_type_fractional">
                      
                        <li class="decimal-list__item">
						        The amount of payment for providing access to the customer’s contacts will be deducted by the company from the Seller’s balance after the customer sends his contacts in response to the seller’s offers. The size of payments is available at: 
                                <a target="_blank" href="https://blablaprice.com/komissii-po-kategoriyam">https://blablaprice.com/komissii-po-kategoriyam</a>
                            
                                At the moment the seller submits the offer, such action by the seller is the seller’s agreement (acceptance) to change the purpose of the guarantee payment made by him and to make payments for providing the contractor with the access to the company's software products in the form of the online service blablaprice.com, which is posted on the company website  <a target="_blank" href="https://blablaprice.com/">blablaprice.com</a>, размещенного 
                                <a target="_blank" href="https://blablaprice.com/">https://blablaprice.com/</a>,
                                which ensures the creation and placement of the seller’s public profile, the creation and placement of the offer.
                            
                        </li>
                        
                        <li class="decimal-list__item">
                            
                                Access payment and additional services are carried out by the user in accordance with the current tariffs of the company specified in this agreement or the rules for the provision of services, applications.
                            
                        </li>
                       
                        <li class="decimal-list__item">
                            
                                Seller’s failure or poor fulfillment of the request due to the fault of the seller, as well as the fact that the seller did not receive money from the customer as payment for the properly executed request that is not a sufficient reason to return to the contractor access fees.
                            
                        </li>
                      
                      
                       
                       
                    </ol>
                </li>

                <li class="decimal-list__item">
                    <div class="terms__title">Rights and obligations of the company</div>
                    <ol class="decimal-list decimal-list_type_fractional">
                        <li class="decimal-list__item">
                            
                                The site administration is obligated to ensure that the user can receive the services in the order specified by this agreement.
                            
                        </li>
                        <li class="decimal-list__item">
                            
                                Users agree that the company reserves the right, at its own discretion to modify or delete any information published on the site and to suspend, restrict or terminate the user’s access to the company services at any time for any reason, provided directions of appropriate written notice to the user.
                            
                        </li>
                        <li class="decimal-list__item">
                            
                                The company has the right to change the terms of this agreement, including the payment procedure and tariffs of the services. Information on such changes is published by the company on the site or in the newsletter. Continued use of the site by the user after any changes to the agreement means his consent to such changes or additions.
                            
                        </li>
                        <li class="decimal-list__item">
                            
                                The company has the right to place advertising or other information in any section of the site without the agreement of the user.
                            
                        </li>
                        <li class="decimal-list__item">
                            
                                In the event of the user's breach of the terms of this agreement, the company has the right to suspend, restrict or terminate such user's access to any of the company's services unilaterally at any time, without responsibility for any damage that may be caused to the user by such actions.
                            
                        </li>
                        <li class="decimal-list__item">
                            
                                The Company has the right to send messages to the users of the company, including electronic messages to the e-mail addresses of the user or SMS-messages to the mobile phone numbers of the user containing organizational-technical, informational or other information about the capabilities of the company's services.
                            
                        </li>
                        <li class="decimal-list__item">
                            
                                The Company undertakes not to use the user's credentials obtained during registration for purposes not provided in this agreement and its annexes and guarantees non-disclosure of such data, except when disclosure of such information is the responsibility of the company due to the legislation of Ukraine.
                            
                        </li>
                       
                        <li class="decimal-list__item">
                            
                                The Company has the right to moderate all advertisings, offers, images, videos and requests.
                            
                        </li>
                    </ol>
                </li>

                <li class="decimal-list__item">
                    <div class="terms__title">User’s rights and obligations</div>
                    <ol class="decimal-list decimal-list_type_fractional">
                        <li class="decimal-list__item">
                            
                                The user undertakes to comply with the terms of this agreement and its annexes, as well as pay for the services provided to him in the order and on the conditions that are provided in this agreement.
                            
                        </li>
                        <li class="decimal-list__item">
                            
                                The user undertakes to independently familiarize himself with the information on the conditions for the provision of services of the company and their cost. The user undertakes to regularly, but at least once a week, get acquainted on the site with information related to the provision of the services. The silence and continued use of the service after the company has notified the website about changes to the current conditions of this agreement and other changes is considered as the agreement of the user with the changes and additions, unless otherwise expressly provided in such amendments. All risks associated with the onset of adverse effects due to non-compliance by the user with the requirements of this paragraph. All risks associated with the onset of adverse effects due to non-compliance by the user with the requirements of this paragraph are carried only by the user.
                            
                        </li>
                        <li class="decimal-list__item">
                            
                                The user has the right to contact the technical support service of the company, while providing his username or contact information.
                            
                        </li>
                        <li class="decimal-list__item">
                            
                                The user agrees to use the services only for legitimate purposes and to comply with the current legislation of Ukraine, as well as the rights and legitimate interests of the company.
                            
                        </li>
                        <li class="decimal-list__item">
                            
                                The user does not have the right to perform actions that affect the normal operation of the portal and are its unfair use. The user agrees not to use any devices, programs, procedures, algorithms and methods, automatic devices or equivalent manual processes to access, acquire, copy or track the content of the site.
                            
                        </li>
                        <li class="decimal-list__item">
                            
                                The user agrees not to take actions aimed at gaining access to someone else’s personal account by selecting a username and password, hacking or other actions.
                            
                        </li>
                        <li class="decimal-list__item">
                            
                                The user confirms that he is fully competent (for individual entities), capable (for legal entities) and there is no care in any form above it.
                            
                        </li>
                        <li class="decimal-list__item">
                            
                                The user guarantees that he has all the rights to use the materials (content) placed by him when creating the announcement.
                            
                        </li>
                        <li class="decimal-list__item">
                            
                                Customers agree not to post requests whose purpose is to:
                            
                            <ul class="b-dash-marked">
                                <li class="b-dash-marked__item">
                                    
                                        attract users, as well as other visitors of the site to third-party resources, sites, or registering users, as well as other visitors of the Site on such resources, sites.
                                    
                                </li>
                                <li class="b-dash-marked__item">
                                    
                                        advertise of goods, works and services, as well as goods, works and services belonging to third parties.
                                    
                                </li>
                                <li class="b-dash-marked__item">
                                    
                                        cheat or change the statistics of sites, the number of subscribers in social networks.
                                    
                                </li>
                                <li class="b-dash-marked__item">
                                    
                                        order automatic or manual sending of invitations and messages to users of social networks, email-mailings.
                                    
                                </li>
                                <li class="b-dash-marked__item">
                                    services provision on distribution of goods of the customer.
                                </li>
                            </ul>
                        </li>
                        <li class="decimal-list__item">
                            Sellers are not obliged to post advertisements and offers on the site, which:
                            <ul class="b-dash-marked">
                                <li class="b-dash-marked__item">
                                    violate the current legislation of Ukraine;
                                </li>
                                <li class="b-dash-marked__item">
                                    contain spam, financial pyramid schemes;
                                </li>
                                <li class="b-dash-marked__item">
                                    
                                        are illegal, malicious, threatening, abusive, defamatory, infringing on copyrights or other intellectual property rights of third parties, promoting hatred or discrimination against persons on racial, ethnic, sexual, social grounds;
                                    
                                </li>
                                <li class="b-dash-marked__item">
                                    contain links to Internet resources owned by users or third parties;
                                </li>
                                <li class="b-dash-marked__item">
                                    services provision on distribution of goods of the customer;
                                </li>
                                <li class="b-dash-marked__item">
                                    
                                        contain seller or third party’s contact information (phone number, social networking accounts, or instant messaging services);
                                    
                                </li>
                                <li class="b-dash-marked__item">
                                    violate third parties’ rights;
                                </li>
                                <li class="b-dash-marked__item">
                                    not relevant to the selected service category.
                                </li>
                            </ul>
                        </li>
                        <li class="decimal-list__item">
                            
                                The customer recognizes and confirms that by selecting the seller by using company services, that:
                            
                            <ul class="b-dash-marked">
                                <li class="b-dash-marked__item">
                                    
                                        The company and sellers are completely independent entities that do not affect each other's activities;
                                    
                                </li>
                                <li class="b-dash-marked__item">
                                    
                                        The company is not responsible for compliance with the legislation of Ukraine and the customer's expectations of the activities performed by the seller to perform works, provide services for the customer;
                                    
                                </li>
                                <li class="b-dash-marked__item">
                                    
                                        The company is not a party to the electronic transaction between the seller and the customer, the subject of which is the work or services which are offered by the sellers. All transactions between sellers and customers are concluded directly, the company is not a party to such transactions (agreements), but only provides a communication platform for the placement of announcements, offers, requests, as well as provides the opportunity to make a choice by the customer of the seller to provide , perform services, works or purchase goods in a certain category. The Company is not responsible for the content of the transmitted or received information  through the damage caused as a result of users using the results of the portal services;
                                    
                                </li>
                                <li class="b-dash-marked__item">
                                    
                                        The company is not responsible for the quality of goods or the timing and quality of work, services performed or provided by the sellers for the customer;
                                    
                                </li>
                                <li class="b-dash-marked__item">
                                    
                                        The company is not responsible for the fulfillment of warranty obligations for goods or works, services performed or provided by sellers for the customer.
                                    
                                </li>
                                <li class="b-dash-marked__item">
                                    
                                        The customer undertakes to independently draw up its contractual relationship with the sellers chosen by it (including: to request documents proving the identity of the seller when concluding contracts and  also to request documents confirming the seller’s qualifications for the performance and provision of relevant works, services, as well as other documents provided  by the legislation of Ukraine.
                                    
                                </li>
                            </ul>
                        </li>
                        <li class="decimal-list__item">
                            
                                The seller understands and confirms that when choosing it by the customer through the use of the services provided by the company, that:
                            
                            <ul class="b-dash-marked">
                                <li class="b-dash-marked__item">
                                    
                                        The company and the customer are completely independent entities that do not affect each other's activities;
                                    
                                </li>
                                <li class="b-dash-marked__item">
                                    
                                        The company is not responsible for the fulfillment by the customer of contractual obligations for the seller, including those related to payment for the work, services or goods.
                                    
                                </li>
                                <li class="b-dash-marked__item">
                                    
                                        The company is not a party to the electronic transaction between the seller and the customer, the subject of which is the work or services or goods offered by the sellers. All transactions between sellers and customers are concluded directly, the company is not a party to such transactions (agreements), but only provides a communication platform for posting announcements, proposals, requests, and also provides an opportunity to make a choice by the customer of the seller to provide, perform services, work or purchase goods in a certain category. The company is not responsible for the content of transmitted or received information through the damage caused as a result of users using the results of the portal services.
                                    
                                </li>
                                <li class="b-dash-marked__item">
                                    
                                        The seller undertakes to independently draw up contractual relations with customers who have chosen the seller as the person who will perform certain works, services or sell goods, including: to request documents proving the identity of the customer when concluding contracts and also draw up a written contract with the customer and other documents confirming, including the sale of goods or the performance, provision of work or services;
                                    
                                </li>
                            </ul>
                        </li>
                       
                      
                        <li class="decimal-list__item">
                            
                                The user may have other rights and bear other obligations established by this agreement and the current legislation of Ukraine.
                            
                        </li>                 
                    </ol>
                </li>

                <li class="decimal-list__item">
                    <div class="terms__title">Responsibility and limitation of responsibility.</div>
                    <ol class="decimal-list decimal-list_type_fractional">
                        <li class="decimal-list__item">
                            
                                The company is not responsible for any errors, omissions, interruptions, defects and delays in the processing or transfer of data, interruptions in communication lines, destruction of any equipment, illegal access of third parties of the site, which caused the user to restrict access to the services. The company is not responsible for any technical failures or other problems of any telephone networks or services, computer systems, servers or providers, computer or telephone equipment, software, failure of email services or scripts for technical reasons, for the normal functioning and accessibility of certain segments of the Internet and networks of telecommunication operators involved in the user’s access to the services.
                            
                        </li>
                        <li class="decimal-list__item">
                            
                                The company is not responsible for the compliance of the entire service or its parts with the expectations of the user, the error-free and uninterrupted operation of the service, termination of the user’s access to the service, as well as the safety of the user’s login and password, providing access to the services, for reasons related to technical failures of hardware or software of the company, and does not reimburse the user for any losses associated with this.
                            
                        </li>
                        <li class="decimal-list__item">
                            
                                In case of violation by the users of the terms of this agreement and / or the norms of the current legislation of Ukraine. The company reserves the right to restrict the user’s access to the company’s services on a temporary basis, and in case of a gross and / or repeated (more than two times) violation of the terms of this agreement to refuse access to permanent services.
                            
                        </li>
                        <li class="decimal-list__item">
                            
                                The company is not responsible to the user for restricting access to the services, for terminating access to the services. If these restrictions and termination were the result of force majeure circumstances that arose after the conclusion of this agreement and on the occurrence of which the parties were not able to influence, including, but not limited to the following: war, riots, strikes, sabotage, embargoes, fires, floods, natural disasters, deterioration of the radio electronic or radiological situation, explosions, acts or omissions of the government of Ukraine or another country, acts of state bodies and / or local governments, amendments to the legislation of Ukraine, accidents on public networks, changes in access conditions to line-cable communication facilities.
                            
                        </li>
                        <li class="decimal-list__item">
                            
                                The company is not liable to the user or any third parties for any direct and / or indirect losses, including lost profits or lost data, damage to honor, dignity or business reputation, incurred in connection with the use of the services, or the inability to use it, or unauthorized access to third party user communications.
                            
                        </li>
                        <li class="decimal-list__item">
                            
                               The company is not responsible for any damage to the electronic devices of the user or another person, any other equipment or software caused by or associated with the use of the services by the user.
                            
                        </li>
                        <li class="decimal-list__item">
                            The company is not responsible to the User or any third parties for:
                            <ul class="b-dash-marked">
                                <li class="b-dash-marked__item">
                                    
                                        content and legality, reliability of information used or received by the user when using the services;
                                    
                                </li>
                                <li class="b-dash-marked__item">
                                    quality and delivery time of goods or works, services provided by the seller to the customer, their on time fulfillment.
                                </li>
                                <li class="b-dash-marked__item">
                                    
                                        fulfillment of warranty obligations to customers regarding the work, services performed or provided by the sellers or delivered goods;
                                    
                                </li>
                                <li class="b-dash-marked__item">
                                    
                                        compliance of the activities carried out by the sellers in the implementation, provision of works, services or delivery of goods to the customers with the legislation of Ukraine;
                                    
                                </li>
                                <li class="b-dash-marked__item">
                                    
                                        fulfillment by customers of their payment’s obligations;
                                    
                                </li>
                            </ul>
                        </li>
                        <li class="decimal-list__item">
                            
                                In the case of claims by the third parties, including another user, against the company related to the use of the company's services by the user and the user undertakes to settle these claims with third parties on his own and at his own expense, protecting the company from possible losses and proceedings, or to act on the side of the company in such proceedings, as well as to compensate the losses of the company (including legal costs) incurred in connection with the claims and claims related to the placement of materials and / or the activities of the user on the site.
                            
                        </li>
                        <li class="decimal-list__item">
                            
                                The company will not be liable for any costs or damage directly or indirectly incurred by the customers or Sellers as a result of the fulfillment, provision by the sellers of work, services or the delivery of goods by the sellers to the customers. The Company is under no circumstances liable to customers, sellers or third parties for any indirect losses, including lost profits. The responsibility of the company is limited to direct documented confirmed losses incurred as a result of the action or inaction of the company in an amount not exceeding the cost of the services provided to an individual user.
                            
                        </li>
                        <li class="decimal-list__item">
                            
                                The company does not control the quality and terms of the works, services performed or provided by the sellers or the quality and terms of the goods delivered by the sellers offered by them by posting relevant information on the site. As a result of this, the user accepts the condition that all goods or works and services offered through the site by sellers are provided by them under their own responsibility and the supply of goods or the provision of these works and services is in no way connected with the activities of the company. The customer assumes full responsibility and risks for the provision of works and services and the supply of goods offered by sellers by posting relevant information on the site. The seller assumes full responsibility and risks for payment by the customers of the work and services performed by the sellers or delivered goods by the sellers.
                            
                        </li>
                        <li class="decimal-list__item">
                            
                                The company administration reserves the right to remove or block access to information posted by the user without warning, in the case of:
                            
                            <ul class="b-dash-marked">
                                <li class="b-dash-marked__item">
                                    
                                        obtaining mandatory decisions of the competent state authorities of Ukraine;
                                    
                                </li>
                                <li class="b-dash-marked__item">
                                    
                                        claims of owners (and / or authorized representatives) of intellectual property rights, including, but not limited to, copyright and / or related rights, rights to marks for goods and services, etc., and on termination of violations of his rights by the user on to site;
                                    
                                </li>
                                <li class="b-dash-marked__item">
                                    
                                        any other rights violation or legitimate interests of other users of the site, legal and individuals entities on their reasoned appeal;
                                    
                                </li>
                                <li class="b-dash-marked__item">
                                    
                                        identifying information that is prohibited from posting on the site or does not comply with the rules for the provision of services in accordance with this agreement and / or the current legislation of Ukraine;
                                    
                                </li>
                            </ul>
                        </li>
                    </ol>
                </li>

                <li class="decimal-list__item">
                    <div class="terms__title">Intellectual property.</div>
                    <ol class="decimal-list decimal-list_type_fractional">
                        <li class="decimal-list__item">
                            
                                The totality of programs, data, trademarks, intellectual property, including copyright, and other objects used on the Site is the intellectual property of its legal owners and is protected by the intellectual property law of Ukraine, as well as relevant international legal treaties and conventions. Any use of elements, symbols, texts, graphic images, programs and other objects included in the service, except as permitted in this agreement, without the permission of the company or other legal copyright holder is illegal and may serve as a reason for legal proceedings and attraction of violators to civil law, administrative and criminal responsibility in accordance with the legislation of Ukraine.
                            
                        </li>
                    </ol>
                </li>

                <li class="decimal-list__item">
                    <div class="terms__title">Parties’ correspondence. Notices and notifications.</div>
                    <ol class="decimal-list decimal-list_type_fractional">
                        <li class="decimal-list__item">
                            
                                Correspondence between the parties regarding the execution of this agreement is carried out by e-mail, through the addresses specified by the users during registration. The email address registered with the company shall be considered the email addresses of &nbsp;<a href="mailto:team@blablaprice.com">team@blablaprice.com</a>.
                            
                        </li>
                        <li class="decimal-list__item">
                            
                                The user and the company agree that all notices and notifications received to the email addresses registered for each of the parties as part of the services provided in accordance with this agreement, as well as the publication of changes and additions to this agreement on the site are considered delivered to the addressee in the proper form.
                            
                        </li>
                        <li class="decimal-list__item">
                            
                                The user and the company agreed that the documents related to the execution of this agreement, transmitted using e-mail have legal force.
                            
                        </li>
                        <li class="decimal-list__item">
                            
                                The user and the company undertakes to timely check the correspondence received at the email addresses.
                            
                        </li>
                    </ol>
                </li>

                <li class="decimal-list__item">
                    <div class="terms__title">Order of settlement’ disputes.</div>
                    <ol class="decimal-list decimal-list_type_fractional">
                        <li class="decimal-list__item">
                            
                                The user and the company agree that all disputes and disagreements that may arise from this agreement or in connection with it will be resolved through negotiations with the mandatory observance of the pre-trial procedure for resolving disputes. The claims of the user regarding the service provided by the company are accepted for consideration only if they are made in writing and sent to the mailing address of the company within three months from the date of the provision of the service or refusal in his providing.
                            
                        </li>
                        <li class="decimal-list__item">
                            
                                In case that agreement is not reached, all disputes regarding the execution of this agreement are settled in court in accordance with the current legislation of Ukraine at the location of the company.
                            
                        </li>
                        <li class="decimal-list__item">
                            
                                In case of a dispute between the customer and the seller related to the delivery by the seller of goods or the fulfillment, provision by the seller of work, services to the customer or their payment, these disputes shall be resolved independently between the customer and the seller without involving the company.
                            
                        </li>
                    </ol>
                </li>

                <li class="decimal-list__item">
                    <div class="terms__title">Procedure for amending and supplementing to the agreement.</div>
                    <ol class="decimal-list decimal-list_type_fractional">
                        <li class="decimal-list__item">
                            
                                Changes and / or additions to the agreement are made unilaterally by decision of the company. The date of entry into force of amendments and / or additions to this agreement is the date of publication of these amendments and / or additions to the site, unless otherwise specified by the company.
                            
                        </li>
                        <li class="decimal-list__item">
                            
                                In case of disagreement of the user with the amendments and / or additions to this agreement and the user has the right to terminate this agreement by notifying the company of the user’s refusal to continue using the company services, as well as of disagreeing with the amendments and / or additions, or not joining the new edition of the agreement or refusal to comply with its terms.
                            
                        </li>
                        <li class="decimal-list__item">
                            
                                The parties agree that silence (lack of written notice of termination of the agreement or disagreement with certain provisions of the agreement, including changes in tariffs), as well as continued use of the company's services, shall be recognized by the consent and accession of the party to the new version of the agreement, to the revision of the agreement taking into account amendments and / or additions.
                            
                        </li>
                    </ol>
                </li>

                <li class="decimal-list__item">
                    <div class="terms__title">Final provisions.</div>
                    <ol class="decimal-list decimal-list_type_fractional">
                        <li class="decimal-list__item">
                            
                                This agreement and the relationship between the company and the user are governed by the laws of Ukraine. Issues not regulated by the agreement shall be resolved in accordance with the legislation of Ukraine.
                            
                        </li>
                        <li class="decimal-list__item">
                            
                                If for one reason or another, any of the conditions of this agreement is declared invalid, this does not affect the validity or applicability of the remaining conditions of the agreement.
                            
                        </li>
                        <li class="decimal-list__item">
                            
                                This agreement with respect to each of the users comes into force from the moment the user takes one of the earliest actions specified in paragraph 2.2. of this agreement and is valid until the end of the use of the company services by the user.
                            
                        </li>                      
                        
                       
                    </ol>
                </li>
            </ul>
        </div>
    </div>
     
	




			 <div class="inner-block fixed-desktop fixed-desktop-right " >
					<div class="user-photo-left icon-logo">
						<img src="/img/icon-logo.png" alt="">
					</div>
                   <div class="container">
                        <div class="title-how-it-works"><?= Yii::t('app', 'Популярні питання'); ?></div>
						<div class="cust-tooltip ">
						   <div  class="link-how-it-works "  <span>  <?= Yii::t('app', 'Це безкоштовно ?'); ?></span></div>
						   <div class="tooltip-content-2 how-it-works-tooltip">
                              <?= Yii::t('app', 'Так. Ви можете безкоштовно надсилати запити і обмінюватись контактами з обраними продавцями. '); ?>
                           </div>
						</div >
						<div class="cust-tooltip ">
						   <div  class="link-how-it-works "  <span>  <?= Yii::t('app', 'Хто бачить мої контакти?'); ?></span></div>
						   <div class="tooltip-content-2 how-it-works-tooltip">
                             <?= Yii::t('app','Ви самі обираєте з ким обмінятись контактами. '); ?>
                           </div>
						</div >
						<div class="cust-tooltip ">
						   <div  class="link-how-it-works "  <span><?= Yii::t('app', 'Чи обовязково обирати продавця? '); ?></span></div>
						   <div class="tooltip-content-2 how-it-works-tooltip">
                              <?= Yii::t('app','Не обовязково. Якщо вам не підійшли умови ви можете проігноравати пропозиції , або обмінятись контактами і ще поторгуватись з обраним продавцем.'); ?>
                           </div>
						</div >
						 <div class="empty-space col-xs-b20 col-lg-b20"></div>
						 <div class="title-how-it-works"><?= Yii::t('app', 'Поширте BlaBlaPrice'); ?></div>
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
                              <?= Yii::t('app','Поширте BlaBlaPrice щоб отримувати більше запитів '); ?>
                           </div>
					</div >
					 <div class="empty-space col-xs-b20 col-lg-b20"></div>
					 <a class="link-right-block" href="/site/howitworks"><?= Yii::t('app', 'Як це працює? '); ?></a>  
					 <a class="link-right-block" href="/site/contact"><?= Yii::t('app', 'Контакти '); ?></a>
					 <a class="link-right-block" href="/site/termsofuse"><?= Yii::t('app', 'Умови використання '); ?></a>
					 <a class="link-right-block" href="/site/privacypolicy"><?= Yii::t('app', 'Політика конфіденційності '); ?></a>					 
					 
					 
                     <div  class="blabla-right-block "  <span> BlaBlaPrice © 2018 </span></div>				 
					 
		
     </div>
	</div>
	<div class="empty-space col-xs-b90 col-sm-b90"></div> 
                

            
     
            
            
	
   </div> 
  </div>
</div>
<div class="float-container-bottom hidden-lg" >
            <div class="footer-main-link">

               <a href="/cabinet/order" class="link-footer"><i class="icon-login"></i><span> <?= Yii::t('app', 'Запити'); ?></a>
               <a href="/cabinet/offer" class="link-footer  "><i class="icon-logout"></i><span> <?= Yii::t('app', 'Пропозиції'); ?></span></a>
               <a href="/cabinet/accepted" class="link-footer "><i class="icon-users-outline"></i><span> <?= Yii::t('app', 'Контакти'); ?></span></a>
               <a href="/cabinet/comment" class="link-footer "><i class="icon-chat-alt"></i><span> <?= Yii::t('app', 'Відгуки'); ?></span></a>




        </div>
    </div>
  </div>       
              

        

        

    <div class="popup-wrapper">
        <div class="close-layer"></div>

        <?= $this->render('@app/themes/blablaprice/popup/popup-account-login') ?>

        <?= $this->render('@app/themes/blablaprice/popup/popup-account-registration') ?>

        <?= $this->render('@app/themes/blablaprice/popup/popup-account-reset-password') ?>
		 <?= $this->render('@app/themes/blablaprice/popup/language'); ?>

    </div>

    <div class="video-popup">
        <a class="button style-3 size-3 shadow close-video" href="#">
                <span>
                    <?= Html::img('/img/icon-1.png') ?>
                </span>
        </a>
        <div class="video-container">

        </div>
    </div>

    <!-- SCRIPTS BEGIN -->
    <script type='text/javascript'>
        $(function () {
            var datepickerInterval;

            $('#datepicker').pickadate({
                min: new Date(),
                onSet: function (thingSet) {
                    clearInterval(datepickerInterval);
                    setTimer($('.time-entry[data-rel="' + $('#datepicker').data('rel') + '"]'), thingSet.select);
                    datepickerInterval = setInterval(function () {
                        setTimer($('.time-entry[data-rel="' + $('#datepicker').data('rel') + '"]'), thingSet.select);
                    }, 1000);
                }
            });

            function setTimer(wrapper, finalTime) {
                var today = new Date().getTime();
                var interval = finalTime - today;
                if (interval < 0) interval = 0;
                var days = parseInt(interval / (1000 * 60 * 60 * 24));
                var daysLeft = interval % (1000 * 60 * 60 * 24);
                var hours = parseInt(daysLeft / (1000 * 60 * 60));
                var hoursLeft = daysLeft % (1000 * 60 * 60);
                var minutes = parseInt(hoursLeft / (1000 * 60));
                var minutesLeft = hoursLeft % (1000 * 60);
                var seconds = parseInt(minutesLeft / (1000));
                wrapper.find('.days').text(days);
                wrapper.find('.hours').text(hours);
                wrapper.find('.minutes').text(minutes);
                wrapper.find('.seconds').text((seconds < 10) ? '0' + seconds : seconds);
            }
        });
    </script>

<?php
$this->registerJs('
    var wow = new WOW();
    if(!_ismobile) wow.init();
    ', \yii\web\View::POS_END);
?>
    <!-- SCRIPTS END -->


<?= $this->render('footer'); ?>