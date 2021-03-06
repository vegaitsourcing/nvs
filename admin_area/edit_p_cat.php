<?php

if (!isset($_SESSION['admin_email'])) {
    echo "<script>window.open('login.php','_self')</script>";
} else {
    ?>

    <?php

    if (isset($_GET['edit_p_cat'])) {
        $edit_p_cat_id = $_GET['edit_p_cat'];

        $edit_p_cat_query = "select * from product_categories where p_cat_id='$edit_p_cat_id'";

        $run_edit = mysqli_query($con, $edit_p_cat_query);

        $row_edit = mysqli_fetch_array($run_edit);

        $p_cat_id = $row_edit['p_cat_id'];

        $p_cat_title = $row_edit['p_cat_title'];

        $p_cat_opis = $row_edit['p_cat_opis'];

        $p_cat_top = $row_edit['p_cat_top'];

        $p_cat_image = $row_edit['p_cat_image'];

        $new_p_cat_image = $row_edit['p_cat_image'];

        $p_cat_lokacija = $row_edit['p_cat_lokacija'];

        $p_cat_od = $row_edit['p_cat_do'];

        $p_cat_do = $row_edit['p_cat_do'];

        $p_cat_hrana = $row_edit['p_cat_hrana'];

        $p_cat_smestaj = $row_edit['p_cat_smestaj'];

        $m_id = $row_edit['p_man_id'];
    }

    $get_manufacturer = "select * from organizations where manufacturer_id='$m_id'";

    $run_manufacturer = mysqli_query($con, $get_manufacturer);

    $row_manfacturer = mysqli_fetch_array($run_manufacturer);

    $manufacturer_id = $row_manfacturer['manufacturer_id'];

    $manufacturer_title = $row_manfacturer['manufacturer_title'];
    ?>

<div class="row"><!-- 1 row Starts -->

<div class="col-lg-12"><!-- col-lg-12 Starts -->

<ol class="breadcrumb"><!-- breadcrumb Starts -->

<li>

<i class="fa fa-dashboard"></i> Dashboard / Promeni program

</li>

</ol><!-- breadcrumb Ends -->

</div><!-- col-lg-12 Ends -->

</div><!-- 1 row Ends -->

<div class="row"><!-- 2 row Starts -->

<div class="col-lg-12"><!-- col-lg-12 Starts -->

<div class="panel panel-default"><!-- panel panel-default Starts -->

<div class="panel-heading" ><!-- panel-heading Starts -->

<h3 class="panel-title" ><!-- panel-title Starts -->

<i class="fa fa-money fa-fw" ></i> Ažuriraj program

</h3><!-- panel-title Ends -->


</div><!-- panel-heading Ends -->

<div class="panel-body" ><!-- panel-body Starts -->

<form class="form-horizontal" action="" method="post" enctype="multipart/form-data" ><!-- form-horizontal Starts -->

<div class="form-group" ><!-- form-group Starts -->

<label class="col-md-3 control-label" >Naziv</label>

<div class="col-md-6" >

<input type="text" name="p_cat_title" class="form-control" value="<?php echo $p_cat_title; ?>">

</div>

</div><!-- form-group Ends -->

<div class="form-group"><!-- form-group Starts -->

<label class="col-md-3 control-label"> Opis </label>

<div class="col-md-6">

<textarea id="text1" class="form-control" rows="15" name="p_cat_opis"><?php echo $p_cat_opis; ?></textarea>

</div>

</div><!-- form-group Ends -->

<div class="form-group" ><!-- form-group Starts -->

<label class="col-md-3 control-label" > Organizacija </label>

<div class="col-md-6" >

<select name="manufacturer" class="form-control">

    <option value="<?php echo $manufacturer_id; ?>">
    <?php echo $manufacturer_title; ?>
    </option>

    <?php

    $get_manufacturer = "select * from organizations ";

    $run_manufacturer = mysqli_query($con, $get_manufacturer);

    while ($row_manfacturer = mysqli_fetch_array($run_manufacturer)) {
        $manufacturer_id = $row_manfacturer['manufacturer_id'];

        $manufacturer_title = $row_manfacturer['manufacturer_title'];

        echo "
        <option value='$manufacturer_id'>
        $manufacturer_title
        </option>
        ";
    }

    ?>

</select>

</div>

</div><!-- form-group Ends -->

<div class="form-group" ><!-- form-group Starts -->

<label class="col-md-3 control-label" >Lokacija</label>

<div class="col-md-6" >

<input type="text" name="p_cat_lokacija" class="form-control" value="<?php echo $p_cat_lokacija; ?>">

</div>

</div><!-- form-group Ends -->

<div class="form-group" ><!-- form-group Starts -->

<label class="col-md-3 control-label" >Od</label>

<div class="col-md-3" >

<input type="date" name="p_cat_od" class="form-control" value="<?php echo $p_cat_od; ?>" >

</div>

</div><!-- form-group Ends -->
<div class="form-group" ><!-- form-group Starts -->

<label class="col-md-3 control-label" >Do</label>

<div class="col-md-3" >

<input type="date" name="p_cat_do" class="form-control" value="<?php echo $p_cat_do; ?>">

</div>

</div><!-- form-group Ends -->

<div class="form-group" ><!-- form-group Starts -->

<label class="col-md-3 control-label" >Hrana</label>

<div class="col-md-6" >

<input type="radio" name="p_cat_hrana" value="Da" 
    <?php if ($p_cat_hrana == 'no') {
    } else {
        echo "checked='checked'";
    } ?>>

<label> Da </label>

<input type="radio" name="p_cat_hrana" value="Ne" 
    <?php if ($p_cat_hrana == 'no') {
        echo "checked='checked'";
    } else {
    } ?>>

<label> Ne </label>

</div>


</div><!-- form-group Ends -->


<div class="form-group" ><!-- form-group Starts -->

<label class="col-md-3 control-label" >Smeštaj</label>

<div class="col-md-6" >

<input type="radio" name="p_cat_smestaj" value="Da" 
    <?php if ($p_cat_smestaj == 'no') {
    } else {
        echo "checked='checked'";
    } ?>>

<label> Da </label>

<input type="radio" name="p_cat_smestaj" value="Ne" 
    <?php if ($p_cat_smestaj == 'no') {
        echo "checked='checked'";
    } else {
    } ?>>

<label> Ne </label>

</div>

</div><!-- form-group Ends -->


<div class="form-group" ><!-- form-group Starts -->

<label class="col-md-3 control-label" >Prikaži kao prvi</label>

<div class="col-md-6" >

<input type="radio" name="p_cat_top" value="Da" 
    <?php if ($p_cat_top == 'no') {
    } else {
        echo "checked='checked'";
    } ?>>

<label> Da </label>

<input type="radio" name="p_cat_top" value="Ne" 
    <?php if ($p_cat_top == 'no') {
        echo "checked='checked'";
    } else {
    } ?>>

<label> Ne </label>

</div>

</div><!-- form-group Ends -->


<div class="form-group" ><!-- form-group Starts -->

<label class="col-md-3 control-label" > Izaberi sliku</label>

<div class="col-md-6" >

<input type="file" name="p_cat_image" class="form-control" >

<br>

<img src="other_images/<?php echo $p_cat_image; ?>" width="70" height="70" >

</div>

</div><!-- form-group Ends -->

<div class="form-group" ><!-- form-group Starts -->

<label class="col-md-3 control-label" ></label>

<div class="col-md-6" >

<input type="submit" name="update" value="Ažuriraj" class="btn btn-primary form-control" >

</div>

</div><!-- form-group Ends -->

</form><!-- form-horizontal Ends -->

</div><!-- panel-body Ends -->


</div><!-- panel panel-default Ends -->

</div><!-- col-lg-12 Ends -->

</div><!-- 2 row Ends -->

    <?php

    if (isset($_POST['update'])) {
        $p_cat_title = escape($_POST['p_cat_title']);

        $p_cat_opis = escape($_POST['p_cat_opis']);

        $p_cat_top = $_POST['p_cat_top'];

        $p_cat_image = $_FILES['p_cat_image']['name'];

        $temp_name = $_FILES['p_cat_image']['tmp_name'];


    

        if (empty($p_cat_image)) {
            $p_cat_image = $new_p_cat_image;
        } else {
             $file="other_images" ."/". $new_p_cat_image;

            if (file_exists($file)) {
                  unlink($file);
            }
        }

        $p_cat_lokacija = escape($_POST['p_cat_lokacija']);

        $p_cat_od = $_POST['p_cat_od'];

        $p_cat_do = $_POST['p_cat_do'];

        $p_cat_hrana = $_POST['p_cat_hrana'];

        $p_cat_smestaj = $_POST['p_cat_smestaj'];

        $p_man_id = $_POST['manufacturer'];


        $update_p_cat = "update product_categories set p_cat_title='$p_cat_title',p_cat_opis='$p_cat_opis',p_cat_top='$p_cat_top',p_cat_image='$p_cat_image',p_cat_lokacija='$p_cat_lokacija',p_cat_do='$p_cat_od',p_cat_do='$p_cat_do',p_cat_hrana='$p_cat_hrana',p_cat_smestaj='$p_cat_smestaj',p_man_id='$p_man_id' where p_cat_id='$p_cat_id'";

        $run_p_cat = mysqli_query($con, $update_p_cat);

        if ($run_p_cat) {
            move_uploaded_file($temp_name, "other_images/$p_cat_image");

            echo "<script>alert('Program je ažuriran')</script>";

            echo "<script>window.open('index.php?view_p_cats','_self')</script>";
        }
    }



    ?>


<?php } ?>