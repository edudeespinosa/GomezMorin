jQuery(document).ready(function($) {    
    var valor = '';
    $('#posts_container').html('');
    jQuery.post(MyAjax.url, {
        nonce: MyAjax.nonce,
        action: 'buscar_posts',
        valor: $('#calendar').val(),
        perm: $('#perm').val()
    }, function(response) {  
        $('#posts_container').hide().html(response).fadeIn();
    });
    $('#ajax-form-all').submit(function(e) {                 
        e.preventDefault();         
        jQuery.post(MyAjax.url, {
            nonce: MyAjax.nonce,
            action: 'buscar_todos_posts',
            valor: $('#calendar').val()
        }, function(response) {
            $('#posts_container').hide().html(response).fadeIn();
        });    
    });         
});