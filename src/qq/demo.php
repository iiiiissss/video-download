<?php
$url = 'http://v.qq.com/cover/7/7v8sfg6josbppif.html?vid=k0014fszehy';
include('qq.php');
$obj = new qq();
$urls = $obj->get_source_by_url($url); //返回视频源地址的url, 如果视频分片, 返回数组(多个url)
var_dump($urls);

?> 