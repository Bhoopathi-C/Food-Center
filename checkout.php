<?php
include 'db_connection.php'; // Include the database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cart = $_POST['cart'];
    $totalAmount = 0;

    // Insert payment record
    $user_id = 1; // Replace with the actual user ID
    $transaction_id = uniqid('TRANS_');
    $payment_status = 'pending';

    foreach ($cart as $item) {
        $totalAmount += $item['price'] * $item['quantity'];
    }

    $sql = "INSERT INTO Payment (user_id, amount, transaction_id, payment_status)
            VALUES ('$user_id', '$totalAmount', '$transaction_id', '$payment_status')";

    if ($conn->query($sql) !== TRUE) {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="css/style7.css"/>
</head>
<body>
    <div class="nav">
        <div class="logo"><h1>Food <b>Centre</b></h1></div>
        <ul>
            <li><a href="menu.php">Menu |</a></li>
        </ul>
    </div>
    <center>
    <div class="container">
        <header>
            <h2>Checkout</h2>
        </header>
        <div class="checkout-details">
            <h2>Items in your cart:</h2>
    <ul>
        <?php
        foreach ($cart as $item) {
            echo "<li>{$item['name']} (x{$item['quantity']}) - $" . number_format($item['price'], 2) . "</li>";
        }
        ?>
    </ul>
    <h3>Total Amount: $<?php echo number_format($totalAmount, 2); ?></h3>
            <img src="images/IMG-20240527-WA0000.jpg" alt="QR Code" width="400"> <!-- Replace with the path to your QR code image -->
            <p>Scan the QR code to make the payment using your preferred payment app.</p>
        </div>
    </div>
    </center> 

    <script>
        /* Get the total amount from the URL parameters
        const urlParams = new URLSearchParams(window.location.search);
        const totalAmount = urlParams.get('total');

        // Display the total amount on the checkout page
        document.getElementById('totalAmount').innerText = totalAmount;

        document.getElementById('completePurchase').addEventListener('click', () => {
            alert('Purchase Completed!');
        }); */
        function checkout() {
    let cartItems = listCards.filter(item => item != null);
    let form = document.createElement('form');
    form.method = 'POST';
    form.action = 'checkout.php';
    
    cartItems.forEach((item, index) => {
        let input = document.createElement('input');
        input.type = 'hidden';
        input.name = `cart[${index}][id]`;
        input.value = item.id;
        form.appendChild(input);

        input = document.createElement('input');
        input.type = 'hidden';
        input.name = `cart[${index}][name]`;
        input.value = item.name;
        form.appendChild(input);

        input = document.createElement('input');
        input.type = 'hidden';
        input.name = `cart[${index}][quantity]`;
        input.value = item.quantity;
        form.appendChild(input);

        input = document.createElement('input');
        input.type = 'hidden';
        input.name = `cart[${index}][price]`;
        input.value = item.price;
        form.appendChild(input);
    });

    document.body.appendChild(form);
    form.submit();
}

// Add a checkout button to trigger the checkout function
document.querySelector('.checkout .closeShopping').innerHTML = '<button onclick="checkout()">Checkout</button>';

    </script>
</body>
</html>
