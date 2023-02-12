<?php
include_once "../classes/Product.php";
// avoid including again later

if(isset($_POST['add_product'])){
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    $product = new Product;
    $product->addProduct($product_name, $price, $quantity);

}elseif(isset($_POST['edit_product'])){
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    $product = new Product;
    $product->updateProduct($product_name, $price, $quantity, $product_id);

}elseif(isset($_POST['pay_product'])){
    $product_id = $_POST['product_id'];
    $new_quantity = $_POST['new_quantity'];

    $product = new Product;
    $product->payProduct($product_id, $new_quantity);
}
?>