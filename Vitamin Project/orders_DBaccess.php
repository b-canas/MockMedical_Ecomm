<?php
/* To utilize this file, you must first use: require('dpConnection.php')
 * followed by: require ('orders_DBaccess.php')
 */

/*
 * Function to get all unique order numbers (orderno)
 * The orderno table consists of these columns: ORDERNO, USERID, TOTALCOST, ATTIME, STATUS, LASTMOD
 * returns a mysqli_result object with all orderno entries
 */
function get_all_orderno() {
    global $conn;

    $stmt = $conn->prepare("SELECT * FROM orderno ORDER BY ORDERNO");

    //if-statement to test if prepare() worked properly
    if (!$stmt) {
        echo "prepare() returned false, for get_all_orders";
        $conn->close;
        exit;
    }

    $result = $stmt->execute();

    if (!$result) {
        echo 'An error has occurred when attempting to get all orders';
    }

    $result = $stmt->get_result();
    //NOTE: will need to traverse $results by using a loop ($row = $result->fetch_assoc())

    $stmt->close();

    if ($result->num_rows === 0) {
        //no orderno with matching userid found
        return false;
    } else {
        return $result;
    }
}

function get_orderno($orderno) {
    global $conn;

    $stmt = $conn->prepare("SELECT * FROM orderno WHERE ORDERNO = ?");

    //if-statement to test if prepare() worked properly
    if (!$stmt) {
        echo "prepare() returned false, for get_orderno";
        $conn->close;
        exit;
    }

    $stmt->bind_param("i", $orderno);
    $result = $stmt->execute();

    if (!$result) {
        echo 'An error has occurred when attempting to access orderno.s with specific orderno';
    }

    $result = $stmt->get_result();

    return $result;
}

/*
 * Function to get all unique order numbers from orderno table with matching (userid)
 * The orderno table consists of these columns: ORDERNO, USERID, TOTALCOST, ATTIME, STATUS, LASTMOD
 * returns a mysqli_result object with all orderno entries
 */
function get_orderno_for_user($userid) {
    global $conn;

    $stmt = $conn->prepare("SELECT * FROM orderno WHERE USERID = ?");

    //if-statement to test if prepare() worked properly
    if (!$stmt) {
        echo "prepare() returned false, for get_orderno_for_user";
        $conn->close;
        exit;
    }

    $stmt->bind_param("i", $userid);
    $result = $stmt->execute();

    if (!$result) {
        echo 'An error has occurred when attempting to access orderno.s for userid';
    }

    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        //no orderno with matching userid found
        return false;
    } else {
        return $result;
    }
}

/*
 * Function to get all unique order numbers from orderno table with matching (userid) AND (status)
 * The orderno table consists of these columns: ORDERNO, USERID, TOTALCOST, ATTIME, STATUS, LASTMOD
 * returns a mysqli_result object with all orderno entries
 */
function get_orderno_for_user_by_status($userid, $status) {
    global $conn;

    $stmt = $conn->prepare("SELECT * FROM orderno WHERE USERID = ? AND STATUS = ?");

    //if-statement to test if prepare() worked properly
    if (!$stmt) {
        echo "prepare() returned false, for get_orderno_for_user";
        $conn->close;
        exit;
    }

    $stmt->bind_param("is", $userid, $status);
    $result = $stmt->execute();

    if (!$result) {
        echo 'An error has occurred when attempting to access orderno.s for userid';
    }

    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        //no orderno with matching userid found
        return false;
    } else {
        return $result;
    }
}

/*
 * Function to get all item entries from orders table with matching (orderno)
 * The orders table consists of these columns: ORDERNO, USERID, PRODUCTID, AMOUNT, ICOST, TPRICE
 * returns a mysqli_result object with all orderno entries
 */
function get_orders_by_orderno($orderno) {
    global $conn;

    $stmt = $conn->prepare("SELECT * FROM orders WHERE ORDERNO = ?");

    //if-statement to test if prepare() worked properly
    if (!$stmt) {
        echo "prepare() returned false, for get_orders_by_orderno";
        $conn->close;
        exit;
    }

    $stmt->bind_param("i", $orderno);
    $result = $stmt->execute();

    if (!$result) {
        echo 'An error has occurred when attempting to access orders by orderno';
    }

    $result = $stmt->get_result();

    return $result;
}

/*
 * Function to get all possible status values. Used for setting up possible status values
 * to update an orderno to.
 *
 * Returns an indexed array
 */
function get_status_options() {
    $status_arr = array("READY", "SHIPPED", "DELIVERED", "CANCELLED");

    return $status_arr;
}

/*
 * Function to update the status value of a specific orderno and the LASTMOD (last modified) timestamp
 * Possible values are seen in get_status_options(): READY, SHIPPED, DELIVERED, CANCELLED
 */
function update_orderno_status($orderno, $status) {
    global $conn;

    $stmt = $conn->prepare("UPDATE orderno SET STATUS = ?, LASTMOD = CURRENT_TIMESTAMP WHERE ORDERNO = ?");

    //if-statement to test if prepare() worked properly
    if (!$stmt) {
        echo "prepare() returned false, for update_orderno_status";
        $conn->close;
        exit;
    }

    $stmt->bind_param("si", $status, $orderno);
    $result = $stmt->execute();

    if (!$result) {
        echo 'An error has occurred when attempting to update status for an order';
    }
}
?>
