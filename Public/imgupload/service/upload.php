<?php
    try{
        //获取json配置文件
        $CONFIG = json_decode(preg_replace("/\/\*[\s\S]+?\*\//", "", file_get_contents("config.json")), true);
        //拼接绝对上传路径
        $upFilePath = $_SERVER['DOCUMENT_ROOT']."".$CONFIG['uploadFile'];
        //配置文件名称
        $rename = md5(time()).'.jpg';
        //开始上传
        $ok = move_uploaded_file($_FILES['file']['tmp_name'], $upFilePath.$rename);
        if($ok === FALSE) {
            echo json_encode(array('status'=>'0'));
        } else {
            echo json_encode(array('status'=>'1', 'msg'=>"/".$CONFIG['uploadFile'].$rename));
        }
    }catch(Exception $e){
        echo json_encode(array('status'=>'0'));
    }

