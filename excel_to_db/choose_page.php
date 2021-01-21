<?php
    //フォルダ内の削除関数
    function delete_allfile($dirpath=''){
        if ( strcmp($dirpath,'')==0 ){ die('delete_allfile : error : please set dir_name'); }
        $deleted_list = array();
        $dir = dir($dirpath);
        while ( ($file=$dir->read()) !== FALSE ){
            if (preg_match('/^\./',$file)){ continue; }	// skip dir , skip hidden file
            else {
                array_push($deleted_list, $file);
                if ( ! unlink("$dirpath/$file") ){ die("delete_allfile : error : can not delete file [{$dirpath}/{$file}]"); }
            }
        }
        return $deleted_list;
    }

    //フォルダ内のファイルを全て削除
    $deleted_list  = delete_allfile('files');
    // $deleted_list  = delete_allfile('cell_info');

    $filePath = "./files/" . $_FILES["csvFile"]["name"];
    // touch("cell_info/".$_POST["cntCell"].".txt");

    if (move_uploaded_file($_FILES["csvFile"]["tmp_name"], $filePath)){
        chmod($filePath, 0644); // ファイルアップロード成功
        // echo 'OK';
    }else{
        // ファイルアップロード失敗
        echo '失敗';
    }

    $disp_page = $_POST["page"];
    
    if($disp_page < 1){
        header("Location: read_excel_column.php");
    }else{
        header("Location: select.php");
    }
?>