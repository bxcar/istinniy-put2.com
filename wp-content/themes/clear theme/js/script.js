$(function () {
    $('.stars-container').rating(function (vote, event) {
        // we have vote and event variables now, lets send vote to server.
        $.ajax({
            url: "woocommerce/single-product/rating.php",
            type: "GET",
            data: {rate: vote},
        });
    });
});

$(".my-rating").starRating({
    totalStars: 5,
    initialRating: 4,
    strokeColor: '#fec71c',
    strokeWidth: 10,
    starSize: 21,
    starShape: 'rounded',
    // starSize: 25,
    emptyColor: 'lightgray',
    hoverColor: '#fec71c',
    activeColor: '#fec71c',
    useGradient: false,
    
});

$('.mgallery > span').mouseover(function () {
    var tabs = $(this).index();
    var tabItem = $('.gallery_full > .gallery_fullView');
    $(this).siblings().removeClass('active');
    $(this).addClass('active');
    $('.gallery_full').fadeOut(300, function () {
        tabItem.removeClass('active');
        tabItem.eq(tabs).addClass('active');
        $(this).fadeIn(300);
    });
});

$('[data-fancybox="gallery"]').fancybox({
    // Options will go here
});
$(function () {
    var button = $('.characters .toggler'),
        animateTime = 150;

    $(button).click(function () {
        reset(animateTime);
        $('.characters .toggler').text("развернуть");

        var text = $(this).parent().find('div.characters-item');
        if (text.height() === 150) {
            autoHeightAnimate(text, animateTime);
            $(this).text("свернуть");
            $('.characters .toggler').addClass("open");

        } else {
            $('.characters .toggler').removeClass("open");

            text.stop().animate({height: '150px'}, animateTime);
            $('.characters .toggler').text("развернуть");
        }
    });
});

/* Function to animate height: auto */
function autoHeightAnimate(element, time) {

    var curHeight = element.height(), // Get Default Height
        autoHeight = element.css('height', 'auto').height(); // Get Auto Height
    element.height(curHeight); // Reset to Default Height
    element.stop().animate({height: autoHeight}, time); // Animate to Auto Height
}
function reset(time) {
    $('.characters .toggler').addClass("open");
    $('.characters-item').animate({'height': '550'}, time);
}


$(".desc-block").on("click", "a", function (event) {
    event.preventDefault();
    var id = $(this).attr('href'), top = $(id).offset().top;
    $('body,html').animate({scrollTop: top}, 500);
});


$(document).ready(function () {
    $(".book-desc").on("click", "a", function (event) {
        //отменяем стандартную обработку нажатия по ссылке
        event.preventDefault();

        //забираем идентификатор бока с атрибута href
        var id = $(this).attr('href'),

            //узнаем высоту от начала страницы до блока на который ссылается якорь
            top = $(id).offset().top;

        //анимируем переход на расстояние - top за 1500 мс
        $('body,html').animate({scrollTop: top}, 1500);
    });

    $('a.view-audio').click(function (e) {
        e.preventDefault();
        // $(this).toggleClass('active');
        if ($(this).next().css('display') == 'none') {

            $(this).next().animate({height: 'show'}, 500);

            $(this).find('img').animate({borderSpacing: 90}, {
                step: function (now, fx) {
                    $(this).css('transform', 'rotate(' + now + 'deg)');
                },
                duration: 'slow'
            }, 'linear');
        }
        else {
            $(this).next().animate({height: 'hide'}, 500);

            $(this).find('img').animate({borderSpacing: 0}, {
                step: function (now, fx) {
                    $(this).css('transform', 'rotate(' + now + 'deg)');
                },
                duration: 'slow'
            }, 'linear');
        }
        e.stopPropagation();
    });

    $('.audio-preview').click(function (e) {
        e.preventDefault();
        // $(this).toggleClass('active');
        if ($(this).next().next().css('display') == 'none') {

            $(this).next().next().animate({height: 'show'}, 500);

            $(this).next().find('img').animate({borderSpacing: 90}, {
                step: function (now, fx) {
                    $(this).css('transform', 'rotate(' + now + 'deg)');
                },
                duration: 'slow'
            }, 'linear');
        }
        else {
            $(this).next().next().animate({height: 'hide'}, 500);

            $(this).next().find('img').animate({borderSpacing: 0}, {
                step: function (now, fx) {
                    $(this).css('transform', 'rotate(' + now + 'deg)');
                },
                duration: 'slow'
            }, 'linear');
        }
        e.stopPropagation();
    });

    $('.products-menu-download a').click(function (e) {
        e.preventDefault();

        var block = $(this).attr('data-block');

        $('.container-download > .row').css('display', 'none');
        $('#' + block).css('display', 'block');
    });
});


