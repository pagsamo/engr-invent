<?php


function style_url($path_to_file="")
{
    return base_url('/static/css/'.$path_to_file);
}


function js_url($path_to_file="")
{
    return base_url('/static/js/'.$path_to_file);
}
