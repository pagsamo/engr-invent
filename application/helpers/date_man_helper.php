<?php 

date_default_timezone_set('Asia/Manila');

function default_now()
{
	return explode('-',mdate('%Y-%m-%d',now()));
}