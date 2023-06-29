<?php

// content="text/plain; charset=utf-8"

require_once('jpgraph/jpgraph.php');
require_once('jpgraph/jpgraph_bar.php');

$pdo = new PDO("mysql:host=localhost;dbname=agenda", "aplicacao_agenda", "agenda123");

// Query para recuperar os dados do banco de dados
$query = "SELECT cd_sexo, COUNT(*) AS qtd FROM tb_pessoa GROUP BY cd_sexo";
$stmt = $pdo->prepare($query);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Armazena os dados em vetores
$labels = array();
$data = array();

foreach ($result as $row) {
    $labels[] = $row['cd_sexo'];
    $data[] = $row['qtd'];
}

// New graph with a drop shadow
$graph = new Graph(300, 200);
$graph->clearTheme();
$graph->SetShadow();

// Use a "text" X-scale
$graph->SetScale("textlin");

// Set title and subtitle
$graph->title->Set("Elementary barplot with a text scale");
$graph->title->SetFont(FF_FONT1, FS_BOLD);

// Create the bar plot
$b1 = new BarPlot($data);
$b1->SetLegend("Quantity");
//$b1->SetAbsWidth(6);
//$b1->SetShadow();

// The order the plots are added determines who's on top
$graph->Add($b1);

// Label do eixo X
$graph->xaxis->SetTickLabels($labels);

// Finally output the image
$graph->Stroke();

?>
