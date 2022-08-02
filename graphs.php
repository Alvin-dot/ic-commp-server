<?php
// Add these lines in case of error 500 problems
// ini_set('max_execution_time', '256'); //max_execution_time','0' <- unlimited time
// ini_set('memory_limit', '512M');



if (isset($_GET['action']) && !empty($_GET['action'])) {
	$action 			= $_GET['action'];
	$pmu 				= (isset($_GET['pmu']) && !empty($_GET['pmu']) ? $_GET['pmu'] : "");
	$time_window 		= (isset($_GET['time_w']) && !empty($_GET['time_w']) ? $_GET['time_w'] : "");
	$sample_frequency 	= (isset($_GET['sample_freq']) && !empty($_GET['sample_freq']) ? $_GET['sample_freq'] : "");
	$segment_window 	= (isset($_GET['segment_window']) && !empty($_GET['segment_window']) ? $_GET['segment_window'] : "");
	$segment_overlap 	= (isset($_GET['segment_overlap']) && !empty($_GET['segment_overlap']) ? $_GET['segment_overlap'] : "");
	$filter_lower 		= (isset($_GET['filter_lower']) && !empty($_GET['filter_lower']) ? $_GET['filter_lower'] : "");
	$filter_higher 		= (isset($_GET['filter_higher']) && !empty($_GET['filter_higher']) ? $_GET['filter_higher'] : "");
	$outlier_constant 	= (isset($_GET['outlier_constant']) && !empty($_GET['outlier_constant']) ? $_GET['outlier_constant'] : "");
	switch ($action) {
		case 'startup':
			
			// startup(
			// 	$pmu, 
			// 	$time_window, 
			// 	$sample_frequency, 
			// 	$segment_window,
			// 	$segment_overlap,
			// 	$filter_lower,
			// 	$filter_higher,
			// 	$outlier_constant,
			// );
			
			// echo($action);
			// echo($pmu);
			// echo($time_window);
			// echo($sample_frequency + "\n");
			// echo($segment_window + "\n");
			// echo($segment_overlap + "\n");
			// echo($filter_lower + "\n");
			// echo($filter_higher + "\n");
			// echo($outlier_constant + "\n");

			$pmu = "agrarias";
			$time_window = 20;
			$sample_freq = 120;
			$segment_window = 100;
			$segment_overlap = 50;
			$filter_lower = 0.3;
			$filter_higher = 7.0;
			$outlier_constant = 3.5;

			// Execute the python script with the JSON data
			$results = shell_exec("/opt/ic-commp/bin/python3 /opt/ic-commp/ic-commp/startup.py $pmu $time_window $sample_freq $segment_window $segment_overlap $filter_lower $filter_higher $outlier_constant");
			// $results = shell_exec("D:/Alvaro/Faculdade/TCC/Source/ic-commp-welch-backend/venv/Scripts/python.exe D:/Alvaro/Faculdade/TCC/Source/ic-commp-welch-backend//startup.py $pmu $time_w $sample_freq $segment_window $segment_overlap $filter_lower $filter_higher $outlier_constant");
			
			echo json_decode($results);

			break;
	}
}

// Main function, gets data from startup.py
// TODO: Mudar o path e o interpreter do programa em python
function startup($pmu, $time_w, $sample_freq, $segment_window, $segment_overlap, $filter_lower, $filter_higher, $outlier_constant)
{

}
