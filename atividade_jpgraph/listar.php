<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atividade Gerando gráficos com jpgraph</title>
</head>
<body>

<?php
$pasta = 'graficos';

if (is_dir($pasta)) {
    $diretorio = dir($pasta);

    while (($arquivo = $diretorio->read()) !== false) {
        if (substr($arquivo, -3) == 'php') {
            echo '<h1>' . $arquivo . '</h1>';
            echo '<img src="' . $pasta . '/' . $arquivo . '" style="height: 250px; width: 400px;" alt="' . $arquivo . '">';
            echo '<br><br>';
        }
    }

    $diretorio->close();
} else {
    echo 'A pasta não existe.';
}
?>

</body>
</html>
