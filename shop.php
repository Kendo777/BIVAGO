<?php 

$limitRow = 3;
$limitColumns = 5;
$limit = $limitRow*$limitColumns;


if(isset($_GET['product']))
{
    $categ = mysql_fix_string($mySqli,$_GET['product']);
}
if(isset($_POST["search"]))
{
  header( "Location: index.php?page=shop&search=".$_POST["search"]);
}
if(isset($_POST["pagination"]))
{
    if(strpos($_SERVER['QUERY_STRING'],'&pagination') === false)
    {
        header("Location: index.php?".$_SERVER['QUERY_STRING']."&pagination=".$_POST['pagination']);
    }
    else
    {
        $get = mysql_fix_string($mySqli,$_GET['pagination']);;
        header("Location: index.php?".str_replace("&pagination=".$get, "&pagination=".$_POST['pagination'], $_SERVER['QUERY_STRING'])."");
    }
}
if(isset($_POST["nextPage"]))
{
    if(strpos($_SERVER['QUERY_STRING'],'&pagination') === false)
    {
        header("Location: index.php?".$_SERVER['QUERY_STRING']."&pagination=2");
    }
    else
    {
        $get = mysql_fix_string($mySqli,$_GET['pagination']);;
        header("Location: index.php?".str_replace("&pagination=".$get, "&pagination=".($get+1), $_SERVER['QUERY_STRING'])."");
    }
}
if(isset($_POST["prevPage"]))
{
    $get = mysql_fix_string($mySqli,$_GET['pagination']);;
    header("Location: index.php?".str_replace("&pagination=".$get, "&pagination=".($get-1), $_SERVER['QUERY_STRING'])."");
}

