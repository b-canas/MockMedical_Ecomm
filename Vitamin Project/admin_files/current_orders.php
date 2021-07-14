<?php include 'vitimins_worker_banner.php'; ?>

<main class="box">

    <div class="products_row">
        <aside class="products_column"> <!-- show all user id and username pairs -->
            <h2>User ID: Username List</h2>
            <nav>
                <ul>
                    <li> <!--This first link in the list will be the default All products -->
                        <?php echo '<a href="?action=view_user_orders&user_id=All&wanted_status='.$wantedStatus.'">All Customers</a>'; ?>
                    </li>
                    <?php while ($user_entry = $users->fetch_assoc()) { ?>
                        <li>
                            <a href="?action=view_user_orders&user_id=<?php
                                      echo $user_entry['USERID']."&wanted_status=$wantedStatus"; ?>">
                                <?php echo $user_entry['USERID'].': '.$user_entry['USERNAME']; ?>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </nav>
        </aside>

        <div class="products_column"> <!-- will display a table with products in selected category -->
        <h2>Order Numbers For User ID: <?php echo $userID;?> </h2>
        <p>
            Filter By Status:
            <?php
            echo '<a href="?action=view_user_orders&user_id='.$userID.'&wanted_status=All">ALL | </a>';

            foreach ($statusOptions as $option) {
                echo '<a href="?action=view_user_orders&user_id='.$userID.'&wanted_status='.$option.'">'.$option.' | </a>';
            } ?>
        </p>
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
            <?php
            if (!$orders) { //IF no orders...
                echo "<tr><td colspan=\"6\">NO ORDERS FOUND</td></tr>";
            }
            else {
            while ($order_entry = $orders->fetch_assoc()) {
                    //$wantedStatus was initialized inside of vitimins_worker.php
                    if ($order_entry['STATUS'] == $wantedStatus || $wantedStatus == 'All') { ?>
            <tr>
                <td>
                    <a href="?action=view_order_details&order_no=<?php echo $order_entry['ORDERNO'];?>">
                        <b><?php echo $order_entry['ORDERNO']; ?></b> <!--Order Number -->
                    </a>
                </td>
                <td><?php echo $order_entry['USERID']; ?></td> <!--UserID of order -->
                <td>$<?php echo $order_entry['TOTALCOST']; ?></td> <!--Total Cost of order -->
                <td><?php echo $order_entry['ATTIME']; ?></td> <!--Time order was placed -->

                <td> <!--Current order status -->
                    <!--A form is used here to allow for order status' to be updated from this page -->
                    <!-- In order for forms to have unique names, necessary for JS, the name attribute includes the orderno, which is then passed to onsubmit -->
                    <form action="?" method="post" <?php echo "name=\"status_update_form".$order_entry['ORDERNO']."\"";?>
                            onsubmit="return validateStatusUpdate(<?php echo $order_entry['ORDERNO']; ?>)">

                        <select id="status_choices" name="status_choices"
                        <?php if ($order_entry['STATUS'] == 'DELIVERED' || $order_entry['STATUS'] == 'CANCELLED') {
                            //if order status has the value DELIVERED or CANCELLED, disable the select list
                            echo 'disabled';
                        } ?>> <!--END OF select opening tag -->

                            <?php foreach ($statusOptions as $option) {
                                echo "<option value=\"$option\"";
                                if ($order_entry['STATUS'] == $option)
                                    echo " selected>$option</option>";
                                else
                                    echo ">$option</option>";
                            } ?>
                        </select>
                </td>

                <td><?php echo $order_entry['LASTMOD']; ?></td> <!--Time order was last updated -->

                <td> <!--Table cell with the Update Status button which updates the order based on the status selected from the datalist -->
                        <input type="hidden" name="action" value="update_order_status"> <!--Action variable for the controller vitimans_worker-->
                        <input type="hidden" name="order_no"
                            value="<?php echo $order_entry['ORDERNO']; ?>"> <!--Order Number of order to be updated -->
                        <input type="hidden" name="current_order_status"
                            value="<?php echo $order_entry['STATUS']; ?>"> <!--Current status of order no. -->
                        <input type="hidden" name="current_id_filter"
                            value="<?php echo $userID; ?>"> <!--Bookmarking which userid the orders were displaying -->
                        <input type="hidden" name="current_status_filter"
                            value="<?php echo $wantedStatus; ?>"> <!--Bookmarking which status the orders were displaying -->
                        <input type="submit" value="Update Status">
                    </form>
                </td>
            <?php   } //END OF if-statement which checks status values
                } }?> <!--END OF Table WHILE LOOP, and END OF else block -->
        </table>
        </div> <!-- End of Table div -->
    </div> <!-- End of Page dive -->
</main>

<?php include 'footer.php'; ?>
