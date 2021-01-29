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

	$item = json_decode($json, true);

	$date = date("Y-m-d H:i:s");

	$user = mysql_fix_string($mySqli,$_GET['user']);
	$cuantity = mysql_fix_string($mySqli,$_GET['cuantity']);
	$shop = mysql_fix_string($mySqli,$_GET['shop']);

    $sql= $mySqli->prepare("SELECT * FROM orders WHERE itemId = ? AND shop = ? AND user=? AND paid=0");
    $sql->bind_param("iis",$item["id"], $shop, $user);
    $sql->execute();
    $result=$sql->get_result();

    $totalPrize = $item["prize"] * $cuantity;
    if($result->num_rows>0)
	    {
	      $row=$result->fetch_assoc();
	      $sql= $mySqli->prepare("UPDATE orders SET cuantity = cuantity + ?, totalPrize=totalPrize + ?, date=? WHERE orderId=?");
	      $sql->bind_param("idsi",$cuantity, $totalPrize, $date, $row['orderId']);

	}else
    {
    	$totalPrize += $item["shippment"];
      $sql= $mySqli->prepare("INSERT INTO orders(itemId, shop, user, cuantity, totalPrize) VALUES (?,?,?,?,?)");
      $sql->bind_param("issid",$item["id"], $shop, $user,$cuantity,$totalPrize);
    }
      $sql->execute();
      $result=$sql->get_result();

      echo $mySqli->error;

    $sql= $mySqli->prepare("SELECT * FROM orders WHERE user=? AND paid=0");
    $sql->bind_param("s",$user);
    $sql->execute();
    $result=$sql->get_result();
    for ($i=0; $i <$result->num_rows; $i++) { 
      $row=$result->fetch_assoc();
      
      $sql= $mySqli->prepare("UPDATE orders SET date=? WHERE orderId=?");

      $sql->bind_param("si",$date,$row['orderId']);
      $sql->execute();

    }

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
	$user = mysql_fix_string($mySqli,$_GET['user']);
	$paid = mysql_fix_string($mySqli,$_GET['order']);
	$sql= $mySqli->prepare("SELECT * FROM orders WHERE user=? AND paid=?");
    $sql->bind_param("si",$user,$paid);
    $sql->execute();
    $result=$sql->get_result();

	$json = [];
	//var_dump($data);
    for ($i=0; $i <$result->num_rows; $i++) { 
      $row=$result->fetch_assoc();
      
      $product = file_get_contents("http://localhost/PAPI/OnlineShop/getProducts.php?user=Bivago&password=bivago&item=".$row["itemId"]);
      $product = json_decode($product,true);
      $product["cuantity"] = $row["cuantity"];
      $product["date"] = $row["date"];
      $product["send"] = $row["send"];
		$sqlAux= $mySqli->prepare("SELECT * FROM addresses WHERE addressId=?");
          $sqlAux->bind_param("i",$row['addressId']);
          $sqlAux->execute();
          $resultAux=$sqlAux->get_result();
          $rowDir = $resultAux->fetch_assoc();
        $product["direction"] = $rowDir["direction"];

      array_push($json, $product);
    }
    $json = json_encode($json);
    header('Content-type: application/json');
	echo $json;
}
else if(isset($_GET["deleteOrder"]))
{
	$get = mysql_fix_string($mySqli,$_GET["deleteOrder"]);
	$sql= $mySqli->prepare("SELECT * FROM orders WHERE orderId=?");
    $sql->bind_param("s",$get);
    $sql->execute();
    $result=$sql->get_result();
    $row=$result->fetch_assoc();
    
    file_get_contents("http://localhost/PAPI/OnlineShop/getProducts.php?user=Bivago&password=bivago&item=".$row["itemId"]."&cuantity=-".$row["cuantity"]);

	  $sql= $mySqli->prepare("DELETE FROM orders WHERE orderId=?");
	  $sql->bind_param("i",$get);
	  $sql->execute();

}
else if(isset($_GET['address']) && isset($_GET['creditCard']))
{
	$address = mysql_fix_string($mySqli,$_GET['address']);
    $creditCard = mysql_fix_string($mySqli,$_GET['creditCard']);
	$user = mysql_fix_string($mySqli,$_GET['user']);
	$sql= $mySqli->prepare("SELECT * FROM orders WHERE user=? AND paid=0");
      $sql->bind_param("s",$user);
      $sql->execute();
      $result=$sql->get_result();

      $date = date("Y-m-d H:i:s");
      
      for($i=0; $i<$result->num_rows ;$i++)
      {
        $row=$result->fetch_assoc();

        file_get_contents("http://localhost/PAPI/OnlineShop/getProducts.php?user=Bivago&password=bivago&item=".$row["itemId"]."&cuantity=".$row["cuantity"]."&buy");

        $sql= $mySqli->prepare("UPDATE orders SET addressId=?, creditCardId=?, date=?, paid=1 WHERE orderId=?");
        $sql->bind_param("iisi",$address,$creditCard,$date,$row['orderId']);
        $sql->execute();
      }
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