<?php
include_once "../classes/Product.php";

$product = new Product;
$product->deleteProduct($_GET['id']);

?>