<?php

$pmu = "eficiencia";
$time_w = 30;
$sample_freq = 5;

// Execute the python script with the JSON data
$results = shell_exec("python C:\Users\alvar\Desktop\IC-COMMP\ic-commp\\startup.py $pmu $time_w $sample_freq");

$data_results = json_decode($results, true);

print_r($data_results);
