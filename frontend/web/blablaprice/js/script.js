/* CLOSE POPUP ALL
---------------------------------------------- */
function closePopupAll() {
    const btnClose = document.querySelectorAll('.close-popup-all');
    const overlay = document.querySelector('.popup-wrapper');

    btnClose.forEach(btn => {
        btn.onclick = (e) => {
            e.target.closest('.popup-content').classList.remove('active');
            overlay.classList.remove('active');
            document.querySelector('html').classList.remove('overflow-hidden');
        }
    });
}

closePopupAll();

/* GLOBAL FUNCTIONS
---------------------------------------------- */
function setCookie(name, value, options) {
    options = options || {};

    var expires = options.expires;

    if (typeof expires == "number" && expires) {
      var d = new Date();
      d.setTime(d.getTime() + expires * 1000);
      expires = options.expires = d;
    }
    if (expires && expires.toUTCString) {
      options.expires = expires.toUTCString();
    }

    value = encodeURIComponent(value);

    var updatedCookie = name + "=" + value;

    for (var propName in options) {
      updatedCookie += "; " + propName;
      var propValue = options[propName];
      if (propValue !== true) {
        updatedCookie += "=" + propValue;
      }
    }

    document.cookie = updatedCookie;
}

function getCookie(name) {
    var matches = document.cookie.match(new RegExp(
        "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
    ));
    return matches ? decodeURIComponent(matches[1]) : undefined;
}

function deleteCookie(name) {
    setCookie(name, "", {
        expires: -1
    });
}

function resetCheckbox(sel) {
    const checkboxs = sel.querySelectorAll('input[type="checkbox"]');
}

deleteCookie('role');
deleteCookie('username');
deleteCookie('email');
deleteCookie('phone');

