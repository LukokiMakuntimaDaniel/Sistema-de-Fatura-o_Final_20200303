<?php
class ProductCRUD {
    private $connection;

    // Constructor to initialize database connection
    public function __construct(DatabaseConnection $dbConnection) {
        $this->connection = $dbConnection->getConnection();
    }

    // Create a new product record
    public function create(Product $product) {
        $stmt = mysqli_prepare($this->connection, "INSERT INTO products (productName, description, prince, amount, category, image) VALUES (?, ?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "ssdiss", 
            $product->getProductName(),
            $product->getDescription(),
            $product->getPrice(),
            $product->getAmount(),
            $product->getCategory(),
            $product->getImage()
        );
        if (mysqli_stmt_execute($stmt)) {
            $productId = mysqli_insert_id($this->connection);
            mysqli_stmt_close($stmt);
            return $productId;
        } else {
            mysqli_stmt_close($stmt);
            return false;
        }
    }

    // Read a product record by ID
    public function read($productId) {
        $stmt = mysqli_prepare($this->connection, "SELECT productId, productName, description, price, amount, category, image FROM products WHERE productId = ?");
        mysqli_stmt_bind_param($stmt, "i", $productId);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $productId, $productName, $description, $price, $amount, $category, $image);

        if (mysqli_stmt_fetch($stmt)) {
            $product = new Product($productName, $description, $price, $amount, $category, $image);
            $reflection = new ReflectionClass($product);
            $property = $reflection->getProperty('productId');
            $property->setAccessible(true);
            $property->setValue($product, $productId);
            mysqli_stmt_close($stmt);
            return $product;
        } else {
            mysqli_stmt_close($stmt);
            return null;
        }
    }

    // Update a product record
    public function update(Product $product) {
        $stmt = mysqli_prepare($this->connection, "UPDATE products SET productName = ?, description = ?, price = ?, amount = ?, category = ?, image = ? WHERE productId = ?");
        mysqli_stmt_bind_param($stmt, "ssdiissi", 
            $product->getProductName(),
            $product->getDescription(),
            $product->getPrice(),
            $product->getAmount(),
            $product->getCategory(),
            $product->getImage(),
            $product->getProductId()
        );

        $result = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return $result;
    }

    // Delete a product record by ID
    public function delete($productId) {
        $stmt = mysqli_prepare($this->connection, "DELETE FROM products WHERE productId = ?");
        mysqli_stmt_bind_param($stmt, "i", $productId);

        $result = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return $result;
    }
}
?>
