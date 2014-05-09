<?php
Class sina{
	//返回视频源地址的url, 如果视频分片, 返回数组(多个url)
	public function get_source_by_url($url){
		$content = file_get_contents($url);
		if(preg_match("#vid:'(\d*)#",$content,$m)) {
			$vid = $m[1];
		}elseif(preg_match("#\#(\d*)#",$url,$m)){
			$vid = $m[1];
		}
		$xml  = file_get_contents('http://v.iask.com/v_play.php?vid=' . $vid);
		echo 'http://v.iask.com/v_play.php?vid=' . $vid;
		$re_url = '';
		if(preg_match_all('#<durl>([\w\W]*?)</durl>#',$xml,$m)) {
			foreach($m[1] as $k=>$v) {
				if(preg_match('#<!\[CDATA\[([\w\W]*?)\]\]>#',$v,$m_url)) {
					$re_url []= $m_url[1];
				}
			}
		}
		return empty($re_url)?array(''):$re_url;
	}
}
?> 