/* 01   REGISTRATION
---------------------------------------------- */
function register() {
    const popupRegister = document.querySelectorAll('.popup-register');
    const popupUser = document.querySelector('.popup-content[data-rel="registration-user"]');
    const popupSeller = document.querySelector('.popup-content[data-rel="registration-seller"]');
    const popupPhone = document.querySelector('.popup-content[data-rel="registration-user-phone"]');
    const popupErrorEmail = document.querySelector('.popup-content[data-rel="registration-user-error-email"]');
    const popupErrorEmailSeller = document.querySelector('.popup-content[data-rel="registration-seller-error-email"]');
    const popupPhoneActive = document.querySelector('.popup-content[data-rel="registration-user-active-phone"]');
    const popupUserSuccess = document.querySelector('.popup-content[data-rel="registration-user-success"]');
    const popupSellerSuccess = document.querySelector('.popup-content[data-rel="registration-seller-success"]');
    const popupErrorCode = document.querySelector('.popup-content[data-rel="registration-user-error-active-phone"]');

    popupRegister.forEach(popup => {
        const radios = popup.querySelectorAll('[type="radio"]');

        // реєстрація при запросі
        if (location.href.indexOf('filter?id=') != -1) {
            popup.querySelector('.switch-role .radio:last-child').remove();
        }

        radios.forEach(radio => {
            radio.onchange = function() {
                const form = this.closest('form');
                const wrapSubmit = form.querySelectorAll('.wrap-submit');

                setCookie('role', this.value);

                if (this.value == 1) {
                    wrapSubmit[0].classList.add('active');
                    wrapSubmit[1].classList.remove('active');
                } else if (this.value == 2) {
                    wrapSubmit[0].classList.remove('active');
                    wrapSubmit[1].classList.add('active');
                }
            }
        });
    });    

    // popup role
    popupRegister.forEach(popupRegister => {
        popupRegister.querySelector('[type="submit"]').onclick = function(e) {
            const role = popupRegister.querySelector('[type="radio"]:checked');
            setCookie('role', role.value);
        }
    }); 

    // popup user   
    popupUser.querySelector('[type="submit"]').onclick = function(e) {
        e.preventDefault();

        popupUser.classList.add('preloader');

        const username = popupUser.querySelector('#signupform-username');
        const email = popupUser.querySelector('#signupform-email');

        setCookie('username', username.value);
        setCookie('email', email.value);

        const xml = new XMLHttpRequest();
        xml.open('POST', '/user/change');
        xml.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xml.send('email=' + email.value);
        xml.onload = function(e) {
            if (xml.readyState == 4 && xml.status == 200) {
                popupUser.classList.remove('preloader');

                if (!xml.response) {
                    popupUser.classList.remove('active');
                    popupPhone.classList.add('active');
                } else {
                    popupUser.classList.remove('active');
                    popupErrorEmail.classList.add('active');
                }
            }
        }
    }

    // popup seller
    popupSeller.querySelector('[type="submit"]').onclick = function(e) { 
        e.preventDefault();

        popupSeller.classList.add('preloader');

        const username = popupSeller.querySelector('#signupform-username').value;
        const email = popupSeller.querySelector('#signupform-email').value;
        const role = getCookie('role');

        const xml = new XMLHttpRequest();
        xml.open('POST', '/user/change');
        xml.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xml.send('email=' + email);
        xml.onload = function(e) {
            if (xml.readyState == 4 && xml.status == 200) {
                if (xml.response) {
                    popupSeller.classList.remove('preloader');
                    popupSeller.classList.remove('active');
                    popupSellerSuccess.classList.remove('active');
                    popupErrorEmailSeller.classList.add('active');
                } else {
                    const xml = new XMLHttpRequest();
                    xml.open('POST', '/user/register');
                    xml.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    xml.send('role=' + role + '&username=' + username + '&email=' + email);
                    xml.onload = function(e) {
                        if (xml.readyState == 4 && xml.status == 200) {
                            popupSeller.classList.remove('active');
                            popupSeller.classList.remove('preloader');
                            popupSellerSuccess.classList.add('active');
                            let btns = popupSellerSuccess.querySelectorAll('.redirect-cabinet');

                            for (let i = 0; i < btns.length; i++) {
                                btns[i].onclick = function(e) {
                                    let xml = new XMLHttpRequest();
                                    xml.open('POST', '/user/auth');
                                    xml.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                                    xml.send('role=' + role + '&username=' + username + '&email=' + email);
                                    xml.onload = function(e) {
                                        if (xml.readyState == 4 && xml.status == 200) {
                                            window.location.href = '/cabinet/order'
                                        }
                                    }
                                }
                            }

                            deleteCookie('role');
                        }
                    }
                }
            }
        }        
    }    

    // popup phone
    popupPhone.querySelector('[type="submit"]').onclick = function(e) {
        e.preventDefault();

        popupPhone.classList.add('preloader');

        const tel = popupPhone.querySelector('#signupform-phone');

        const xml = new XMLHttpRequest();
        xml.open('POST', '/user/send-phone-code');
        xml.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xml.send('phone=' + tel.value);
        xml.onload = function(e) {
            if (xml.readyState == 4 && xml.status == 200) {
                popupPhone.classList.remove('preloader');
                if (xml.response) {
                    setCookie('code', xml.response);
                    setCookie('phone', tel.value);
                } else {
                    setCookie('code', false);
                }
            }
        }
    }
    
    // active phone
    popupPhoneActive.querySelector('[type="submit"]').onclick = function(e) {
        e.preventDefault();

        popupPhoneActive.classList.add('preloader');

        const code = getCookie('code');
        const curCode = popupPhoneActive.querySelector('#signupform-code');

        if (code === curCode.value) {
            const role = getCookie('role');
            const username = getCookie('username');
            const email = getCookie('email');
            const phone = getCookie('phone');

            const xml = new XMLHttpRequest();
            xml.open('POST', '/user/register');
            xml.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xml.send('role=' + role + '&username=' + username + '&email=' + email + '&phone=' + phone);
            xml.onload = function(e) {
                if (xml.readyState == 4 && xml.status == 200) {
                    popupPhoneActive.classList.remove('preloader');
                    popupPhoneActive.classList.remove('active');
                    popupUserSuccess.classList.add('active');

                    let btns = popupUserSuccess.querySelectorAll('.redirect-cabinet');

                    for (let i = 0; i < btns.length; i++) {
                        btns[i].onclick = function(e) {
                            const xml = new XMLHttpRequest();
                            xml.open('POST', '/user/auth');
                            xml.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                            xml.send('role=' + role + '&username=' + username + '&email=' + email);
                            xml.onload = function(e) {
                                if (xml.readyState == 4 && xml.status == 200) {
                                    // реєстрація при запросі
                                    if (location.href.indexOf('filter?id=') != -1 && role == 1) {
                                        let formData = new FormData(document.forms.filter);

                                        const xml = new XMLHttpRequest();
                                        xml.open('POST', location.href);
                                        xml.send(formData);
                                    }
                                    
                                    window.location.href = '/cabinet/order';                                    
                                }
                            }
                        }
                    }

                    deleteCookie('role');
                    deleteCookie('username');
                    deleteCookie('email');
                    deleteCookie('phone');
                }
            }
        } else {
            popupPhoneActive.classList.remove('preloader');
            popupPhoneActive.classList.remove('active');
            popupErrorCode.classList.add('active');
        }
    }  
}

