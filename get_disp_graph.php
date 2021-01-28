<?php
    $tmp_g = $_POST["n"];

    // echo $tmp_img;

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
    <form method="POST" action="insert.php">
        <img src="<?=$tmp_g?>.php" name="img" id="MyImg1">
        <input type="hidden" value="" id="img_id" name="img_id">
    </form>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
        function sendImg(){
            let img = document.getElementById('MyImg');
            let b64 = ImageToBase64(img, "image/jpeg");

            document.getElementById("img_id").value = b64;
            // $("#img_id").val = b64;
        }

        function ImageToBase64(img, mime_type) {
            // New Canvas
            let canvas = document.createElement('canvas');
            canvas.width  = img.width;
            canvas.height = img.height;
            // Draw Image
            let ctx = canvas.getContext('2d');
            ctx.drawImage(img, 0, 0);
            // To Base64
            return canvas.toDataURL(mime_type);
        }
    </script>
</body>
</html>