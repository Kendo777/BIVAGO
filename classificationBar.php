
<div class="col-md-auto">
    <div class="classificationBar">
    <h7 style="color: red;"><a style="cursor: pointer;"<?php 
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
    echo '<hr>
  <div class="form-group">
    <label for="formControlRange">Prize</label>
    <input type="range" name="prize" class="form-control-range"min="0" max="1000" value="0" onchange="updateTextInput(this.value)">
    <p id="textInput">0$</p>
    </div>
<hr>';

echo '<div class="custom-control custom-checkbox form-group">
  <input type="hidden" name="uncheck"/>
  <input type="checkbox" name="shippment" class="custom-control-input" id="ShippmentCheckbox">
  <label class="custom-control-label" for="ShippmentCheckbox">Free Shippment</label><br>
</div>';

    echo '<h5>Products</h5><hr>';
    $category = file_get_contents("http://localhost/PAPI/Group/API-grupo/metaSearch.php?category");
        $category = json_decode($category,true);
        for($i=0; $i<count($category); $i++)
        {
          echo '<p style="cursor: pointer;">'.$category[$i]["name"].'</p>';
        }
  echo '<h5>Related categories</h5><hr>';
      $subCategory = file_get_contents("http://localhost/PAPI/Group/API-grupo/metaSearch.php?subCategory");

        $subCategory = json_decode($subCategory,true);
        for($i=0; $i<count($subCategory); $i++)
        {
          echo '<p style="cursor: pointer;">'.$subCategory[$i]["name"].'</p>';
        }
?>
</div>
</div>

