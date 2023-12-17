(function ($) {
    "use strict";
    $('.input100').each(function(){
        $(this).addClass('has-val');
        $(this).on('blur', function(){
            if($(this).val().trim() != "") {
                $(this).addClass('has-val');
            }
            else {
                $(this).removeClass('has-val');
            }
        })    
    })

})(jQuery);