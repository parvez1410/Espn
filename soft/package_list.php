<?php include 'include/header.php';?>
<?php $table_heading = "Package List";?>
<?php include 'include/sidebar.php';?>
<?php include 'include/body-top.php';?>
 <?php
           //your table name
        $tbl_name="gen_packagemasters"; 
        $targetpage = "package_list.php"; //your file name  (the name of this file)
        $user_no =$_SESSION['user']['user_no'];
        $CURR_TIME = date('Y-m-d H:i:s'); 
        $mgs = '';
    
   
?> 
    <?php
        if(isset($_GET['remove'])){
            $id = $_GET['remove'];
           $sql = "UPDATE $tbl_name SET `IS_DELETED`=1,`DELETED_BY`='$user_no',`DELETED_ON`='$CURR_TIME' WHERE `PACKAGEMASTER_NO` = '$id' ";
            $result = mysqli_query($con,$sql);
        
             if($result)
            {
                $mgs = "Data Delete Successfully!";
                $class = "green_color alert alert-success col-md-6 alert-dismissable";
            }
            else
            {
                $mgs = "Data Delete Fail!";
                $class = "red_color alert alert-warning alert-dismissable col-md-6";
            }
            echo "<meta http-equiv='Refresh' content='5; url=package_list.php'>";
        }
    ?>

    
    <?php
        
    
    // How many adjacent pages should be shown on each side?
    $adjacents = 3;
    
    /* 
       First get total number of rows in data table. 
       If you have a WHERE clause in your query, make sure you mirror it here.
    */
    $query = "SELECT COUNT(*) as num FROM $tbl_name WHERE `IS_DELETED` = 0";
    $total_pages = mysqli_fetch_array(mysqli_query($con,$query));
    $total_pages = $total_pages['num'];
    
    /* Setup vars for query. */
    $limit = 15; 
    if(isset($_GET['page']))
    {                               //how many items to show per page
        $page = $_GET['page'];
    }
    else
    $page = 1;
    
    if($page) 
        $start = ($page - 1) * $limit;          //first item to display on this page
    else
        $start = 0;                             //if no page var is given, set start to 0
    
    /* Get data. */
  
    $sql = "SELECT $tbl_name.PACKAGEMASTER_NO,$tbl_name.PACKAGE_NAME,$tbl_name.PACKAGE_CODE,$tbl_name.PACKAGE_RATE,$tbl_name.PACKAGE_BENEFIT,$tbl_name.PACKAGE_IMAGE,gen_packagedtls.PACKAGEMASTER_NO,gen_packagedtls.ITEM_NO,gen_packagedtls.ITEM_UNIT,gen_packagedtls.ITEM_RATE, gen_items.ITEM_NO, gen_items.ITEM_NAME,gen_items.ITEM_CODE FROM $tbl_name LEFT JOIN gen_packagedtls ON gen_packagedtls.PACKAGEMASTER_NO=$tbl_name.PACKAGEMASTER_NO LEFT JOIN gen_items ON gen_items.ITEM_NO=gen_packagedtls.ITEM_NO WHERE $tbl_name.IS_DELETED = 0  LIMIT $start, $limit";
    $result = mysqli_query($con,$sql);
    
    
    /* Setup page vars for display. */
    if ($page == 0) $page = 1;                  //if no page var is given, default to 1.
    $prev = $page - 1;                          //previous page is page - 1
    $next = $page + 1;                          //next page is page + 1
    $lastpage = ceil($total_pages/$limit);      //lastpage is = total pages / items per page, rounded up.
    $lpm1 = $lastpage - 1;                      //last page minus 1
    
    /* 
        Now we apply our rules and draw the pagination object. 
        We're actually saving the code to a variable in case we want to draw it more than once.
    */
    $pagination = "";
    if($lastpage > 1)
    {   
        $pagination .= "<div class=\"pagination\">";
        //previous button
        if ($page > 1) 
            $pagination.= "<a href=\"$targetpage?page=$prev\"><< previous</a>";
        else
            $pagination.= "<span class=\"disabled\"><< previous</span>";    
        
        //pages 
        if ($lastpage < 7 + ($adjacents * 2))   //not enough pages to bother breaking it up
        {   
            for ($counter = 1; $counter <= $lastpage; $counter++)
            {
                if ($counter == $page)
                    $pagination.= "<span class=\"current\">$counter</span>";
                else
                    $pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";                 
            }
        }
        elseif($lastpage > 5 + ($adjacents * 2))    //enough pages to hide some
        {
            //close to beginning; only hide later pages
            if($page < 1 + ($adjacents * 2))        
            {
                for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
                {
                    if ($counter == $page)
                        $pagination.= "<span class=\"current\">$counter</span>";
                    else
                        $pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";                 
                }
                $pagination.= "...";
                $pagination.= "<a href=\"$targetpage?page=$lpm1\">$lpm1</a>";
                $pagination.= "<a href=\"$targetpage?page=$lastpage\">$lastpage</a>";       
            }
            //in middle; hide some front and some back
            elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
            {
                $pagination.= "<a href=\"$targetpage?page=1\">1</a>";
                $pagination.= "<a href=\"$targetpage?page=2\">2</a>";
                $pagination.= "...";
                for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
                {
                    if ($counter == $page)
                        $pagination.= "<span class=\"current\">$counter</span>";
                    else
                        $pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";                 
                }
                $pagination.= "...";
                $pagination.= "<a href=\"$targetpage?page=$lpm1\">$lpm1</a>";
                $pagination.= "<a href=\"$targetpage?page=$lastpage\">$lastpage</a>";       
            }
            //close to end; only hide early pages
            else
            {
                $pagination.= "<a href=\"$targetpage?page=1\">1</a>";
                $pagination.= "<a href=\"$targetpage?page=2\">2</a>";
                $pagination.= "...";
                for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
                {
                    if ($counter == $page)
                        $pagination.= "<span class=\"current\">$counter</span>";
                    else
                        $pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";                 
                }
            }
        }
        
        //next button
        if ($page < $counter - 1) 
            $pagination.= "<a href=\"$targetpage?page=$next\">next >></a>";
        else
            $pagination.= "<span class=\"disabled\">next >></span>";
        $pagination.= "</div>\n";       
    }
