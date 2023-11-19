<?php
require "bd.php";


$studentDisciplines = [];
$studentDisciplines += array_unique(array_column($data, 1));
// array_values не обязателен, т.к. сортировка поправит ключи
//$school_subjects = array_values($school_subjects);
sort($studentDisciplines);


$filteredData = [];
foreach ($data as $value) {
    $studentName = $value[0];
    $studentDiscipline = $value[1];
    $studentGrade = $value[2];

    if (!array_key_exists($studentName, $filteredData)) {
        $filteredData[$studentName] = [];
        foreach ($studentDisciplines as $discipline) {
            $filteredData[$studentName][$discipline] = [null];
        }
    }

    $filteredData[$studentName][$studentDiscipline][] += $studentGrade;
}

// Суммируем все баллы по предметам
foreach ($filteredData as $key1 => $value1) {
    foreach ($value1 as $key2 => $value2) {
        $a = array_sum($value2);
        $filteredData[$key1][$key2] = $a;

        if ($a == 0) {
            $filteredData[$key1][$key2] = '';
        }
    }
}

array_unshift($studentDisciplines, '');
ksort($filteredData);
//print_r($filteredData);