if (document.querySelector('[data-rel="registration"]') != null) register();

/* 02   REGISTRATION SOCIAL
---------------------------------------------- */
function buttonSocial() {
    const btnSocial = document.querySelectorAll('.btn-social');
    const btnSubmit = document.querySelectorAll('#login-form .login-ajax');

    btnSocial.forEach(btn => {
        btn.addEventListener('click', function(e) {
            // реєстрація при запросі
            if (location.href.indexOf('filter?id=') !== -1) {
                let formData = new FormData(document.forms.filter);
                formData.append('link', document.forms.filter.getAttribute('action'));
                let object = {};
                formData.forEach((value, key) => {
                    if(!Reflect.has(object, key)){
                        object[key] = value;
                        return;
                    }
                    if(!Array.isArray(object[key])){
                        object[key] = [object[key]];    
                    }
                    object[key].push(value);
                });

                let json = JSON.stringify(object);
                setCookie('filter', json, {'path':'/','max-age': 3600});
            }
        });
    });

    btnSubmit.forEach(btn => {
        btn.addEventListener('click', function(e) {
            // реєстрація при запросі
            if (location.href.indexOf('filter?id=') !== -1) {
                let formData = new FormData(document.forms.filter);
                formData.append('link', document.forms.filter.getAttribute('action'));
                let object = {};
                formData.forEach((value, key) => {
                    if(!Reflect.has(object, key)){
                        object[key] = value;
                        return;
                    }
                    if(!Array.isArray(object[key])){
                        object[key] = [object[key]];
                    }
                    object[key].push(value);
                });

                let json = JSON.stringify(object);
                setCookie('filter', json, {'path':'/','max-age': 3600});
            }
        });
    });
}

buttonSocial();

function registerSocial() {    
    const register = document.querySelector('.popup-register[data-rel="registration-social"]');
    const submit = register.querySelectorAll('input.button');
    const form = register.querySelector('form');

    // реєстрація при запросі
    if (getCookie('filter')) {
        register.querySelector('.switch-role .radio:last-child').remove();
    }

    submit.forEach(submit => {
        submit.addEventListener('click', function() {
            let data = "role=" + form.querySelector('input[type="radio"]:checked').value
            + "&email=" + register.dataset.email;
            
            const xml = new XMLHttpRequest();
            xml.open('POST', '/site/set-role-user');
            xml.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xml.send(data);
            xml.onload = function(e) {
                if (xml.readyState == 4 && xml.status == 200) {
                    // реєстрація при запросі
                    if (xml.response) {
                        let data = JSON.parse(xml.response);
                        let formData = new FormData();

                        for (key in data) {
                            formData.append(key, data[key]);
                        }

                        const xhr = new XMLHttpRequest();
                        xhr.open('POST', data.link);
                        xhr.send(formData);
                        deleteCookie('filter');
                    }

                    window.location.href = '/cabinet/order';
                }
            }
        });
    });   
}

if (document.querySelector('[data-rel="registration-social"]') != null) registerSocial();

