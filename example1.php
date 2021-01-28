<?php // content="text/plain; charset=utf-8"

require_once ('../jpgraph/jpgraph.php');
require_once ('../jpgraph/jpgraph_line.php');

require('read_excel_data.php');

$ar_graph = array();
$ar_title = array();

for($i=0;$i<count($ar_val);$i++){
    foreach($ar_val[$i] as $key=>$value){
        array_unshift($ar_graph,$value);
        array_unshift($ar_title,$key);
    }
}

// $ydata = array(11,3,8,12,5,1,9,13,5,7);
$ydata = $ar_graph;

// Create the graph. These two calls are always required
$graph = new Graph(300,200);	
$graph->SetScale("textlin");
// $graph->img->SetMargin(50,90,40,50);
// $graph->xaxis->SetFont(FF_FONT1,FS_BOLD);
// $graph->title->SetFont(FF_MINCHO,FS_NORMAL,20);
// $graph->title->Set(mb_convert_encoding('タイトル', 'UTF-8', 'auto'));


// $graph->title->Set("Examples for graph");
$graph->title->Set(date("Y/m/d H:i:s"));
$graph->xaxis->SetTickLabels($ar_title);

// Create the linear plot
$lineplot=new LinePlot($ydata);
// $lineplot->SetLegend("Test 1");
$lineplot->SetColor("blue");


// Add the plot to the graph
$graph->Add($lineplot);

// Display the graph
$graph->Stroke();
?>