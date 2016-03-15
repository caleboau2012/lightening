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

$inputFileName = 'data.xlsx';

$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);

$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);

$substation = array(
    "ID" => 1, "coord" => array(
        "lat" => 6.60416666667,
        "lng" => 3.36611111111
    ),
    "data" => array( "name" => "The Substation")
);
$circuit = array(array(), array(), array(), array(), array(), array());
$pole = array();

for($i = 10; $i <= 81; $i++){
    switch($sheetData[$i]['B']){
        case 1:
        case 2:
        case 3:
            $pole['data'] = array("name" => $sheetData[$i]['D']);
            $lngDegree = substr($sheetData[$i]['F'], 0, strpos($sheetData[$i]['F'], "º"));
            $lngMinute = substr($sheetData[$i]['F'], (strpos($sheetData[$i]['F'], " ") + 1), 2);
            $lngSeconds = substr($sheetData[$i]['F'], (strpos($sheetData[$i]['F'], "'") + 2), 2);
            $pole['lng'] = floatval($lngDegree) + floatval($lngMinute / 60.0) + floatval($lngSeconds / 3600.0);

            $latDegree = substr($sheetData[$i]['E'], 0, strpos($sheetData[$i]['E'], "º"));
            $latMinute = substr($sheetData[$i]['E'], (strpos($sheetData[$i]['E'], " ") + 1), 2);
            $latSeconds = substr($sheetData[$i]['E'], (strpos($sheetData[$i]['E'], "'") + 2), 2);
            $pole['lat'] = floatval($latDegree) + floatval($latMinute / 60.0) + floatval($latSeconds / 3600.0);

            array_push($circuit[0], $pole);
            break;
        case 4:
        case 5:
        case 6:
            $pole['data'] = array("name" => $sheetData[$i]['D']);
            $lngDegree = substr($sheetData[$i]['F'], 0, strpos($sheetData[$i]['F'], "º"));
            $lngMinute = substr($sheetData[$i]['F'], (strpos($sheetData[$i]['F'], " ") + 1), 2);
            $lngSeconds = substr($sheetData[$i]['F'], (strpos($sheetData[$i]['F'], "'") + 2), 2);
            $pole['lng'] = floatval($lngDegree) + floatval($lngMinute / 60.0) + floatval($lngSeconds / 3600.0);

            $latDegree = substr($sheetData[$i]['E'], 0, strpos($sheetData[$i]['E'], "º"));
            $latMinute = substr($sheetData[$i]['E'], (strpos($sheetData[$i]['E'], " ") + 1), 2);
            $latSeconds = substr($sheetData[$i]['E'], (strpos($sheetData[$i]['E'], "'") + 2), 2);
            $pole['lat'] = floatval($latDegree) + floatval($latMinute / 60.0) + floatval($latSeconds / 3600.0);

            array_push($circuit[1], $pole);
            break;
        case 7:
        case 8:
        case 9:
            $pole['data'] = array("name" => $sheetData[$i]['D']);
            $lngDegree = substr($sheetData[$i]['F'], 0, strpos($sheetData[$i]['F'], "º"));
            $lngMinute = substr($sheetData[$i]['F'], (strpos($sheetData[$i]['F'], " ") + 1), 2);
            $lngSeconds = substr($sheetData[$i]['F'], (strpos($sheetData[$i]['F'], "'") + 2), 2);
            $pole['lng'] = floatval($lngDegree) + floatval($lngMinute / 60.0) + floatval($lngSeconds / 3600.0);

            $latDegree = substr($sheetData[$i]['E'], 0, strpos($sheetData[$i]['E'], "º"));
            $latMinute = substr($sheetData[$i]['E'], (strpos($sheetData[$i]['E'], " ") + 1), 2);
            $latSeconds = substr($sheetData[$i]['E'], (strpos($sheetData[$i]['E'], "'") + 2), 2);
            $pole['lat'] = floatval($latDegree) + floatval($latMinute / 60.0) + floatval($latSeconds / 3600.0);

        array_push($circuit[2], $pole);
            break;
        case 10:
        case 11:
        case 12:
            $pole['data'] = array("name" => $sheetData[$i]['D']);
            $lngDegree = substr($sheetData[$i]['F'], 0, strpos($sheetData[$i]['F'], "º"));
            $lngMinute = substr($sheetData[$i]['F'], (strpos($sheetData[$i]['F'], " ") + 1), 2);
            $lngSeconds = substr($sheetData[$i]['F'], (strpos($sheetData[$i]['F'], "'") + 2), 2);
            $pole['lng'] = floatval($lngDegree) + floatval($lngMinute / 60.0) + floatval($lngSeconds / 3600.0);

            $latDegree = substr($sheetData[$i]['E'], 0, strpos($sheetData[$i]['E'], "º"));
            $latMinute = substr($sheetData[$i]['E'], (strpos($sheetData[$i]['E'], " ") + 1), 2);
            $latSeconds = substr($sheetData[$i]['E'], (strpos($sheetData[$i]['E'], "'") + 2), 2);
            $pole['lat'] = floatval($latDegree) + floatval($latMinute / 60.0) + floatval($latSeconds / 3600.0);

            array_push($circuit[3], $pole);
            break;
        case 13:
        case 14:
        case 15:
            $pole['data'] = array("name" => $sheetData[$i]['D']);
            $lngDegree = substr($sheetData[$i]['F'], 0, strpos($sheetData[$i]['F'], "º"));
            $lngMinute = substr($sheetData[$i]['F'], (strpos($sheetData[$i]['F'], " ") + 1), 2);
            $lngSeconds = substr($sheetData[$i]['F'], (strpos($sheetData[$i]['F'], "'") + 2), 2);
            $pole['lng'] = floatval($lngDegree) + floatval($lngMinute / 60.0) + floatval($lngSeconds / 3600.0);

            $latDegree = substr($sheetData[$i]['E'], 0, strpos($sheetData[$i]['E'], "º"));
            $latMinute = substr($sheetData[$i]['E'], (strpos($sheetData[$i]['E'], " ") + 1), 2);
            $latSeconds = substr($sheetData[$i]['E'], (strpos($sheetData[$i]['E'], "'") + 2), 2);
            $pole['lat'] = floatval($latDegree) + floatval($latMinute / 60.0) + floatval($latSeconds / 3600.0);

            array_push($circuit[4], $pole);
            break;
        case 16:
        case 17:
        case 18:
            $pole['data'] = array("name" => $sheetData[$i]['D']);
            $lngDegree = substr($sheetData[$i]['F'], 0, strpos($sheetData[$i]['F'], "º"));
            $lngMinute = substr($sheetData[$i]['F'], (strpos($sheetData[$i]['F'], " ") + 1), 2);
            $lngSeconds = substr($sheetData[$i]['F'], (strpos($sheetData[$i]['F'], "'") + 2), 2);
            $pole['lng'] = floatval($lngDegree) + floatval($lngMinute / 60.0) + floatval($lngSeconds / 3600.0);

            $latDegree = substr($sheetData[$i]['E'], 0, strpos($sheetData[$i]['E'], "º"));
            $latMinute = substr($sheetData[$i]['E'], (strpos($sheetData[$i]['E'], " ") + 1), 2);
            $latSeconds = substr($sheetData[$i]['E'], (strpos($sheetData[$i]['E'], "'") + 2), 2);
            $pole['lat'] = floatval($latDegree) + floatval($latMinute / 60.0) + floatval($latSeconds / 3600.0);

            array_push($circuit[5], $pole);
            break;
    }
}

$substation['circuits'] = $circuit;

echo json_encode($substation);

file_put_contents('data.json', json_encode(array("substations" => array($substation))));