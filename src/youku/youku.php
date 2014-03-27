<?php
Class youku{
	//返回视频源地址的url, 如果视频分片, 返回数组(多个url)
	public function get_source_by_url($url,$flag='flv'){
		preg_match("#id_(.*?)\.html#",$url,$out); 
		$id=$out[1]; 
		$content=file_get_contents('http://v.youku.com/player/getPlayList/VideoIDS/'.$id); //
		$data=json_decode($content);
		$re = array();
		foreach($data->data[0]->streamfileids AS $k=>$v){ // $k = hd2 flv mp4 三种格式的视频源, hd2最清晰(不一定有),
			if($k != $flag) continue;
			$sid=$this->getSid(); 
			$fileid=$this->getfileid($v,$data->data[0]->seed); 
			$one=($data->data[0]->segs->$k);
			$count = count($one);
			$inpart_k = $k;
			for($i=0; $i < $count; $i++) {
				$num = str_pad(strtoupper(dechex($i)),2,'0',STR_PAD_LEFT);
				$newid = substr_replace($fileid,$num,8,2);
				if('hd2'==$k) $inpart_k = 'flv';
				$re []="http://f.youku.com/player/getFlvPath/sid/{$sid}_{$num}/st/{$inpart_k}/fileid/{$newid}?K={$one[$i]->k}"; 
				if(-1 == $one[$i]->k) break;
			}
		}
		return $re;
	}
	
	private function getSid() { 
		$sid = time().(rand(0,9000)+10000); 
		return $sid; 
	} 
	private  function getfileid($fileId,$seed) { 
		$mixed = $this->getMixString($seed); 
		$ids = explode("*",$fileId); 
		unset($ids[count($ids)-1]); 
		$realId = ""; 
		for ($i=0;$i < count($ids);++$i) { 
		$idx = $ids[$i]; 
		$realId .= substr($mixed,$idx,1); 
		} 
		return $realId; 
	} 
	private function getMixString($seed) { 
		$mixed = ""; 
		$source = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ/\\:._-1234567890"; 
		$len = strlen($source); 
		for($i=0;$i< $len;++$i){ 
		$seed = ($seed * 211 + 30031) % 65536; 
		//$seed = ($seed * 1511 + 30031) % 65536; 
		$index = ($seed / 65536 * strlen($source)); 
		$c = substr($source,$index,1); 
		$mixed .= $c; 
		$source = str_replace($c, "",$source); 
		} 
		return $mixed; 
	}

}
?> 