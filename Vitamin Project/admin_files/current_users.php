<?php include 'vitimins_worker_banner.php'; ?>

<main class="box">
    <h1>Current Users | <a href="?action=show_add_user_form"> Add New User</a></h1>
        <table class="full_page_table">
            <tr>
                <th>User ID</th>
                <th>Username</th>
                <th>Access Code</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Address</th>
                <th>Phone #</th>
                <th>Email</th>
                <th>&nbsp;</th> <!--column will have View Orders button -->
                <th>&nbsp;</th> <!--column will have Edit button -->
                <th>&nbsp;</th> <!--column will have Delete button -->
            </tr>
            <?php while ($user_entry = $users->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $user_entry['USERID']; ?></td> <!-- User ID -->
                <td><?php echo $user_entry['USERNAME']; ?></td> <!-- User username -->
                <td><?php echo $user_entry['ACCESS']; ?></td> <!-- User access code -->
                <td><?php echo $user_entry['FNAME']; ?></td> <!-- User first name -->
                <td><?php echo $user_entry['LNAME']; ?></td> <!-- User last name -->
                <td><?php echo $user_entry['ADDRESS']; ?></td> <!-- User address -->
                <td><?php echo $user_entry['PHONE']; ?></td> <!-- User phone number -->
                <td><?php echo $user_entry['EMAIL']; ?></td> <!-- User email address -->

                <?php if ($user_entry['ACCESS'] != 0) { ?> <!-- If user access is not a customer, the View Orders button should not be shown -->
                <td> <!--Table cell with the View Orders button which will direct to the orders page of a specific user-->
                    <form action="?" method="post">
                        <input type="hidden" name="action" value="view_user_orders"> <!--Action variable for the controller vitimans_worker-->
                        <input type="hidden" name="user_id"
                            value="<?php echo $user_entry['USERID']; ?>"> <!--User ID of user to view orders of-->
                        <input type="submit" value="View Orders">
                    </form>
                </td>
                <?php } else {echo '<td>--</td>'; } ?>

                <td> <!--Table cell with the Edit button which will direct to a form to edit a specific user-->
                    <form action="?" method="post">
                        <input type="hidden" name="action" value="show_user_edit_form"> <!--Action variable for the controller vitimans_worker-->
                        <input type="hidden" name="user_id"
                            value="<?php echo $user_entry['USERID']; ?>"> <!--User ID of user to be edited-->
                        <input type="submit" value="Edit">
                    </form>
                </td>

                <td> <!--Table cell with the Delete button which will delete a user PERMANENTLY from the DB-->
                    <form action="?" method="post">
                        <input type="hidden" name="action" value="delete_user"> <!--Action variable for the controller vitimans_worker-->
                        <input type="hidden" name="user_id"
                            value="<?php echo $user_entry['USERID']; ?>"> <!--User ID of user to be deleted-->
                        <input type="submit" value="Delete">
                    </form>
                </td>
            </tr>
            <?php } ?> <!--END OF Table WHILE LOOP  -->
        </table>
</main>

<?php include 'footer.php'; ?>
