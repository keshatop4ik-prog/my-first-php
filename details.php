<?php
include 'db.php';
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$sql = "SELECT * FROM cocktails WHERE id = $id";
$result = $conn->query($sql);
$cocktail = $result->fetch_assoc();

if (!$cocktail) { header("Location: index.php"); exit(); }
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($cocktail['name']); ?></title>
    <style>
        body { background-color: #051612; color: white; font-family: 'Segoe UI', sans-serif; margin: 0; padding: 0; }
        nav { background: #0a2a22; padding: 20px; border-bottom: 1px solid #1a4a3e; text-align: center; }
        nav a { color: #2ecc71; text-decoration: none; font-weight: bold; margin: 0 15px; }

        .container { max-width: 700px; margin: 50px auto; padding: 0 20px; text-align: center; }
        .main-photo { width: 100%; max-width: 500px; border-radius: 30px; box-shadow: 0 20px 50px rgba(0,0,0,0.7); }
        h1 { color: #2ecc71; font-size: 42px; margin: 30px 0 10px; }
        .category-tag { color: #a0d468; font-style: italic; font-size: 18px; margin-bottom: 40px; display: block; }

        .info-card { background: #0a2a22; padding: 40px; border-radius: 25px; text-align: left; border: 1px solid #1a4a3e; }
        .section-title { color: #2ecc71; font-weight: bold; display: block; margin-top: 25px; font-size: 20px; border-left: 4px solid #2ecc71; padding-left: 15px; }
        p { line-height: 1.8; color: #ddd; font-size: 17px; }
        .back-btn { display: inline-block; margin-top: 40px; color: #888; text-decoration: none; transition: 0.3s; }
        .back-btn:hover { color: #2ecc71; }
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
    <img src="img/<?php echo $cocktail['photo']; ?>" alt="photo" class="main-photo">
    <h1><?php echo htmlspecialchars($cocktail['name']); ?></h1>
    <span class="category-tag"><?php echo htmlspecialchars($cocktail['category']); ?></span>

    <div class="info-card">
        <span class="section-title">Інгредієнти</span>
        <p><?php echo nl2br(htmlspecialchars($cocktail['ingredients'])); ?></p>

        <span class="section-title">Опис та приготування</span>
        <p><?php echo nl2br(htmlspecialchars($cocktail['description'])); ?></p>

        <span class="section-title">Історія виникнення</span>
        <p><?php echo nl2br(htmlspecialchars($cocktail['history'])); ?></p>
    </div>

    <a href="javascript:history.back()" class="back-btn">← Повернутися назад</a>
</div>

</body>
</html>