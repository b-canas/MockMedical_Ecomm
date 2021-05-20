<?php include 'vitimins_worker_banner.php'; ?>

<main class="box">

    <div class="products_row">
        <aside class="product_column"> <!-- show all product categories -->
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

        <div class="product_column">
            <h1><?php echo $prodName; ?></h1>
            <img src="Images/bottleA.png">
        </div>


        <div class="product_column">
            <p style="font-weight: bold;">Product ID:
                <?php echo $product_entry['PRODUCTID']; ?></p>

            <p style="font-weight: bold;">Product Name:
                <?php echo $product_entry['PNAME']; ?></p>

            <p style="font-weight: bold;">Category:
                <?php echo $product_entry['CATEGORY']; ?></p>

            <p style="font-weight: bold;">Price:
                $<?php echo number_format($product_entry['PRICE'], 2); ?></p>

            <p style="font-weight: bold;">Available Stock:
                <?php echo $product_entry['PSTOCK']; ?></p>
        </div>
    </div>
</main>

<?php include 'footer.php' ?>
