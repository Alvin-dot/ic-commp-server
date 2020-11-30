<?php
if(isset($_GET['action']) && !empty($_GET['action'])) {
	$action = $_GET['action'];
	$pmu = (isset($_GET['pmu']) && !empty($_GET['pmu']) ? $_GET['pmu'] : "");
	$time_window = (isset($_GET['time_w']) && !empty($_GET['time_w']) ? $_GET['time_w'] : "");

	switch($action) {
		case 'graph1': 
			graph("Grafico1.csv"); 
			break;
		case 'graph2': 
			graph("Grafico2.csv");
			break;
		case 'status':
			get_status();
			break;
		case 'change_pmu_port':
			change_pmu_port($pmu);
			break;
		case 'change_time_window':
			change_time_window($time_window);
			break;
	}
}

function graph($filename) {
	$coord = array(
		"success" => false,
		"data" => array("x" => array(), "y" => array()),
		"update" => 0,
		"last_update" => -1
	);
	$file = "C:\Users\alvar\Desktop\IC COMMP\ic-commp-server\\".$filename;
	if(file_exists($file)) {
		$handle = fopen($file, "r");
		$coord['success'] = true;
		while(($data = fgetcsv($handle)) !== FALSE) {
			$coord['data']['x'][] = $data[0];
			$coord['data']['y'][] = $data[1];
			if($data[2] == 1) $coord['update'] = $data[0];
		}
		 $coord['last_update'] = date("d/m/Y H:i:s", filemtime($file));
	}
	
	echo json_encode($coord);
}


function change_pmu_port($pmu) { 
	$filename = "pmu_port.csv";
	unlink($filename);
	$file = fopen($filename, "w");
	fwrite($file, $pmu);
	fclose($file);
	$response = "PMU changed";
	
	$return = array("success" => true, "response" => $response);
	
	echo json_encode($return);
}

function change_time_window($time_w) { 
	$filename = "pmu_time_window.csv";
	unlink($filename);
	$file = fopen($filename, "w");
	fwrite($file, $time_w);
	fclose($file);
	$response = "Time window changed";
	
	$return = array("success" => true, "response" => $response);
	
	echo json_encode($return);
}

function get_status() { 
	$filename = "./status.csv";
	$status = "loading";
	$return = array("success" => false, "status" => $status);
	if(file_exists($filename)) 
	{
		$handle = fopen($filename, "r");
		$status = fgetcsv($handle)[0];
		$return["status"] = $status;
		$return["success"] = true;
	}
	
	echo json_encode($return);
}
?>