if (isset($_GET["pagination"])) {
    $page = mysql_fix_string($mySqli,$_GET['pagination'])-1;
}
else
{
    $page = 0;
}

    $sqlQUERY ="SELECT DISTINCT items.* FROM items";
    $sqlQUERYWhere = "";
    $sqlQUERYOrder = "";
    $variables =array();
    $types = "";
    if(isset($_GET["product"]))
    {
        $get = mysql_fix_string($mySqli,$_GET['product']);
        $sqlQUERY=$sqlQUERY." INNER JOIN classification ON items.itemId=classification.itemId ";
        $sqlQUERYWhere.=" WHERE classification.categoryId=?";
        array_push($variables,$get);
        $types.="i";
    }
    if(isset($_GET["subCategory"]))
    {
        $sqlQUERY=$sqlQUERY." INNER JOIN subclasification ON items.itemId=subclasification.itemId";

        $query = explode("&", $_SERVER['QUERY_STRING']);
        for ($i=0; $i <count($query); $i++) 
        { 
            if(strpos($query[$i],"subCategory") !== false)
            {
                $get = explode("=", $query[$i]);
                $get = mysql_fix_string($mySqli,$get[1]);
                if(empty($sqlQUERYWhere))
                {
                    $sqlQUERYWhere.=" WHERE items.itemId IN (SELECT itemId FROM subclasification WHERE subCategoryId=?)";
                }
                else
                {
                    $sqlQUERYWhere.=" AND items.itemId IN (SELECT itemId FROM subclasification WHERE subCategoryId=?)";
                }
                array_push($variables,$get);
                $types.="i";
            }
        }
    }
    if(isset($_GET["attribute"]))
    {
        $sqlQUERY=$sqlQUERY." INNER JOIN itemattribute ON items.itemId=itemattribute.itemId";
        $query = explode("&", $_SERVER['QUERY_STRING']);
        for ($i=0; $i <count($query); $i++) 
        { 
            if(strpos($query[$i],"attribute") !== false)
            {
                $get = explode("=", $query[$i]);
                $get = mysql_fix_string($mySqli,$get[1]);
                if(empty($sqlQUERYWhere))
                {
                    $sqlQUERYWhere.=" WHERE items.itemId IN (SELECT itemId FROM itemattribute WHERE attributeId=?)";
                }
                else
                {
                    $sqlQUERYWhere.=" AND items.itemId IN (SELECT itemId FROM itemattribute WHERE attributeId=?)";
                }
                array_push($variables,$get);
                $types.="i";
            }
        }
    }
    if(isset($_GET["classifi"]))
    {
        if(strpos($sqlQUERY, " INNER JOIN itemattribute ON items.itemId=itemattribute.itemId") === false)
            $sqlQUERY=$sqlQUERY." INNER JOIN itemattribute ON items.itemId=itemattribute.itemId";

        $query = explode("&", $_SERVER['QUERY_STRING']);
        for ($i=0; $i <count($query); $i++) 
        { 
            if(strpos($query[$i],"classifi") !== false)
            {
                $get = explode("=", $query[$i]);
                $get = mysql_fix_string($mySqli,$get[1]);
                if(empty($sqlQUERYWhere))
                {
                    $sqlQUERYWhere.=" WHERE items.itemId IN (SELECT itemId FROM itemattribute WHERE value=?)";
                }
                else
                {
                    $sqlQUERYWhere.=" AND items.itemId IN (SELECT itemId FROM itemattribute WHERE value=?)";
                }
                array_push($variables,$get);
                $types.="s";
            }
        }
    }
    if(isset($_GET["prize"]))
    {
        $get = mysql_fix_string($mySqli,$_GET['prize']);
        if(empty($sqlQUERYWhere))
        {
            $sqlQUERYWhere.=" WHERE items.prize>=?";
        }
        else
        {
            $sqlQUERYWhere.=" AND items.prize>=?";
        }
        array_push($variables,$get);
        $types.="i";
    }
    if(isset($_GET["freeShippment"]))
    {
        if(empty($sqlQUERYWhere))
        {
            $sqlQUERYWhere.=" WHERE items.extra=0";
        }
        else
        {
            $sqlQUERYWhere.=" AND items.extra=0";
        }
    }
    if(isset($_GET["search"]))
      {
        if(empty($sqlQUERYWhere))
        {
            $sqlQUERYWhere.=" WHERE itemName LIKE ?";
        }
        else
        {
            $sqlQUERYWhere.=" AND itemName LIKE ?";
        }
        $get = mysql_fix_string($mySqli,$_GET['search']);
        $compare = "%".$get."%";
        array_push($variables,$compare);
        $types.="s";
    }
    if(isset($_GET["orderBy"]))
    {
        $get = mysql_fix_string($mySqli,$_GET['orderBy']);
        $sqlQUERYOrder = " ORDER BY ".$get;
    }
    if($types == "" && count($variables) == 0)
    {
        $sql = $mySqli->prepare($sqlQUERY);
    }
    else
    {
        $sql = $mySqli->prepare($sqlQUERY.$sqlQUERYWhere.$sqlQUERYOrder);
        $sql->bind_param($types,...$variables);
    }
        $sql->execute();
        $result=$sql->get_result();
        $result->data_seek($page*$limit);

