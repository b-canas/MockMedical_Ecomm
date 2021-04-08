<?php
/* To utilize this file, you must first use: require('dpConnection.php')
 * followed by: require ('product_DBaccess.php')
 */

/*
 * Function to get all unique products in a specific category
 * returns a mysqli_result object with all products with a matching categoryID
 */
function get_products_by_category($category) {
    global $conn;

    $stmt = $conn->prepare("SELECT * FROM products WHERE CATEGORY = ? ORDER BY PRODUCTID");

    //if-statement to test if prepare() worked properly
    if (!$stmt) {
        echo "prepare() returned false, for get_products_by_category";
        $conn->close;
        exit;
    }

    $stmt->bind_param("s", $category); //"s" means that the parameter is bound as a string
    $result = $stmt->execute();

    if (!$result) {
        echo 'An error has occurred when attempting to access products by category';
    }

    $result = $stmt->get_result();
    //NOTE: will need to traverse $results by using a loop ($row = $result->fetch_assoc())

    $stmt->close();
    return $result;
}

/*
 * Function to get all unique products
 * returns a mysqli_result object with all products with a matching categoryID
 */
function get_all_products() {
    global $conn;

    $stmt = $conn->prepare("SELECT * FROM products ORDER BY PRODUCTID");

    //if-statement to test if prepare() worked properly
    if (!$stmt) {
        echo "prepare() returned false, for get_products_by_category";
        $conn->close;
        exit;
    }

    $result = $stmt->execute();

    if (!$result) {
        echo 'An error has occurred when attempting to access products by category';
    }

    $result = $stmt->get_result();
    //NOTE: will need to traverse $results by using a loop ($row = $result->fetch_assoc())

    $stmt->close();
    return $result;
}

/*
 * Function to get specific product with matching productID
 * returns a mysqli_result object containing all information about product with matching productID
 */
function get_product($product_id) {
    global $conn;

    $stmt = $conn->prepare("SELECT * FROM products WHERE PRODUCTID = ?");

    //if-statement to test if prepare() worked properly
    if (!$stmt) {
        echo "prepare() returned false, for get_product";
        $conn->close;
        exit;
    }

    $stmt->bind_param("i", $product_id); //"i" means that the parameter is bound as an int
    $result = $stmt->execute();

    if (!$result) {
        echo 'An error has occurred when attempting to access products by product id';
    }

    $result = $stmt->get_result();
    //NOTE: will need to traverse $results by using a loop ($row = $result->fetch_assoc())

    $stmt->close();
    return $result;
}

/*
 * Function to get all unique product categories from the 'products' table
 */
function get_categories()
{
    global $conn;

    $stmt = $conn->prepare("SELECT DISTINCT CATEGORY FROM products");
    $result = $stmt->execute();

    if (!$result) {
        echo 'An error has occurred when attempting to retrieve distinct categories';
    }

    $result = $stmt->get_result();
    //NOTE: will need to traverse $results by using a loop ($row = $result->fetch_assoc())

    $stmt->close();
    return $result;
}

/*
 * Function to delete a specific product entry with a matching productID
 */
function delete_product($product_id) {
    global $conn;

    $stmt = $conn->prepare("DELETE FROM products WHERE PRODUCTID = ?");

    //if-statement to test if prepare() worked properly
    if (!$stmt) {
        echo "prepare() returned false, for delete_product";
        $conn->close;
        exit;
    }

    $stmt->bind_param("i", $product_id);
    $result = $stmt->execute();

    if (!$result) {
        echo 'An error has occurred when attempting to delete product';
    }
}

/*
 * Function to add a product entry to the product table
 */
function add_product($product_id, $product_name, $category, $product_stock, $price)
{
    global $conn;

    $stmt = $db->prepare("INSERT INTO products (PRODUCTID, PNAME, CATEGORY, PSTOCK, PRICE)
                            VALUES (?, ?, ?, ?, ?)");

    if (!$stmt) {
        echo "prepare() returned false, for add_product";
        $conn->close();
        exit;
    }

    $stmt->bind_param("issid", $product_id, $product_name, $category, $product_stock, $price);
    $result = $stmt->execute();

    if (!$result) {
        echo 'An error has occurred when attempting to add product';
    }

    $result = $stmt->get_result();
    $stmt->close();
    return $result;
}

?>
