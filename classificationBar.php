
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
    <option value="prize">Prize</option>
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
?>
    <h5>Related Sub-categories</h5><hr>
<?php
require_once("mySqli.php");
if(isset($_POST['attributeClassifi']))
{
    if(strpos($_SERVER['QUERY_STRING'], "&classifi=".$_POST['attributeClassifi']) === false)
    {
        header("Location: index.php?".$_SERVER['QUERY_STRING']."&classifi=".$_POST['attributeClassifi']);
    }
    else
    {
        header("Location: index.php?".$_SERVER['QUERY_STRING']);
    }
}
if(isset($_POST['prize']))
{
    if(strpos($_SERVER['QUERY_STRING'], "&prize=".$_POST['prize']) === false)
    {
        header("Location: index.php?".$_SERVER['QUERY_STRING']."&prize=".$_POST['prize']);
    }
    else
    {
        header("Location: index.php?".$_SERVER['QUERY_STRING']);
    }
}
if(isset($_POST['shippment']))
{
    if(strpos($_SERVER['QUERY_STRING'], "&freeShippment") === false)
    {
        header("Location: index.php?".$_SERVER['QUERY_STRING']."&freeShippment");
    }
}
else if(isset($_POST['uncheck']))
{
    header("Location: index.php?".str_replace("&freeShippment", '', $_SERVER['QUERY_STRING'])."");
}

if(isset($_POST['order']))
{
    if(strpos($_SERVER['QUERY_STRING'],'&orderBy') === false)
    {
        header("Location: index.php?".$_SERVER['QUERY_STRING']."&orderBy=".$_POST['order']);
    }
    else
    {
        $get = mysql_fix_string($mySqli,$_GET['orderBy']);;
        header("Location: index.php?".str_replace("&orderBy=".$get, "&orderBy=".$_POST['order'], $_SERVER['QUERY_STRING'])."");
    }
}

    if(isset($categ))
    {
        $sqlAux= $mySqli->prepare("SELECT subcategories.* FROM subcategories INNER JOIN categoriesrelation ON subcategories.subCategoryId=categoriesrelation.subCategoryId WHERE categoriesrelation.categoryId=?");
        $sqlAux->bind_param("i",$categ);
    }
    else
    {
        $sqlAux= $mySqli->prepare("SELECT subcategories.* FROM subcategories ");
    }
    $sqlAux->execute();
    $resultAux=$sqlAux->get_result();
    for($i=0; $i<$resultAux->num_rows; $i++)
        {
            $rowAux=$resultAux->fetch_assoc();
            if(strpos($_SERVER['QUERY_STRING'], '&subCategory='.$rowAux['subCategoryId']) === false)
            {
                echo'<p><a href="index.php?'.$_SERVER['QUERY_STRING'].'&subCategory='.$rowAux['subCategoryId'].'">'.$rowAux['name'].'</a></p>';
            }
            else
            {
                echo'<p class="selected"><a href="index.php?'.str_replace("&subCategory=".$rowAux['subCategoryId'], '', $_SERVER['QUERY_STRING']).'">'.$rowAux['name'].'</a></p>';
            }
        }
    echo "<hr>";
    echo '<form method="post" action="index.php?'.$_SERVER['QUERY_STRING'].'">
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

