<?php include 'vitimins_worker_banner.php'; ?>

<main class="products_row">

    <div class="product_column">
        <h1>Edit/Update Product</h1>

        <form action="vitimins_worker.php" method="post">
            <input type="hidden" name="action" value="update_product">
            <input type="hidden" name="product_id" value="<?php echo $product_entry['PRODUCTID']; ?>">
            <input type="hidden" name="category" value="<?php echo $product_entry['CATEGORY']; ?>">

            <label>Category:</label>
            <input list="categories" name="new_category">

            <datalist id="categories">
                <?php while ($category_entry = $categories->fetch_assoc()) { ?>
                    <option value="<?php echo $category_entry['CATEGORY']; ?>">
                <?php } ?>
            </datalist>

            <br>

            <label>Product ID:</label>
            <input type="text" name="new_id" size="30" maxlength="16" />
            <br>

            <label>Product Name:</label>
            <input type="text" name="new_name" size="30" maxlength="16" />
            <br>

            <label>Product Price:</label>
            $<input type="text" name="new_price" size="30" maxlength="16" pattern="\d+(\.\d{2})?" />
            <br>

            <label>Product Stock:</label>
            <input type="number" name="new_stock" size="6" min="0" value="" />
            <br>

            <label>&nbsp;</label>
            <input type="submit" value="Update Product" />
        </form>
    </div>

    <div class="product_column">
            <h1><?php $product_entry['PNAME']; ?></h1>
            <img src="Images/bottleA.png">
    </div>

    <section class="product_column">
      <h1>Current Product Information</h1>

      <div>
            <p style="font-weight: bold;">Category:
                <?php echo $product_entry['CATEGORY'] ?></p>

            <p style="font-weight: bold;">Product ID:
                <?php echo $product_entry['PRODUCTID']; ?></p>

            <p style="font-weight: bold;">Product Name:
                <?php echo $product_entry['PNAME']; ?></p>

            <p style="font-weight: bold;">Price:
                $<?php echo number_format($product_entry['PRICE'], 2); ?></p>

            <p style="font-weight: bold;">Stock:
                <?php echo $product_entry['PSTOCK']; ?></p>
      </div>
    </section>
</main>

<?php include 'footer.php' ?>
