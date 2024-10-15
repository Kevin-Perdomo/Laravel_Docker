</html>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Debug</title>
</head>
<body>
<h1>Testando Xdebug no Laravel</h1>
    <?php
    // Exemplo de código PHP para fazer debug
    $x = 10;
    $y = 20;
    $result = $x + $y;

    // Ponto de parada para o Xdebug
    xdebug_break();

    echo "O resultado de $x + $y é $result";
    ?>
</body>
</html>