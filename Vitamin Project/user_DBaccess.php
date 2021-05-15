<?php
/* To utilize this file, you must first use: require('dpConnection.php')
 * followed by: require ('user_DBaccess.php')
 */

/*
 * Function to get all unique users
 * returns a mysqli_result object with all users
 */
function get_all_users() {
    global $conn;

    $stmt = $conn->prepare("SELECT USERID, USERNAME, ACCESS, FNAME, LNAME, ADDRESS, PHONE, EMAIL FROM users ORDER BY USERID");

    //if-statement to test if prepare() worked properly
    if (!$stmt) {
        echo "prepare() returned false, for get_all_users";
        $conn->close;
        exit;
    }

    $result = $stmt->execute();

    if (!$result) {
        echo 'An error has occurred when attempting to get all users';
    }

    $result = $stmt->get_result();
    //NOTE: will need to traverse $results by using a loop ($row = $result->fetch_assoc())

    $stmt->close();
    return $result;
}

/*
 * Function to get all unique users' identitification: (USERID, USERNAME)
 * returns a mysqli_result object with all users
 */
function get_all_customer_userIds() {
    global $conn;

    $stmt = $conn->prepare("SELECT USERID, USERNAME FROM users WHERE ACCESS = -1 ORDER BY USERID");

    //if-statement to test if prepare() worked properly
    if (!$stmt) {
        echo "prepare() returned false, for get_all_userIds";
        $conn->close;
        exit;
    }

    $result = $stmt->execute();

    if (!$result) {
        echo 'An error has occurred when attempting to get all users Ids';
    }

    $result = $stmt->get_result();
    //NOTE: will need to traverse $results by using a loop ($row = $result->fetch_assoc())

    $stmt->close();
    return $result;
}

/*
 * Function to get specific user with matching username and password
 * returns a mysqli_result object containing all information about user with matching credentials
 * ** If no user found, returns false,
 */
function get_user_withLogin($username, $password) {
    global $conn;

    $stmt = $conn->prepare("SELECT * FROM users WHERE USERNAME = ? AND PASSWORD = ?");

    if (!$stmt) {
        echo "prepare() returned false, for get_user_withLogin";
        $conn->close();
        exit;
    }

    //ADD PASSWORD HASH FUNCTION HERE

    $stmt->bind_param("ss", $username, $password);
    $result = $stmt->execute();

    if (!$result) {
        echo 'An error has occurred when attempting to get user with login';
    }

    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        //no user with matching credentials found
        return false;
    } else {
        return $result;
    }
}

/*
 * Function to get specific user with matching USERID
 * returns a mysqli_result object containing all information about user with matching id
 */
function get_user_withID($user_id) {
    global $conn;

    $stmt = $conn->prepare("SELECT * FROM users WHERE USERID = ?");

    if (!$stmt) {
        echo "prepare() returned false, for get_user_withID";
        $conn->close();
        exit;
    }

    $stmt->bind_param("i", $user_id);
    $result = $stmt->execute();

    $result = $stmt->get_result();
    //NOTE: will need to access columns of user by using $result->fetch_assoc() which returns an assoc. array

    $stmt->close();
    return $result;
}

/*
 * Function to add a user to the user table with an explicit access as opposed to
 * adding a user with defualt access of -1 (customer access)
 */
function add_user_withAccess($username, $password, $access, $first_name, $last_name, $address, $phone, $email) {
    global $conn;

    $stmt = $conn->prepare("INSERT INTO users (USERNAME, PASSWORD, ACCESS, FNAME, LNAME, ADDRESS, PHONE, EMAIL)
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

    if (!$stmt) {
        echo "prepare() returned false, for add_user_withAccess";
        $conn->close();
        exit;
    }

    //ADD PASSWORD HASH FUNCTION HERE

    $stmt->bind_param("ssisssss", $username, $password, $access, $first_name, $last_name, $address, $phone, $email);
    $result = $stmt->execute();

    if (!$result) {
        echo 'An error has occurred when attempting to add user';
    }

    $result = $stmt->get_result();
    $stmt->close();
    return $result;
}

/*
 * Function to delete a specific user with a matching USERID
 */
function delete_user($user_id) {
    global $conn;

    $stmt = $conn->prepare("DELETE FROM users WHERE USERID = ?");

    //if-statement to test if prepare() worked properly
    if (!$stmt) {
        echo "prepare() returned false, for delete_user";
        $conn->close;
        exit;
    }

    $stmt->bind_param("i", $user_id);
    $result = $stmt->execute();

    if (!$result) {
        echo 'An error has occurred when attempting to delete user';
    }
}

/*
 * Function to update a specific column of a certain user, whose ID is passed
 * as an arguement: $user_id
 */
function update_user_column($user_id, $column, $value) {
    global $conn;

    //switch statement for specific columns
    switch ($column) {
        case 'USERNAME':
        $stmt = $conn->prepare("UPDATE users SET USERNAME = ? WHERE USERID = ?");
        $stmt->bind_param(si, $value, $user_id);
        break;

        case 'PASSWORD':
        $stmt = $conn->prepare("UPDATE users SET PASSWORD = ? WHERE USERID = ?");

        //ADD PASSWORD HASH FUNCTION HERE

        $stmt->bind_param(si, $value, $user_id);
        break;

        case 'ACCESS':
        $stmt = $conn->prepare("UPDATE users SET ACCESS = ? WHERE USERID = ?");
        $stmt->bind_param(ii, $value, $user_id);
        break;

        case 'FNAME':
        $stmt = $conn->prepare("UPDATE users SET FNAME = ? WHERE USERID = ?");
        $stmt->bind_param(si, $value, $user_id);
        break;

        case 'LNAME':
        $stmt = $conn->prepare("UPDATE users SET LNAME = ? WHERE USERID = ?");
        $stmt->bind_param(si, $value, $user_id);
        break;

        case 'ADDRESS':
        $stmt = $conn->prepare("UPDATE users SET ADDRESS = ? WHERE USERID = ?");
        $stmt->bind_param(si, $value, $user_id);
        break;

        case 'PHONE':
        $stmt = $conn->prepare("UPDATE users SET PHONE = ? WHERE USERID = ?");
        $stmt->bind_param(si, $value, $user_id);
        break;

        case 'EMAIL':
        $stmt = $conn->prepare("UPDATE users SET EMAIL = ? WHERE USERID = ?");
        $stmt->bind_param(si, $value, $user_id);
        break;
    }

    $result = $stmt->execute();

    if (!$result) {
        echo 'An error has occurred when attempting to update user';
    }

    $stmt->close();
}


?>
