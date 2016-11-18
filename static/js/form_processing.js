$(document).ready(function(){

    // create item
    $('#item_create').submit(function(){
        event.preventDefault();

        var data = {};
        data.name = $('input[name="name"]').val();
        data.unit = $('input[name="unit"]').val();
        data.balance = $('input[name="balance"]').val();
        data.frequency = $('input[name="frequency"]').val();

        $.post('index.php/items/create',$(this).serialize(), function(result){
            $('.message-placeholder').html("");

            var alarm = '<div class="alert alert-danger alert-dismissible" role="alert">'
                alarm += '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'
                result.forEach(function(a){
                    alarm += "<p>"+a+"</p>";
                });
                alarm += '</div>';

            $('.message-placeholder').html(alarm);
        },'json');
    });


});