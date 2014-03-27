<?php
$url = 'http://v.youku.com/v_show/id_XMzk5MTczMTY4.html';

include('youku.php');
$obj = new youku();
$urls = $obj->get_source_by_url($url); //返回视频源地址的url, 如果视频分片, 返回数组(多个url)
var_dump($urls);

?> 