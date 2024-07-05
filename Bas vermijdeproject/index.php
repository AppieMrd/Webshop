<?php
include "db.php";

// dit is voor de database, appie dit haalt zegma producten uit de db.
$stmt = $pdo->query('SELECT * FROM products');
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Je zet product in een winkelwagen 
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] == 'add_to_cart') {
    $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
    $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;

    if ($product_id > 0) {
        // Hier controleren ze of het product bestaat
        foreach ($products as $product) {
            if ($product['id'] === $product_id) {
                // Hier word die toegevoegd aan de winkelwagen
                $cart_item = [
                    'id' => $product['id'],
                    'name' => $product['name'],
                    'price' => $product['price'],
                    'quantity' => $quantity
                ];

                // Hier word de winkelwagen zegmaar opgeslagen voor de sessie 
                if (!isset($_SESSION['cart'])) {
                    $_SESSION['cart'] = [];
                }
                $_SESSION['cart'][$product_id] = $cart_item;
                break;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BAS</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Welkom bij de dirk</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="cart.php">Winkelwagen (<span id="cart-count"><?php echo count($_SESSION['cart'] ?? []); ?></span>)</a></li>
            </ul>
        </nav>
    </header>
    <main class="container">
        <section class="products">
            <?php foreach ($products as $product): ?>
                <article class="product">
                    <h2><?php echo htmlspecialchars($product['name']); ?></h2>
                    <img src="<?php echo $product['image']; ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                    <p><?php echo htmlspecialchars($product['description']); ?></p>
                    <p>Prijs: &euro;<?php echo number_format($product['price'], 2); ?></p>
                    <form action="index.php" method="post">
                        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                        <label for="quantity">Aantal:</label>
                        <input type="number" id="quantity" name="quantity" value="1" min="1">
                        <button type="submit" name="action" value="add_to_cart" class="btn">Toevoegen aan winkelwagen</button>
                    </form>
                </article>
            <?php endforeach; ?>
        </section>
    </main>
</body>
</html>
