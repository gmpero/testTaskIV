<?php require('table.php'); ?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
<p>Вывод таблицы</p>


<table class="table">
    <?php foreach (array_chunk($studentDisciplines, count($studentDisciplines)) as $value): ?>
        <tr>
            <?php foreach ($studentDisciplines as $item): ?>
                <th><?= $item ?></th>
            <?php endforeach; ?>
        </tr>
    <?php endforeach; ?>

    <?php foreach ($filteredData as $name => $person): ?>
        <tr>
            <td><?= $name ?></td>
            <?php foreach ($person as $key => $value): ?>

                <td><?= $value ?></td>

            <?php endforeach ?>
        </tr>
    <?php endforeach ?>
</table>


</body>
</html>

