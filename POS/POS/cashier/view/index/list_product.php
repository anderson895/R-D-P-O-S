<div class="tables color-gray">
            <div class="container" style="margin-top: 20px;">
                <h1 class="color-gray">Product Listing </h1>
            </div>
            <div class="category">
                <form action="index.php" class="button-rounded"  method="GET" style="border: none; margin: 0px -px;">
                <input required type="text" style="margin-right: -15px;" class="button-rounded search" name="query" id="searchInput" 
                    <?php 
                    if (isset($_GET['query'])) {
                    echo 'placeholder="' . htmlspecialchars($_GET['query']) . '" value="' . htmlspecialchars($_GET['query']) . '"';
                    } else {
                    echo 'placeholder="Search"';
                    }
                    ?> 
                >
                <div id="suggestionsContainer"></div>
               </form>

                <?php
                $category = "SELECT * FROM `category`";
                $categoryResult = $conn->query($category);
                echo '<a href="index.php" class="button-rounded">All</a>';
                // Display category buttons
                while ($row = $categoryResult->fetch_assoc()) {
                    echo '<a href="?category=' . urlencode($row["category_id"]) . '" class="button-rounded">' . $row["category_name"] . '</a>';
                }
                ?>
            </div>
            <?php
                if (isset($_GET['query'])) {
                    // Sanitize and store the search query
                    $searchQuery = htmlspecialchars($_GET['query']);                                                                
                    echo '<div class="parent">'; // Opening div tag was missing
                    
                    $productSql = "SELECT product.prod_id, product.prod_name, product.prod_currprice, product.prod_image, 
                    SUM(IF(s_expiration = '0000-00-00' OR s_expiration > '$current_date', stocks.s_amount, 0)) AS prod_stocks
                    FROM product 
                    LEFT JOIN stocks ON product.prod_id = stocks.s_prod_id 
                    WHERE prod_status = 0  AND prod_name LIKE '%$searchQuery%' 
                    GROUP BY product.prod_id, product.prod_name, product.prod_currprice, product.prod_image";
                    
                    // Check if a category is selected for filtering
                    if (isset($_GET['category'])) {
                        $selectedCategory = $_GET['category'];
                        // Prevent SQL injection using prepared statements
                        $productSql = "SELECT product.prod_id, product.prod_name, product.prod_currprice, product.prod_image, 
                       SUM(IF(s_expiration = '0000-00-00' OR s_expiration > '$current_date', stocks.s_amount, 0)) AS prod_stocks
                        FROM product LEFT JOIN stocks ON product.prod_id = stocks.s_prod_id 
                        WHERE prod_status = 0 AND prod_name LIKE '%$searchQuery%' AND prod_category_id = ? 
                        GROUP BY product.prod_id, product.prod_name, product.prod_currprice, product.prod_image";
                        
                        // Prepare and bind the parameter
                        $stmt = $conn->prepare($productSql);
                        $stmt->bind_param("s", $selectedCategory);
                        $stmt->execute();
                        
                        $result = $stmt->get_result();
                    } else {
                        // No category selected, retrieve all products
                        $result = $conn->query($productSql);
                    }

                    // Loop through the result set and display products
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo '<div class="product">';
                                echo '<div class="image">';
                                
                                if (!empty($row['prod_stocks'])) {
                                    echo '<a href="#" class="a-class 
                            togler" data-bs-toggle="modal" data-bs-target="#ModalCart"
                            data-id="'.$row["prod_id"].'"
                                    >';
                                    if (!empty($row["prod_image"])) {
                                        echo '<img src="../../upload_prodImg/' . $row["prod_image"] . '" alt="Product">';
                                    } else {
                                        echo '<img src="../../upload_prodImg/no_available.jpg" alt="No Image">';
                                    }
                                    echo '</a>';
                                } else if (!empty($row["prod_image"])) {
                                    echo '<img src="../../upload_prodImg/' . $row["prod_image"] . '" alt="Product">';
                                } else {
                                    echo '<img src="../../upload_prodImg/no_available.jpg" alt="No Image">';
                                }
                                
                                echo '</div>';
                                echo '<div class="description">';
                                echo '<p>' . $row["prod_name"] . '</p>';
                                echo '<p>Price: ₱ ' . $row["prod_currprice"] . '</p>';
                                
                                if ($row["prod_stocks"] > 0) {
                                    echo '<p>Stocks: ' . $row["prod_stocks"] . '</p>';
                                } else {
                                    echo '<p>Out of stocks</p>';
                                }
                                
                                echo '</div>';
                                echo '</div>';
                            }
                        } else {
                            echo '<p style="margin-left: 15px;">No results found.</p>';
                        }
                    echo '</div>'; 
                } else {
                    echo '<div class="parent">'; // Opening div tag was missing
                
                    $productSql = "SELECT product.prod_id, product.prod_name, product.prod_currprice, product.prod_image, 
                   SUM(IF(s_expiration = '0000-00-00' OR s_expiration > '$current_date', stocks.s_amount, 0)) AS prod_stocks
                    FROM product
                    LEFT JOIN stocks ON product.prod_id = stocks.s_prod_id 
                    WHERE prod_status = 0 
                    GROUP BY product.prod_id, product.prod_name, product.prod_currprice, product.prod_image;";
                    
                    // Check if a category is selected for filtering
                    if (isset($_GET['category'])) {
                        $selectedCategory = $_GET['category'];
                        // Prevent SQL injection using prepared statements
                        $productSql = "SELECT product.prod_id, product.prod_name, product.prod_currprice, product.prod_image,
                         SUM(IF(s_expiration = '0000-00-00' OR s_expiration > '$current_date', stocks.s_amount, 0)) AS prod_stocks
                         FROM product 
                         LEFT JOIN stocks ON product.prod_id = stocks.s_prod_id 
                         
                         WHERE prod_status = 0 
                         AND prod_category_id = ? 
                         GROUP BY product.prod_id, product.prod_name, product.prod_currprice, product.prod_image";
                        
                        // Prepare and bind the parameter
                        $stmt = $conn->prepare($productSql);
                        $stmt->bind_param("s", $selectedCategory);
                        $stmt->execute();
                        
                        $result = $stmt->get_result();
                    } else {
                        // No category selected, retrieve all products
                        $result = $conn->query($productSql);
                    }

                    // Loop through the result set and display products
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="product">';
                        echo '<div class="image">';
                        
                        if (!empty($row['prod_stocks'])) {
                            echo '<a href="#" class="a-class 
                            togler" data-bs-toggle="modal" data-bs-target="#ModalCart"
                            data-id="'.$row["prod_id"].'"
                        
                            ">';
                            if (!empty($row["prod_image"])) {
                                echo '<img src="../../upload_prodImg/' . $row["prod_image"] . '" alt="Product">';
                            } else {
                                echo '<img src="../../upload_prodImg/no_available.jpg" alt="No Image">';
                            }
                            echo '</a>';
                        } else if (!empty($row["prod_image"])) {
                            echo '<img src="../../upload_prodImg/' . $row["prod_image"] . '" alt="Product">';
                        } else {
                            echo '<img src="../../upload_prodImg/no_available.jpg" alt="No Image">';
                        }
                        
                        echo '</div>';
                        echo '<div class="description">';
                        echo '<p>' . $row["prod_name"] . '</p>';
                        echo '<p>Price: ₱ ' . $row["prod_currprice"] . '</p>';
                        
                        if ($row["prod_stocks"] > 0) {
                            echo '<p>Stocks: ' . $row["prod_stocks"] . '</p>';
                        } else {
                            echo '<p>Out of stocks</p>';
                        }
                        
                        echo '</div>';
                        echo '</div>';
                    }

                    echo '</div>'; 

                    // Close your database connection here
                }
            ?>

            
        </div>