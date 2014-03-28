<?php
Class qq{
	//返回视频源地址的url, 如果视频分片, 返回数组(多个url)
	public function get_source_by_url($url){
		$content = file_get_contents($url);
		preg_match('#vid:"([\w\W]*?)"#',$content,$match);
		if(empty($match)) return array();
		$vid = $match[1]; //唯一标识vid
		$json_url = 'http://vv.video.qq.com/geturl?otype=json&callback=j' . time() . '&vid=' . $vid;
		$json = file_get_contents($json_url);
		preg_match('#"url":"([\w\W]*?)"#',$json,$match);
		$real_url = empty($match[1])?'':$match[1]; //真实地址
		return array($real_url);
	}
}
?> 