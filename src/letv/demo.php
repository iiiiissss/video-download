<?php
$url = 'http://www.letv.com/ptv/vplay/20040447.html';

include('letv.php');
$obj = new letv();
$urls = $obj->get_source_by_url($url); //返回视频源地址的url, 如果视频分片, 返回数组(多个url)
var_dump($urls);

?> 