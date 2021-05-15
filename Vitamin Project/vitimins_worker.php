<?php
require ('dbConnection.php');
require ('product_DBaccess.php');
require ('user_DBaccess.php');
require ('orders_DBaccess.php');

//will need to add other DB accesses for other functions

/*
 * $action is a variable that will determine what page to redirect to and what variabels to
 * preemptively setup. Essentially working as a controller for vitamin_worker
 * Possible actions: show_products, view_product, delete_product, show_add_form, add_product
 *                   show_edit_form, update_product, log_off
 */

$action = filter_input(INPUT_POST, 'action'); //check POST level for action variable
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action'); //check GET level for action variable

    if ($action == NULL)
        $action = 'show_products'; //default action
}

/*
 * The default action for the worker login is to show the current products in the database.
 * Products are organized first by CATEGORY and then by PRODUCTID
 */
if ($action == 'show_products') {
    $category = filter_input(INPUT_GET, 'category');

    //default will set category variable to All which will display all products
    if ($category == NULL || $category == FALSE || $category == 'All') {
        $category = 'All';
        $categories = get_categories();
        $products = get_all_products();
    }
    else { //the category variable has already been set
        //$category SHOULD be == 'Child' || 'Adult' || 'Elderly' ...
        $categories = get_categories();
        $products = get_products_by_category($category);
    }

    include('admin_files/current_products.php');

} //END OF if ($action == 'show_products')

/*
 * The action 'view_product', will display a page showing all information about a specific product
 */
else if ($action == 'view_product') {
    $productID = filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT); //check POST level for productID variable

    if ($productID == NULL || $productID == FALSE) { //*****NEEDS MORE WORK HERE *****
        echo "Invalid product ID";
        exit();
    }
    else {
        $categories = get_categories();
        $product = get_product($productID);

        $product_entry = $product->fetch_assoc();
        $productID = $product_entry['PRODUCTID'];
        $prodName = $product_entry['PNAME'];

        include('admin_files/admin_product_view.php');
    }
} //END OF if ($action == 'view_product'

/*
 * The action 'show_edit_form', will display a page showing all information about a specific product
 * and then a form where the product values can be updated
 *
 */
else if ($action == 'show_edit_form') {
    $productID = filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT); //check POST level for productID variable
    $categories = get_categories();

    $product = get_product($productID);
    $product_entry = $product->fetch_assoc();

    include('admin_files/product_edit.php');
} //END OF if ($action == 'show_edit_form'

/*
 * The action 'update_product', will only be set if an edit_form has been submitted.
 * Here the product columns will be updated as long as valid input has been entered
 */
else if ($action == 'update_product') {

    $productID = filter_input(INPUT_POST, 'product_id');
    $category = filter_input(INPUT_POST, 'category');

    $newName = filter_input(INPUT_POST, 'new_name');
    if ($newName !== '' && $newName !== NULL && $newName !== FALSE) {
        update_column($productID, 'PNAME', $newName);
    }

    $newCategory = filter_input(INPUT_POST, 'new_category');
    if ($newCategory !== '' && $newCategory !== NULL && $newCategory !== FALSE) {
        update_column($productID, 'CATEGORY', $newCategory);
    }

    $newStock = filter_input(INPUT_POST, 'new_stock');
    if ($newStock !== '' && $newStock !== NULL && $newStock !== FALSE) {
        update_column($productID, 'PSTOCK', $newStock);
    }

    $newPrice = filter_input(INPUT_POST, 'new_price');
    if ($newPrice !== '' && $newPrice !== NULL && $newPrice !== FALSE) {
        update_column($productID, 'PRICE', $newPrice);
    }

    //THIS MUST BE LAST CHECK IN FORM
    //Since all sql queries use the product id as a key, ID must be changed last
    $newID = filter_input(INPUT_POST, 'new_id');
    if ($newID !== '' && $newID !== NULL && $newID !== FALSE) {
        update_column($productID, 'PRODUCTID', $newID);
    }

    if ($newCategory !== '' && $newCategory !== NULL && $newCategory !== FALSE)
        header("Location: ?category=$newCategory");
    else
        header("Location: ?category=$category");
} //END OF if ($action == 'update_product')

/*
 * The action 'delete_product', is available via the Delete button in every entry of the
 * current_products table. The action will delete a specific product from the database
 */
