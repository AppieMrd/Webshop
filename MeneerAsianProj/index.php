<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sportwinkel</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <h1>Sportwinkel</h1>
    <nav>
        <a href="index.php">Home</a>
        <a href="cart.php">Winkelwagentje</a>
        <a href="#" id="cart-link">Winkelwagen (<span id="cart-count">0</span>)</a>
    </nav>
</header>

<section class="products">
    <h2>Onze producten</h2>
    <div class="product">
        <img src="images/voetbal.jpg" alt="Voetbal">
        <h3>Voetbal</h3>
        <p>Prijs: €25</p>
        <button onclick="addToCart('Voetbal', 25)">Toevoegen aan winkelwagentje</button>
    </div>
    <div class="product">
        <img src="images/basketbal.jpg" alt="Basketbal">
        <h3>Basketbal</h3>
        <p>Prijs: €30</p>
        <button onclick="addToCart('Basketbal', 30)">Toevoegen aan winkelwagentje</button>
    </div>
</section>

<div id="cart-modal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Winkelwagen</h2>
        <ul id="cart-items"></ul>
        <p>Totaal: €<span id="total-price">0</span></p>
    </div>
</div>

<script src="script.js"></script>
</body>
</html>

<?php 
include 'db.php'; // Make sure db.php handles connection details securely
?>