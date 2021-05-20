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
 * returns a mysqli_result object with all products
 */
function get_all_products() {
    global $conn;

    $stmt = $conn->prepare("SELECT * FROM products ORDER BY PRODUCTID");

    //if-statement to test if prepare() worked properly
    if (!$stmt) {
        echo "prepare() returned false, for get_all_products";
        $conn->close;
        exit;
    }

    $result = $stmt->execute();

    if (!$result) {
        echo 'An error has occurred when attempting to get all products';
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

    $stmt = $conn->prepare("INSERT INTO products (PRODUCTID, PNAME, CATEGORY, PSTOCK, PRICE)
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

/*
 * Function to update a specific column of a certain product, whose ID is passed
 * as an arguement: $productID
 */
function update_column($product_id, $column, $value) {
    global $conn;

    //must use a switch statement for the specfic columns
    switch ($column) {
        case 'PRODUCTID':
            $stmt = $conn->prepare("UPDATE products SET PRODUCTID = ? WHERE PRODUCTID = ?");
            $stmt->bind_param('ii', $value, $product_id);
            break;

        case 'PNAME':
            $stmt = $conn->prepare("UPDATE products SET PNAME = ? WHERE PRODUCTID  = ?");
            $stmt->bind_param('si', $value, $product_id);
            break;

        case 'CATEGORY':
            $stmt = $conn->prepare("UPDATE products SET CATEGORY = ? WHERE PRODUCTID  = ?");
            $stmt->bind_param('si', $value, $product_id);
            break;

        case 'PSTOCK':
            $stmt = $conn->prepare("UPDATE products SET PSTOCK = ? WHERE PRODUCTID  = ?");
            $stmt->bind_param('ii', $value, $product_id);
            break;

        case 'PRICE':
            $stmt = $conn->prepare("UPDATE products SET PRICE = ? WHERE PRODUCTID  = ?");
            $stmt->bind_param('di', $value, $product_id);
            break;
    }

    $result = $stmt->execute();

    if (!$result) {
        echo 'An error has occurred when attempting to update product';
    }

    $stmt->close();
}

?>
