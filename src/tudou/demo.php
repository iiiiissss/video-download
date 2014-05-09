<?php
$url = 'http://www.tudou.com/albumplay/sjo2DIpRyrE/dhcqIWkTrbM.html';
include('tudou.php');
$obj = new tudou();
$urls = $obj->get_source_by_url($url); //返回视频源地址的url, 如果视频分片, 返回数组(多个url)
var_dump($urls);

?> 