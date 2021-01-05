<?php

/**
 * 新闻管理控制器
 *122123
 * @author nielixin 2014-2-27
 */
class NewsAction extends AdminBaseAction {

 
    
    /**
     * 新闻图片类型文章图片上传
     * @author yucheng 2014-12-17
     */
    public function news_upload_img() {
		$config['set_img'] = array(  
			"news"=>array(
					'path' => 'news/',
					'big' => array('w'=>940,'h'=>625),
					'middle' => array('w'=>425,'h'=>270),    //
					'small' => array('w'=>192,'h'=>140),     //
					'mid' => array('w'=>200,'h'=>145),     //资讯中的图片 Mo Xiaolong <moxiaolong@tuliu.com> 2015-12-30
					'suffix' => array('big'=>'_big','middle'=>'_sml','small'=>'_tin', 'mid' => '_mid')
			)
		);
        $res = array('s' => false, 'info' => '未上传任何图片');
        import('ORG.Net.UploadFile');
        $upload = new UploadFile(); // 实例化上传类
        $upload->maxSize = 1024*1024*4; // 设置附件上传大小，最大4M
        $upload->allowExts = array('jpg', 'jpeg', 'gif', 'png'); // 设置附件上传类型
        $file_path = UPLOAD_PATH .'/news/' . date('Ymd',time()) . '/';         //目录路径
        $upload->savePath = $file_path; // 设置附件上传目录
        $upload->thumb = true;   //对上传图片进行缩略处理
        $ar_img_config = C("set_img.news");
        $upload->thumbMaxWidth  = $ar_img_config['big']['w'] . ',' . $ar_img_config['middle']['w'] . ',' . $ar_img_config['small']['w'];   //缩略图宽
        $upload->thumbMaxHeight = $ar_img_config['big']['h'] . ',' . $ar_img_config['middle']['h'] . ',' . $ar_img_config['small']['h'];  //缩略图高
        $upload->thumbPrefix = $ar_img_config['prefix'];   //缩略图名称前缀
        $upload->thumbSuffix = $ar_img_config['suffix']['big'] . ',' . $ar_img_config['suffix']['middle'] . ',' . $ar_img_config['suffix']['small'];  //缩略图名称后缀
        $upload->thumbType = 0; // 缩略图生成方式 1 按设置大小截取 0 按原图等比例缩略
        $upload->watermark = C('watermark'); //加水印地址
     
        if (!$upload->upload()) {// 上传错误提示错误信息
            $res['info'] = $upload->getErrorMsg();
        } else {// 上传成功 获取上传文件信息
            $info = $upload->getUploadFileInfo();
            $imgurl = $info[0]['savename'];
            echo $imgurl;
        }

    }
    
  
}

?>
