<?php
require('connection.php');
ini_set('max_execution_time', 1000);
$collection = $database->selectCollection('AH');
$collection_item = $database->selectCollection('item_list');
$date_modifield = $database->selectCollection('flag');

$api_key = getenv('WOW');
$list = array();
$name = array();
$str = file_get_contents('https://us.api.battle.net/wow/auction/data/dreadmaul?locale=en_US&apikey='.$api_key);
$json = json_decode($str, true); // decode the JSON into an associative array
$data_url = $json['files'][0]['url'];
// $lastModified = $json['files'][0]['lastModified'];
// $currentTime = gmdate($format);
// $interval = date_diff(date_create($lastModified), date_create($currentTime));
// $min=$interval->format('%i');
// $sec=$interval->format('%s');
// $date_modifield->save(array("last_update" => $lastModified));


$json_data = json_decode(file_get_contents($data_url),true);
$ah_data = $json_data['auctions'];
 
$collection->remove(array(),array('w' => true));
foreach ($ah_data as $key=>$value) {

    $value['viable'] = round($value['buyout']/ $value['quantity'],2);
    $collection->insert($value);
    array_push($list,$value['item']);


}
print_r('Successfully Collect Data with '.count($ah_data).' Records');

$item_list = array_unique($list);
sort($item_list);
// $collection_item->insert($item_list);
// $collection_item->remove(array(),array('w' => true));
foreach($item_list as $val){

$exist = $collection_item->findOne(array('item' => $val));
if(empty($exist)){

$item_name = file_get_contents('https://us.api.battle.net/wow/item/'.$val.'?locale=en_US&apikey='.$api_key);
// print "<br>";
// print_r('Data: '.$item_name.'');
$json_item = json_decode($item_name, true); // decode the JSON into an associative array
// $name[$json_item['name']] = $val;
$collection_item->insert(array("name" => strtoupper($json_item['name']), "item" => $val ));

} 
}

// $collection_item->insert($name);

// $collection_item->remove(array(),array('w' => true));
// $collection_item->insert($name);

print "<br>";
print_r('Successfully insert unique with '.count($item_list).' Records');
print "<br>";



?>