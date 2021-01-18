<?php

require_once("mySqli.php");
header('Access-Control-Allow-Origin: *');
header('content-type: application/json; charset=utf-8');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');

if(isset($_GET['search'])) {

	$json1 = file_get_contents("http://localhost/PAPI/OnlineShop/getProducts.php?user=CrapiKodaa&psw=12345&search=".$_GET["search"]);
	$json2 = file_get_contents("http://localhost/PAPI/IA-II/getProducts.php?user=CrapiKodaa&psw=12345&search=".$_GET["search"]);
	$json = json_encode(array_merge(json_decode($json1, true),json_decode($json2, true)));
	//var_dump($data);
	header('Content-type: application/json');
	echo $json;
}
else if(isset($_GET['filter']))
{
	$json1 = file_get_contents("http://localhost/PAPI/OnlineShop/getProducts.php?user=CrapiKodaa&psw=12345&filter=".$_GET["filter"]);
	$json2 = file_get_contents("http://localhost/PAPI/IA-II/getProducts.php?user=CrapiKodaa&psw=12345&filter=".$_GET["filter"]);
	$json = json_encode(array_merge(json_decode($json1, true),json_decode($json2, true)));
	//var_dump($data);
	header('Content-type: application/json');
	echo $json;
}
else
{
	$json1 = file_get_contents("http://localhost/PAPI/OnlineShop/getProducts.php?user=CrapiKodaa&psw=12345");
	$json2 = file_get_contents("http://localhost/PAPI/IA-II/getProducts.php?user=CrapiKodaa&psw=12345");
	$json = json_encode(array_merge(json_decode($json1, true),json_decode($json2, true)));
	//var_dump($data);
	header('Content-type: application/json');
	echo $json;
}

?>