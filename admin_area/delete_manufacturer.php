<?php


if (!isset($_SESSION['admin_email'])) {
    echo "<script>window.open('login.php','_self')</script>";
} else {
    ?>

    <?php

    if (isset($_GET['delete_manufacturer'])) {
        $delete_id = $_GET['delete_manufacturer'];
    
        $select_pro = "select * from products where manufacturer_id='$delete_id'";
        $delete_pro = "delete from products where manufacturer_id='$delete_id'";
        
        $run_select_pro = mysqli_query($con, $select_pro);
    
        while ($row = mysqli_fetch_array($run_select_pro)) {
            $wish=  $row["product_id"];
            $select_wish = "delete from wishlist where product_id='$wish'";
            $run_delete_wish = mysqli_query($con, $select_wish);
             
            
            $image1= $row["product_img1"];
            $image2= $row["product_img2"];
            $image3= $row["product_img3"];
              
        
             $file="../admin_area/product_images" ."/". $image1;
                 
            if (file_exists($file)) {
                 unlink($file);
            } else {
            }
                   
       
             $file2="../admin_area/product_images" ."/". $image2;
           
            if (file_exists($file2)) {
                 unlink($file2);
            } else {
            }
            
    
            $file3="../admin_area/product_images" ."/". $image3;
            
            
            if (file_exists($file3)) {
                 unlink($file3);
            } else {
            }
        }


        $run_delete_pro = mysqli_query($con, $delete_pro);

            
        $delete_p_cat = "delete from product_categories where p_man_id='$delete_id'";
        $select_p_cat = "select * from product_categories where p_man_id='$delete_id'";
        
        $run_select = mysqli_query($con, $select_p_cat);
      
        while ($row = mysqli_fetch_array($run_select)) {
            $image1= $row["p_cat_image"];
                $file="../admin_area/other_images" ."/". $image1;
            
            if (file_exists($file)) {
                 unlink($file);
            }
        }

        $run_delete_p_cat = mysqli_query($con, $delete_p_cat);

    
        $delete_manufacturer = "delete from organizations where manufacturer_id='$delete_id'";
        $select_org = "select * from organizations where manufacturer_id='$delete_id'";
    
        $row_man = mysqli_fetch_array($con, $select_org);
            $image= $row["manufacturer_image"];
            $file="../admin_area/other_images" ."/". $image;
            
        if (file_exists($file)) {
             unlink($file);
        }
    
  
        $run_manufacturer = mysqli_query($con, $delete_manufacturer);

        if ($run_manufacturer) {
            echo "<script>alert('Organizacija je obrisana')</script>";
            echo "<script>window.open('index.php?view_organizations','_self')</script>";
        }
    }


    ?>


<?php }
