$(document).ready(function(){

/////////////////VARIABLE LOOK UP HELPERS///////////////////////////////
    /**
     * range starts here
     */
    var month_start;
    /**
     * range default ends here
     */
    var month_end;

    // lets get the items
    var items = [];
    $.getJSON(window.location.origin+'/engr-invent/index.php/items/lookup', function(data){
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
            $('input[name="item_category"]').val(suggestion.category)
        }
    });//autocomplete on select items
/////////////////////////////////////////////////////////////////////////////
/////////////////Jquery form enablers///////////////////////////////////
$('.date_range').daterangepicker({
    locale:{
        format: "YYYY-MM-DD"
    },
    singleDatePicker: true,
    showDropdowns: true
});
////////////////////////////////////////////////////////////////////////

/////////////////////HTML GENERATOR FUNCTIONS////////////////////////////////
    //helper function - generate dismissable alert bootstrap
    function alarmer(ar)
    {
        var alarm = '<div class="alert alert-danger alert-dismissible" role="alert">'
        alarm += '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'
        ar.forEach(function(a){
            if(ar[(ar.length)] != a)
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

    // goer
    $('.goer').click(function(){
        m = $('select[name="month"]').val();
        y = $('select[name="year"]').val();
        c = $('select[name="category"]').val();
        window.location = window.location.origin+'/engr-invent/index.php/'+m+'/'+y+'/'+c;
    });
    
////////////////////////////////////////////////////////////////////
/////////////////FORM PROCESSING////////////////////////////////////
    submitter('#item_create','index.php/items/create');//items
    submitter('#stock_f','stocks/new_stocks');//stocks
    submitter('#release_f','release/new_release');//release

    
//////////////////////////TEST//////////////////////////////////////
$('#api_trigger').click(function(){
    var start, end, category;
    start = $('input[name="start"]').val();
    end = $('input[name="end"]').val();
    category = $('select[name="category"]').val();
    var api_url = window.location.origin+'/engr-invent/index.php/stocks/selected/'+start+'/'+end+'/'+category;
    var tbl_b = "";
    $.get(api_url, function(data){
        data.forEach(function(d){
            var tbl = "";
            tbl += "<tr><td>"+d.id+"</td>";
            tbl +="<td>"+d.rp_number+"</td>";
            tbl +="<td>"+d.item_name+"</td>";
            tbl +="<td>"+d.unit+"</td>";
            tbl +="<td>"+d.quantity+"</td>";
            tbl +="<td>"+d.amount+"</td>";
            tbl +="<td>"+d.supplier+"</td>";
            tbl +="<td>"+d.date+"</td></tr>";
            tbl_b += tbl;
        });
    $('tbody').html(tbl_b);
    },"json");
});
////////////////////////////////////////////////////////////////////
});//JQUERY DOCUMENT INIT