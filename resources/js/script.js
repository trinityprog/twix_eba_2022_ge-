import $ from "jquery";
import Cookies from 'js-cookie';
import SimpleBar from 'simplebar';
import Dropzone from 'dropzone';
import { Swiper, Navigation, Autoplay } from 'swiper';
import Alpine from 'alpinejs';


Swiper.use([Navigation, Autoplay]);
window.Alpine = Alpine;
window.$ = $;
window.jQuery = $;
window.Swiper = Swiper;

require('remodal');
require('inputmask');
require('@fancyapps/fancybox/dist/jquery.fancybox.min');

let getLocale = () => { return document.querySelector('html').attributes.lang.value }
let isDesktopScreen = () => { return window.innerWidth > 1200 }

document.addEventListener('DOMContentLoaded', () => {
    let ageFilter = $('[data-remodal-id="age-filter"]').remodal({ closeOnOutsideClick: false, hashTracking: false });

    let cookie = parseInt(Cookies.get('mature'));

    if(cookie === 1 && window.location.pathname != "/restricted" ||
        cookie === 0 && window.location.pathname == "/restricted") {
    }
    else if(cookie === 1 && window.location.pathname == "/restricted") {
        window.open("/", "_self");
    }
    else if(cookie === 0 && window.location.pathname != "/restricted") {
        ageFilter.open();
    }
    else {
        ageFilter.open();
    }

    let remodal = document.querySelector('[data-remodal-id="age-filter"]');

    if (remodal) {
        remodal.querySelectorAll('.btn').forEach( el => {
            el.addEventListener('click', function(){
                let value = parseInt(el.dataset.value);
                Cookies.set('mature', value);
                if(value === 1){
                    ageFilter.close();
                }
                else{
                    window.open("/restricted", "_self");
                }
            });
        });

    }


    $(remodal).find('.promise').click( function () {
        $(remodal).find('.promise_text').toggle()
    })

    let inputmaskInit = () => {
        Inputmask({
            mask: document.querySelector('meta[name=inputmask]').attributes.content.value,
            onUnMask: (maskedValue) => {
                return maskedValue.replaceAll(/\s/g,'');
            },
            clearIncomplete: true,
            removeMaskOnSubmit: true
        }).mask(document.querySelectorAll('input[type=tel]'))
    }

    inputmaskInit()

    window.addEventListener('componentRender', event => {
        inputmaskInit()
    })

    document.querySelector('.menu-toggle').addEventListener('click', e => {
        e.preventDefault()
        document.querySelector('header').classList.toggle('toggled')
    })

    if (isDesktopScreen()) {

    } else {

    }


    let getUrlParameter = function getUrlParameter(sParam) {
        let sPageURL = window.location.search.substring(1),
            sURLVariables = sPageURL.split('&'),
            sParameterName,
            i;

        for (i = 0; i < sURLVariables.length; i++) {
            sParameterName = sURLVariables[i].split('=');

            if (sParameterName[0] === sParam) {
                return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
            }
        }
        return false;
    };

    $(document).on('opened', '[data-remodal-id=register-submit]', function () {
        let phone = getUrlParameter('phone').replace(/\s/g, '')

        console.log('register-submit is opened');
        console.log(phone);

        gtag('event', 'register', {
            'event_category': 'register',
            'event_label': phone,
            'value': 1,
        });
    });

    window.addEventListener('start-test', event => {
        let phone = event.detail.phone.replace(/\s/g, '')

        console.log('start-test');
        console.log(phone);


        gtag('event', 'start-test', {
            'event_category': 'quiz_1',
            'event_label': phone,
            'value': 1,
        });
    });

    window.addEventListener('finish-test', event => {
        let phone = event.detail.phone.replace(/\s/g, '')

        console.log('finish-test');
        console.log(phone);


        gtag('event', 'complete_game', {
            'event_category': 'quiz_1',
            'event_label': phone,
            'value': 1,
        });
    });

    window.addEventListener('prize', event => {
        let phone = event.detail.phone.replace(/\s/g, '')
        let prize_id = event.detail.prize_id

        console.log('prize');
        console.log(phone);
        console.log(prize_id);


        gtag('event', 'prize', {
            'event_category': prize_id,
            'event_label': phone,
            'value': 1,
        });
    });

    window.addEventListener('login', event => {
        let phone = event.detail.phone.replace(/\s/g, '')

        console.log('login');
        console.log(phone);


        gtag('event', 'login', {
            'event_category': 'login',
            'event_label': phone,
            'value': 1,
        });
    });

    window.addEventListener('send-sms', event => {
        let phone = event.detail.phone.replace(/\s/g, '')
        let type = event.detail.type

        console.log('login');
        console.log(phone);


        gtag('event', 'send_sms', {
            'event_category': type,
            'event_label': phone,
            'value': 1,
        });
    });

    $(document).on('opened', '[data-remodal-id=check-success]', function () {
        if ($(this).find('[name=type]').val() == 'confirm') return;
        let phone = $(this).find('[name=phone]').val().replace(/\s/g, '')

        console.log('scan_check');
        console.log(phone);

        gtag('event', 'scan_check', {
            'event_category': 'scan',
            'event_label': phone,
            'value': 1,
        });
    });

    Alpine.start();
})

