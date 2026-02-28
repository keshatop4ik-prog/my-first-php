<?php
$name = "Розробнику"; // Ваша перша змінна
$time = date("H:i"); // Отримуємо поточний час сервера
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Мій перший PHP сайт</title>
    <style>
        body { font-family: sans-serif; background-color: #f4f4f4; text-align: center; padding-top: 50px; }
        .card { background: white; padding: 20px; border-radius: 10px; display: inline-block; shadow: 0 4px 8px rgba(0,0,0,0.1); }
        h1 { color: #333; }
    </style>
</head>
<body>
<div class="card">
    <h1>Salam Aleykum, <?php echo $name; ?>! 👋</h1>
    <p>Зараз на сервері: <strong><?php echo $time; ?></strong></p>
    <p>Це ваш перший динамічний контент.</p>
</div>
</body>
</html>