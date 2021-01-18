<?php

require_once("mySqli.php");
header('Access-Control-Allow-Origin: *');
header('content-type: application/json; charset=utf-8');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');

if(isset($_GET['search'])) {

	$json = file_get_contents("http://localhost/PAPI/OnlineShop/getProducts.php?user=CrapiKodaa&psw=12345&search=".$_GET["search"]);
	//var_dump($data);
	header('Content-type: application/json');
	echo $json;
}
else if(isset($_GET['filter']))
{
	//$json = file_get_contents("https://apimlozanoo20.000webhostapp.com/OnlineShop/getProducts.php?user=CrapiKodaa&psw=12345&search=".$_GET["search"]);
	//var_dump($data);
	header('Content-type: application/json');
	echo $json;
}
else
{
	$json = file_get_contents("http://localhost/PAPI/OnlineShop/getProducts.php?user=CrapiKodaa&psw=12345");
	//var_dump($data);
	header('Content-type: application/json');
	echo $json;
}

?>