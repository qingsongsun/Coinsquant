<?php
// 前端图片路径
if (!function_exists('imgurl')) {
    function imgurl($file)
    {
        return '//' . $_SERVER['HTTP_HOST'] . "/img/" . $file;
    }
}