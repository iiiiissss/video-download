<?php
$url = 'http://www.iqiyi.com/v_19rrh4k2go.html';
include('iqiyi.php');
$obj = new iqiyi();
$urls = $obj->get_source_by_url($url); //返回视频源地址的url, 如果视频分片, 返回数组(多个url)
var_dump($urls);

?> 