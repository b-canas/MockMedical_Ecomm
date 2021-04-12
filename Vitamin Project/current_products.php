<?php include 'vitimins_worker_banner.php'; ?>

<main class="box">
    <h1>Current Products</h1>

    <div class="products_row">

    <aside class="products_column"> <!-- show all product categories -->
        <h2>Categories</h2>
        <nav>
            <ul>
                <li> <!--This first link in the list will be the default All products -->
                    <a href="?category=All">All</a>
                </li>
                <?php while ($category_entry = $categories->fetch_assoc()) { ?>
                    <li>
                        <a href="?category=<?php
                                  echo $category_entry['CATEGORY']; ?>">
                            <?php echo $category_entry['CATEGORY']; ?>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </nav>
    </aside>

    <div class="products_column"> <!-- will display a table with products in selected category -->
        <h2><?php echo $category;?> Products</h2>
        <table>
            <tr>
                <th>Name</th>
                <th>Category</th>
                <th>Price</th>
                <th>Stock</th>
                <th>&nbsp;</th> <!--column will have View button -->
                <th>&nbsp;</th> <!--column will have Edit button -->
                <th>&nbsp;</th> <!--column will have Delete button -->
            </tr>
            <?php while ($product_entry = $products->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $product_entry['PNAME']; ?></td> <!--Product Name -->
                <td><?php echo $product_entry['CATEGORY']; ?></td> <!--Product Category -->
                <td>$<?php echo number_format($product_entry['PRICE'], 2); ?></td> <!--Product Price -->
                <td><?php echo $product_entry['PSTOCK']; ?></td> <!--Product Stock -->

                <td> <!--Table cell with the View button which will direct to the product page of a specific product-->
                    <form action="?" method="post">
                        <input type="hidden" name="action" value="view_product"> <!--Action variable for the controller vitimans_worker-->
                        <input type="hidden" name="product_id"
                            value="<?php echo $product_entry['PRODUCTID']; ?>"> <!--Product ID of product to be directed to-->
                        <input type="submit" value="View">
                    </form>
                </td>

                <td> <!--Table cell with the Edit button which will direct to a form to edit a specific product-->
                    <form action="?" method="post">
                        <input type="hidden" name="action" value="show_edit_form"> <!--Action variable for the controller vitimans_worker-->
                        <input type="hidden" name="product_id"
                            value="<?php echo $product_entry['PRODUCTID']; ?>"> <!--Product ID of product to be edited-->
                        <input type="hidden" name="category"
                            value="<?php echo $product_entry['CATEGORY']; ?>"> <!--Product category of product to be edited-->
                        <input type="submit" value="Edit">
                    </form>
                </td>

                <td> <!--Table cell with the Delete button which will delete a product PERMANENTLY from the DB-->
                    <form action="?" method="post">
                        <input type="hidden" name="action" value="delete_product"> <!--Action variable for the controller vitimans_worker-->
                        <input type="hidden" name="product_id"
                            value="<?php echo $product_entry['PRODUCTID']; ?>"> <!--Product ID of product to be deleted-->
                        <input type="hidden" name="category"
                            value="<?php echo $product_entry['CATEGORY']; ?>"> <!--Product category of product to be deleted-->
                        <input type="submit" value="Delete">
                    </form>
                </td>
            </tr>
            <?php } ?> <!--END OF Table WHILE LOOP  -->
        </table>
        <p>
            <a href="?action=show_add_form"> Add Product</a> <!--To be built upon -->
        </p>
    </div>

    </div>
</main>

<?php include 'footer.php'; ?>
