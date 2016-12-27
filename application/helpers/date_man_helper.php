<?php 

date_default_timezone_set('Asia/Manila');

function months(){
	return array(
		array('name'=>'January','val'=>1,),
		array('name'=>'February','val'=>2,),
		array('name'=>'March','val'=>3,),
		array('name'=>'April','val'=>4,),
		array('name'=>'May','val'=>5,),
		array('name'=>'June','val'=>6,),
		array('name'=>'July','val'=>7,),
		array('name'=>'August','val'=>8,),
		array('name'=>'September','val'=>9,),
		array('name'=>'October','val'=>10,),
		array('name'=>'November','val'=>11,),
		array('name'=>'December','val'=>12,)
	);
}

function default_now()
{
	return explode('-',mdate('%Y-%m-%d',now()));
}

function today()
{
	return mdate('%Y-%m-%d',now());
}

/**
 * [month_default description]
 * returns array of start and end of current month
 * @return [array] [description]
 */
function month_default()
{
	$m = default_now();
	$s = $m[0].'-'.$m[1].'-'.'01';
	$md = days_in_month($m[1],$m[0]);
	$ed = $m[0].'-'.$m[1].'-'.$md;
	return array($s,$ed);
}

