<?php
// Add these lines in case of error 500 problems
ini_set('max_execution_time','256'); //max_execution_time','0' <- unlimited time
ini_set('memory_limit','512M');

if(isset($_GET['action']) && !empty($_GET['action'])) 
{
	$action = $_GET['action'];
	$pmu = (isset($_GET['pmu']) && !empty($_GET['pmu']) ? $_GET['pmu'] : "");
	$time_window = (isset($_GET['time_w']) && !empty($_GET['time_w']) ? $_GET['time_w'] : "");
	$sample_frequency = (isset($_GET['sample_freq']) && !empty($_GET['sample_freq']) ? $_GET['sample_freq'] : "");
	switch($action) {
		case 'startup': 
			startup($pmu, $time_window, $sample_frequency); 
			break;
	}
}

// Main function, gets data from startup.py
// TODO: Mudar o path e o interpreter do programa em python
function startup($pmu, $time_w, $sample_freq) {
	
    // Execute the python script with the JSON data
	$results = shell_exec("/opt/ic-commp/bin/python3 /opt/ic-commp/ic-commp/startup.py $pmu $time_w $sample_freq");

	// $results = shell_exec("python C:/Users/alvar/Desktop/IC-COMMP/ic-commp/startup.py $pmu $time_w $sample_freq");

	$data_results = json_decode($results, true);

	echo json_encode($data_results);
   
}
