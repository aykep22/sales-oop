<?php
require_once "Database.php";

class Product extends Database{
    public function addProduct($product_name, $price, $quantity){
        $sql = "INSERT INTO `products` (`product_name`, `price`, `quantity`) VALUES ('$product_name', '$price', '$quantity')";

        if($this->conn->query($sql)){
            header("location: ../views/dashboard.php");
        }else{
            die("Error adding product: " . $this->conn->error);
        }
    }

    public function displayProducts(){
        $sql = "SELECT * FROM products";

        if($result = $this->conn->query($sql)){
            return $result;
        }else{
            die("Error getting all products: " . $this->conn->error);
        }
    }

    public function getProduct($product_id){
        $sql = "SELECT `id`, `product_name`, `price`, `quantity` FROM products WHERE `id` = $product_id";

        if($result = $this->conn->query($sql)){
            return $result->fetch_assoc();
        }else{
            die("Error getting a product: " . $this->conn->error);
        }
    }

    public function updateProduct($product_name, $price, $quantity, $product_id){
        $sql = "UPDATE products SET `product_name` = '$product_name', `price` = '$price', `quantity` = '$quantity' WHERE `id` = $product_id";

        if($this->conn->query($sql)){
            header("location: ../views/dashboard.php");
            exit;
        }else{
            die("Error updating product: " . $this->conn->error);
        }
    }

    public function deleteProduct($product_id){
        $sql = "DELETE FROM products WHERE `id` = $product_id";

        if($this->conn->query($sql)){
            header("location: ../views/dashboard.php");
            exit; 
        }else{
            die("Error deleting product: " . $this->conn->error);
        }
    }

    public function payProduct($product_id, $new_quantity){
        $sql = "UPDATE products SET `quantity` = $new_quantity WHERE `id` = $product_id";

        if($this->conn->query($sql)){
            header("location: ../views/dashboard.php");
            exit;
        }else{
            die("Error paying product: " . $this->conn->error);
        }
    }
}
?>