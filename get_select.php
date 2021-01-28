<?php
    include("name_map.php");

    $tmp_img = $_POST["h"];
    $tmp_graph = $name_map[$tmp_img];

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
    $deleted_list  = delete_allfile('cell_info');

    $filePath = "./files/" . $_FILES["csvFile"]["name"];
    touch("cell_info/".$_POST["cntCell"].".txt");

    if (move_uploaded_file($_FILES["csvFile"]["tmp_name"], $filePath)){
        chmod($filePath, 0644); // ファイルアップロード成功
        // echo 'OK';
    }else{
        // ファイルアップロード失敗
        echo '失敗';
    }

    $cell_val = "";
    if(isset($_POST["cntCell"])){
        $cell_val = $_POST["cntCell"];
    }else{
        $cell_val = "A2";
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/style.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>

    <p>【選択したグラフ】</p>
    <img src="img/<?=$tmp_graph?>.png">
    
    <p>【Excelファイルを選択してください】</p>
    <form action="get_disp_graph.php" method="post" enctype="multipart/form-data">
        <input type="file" id="csvFile" name="csvFile">
        <p>（取得対象）</p>
        <input type="radio" name="val_target" id="" value="0" checked>シートごとの値
        <input type="radio" name="val_target" id="" value="1">同一シートの値
        <p>（取得セル）</p>
        <input type="text" value="<?=$cell_val?>" name="cntCell"><br><br>
        <input type="hidden" name="n" value="<?=$tmp_graph?>">
        <input type="submit">
    </form>
</body>
</html>