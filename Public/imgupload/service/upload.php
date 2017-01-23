<?php
    try{
        //获取json配置文件
        $CONFIG = json_decode(preg_replace("/\/\*[\s\S]+?\*\//", "", file_get_contents("config.json")), true);
        //拼接绝对上传路径
        $upFilePath = $_SERVER['DOCUMENT_ROOT']."".$CONFIG['uploadFile'];
        //配置文件名称
        $rename = md5(time()).'.jpg';
        //限制上传格式
        if(!empty($CONFIG['imageAllowFiles'])){
            $fileType = explode('/',$_FILES['file']['type'] );
            if(!empty($fileType[0])){
                if(!in_array($fileType[1],$CONFIG['imageAllowFiles'])){
                    echo json_encode(array('status'=>'0','msg'=>'上传文件格式有误!'));exit();
                }
            }else{
                echo json_encode(array('status'=>'0','msg'=>'上传文件格式有误!'));exit();
            }
        }
        //检测图片大小,图片格式,图片规格
        $maxSize = (int)$CONFIG['maxUploadSize'];
        if($maxSize != 0){
            if($maxSize < $_FILES['file']['size']){
                echo json_encode(array('status'=>'0','msg'=>'图片太大了!')); exit(); //此处可自定义通知
            }
        }
        $imgWH = explode("x",$CONFIG['isCheckImgWH']);
        $tempFile = $_FILES['file']['tmp_name'];
        $tempImg = getimagesize($tempFile);
        $tempW = $tempImg[0];
        $tempH = $tempImg[1];
        //限制宽高
        if(!empty($imgWH[0]) ||  !empty($imgWH[1])){
                if(!empty($imgWH[0]) && empty($imgWH[1])){
                    if($imgWH[0] != $tempW){
                        echo json_encode(array('status'=>'0','msg'=>'图片尺寸不符合规则!'));exit();
                    }
                }else if(empty($imgWH[0]) && !empty($imgWH[1])){
                    if($imgWH[1] != $tempH){
                        echo json_encode(array('status'=>'0','msg'=>'图片尺寸不符合规则!'));exit();
                    }
                }else{
                    if($imgWH[0] != $tempW || $imgWH[1] != $tempH){
                        echo json_encode(array('status'=>'0','msg'=>'图片尺寸不符合规则!'));exit();
                    }
                }
        }

        //开始上传
        $ok = move_uploaded_file($_FILES['file']['tmp_name'], $upFilePath.$rename);
        if($ok === FALSE) {
            echo json_encode(array('status'=>'0'));
        } else {
            echo json_encode(array('status'=>'1', 'msg'=>"/".$CONFIG['uploadFile'].$rename));
        }
    }catch(Exception $e){
        echo json_encode(array('status'=>'0'));exit();
    }

