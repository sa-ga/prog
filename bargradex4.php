<?php // content="text/plain; charset=utf-8"

require_once ('../jpgraph/jpgraph.php');
require_once ('../jpgraph/jpgraph_bar.php');

require('read_excel_data.php');

$ar_graph = array();
$ar_title = array();

for($i=0;$i<count($ar_val);$i++){
    foreach($ar_val[$i] as $key=>$value){
        array_unshift($ar_graph,$value);
        array_unshift($ar_title,$key);
    }
}

// We need some data
// $datay=array(0.3031,0.3044,0.3049,0.3040,0.3024,0.3047);
$datay = $ar_graph;

// Setup the graph.
$graph = new Graph(400,200);
$graph->clearTheme();
$graph->img->SetMargin(60,30,30,40);
$graph->SetScale("textlin");
$graph->SetMarginColor("teal");
$graph->SetShadow();

// Set up the title for the graph
$graph->title->Set(date("Y/m/d H:i:s"));
$graph->title->SetColor("white");
$graph->title->SetFont(FF_VERDANA,FS_BOLD,12);

// Setup color for axis and labels
$graph->xaxis->SetColor("black","white");
$graph->yaxis->SetColor("black","white");

// Setup font for axis
$graph->xaxis->SetFont(FF_VERDANA,FS_NORMAL,10);
$graph->yaxis->SetFont(FF_VERDANA,FS_NORMAL,10);

// Setup X-axis title (color & font)
$graph->xaxis->title->Set("X-axis");
$graph->xaxis->title->SetColor("white");
$graph->xaxis->title->SetFont(FF_VERDANA,FS_BOLD,10);
$graph->xaxis->SetTickLabels($ar_title);

// Create the bar pot
$bplot = new BarPlot($datay);
$bplot->SetWidth(0.6);

// Setup color for gradient fill style
$tcol=array(100,100,255);
$fcol=array(255,100,100);
$bplot->SetFillGradient($fcol,$tcol,GRAD_HOR);
$graph->Add($bplot);

// Finally send the graph to the browser
$graph->Stroke();
?>
