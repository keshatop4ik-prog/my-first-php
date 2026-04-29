<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>MixUp — Absolute Cinema Software</title>
    <style>
        :root {
            --bg: #0b0b1a;
            --accent: #7b61ff;
            --cyan: #00d1ff;
            --glass: rgba(255, 255, 255, 0.05);
            --gradient: linear-gradient(135deg, #7b61ff 0%, #00d1ff 100%);
        }

        body { background-color: var(--bg); color: #e0e0e0; font-family: 'Segoe UI', sans-serif; margin: 0; text-align: center; }

        /* ОНОВЛЕНО: ФОНОВЕ ЗОБРАЖЕННЯ */
        .bg-overlay {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: -1;
            background: url('img/background.png?v=5') center/cover no-repeat !important;
        }

        header {
            display: flex; justify-content: space-between; align-items: center;
            padding: 15px 40px; background: rgba(11, 11, 26, 0.9);
            border-bottom: 1px solid rgba(123, 97, 255, 0.2);
            backdrop-filter: blur(20px); position: sticky; top: 0; z-index: 1000;
        }
        /* СТИЛЬ КНОПОК НАВІГАЦІЇ */
        nav a {
            color: #a0a0b0;
            text-decoration: none;
            margin: 0 15px;
            font-weight: 700;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            padding: 8px 16px;
            border-radius: 12px;
            transition: 0.4s;
            position: relative;
            border: 1px solid transparent; /* Щоб при наведенні не "стрибало" */
        }

        /* ЕФЕКТ ПРИ НАВЕДЕННІ */
        nav a:hover {
            color: #fff;
            background: rgba(123, 97, 255, 0.1); /* Легкий фіолетовий фон */
            border-color: rgba(123, 97, 255, 0.3);
            box-shadow: 0 0 15px rgba(123, 97, 255, 0.2);
            transform: translateY(-2px);
        }

        /* АКТИВНА КНОПКА (можна додати в HTML пізніше) */
        nav a.active {
            color: var(--cyan);
            border-color: var(--cyan);
            background: rgba(0, 209, 255, 0.05);
        }
        /* ОНОВЛЕНО: СТИЛЬ ЛОГОТИПА ЗЛІВА */
        .brand-logo {
            display: flex;
            align-items: center;
            font-size: 22px;
            font-weight: 800;
            color: #fff;
            text-shadow: 0 0 10px var(--accent);
            text-decoration: none;
        }

        .brand-logo img {
            height: 50px;
            width: auto;
            margin-right: 12px;
            filter: drop-shadow(0 0 5px var(--accent));
            transition: 0.3s ease-in-out;
        }

        .brand-logo:hover img {
            transform: scale(1.1) rotate(-5deg);
            filter: drop-shadow(0 0 10px var(--cyan));
        }

        /* ОСНОВНИЙ СТИЛЬ ТЕГУ */
        .prod-tag {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: var(--cyan);
            font-weight: 800;
            background: rgba(0, 209, 255, 0.05);
            padding: 6px 15px;
            border-radius: 50px;
            border: 1px solid rgba(0, 209, 255, 0.2);
            box-shadow: 0 0 10px rgba(0, 209, 255, 0.1);
            transition: 0.4s; /* Це важливо для плавності */
            cursor: pointer;
        }

        /* ДОДАЙ ЦЕЙ БЛОК НИЖЧЕ */
        .prod-tag:hover {
            background: rgba(0, 209, 255, 0.2);
            border-color: var(--cyan);
            box-shadow: 0 0 20px rgba(0, 209, 255, 0.5);
            transform: translateY(-2px); /* Трохи піднімається при наведенні */
            color: #fff;
        }

        /* ОНОВЛЕНО: HERO БЛОК З ЛОГОТИПОМ ПОСЕРЕДИНІ */
        .hero {
            padding: 60px 20px 20px; /* Зменшили верхній відступ з 100px до 60px */
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .hero-content {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* ОНОВЛЕНЕ ЛОГО ПОСЕРЕДИНІ */
        .hero-img {
            height: 200px;  /* Збільшили розмір */
            width: auto;
            margin-bottom: 15px;
            filter: drop-shadow(0 0 25px var(--accent));
            /* Додаємо анімацію пульсації */
            animation: logoPulse 4s infinite ease-in-out;
            transition: 0.5s;
        }

        /* Ефект при наведенні курсору */
        .hero-img:hover {
            transform: scale(1.1) translateY(-10px);
            filter: drop-shadow(0 0 40px var(--cyan));
        }

        /* Анімація світіння */
        @keyframes logoPulse {
            0%, 100% { filter: drop-shadow(0 0 20px var(--accent)); transform: translateY(0); }
            50% { filter: drop-shadow(0 0 45px var(--cyan)); transform: translateY(-10px); }
        }

        .hero h1 {
            font-size: 75px; /* Трохи збільшили заголовок */
            color: #fff;
            margin: 0;
            text-shadow: 0 0 30px rgba(123, 97, 255, 0.5);
            letter-spacing: -2px; /* Робимо шрифт більш сучасним */
        }

        /* ПІДПИС ПІД ЛОГО */
        .hero p {
            background: linear-gradient(to right, var(--accent), var(--cyan));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: bold;
            letter-spacing: 6px;
            margin-top: 10px;
        }

        /* БЛОК ПОШУКУ */
        .group-box {
            background: rgba(10, 10, 30, 0.7);
            max-width: 650px;
            margin: 20px auto 50px; /* Змінили від’ємний margin на позитивний 20px */
            padding: 45px;
            border-radius: 40px;
            border: 1px solid rgba(123, 97, 255, 0.3);
            backdrop-filter: blur(15px);
            box-shadow: 0 25px 50px rgba(0,0,0,0.5);
        }

        .search-input {
            padding: 18px 30px; width: 80%; border-radius: 50px;
            border: 2px solid var(--accent); background: rgba(0, 0, 0, 0.5);
            color: white; font-size: 16px; outline: none;
            transition: 0.3s;
        }
        .search-input:focus { border-color: var(--cyan); box-shadow: 0 0 15px rgba(0, 209, 255, 0.3); }

        .btn-start {
            display: inline-block; background: var(--gradient);
            color: white; padding: 16px 50px; border-radius: 50px;
            text-decoration: none; font-weight: bold; margin-top: 35px;
            border: none; cursor: pointer; transition: 0.4s;
        }
        .btn-start:hover { transform: scale(1.05); box-shadow: 0 0 20px var(--cyan); }
    </style>
</head>
<body>
<div class="bg-overlay"></div>

<header>
    <a href="index.php" class="brand-logo">
        <img src="img/mixup.png?v=3" alt="Logo">
        <span>MixUp</span>
    </a>
    <nav>
        <a href="index.php">Головна</a>
        <a href="category.php?cat=Алкогольні">Алкогольні</a>
        <a href="category.php?cat=Безалкогольні">Безалкогольні</a>
    </nav>
    <div class="prod-tag">ФЕС-11 Production</div>
</header>

<div class="hero">
    <div class="hero-content">
        <img src="img/mixup.png?v=3" class="hero-img" alt="Main Logo">
        <h1>MixUp</h1>
    </div>
    <p style="color: var(--accent); letter-spacing: 5px; text-transform: uppercase; font-weight: bold;">Absolute Cinema Software</p>
</div>

<div class="group-box">
    <h2 style="margin-bottom: 30px; font-size: 32px; color: #fff;">Пошук Коктейлів</h2>
    <form action="category.php" method="GET">
        <input type="text" name="search" class="search-input" placeholder="Пошук у вашій базі..." required>
        <button type="submit" class="btn-start">Шукати коктейль</button>
    </form>
</div>
</body>
</html>