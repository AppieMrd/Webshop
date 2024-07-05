<?php
include "db.php";

//Dit zijn allemaal voor de cart. En de html voor de winkelwagen kan je zegmaar zien wat erin zit etc.

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] == 'remove_from_cart') {
    $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
    if ($product_id > 0 && isset($_SESSION['cart'][$product_id])) {
        unset($_SESSION['cart'][$product_id]);
    }
}


$total = 0.00;
foreach ($_SESSION['cart'] as $item) {
    $total += ($item['price'] * $item['quantity']);
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Winkelwagen</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Uw Winkelwagen</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="cart.php">Winkelwagen (<span id="cart-count"><?php echo count($_SESSION['cart']); ?></span>)</a></li>
            </ul>
        </nav>
    </header>
    <main class="container">
        <section class="cart">
            <?php if (!empty($_SESSION['cart'])): ?>
                <?php foreach ($_SESSION['cart'] as $product_id => $item): ?>
                    <article class="cart-item">
                        <h3><?php echo htmlspecialchars($item['name']); ?></h3>
                        <p>Prijs: &euro;<?php echo number_format($item['price'], 2); ?></p>
                        <p>Aantal: <?php echo $item['quantity']; ?></p>
                        <p>Totaal: &euro;<?php echo number_format($item['price'] * $item['quantity'], 2); ?></p>
                        <form action="cart.php" method="post">
                            <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                            <button type="submit" name="action" value="remove_from_cart" class="btn">Verwijderen</button>
                        </form>
                    </article>
                <?php endforeach; ?>
                <div class="cart-total">
                    <h3>Totaalbedrag: &euro;<?php echo number_format($total, 2); ?></h3>
                </div>
            <?php else: ?>
                <p>Uw winkelwagen is leeg.</p>
            <?php endif; ?>
        </section>
    </main>
</body>
</html>
