<?php

require_once('classes/PHPExcel.php');

/** Include path **/
set_include_path(get_include_path() . PATH_SEPARATOR . 'classes/PHPExcel/');

/** PHPExcel_IOFactory */
include 'classes/PHPExcel/IOFactory.php';
include 'classes/EditableGrid.php';

$grid = new EditableGrid();

$objPHPExcel = PHPExcel_IOFactory::load('randomdata.xls');
$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);

$data =array();
$c=0;

foreach ($sheetData as $key => $value) {
	if ( $c == 0) { // use the first row to build columns
		$columns = array_keys($value);
		foreach ($columns as $k => $v) {
				$grid->addColumn($v,$v,"string",NULL,true);
		}
	}
	$data[] = $value;
	$c++;
}

echo $grid->renderJSON($data);
