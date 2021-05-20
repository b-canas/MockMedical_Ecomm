<?php include 'vitimins_worker_banner.php'; ?>

<main class="box">

    <h2>Order Details</h2>

    <table class="full_page_table">
        <tr>
            <th>Order No.</th>
            <th>User ID</th>
            <th>Total Cost</th>
            <th>Time Ordered</th>
            <th>Status</th>
            <th>Last Updated</th>
            <th>&nbsp;</th> <!--column will have Update Status button -->
        </tr>

        <tr>
            <td><?php echo $orderDetails['ORDERNO']; ?></td> <!--Order Number -->
            <td><?php echo $orderDetails['USERID']; ?></td> <!--UserID of order -->
            <td>$<?php echo $orderDetails['TOTALCOST']; ?></td> <!--Total Cost of order -->
            <td><?php echo $orderDetails['ATTIME']; ?></td> <!--Time order was placed -->

            <td> <!--Current order status -->
                <!--A form is used here to allow for order status' to be updated from this page -->
                <form action="?" method="post">

                    <select id="status_choices" name="status_choices">
                        <?php foreach ($statusOptions as $option) {
                            echo "<option value=\"$option\"";
                            if ($orderDetails['STATUS'] == $option)
                                echo " selected>$option</option>";
                            else
                                echo ">$option</option>";
                        } ?>
                    </select>
            </td>

            <td><?php echo $orderDetails['LASTMOD']; ?></td> <!--Time order was last updated -->

            <td> <!--Table cell with the Update Status button which updates the order based on the status selected from the datalist -->
                    <input type="hidden" name="action" value="update_order_status"> <!--Action variable for the controller vitimans_worker-->
                    <input type="hidden" name="order_no"
                        value="<?php echo $orderDetails['ORDERNO']; ?>"> <!--Order Number of order to be updated -->
                    <input type="hidden" name="current_order_status"
                        value="<?php echo $orderDetails['STATUS']; ?>"> <!--Current status of order no. -->
                    <input type="hidden" name="view_order_details_flag"
                        value="true"> <!--Flagging that we are on this page so this page is reloaded -->
                    <input type="hidden" name="current_status_filter"
                        value="<?php echo 'All'; ?>"> <!--Deciding which status filter the orders should be displaying -->
                    <input type="submit" value="Update Status">
                </form>
            </td>
    </table> <!-- End of order details table -->

    <h2>Product Details</h2>

    <table class="full_page_table">
        <tr>
            <th>Product ID</th>
            <th>Product Image</th>
            <th>Product Name</th>
            <th>Category</th>
            <th>Item Quantity</th>
            <th>Item Cost</th>
            <th>Total Price</th>
        </tr>

        <?php while ($item_entry = $orderItems->fetch_assoc()) {
            $product_entry = get_product($item_entry['PRODUCTID'])->fetch_assoc(); ?>

        <tr>
            <td><?php echo $product_entry['PRODUCTID']; ?></td> <!--Product ID -->
            <td><img src="Images/bottleA.png" width=100 px></td> <!--Product Image -->
            <td><?php echo $product_entry['PNAME']; ?></td> <!--Product Name -->
            <td><?php echo $product_entry['CATEGORY']; ?></td> <!--Product category -->
            <td><?php echo $item_entry['AMOUNT']; ?></td> <!--Quantity ordered of product -->
            <td>$<?php echo $item_entry['ICOST']; ?></td> <!--Product price -->
            <td>$<?php echo $item_entry['TPRICE']; ?></td> <!--Total price: item price * quantity -->
        </tr>
        <?php } ?> <!-- End OF while loop for item entries -->
    </table> <!-- End of product details table -->
</main>

<?php include 'footer.php'; ?>
