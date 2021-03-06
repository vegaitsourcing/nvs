<?php

require_once __DIR__.'/../app/bootstrap.php';

?>
<div class="panel-heading">
    <h1> Moja Volonterska Knjižica</h1
</div>
<div class="manifestation-container"><!-- manifestation-container Starts -->

<p>Lista prethodnih manifestacija</p>

    <div class="table-responsive"><!-- table-responsive Starts -->

        <table class="table table-bordered table-hover"><!-- table table-bordered table-hover Starts -->

            <tbody>

            <?php

            $customer_session = $_SESSION['customer_email'];

            $get_customer = "select * from volunteers where customer_email='$customer_session'";

            $run_customer = mysqli_query($con, $get_customer);

            $row_customer = mysqli_fetch_array($run_customer);

            $customer_id = $row_customer['customer_id'];

            $i = 0;

            $wishlistRepository = $entityManager->getRepository('Wishlist');
            $wishlists = $wishlistRepository->findBy([
                'customerId' => $customer_id,
                'status' => Wishlist::STATUS_VALUE_TRUE
            ]);

            $productRepository = $entityManager->getRepository('Product');

            foreach ($wishlists as $wishlist) {
                $product = $productRepository->find($wishlist->getProductId());

                $i++;

                ?>

                <tr>

                    <td width="100" style="vertical-align:middle"> <span class="btn manifestation-name"><?php echo $i; ?></span> </td>

                    <td style="vertical-align:middle" >

                        <img src="../admin_area/product_images/<?php echo $product->getImg1(); ?>" width="60" height="60">

                        &nbsp;&nbsp;&nbsp;

                        <a href="../pozicija-<?php echo $product->getUrl(); ?>">

                            <?php echo $product->getTitle(); ?>

                        </a>

                    </td>

                    <?php
                        $hours = $wishlist->getHours();
                        $hours_approved = $wishlist->getHoursApproved();
                    ?>

                    <td style="vertical-align:middle" >
                        <?php  if ($hours == 0 && canEnterHours($wishlist, $product)) : ?>
                            <a href="index.php?my_book_manage&wishlist_id=<?php echo $wishlist->getId(); ?>">
                                <i class="fa fa-plus"></i>
                                Unesi
                            </a>
                        <?php else : ?>
                            <?php echo $hours; ?>
                        <?php endif ?>
                    </td>

                    <td style="vertical-align:middle" >
                        <?php if ($hours) : ?>
                            <?php  if (is_null($hours_approved)): ?>
                                <i class="fa fa-clock-o" title="U obradi"></i>
                            <?php else: ?>
                                <?php if ($hours_approved): ?>
                                    <i class="fa fa-check" title="Odobreno"></i>
                                <?php else: ?>
                                    <i class="fa fa-times" title="Odbijeno"></i>
                                <?php endif ?>
                            <?php endif ?>
                        <?php else: ?>
                            Gotovo
                        <?php endif ?>
                    </td>

                    <td style="vertical-align:middle" >
                        <?php if ($hours_approved) : ?>
                            <a href="wishlist_to_pdf.php?wishlist_id=<?php echo $wishlist->getId() ?>" class="volunteering-pdf btn btn-sm">
                                PDF
                            </a>
                        <?php elseif (canEnterHours($wishlist, $product)) : ?>
                            <a href="index.php?my_book_manage&wishlist_id=<?php echo $wishlist->getId() ?>" class="btn btn-link">
                                <i class="fa fa-pencil"></i>
                                Izmeni
                            </a>
                        <?php else : ?>
                            Gotovo
                        <?php endif ?>
                    </td>

                </tr>

            <?php } ?>

            </tbody>

        </table><!-- table table-bordered table-hover Ends -->

    </div><!-- table-responsive Ends -->

</div><!-- manifestation-container Ends -->
<?php
function canEnterHours(Wishlist $wishlist, Product $product)
{
    $endDate = $product->getDo();
    $endDateTwoWeeksLater = clone $endDate;
    $endDateTwoWeeksLater->add(new DateInterval('P14D'));
    $currentDate = new DateTime('now');

    $dateCheck = $currentDate >= $endDate && $currentDate <= $endDateTwoWeeksLater;
    $approvalCheck = $wishlist->getStatus() === Wishlist::STATUS_VALUE_TRUE;
    $hoursApprovedCheck = is_null($wishlist->getHoursApproved());

    return $dateCheck && $approvalCheck && $hoursApprovedCheck;
}
?>
