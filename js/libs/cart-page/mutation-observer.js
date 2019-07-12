(function( $ ) {
    //Input number
    function inputCartNumber(){
        $('.qty').number_plugin({
            width: '188px',
            height: '88px',
            negative: false,
            step: 1,
            animate: true,
            delay: 100,
        });
    }

    // var MutationObserver = window.MutationObserver || window.WebKitMutationObserver || window.MozMutationObserver;
    var table = document.querySelector('#cart-table');

    var observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            // console.log(mutation.type);
            inputCartNumber();
            $('.button[name="update_cart"]').removeAttr('disabled');
        });
    });

    observer.observe(table, {
        attributes: true,
        childList: true,
        subtree: true
    });
})(jQuery);

