<?php
session_start();

if(empty($_SESSION)){
    header("location: ../views/");
    exit;
}

include_once "../classes/Product.php";

$product = new Product;
$product_details = $product->getProduct($_GET['id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buy Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white justify-content-between">
        <a href="dashboard.php" class="ms-3" title="Home">
            <i class="fa-solid fa-house fa-2x text-dark"></i>
        </a>

        <a href="profile.php" class="nav-link text-secondary">
            <span class="fw-bold fs-5">Welcome, <?= ucfirst($_SESSION['username'])?></span>
        </a>

        <!-- <div class="ms-auto me-3 navbar-nav"> -->
            <a href="../actions/logout.php" class="me-3" title="Logout"><i class="fa-solid fa-user-xmark fa-2x text-danger"></i></a>
        <!-- </div> -->
    </nav>

    <main class="container mt-5">
        <div class="card w-75 mx-auto">
            <div class="card-header bg-success text-white">
                <h1 class="display-6 fw-bold">Buy Product</h1>
            </div>
            <div class="card-body">
                <form action="" method="post" class="w-75 mx-auto pt-4 p-5">
                    <input type="hidden" name="product_id" value="<?= $product_details['id'] ?>">

                    <p>Product Name: <?= $product_details['product_name'] ?></p>
                    <p>Price per product: $<?= $product_details['price'] ?></p>                        

                    <div class="row mb-3">
                        <label for="quantity" class="form-label small text-secondary">Quantity (Up to <?= $product_details['quantity'] ?>)</label>
                        <input type="number" name="quantity" id="quantity" class="form-control" max="<?= $product_details['quantity'] ?>">
                    </div>
                    
                    <div class="row">
                        <div class="col-md">
                            <button type="submit" class="btn btn-success w-100" name="confirm_quantity">Confirm quantity</button>
                        </div>
                    </div>
                </form>
                    
                    <?php
                    if(isset($_POST['confirm_quantity'])){
                        $product_id = $_POST['product_id'];
                        $buy_quantity = $_POST['quantity'];
                        $new_quantity = $product_details['quantity'] - $buy_quantity; 
                        $pay_price = $buy_quantity * $product_details['price'];

                        echo "<div><form action='../actions/product-actions.php' method='post' class='w-75 mx-auto pt-4 p-5'>";
                        echo "<p>Quantity: $buy_quantity</p>";
                        echo "<input type='hidden' name='product_id' value='$product_id'>";
                        echo "<input type='hidden' name='new_quantity' value='$new_quantity'>";
                        echo "<label for='pay-price' class='form-label small text-secondary'>Pay ($$pay_price)</label>";
                        echo "<div class='input-group mb-3'>";
                        echo "<span class='input-group-text' id='price-tag'>$</span><input type='number' name='pay_price' id='pay_price' class='form-control' aria-label='Price' aria-describedby='price-tag' min='$pay_price' max='$pay_price'></div>";
                        echo "<div class='row'><div class='col-md'>";
                        echo "<button type='submit' class='btn btn-success w-100' name='pay_product'>Pay</button></div></div></form></div>";
                    }
                    ?>

                    
            </div>
        </div>
    </main>

    
</body>
</html>