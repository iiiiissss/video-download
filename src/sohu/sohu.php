<?php
Class sohu{
	//返回视频源地址的url, 如果视频分片, 返回数组(多个url)
	public function get_source_by_url($url){
		$content = file_get_contents($url);
		preg_match('#vid *=[\'" ]*(\d*)#',$content,$match);
		if(empty($match[1])) return array();
		$vid = $match[1]; //唯一标识vid
		$json = file_get_contents('http://hot.vrs.sohu.com/vrs_flash.action?vid='.$vid);
		$arr = json_decode($json,true);
		if(empty($arr['data']['su'][0])) {
			$arr = @json_decode(file_get_contents('http://my.tv.sohu.com/videinfo.jhtml?m=viewnew&vid='.$vid),true);
		}
		if(empty($arr['data']['su'][0])) return array();
		$urls = '';
		if(!empty($arr['data']['su'][0])) {
			foreach($arr['data']['su'] as $k =>$v ){
				$urls []= "http://{$arr['allot']}/?new=$v";
			}
		}
		return $urls;
	}

}
?> 