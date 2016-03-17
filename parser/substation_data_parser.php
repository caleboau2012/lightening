<?php
/**
 * Created by PhpStorm.
 * User: Mbakwe.Caleb
 * Date: 3/14/2016
 * Time: 11:25 AM
 */

/** Include path **/
set_include_path(get_include_path() . PATH_SEPARATOR . 'Classes/');

/** PHPExcel_IOFactory */
include 'PHPExcel/IOFactory.php';
include './MyReadFilter.php';

$inputFileName = 'substation_data.xlsx';

$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);

$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);

//$data = array(array());
//$range_end = ($sheetData[4]);
//die(json_encode($sheetData));
$headerColumns = range('A', 'Z');

//die(var_dump($sheetData[4][$headerColumns[1]]));

//Run through rows
for($i = 4; $i < sizeof($sheetData); $i++){
//    run through columns
    for($j = 0; $j < sizeof($sheetData[$i]); $j++){
        if($sheetData[$i][$headerColumns[$j]] == null)
            continue;
        else
            $data[$i - 4][$sheetData[3][$headerColumns[$j]]] = $sheetData[$i][$headerColumns[$j]];
    }
}

echo json_encode($data);

file_put_contents('substation_data.json', json_encode(array("substation_data" => $data)));