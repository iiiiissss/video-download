<?php
$url = 'http://tv.sohu.com/20140325/n397130912.shtml#2398';
//$url = 'http://my.tv.sohu.com/us/159854242/66424207.shtml?pvid=059744aacf7bd631';

include('sohu.php');
$obj = new sohu();
$urls = $obj->get_source_by_url($url); //返回视频源地址的url, 如果视频分片, 返回数组(多个url)
var_dump($urls);

?> 