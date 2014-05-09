<?php
//TODO: 待修复
//旧地址'http://cache.video.qiyi.com/v/' . $m[1] 已经弃用
Class iqiyi{
	//返回视频源地址的url, 如果视频分片, 返回数组(多个url)
	public function get_source_by_url($url){
		$file = file_get_contents($url);
		preg_match('#data-player-videoid="(\w*)"#',$file,$m);
		if(empty($m[1])) return array();
		$xml = file_get_contents('http://cache.video.qiyi.com/v/' . $m[1]);
		preg_match_all('#<file>([\w\W]*?)</file>#',$xml,$m);
		$re = empty($m[1])? array():$m[1];
		return $re;
	}
}
?> 