<?php

$customer_session = $_SESSION['customer_email'];

$get_customer = "select * from volunteers where customer_email='$customer_session'";

$run_customer = mysqli_query($con, $get_customer);

$row_customer = mysqli_fetch_array($run_customer);

    $customer_id = $row_customer['customer_id'];

    $customer_name = $row_customer['customer_name'];

    $customer_email = $row_customer['customer_email'];

    $customer_country = $row_customer['customer_country'];

    $customer_city = $row_customer['customer_city'];

    $customer_contact = $row_customer['customer_contact'];

    $customer_address = $row_customer['customer_address'];

    $customer_image = $row_customer['customer_image'];
    $new_customer_image = $row_customer['customer_image'];

    $customer_datum = $row_customer['customer_datum'];

    $customer_pol = $row_customer['customer_pol'];

    $customer_sprema = $row_customer['customer_sprema'];

    $customer_profil = $row_customer['customer_profil'];

    $customer_desc = $row_customer['customer_desc'];
    
$get_cat = "select * from categories where cat_id='$customer_profil'";

$run_cat = mysqli_query($con, $get_cat);

$row_cat = mysqli_fetch_array($run_cat);

    $cat_title = $row_cat['cat_title'];
?>

<h1 align="center" > Ažuriranje podataka </h1>

<form action="" method="post" enctype="multipart/form-data" ><!--- form Starts -->

    <div class="form-group" ><!-- form-group Starts -->

        <label> Ime i Prezime: </label>

        <input type="text" name="c_name" class="form-control" required value="<?php echo $customer_name; ?>">


    </div><!-- form-group Ends -->

    <div class="form-group" ><!-- form-group Starts -->

        <label> Email: </label>

        <input type="text" name="c_email" class="form-control" required value="<?php echo $customer_email; ?>">


    </div><!-- form-group Ends -->

    <div class="form-group" ><!-- form-group Starts -->

        <label> Država: </label>

        <input type="text" name="c_country" class="form-control" required value="<?php echo $customer_country; ?>">


    </div><!-- form-group Ends -->

    <div class="form-group" ><!-- form-group Starts -->

        <label> Mesto: </label>

        <input type="text" name="c_city" class="form-control" required value="<?php echo $customer_city; ?>">


    </div><!-- form-group Ends -->

    <div class="form-group" ><!-- form-group Starts -->

        <label> Telefon: </label>

        <input type="text" name="c_contact" class="form-control" required value="<?php echo $customer_contact; ?>">


    </div><!-- form-group Ends -->

    <div class="form-group" ><!-- form-group Starts -->

        <label> Adresa: </label>

        <input type="text" name="c_address" class="form-control" required value="<?php echo $customer_address; ?>">


    </div><!-- form-group Ends -->


         <div class="form-group"><!-- form-group Starts -->

            <label> Datum rođenja</label>

            <input type="date" class="form-control" name="datum" value="<?php echo $customer_datum; ?>" required>

        </div><!-- form-group Ends -->


        <div class="form-group" ><!-- form-group Starts -->

            <label class="col-md-3 control-label" > Pol </label>

            <div class="col-md-9" >

            <select name="pol" class="form-control" >
                <option value="<?php echo $customer_pol; ?>"><?php echo $customer_pol; ?></option>
                <option value="Muško">Muško</option>
                <option value="Žensko">Žensko</option>

            </select>

            </div>

        </div><!-- form-group Ends -->


        <div class="form-group" ><!-- form-group Starts -->

            <label class="col-md-3 control-label" > Oblast </label>

            <div class="col-md-9" >


            <select name="profil" class="form-control" >

                <option value="<?php echo $customer_profil; ?>"><?php echo $cat_title; ?></option>

                <?php

                $get_cat = "select * from categories ";

                $run_cat = mysqli_query($con, $get_cat);

                while ($row_cat=mysqli_fetch_array($run_cat)) {
                    $cat_id = $row_cat['cat_id'];

                    $cat_title = $row_cat['cat_title'];

                    echo "<option value='$cat_id'>$cat_title</option>";
                }
                ?>
            </select>

            </div>

        </div><!-- form-group Ends -->


        <div class="form-group" ><!-- form-group Starts -->

        <label class="col-md-3 control-label" > Školska sprema </label>

        <div class="col-md-9" >


            <select name="sprema" class="form-control" >

                <option value="<?php echo $customer_sprema; ?>"><?php echo $customer_sprema; ?></option>
                <option value="Osnovno">Osnovno</option>
                <option value="Srednje">Srednje</option>
                <option value="Viša">Viša</option>
                <option value="Visoka">Visoka</option>

            </select>

        </div>

        </div><!-- form-group Ends -->

    <div class="form-group" ><!-- form-group Starts -->

            <label> Slika: </label>

            <input type="file" name="c_image" class="form-control"  ><br>

            <img src="customer_images/<?php echo $customer_image; ?>" width="100" height="100" class="img-responsive" >


    </div><!-- form-group Ends -->
    
    <div class="form-group"><!-- form-group Starts -->

    <label > Opis </label>

    <div>

    <textarea id="text1" class="form-control" rows="15" name="opis"><?php echo $customer_desc; ?></textarea>

    </div>

    </div><!-- form-group Ends -->


    <div class="text-center" ><!-- text-center Starts -->

        <button name="update" class="btn btn-primary" >

            <i class="fa fa-user-md" ></i> Ažuriraj

        </button>


    </div><!-- text-center Ends -->


</form><!--- form Ends -->

<?php

if (isset($_POST['update'])) {
    $update_id = $customer_id;

    $c_name = escape($_POST['c_name']);

    $c_email = filter_var($_POST['c_email'], FILTER_SANITIZE_EMAIL);

    $c_country = escape($_POST['c_country']);

    $c_city = escape($_POST['c_city']);

    $c_contact = escape($_POST['c_contact']);

    $c_address = escape($_POST['c_address']);

    $c_pol = $_POST['pol'];

    $c_datum = $_POST['datum'];

    $c_profil = $_POST['profil'];

    $c_sprema = $_POST['sprema'];
    
    $c_opis = escape($_POST['opis']);

    $c_image = $_FILES['c_image']['name'];

    $c_image_tmp = $_FILES['c_image']['tmp_name'];

    if (empty($c_image)) {
        $c_image = $new_customer_image;
    } else {
         $file="customer_images" ."/". $new_customer_image;

        if (file_exists($file)) {
                unlink($file);
        }
    }

   

    $update_customer = "update volunteers set customer_name='$c_name',customer_email='$c_email',customer_country='$c_country',customer_city='$c_city',customer_contact='$c_contact',customer_address='$c_address',customer_image='$c_image',customer_pol='$c_pol',customer_datum='$c_datum',customer_profil='$c_profil',customer_sprema='$c_sprema',customer_desc='$c_opis' where customer_id='$update_id'";

    $run_customer = mysqli_query($con, $update_customer);

    if ($run_customer) {
        move_uploaded_file($c_image_tmp, "customer_images/$c_image");

        echo "<script>alert('Vaš nalog je ažuriran. Ako ste promenili email ulogujte se ponovo ')</script>";

        echo "<script>window.open('index.php','_self')</script>";
    }
}


?>