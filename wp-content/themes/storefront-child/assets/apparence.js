(function ($) {

    wp.customize('header_background', (value) => {
        value.bind((newVal) => {
            $('.site-header').css('background', newVal)
        })
    })

})(jQuery)