<?php
include 'db.php';
$type = isset($_GET['type']) ? $_GET['type'] : 'Слабоалкогольні';
// Захист від помилок у запиті
$safe_type = $conn->real_escape_string($type);
$sql = "SELECT * FROM cocktails WHERE category = '$safe_type'";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>MixUp — <?php echo htmlspecialchars($type); ?></title>
    <style>
        body { background-color: #051612; color: white; font-family: sans-serif; margin: 0; padding: 0; text-align: center; }
        nav { background: #0a2a22; padding: 20px; border-bottom: 1px solid #1a4a3e; }
        nav a { color: #2ecc71; text-decoration: none; font-weight: bold; margin: 0 15px; }

        .container { max-width: 1100px; margin: 40px auto; padding: 0 20px; }
        h1 { color: #2ecc71; font-size: 32px; margin-bottom: 40px; }

        .grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 30px; }
        .card { background: #0a2a22; border-radius: 20px; border: 1px solid #1a4a3e; padding: 15px; text-decoration: none; color: white; transition: 0.3s; }
        .card:hover { border-color: #2ecc71; transform: scale(1.03); box-shadow: 0 10px 30px rgba(0,0,0,0.4); }
        .card img { width: 100%; aspect-ratio: 1/1; object-fit: cover; border-radius: 15px; }
        .card h2 { font-size: 20px; margin-top: 15px; color: #2ecc71; }
    </style>
</head>
<body>

<nav>
    <a href="index.php">Головна</a>
    <a href="category.php?type=Слабоалкогольні">Слабоалкогольні</a>
    <a href="category.php?type=Міцний Алкоголь">Міцний Алкоголь</a>
    <a href="category.php?type=Безалкогольні">Безалкогольні</a>
</nav>

<div class="container">
    <h1>Розділ: <?php echo htmlspecialchars($type); ?></h1>

    <div class="grid">
        <?php if ($result && $result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <a href="details.php?id=<?php echo $row['id']; ?>" class="card">
                    <img src="img/<?php echo $row['photo']; ?>" alt="photo">
                    <h2><?php echo htmlspecialchars($row['name']); ?></h2>
                </a>
            <?php endwhile; ?>
        <?php else: ?>
            <div style="grid-column: 1/-1; padding: 50px; background: #0a2a22; border-radius: 20px;">
                <p style="color: #888; font-size: 18px;">У цій категорії поки немає записів. Додайте їх через базу даних.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

</body>
</html>