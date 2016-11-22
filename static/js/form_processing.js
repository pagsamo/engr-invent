$(document).ready(function(){

    //helper function - generate dismissable alert bootstrap
    function alarmer(ar)
    {
        var alarm = '<div class="alert alert-danger alert-dismissible" role="alert">'
        alarm += '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'
        ar.forEach(function(a){
            if(ar[(ar.length - 1)] != a)
            {
                alarm += "<p>"+a+".</p>";
            }
        });
        alarm += '</div>';
        return alarm;
    };//helper function - generate dismissable alert bootstrap

/////////////////ITEM////////////////////////////////////
    // create item
    $('#item_create').submit(function(){
        event.preventDefault();
        $.post('index.php/items/create',$(this).serialize(), function(result){
           if(result.stat === true)
           {
                 location.reload();
           }else{
                $('.message-placeholder').html("");
               $('.message-placeholder').html(alarmer(result));
           }
        },'json');
    }); // create item

///////////////STOCKS/////////////////////////////////////
//    autocomplete for item name


    // lets get the items
    var items = [];
    $.getJSON('http://localhost/engr-invent/index.php/items/lookup', function(data){
        data.forEach(function(d)
        {
           items.push(d);
        });
    });
    // get items assign to items

    $('.item-name-auto').autocomplete({
        lookup: items,
        onSelect: function (suggestion) {
            $('input[name="item_id"]').val(suggestion.id);
            $('input[name="unit"]').val(suggestion.unit);
        }
    });


    $('#stock_f').submit(function(){
        event.preventDefault();
        $.post('stocks/new_stocks',$(this).serialize(), function(result)
        {
             if(result.stat === true)
            {
                location.reload();
             }else{
                $('.message-placeholder').html("");
                $('.message-placeholder').html(alarmer(result));
            }
        },'json');
    });//stock submission


});