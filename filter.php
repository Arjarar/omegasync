<?php
	require_once(dirname(__FILE__) . '/../../config.php');
	
	global $CFG, $DB;
	
	$filter = $_REQUEST['filter'];
	$selectData = $DB->get_records_sql("SELECT * FROM mdl_local_omegasync WHERE id_unidad LIKE '%".$filter."%'");
	echo json_encode($selectData);
?>