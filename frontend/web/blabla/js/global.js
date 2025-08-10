/*================*/
/* 01 - VARIABLES */
/*================*/
var swipers = [], winW, winH, winScr, sidebarH, footerTop, headerHeight = 69, _isresponsive = false,
	_ismobile = navigator.userAgent.match(/Android/i) || navigator.userAgent.match(/webOS/i) || navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i) || navigator.userAgent.match(/iPod/i);

var _functions = {};

$(function() {
	"use strict";

	/*========================*/
	/* 02 - page calculations */
	/*========================*/
	_functions.pageCalculations = function(){
		winW = $(window).width();
		winH = $(window).height();
		if($('#responsive-point').is(':visible')) _isresponsive = true;
		else _isresponsive = false;
		$('.banner-align').css({'height':winH - 180 - 69});
        $('.sidebar-content').css({'min-height':winH-headerHeight});
	};
	_functions.selectInit = function(){
		$('.SlectBox').SumoSelect({ csvDispCount: 3, search: true, searchText:'Пошук', noMatch:'Нічого не знайдено за "{0}"', floatWidth: 0 });
	};
	var initIterator = 0;
	_functions.initSwiper = function(){
		$('.swiper-container:not(.initialized)').each(function(){								  
			var $t = $(this);								  

			var index = 'swiper-unique-id-'+initIterator;

			$t.addClass('swiper-'+index+' initialized').attr('id', index);
			$t.find('.swiper-pagination').addClass('swiper-pagination-'+index);
			$t.find('.swiper-button-prev').addClass('swiper-button-prev-'+index);
			$t.find('.swiper-button-next').addClass('swiper-button-next-'+index);

			var slidesPerViewVar = ($t.data('slides-per-view'))?$t.data('slides-per-view'):1,
				loopVar = ($t.data('loop'))?parseInt($t.data('loop'), 10):0;
			if(slidesPerViewVar!='auto') slidesPerViewVar = parseInt(slidesPerViewVar, 10);

			swipers['swiper-'+index] = new Swiper('.swiper-'+index,{
				pagination: '.swiper-pagination-'+index,
		        paginationClickable: true,
		        nextButton: '.swiper-button-next-'+index,
		        prevButton: '.swiper-button-prev-'+index,
		        slidesPerView: slidesPerViewVar,
		        autoHeight: ($t.data('auto-height'))?parseInt($t.data('auto-height'), 10):0,
		        loop: loopVar,
				autoplay: ($t.data('autoplay'))?parseInt($t.data('autoplay'), 10):0,
				centeredSlides: ($t.data('center'))?parseInt($t.data('center'), 10):0,
		        breakpoints: ($t.data('breakpoints'))? { 767: { slidesPerView: parseInt($t.attr('data-xs-slides'), 10) }, 991: { slidesPerView: parseInt($t.attr('data-sm-slides'), 10) }, 1199: { slidesPerView: parseInt($t.attr('data-md-slides'), 10) } } : {},
		        initialSlide: ($t.data('ini'))?parseInt($t.data('ini'), 10):0,
		        watchSlidesProgress: true,
		        speed: ($t.data('speed'))?parseInt($t.data('speed'), 10):500,
		        parallax: ($t.data('parallax'))?parseInt($t.data('parallax'), 10):0,
		        slideToClickedSlide: true,
		        keyboardControl: true,
		        mousewheelControl: ($t.data('mousewheel'))?parseInt($t.data('mousewheel'), 10):0,
		        mousewheelReleaseOnEdges: true,
		        direction: ($t.data('direction'))?$t.data('direction'):'horizontal',
		        lazyLoading: true,
		        onTransitionStart: function(swiper){
		        	var activeIndex = swiper.activeIndex,
		        		wrapper = $t.closest('.swiper-entry');
		        	if(wrapper.hasClass('new-page-custom-slider')){
		        		wrapper.find('.new-page-slider-bg').removeClass('active');
		        		wrapper.find('.new-page-slider-bg').eq(activeIndex).addClass('active');
		        	}
		        	if(wrapper.find('.swiper-tabs').length){
		        		wrapper.find('.swiper-tab-entry').removeClass('active');
		        		wrapper.find('.swiper-tab-entry').eq(activeIndex).addClass('active');
		        	}

	                // if($t.hasClass('swiper-control-top')){
	                //     var activeIndex = swiper.activeIndex,
	                //         slidersWrapper = $t.closest('.swipers-couple-wrapper');
	                //     swipers['swiper-'+slidersWrapper.find('.swiper-control-bottom').attr('id')].slideTo(activeIndex);
	                //     slidersWrapper.find('.swiper-control-bottom').find('.active').removeClass('active');
	                //     slidersWrapper.find('.swiper-control-bottom').find('.swiper-slide').eq(activeIndex).addClass('active');
	                // }
            	}
			});
			swipers['swiper-'+index].update();
			initIterator++;
		});
	};

	/*=================================*/
	/* 03 - function on document ready */
	/*=================================*/
	if(_ismobile) $('body').addClass('mobile');
	_functions.pageCalculations();
	$('#loader').fadeOut();
	_functions.initSwiper();
	_functions.selectInit();


	/*============================*/
	/* 04 - function on page load */
	/*============================*/
	$(window).load(function(){
		$('body').addClass('loaded');
	});

	/*==============================*/
	/* 05 - function on page resize */
	/*==============================*/
	_functions.resizeCall = function(){
		_functions.pageCalculations();
	};
	if(!_ismobile){
		$(window).resize(function(){
			_functions.resizeCall();
		});
	} else{
		window.addEventListener("orientationchange", function() {
			_functions.resizeCall();
		}, false);
	}

	/*==============================*/
	/* 06 - function on page scroll */
	/*==============================*/
	$(window).scroll(function(){
		_functions.scrollCall();
	});

	_functions.scrollCall = function(){
		winScr = $(window).scrollTop();
		if(winScr>100) $('header').addClass('scrolled');
		else $('header').removeClass('scrolled');
		
		if($('.left-right-row').length){
			$('.tab-entry:visible').find('.left-right-row').each(function(index, element){
				if($(element).offset().top<=($('.left-right-wrapper .clip-line').offset().top+winH*0.6)){
					$(element).addClass('active');
					$(element).prevAll().addClass('active');
					$(element).nextAll().removeClass('active');
				}
			});
		}
        if($('.sidebar-align-right-hover-wrapper').length && footerTop <= winH + winScr){
            $('.sidebar-align-right-hover-wrapper').css({'transform':'translateY('+(-1)*(winScr+winH-footerTop)+'px)','-webkit-transform':'translateY('+(-1)*(winScr+winH-footerTop)+'px)'});
        }
        else $('.sidebar-align-right-hover-wrapper').css({'transform':'translateY(0px)','-webkit-transform':'translateY(0px)'});
	};

	/*==============================*/
	/* 08 - buttons, clicks, hovers */
	/*==============================*/

	// TOP HEADER MENU
	// ===============================================================================================================================

	//open and close top header menu
	/*$('.menu-button, .header-menu-close').on('click', function () {
		if ($('.header-menu').hasClass('active')) {
			$('.menu-button, .header-menu').removeClass('active');
			$('.header-menu-column').removeClass('active').find('.hover').removeClass('hover');
			$('html').removeClass('rw-overflow-hidden');
			$('.sidebar-menu-search-popup').removeClass('active');
			$('.header-menu-content').removeClass('active fake-panel-visible');
		}
		else {
			$('.menu-button, .header-menu').addClass('active');
			$('.header-menu-column:first-child').addClass('active');
			$('html').addClass('rw-overflow-hidden');
		}
	});*/

	const nav = document.querySelector('.nav');
	$('.menu-button, .header-menu-close, .btn-filter').on('click', function(){
		nav.classList.toggle('active');
	});

	document.addEventListener('click', (e) => {
		if (e.target.classList.contains('nav')) {
			nav.classList.toggle('active');
		}
	});

	//sidebar search in responsive mode
	$('.open-sidebar-search').on('click', function(){
		$('.sidebar-menu-search-popup').addClass('active').find('input').focus();
		$('.header-menu-column').removeClass('active');
	});

	$('.close-sidebar-search').on('click', function(){
		$('.sidebar-menu-search-popup').removeClass('active');
		$('.header-menu-column:first-child').addClass('active');
	});	

	//header menu mouseover top and bottom arrows
	$(document).on('mouseenter', '.menu-scroll-bottom', function(){
		clearTimeout(menuTimeout);
		$(this).closest('.header-menu-column').nextAll('.header-menu-column').hide();

		var animateOut = $(this).parent().find('.header-menu-scroll-overflow'),
			animateIn = $(this).parent().find('.header-menu-scroll-container'),
			animateOutHeight = animateOut.outerHeight(),
			animateInHeight = animateIn.outerHeight(),
			s = animateInHeight - animateOutHeight,
			dif = animateOut.scrollTop(),
			t = (animateInHeight - animateOutHeight-animateOut.scrollTop())/0.4;
		animateOut.animate({'scrollTop':s}, t);
	});

	$(document).on('mouseleave', '.menu-scroll-bottom', function(){
		$(this).parent().find('.header-menu-scroll-overflow').stop();
	});

	$(document).on('mouseenter', '.menu-scroll-top', function(){
		clearTimeout(menuTimeout);
		$(this).closest('.header-menu-column').nextAll('.header-menu-column').hide();

		var animateOut = $(this).parent().find('.header-menu-scroll-overflow'),
			t = animateOut.scrollTop()/0.4;
		animateOut.animate({'scrollTop':0}, t);
	});
	$(document).on('mouseleave', '.menu-scroll-top', function(){
		$(this).parent().find('.header-menu-scroll-overflow').stop();
	});

	//header menu item mouseover in desktop mode
	var menuTimeout, menuAjaxFinish = 0;	

	$(document).on('mouseenter', '.header-menu-column a', function(e){

		if(!_isresponsive){
			if(menuAjaxFinish) return false;
			clearTimeout(menuTimeout);

			var ajaxURL = $(this).attr('href'),
				$this = $(this),
				thisColumn = $this.closest('.header-menu-column');

			$(this).parent().find('a.hover').removeClass('hover');
			$(this).addClass('hover');

			if($(this).hasClass('submenu')){
				thisColumn.nextAll('.header-menu-column').remove();
                $('.header-menu-content').addClass('active fake-panel-visible');
				console.log(ajaxURL);
                menuTimeout = setTimeout(function(){
					menuAjaxFinish = 1;
	                $.ajax({
						type:"GET",
						async:false,
						url: ajaxURL,
						success:function(response){							
							$($.parseHTML(response)).insertAfter(thisColumn);
	                        $('.header-menu-content').removeClass('fake-panel-visible');
							menuAjaxFinish = 0;

							jQuery('.submenu').on('click', function (e) {
								e.preventDefault();
							});
						}
					});
				}, 100);
			} else {
				thisColumn.nextAll('.header-menu-column').remove();
                $('.header-menu-content').removeClass('fake-panel-visible');
			}
		}
	});

	//header menu item click in responsive mode
	$(document).on('click', '.header-menu-column a', function(e){
		if(_isresponsive){
			if(menuAjaxFinish) return false;
			var ajaxURL = $(this).attr('href'),
				$this = $(this),
				thisColumn = $this.closest('.header-menu-column');

			thisColumn.find('.hover').removeClass('hover');
			$(this).addClass('hover');
			if($(this).hasClass('submenu')){
				e.preventDefault();
				thisColumn.nextAll('.header-menu-column').remove();	
				menuAjaxFinish = 1;
				$.ajax({
					type:"GET",
					async:false,
					url: ajaxURL,
					success:function(response){
						$($.parseHTML(response)).insertAfter(thisColumn);
                        setTimeout(function(){$('.header-menu-column').last().addClass('active');},0);
						menuAjaxFinish = 0;
					}
				});
			}
		}
	});

	//header menu item click back in responsive mode
	$(document).on('click', '.header-menu .menu-back-wrapper', function(){
		var $this = $(this),
			thisColumn = $this.closest('.header-menu-column');
		thisColumn.removeClass('active').find('.hover').removeClass('hover');
		if(thisColumn.is(':first-child')) $('.header-menu-close').click();
	});


	// CATEGORIES SLIDE MENU
	// ===============================================================================================================================

	//click on category thumbnail (in desktop sliding block below, in responsive sliding panel from the left)
    $('.category-entry').on('click', function(e){
    	e.preventDefault();
    	var ajaxURL = $(this).attr('href'),
			$this = $(this),
			thisRow = $this.closest('.categories-row'),
			thisRowNext = thisRow.next('.category-row-description-wrapper');

    	if(!_isresponsive){
    		if(menuAjaxFinish) return false;

	    	if($(this).hasClass('active')){
	    		$('.category-row-description-wrapper:visible').slideUp(function(){
	    			$('.category-entry').removeClass('active');
	    		});
	    	}
	    	else{
	    		$.ajax({
	    			type:"GET",
	    			async:false,
	    			url: ajaxURL,
	    			success:function(response){
	    				if(thisRowNext.is(':visible')){
		    				thisRowNext.slideUp(function(){
		    					thisRowNext.find('.category-row-description').html($($.parseHTML(response)));
	    						$('.category-entry').removeClass('active');
    							$this.addClass('active');
		    					thisRowNext.slideDown(function(){
		    						menuAjaxFinish = 0;
		    					});
		    				});
			    		}
			    		else{
			    			$('.category-row-description-wrapper:visible').slideUp();
				    		thisRowNext.find('.category-row-description').html($($.parseHTML(response)));
	    					$('.category-entry').removeClass('active');
    						$this.addClass('active');
		    				thisRowNext.slideDown(function(){
		    					menuAjaxFinish = 0;
		    				});
			    		}
	    			}
	    		});
	    	}
	    }
	    else{
	    	if(menuAjaxFinish){
                return false;
			}

	    	$.ajax({
	    		type:"GET",
	    		async:false,
	    		url: ajaxURL,
	    		success:function(response){
	    			thisRowNext.addClass('active');
	    			$('html').addClass('rw-overflow-hidden');
	    			thisRowNext.find('.category-row-description').html($($.parseHTML(response)));
	    			setTimeout(function(){thisRowNext.find('.menu-column:last-child').addClass('active');}, 0);
	    			menuAjaxFinish = 0;
	    		}
	    	});
	    }
    });

    //click on category link (in desktop sliding block below, in responsive sliding panel from the left)
    $(document).on('click', '.category-row-description .bottom a', function(e){

		var ajaxURL = $(this).attr('href'),
			$this = $(this),
			thisColumn = $this.closest('.category-row-description');

		thisColumn.find('.active').removeClass('active');
		$(this).addClass('active');

		if($this.hasClass('submenu')){
			e.preventDefault();

	    	if(!_isresponsive){
	    		if(menuAjaxFinish) return false;

		    	if($this.hasClass('submenu')){
			    	menuAjaxFinish = 1;
			    	$.ajax({
			    		type:"GET",
			    		async:false,
			    		url: ajaxURL,
			    		success:function(response){
			    			thisColumn.slideUp(function(){
								thisColumn.html($.parseHTML(response)).slideDown(function(){
			    					menuAjaxFinish = 0;
			    				});
			    			});
			    		}
			    	});
		    	}
		    } else {

		    	if(menuAjaxFinish) return false;

		    	$.ajax({
		    		type:"GET",
		    		async:false,
		    		url: ajaxURL,
		    		success:function(response){
						thisColumn.html($.parseHTML(response));
						thisColumn.find('.menu-column:last-child').addClass('active');
						menuAjaxFinish = 0;
		    		}
		    	});
		    }
		}
    });

    //click on back button in panel in responsive mode
    $(document).on('click', '.category-row-description .menu-back-wrapper', function(){
		var $t = $(this);
		$t.closest('.menu-column').removeClass('active').find('.active').removeClass('active');
		if($t.closest('.menu-column').is(':first-child')) $('.category-row-description-wrapper-close').click();
	});

    //click that closes panels in responsive mode
	$('.category-row-description-wrapper-close').on('click', function(){
		$('.category-row-description-wrapper').removeClass('active');
		$('.category-row-description-wrapper .menu-column').removeClass('active').find('.active').removeClass('active');
		$('html').removeClass('rw-overflow-hidden');
	});

	// ===============================================================================================================================

	//header sliding elements in responsive mode
    $('.open-responsive-slide').on('click', function(){
    	$('.responsive-slide[data-rel="'+$(this).data('rel')+'"]').addClass('active');
    });

    $('.responsive-slide .close-button-wrapper .button, .responsive-slide-close-layer').on('click', function(){
    	$('.responsive-slide').removeClass('active');
    });

	//tabs
	$(document).on('click', '.tab-menu', function() {
        var $this = $(this),
        	menuItemActive = $(this).closest('.tabs-block').find('.tab-menu.active').eq(0),
        	menuWrapper = menuItemActive.parent(),
        	tabActive = $(this).closest('.tabs-block').find('.tab-entry:visible').eq(0),
        	tabWrapper = tabActive.parent();

        menuWrapper.find('.tab-menu.active').removeClass('active');
        $(this).addClass('active');
        $(this).closest('.tab-menu-wrapper').removeClass('active').find('.title').text($(this).text());
        var thisIndex = menuWrapper.find('> .tab-menu').index(this);

        tabActive.hide();
        tabWrapper.find('> .tab-entry').eq(thisIndex).show();
        _functions.scrollCall();
        //swipers['swiper-'+tab.find('.swiper-container').attr('id')].update();
    });

    $(document).on('click', '.popup-tabs .title', function(){
    	$(this).closest('.popup-tabs').toggleClass('active');
    	return false;
    });

	//animated scrolling to block
    $(document).on('click', '.scroll-to-link', function(){
    	$('body, html').animate({'scroll-top':$('.scroll-to-block[data-rel="'+$(this).data('rel')+'"]').offset().top - $('header').height()});
    	return false;
    });

    //toggle all rows in table in responsive mode
    $(document).on('click', '.toggle-max-height', function(){
    	//$(this).closest('.main-table-max-height').toggleClass('active');
    	//return false;
    });

    //sidebar menu in responsive mode
    $(document).on('click', '.sidebar-title', function(){
    	$(this).toggleClass('active').next().slideToggle();
    	return false;
    });

	function open_popup(rel) {
		$('.popup-content').removeClass('active');
		var win = $('.popup-wrapper, .popup-content[data-rel="'+rel+'"]').addClass('active');
		popup_arr.push(win);
		$('html').addClass('overflow-hidden');
	}

    $(document).on('click', '.open-static-popup', function(){
        open_static_popup($(this).data('rel'));
        return false;
    });

    function open_static_popup(rel) {
        $('.popup-content').removeClass('active');
        var win = $('.popup-wrapper, .popup-content[data-rel="'+rel+'"]').addClass('active');
        popup_arr.push(win);
        $('html').addClass('overflow-hidden');
    }

    //open and close popup
	var popup_arr = [];
	$(document).on('click', '.open-popup', function(){
		open_popup($(this).data('rel'));
		return false;
	});

	$('.popup-content[autoload]').each(function () {
		open_popup($(this).data('rel'));
	})

    $('.close-pop-btn').click(function () {
        $('.close-popup').click();
    });

	$(document).on('click', '.popup-wrapper .close-popup', function(){
		$('.popup-wrapper, .popup-content').removeClass('active');
		popup_arr.pop();
		if (popup_arr.length > 0) {
			popup_arr[popup_arr.length - 1].addClass('active');
		} else {
			$('html').removeClass('overflow-hidden');
		}

        //scrollCall();
		return false;
	});

	//video popup
	$('.open-video').on('click', function(){
		var $t = $(this);
		$('.video-popup').addClass('active');
		setTimeout(function(){
			$('.video-popup .video-container').html('<iframe class="full-size" src="'+$t.data('src')+'"></iframe>');
		}, 300);
		return false;
	});

	$('.video-popup .close-video').on('click', function(){
		var $t = $(this);
		$('.video-popup').removeClass('active');
		setTimeout(function(){
			$('.video-popup .video-container').html('');
		}, 300);
		return false;
	});

	$(document).on('click', '.smile-button span', function(){
		$(this).parents('form')[0]['Comment[rating]'].value = $(this).attr('value');
	});

	//table testimonials block
	$(document).on('click', '.toggle-table-testimonial', function(){
		$(this).toggleClass('text-toggle');
		$(this).closest('tr').next('.table-testimonial').toggleClass('active');
		_functions.scrollCall();
		return false;
	});

	//remove photo upload
	$(document).on('click', '.remove-upload', function(){
		$($(this).attr("holder")).html('');
		$($(this).attr("target"))[0].value="";
		return false;
	});

	//sliding filters column
	$(document).on('click', '.filters-toggle-button .button', function(){
		$(this).toggleClass('text-toggle').closest('.filters-column').find('.filters-toggle').slideToggle();
		return false;
	});

	$(document).on('change', '.filters-title', function(){
		//alert(this.checked);
		var checked=this.checked;
        $(this).closest('.filters-column').find('.filter-entry input[type="checkbox"]').each(function(){
            if(checked) this.setAttribute("checked","checked");
            else this.removeAttribute("checked"); this.checked=checked;
        });
        $(this).closest('.filters-column').find('.filter-arrow')[checked?"addClass":"removeClass"]("active");
		//if($(this).is(':checked')) $(this).closest('.filters-column').find('input[type="checkbox"]').click();
		//else $(this).closest('.filters-column').find('input[type="checkbox"]').click();
	});

	// accordeon
	$(document).on('click', '.accordeon-title', function(){
		if(!$(this).next('.accordeon-toggle').is(':visible')) /*$('body, html').animate({'scrollTop':$(this).offset().top - $('header').height()})*/;
		$(this).toggleClass('active').next('.accordeon-toggle').slideToggle(function(){
        	_functions.scrollCall();
		});
		return false;
	});

	// testimonials
	$(document).on('click', '.cloud-edit', function(){
		$(this).closest('.cloud-edit-wrapper').hide().prev('.cloud-save-wrapper').show();
	});

	$(document).on('click', '.cloud-save', function(){
		$(this).closest('.cloud-save-wrapper').hide().next('.cloud-edit-wrapper').show();
	});
	/*contact*/
	$('.toggle-contact-panel, .new-page-contact-close').on('click', function(){
		$(this).closest('.new-page-contact-panel').toggleClass('active');
		return false;
	});
/*slider*/
	$('.swiper-tab-entry').on('click', function(){
		swipers['swiper-'+$(this).closest('.swiper-entry').find('.swiper-container').attr('id')].slideTo($(this).parent().find('.swiper-tab-entry').index(this));
	});
	// autocomplete
	$(document).on('focus', '.inline-form input', function(){
		$(this).next('.autocomplete').show();
		clearTimeout(hideTimeout);
	});

	var hideTimeout = 0;

	$(document).on('blur', '.inline-form input', function(){
		var $this = $(this);
		hideTimeout = setTimeout(function(){
			$this.next('.autocomplete').hide();
		}, 500);
	});

	$('.close-sidebar-search').on('click', function(){
		$('.autocomplete').hide();
		clearTimeout(hideTimeout);
	});
});











(function(Function_prototype) {
 Function_prototype.debounce = function(delay, ctx) {
        var fn = this, timer;
        return function() {
            var args = arguments, that = this;
            clearTimeout(timer);
            timer = setTimeout(function() {
                fn.apply(ctx || that, args);
            }, delay);
        };
    };

})(Function.prototype);

window.addEventListener('DOMContentLoaded', function() {
 var input = document.getElementById("ac");

 function test() {
 var val = document.getElementById("ac").value;
        jQuery.ajax({
            url: '/site/search',
            type: 'post',
            data: {
                search: val
            },
        }).done(function (data) {
           jQuery('.autocomplete').html(data);
            var li = $('.autocomplete li');
            
            li.each(function(e) {
                var title = $(this).find('.title').text().toLowerCase(),
                    str = '',
                    newStr = '<strong>' + val + '</strong>';

                str += title.replace(val, newStr);

                $(this).find('.title').html(str);
            });       
            
            jQuery('.autocomplete a').mousedown(function () {
                location.href = this.href;
            })
        });    
    
    
 }

 if (input != null) input.addEventListener('input', test.debounce(500));
 });
