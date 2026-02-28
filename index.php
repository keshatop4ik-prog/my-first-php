<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>MixUp — Absolute Cinema Software</title>
    <style>
        body { background-color: #051612; color: white; font-family: 'Segoe UI', sans-serif; margin: 0; padding: 0; text-align: center; }
        nav { background: #0a2a22; padding: 20px; border-bottom: 1px solid #1a4a3e; position: sticky; top: 0; z-index: 1000; }
        nav a { color: #2ecc71; text-decoration: none; font-weight: bold; margin: 0 15px; transition: 0.3s; }
        nav a:hover { color: #a0d468; }

        .hero { padding: 80px 20px; background: linear-gradient(180deg, #0a2a22 0%, #051612 100%); }
        .hero h1 { font-size: 55px; color: #2ecc71; margin-bottom: 10px; letter-spacing: 2px; }
        .hero p { font-size: 22px; color: #a0d468; opacity: 0.8; }

        .group-box {
            background: rgba(10, 42, 34, 0.8);
            max-width: 650px;
            margin: -40px auto 60px;
            padding: 50px;
            border-radius: 30px;
            border: 1px solid #1a4a3e;
            box-shadow: 0 15px 50px rgba(0,0,0,0.6);
            backdrop-filter: blur(10px);
        }
        .team-name { font-size: 28px; color: #fff; font-weight: bold; margin: 10px 0; display: block; }
        .subject { color: #2ecc71; font-size: 18px; text-transform: uppercase; letter-spacing: 1px; }

        .btn-start {
            display: inline-block;
            background: #2ecc71;
            color: #051612;
            padding: 18px 50px;
            border-radius: 35px;
            text-decoration: none;
            font-weight: bold;
            margin-top: 30px;
            font-size: 18px;
            transition: 0.3s;
        }
        .btn-start:hover { background: #a0d468; transform: translateY(-3px); box-shadow: 0 5px 20px rgba(46, 204, 113, 0.4); }
    </style>
</head>
<body>

<nav>
    <a href="index.php">Головна</a>
    <a href="category.php?type=Слабоалкогольні">Слабоалкогольні</a>
    <a href="category.php?type=Міцний Алкоголь">Міцний Алкоголь</a>
    <a href="category.php?type=Безалкогольні">Безалкогольні</a>
</nav>

<div class="hero">
    <h1>MixUp🍸</h1>
    <p>Марта Одна Надія На вас</p>
</div>

<div class="group-box">
    <span class="subject">Дисципліна: Інженерія програмного забезпечення</span>
    <h2 style="margin: 20px 0 10px 0;">Курсовий проєкт</h2>
    <p style="color: #888;">Розробку виконала команда:</p>
    <span class="team-name">Absolute Cinema Software</span>

    <hr style="border: 0; border-top: 1px solid #1a4a3e; margin: 30px 0;">

    <a href="category.php?type=Слабоалкогольні" class="btn-start">Перейти до списку</a>
</div>

</body>
</html>