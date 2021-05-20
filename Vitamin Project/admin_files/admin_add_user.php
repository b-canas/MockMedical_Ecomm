<?php include 'vitimins_worker_banner.php'; ?>



<form action="vitimins_worker.php" method="post" style="margin: 0 auto; width:25%;">
    <input type="hidden" name="action" value="add_user">

    <h1>Add User</h1>

    <table>
        <tr>
            <td>Username: </td>
            <td><input type="text" name="username" size="30" maxlength="16" /></td>
        </tr>

        <tr>
            <td>Password: </td>
            <td><input type="password" name="password" size="30" maxlength="16" /></td>
        </tr>

        <tr>
            <td>Access Code: </td>
            <td>
                <select id="access_code" name="access_code">
                    <option value="" selected disabled hidden></option>
                    <option value="0">0 (Admin)</option>
                    <option value="-1">-1 (Customer)</option>
                </select>
            </td>
        </tr>

        <tr>
            <td>First Name: </td>
            <td><input type="text" name="first_name" size="30" minlength="2" maxlength="64"/></td>
        </tr>

        <tr>
            <td>Last Name: </td>
            <td><input type="text" name="last_name" size="30" minlength="2" maxlength="64"/></td>
        </tr>

        <tr>
            <td>Address: </td>
            <td><input type="text" name="address" size="30" maxlength="256"/></td>
        </tr>

        <tr>
            <td>Phone: </td>
            <td><input type="text" name="phone_number" size="30" maxlength="16"/></td>
        </tr>

        <tr>
            <td>Email: </td>
            <td><input type="text" name="email" size="30" maxlength="128"/></td>
        </tr>

        <tr>
            <td colspan="2"><input type="submit" value="Add New User" /></td>
        </tr>
    </table>
</form>


<?php include 'footer.php'; ?>
