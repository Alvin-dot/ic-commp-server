<?php
if(isset($_GET['action']) && !empty($_GET['action'])) {
	$action = $_GET['action'];
	$pmu = (isset($_GET['pmu']) && !empty($_GET['pmu']) ? $_GET['pmu'] : "");
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
	}
}

function graph($filename) {
	$coord = array(
		"success" => false,
		"data" => array("x" => array(), "y" => array()),
		"update" => 0,
		"last_update" => -1
	);
	$file = $filename;
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
	$filename = "/opt/R3LS/pmu_port";
	$prev_pmu = -1;
	$response = "";
	if(file_exists($filename)) 
	{
		$handle = fopen($filename, "r");
		$prev_pmu = fgetcsv($handle)[0];
	}
	if($prev_pmu != $pmu || $prev_pmu < 0) {
		unlink($filename);
		$file = fopen($filename, "w");
		fwrite($file, $pmu);
		fclose($file);
		$response = "PMU changed";
	}
	else $response = "PMU not changed";

	$return = array("success" => true, "response" => $response);
	
	echo json_encode($return);
}

function get_pmu_port() { 
	$filename = "/opt/R3LS/pmu_port";
	$pmu = -1;
	$response = "";
	if(file_exists($filename)) 
	{
		$handle = fopen($filename, "r");
		$pmu = fgetcsv($handle)[0];
	}
	$return = array("success" => true, "port" => $pmu);
	
	echo json_encode($return);
}

function graph3() {
	$coord = array(
		"success" => true,
		"cluster0" => array("x" => array(), "y" => array()), 
		"cluster1" => array("x" => array(), "y" => array()), 
		"cluster2" => array("x" => array(), "y" => array()), 
		"cluster3" => array("x" => array(), "y" => array()), 
		"cluster4" => array("x" => array(), "y" => array()), 
		"cluster5" => array("x" => array(), "y" => array()), 
		"cluster6" => array("x" => array(), "y" => array()), 
		"cluster7" => array("x" => array(), "y" => array()), 
		"centroide" => array("x" => array(), "y" => array()),
		"linha_vertical" => 0);

	$file = "/opt/R3LS/Grafico3.centroide";
	if(file_exists($file)) {
		$handle = fopen($file, "r");
		while(($data = fgetcsv($handle)) !== FALSE) {
			$coord["centroide"]["x"][] = $data[0];
			$coord["centroide"]["y"][] = $data[1];
	 	}
	} 
	else $coord['success'] = false;

 	for($i = 0; $i < 8; $i++) {
 		$file = "/opt/R3LS/Grafico3.cluster.".$i;
 		if(file_exists($file) && $coord['success'] == true) {
	 		$index = "cluster" . $i;
	 		$handle = fopen($file, "r");
			while(($data = fgetcsv($handle)) !== FALSE) {
				$coord["cluster".$i]["x"][] = $data[0];
				$coord["cluster".$i]["y"][] = $data[1];
		 	}
 		}
 		else $coord['success'] = false;
 	}

 	$file = "/opt/R3LS/Grafico3.linha_vertical";
 	if(file_exists($file) && $coord['success'] == true) {
	 	$handle = fopen($file, "r");
	 	$coord["linha_vertical"] = fgetcsv($handle);
 	}
 	else $coord['success'] = false;

	echo json_encode($coord);
}

function get_status() { 
	$filename = "/var/www/html/welch/status.csv";
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