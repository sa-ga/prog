<?php

require('vendor/autoload.php');
use PhpOffice\PhpSpreadsheet\Settings;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx as XlsxReader;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx as XlsxWriter;
use PhpOffice\PhpSpreadsheet\Writer\CSV as CSVWriter;

// Excel読込
$reader = new XlsxReader();
$xlsx_path = glob('files/*.xlsx');

$t = file_exists($xlsx_path[0]);

// echo $t;

$view = "";
if(file_exists($xlsx_path[0])){

    $spreadsheet = $reader->load($xlsx_path[0]);
    $sheet = $spreadsheet->getActiveSheet();
    $data = $sheet->rangeToArray('A1:H1');
    $v = $data[0];

    $view .= "<table>";

    for($i<0;$i<count($v);$i++){
        if($v[$i] != ""){
            $view .= "<td>$v[$i]</td><td> → </td><td><input type='text' name='val_$i'></td>";
        }
    }
    $view .= "</table>";
    $view .= "テーブル名 → <input type='text' name='val_tb_name'><br>";
}else{
    $filePath = "./files/" . $_FILES["csvFile"]["name"];

    if (move_uploaded_file($_FILES["csvFile"]["tmp_name"], $filePath)){
        chmod($filePath, 0644); // ファイルアップロード成功
        // echo 'OK';
    }else{
        // ファイルアップロード失敗
        echo '失敗';
    }
    $view .= "<p>aiu</p>";
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
    <p>【Excelファイルを選択してください】</p>
    <form action="excel_to_db.php" method="post" enctype="multipart/form-data">
        <input type="file" id="csvFile" name="csvFile">
        <input type="submit">
    </form>
    <form action="create_table.php" method="POST">
        <?=$view?>
        <input type="submit" value="テーブル作成">
    </form>
</body>
</html>