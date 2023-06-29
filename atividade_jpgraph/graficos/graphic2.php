<?php

// content="text/plain; charset=utf-8"
// Basic contour plot example

require_once('jpgraph/jpgraph.php');
require_once('jpgraph/jpgraph_contour.php');

$pdo = new PDO("mysql:host=localhost;dbname=agenda", "aplicacao_agenda", "agenda123");

// Query para recuperar os dados do banco de dados
$query = "SELECT data_value FROM tb_contour_data";
$stmt = $pdo->prepare($query);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_COLUMN);

// Organizar os valores em uma matriz 3x3 (ou em uma matriz quadrada NxN)
$data = array_chunk($result, 3);

// Basic contour graph
$graph = new Graph(350, 250);
$graph->SetScale('intint');

// Adjust the margins to fit the margin
$graph->SetMargin(30, 100, 40, 30);

// Setup
$graph->title->Set('Basic contour plot');
$graph->title->SetFont(FF_ARIAL, FS_BOLD, 12);

// A simple contour plot with default arguments (e.g., 10 isobar lines)
$cp = new ContourPlot($data);

// Display the legend
$cp->ShowLegend();

$graph->Add($cp);

// ... and send the graph back to the browser
$graph->Stroke();

?>
