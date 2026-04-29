<?php
include 'db.php';
session_start();

$cat = $_GET['cat'] ?? '';
$search = $_GET['search'] ?? '';

// 1. ЛОГІКА СТАБІЛЬНОГО "КОКТЕЙЛЮ ДНЯ" (15 ХВИЛИН)
$interval = 900; // Рівно 15 хвилин

if (!isset($_SESSION['daily_cocktail']) || !isset($_SESSION['last_update']) || (time() - $_SESSION['last_update']) > $interval) {
    $sql_random = "SELECT * FROM cocktails ORDER BY RAND() LIMIT 1";
    $res_random = $conn->query($sql_random);

    if ($res_random && $res_random->num_rows > 0) {
        $_SESSION['daily_cocktail'] = $res_random->fetch_assoc();
        $_SESSION['last_update'] = time();
    }
}
$daily = $_SESSION['daily_cocktail'];

// 2. ЛОГІКА КАТЕГОРІЙ (Розділяємо назву на дві частини)
if (!empty($search)) {
    $p1 = "Результати: ";
    $p2 = htmlspecialchars($search);
} elseif ($cat == 'Алкогольні') {
    $p1 = "Алкогольні ";
    $p2 = "коктейлі";
    $sql = "SELECT * FROM cocktails WHERE category = 'Алкогольні' OR category = 'С' OR category = 'Слабоалкогольні'";
} elseif ($cat == 'Безалкогольні') {
    $p1 = "Безалкогольні ";
    $p2 = "коктейлі";
    $sql = "SELECT * FROM cocktails WHERE category = 'Безалкогольні' OR category = 'Без'";
} else {
    $p1 = $cat ?: "Каталог ";
    $p2 = "рецептів";
    $sql = "SELECT * FROM cocktails" . ($cat ? " WHERE category = '" . $conn->real_escape_string($cat) . "'" : "");
}

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title><?php echo $p1 . $p2; ?> — MixUp Pro</title>
    <style>
        :root {
            --bg: #0b0b1a;
            --accent: #7b61ff;
            --cyan: #00d1ff;
            --glass: rgba(255, 255, 255, 0.05);
            --card-bg: #00343E;
            --gradient: linear-gradient(135deg, #7b61ff 0%, #00d1ff 100%);
        }

        body { background: var(--bg); color: white; font-family: 'Segoe UI', sans-serif; margin: 0; padding-bottom: 50px; }

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

        .brand-logo {
            display: flex; align-items: center; font-size: 22px; font-weight: 800;
            color: #fff; text-shadow: 0 0 10px var(--accent); text-decoration: none;
        }

        .brand-logo img {
            height: 40px; width: auto; margin-right: 12px;
            filter: drop-shadow(0 0 5px var(--accent)); transition: 0.3s;
        }

        .brand-logo:hover img { transform: scale(1.1); filter: drop-shadow(0 0 10px var(--cyan)); }

        nav a {
            color: #a0a0b0; text-decoration: none; margin: 0 15px; font-weight: 700;
            font-size: 12px; text-transform: uppercase; letter-spacing: 1.5px;
            padding: 8px 16px; border-radius: 12px; transition: 0.4s; position: relative;
            border: 1px solid transparent;
        }

        nav a:hover {
            color: #fff; background: rgba(123, 97, 255, 0.1); border-color: rgba(123, 97, 255, 0.3);
            box-shadow: 0 0 15px rgba(123, 97, 255, 0.2); transform: translateY(-2px);
        }

        nav a.active {
            color: var(--cyan); border-color: rgba(0, 209, 255, 0.3);
            background: rgba(0, 209, 255, 0.05); box-shadow: 0 0 15px rgba(0, 209, 255, 0.1);
        }

        .container { max-width: 1200px; margin: 0 auto; padding: 0 20px; }

        /* --- НОВИЙ СТИЛЬ ЗАГОЛОВКА --- */
        .title-wrapper { text-align: center; margin-top: 60px; margin-bottom: 40px; }

        .main-title {
            font-size: 42px; /* Чуть менше, щоб виглядало акуратніше */
            font-weight: 700;
            color: #fff; /* Колір першої частини */
            text-transform: uppercase;
            letter-spacing: -1px;
            margin: 0;
            display: inline-block;
        }

        /* ТУТ РОБИМО ГАРНИЙ ЦІАНОВИЙ ДЛЯ "КОКТЕЙЛІ" */
        .main-title span {
            color: var(--cyan);
            text-shadow: 0 0 20px rgba(0, 209, 255, 0.5); /* Плавний неон */
        }

        /* Тонка, стильна лінія знизу */
        .title-line {
            width: 80px;
            height: 3px;
            background: var(--gradient); /* Переливання тілкьи на лінії */
            margin: 15px auto 0;
            border-radius: 10px;
            box-shadow: 0 0 15px var(--cyan);
        }
        /* ---------------------------- */

        .daily-banner {
            margin: 40px 0; background: rgba(10, 10, 30, 0.7); border-radius: 40px;
            display: flex; align-items: center; padding: 30px; border: 1px solid var(--accent);
            position: relative; overflow: hidden; backdrop-filter: blur(15px); box-shadow: 0 20px 40px rgba(0,0,0,0.6);
        }
        .daily-banner::before {
            content: "РЕКОМЕНДАЦІЯ ДНЯ"; position: absolute; top: 20px; right: -30px;
            background: var(--accent); color: white; padding: 5px 40px; transform: rotate(45deg);
            font-size: 10px; font-weight: bold; letter-spacing: 1px;
        }
        .daily-img { width: 200px; height: 200px; border-radius: 30px; object-fit: cover; margin-right: 40px; border: 2px solid var(--accent); }
        .daily-info { text-align: left; flex: 1; }
        .daily-info h3 { margin: 0; font-size: 32px; color: var(--cyan); text-shadow: 0 0 15px var(--cyan); }
        .daily-info p { color: #ccc; line-height: 1.6; margin: 15px 0; }
        .btn-daily {
            display: inline-block; padding: 12px 30px; background: var(--gradient); color: white;
            text-decoration: none; border-radius: 50px; font-weight: bold; transition: 0.3s;
        }

        .grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); gap: 35px; margin-top: 50px; }
        .card {
            background: var(--card-bg); border-radius: 30px; border: 1px solid rgba(123, 97, 255, 0.2);
            padding: 20px; text-decoration: none; color: white; transition: 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            box-shadow: inset 0 0 20px rgba(0, 0, 0, 0.5);
        }
        .card:hover {
            transform: translateY(-12px); border-color: var(--cyan);
            box-shadow: 0 0 30px rgba(123, 97, 255, 0.4), 0 0 10px rgba(0, 209, 255, 0.2);
        }
        .card img { width: 100%; border-radius: 22px; aspect-ratio: 1/1; object-fit: cover; box-shadow: 0 10px 20px rgba(0,0,0,0.6); }
        h2 { color: var(--cyan); font-size: 19px; margin: 15px 0 5px; text-shadow: 0 0 5px rgba(0, 209, 255, 0.3); }
        .view-link { font-size: 11px; letter-spacing: 2px; color: var(--accent); font-weight: bold; text-transform: uppercase; }

        @media (max-width: 768px) {
            .daily-banner { flex-direction: column; text-align: center; }
            .daily-img { margin: 0 0 20px 0; }
            .daily-info { text-align: center; }
        }
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
        <a href="category.php?cat=Алкогольні" class="<?php echo ($cat == 'Алкогольні') ? 'active' : ''; ?>">Алкогольні</a>
        <a href="category.php?cat=Безалкогольні" class="<?php echo ($cat == 'Безалкогольні') ? 'active' : ''; ?>">Безалкогольні</a>
    </nav>
    <div style="color: var(--cyan); font-size: 13px; font-weight: bold;">ФЕС-11 PRODUCTION</div>
