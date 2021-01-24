
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
?>
</div>
</div>

