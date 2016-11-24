<?php 

date_default_timezone_set('Asia/Manila');

function months(){
	return array(
		array('name'=>'Jan','Val'=>1,),
		array('name'=>'Feb','Val'=>2,),
		array('name'=>'Mar','Val'=>3,),
		array('name'=>'Apr','Val'=>4,),
		array('name'=>'May','Val'=>5,),
		array('name'=>'Jun','Val'=>6,),
		array('name'=>'Jul','Val'=>7,),
		array('name'=>'Aug','Val'=>8,),
		array('name'=>'Sep','Val'=>9,),
		array('name'=>'Oct','Val'=>10,),
		array('name'=>'Nov','Val'=>11,),
		array('name'=>'Dec','Val'=>12,)
	);
}

function default_now()
{
	return explode('-',mdate('%Y-%m-%d',now()));
}