/* 03   ACTIVATION PHONE
---------------------------------------------- */
function activationPhoneUser() {
    const popupPhone = document.querySelector('.activation-phone');
    const popupPhoneActive = document.querySelector('.popup-content[data-rel="registration-user-active-phone"]');
    const popupErrorCode = document.querySelector('.popup-content[data-rel="registration-user-error-active-phone"]');

    // popup phone
    popupPhone.querySelector('[type="submit"]').onclick = function(e) {
        e.preventDefault();

        popupPhone.classList.add('preloader');

        const tel = popupPhone.querySelector('#signupform-phone');

        const xml = new XMLHttpRequest();
        xml.open('POST', '/user/send-phone-code');
        xml.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xml.send('phone=' + tel.value);
        xml.onload = function(e) {
            if (xml.readyState == 4 && xml.status == 200) {
                popupPhone.classList.remove('preloader');
                if (xml.response) {
                    setCookie('code', xml.response);
                    setCookie('phone', tel.value);
                } else {
                    setCookie('code', false);
                }
            }
        }
    }

    // active phone
    popupPhoneActive.querySelector('[type="submit"]').onclick = function(e) {
        e.preventDefault();

        popupPhoneActive.classList.add('preloader');

        const code = getCookie('code');
        const curCode = popupPhoneActive.querySelector('#signupform-code');

        if (code === curCode.value) {
            const phone = getCookie('phone');
            const email = popupPhoneActive.dataset.email;

            const xml = new XMLHttpRequest();
            xml.open('POST', '/user/activation-phone');
            xml.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xml.send('phone=' + phone + '&email=' + email);
            xml.onload = function(e) {
                if (xml.readyState == 4 && xml.status == 200) {
                    deleteCookie('phone');
                    deleteCookie('code');
                    if (xml.response) location.href = location.href;
                }
            }
        } else {
            popupPhoneActive.classList.remove('preloader');
            popupPhoneActive.classList.remove('active');
            popupErrorCode.classList.add('active');
        }
    }  
}

if (document.querySelector('.activation-phone') != null) activationPhoneUser();

/* 04   AUTH
---------------------------------------------- */
function loginIn() {
    const popupLogin = document.querySelector('.popup-content[data-rel="account-login"]');
    const form = popupLogin.querySelector('form');
    let flag = true;

    form.onsubmit = (e) => {
        e.preventDefault();
        e.stopPropagation();

        if (flag) {
            flag = false;
            const email = form.querySelector('#loginform-email').value;
            const password = form.querySelector('#loginform-password').value;

            const xml = new XMLHttpRequest();
            xml.open('POST', '/site/login');
            xml.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xml.send('&email=' + email + '&password=' + password);
            xml.onload = function(e) {
                if (xml.readyState == 4 && xml.status == 200) {
                    // реєстрація при запросі
                    if (location.href.indexOf('filter?id=') != -1 && role == 1) {
                        let formData = new FormData(document.forms.filter);

                        const xml = new XMLHttpRequest();
                        xml.open('POST', location.href);
                        xml.send(formData);
                    }

                    window.location.href = '/cabinet/order';
                }
            }
        }
    }

    form.removeEventListener('submit');
}

// loginIn();

/* MAIN MENU
---------------------------------------------- */
function menu() {
    const linkAll = document.querySelectorAll('.menu-item.icon > a');
    const backAll = document.querySelectorAll('.back-menu');

    linkAll.forEach(link => {
        link.addEventListener('mouseover', (e) => {
            e.preventDefault();

            if (!e.target.parentNode.classList.contains('active')) {
                e.target.parentNode.classList.add('active');

                const ID = e.target.dataset.id;
                const params = "ID=" + ID;

                const xhr = new XMLHttpRequest();
                xhr.open('POST', '/menu/get-sub-menu');
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.send(params);
                xhr.onload = () => {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        const subMenu = e.target.parentNode.querySelector('.menu');

                        if (subMenu == null) {
                            e.target.insertAdjacentHTML('afterend', xhr.response);
                            menu();
                        }
                    }
                }
            }
        });

        link.parentNode.addEventListener('mouseout', (e) => {
            e.preventDefault();
            e.target.classList.remove('active');
        });

        /* MENU MOBILE */
        link.addEventListener('click', (e) => {
            e.preventDefault();

            if (e.target) {
                const breakpoint = window.matchMedia('(max-width: 991px)');

                if (breakpoint.matches) {
                    const parent = e.target.parentNode;
                    const sub = parent.querySelector('.sub-menu');

                    if (sub != null) {
                        sub.classList.add('show');
                    }
                }
            }
        });
    });

    backAll.forEach(back => {
        back.addEventListener('click', (e) => {
           e.preventDefault();
           e.target.parentNode.classList.remove('show');
        });
    });
}

menu();

