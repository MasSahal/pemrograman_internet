<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Html tag dari php</title>
</head>
<?php
$array = [
    "<b>Membuat tag html dari array PHP</b>",
    "<h1>Ini adalah tag Heading 1</h1>",
    "<h2>Ini adalah tag Heading 2</h2>",
    "<h3>Ini adalah tag Heading 3</h3>",
    "<h4>Ini adalah tag Heading 4</h4>",
    "<h5>Ini adalah tag Heading 5</h5>",
    "<h6>Ini adalah tag Heading 6</h6>"
];
?>

<body>
    <?= $array[0]; ?>
    <?= $array[1]; ?>
    <?= $array[2]; ?>
    <?= $array[3]; ?>
    <?= $array[4]; ?>
    <?= $array[5]; ?>
    <?= $array[6]; ?>
</body>

</html>