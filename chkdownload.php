<?php
include 'dbconn_new.php';



$sql=("SELECT * FROM `checklist` ORDER BY date DESC,time DESC");
$result=$conn->query($sql);
$checklist= array();



if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $checklist[] = $row;
    }
}

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=checklist-export.csv');
$output = fopen('php://output', 'w');
fputcsv($output, array('id', 'date', 'time', 'chacker','area','remark','record_date'));

if (count($checklist) > 0) {
    foreach ($checklist as $row) {
        fputcsv($output, $row);
    }
}


?>