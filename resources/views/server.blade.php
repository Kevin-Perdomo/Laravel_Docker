<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <style>
    p {
        font-size: 2.0em;
    }
    </style>
</head>

<body>
    <h1 style="font-size: 2em;">PHP com Laravel</h1>
    <?php
    echo "<p>==========================================================================================================" . "</p>";
    echo "<p>hello-world! \u{1F30E}</p>";
    date_default_timezone_set("America/Sao_Paulo");
    ?>
    <?php
    echo "<p>Dia: " . date("D") . "</p>";
    ?>
    <?php
    echo "<p>Data: " . date("d/m/Y") . "</p>";
    ?>
    <?php
    echo "<p>Hora: " . date("G:i:s T") . "</p>";
    ?>
    <?php
    echo "<p> Welcome to the jungle" . "</p>";
    echo "<p>==========================================================================================================" . "</p>";    ?>
</body>

</html>