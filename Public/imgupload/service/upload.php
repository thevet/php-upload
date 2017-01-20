<?php
    try{
        $CONFIG = json_decode(preg_replace("/\/\*[\s\S]+?\*\//", "", file_get_contents("config.json")), true);
        $upFilePath = $_SERVER['DOCUMENT_ROOT']."".$CONFIG['uploadFile'];
        $rename = md5(time()).'.jpg';
        $ok = move_uploaded_file($_FILES['file']['tmp_name'], $upFilePath.$rename);
        if($ok === FALSE) {
            echo json_encode(array('status'=>'0'));
        } else {
            echo json_encode(array('status'=>'1', 'msg'=>"/".$CONFIG['uploadFile'].$rename));
        }
    }catch(Exception $e){
        echo json_encode(array('status'=>'0'));
    }