?>
<div style="overflow: auto;">
  <table   class="table table-bordered table-hover table-responsive table-condensed table-striped dataTable col-xs-12 col-sm-12 col-md-6 col-lg-6 ">
         <tr>
            <th><center>Sl</center></th>
            <th><center>Package Name</center></th>
            <th><center>Package Code</center></th>
            <th><center>Package Rate</center></th>
            <th><center>Package Details</center></th>
            <th><center>Package Benefit</center></th>
            <th><center>Image</center></th>
            <th><center>Action</center></th>
            
         </tr>
    <?php $i=$page*$limit-$limit+1; while($row = mysqli_fetch_array($result)):?>
        <tr>
            <td><center><?=$i++?></center></td>
            <td><?=$row['PACKAGE_NAME']?></td>
            <td><?=$row['PACKAGE_CODE']?></td>
            <td><?=$row['PACKAGE_RATE']?></td>
            <td> 
                <b>Item Name:</b> <?=$row['ITEM_NAME']?> <b>Item Rate:</b> <?=$row['ITEM_RATE']?> <b>Item Unit:</b> <?=$row['ITEM_UNIT']?></td>
            <td><?=$row['PACKAGE_BENEFIT']?></td>
            <td><a class="" target="_blank" href="upload/<?=$row['PACKAGE_IMAGE']?>" title="Click to view full image"><img src="upload/<?=$row['PACKAGE_IMAGE']?>" height="70px" width="60px"></a></td>
            <td>
               <center><a onclick="return confirm('Are you Sure Want to Remove?');" href="<?=$targetpage.'?remove='.$row['PACKAGEMASTER_NO']?>" class="btn btn-danger">Remove</a></center>
            </td>
        </tr>
    <?php endwhile;?>
    </table>
</div>
<?=$pagination?>
    
    <!---main content end---->
<?php include 'include/footer.php';?>