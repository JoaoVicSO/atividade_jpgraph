<?php

// content="text/plain; charset=utf-8"
require_once('jpgraph/jpgraph.php');
require_once('jpgraph/jpgraph_scatter.php');

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

$graph = new Graph(300, 200);
$graph->SetScale("textlin");

$graph->SetShadow();
$graph->img->SetMargin(40, 40, 40, 40);

$graph->title->Set("Simple impulse plot");
$graph->title->SetFont(FF_FONT1, FS_BOLD);

$sp1 = new ScatterPlot($data);
$sp1->mark->SetType(MARK_SQUARE);
$sp1->SetImpuls();

$graph->Add($sp1);
$graph->Stroke();

?>
