<?php

$pmu = "cabine";
$time_w = 30;

// Execute the python script with the JSON data
$results = shell_exec("python C:\Users\alvar\Desktop\welch_json_test\ic-commp\\startup.py $pmu $time_w");

$data_results = json_decode($results, true);

echo "first off gone\n";

//$data_freq = json_encode((object) $data_results["freq"]);
//$data_time = json_encode((object) $data_results["date"]);

$data_freq = json_encode($data_results["freq"]);
$data_time = json_encode($data_results["date"]);

$results = shell_exec("python C:\Users\alvar\Desktop\welch_json_test\ic-commp\\refresh.py $pmu '$data_freq' '$data_time'");

$data_results = json_decode($results, true);

print_r ($results);


?>