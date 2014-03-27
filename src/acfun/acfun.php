<?php
Class acfun{
public function get_source_by_url($url){
	$content = file_get_contents($url);
	if(preg_match("#\[video\]([\w\W]*?)\[/video\]#",$content,$m)) {
		$vid = $m[1];
	}
	exit('ccc');
	if(empty($vid)) return '';	
	$arr  = json_decode(file_get_contents('http://www.acfun.tv/api/getVideoByID.aspx?vid=' . $vid), true);
	var_dump($arr);
	//return empty($re_url)?'':$re_url;
}


}
?> 