</header>

<div class="container">

    <?php if ($daily): ?>
        <div class="daily-banner">
            <img src="img/<?php echo $daily['photo']; ?>" class="daily-img" alt="Daily">
            <div class="daily-info">
                <h3><?php echo htmlspecialchars($daily['name']); ?></h3>
                <p><?php echo mb_strimwidth($daily['description'], 0, 150, "..."); ?></p>
                <a href="details.php?id=<?php echo $daily['id']; ?>" class="btn-daily">ПЕРЕГЛЯНУТИ РЕЦЕПТ</a>
            </div>
        </div>
    <?php endif; ?>

    <div class="title-wrapper">
        <h1 class="main-title">
            <?php echo $p1; ?><span><?php echo $p2; ?></span>
        </h1>
        <div class="title-line"></div>
    </div>

    <div class="grid">
        <?php if ($result && $result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <a href="details.php?id=<?php echo $row['id']; ?>" class="card">
                    <img src="img/<?php echo $row['photo']; ?>" alt="photo">
                    <h2><?php echo htmlspecialchars($row['name']); ?></h2>
                    <div class="view-link">ПЕРЕГЛЯНУТИ →</div>
                </a>
            <?php endwhile; ?>
        <?php else: ?>
            <p style="grid-column: 1/-1; padding: 50px; color: #666; text-align:center;">Тут поки порожньо.</p>
        <?php endif; ?>
    </div>
</div>
</body>
</html>