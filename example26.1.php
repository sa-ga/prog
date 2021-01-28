<?php // content="text/plain; charset=utf-8"

require_once ('../jpgraph/jpgraph.php');
require_once ('../jpgraph/jpgraph_pie.php');

require('read_excel_data.php');

$ar_graph = array();
$ar_title = array();

for($i=0;$i<count($ar_val);$i++){
    foreach($ar_val[$i] as $key=>$value){
        array_unshift($ar_graph,$value);
        array_unshift($ar_title,$key);
    }
}

// $data = array(40,60,21,33);
$data = $ar_graph;

$graph = new PieGraph(300,200);
$graph->clearTheme();
$graph->SetShadow();

$graph->title->Set(date("Y/m/d H:i:s"));
$graph->title->SetFont(FF_FONT1,FS_BOLD);

$p1 = new PiePlot($data);
$p1->SetLegends($ar_title);
$p1->SetCenter(0.4);

$graph->Add($p1);
$graph->Stroke();

?>