jQuery(document).ready(function () {
    /* 03   FILTERS
    ---------------------------------------------- */
    function checkedFilter() {
        $('.filter-entry .category-submit').change(function() {
            var parent = $(this).closest('.accordeon-entry'),
                title = parent.find('.accordeon-title'),
                entri = parent.find('.filter-entry'),
                arrCheck = [],
                count = 0;

            entri.each(function() {
                var _this = $(this);

                if (_this.find('.category-submit').is(":checked")) {
                    arrCheck[count] = _this.find('.category-submit');

                    var id = _this.closest('.accordeon-entry').find('.accordeon-title').attr('data-parentid');

                    if (!_this.closest('.accordeon-entry-elem').find('.category-parent').length) {
                        _this.closest('.accordeon-entry-elem').prepend('<input type="hidden" name="primary_category[]" class="category-parent" value="' + id + '">');
                    }

                    count++;
                }
            });

            if (!title.hasClass('checked-filter')) {
                title.addClass('checked-filter');
            }

            if (arrCheck.length) {
                title.addClass('checked-filter');
            } else {
                title.removeClass('checked-filter');
                title.closest('.accordeon-entry-elem').find('.category-parent').remove();
            }
        });

        $('.filter-entry .category-submit').each(function() {
            var parent = $(this).closest('.accordeon-entry'),
                title = parent.find('.accordeon-title'),
                entri = parent.find('.filter-entry'),
                arrCheck = [],
                count = 0;

            entri.each(function() {
                var _this = $(this);

                if (_this.find('.category-submit').is(":checked")) {
                    arrCheck[count] = _this.find('.category-submit');

                    var id = _this.closest('.accordeon-entry').find('.accordeon-title').attr('data-parentid');

                    if (!_this.closest('.accordeon-entry-elem').find('.category-parent').length) {
                        _this.closest('.accordeon-entry-elem').prepend('<input type="hidden" name="primary_category[]" class="category-parent" value="' + id + '">');
                    }

                    count++;
                }
            });

            if (!title.hasClass('checked-filter')) {
                title.addClass('checked-filter');
            }

            if (arrCheck.length) {
                title.addClass('checked-filter');
            } else {
                title.removeClass('checked-filter');
                title.closest('.accordeon-entry-elem').find('.category-parent').remove();
            }
        });
    }

    checkedFilter();

    function countFilters() {
        var countFilters = $('.filter-info-fixed .filter-button-count span'),
            checkbox = $('.checkbox-entry input'),
            inputCount = $('.count-filter');

        checkbox.change(function() {
            if ($(this).is(':checked')) {
                countFilters.text(Number(countFilters.text()) + 1);
                inputCount.val(Number(inputCount.val()) + 1);
            } else {
                countFilters.text(Number(countFilters.text()) - 1);
                inputCount.val(Number(inputCount.val()) - 1);
            }
        });
    }

    countFilters();

    /* 04   AUTOCOMPLITE
    ---------------------------------------------- */
    jQuery('.main-search').keyup(function () {
        var self = this,
            val = $(self).val();

        jQuery.ajax({
            url: '/site/search',
            type: 'post',
            data: {
                search: jQuery(self).val()
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
    });

    jQuery('.main-search').on('focus', function () {
        jQuery('.autocomplete').css('display', 'block');
    });

    jQuery('.main-search').on('blur', function () {
        jQuery('.autocomplete').css('display', 'none');
    });

    /* 05   DOWNLOAD FILE
    ---------------------------------------------- */
    function downloadFileAJAX(root) {
        $('.file-upload').change(function() {
            var _this = $(this),
                form = _this.closest('form'),
                wrapFile = $('.list-files-uploaded'),
                file = this.files[0],
                formData = new FormData();

            formData.append('offerImage', file);

            $.ajax({
                url: '/cabinet/order',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    wrapFile.addClass('preloader');
                },
                success: function(data) {
                    var elem = $('<div class="item-file" data-file-path="' + data + '"><div class="img"><a data-fancybox="gallery" href="' + data + '"><img src="' + data + '"></a></div><p class="name">' + file.name + '</p><span class="delete">Видалити</span></div>').appendTo(wrapFile);
                    wrapFile.removeClass('preloader');
                    addInputHiddenFile(form, elem);
                    deleteFile();

                    if(form.find('.edit-photo-offer').length){
                        $('.edit-photo-offer img').attr('src', data);
                        $('.edit-photo-offer img').closest('.previews-row').find('.item-file').remove();
                        form.append('<input type="hidden" name="Offer[images]" value="' + data + '">');
                    }
                }
            });
        });
    }

    function addInputHiddenFile(form, elem) {
        if (!elem.find('name[images]').length) {
            elem.append('<input type="hidden" name="images[]" value="' + elem.data('file-path') + '">');
        }
    }

    function deleteFile() {
        var item = $('.item-file');
        item.each(function() {
            $(this).find('.delete').click(function() {
                $(this).closest('.item-file').remove();
                var path = $(this).closest('.item-file').data('file-path');

                $.ajax({
                    url: '/site/delete-file',
                    type: 'POST',
                    data: {path: path},
                    beforeSend: function() {
                        $('.list-files-uploaded').addClass('preloader');
                    },
                    success: function(data) {
                        $('.list-files-uploaded').removeClass('preloader');
                    }
                });
            });
        });
    }

    /* 06   PAYMENT
    ---------------------------------------------- */
    function liqPay() {
        $('#user-balance').keyup(function(e) {
            e.preventDefault();

            var price = $(this).val(),
                form = $(this).closest('form');

            $.ajax({
                url: '/cabinet/payment',
                type: 'POST',
                dataType: 'json',
                data: {price: price},
                success: function(data) {
                    form.find('input[name="data"]').remove();
                    form.find('input[name="signature"]').remove();

                    form.prepend('<input type="hidden" name="data" value="' + data.data + '">');
                    form.prepend('<input type="hidden" name="signature" value="' + data.signature + '">');
                }
            });
        });
    }

    liqPay();

    /* 08   TOOLTIP
    ---------------------------------------------- */
    function custTooltip() {
        var tooltiop = $('.cust-tooltip');

        tooltiop.each(function() {
            var input = $(this).find('input'),
                section = $(this).find('section'),
                textarea = $(this).find('textarea');

            input.focus(function() {
                $(this).closest('.cust-tooltip').find('.tooltip-content').fadeIn(300);
            });

            section.focus(function() {
                $(this).closest('.cust-tooltip').find('.tooltip-content').fadeIn(300);
            });

            textarea.focus(function() {
                $(this).closest('.cust-tooltip').find('.tooltip-content').fadeIn(300);
            });

            input.blur(function() {
                $(this).closest('.cust-tooltip').find('.tooltip-content').fadeOut(300);
            });

            section.blur(function() {
                $(this).closest('.cust-tooltip').find('.tooltip-content').fadeOut(300);
            });

            textarea.blur(function() {
                $(this).closest('.cust-tooltip').find('.tooltip-content').fadeOut(300);
            });

            input.focus(function() {
                $(this).closest('.cust-tooltip').find('.up-tooltip').fadeIn(300);
            });

            section.focus(function() {
                $(this).closest('.cust-tooltip').find('.up-tooltip').fadeIn(300);
            });

            textarea.focus(function() {
                $(this).closest('.cust-tooltip').find('.up-tooltip').fadeIn(300);
            });

            input.blur(function() {
                $(this).closest('.cust-tooltip').find('.up-tooltip').fadeOut(300);
            });

            section.blur(function() {
                $(this).closest('.cust-tooltip').find('.up-tooltip').fadeOut(300);
            });

            textarea.blur(function() {
                $(this).closest('.cust-tooltip').find('.up-tooltip').fadeOut(300);
            });
        });
    }

    custTooltip();

    /* 09   VALIDATOR FORM
    ---------------------------------------------- */
    function validatorForm(form) {
        var form = form,
            input = form.find('input'),
            error = [true],
            count = 0;

        input.each(function() {
            var _this = $(this);

            if (_this.attr('required')) {

                if (_this.val() == '') {
                    _this.addClass('focus');
                    error[count] = 'error';
                    count++;
                } else {
                    _this.removeClass('focus');
                    error.splice(count, 1);
                    count++;
                }
            }
        });

        if (error.length) {
            return false;
        } else {
            return true;
        }
    }

    function validateFormSubmit() {
        $('.validate-form').each(function() {
            $(this).submit(function(e) {

                 var form = $(this),
                     input = form.find('input'),
                     error = [true],
                     count = 0;

                 input.each(function() {
                     var _this = $(this);

                     if (_this.attr('required')) {

                         if (_this.val() == '') {
                             _this.addClass('focus');
                             error[count] = 'error';
                             count++;
                         } else {
                             _this.removeClass('focus');
                             error.splice(count, 1);
                             count++;
                         }
                     }
                 });

                 if (error.length) {
                     return false;
                 } else {
                     return true;
                 }
            });
        });
    }

    validateFormSubmit();


    /* 10   POPUPS
    ---------------------------------------------- */
    jQuery('.submenu').on('click', function (e) {
        e.preventDefault();
    });

    jQuery('*[data-href]').on('click', function () {
        var self = this;

        var href = jQuery(self).attr('data-href') + jQuery(self).attr('data-page');

        jQuery.ajax({
            url: href,
            type: 'get'
        }).done(function (data) {
            var root = jQuery("<div>").append(data);
            jQuery(jQuery(self).attr('data-target')).append(root);

            jQuery(self).attr('data-page', parseInt(jQuery(self).attr('data-page')) + 1);
            submit_form(root);
            order_popup(root);

        });

        return false;

    });

    function order_popup(root) {
        jQuery('.open-popup', root).on('click', function () {

            var id = jQuery(this).attr('data-param');
            var rel = jQuery(this).attr('data-rel');
            var root = jQuery('.popup-content[data-rel = "' + rel + '"]');
            var post_data = {id: id,}

            if (rel == 'gallery') {
                post_data['type'] = jQuery(this).attr('data-type');
            }

            if (rel == 'seller-filter') {
                var par_block = jQuery(this).closest('.filters-column');
                popup_close_callback = function () {
                    jQuery.ajax({
                        url: '/popup/sub-filter?id=' + jQuery('input', par_block).val(),
                        type: 'post'
                    }).done(function (data) {
                        par_block.html(data);
                        order_popup(par_block);
                        category_submit(par_block);
                    });
                }
            }
            root.html("");

            jQuery.ajax({
                url: '/popup/' + rel,
                type: 'post',
                data: post_data,
                beforeSend: function() {
                    root.addClass('preloader');
                },
                success: function(data) {
                    setTimeout(function() {
                        root.removeClass('preloader');
                        closePopupAll();
                    }, 300);
                }
            }).done(function (data) {

                root.html(data);
                order_popup(root);
                category_submit(root);
                submit_form(root);
                order_disable(root);
                downloadFileAJAX(root);
                custTooltip();
                validateFormSubmit();
            });

        })
    }

    function order_disable(root) {
        jQuery('.order-disable', root).on('click', function () {

            var id = jQuery(this).attr('data-order');

            jQuery.ajax({
                url: '/cabinet/order-disable',
                type: 'post',
                data: {
                    id: id,
                }
            });
        });
    }

    /* 07   EMAIL CONFIRMATION
    ---------------------------------------------- */
    jQuery('#email-unapproved').click(function () {
        sendEmailConfirmation();
    });

    function sendEmailConfirmation() {
        jQuery.ajax({
            url: '/cabinet/send-confirm-email',
            type: 'GET',
            dataType: 'json'
        }).success(function (data) {
            if (data.result) {
                var waitingBlock = '<a class="btn btn-warning btn-sm">';
                waitingBlock += '       <span class="glyphicon glyphicon-ok"></span>Очікується';
                waitingBlock += '   </a>';
                jQuery('#email-buttons-wrapper').html(waitingBlock);
            }

            if (data == true) {
                jQuery('#login-area').html('<div class="inline-align-middle"><div class="empty-space col-xs-b5"></div><div class="h5">Ви отримаєте пропозицію в особистому кабінеті</div><div class="empty-space col-xs-b5"></div></div> <div class="inline-align-middle"> <a class="button style-1 size-1 shadow submit-form" href="#"><span>Отримати пропозицію</span></a> </div>');
                jQuery('.close-popup').click();
                submit_form();
            }

        });
    }

    function category_submit(root) {
        $('.category-submit', root).on('click', function () {
            $.ajax({
                type: 'post',
                url: '/cabinet/set-category',
                data: {
                    id: this.value,
                    checked: this.checked,
                },
                success: function () {

                }
            });
        });
    }

    function submit_form(root) {
        jQuery('.submit-form', root).on('click', function () {
            jQuery(this).closest('form').submit();
        });
    }

    category_submit();
    order_popup();
    submit_form();
    order_disable();

    /* 08   CONTACT FORM
    ---------------------------------------------- */
    $('.form-contact-ajax').submit(function(e) {
        e.preventDefault();

        var form = $(this),
            data = form.serialize();

        $.ajax({
            url: '/site/contact-ajax-send',
            type: 'POST',
            data: data,
            beforeSend: function() {
                form.addClass('preloader');
            },
            success: function(data) {
                form.removeClass('preloader');
                form[0].reset();
            }
        });
    });
});
