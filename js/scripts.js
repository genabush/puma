(function ($) {
    function linePadding(text) {
        //Padding for lines in main-banner__title
        $(text).removeClass('pad-left, pad-right');
        var linePos = -1;
        $(text).each(function (i, elem) {
            var wordTop = $(this).offset();
            if (wordTop.top != linePos) {
                $(this).addClass('pad-left');
                $(this).prev().addClass('pad-right');
                linePos = wordTop.top;
            }
        });
    }

//Main banner title
    function splitTitle(elem) {
        var OurString = $(elem).html();
        var NewOurString = "";
        OurString = OurString.split(" ");
        for (i = 0; i < OurString.length; i++) {
            NewOurString = NewOurString + "<span>" + OurString[i] + "</span>" + " ";
        }
        $(elem).html(NewOurString);
    }

    if ($('.main-banner__title').length != 0) {
        splitTitle(".main-banner__title");
    }
    if ($('.main-banner__subtitle').length != 0) {
        splitTitle(".main-banner__subtitle");
    }


//Mobile menu
    $('.header').on('click', '.navigation.mobile', function () {
        var ww = $(window).width();
        if (ww < 1061) {
            if (!$(this).hasClass('close')) {
                $('body').addClass('no-scroll');
                $('.navigation .navigation__wrap').slideDown();
                $(this).toggleClass('close');
            } else {
                $('body').removeClass('no-scroll');
                $('.navigation > .navigation__wrap').slideUp();
                $(this).toggleClass('close');
            }
        }
    });

//Input number
    function inputNumber() {
        $('.qty').number_plugin({
            width: '188px',
            height: '88px',
            negative: false,
            step: 1,
            animate: true,
            delay: 100,
        });
    }

    inputNumber();

//Product variations dropdown
    $('.variations').on('click', '.label', function () {
        $(this).find('.arrow').toggleClass('opened');
        $(this).next('.value').find('.value-box').slideToggle();
    });

//Shop table unable update button
    $('.shop_table').on('click', '[class*="_number_plugin"]', function () {
        $('.button[name="update_cart"]').removeAttr('disabled');
    });


    linePadding('.main-banner__title span');
    linePadding('.main-banner__subtitle span');

    // complete strings of min / max prices with cents and symbol (') if price more than thousand
    $(window).load(function () {
        let newNamber = [], currency = '';
        $('.products .product .product__info .price .woocommerce-Price-amount').each(function (i, elem) {
            if (i === 0) {
                currency = $(elem).find('.woocommerce-Price-currencySymbol').text();
            }
            let number = $(elem).html().split('</span>');
            newNamber[i] = number[1].replace(/'|&nbsp;/gi, "");
        });

        let minNum = 0;
        let maxNum = 0;

        let newStrMinPrice = '';
        let newStrMaxPrice = '';

        if (0 !== newNamber.length) {
            minNum = newNamber[0];
            maxNum = minNum;
            for (let i = 1; i < newNamber.length; ++i) {
                if (parseFloat(newNamber[i]) > parseFloat(maxNum)) maxNum = newNamber[i];
                if (parseFloat(newNamber[i]) < parseFloat(minNum)) minNum = newNamber[i];
            }

            if (4 <= minNum.split('.')[0].length) {
                newStrMinPrice = currency + ' ' + minNum.substring(0, 1) + "'" + minNum.substring(1);
            } else {
                newStrMinPrice = currency + ' ' + minNum;
            }

            if (4 <= maxNum.split('.')[0].length) {
                newStrMaxPrice = currency + ' ' + maxNum.substring(0, 1) + "'" + maxNum.substring(1);
            } else {
                newStrMaxPrice = currency + ' ' + maxNum;
            }

            $('.woof_redraw_zone .woof_price3_search_container .irs-min').text(newStrMinPrice);
            $('.woof_redraw_zone .woof_price3_search_container .irs-max').text(newStrMaxPrice);
        }
        else {
            let MinPrice = $('.woof_redraw_zone .woof_price3_search_container .irs-min').html();
            let MaxPrice = $('.woof_redraw_zone .woof_price3_search_container .irs-max').html();
            if (undefined !== MinPrice && undefined !== MaxPrice) { // this (if) prevent errors on other pages except shop
                let arrMin = MinPrice.split(" ");
                let arrMax = MaxPrice.split(" ");

                newStrMinPrice = arrMin[0] + " " + "0.00";
                newStrMaxPrice = arrMax[0] + " " + "0.00";

                //
                // // this code output min / max price on filter even there are not products on page
                // //
                //
                // if (3 === arrMin.length) {
                //     newStrMinPrice = arrMin[0] + ' ' + arrMin[1] + "'" + arrMin[2] + '.00';
                // } else {
                //     newStrMinPrice = arrMin[0] + ' ' + arrMin[1] + '.00';
                // }
                //
                // if (3 === arrMax.length) {
                //     newStrMaxPrice = arrMax[0] + ' ' + arrMax[1] + "'" + arrMax[2] + '.00';
                // } else {
                //     newStrMaxPrice = arrMax[0] + ' ' + arrMax[1] + '.00';
                // }

                $('.woof_redraw_zone .woof_price3_search_container .irs-min').text(newStrMinPrice);
                $('.woof_redraw_zone .woof_price3_search_container .irs-max').text(newStrMaxPrice);
            }
        }
    });
    jQuery(window).resize(function ($) {
        function linePadding(text) {
            //Padding for lines in main-banner__title
            jQuery(text).removeClass('pad-left').removeClass('pad-right');
            var linePos = -1;
            $(text).each(function (i, elem) {
                var wordTop = $(this).offset();
                if (wordTop.top != linePos) {
                    $(this).addClass('pad-left');
                    $(this).prev().addClass('pad-right');
                    linePos = wordTop.top;
                }
            });
        }

        if (jQuery('.main-banner__title').length != 0) {
            linePadding('.main-banner__title span');
        }
        if (jQuery('.main-banner__subtitle').length != 0) {
            linePadding('.main-banner__subtitle span');
        }

    });
    jQuery(window).resize(function ($) {
        var winW = jQuery(window).width();
        if (winW > 860) {
            jQuery('.navigation__wrap').show();
        } else if (winW < 861) {
            jQuery('.navigation__wrap').hide();
            jQuery('.navigation.mobile').removeClass('close');
            jQuery('body').removeClass('no-scroll');
        }
    });
    $('.btn:empty').hide();

})(jQuery);
