<?php
/**
 * Created by PhpStorm.
 * User: peter wasonga
 * Date: 10/13/2015
 * Time: 11:33 PM
 */

require_once 'dbUtils.php';

$db = new dbUtils();
$request = $_GET["q"];

if($request == "byAge"){
    $response = $db->getAgeGroup('*','*');
}elseif($request == "byGender"){
    $response = $db->getGender('*','*');
}elseif($request == "byBloodGroupAplus"){
    $response = $db->getBloodGroup('APlus');
}elseif($request == "byRegion"){
    $response = $db->getRegions('*');
}elseif($request == "byTotalRequest"){
    $response = $db->getTotalRequest();
}elseif($request == "byTotalMale"){
    $response = $db->getTotalMale();
}elseif($request == "byTotalFemale"){
    $response = $db->getTotalFemale();
}
echo json_encode($response);