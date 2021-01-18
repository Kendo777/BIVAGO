
<div class="col-md-auto">
    <div class="classificationBar">
    <h7 style="color: red;"><a <?php 
    if(isset($_GET['search']))
        echo'onclick="changeProducts()"';
    else
        echo'onclick="changeProducts()"';
    ?>
    >Resset</a></h7>
    <h5>Order by:</h5><hr>
<form>
    <select class="form-control" id="orderBy" onchange="changeProductsByOrder(this.value)">
    <option value="name">Name</option>
    <option value="price">Price</option>
  </select>
  </form><hr>
<?php

    echo '<h5>Products</h5><hr>';
    $sqlAux= $mySqli->prepare("SELECT categories.* FROM categories ");
    $sqlAux->execute();
    $resultAux=$sqlAux->get_result();
    for($i=0; $i<$resultAux->num_rows; $i++)
        {
            $rowAux=$resultAux->fetch_assoc();
            if(strpos($_SERVER['QUERY_STRING'], '&product='.$rowAux['categoryId']) === false)
            {
                echo'<p><a  onclick="changeProductsByFilter('.$rowAux['categoryId'].')">'.$rowAux['name'].'</a></p>';
            }
            else
            {
                echo'<p class="selected"><a onclick="changeProductsByFilter(0)">'.$rowAux['name'].'</a></p>';
            }
        }
    echo '<hr><form method="post" action="index.php?'.$_SERVER['QUERY_STRING'].'">
  <div class="form-group">
    <label for="formControlRange">Prize</label>
    <input type="range" name="prize" class="form-control-range"min="0" max="100" value="';
    if(isset($_GET['prize']) && is_numeric($_GET['prize']))
    {
        echo $_GET['prize'].'" onchange="updateTextInput(this.value)">
    <p id="textInput">'.$_GET['prize'].'$</p>';
    }
    else
    {
        echo '0" onchange="updateTextInput(this.value)">
    <p id="textInput">0$</p>';
    }
    echo '  </div>
   <input type="submit">
</form><hr>';

echo '<form method="post" action="index.php?'.$_SERVER['QUERY_STRING'].'">
<div class="custom-control custom-checkbox form-group">
  <input type="hidden" name="uncheck"/>
  <input type="checkbox" name="shippment" class="custom-control-input" id="ShippmentCheckbox" ';
  if(isset($_GET["freeShippment"]))
  {
    echo "checked";
  }
  echo '>
  <label class="custom-control-label" for="ShippmentCheckbox">Free Shippment</label><br>
</div>
  <input type="submit">
</form><hr>';
?>
</div>
</div>