?>
<div class="products">
    <?php 
            echo '<div class="row">';
            require_once("classificationBar.php");
            echo '<div class="col">';
            echo '<div class="row justify-content-md-center" id="items">
            <script type="text/javascript">
                changeProducts();
            </script>';

                /*if(isset($_GET["search"]))
                {
                    $json = file_get_contents("http://localhost/PAPI/Group/API-grupo/metaSearch.php?user=CrapiKodaa&psw=12345&search=".$_GET["search"]);
                }
                else
                {
                    $json = file_get_contents("http://localhost/PAPI/Group/API-grupo/metaSearch.php?user=CrapiKodaa&psw=12345");
                }
                $data = json_decode($json,true);

            
            $k = $page*$limit;
            for ($i=0; $i <$limitRow; $i++) 
            { 
                echo '<div class="row justify-content-md-center">';
                for ($j=0; $j <$limitColumns; $j++) 
                { 
                    if($data != null && $k<count($data))
                        $product = $data[$k];
                    else
                        $product= null;
                    if($product)
                    {
                        echo '<div class="col-md-auto">
                                <div class="card text-center" style="width: 18rem;">';
                        //<img class="card-img-top" src="..." alt="Card image cap">
                        echo '<div class="card-body">';
                        if(file_exists("css".DIRECTORY_SEPARATOR."ItemImg".DIRECTORY_SEPARATOR.$product['id'].$product['name'].".png"))
                            echo '<td><a href = "index.php?page=itemInfo&item='.$product['id'].'"><img src="css'.DIRECTORY_SEPARATOR.'ItemImg'.DIRECTORY_SEPARATOR.$product['id'].$product['name'].'.png" width="200" height="260"></a></td>';
                        else
                        {
                            if(isset($categ))
                            {
                                $sqlAux= $mySqli->prepare("SELECT categories.* FROM categories WHERE categories.categoryId=?");
                                $sqlAux->bind_param("i",$categ);
                            }
                            else
                            {
                                $sqlAux= $mySqli->prepare("SELECT categories.* FROM categories INNER JOIN classification ON categories.categoryId=classification.categoryId WHERE classification.itemId=?");
                                $sqlAux->bind_param("i",$product['id']);
                            }
                            $sqlAux->execute();
                            $resultAux=$sqlAux->get_result();
                            $rowAux=$resultAux->fetch_assoc();
                            if(file_exists("css".DIRECTORY_SEPARATOR."Default".DIRECTORY_SEPARATOR.$rowAux['name']."Default.jpg"))
                            {
                              echo '<td><a href = "index.php?page=itemInfo&item='.$product['id'].'"><img src="css'.DIRECTORY_SEPARATOR.'Default'.DIRECTORY_SEPARATOR.$rowAux['name'].'Default.jpg" width="200" height="260"></a></td>';
                            }
                            else
                            {
                              echo '<td><a href = "index.php?page=itemInfo&item='.$product['id'].'"><img src="css'.DIRECTORY_SEPARATOR.'Default'.DIRECTORY_SEPARATOR.'itemDefault.jpg" width="200" height="260"></a></td>';
                            }
                        }
                        echo '<a href = "index.php?page=itemInfo&item='.$product['id'].'"><h5 class="card-title">'.$product['name'].'</h5></a>';
                            
                        echo '<p class="card-text text-truncate">'.$product['description'].'</p>';
                        echo '<p class="card-text">'.$product['prize'].'$</p>';
                        echo '<p class="card-text min">'.$product['shippment'].'$ shipping</p>';
                        echo '</div>
                            </div>
                        </div>';
                    
                    }
                    $k++;
                }
                echo '</div>';
                
            }*/
             echo '</div><div class="row justify-content-md-center">';
             echo '<form method="post" action="index.php?'.$_SERVER['QUERY_STRING'].'">
                        <input type="text" hidden class="form-control" name="prevPage">
                        <button type="submit" class="btn btn-secondary pages"';
                        if(!isset($_GET['pagination'])|| $page==0)
                        {
                            echo "disabled";
                        }
                        echo '><i class="fas fa-angle-left"></i></button></form>';
            for ($i=0; $i <ceil($result->num_rows/$limit) ; $i++) {
                if($i==$page)
                {
                    echo '
                        <button type="submit" class="btn btn-outline-primary pages" value="'.($i+1).'" onclick="pagination(this.value)">'.($i+1).'</button>';
                }
                else
                {
                    echo '
                        <button type="submit" class="btn btn-secondary pages" value="'.($i+1).'" onclick="pagination(this.value)">'.($i+1).'</button>';
                }
                
            }
            echo '<form method="post" action="index.php?'.$_SERVER['QUERY_STRING'].'">
                        <input type="text" hidden class="form-control" name="nextPage">
                        <button type="submit" class="btn btn-secondary pages"';
                        if($page==ceil($result->num_rows/$limit)-1)
                        {
                            echo "disabled";
                        }
                        echo '><i class="fas fa-angle-right"></i></button></form>';
            echo '</div>';
            echo '</div></div>';
    ?>
    </div>
</div>