else if ($action == 'delete_product') {
    $productID = filter_input(INPUT_POST, 'product_id');
    $category = filter_input(INPUT_POST, 'category');

    if ($category === NULL || $productID === NULL)
    {
        $error = "Invalid product/category ID";
        exit($error);
    }
    else
    {
        delete_product($productID);
        header("Location: ?category=$category");
    }
} //END OF if ($action == 'delete_product')

else if ($action == 'show_add_product_form') {

    //These variables are created to act as sort of a reference when creating a new product
    $categories = get_categories();
    $products = get_all_products();

    include('admin_files/admin_add_product.php');
}

else if ($action == 'add_product') {

    //Get product values from the form
    $productID = filter_input(INPUT_POST, 'id');
    $productName = filter_input(INPUT_POST, 'name');
    $category = filter_input(INPUT_POST, 'category');
    $initialStock = filter_input(INPUT_POST, 'stock');
    $price = filter_input(INPUT_POST, 'price');

    add_product($productID, $productName, $category, $initialStock, $price);

    //After product insertion, return to product add form
    //These variables are created to act as sort of a reference when creating a new product
    $categories = get_categories();
    $products = get_all_products();

    include('admin_files/admin_add_product.php');
}


/*
 * The action 'show_users' will display a table filled with user info for all users currently
 * registerd in the database.
 */
else if ($action == 'show_users') {

    $users = get_all_users();

    /* get_all_users returns a mysqli_result object with all users.
     * To access column values of returned users, you will need to traverse $users
     * by using a loop ($row = $users->fetch_assoc()) */

    include ('admin_files/current_users.php');
} //END OF if ($action == 'show_users')

/*
 * The action 'show_user_edit_form' will display a page showing all information about a specific user
 * and then a form where the user values can be updated
 */
else if ($action == 'show_user_edit_form') {

    $userID = filter_input(INPUT_POST, 'user_id');
    if ($userID == NULL)
        $userID = filter_input(INPUT_GET, 'user_id');

    $user_entry = get_user_withID($userID)->fetch_assoc();
    //Get current user values for later comparison of new ones
    $current_username = $user_entry['USERNAME'];
    $current_access = $user_entry['ACCESS'];
    $current_fName = $user_entry['FNAME'];
    $current_lName = $user_entry['LNAME'];
    $current_address = $user_entry['ADDRESS'];
    $current_phone = $user_entry['PHONE'];
    $current_email = $user_entry['EMAIL'];

    include('admin_files/admin_user_management.php');

} //END OF if ($action == 'show_user_edit_form')

else if ($action == 'show_add_user_form') {

    //No variables are prepared here. The form is called
    include('admin_files/admin_add_user.php');

}

else if ($action == 'add_user') {

    //Fetch user variables from the add_user_form
    $username = filter_input(INPUT_POST, 'username');
    $password = filter_input(INPUT_POST, 'password');
    $access = filter_input(INPUT_POST, 'access_code');
    $firstName = filter_input(INPUT_POST, 'first_name');
    $lastName = filter_input(INPUT_POST, 'last_name');
    $address = filter_input(INPUT_POST, 'address');
    $phone = filter_input(INPUT_POST, 'phone_number');
    $email = filter_input(INPUT_POST, 'email');

    //Check for any null values
    if ($username != NULL && $password != NULL && $access != NULL && $firstName != NULL &&
        $lastName != NULL && $address != NULL && $phone != NULL && $email != NULL ) {

        //NULL checks have passed. Continue to insert
        add_user_withAccess($username, $password, $access, $firstName, $lastName, $address, $phone, $email);
    }

    //After user insertion, return to users list
    $users = get_all_users();

    include ('admin_files/current_users.php');
}

