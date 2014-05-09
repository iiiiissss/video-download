<?php
$url = 'http://video.sina.com.cn/m/201404080204095_63717165.html';
include('sina.php');
$obj = new sina();
$urls = $obj->get_source_by_url($url); //返回视频源地址的url, 如果视频分片, 返回数组(多个url)
var_dump($urls);

?> 