<?php include 'vitimins_worker_banner.php'; ?>

<main class="products_row">

    <div class="products_column">
        <h1>Add New Product</h1>

        <form action="vitimins_worker.php" method="post">
            <input type="hidden" name="action" value="add_product">
            <input type="hidden" name="product_id" value="<?php echo $product_entry['PRODUCTID']; ?>">
            <input type="hidden" name="category" value="<?php echo $product_entry['CATEGORY']; ?>">

            <label>Category:</label>
            <input list="categories" name="category">

            <datalist id="categories">
                <?php while ($category_entry = $categories->fetch_assoc()) { ?>
                    <option value="<?php echo $category_entry['CATEGORY']; ?>">
                <?php } ?>
            </datalist>

            <br>

            <label>Product ID:</label>
            <input type="text" name="id" size="30" maxlength="16" />
            <br>

            <label>Product Name:</label>
            <input type="text" name="name" size="30" maxlength="16" />
            <br>

            <label>Product Price:</label>
            $<input type="text" name="price" size="30" maxlength="16" pattern="\d+(\.\d{2})?" />
            <br>

            <label>Product Stock:</label>
            <input type="number" name="stock" size="6" min="0" value="" />
            <br>

            <label>&nbsp;</label>
            <input type="submit" value="Add Product" />
        </form>
    </div>

    <div class="products_column"> <!-- will display a table with all products -->
        <h2>Our Current Products</h2>
        <table>
            <tr>
                <th>ID #</th>
                <th>Name</th>
                <th>Category</th>
                <th>Price</th>
                <th>Stock</th>
            </tr>
            <?php while ($product_entry = $products->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $product_entry['PRODUCTID']; ?> | </td> <!--Product ID -->
                <td><?php echo $product_entry['PNAME']; ?></td> <!--Product Name -->
                <td><?php echo $product_entry['CATEGORY']; ?></td> <!--Product Category -->
                <td>$<?php echo number_format($product_entry['PRICE'], 2); ?></td> <!--Product Price -->
                <td><?php echo $product_entry['PSTOCK']; ?></td> <!--Product Stock -->
            </tr>
            <?php } ?> <!--END OF Table WHILE LOOP  -->
        </table>
    </div>

</main>

<?php include 'footer.php' ?>
