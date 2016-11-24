$(document).ready(function(){
/////////////////VARIABLE LOOK UP HELPERS///////////////////////////////
    // lets get the items
    var items = [];
    $.getJSON('/engr-invent/index.php/items/lookup', function(data){
        data.forEach(function(d)
        {
            items.push(d);
        });
    });//item getter
    //autocomplete on select items
    $('.item-name-auto').autocomplete({
        lookup: items,
        onSelect: function (suggestion) {
            $('input[name="item_id"]').val(suggestion.id);
            $('input[name="unit"]').val(suggestion.unit);
        }
    });//autocomplete on select items
/////////////////////////////////////////////////////////////////////////////
/////////////////////HTML GENERATOR FUNCTIONS////////////////////////////////
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
    //submitter processor on modal forms
    function submitter(form_id,url)
    {
        $(form_id).submit(function(){
            event.preventDefault();
            $.post(url,$(this).serialize(), function(result){
                if(result.stat === true)
                {
                     location.reload();
                }else {
                    $('.message-placeholder').html("");
                    $('.message-placeholder').html(alarmer(result));
                }
            },'json');
        })
    }//submitter
////////////////////////////////////////////////////////////////////
/////////////////FORM PROCESSING////////////////////////////////////
    submitter('#item_create','index.php/items/create');//items
    submitter('#stock_f','stocks/new_stocks');//stocks
    submitter('#release_f','release/new_release');//release
});//JQUERY DOCUMENT INIT