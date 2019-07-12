(function( $ ) {

    $('.woocommerce-variation-add-to-cart-disabled .main_number_plugin').on('click', '.plus_plugin_number', function () {
        return false;
    });
    var negative;
    var step;
    var animate;
    var delay;
    $(document).on('click', '.plus_plugin_number', function () {
        if($(this).parents('.woocommerce-variation-add-to-cart-disabled').length !== 0){
            return false;
        }
        var $dataReset = $('.variations .reset_variations');
        if( ($dataReset.length !==0) && $dataReset.is(':hidden') ){
            //return;
        }

        var input_plugin_number = $(this).parent().find('.input_plugin_number');
        var value = parseInt(input_plugin_number.val());
        var numb = $(this).parent().prev();
        var summAllPlus = value+step;
        changePrice(summAllPlus, '+');

        if (animate === false){
            input_plugin_number.val(value+step);
            numb.val(value+step);
            input_plugin_number.attr('value', value+step);
            numb.val(value+step);
            numb.attr('value', value+step);
            numb.click();
        }
        else if(animate === true){
            var valstep = value + step+1;
            var timeout = 0;
            if (delay === false){
                delay = 10;
            }
            for (var i=value; i< valstep; i++){
                setTimeout((function (m) {
                    return function(){
                        input_plugin_number.val(m);
                        numb.val(m);
                        input_plugin_number.attr('value', m);
                        numb.val(m);
                        numb.attr('value', m);
                        numb.click();
                    }
                })(i),timeout);
                timeout +=delay;
            }
        }
    });
    $(document).on('click', '.minus_plugin_number', function () {
        var input_plugin_number = $(this).parent().find('.input_plugin_number');
        var value = parseInt(input_plugin_number.val());
        var numb = $(this).parent().prev();

        if(value == 1){
            changePrice(value, 'stop');
        }else{
            var summAllMinus = value-step;
            changePrice(summAllMinus, '-');
        }

        if (negative === false) {
            if (value > 1 && value > step) {
                if (animate === false){
                    input_plugin_number.val(value - step);
                    input_plugin_number.attr('value', value - step);
                    numb.val(value - step);
                    numb.attr('value', value - step);
                    numb.click();
                }else if(animate === true){
                    var valstep = value - step-1;
                    var timeout = 0;
                    if (delay === false){
                        delay = 10;
                    }
                    for (var i=value; i > valstep; i--){
                        setTimeout((function (m) {
                            return function(){
                                input_plugin_number.val(m);
                                numb.val(m);
                                input_plugin_number.attr('value', m);
                                numb.val(m);
                                numb.attr('value', m);
                                numb.click();
                            }
                        })(i),timeout);
                        timeout +=delay;
                    }
                }
            } else {
                input_plugin_number.val(value);
                input_plugin_number.attr('value', value);
                numb.val(value);
                numb.attr('value', value);
                numb.click();
            }
        }else {
            if (animate === false){
                input_plugin_number.val(value - step);
                input_plugin_number.attr('value', value - step);
                numb.val(value - step);
                numb.attr('value', value - step);
                numb.click();
            }else if(animate === true){
                var valstep = value - step-1;
                var timeout = 0;
                if (delay === false){
                    delay = 10;
                }
                for (var i=value; i > valstep; i--){
                    setTimeout((function (m) {
                        return function(){
                            input_plugin_number.val(m);
                            numb.val(m);
                            input_plugin_number.attr('value', m);
                            numb.val(m);
                            numb.attr('value', m);
                            numb.click();
                        }
                    })(i),timeout);
                    timeout +=delay;
                }
            }
        }
    });
    $(document).on('keypress', '.input_plugin_number', function () {
        var thi = $(this);
        setTimeout(function () {
            thi.val(thi.val().replace(/[a-zA-Z а-яА-Я]/,""));
        },100);
        // console.log(thi.val());
    });

    // When quantity typed by keyboard (not completed code)
    $(document).on('keyup', '.input_plugin_number', function () {
        var thi = $(this);
        var value = thi.val();
        console.log(value);
        // if ( value < 1 ) {
        //     changePrice( value, 'stop' );
        // } else {
        //     changePrice( value, '+' );
        // }
    });

    $(document).on('click', '.input_plugin_number', function () {
        $('.input_plugin_number').change(function(){
            $(this).val($(this).val().replace(/[a-zA-Z а-яА-Я]/,""));
            var input = $(this).val();
            $(this).val(input);
            $(this).attr('value', input);
            var paren = $(this).parent().prev();
            paren.val(input);
            paren.attr('value', input);
        });
    });


    $.fn.number_plugin = function(options) {
        var settings = $.extend({
            'width': '65px',
            'height': '35px',
            'negative' : false,
            'step' : 1,
            'animate' : false,
            'delay' : false
        }, options);
        return this.each(function() {
            $(this).css('display', 'none');
            if ($(this).siblings('.main_number_plugin').length == 0){
                var value = $(this).val();
                negative = settings['negative'];
                step = settings['step'];
                animate = settings['animate'];
                delay = settings['delay'];
                $(this).after("<div class='main_number_plugin' style='width: " + settings['width'] + "'><input disabled type='text' pattern='[0­9]*' value='" + value + "' class='input_plugin_number' style='width: " + settings['width'] + "; height: " + settings['height'] + "'><div class='plus_plugin_number'></div><div class='minus_plugin_number'></div></div>");
            }
        });
    };
/* <span class="woocommerce-Price-currencySymbol">£</span>2,500.00 */
    function changePrice(liveQuantity, flag){

        if( flag != 'stop' ) {
            var $dataPrice = '';

            var $productTypeSimple = document.querySelector('.product-type-simple');
            var $productTypeVariable = document.querySelector('.product-type-variable');

            if( $productTypeSimple ) {
                $dataPrice = $('.product-type-simple .entry-summary .price').html();
            } else if ( $productTypeVariable ) {
                $dataPrice = $('.product-type-variable .woocommerce-variation-price .price').html();
            } else {
                return;
            }

            var $dataPriceRegular = '';
            var $dataPriceSale = '';
            var $currency = '';

            if( 1 == $dataPrice.indexOf('del') ) {
                if( $productTypeSimple ) {
                    $dataPriceRegular = $('.product-type-simple .entry-summary .price').find('del').html();
                    $dataPriceSale = $('.product-type-simple .entry-summary .price').find('ins').html();
                } else if ( $productTypeVariable ) {
                    $dataPriceRegular = $('.product-type-variable .woocommerce-variation-price .price').find('del').html();
                    $dataPriceSale = $('.product-type-variable .woocommerce-variation-price .price').find('ins').html();
                }

                var $strArrayRegular = $($dataPriceRegular).html();
                var $strArraySale = $($dataPriceSale).html();
                $currency = $($strArrayRegular).html();

                if( $productTypeSimple ) {

                    $('.product-type-simple del .woocommerce-Price-amount').html(getStrResultSumm($strArrayRegular, liveQuantity, flag, $currency));
                    $('.product-type-simple ins .woocommerce-Price-amount').html(getStrResultSumm($strArraySale, liveQuantity, flag, $currency));
                } else if ( $productTypeVariable ) {
                    $('.product-type-variable .woocommerce-variation-price del .woocommerce-Price-amount').html(getStrResultSumm($strArrayRegular, liveQuantity, flag, $currency));
                    $('.product-type-variable .woocommerce-variation-price ins .woocommerce-Price-amount').html(getStrResultSumm($strArraySale, liveQuantity, flag, $currency));
                }
            } else {
                var $strArray = $($dataPrice).html();
                $currency = $($strArray).html();

                if( $productTypeSimple ) {
                    $('.product-type-simple .woocommerce-Price-amount').html(getStrResultSumm($strArray, liveQuantity, flag, $currency));
                } else if ( $productTypeVariable ) {
                    $('.product-type-variable .woocommerce-variation-price .woocommerce-Price-amount').html(getStrResultSumm($strArray, liveQuantity, flag, $currency));
                }
            }
        }
    }

    function getStrResultSumm( $strArray, liveQuantity, flag, $currency ) {
        $strArray = $strArray.split('</span>');
        $strArray[1] = $strArray[1].replace(/,|'|&nbsp;/gi, "");
        let startSumm = '';
        if (flag == '+') {
            startSumm = +$strArray[1] / (+liveQuantity - 1);
        }
        if (flag == '-') {
            startSumm = +$strArray[1] / (+liveQuantity + 1);
        }

        let allSumm = +startSumm * +liveQuantity;

        let resultSumm = number_format(allSumm, 2, ".", "'");
        let resultStr = '<span class="woocommerce-Price-currencySymbol">' + $currency + '</span>' + '&nbsp;' + resultSumm;
        return resultStr;
    }

    function number_format(number, decimals, dec_point, thousands_sep) {
        number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
        var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function(n, prec) {
                var k = Math.pow(10, prec);
                return '' + (Math.round(n * k) / k)
                    .toFixed(prec);
            };
        // Fix for IE parseFloat(0.55).toFixed(0) = 0;
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n))
            .split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '')
            .length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1)
                .join('0');
        }
        return s.join(dec);
    }

    $('body.woocommerce-cart #cart-table').on("click", ".product-remove .remove", function () {
        setTimeout(function () {
            $.ajax({
                url: '/wp-admin/admin-ajax.php',
                type: 'post',
                data: {
                    action: 'quantity_html',
                },
                complete: function (response) {
                    if (response.status == 200) {
                        change_quantity_html();
                    }
                },
                error: function (request, status, error) {
                    console.log('error');
                }
            });
        }, 3000);
    });

    $('body.woocommerce-cart #cart-table').on("click", ".restore-item", function () {
        setTimeout(function () {
            $.ajax({
                url: '/wp-admin/admin-ajax.php',
                type: 'post',
                data: {
                    action: 'quantity_html',
                },
                complete: function (response) {
                    if (response.status == 200) {
                        change_quantity_html();
                    }
                },
                error: function (request, status, error) {
                    console.log('error');
                }
            });
        }, 3000);
    });

    function change_quantity_html(){
        let settings = {
            'width': '65px',
            'height': '35px',
        };
        let quantity =  $('form.woocommerce-cart-form .product-quantity .quantity');
        if ( quantity.siblings('.main_number_plugin').length === 0 ) {
            $('form.woocommerce-cart-form .product-quantity .quantity input.input-text').each( function(i, elem) {
                let value = $(this).val();
                $(this).css('display', 'none');
                $(this).after("<div class='main_number_plugin' style='width: " + settings['width'] + "'><input disabled type='text' pattern='[0­9]*' value='" + value + "' class='input_plugin_number' style='width: " + settings['width'] + "; height: " + settings['height'] + "'><div class='plus_plugin_number'></div><div class='minus_plugin_number'></div></div>");
            });
        }
    }

    // reset quantity on product page to 1 when choose another variation
    $('.variations .value-box').on('click', 'label', function(){
        let radioButton = $(this).prev('input[type=radio]');
        if ( radioButton.prop('checked') === false ) {
            $('.sidebar .product .main_number_plugin .input_plugin_number').val('1');
            $('.sidebar .product .quantity input.qty').val('1');
        }
    })

})(jQuery);