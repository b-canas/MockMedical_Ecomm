<?php
require ('dbConnection.php');
require ('product_DBaccess.php');
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

    include('current_products.php');

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

        include('admin_product_view.php');
    }
}
?>
