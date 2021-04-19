<?php include 'vitimins_worker_banner.php'; ?>

    <div class="products_row">
        <aside class="category_column"> <!-- show all product categories -->
            <h2>Categories</h2>
			<hr class="category_hr"><br>
            <nav class = "product_titles">
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

        <div class="product_column">
            <span class="product_name"><h3><?php echo $prodName; ?></h3></span>
			
			<span class="product_span">
			<ul class="product_list">
				<li><span class="product_list_label">Product ID:</span>
					<?php echo $product_entry['PRODUCTID']; ?></li>

				<li><span class="product_list_label">Product Name:</span>
					<?php echo $product_entry['PNAME']; ?></li>

				<li><span class="product_list_label">Category:</span>
					<?php echo $product_entry['CATEGORY']; ?></li>

				<li><span class="product_list_label">Price:</span>
					$<?php echo number_format($product_entry['PSTOCK'], 2); ?></li>

				<li><span class="product_list_label">Available Stock:</span>
					<?php echo $product_entry['PRICE']; ?></li>
			</ul>
			</span>
			
			<img src="Images/bottleA.png">
        </div>
    </div>
	
<?php include 'footer.php' ?>
