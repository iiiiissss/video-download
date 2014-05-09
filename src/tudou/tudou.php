<?php
//http://v2.tudou.com/v?vn=02&st=1%2C2&it=  //旧接口  已经不用
Class tudou{
	//返回视频源地址的url, 如果视频分片, 返回数组(多个url)
	public function get_source_by_url($url,$flag='flv'){
		$content = file_get_contents($url);
		preg_match('#iid: \d*#',$content,$match);
		$iid = str_replace('iid: ','',$match[0]); //iid
		// preg_match('#pic: "([\w\W]*?)"#',$content,$match) || preg_match('#pic: \'([\w\W]*?)\'#',$content,$match);
		// $pic = $match[1]; //缩略图
		// preg_match('#time: "([\w\W]*?)"#',$content,$match) || preg_match('#time: \'([\w\W]*?)\'#',$content,$match);
		// $time = $match[1]; //时间
		$xml_url = 'http://ct.v2.tudou.com/f?id='.$iid;
		$xml = file_get_contents($xml_url);//要模拟浏览器头
		preg_match('#<f ([\w\W]*?)>([\w\W]*?)</f>#',$xml,$match);
		$url = $match[2];   //视频地址
		return array($url);
	}
	
}
?> 