window.index = () => {
    const rulesSwiper = new Swiper('#rules-swiper', {
        // Optional parameters
        loop: true,
        slidesPerView: 1,
        autoplay: {
            delay: 3000,
        },

        // Navigation arrows
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },

        on: {
            slideChange: (swiper) => {
                $('#rules-swiper').parent().children('.bg').removeClass('rotate_bg')
                if(swiper.activeIndex % 2 == 1) {
                    $('#rules-swiper').parent().children('.bg').addClass('rotate_bg')
                }
            }
        }

    })

    let images = document.querySelectorAll('div.choose-block img.choose')
    let cursor = document.querySelector('img.cursor')
    let counter = 0
    let distance = 250
    let animation_cursor = () => {
        counter++
        images.forEach((el, i) => {
            el.classList.remove('active')

            if (counter % 2 === i) {
                el.classList.add('active')
                cursor.style.transform = 'translateX(' + (i * distance) + '%)'
            }
        })
    }

    $('#go-up').click(function (e) {
        e.preventDefault()

        $('html, body').animate({
            scrollTop: 0
        }, 800);
    });

    setInterval(() => animation_cursor(), 1700)

    document.querySelectorAll('.menu-nav li:not(.go-wrapper) > a.scroll-to').forEach(el => {
        el.addEventListener('click', (e) => {
            e.preventDefault()
            document.querySelector('header').classList.toggle('toggled')

            $('html, body').animate({
                scrollTop: $(e.target.hash).position().top
            }, 800);
        })
    })
}

window.check_register = () => {
    Inputmask({
        mask: '99.99.9999',
        clearIncomplete: true,
    }).mask(document.querySelectorAll('input[name=date]'))

    Inputmask({
        mask: '99:99',
        clearIncomplete: true,
    }).mask(document.querySelectorAll('input[name=time]'))


    Dropzone.autoDiscover = false;

    let dz_start = "";
    let dz_wrongformat = "";
    let dz_morethatone = "";
    let dz_selected = "";
    let dz_loading = "";


    if(getLocale() == "ru")
    {
        dz_start = "Перетяни в эту область фото (скан) чека<br>или нажми, чтобы выбрать файл с<br>устройства";
        dz_wrongformat = "Неправильный формат файла!";
        dz_morethatone = "Вы не можете загрузить больше 1 файла";
        dz_selected = "Выбран файл: <br>";
        dz_loading = "<span>Загрузка...</span>";
    } else {
        dz_start = "Осы аймаққа чектің суретін (сканын)<br>алып кел немесе құрылғыдан<br>файл таңдау үшін бас";
        dz_wrongformat = "Файл пішімі дұрыс емес!";
        dz_morethatone = "Бірден көп файл жүктей алмайсыз";
        dz_selected = "Сіз таңдағаң файлыңыз:";
        dz_loading = "<span>Жүктеу...</span>";
    }

    let img = $('.dz-message .icon')

    let dropzone = new Dropzone('#dropzone', {
        paramName: 'image',
        autoProcessQueue: false,
        addRemoveLinks: false,
        maxFiles: 1,
        resizeWidth: 1000,
        dictInvalidFileType: '' + dz_wrongformat,
        dictMaxFilesExceeded: '' + dz_morethatone,
        acceptedFiles: '.png, .jpg, .jpeg',
        createImageThumbnails: false,
        previewsContainer: false,
        accept: (file, done) => {
            img.removeClass('error');
            $('.dz-message .icon').hide()
            $('.message span').html(file.name).css('color', '#4c0901')
            $('.message span:first-child').html('' + dz_selected).css('color', '#4c0901')
            $('.btn-catch').removeClass('disabled')
            done()
        },
        sending: () => {
            img.removeClass('error');
            $('.message span').html('')
            $('.message span:first-child').html(dz_loading)
        },
        success: (file, response) => {
            location.href = response.url
        },
        error: (file, response) => {
            Object.keys(response.errors).forEach(function(key) {
                $('input[name=' + key + ']').addClass('error')
                $('input[name=' + key + ']').siblings('span').text(response.errors[key][0])
            });
            img.show()
            img.addClass('error');
            $('.message span:first-child').html(dz_start).css('color', '#ed1c24');
            $('.send-dropzone').addClass('disabled');
            dropzone.removeAllFiles();
        },

    });


    $('.btn-catch').on('click', function(e){
        e.preventDefault();
        dropzone.processQueue();
    });

    $('[data-remodal-id=check-success]').on('closing', function () {
        location.reload()
    })
}
 window.testuser = () => {
     let images = document.querySelectorAll('.test-start div.choose-block img.choose')
     let cursor = document.querySelector('img.cursor')
     let counter = 0
     let distance = 250
     let animation_cursor = () => {
         counter++
         images.forEach((el, i) => {
             el.classList.remove('active')

             if (counter % 2 === i) {
                 el.classList.add('active')
                 cursor.style.transform = 'translateX(' + (i * distance) + '%)'
             }
         })
     }

     let animation_cursor_interval = setInterval(() => animation_cursor(), 1700)

     window.addEventListener('stop-animation', event => {
         clearInterval(animation_cursor_interval);
     });
 }

 window.test_result = () => {
    if($('.tab[data-id=1]').length) {
        $('.tab_nav').show()
        $('.tab[data-id=2]').addClass('active').css({
            position: 'absolute',
            top: 0
        })

        $('.tab_button').click(function () {
            let id = $(this).data('id')
            $('.tab_button').removeClass('active')
            $(this).addClass('active')
            $('.tab').removeClass('active')
            $('.tab[data-id=' + id + ']').addClass('active')
        })

        setInterval(() => {
            $('.tab').toggleClass('active');
            $('.tab_button').toggleClass('active')
        }, 6000)
    }
}