else if ($action == 'update_user') {

    $userID = filter_input(INPUT_POST, 'user_id');

    //Get any new values from the user_edit_form action.
    $new_username = filter_input(INPUT_POST, 'new_username');
    $new_accessCode = filter_input(INPUT_POST, 'access_code');
    $new_fName = filter_input(INPUT_POST, 'first_name');
    $new_lName = filter_input(INPUT_POST, 'last_name');
    $new_address = filter_input(INPUT_POST, 'address');
    $new_phoneNum = filter_input(INPUT_POST, 'phone_number');
    $new_email = filter_input(INPUT_POST, 'email');

    //Get all the current values of the user attributes which were also passed along by the form
    $current_username = filter_input(INPUT_POST, 'current_username');
    $current_access = filter_input(INPUT_POST, 'current_access');
    $current_fName = filter_input(INPUT_POST, 'current_fName');
    $current_lName = filter_input(INPUT_POST, 'current_lName');
    $current_address = filter_input(INPUT_POST, 'current_address');
    $current_phone = filter_input(INPUT_POST, 'current_phone');
    $current_email= filter_input(INPUT_POST, 'current_email');

    //Check for nulls and compare current/new values. If checks return true, update columns
    if ($new_username != NULL && $new_username != $current_username) {
        update_user_column($userID, 'USERNAME', $new_username);
    }

    if ($new_accessCode != NULL && $new_accessCode != $current_access) {
        update_user_column($userID, 'ACCESS', $new_accessCode);
    }

    if ($new_fName != NULL && $new_fname != $current_fName) {
        update_user_column($userID, 'FNAME', $new_fName);
    }

    if ($new_lName != NULL && $new_lName != $current_lName) {
        update_user_column($userID, 'LNAME', $new_lName);
    }

    if ($new_address != NULL && $new_address != $current_address) {
        update_user_column($userID, 'ADDRESS', $new_address);
    }

    if ($new_phoneNum != NULL && $new_phoneNum != $current_phone) {
        update_user_column($userID, 'PHONE', $new_phoneNum);
    }

    if ($new_email != NULL && $new_email != $current_email) {
        update_user_column($userID, 'EMAIL', $new_email);
    }

    header("Location: ?action=show_user_edit_form&user_id=$userID");

} //END OF if ($action == 'update_user')

else if ($action == 'delete_user') {

    $userID = filter_input(INPUT_POST, 'user_id');

    if ($userID === NULL)
    {
        $error = "Invalid user ID";
        exit($error);
    }
    else
    {
        delete_user($userID);
        header("Location: ?action=show_users");
    }

} //END OF if ($action == 'delete_user')

/*
 * The action 'view_user_orders' will display a table filled with all orderno.s that have
 * been recorded with a matching userid.
 * IF NO userid is provided, defualt will display all orderno's in database
 */
else if ($action == 'view_user_orders') {

    $userID = filter_input(INPUT_POST, 'user_id'); //check POST level for userID variable
    if ($userID == NULL) {
        $userID = filter_input(INPUT_GET, 'user_id'); //check GET level for userID variable

        //If no userID found, default will set userID variable to All which will display orders for all users
        if ($userID == NULL) {
            $userID = 'All';
        }
    }

    $wantedStatus = filter_input(INPUT_POST, 'wanted_status'); //check POST level for wantedStatus variable
    if ($wantedStatus == NULL) {
        $wantedStatus = filter_input(INPUT_GET, 'wanted_status'); //check GET level for wantedStatus variable

        //If no wanted status is found, default will wanted status to All which will display orders of any status
        if ($wantedStatus == NULL) {
            $wantedStatus = 'All';
        }
    }

    //Initialize variables used to populate table values
    if ($userID == 'All') {
        $users = get_all_customer_userIds();
        $orders = get_all_orderno();
    }
    else { //A specfic userID has been requested
        $users = get_all_customer_userIds();
        $orders = get_orderno_for_user($userID);
    }

    $statusOptions = get_status_options();

    //*** NOTE: $orders will have the value of false if no orderno.s are found ***

    include('admin_files/current_orders.php');
} //END OF if ($action == 'view_user_orders')

else if ($action == 'update_order_status') {

    $orderno = filter_input(INPUT_POST, 'order_no');
    $newStatus = filter_input(INPUT_POST, 'status_choices');
    $oldStatus = filter_input(INPUT_POST, 'current_order_status');
    $idFilterOfUserOrders = filter_input(INPUT_POST, 'current_id_filter');
    $statusFilterOfUserOrders = filter_input(INPUT_POST, 'current_status_filter');

    $viewOrderDetailsFlag = filter_input(INPUT_POST, 'view_order_details_flag');    //If this variable is set, go to view_order_details action

    if ($newStatus != $oldStatus) {
        update_orderno_status($orderno, $newStatus);
    }

    if ($viewOrderDetailsFlag != NULL)
        header("Location: ?action=view_order_details&order_no=$orderno");
    else
        header("Location: ?action=view_user_orders&user_id=$idFilterOfUserOrders&wanted_status=$statusFilterOfUserOrders");

} //END OF if ($action == 'update_order_status')

else if ($action == 'view_order_details') {

    $orderno = filter_input(INPUT_GET, 'order_no');

    $orderDetailsSQLObject = get_orderno($orderno);
    $orderDetails = $orderDetailsSQLObject->fetch_assoc();

    $orderItems = get_orders_by_orderno($orderno);

    $statusOptions = get_status_options();

    include('admin_files/order_details.php');
}

?>
