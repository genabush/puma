jQuery(document).ready(function($){

    // $('.variations_button').on('click', '.single_add_to_cart_button', function () {
    //     $('.input_plugin_number').val('1');
    //     $('.qty').val('1');
    // });
    $('.variations_form').on('click', '.reset_variations', function () {
        $('.input_plugin_number').val('1');
        $('.qty').val('1');
    });
});
