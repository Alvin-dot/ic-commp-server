<?php

$pmu = "agrarias";
$time_w = 20;
$sample_freq = 120;
$segmentWindow = 100;
$segmentOverlap = 50;
$filter_lower = 0.3;
$filter_higher = 7.0;
$outlier_constant = 3.5;

$results = shell_exec("/opt/ic-commp/bin/python3 /opt/ic-commp/ic-commp/startup.py $pmu $time_w $sample_freq $segmentWindow $segmentOverlap $filter_lower $filter_higher $outlier_constant");
// $results = shell_exec("D:\Alvaro\Faculdade\TCC\Source\ic-commp-welch-backend\\venv\Scripts\python.exe D:\Alvaro\Faculdade\TCC\Source\ic-commp-welch-backend\\startup.py $pmu $time_w $sample_freq $segmentWindow $segmentOverlap $filter_lower $filter_higher $outlier_constant $view");

// print_r($results);

$data_results = json_decode($results, true);

print_r(json_decode($results, true));
