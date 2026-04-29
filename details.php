<?php
include 'db.php';
$id = (int)($_GET['id'] ?? 0);
$sql = "SELECT * FROM cocktails WHERE id = $id";
$result = $conn->query($sql);
$cocktail = $result->fetch_assoc();

if (!$cocktail) { header("Location: index.php"); exit(); }
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title><?php echo $cocktail['name']; ?> — Деталі</title>
    <style>
        :root { --bg: #0b0b1a; --accent: #7b61ff; --cyan: #00d1ff; --glass: rgba(255, 255, 255, 0.05); }
        body { background: var(--bg); color: #e0e0e0; font-family: 'Segoe UI', sans-serif; margin: 0; padding-bottom: 60px; }
        header { display: flex; justify-content: space-between; align-items: center; padding: 15px 40px; background: rgba(11, 11, 26, 0.85); border-bottom: 1px solid rgba(123, 97, 255, 0.2); backdrop-filter: blur(20px); }
        .brand-logo { font-size: 22px; font-weight: 800; color: #fff; text-shadow: 0 0 10px var(--accent); text-decoration: none; }
        .container { max-width: 800px; margin: 50px auto; padding: 0 20px; text-align: center; }
        .main-photo { width: 100%; max-width: 500px; border-radius: 40px; border: 1px solid rgba(255, 255, 255, 0.1); box-shadow: 0 0 40px rgba(123, 97, 255, 0.4); }
        .info-card { background: var(--glass); padding: 50px; border-radius: 40px; text-align: left; margin-top: 30px; border: 1px solid rgba(255, 255, 255, 0.1); backdrop-filter: blur(20px); }
        .label { color: var(--cyan); font-weight: bold; display: block; margin-top: 35px; font-size: 20px; text-transform: uppercase; border-left: 4px solid var(--accent); padding-left: 15px; }
        p { line-height: 1.8; color: #ccc; font-size: 18px; margin-top: 15px; }
    </style>
</head>
<body>
<header>
    <a href="index.php" class="brand-logo">MixUp 🍸</a>
    <div style="color: var(--cyan); font-size: 12px; font-weight: bold;">ФЕС-11 Production</div>
</header>

<div class="container">
    <img src="img/<?php echo $cocktail['photo']; ?>" class="main-photo" alt="Photo">
    <h1 style="color: #fff; font-size: 48px; margin: 30px 0; text-shadow: 0 0 20px var(--accent);"><?php echo $cocktail['name']; ?></h1>

    <div class="info-card">
        <span class="label">Складники</span>
        <p><?php echo nl2br(htmlspecialchars($cocktail['ingredients'])); ?></p>

        <span class="label">Приготування</span>
        <p><?php echo nl2br(htmlspecialchars($cocktail['description'])); ?></p>

        <span class="label">Історія</span>
        <p><?php echo nl2br(htmlspecialchars($cocktail['history'])); ?></p>
    </div>

    <a href="javascript:history.back()" style="display: block; margin-top: 50px; color: #888; text-decoration: none; font-size: 12px; letter-spacing: 2px;">← НАЗАД ДО СПИСКУ</a>
</div>
</body>
</html>