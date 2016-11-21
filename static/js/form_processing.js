$(document).ready(function(){

/////////////////ITEM////////////////////////////////////
    // create item
    $('#item_create').submit(function(){
        event.preventDefault();

        var data = {};
        data.name = $('input[name="name"]').val();
        data.unit = $('input[name="unit"]').val();
        data.balance = $('input[name="balance"]').val();
        data.frequency = $('input[name="frequency"]').val();

        $.post('index.php/items/create',$(this).serialize(), function(result){
            if(result.stat === true)
            {
                location.reload();
            }
            $('.message-placeholder').html("");
            var alarm = '<div class="alert alert-danger alert-dismissible" role="alert">'
                alarm += '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'
                result.forEach(function(a){
                    alarm += "<p>"+a+".</p>";
                });
                alarm += '</div>';
            $('.message-placeholder').html(alarm);
            // console.log(result);
        },'json');
    }); // create item

///////////////STOCKS/////////////////////////////////////
//    autocomplete for item name

    var items = [];
    $.getJSON('http://localhost/engr-invent/index.php/items/lookup', function(data){
        data.forEach(function(d)
        {
            var i = {};
            i.value = d.name;
        });
        console.log(items);
    });

    $('.item-name-auto').autocomplete({
        lookup: items
    });




});