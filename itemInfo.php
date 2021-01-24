<?php
$maxAdds=6;
  $shop = $_GET["shop"];
  $item = $_GET["item"];
  $json = file_get_contents('http://localhost/PAPI/Group/API-grupo/metaSearch.php?shop='.$shop.'&item='.$item);
  $product = json_decode($json,true);
  echo $json;

  echo '<div class="row">
  <div class="col-md-auto">';
    echo '<img src="'.$product["img"].'">';
    echo '</div>';
    echo '<div class="col-md-auto">';
    echo '<h2>'.$product["name"].'</h2>
    <h5>Category:</h5><p><span class="category">'.$product["category"].'</span></p>';
    echo '<h5>Sub-Category:</h5><p><span class="category">';

    $subCategories = explode(":", $product["subCategory"]);
    for ($i=0; $i <count($subCategories) ; $i++) { 
      echo $subCategories[$i]." ";
    }
    echo '</span></p>';
    echo '<p>Prize: <span class="prize">'.$product['prize'].'$</span></p>';
    
    echo '<h5>Product description</h5>';
    echo '<p style="max-width: 500px;">'.$product['description'].'</p>';
    echo '<p>Stock: '.$product['stock'].'</p>';
    if($product['stock']>0)
    {
      if(isset($_SESSION['user']))
      {
        echo '<form action="index.php?page=itemInfo&item='.$item.'" method="post">
            <div class="form-group">
            <input type="text" hidden class="form-control" name="addCart" value="'.$product['id'].'">
            <button type="submit" class="btn btn-warning">Add to the cart</button>
            </div>
            </form>';
      }
      else
      {
        echo '<a href="index.php?page=login"><button type="submit" class="btn btn-warning">Add to the cart</button></a>';
      }
    }
    else
    {
      echo '<button type="button" class="btn btn-secondary" disabled>Sold Out</button>';
    }
    echo '</div>';
    echo '</div>';

// Items suggestions
    /*
    echo '<div class="row suggestions">';
    $sqlAux= $mySqli->prepare("SELECT * FROM categories INNER JOIN classification ON categories.categoryId=classification.categoryId INNER JOIN items ON classification.itemId=items.itemId WHERE items.itemId=?");
    $sqlAux->bind_param("i",$id);
    $sqlAux->execute();
    $resultAux=$sqlAux->get_result();
    $rowAux=$resultAux->fetch_assoc();

    $sql= $mySqli->prepare("SELECT items.*, categories.categoryId FROM items INNER JOIN classification ON items.itemId=classification.itemId INNER JOIN categories ON classification.categoryId=categories.categoryId WHERE items.itemId!=? AND categories.categoryId =?");
    $sql->bind_param("ii",$id,$rowAux["categoryId"]);
    $sql->execute();
    $result=$sql->get_result();
    $pointers= array();
        if($maxAdds>$result->num_rows)
    {
        $maxAdds=$result->num_rows;
    }
    for ($i=0; $i <$maxAdds ; $i++) { 
      
      do
      {

        $num = rand(0,$result->num_rows-1);
      
      }while (in_array($num,$pointers));

      array_push($pointers, $num);

    }
    for ($i=0; $i <$maxAdds; $i++)
    { 
        $result->data_seek($pointers[$i]);
        $row=$result->fetch_assoc();
        echo '<div class="col-md-auto">
        <div class="card text-center" style="width: 18rem;">
        <div class="card-body">';
        if(file_exists("css".DIRECTORY_SEPARATOR."ItemImg".DIRECTORY_SEPARATOR.$row['itemId'].$row['itemName'].".png"))
            echo '<a href = "index.php?page=itemInfo&item='.$row['itemId'].'"><img class="miniature" src="css'.DIRECTORY_SEPARATOR.'ItemImg'.DIRECTORY_SEPARATOR.$row['itemId'].$row['itemName'].'.png" width="200" height="260"></a>';
        else //If the image doesnt exists we give a default one
        {

            if(file_exists("css".DIRECTORY_SEPARATOR."Default".DIRECTORY_SEPARATOR.$rowAux['name']."Default.jpg"))
              echo '<a href = "index.php?page=itemInfo&item='.$row['itemId'].'"><img class="miniature" src="css'.DIRECTORY_SEPARATOR.'Default'.DIRECTORY_SEPARATOR.$rowAux['name'].'Default.jpg" width="200" height="260"></a>';
            else
              echo '<a href = "index.php?page=itemInfo&item='.$row['itemId'].'"><img class="miniature" src="css'.DIRECTORY_SEPARATOR.'Default'.DIRECTORY_SEPARATOR.'itemDefault.jpg" width="200" height="260"></a>';
        }
        echo '<a href = "index.php?page=itemInfo&item='.$row['itemId'].'"><h5 class="card-title">'.$row['itemName'].'</h5></a>';
        echo '<p class="card-text prize">'.$row['prize'].'$</p>';
        echo "</div></div></div>";

    }
    echo "</div>";*/
?>

