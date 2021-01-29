<?php
require_once("mySqli.php");
if(isset($_POST['deleteId']))
{
  $post = mysql_fix_string($mySqli,$_POST['deleteId']);

  file_get_contents("http://localhost/PAPI/Group/API-grupo/metaSearch.php?deleteOrder=".$post);
  
}

if(isset($_POST['address']) && isset($_POST['creditCard']))
{
      file_get_contents("http://localhost/PAPI/Group/API-grupo/metaSearch.php?user=".$_SESSION["user"]."&address=".$_POST['address']."&creditCard=".$_POST['creditCard']);
      header('location:index.php');
}

$sql= $mySqli->prepare("SELECT * FROM orders WHERE user=? AND paid=0");
$sql->bind_param("s",$_SESSION['user']);
$sql->execute();
$result=$sql->get_result();
?>
<h2>Shopping Cart</h2>
<table class="table table-hover">
    <thead>
      <tr>
          <th>Name of product</th>
          <th>Prize</th>
          <th>Shippment</th>
          <th>Quantity</th>
          <th>Total Prize</th>
          <th></th>
          <?php 
          if(!isset($_GET["pay"]))
          {
            echo '<th></th>';
          }
          ?>
      </tr>
    </thead>
    <tbody>
      <?php
      	$totalPrize = 0;

        $orders = file_get_contents("http://localhost/PAPI/Group/API-grupo/metaSearch.php?user=".$_SESSION["user"]."&order=0");

        $orders = json_decode($orders,true);
      	for($i=0; $i<count($orders); $i++)
      	{
	          echo '<tr>';
	          echo '<td>'.$orders[$i]['name'].'</td>';
	          echo '<td>'.$orders[$i]['prize'].'$</td>';
	          echo '<td>'.$orders[$i]['shippment'].'$</td>';
	          echo '<td>'.$orders[$i]['cuantity'].'</td>';
	          $prize = $orders[$i]['cuantity']*$orders[$i]['prize']+$orders[$i]['shippment'];
	          echo '<td>'.$prize.'$</td>';
	          $totalPrize+=$prize;
	          echo '<td><img src="'.$orders[$i]["img"].'" width="100" height="130"></td>';
              if(!isset($_GET["pay"]))
              {
  	            echo '<td><form action="index.php?page=shoppingCart" method="post">
  					    <div class="form-group">
  					       <input type="text" hidden class="form-control" name="deleteId" value="'.$row['orderId'].'">
  					       <button type="submit" class="btn btn-primary">Take out</button>
  					    </div>
  					</form></td>';
            }
	          echo '</tr>';
      	}
      	echo '<tr><td></td><td></td><td></td><td><b>Total:<b></td><td><span class="prize">'.$totalPrize.'$</span></td>';
		if(!isset($_GET["pay"]) && $result->num_rows>0)
		{
			echo'<td><a href="index.php?page=shoppingCart&pay"><button type="submit" class="btn btn-warning">Finnish and buy <i class="fas fa-coins"></i></button><a></td>';
		}
      	echo '<td></td></tr>';
      ?>
    </tbody>
</table>
<?php

if(isset($_GET["pay"]))
{
	echo'<form action="index.php?page=shoppingCart&pay" method="post"> 
  <h4>Adress</h4>
  <select class="custom-select" name="address">';
      $sql= $mySqli->prepare("SELECT * FROM addresses WHERE user=?");
      $sql->bind_param("s",$_SESSION['user']);
      $sql->execute();
      $result=$sql->get_result();
      for($i=0; $i<$result->num_rows; $i++)
        {
          $row=$result->fetch_assoc();
          echo '<option value="'.$row['addressId'].'">'.$row['direction'].' '.$row['zipCode'].' '.$row['city'].' '.$row['country'].'</option>';
        }
echo'</select><hr>
<h4>Credit Card</h4>
<select class="custom-select" name="creditCard">';
      $sql= $mySqli->prepare("SELECT * FROM creditcard WHERE user=?");
      $sql->bind_param("s",$_SESSION['user']);
      $sql->execute();
      $result=$sql->get_result();

      for($i=0; $i<$result->num_rows; $i++)
        {
          $row=$result->fetch_assoc();
          echo '<option value="'.$row['creditCardId'].'">'.$row['name'].' nº: '.$row['number'].' '.$row['date'].'</option>';
        }
echo '</select><hr>
<button type="submit" class="btn btn-primary">Confirm</button>
</form>';
}