<?php include 'vitimins_worker_banner.php'; ?>

<main class="products_row">
    <div class="products_column">
        <h1>Edit/Update User</h1>

        <form action="vitimins_worker.php" method="post" name="admin_update_user_form" onsubmit="return validateUserUpdate()">
            <input type="hidden" name="action" value="update_user">
            <input type="hidden" name="user_id" value="<?php echo $user_entry['USERID']; ?>">

            <label>Username:</label>
            <input type="text" name="new_username" size="30" maxlength="16" />
            <input type="hidden" name="current_username" value="<?php echo $current_username; ?>">
            <br>

            <label>Access Code:</label>
            <select id="access_code" name="access_code">
                <option value="" selected disabled hidden></option>
                <option value="0">0 (Admin)</option>
                <option value="-1">-1 (Customer)</option>
            </select>
            <input type="hidden" name="current_access" value="<?php echo $current_access; ?>">
            <br>

            <label>First Name:</label>
            <input type="text" name="first_name" size="30" minlength="2" maxlength="64"/>
            <input type="hidden" name="current_fName" value="<?php echo $current_fName; ?>">
            <br>

            <label>Last Name:</label>
            <input type="text" name="last_name" size="30" minlength="2" maxlength="64"/>
            <input type="hidden" name="current_lName" value="<?php echo $current_lName; ?>">
            <br>

            <label>Address:</label>
            <input type="text" name="address" size="30" maxlength="256"/>
            <input type="hidden" name="current_address" value="<?php echo $current_address; ?>">
            <br>

            <label>Phone:</label>
            <input type="text" name="phone_number" size="30" maxlength="16"/>
            <input type="hidden" name="current_phone" value="<?php echo $current_phone; ?>">
            <br>

            <label>Email:</label>
            <input type="text" name="email" size="30" maxlength="128"/>
            <input type="hidden" name="current_email" value="<?php echo $current_email; ?>">
            <br>

            <label>&nbsp;</label>
            <input type="submit" value="Update User Information" />
        </form>
    </div>

    <section class="products_column">
      <h1>Current User Information</h1>

      <div>
            <p style="font-weight: bold;">Username:
                <?php echo $current_username; ?></p>

            <p style="font-weight: bold;">Access Code:
                <?php echo $current_access; ?></p>

            <p style="font-weight: bold;">Full Name:
                <?php echo $current_fName.' '.$current_lName; ?></p>

            <p style="font-weight: bold;">Address:
                <?php echo $current_address; ?></p>

            <p style="font-weight: bold;">Phone:
                <?php echo $current_phone; ?></p>

            <p style="font-weight: bold;">Email:
                <?php echo $current_email; ?></p>
      </div>
    </section>
</main>

<!-- This is a hidden table that does not take up space. Needed for form validation -->
<table style="display: none;" id="existing_usernames_table">
    <tr>
        <?php while($user_entry = $current_users->fetch_assoc()) { ?>
            <td><?php echo $user_entry['USERNAME']; ?></td>
        <?php } //END OF while loop ?>
    </tr>
</table>

<?php include 'footer.php' ?>
