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

//参照セル情報
$cell_path = glob('cell_info/*.txt');
$cell_tmp = explode('.',$cell_path[0]);
$cell_data = explode('/',$cell_tmp[0]);

// var_dump($cell_path);
// var_dump($cell_data[1]);
// exit();

// $spreadsheet = $reader->load('files/test-2.xlsx');
$spreadsheet = $reader->load($xlsx_path[0]);

// //表示されているExcelシートを取得
// $sheet = $spreadsheet->getActiveSheet();
// //A1セルの値を取得
// $val = $sheet->getCell('A2')->getValue();

//Excelのシート数を取得
$cnt_sheet = $spreadsheet->getSheetCount();

// $tmp_cell = $_SESSION["cntCell"];

$tmp_cell = $cell_data[1];

for($i = 0 ;$i < $cnt_sheet ; $i++ ){
    // $ar_contents[] = $spreadsheet -> getSheet($i) -> toArray(); //シート内全データの取得
    $sheet = $spreadsheet->getSheet($i);
    // echo $sheet->getTitle();
    $val_title = $sheet->getTitle();

    // $val_tmp = $sheet->getCell('A2')->getValue();
    $val_tmp = $sheet->getCell($tmp_cell)->getValue();

    $ar_val[] = array($val_title=>$val_tmp);
}

// var_dump($ar_val);
?>