<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;700;800&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --blue:        #3B82F6;
            --blue2:       #6366F1;
            --dark:        #080C14;
            --dark2:       #0D1220;
            --card-bg:     #0F1628;
            --cream:       #F0F4FF;
            --text-muted:  rgba(240,244,255,0.5);
        }

        html, body {
            font-family: 'DM Sans', sans-serif;
            background: var(--dark);
            color: var(--cream);
            overflow-x: hidden;
        }

        /* ── FONDO ── */
        .bg-grid {
            position: fixed; inset: 0; z-index: 0;
            background-image:
                linear-gradient(rgba(59,130,246,0.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(59,130,246,0.04) 1px, transparent 1px);
            background-size: 60px 60px;
            animation: gridDrift 20s linear infinite;
        }
        @keyframes gridDrift { to { background-position: 60px 60px; } }

        .bg-glow {
            position: fixed; inset: 0; z-index: 0;
            background:
                radial-gradient(ellipse 70% 55% at 50% 40%, rgba(99,102,241,0.15) 0%, transparent 65%),
                radial-gradient(ellipse 40% 35% at 15% 15%, rgba(59,130,246,0.1) 0%, transparent 55%);
        }

        .page {
            position: relative; z-index: 1;
            min-height: 100vh;
            display: flex; flex-direction: column;
        }

        /* ── HEADER ── */
        header {
            display: flex; align-items: center; justify-content: space-between;
            padding: 22px 48px;
            border-bottom: 1px solid rgba(59,130,246,0.1);
            animation: fadeDown 0.7s ease both;
        }
        .logo-wrap {
            display: flex; align-items: center; gap: 14px;
        }
        .logo-info { display: flex; flex-direction: column; gap: 1px; }
        .logo-name {
            font-family: 'Syne', sans-serif;
            font-weight: 800; font-size: 16px;
            letter-spacing: -0.3px;
        }
        .logo-sub {
            font-size: 10px; font-weight: 400;
            letter-spacing: 0.1em; text-transform: uppercase;
            color: var(--text-muted);
        }

        nav { display: flex; align-items: center; gap: 36px; }
        nav a {
            font-size: 14px; font-weight: 400;
            color: var(--text-muted);
            text-decoration: none;
            transition: color 0.2s;
        }
        nav a:hover { color: var(--cream); }

        .btn-primary {
            display: inline-flex; align-items: center; gap: 8px;
            background: linear-gradient(135deg, var(--blue), var(--blue2));
            color: #ffffff;
            font-family: 'DM Sans', sans-serif;
            font-size: 14px; font-weight: 500;
            padding: 11px 22px;
            border-radius: 10px;
            text-decoration: none; border: none; cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
            box-shadow: 0 8px 30px rgba(33, 84, 165, 0.37);
            position: relative; overflow: hidden;
        }
        .btn-primary::after {
            content: ''; position: absolute; inset: 0;
            background: rgba(255,255,255,0.1);
            opacity: 0; transition: opacity 0.2s;
        }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 12px 36px rgba(99,102,241,0.5); }
        .btn-primary:hover::after { opacity: 1; }

        .btn-secondary {
            display: inline-flex; align-items: center; gap: 8px;
            background: rgba(240,244,255,0.06);
            color: var(--cream);
            font-family: 'DM Sans', sans-serif;
            font-size: 14px; font-weight: 400;
            padding: 11px 22px;
            border-radius: 10px;
            text-decoration: none;
            border: 1px solid rgba(240,244,255,0.1);
            cursor: pointer;
            transition: background 0.2s, border-color 0.2s;
        }
        .btn-secondary:hover {
            background: rgba(240,244,255,0.1);
            border-color: rgba(240,244,255,0.2);
        }

        /* ── HERO ── */
        .hero {
            flex: 1;
            display: flex; flex-direction: column;
            align-items: center; justify-content: center;
            text-align: center;
            padding: 80px 24px 60px;
        }

        .hero-tag {
            display: inline-flex; align-items: center; gap: 8px;
            font-size: 12px; font-weight: 500;
            letter-spacing: 0.1em; text-transform: uppercase;
            color: var(--blue);
            background: rgba(59,130,246,0.1);
            border: 1px solid rgba(59,130,246,0.25);
            padding: 6px 14px; border-radius: 100px;
            margin-bottom: 32px;
            animation: fadeUp 0.5s 0.1s ease both;
        }
        .hero-tag .dot {
            width: 6px; height: 6px;
            background: #fdfdfd;
            border-radius: 50%;
            animation: pulse 1.8s ease-in-out infinite;
        }
        @keyframes pulse {
            0%,100% { opacity: 1; transform: scale(1); }
            50%      { opacity: 0.4; transform: scale(0.7); }
        }

        h1 {
            font-family: 'Syne', sans-serif;
            font-weight: 800;
            font-size: clamp(40px, 6vw, 76px);
            line-height: 1.05;
            letter-spacing: -2.5px;
            margin-bottom: 20px;
            animation: fadeUp 0.5s 0.25s ease both;
        }
        h1 .accent {
            background: linear-gradient(90deg, var(--blue), var(--blue2));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-desc {
            font-size: 16px; font-weight: 300; line-height: 1.7;
            color: rgba(255,255,255,0.55);
            max-width: 520px;
            margin-bottom: 40px;
            animation: fadeUp 0.5s 0.4s ease both;
        }

        .hero-actions {
            display: flex; align-items: center; gap: 14px;
            animation: fadeUp 0.5s 0.55s ease both;
        }

        /* ── STATS BAR ── */
        .stats-bar {
            margin: 0 40px;
            background: var(--card-bg);
            border: 1px solid rgba(59,130,246,0.12);
            border-radius: 18px;
            display: grid; grid-template-columns: repeat(4, 1fr);
            animation: fadeUp 0.5s 0.7s ease both;
        }
        .stat-cell {
            padding: 28px 24px;
            text-align: center;
            border-right: 1px solid rgba(59,130,246,0.1);
        }
        .stat-cell:last-child { border-right: none; }
        .stat-number {
            font-family: 'Syne', sans-serif;
            font-weight: 700; font-size: 32px;
            color: var(--cream);
            letter-spacing: -1px;
        }
        .stat-number sup {
            font-size: 18px; font-weight: 500;
            color: var(--blue);
            vertical-align: super;
        }
        .stat-label {
            font-size: 11px; font-weight: 500;
            color: var(--text-muted);
            text-transform: uppercase; letter-spacing: 0.1em;
            margin-top: 4px;
        }

        /* ── FEATURE CARDS ── */
        .features {
            display: grid; grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            margin: 16px 40px 0;
            animation: fadeUp 0.5s 0.85s ease both;
        }
        .feature-card {
            background: var(--card-bg);
            border: 1px solid rgba(59,130,246,0.1);
            border-radius: 18px;
            padding: 28px 28px 32px;
            transition: border-color 0.25s, transform 0.25s;
        }
        .feature-card:hover {
            border-color: rgba(59,130,246,0.3);
            transform: translateY(-3px);
        }
        .feat-icon {
            width: 44px; height: 44px;
            border-radius: 12px;
            margin-bottom: 20px;
            display: flex; align-items: center; justify-content: center;
            font-size: 20px;
        }
        .feat-icon.blue   { background: rgba(59,130,246,0.15); }
        .feat-icon.indigo { background: rgba(99,102,241,0.15); }
        .feat-icon.teal   { background: rgba(20,184,166,0.15); }
        .feat-title {
            font-family: 'Syne', sans-serif;
            font-weight: 700; font-size: 16px;
            margin-bottom: 8px;
        }
        .feat-desc {
            font-size: 13px; font-weight: 300; line-height: 1.6;
            color: var(--text-muted);
        }

        /* ── FOOTER ── */
        footer {
            text-align: center;
            padding: 24px 48px;
            font-size: 12px;
            color: rgb(255, 255, 255);
            border-top: 1px solid rgba(206, 28, 28, 0.06);
            margin-top: 40px;
        }

        /* ── ANIMATIONS ── */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeDown {
            from { opacity: 0; transform: translateY(-16px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* ── RESPONSIVE ── */
        @media (max-width: 900px) {
            header { padding: 18px 24px; }
            nav { display: none; }
            .hero { padding: 60px 24px 40px; }
            .stats-bar { grid-template-columns: repeat(2, 1fr); margin: 0 16px; }
            .stat-cell:nth-child(2) { border-right: none; }
            .stat-cell:nth-child(3) { border-top: 1px solid rgba(59,130,246,0.1); }
            .features { grid-template-columns: 1fr; margin: 16px 16px 0; }
        }

        .logo-img { width: 90px; height: auto; }
    </style>
</head>
<body>
<div class="bg-grid"></div>
<div class="bg-glow"></div>

<div class="page">

    <!-- HEADER -->
    <header>
        <div class="logo-wrap">
            <img src="images/logo-carga.png" class="logo-img" alt="Logo">
            <div class="logo-info">
                <span class="logo-name">Carga y Logística Tolima</span>
                <span class="logo-sub">Sistema Operativo</span>
            </div>
        </div>
        <nav>
            <a href="#">Seguimiento</a>
            <a href="#">Servicios</a>
            <a href="#">Contacto</a>
        </nav>
        <a href="/login" class="btn-primary">Iniciar sesión →</a>
    </header>

    <!-- HERO -->
    <section class="hero">
        <div class="hero-tag">
            <span class="dot"></span>
            Sistema activo · 13 de mayo, 2026
        </div>

        <h1>
            Logística que<br>
            <span class="accent">mueve tu negocio</span>
        </h1>

        <p class="hero-desc">
            Gestiona guías, conductores y rutas en tiempo real. Todo en
            un solo panel, sin complicaciones.
        </p>

        <div class="hero-actions">
            <a href="/login" class="btn-primary">Acceder al sistema</a>
            <a href="#" class="btn-secondary">Ver seguimiento de guía →</a>
        </div>
    </section>

    

   

    <!-- FOOTER -->
    <footer>
        © 2026 carga y logistica · Todos los derechos reservados
    </footer>

</div>
</body>
</html>
