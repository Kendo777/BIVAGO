<?php

require_once("mySqli.php");
header('Access-Control-Allow-Origin: *');
header('content-type: application/json; charset=utf-8');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');

if(isset($_GET['search'])) {

	$json1 = file_get_contents("http://localhost/PAPI/OnlineShop/getProducts.php?user=Bivago&password=bivago&search=".$_GET["search"]);
	$json2 = file_get_contents("http://localhost/PAPI/IA-II/getProducts.php?search=".$_GET["search"]);
	$json = json_encode(array_merge(json_decode($json1, true),json_decode($json2, true)));
	//var_dump($data);
	header('Content-type: application/json');
	echo $json;
}
else if(isset($_GET['filter']))
{
	$json1 = file_get_contents("http://localhost/PAPI/OnlineShop/getProducts.php?user=Bivago&password=bivago&filter=".$_GET["filter"]);
	$json2 = file_get_contents("http://localhost/PAPI/IA-II/getProducts.php?filter=".$_GET["filter"]);
	$json = json_encode(array_merge(json_decode($json1, true),json_decode($json2, true)));
	//var_dump($data);
	header('Content-type: application/json');
	echo $json;
}
else if(isset($_GET['shop']) && isset($_GET['item']) && isset($_GET['cuantity']))
{
	if($_GET['shop'] == "Steampunk")
	{
		$json = file_get_contents("http://localhost/PAPI/OnlineShop/getProducts.php?user=Bivago&password=bivago&item=".$_GET["item"]."&cuantity=".$_GET['cuantity']);
	}
	else if($_GET['shop'] == "Compopop")
	{
		$json = file_get_contents("http://localhost/PAPI/IA-II/getItem.php?item=".$_GET["item"]."&cuantity=".$_GET['cuantity']);
	}
	//var_dump($data);
	header('Content-type: application/json');
	echo $json;
}
else if(isset($_GET['shop']) && isset($_GET['item']))
{
	if($_GET['shop'] == "Steampunk")
	{
		$json = file_get_contents("http://localhost/PAPI/OnlineShop/getProducts.php?user=Bivago&password=bivago&item=".$_GET["item"]);
	}
	else if($_GET['shop'] == "Compopop")
	{
		$json = file_get_contents("http://localhost/PAPI/IA-II/getItem.php?item=".$_GET["item"]);
	}
	//var_dump($data);
	header('Content-type: application/json');
	echo $json;
}
else if(isset($_GET["order"]))
{
    $orderId = $_GET["order"];




    $sql= $mySqli->prepare("DELETE FROM orders WHERE orderId=?");
    $sql->bind_param("i",$orderId);
    $sql->execute();
}
else
{
	$json1 = file_get_contents("http://localhost/PAPI/OnlineShop/getProducts.php?user=Bivago&password=bivago");
	$json2 = file_get_contents("http://localhost/PAPI/IA-II/getProducts.php");
	$json = json_encode(array_merge(json_decode($json1, true),json_decode($json2, true)));
	//var_dump($data);
	header('Content-type: application/json');
	echo $json;
}

?>