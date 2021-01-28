<?php // content="text/plain; charset=utf-8"

require_once ('../jpgraph/jpgraph.php');
require_once ('../jpgraph/jpgraph_pie.php');

require('read_excel_data.php');



// var_dump($ar_graph);
// exit();

// $data = array(40,60,21,33);
$data = $ar_graph;

$graph = new PieGraph(300,200);
$graph->clearTheme();
$graph->SetShadow();

// $graph->title->Set("A simple Pie plot");
$graph->title->Set(date("Y/m/d H:i:s"));

$p1 = new PiePlot($data);
$graph->Add($p1);
$graph->Stroke();

?>
