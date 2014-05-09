<?php
//旧有的http://app.letv.com/v.php?id=$id接口已经停用
Class letv{
	//返回视频源地址的url, 如果视频分片, 返回数组(多个url)
	public function get_source_by_url($url,$flag='flv'){
		if(preg_match('#play/\d*\.html#',$url,$match)) {
			$id = str_replace('.html','',str_replace('play/','',$match[0])); //标识符id
		}elseif(preg_match('#play/\d*/\d*#',$url,$match)) { //电视剧  分集
			$content = file_get_contents($url);
			preg_match('#vid:\d*#',$content,$match);
			$id = str_replace('vid:','',$match[0]);
		}
		
		$xml_url = 'http://app.letv.com/v.php?id=' . $id;
		$xml = file_get_contents($xml_url);   //获取第一个xml文件  含缩略图  时间
		echo $xml_url;
		preg_match('#<pic>([\w\W]*?)</pic>#',$xml,$match);
		$pic = str_replace('<![CDATA[','',str_replace(']]>','',$match[1]));	//图片
		preg_match('#<duration>([\w\W]*?)</duration>#',$xml,$match);
		$time = str_replace('<![CDATA[','',str_replace(']]>','',$match[1]));//总时间
		
		preg_match('#<mmsJson>([\w\W]*?)</mmsJson>#',$xml,$match);
		preg_match('#"url":"([\w\W]*?)"#',$match[1], $match);    //获取第二个xml文件
		$xml2_url = stripcslashes($match[1]) ;
		$xml2 = file_get_contents($xml2_url);
		echo $xml2_url;
		
		preg_match('#"location": "([\w\W]*?)"#',$xml2,$match); //获取真实地址
		$real_url = stripcslashes($match[1]);
	
		return array('icon'=>$pic, 'time'=>$time, 'url'=>$real_url);	
	
		
	}
	

}
?> 