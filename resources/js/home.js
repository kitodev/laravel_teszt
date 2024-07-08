$(document).ready(function(){
    $('.alphabetical-only').bind('keyup blur change',function(){ 
        var node = $(this);
        node.val(node.val().replace(/[0-9]/g,'') ); }
    );

    $('.number-only').bind('keyup blur',function(){ 
        var node = $(this);
        node.val(node.val().replace(/[^0-9.]/g,'') ); }
    );

    $('#countryAjax').on('change autocompleteselect', function(){
        var self = $(this);

        $.ajax({
            method: 'get',
            url: '/get-shipping-methods-by-country/' + self.val(),
            success: function(res){
                $('#country-selector').html(res);
                if($('input[name="shippingMethod"]').length){
                    $('button[type="submit"]').prop('disabled', false);
                }else{
                    $('button[type="submit"]').prop('disabled', true);
                }
            }
        });
    });
});