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
            --orange: #F7A220;
            --red:    #E63E1C;
            --dark:   #0F0D0B;
            --dark2:  #1A1612;
            --cream:  #FAF6EF;
            --text-muted: rgba(250,246,239,0.5);
        }

        html, body {
            height: 100%;
            font-family: 'DM Sans', sans-serif;
            background: var(--dark);
            color: var(--cream);
            overflow-x: hidden;
        }

        /* ── FONDO ANIMADO ── */
        .bg-grid {
            position: fixed; inset: 0; z-index: 0;
            background-image:
                linear-gradient(rgba(247,162,32,0.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(247,162,32,0.04) 1px, transparent 1px);
            background-size: 60px 60px;
            animation: gridDrift 20s linear infinite;
        }
        @keyframes gridDrift { to { background-position: 60px 60px; } }

        .bg-glow {
            position: fixed; inset: 0; z-index: 0;
            background:
                radial-gradient(ellipse 80% 60% at 70% 50%, rgba(230,62,28,0.18) 0%, transparent 60%),
                radial-gradient(ellipse 50% 40% at 20% 20%, rgba(247,162,32,0.12) 0%, transparent 55%);
        }

        /* ── LAYOUT ── */
        .page {
            position: relative; z-index: 1;
            min-height: 100vh;
            display: flex; flex-direction: column;  
        }

        /* ── HEADER ── */
        header {
            display: flex; align-items: center; justify-content: space-between;
            padding: 28px 48px;
            border-bottom: 1px solid rgba(247,162,32,0.1);
            animation: fadeDown 0.7s ease both;
        }
        .logo-wrap {
            display: flex; align-items: center; gap: 14px;
        }
        .logo-svg {
            width: 46px; height: 36px;
        }
        .logo-name {
            font-family: 'Syne', sans-serif;
            font-weight: 800;
            font-size: 22px;
            letter-spacing: -0.5px;
        }
        .logo-name span { color: var(--orange); }

        .header-badge {
            font-size: 12px;
            font-weight: 500;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--text-muted);
            border: 1px solid rgba(247,162,32,0.2);
            padding: 6px 14px;
            border-radius: 100px;
        }

        /* ── HERO ── */
        .hero {
            flex: 1;
            display: flex; align-items: center; justify-content: center;
            padding: 10px 20px;
            gap: 80px;
        }

        .hero-left {
            max-width: 660px;
        }

        .hero-tag {
            display: inline-flex; align-items: center; gap: 8px;
            font-size: 12px; font-weight: 500;
            letter-spacing: 0.1em; text-transform: uppercase;
            color: var(--orange);
            background: rgba(247,162,32,0.1);
            border: 1px solid rgba(247,162,32,0.25);
            padding: 7px 14px; border-radius: 100px;
            margin-bottom: 28px;
            animation: fadeUp 0.6s 0.1s ease both;
        }
        .hero-tag::before {
            content: '';
            width: 6px; height: 6px;
            background: var(--gr);
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
            font-size: clamp(42px, 5.5vw, 72px);
            line-height: 1.0;
            letter-spacing: -2px;
            margin-bottom: 24px;
            animation: fadeUp 0.6s 0.35s ease both;
        }
        h1 .line-accent {
            display: block;
            background: linear-gradient(90deg, var(--orange), var(--red));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-desc {
            font-size: 17px;
            font-weight: 300;
            line-height: 1.7;
            color: rgba(250,246,239,0.65);
            max-width: 420px;
            margin-bottom: 40px;
            animation: fadeUp 0.6s 0.5s ease both;
        }

        .hero-actions {
            display: flex; align-items: center; gap: 16px;
            animation: fadeUp 0.6s 0.65s ease both;
        }

        .btn-primary {
            display: inline-flex; align-items: center; gap: 10px;
            background: linear-gradient(135deg, var(--orange), var(--red));
            color: #fff;
            font-family: 'DM Sans', sans-serif;
            font-size: 15px; font-weight: 500;
            padding: 14px 30px;
            border-radius: 12px;
            text-decoration: none;
            border: none; cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
            box-shadow: 0 8px 32px rgba(230,62,28,0.35);
            position: relative; overflow: hidden;
        }
        .btn-primary::after {
            content: '';
            position: absolute; inset: 0;
            background: rgba(255,255,255,0.12);
            opacity: 0; transition: opacity 0.2s;
        }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 14px 40px rgba(230,62,28,0.45); }
        .btn-primary:hover::after { opacity: 1; }
        .btn-primary:active { transform: translateY(0); }

        .btn-arrow {
            display: inline-flex; align-items: center; justify-content: center;
            width: 20px; height: 20px;
            transition: transform 0.2s;
        }
        .btn-primary:hover .btn-arrow { transform: translateX(3px); }

        .btn-ghost {
            display: inline-flex; align-items: center; gap: 8px;
            color: var(--text-muted);
            font-size: 14px; font-weight: 400;
            text-decoration: none;
            transition: color 0.2s;
        }
        .btn-ghost:hover { color: var(--cream); }

        /* ── STATS ROW ── */
        .stats-row {
            display: flex; gap: 32px;
            margin-top: 56px;
            padding-top: 40px;
            border-top: 1px solid rgba(247,162,32,0.1);
            animation: fadeUp 0.6s 0.8s ease both;
        }
        .stat-item { display: flex; flex-direction: column; gap: 4px; }
        .stat-number {
            font-family: 'Syne', sans-serif;
            font-weight: 700; font-size: 28px;
            color: var(--cream);
        }
        .stat-number span { color: var(--orange); }
        .stat-label {
            font-size: 12px; font-weight: 400;
            color: var(--text-muted);
            text-transform: uppercase; letter-spacing: 0.06em;
        }
        .stat-divider {
            width: 1px;
            background: rgba(247,162,32,0.15);
            align-self: stretch;
        }

        /* ── HERO RIGHT: ilustración del camión ── */
        .hero-right {
            flex-shrink: 0;
            animation: fadeLeft 0.8s 0.4s ease both;
        }
        .truck-illustration {
            width: 340px; height: 260px;
            position: relative;
        }

        /* Fondo tarjeta flotante */
        .float-card {
            background: rgba(250,246,239,0.04);
            border: 1px solid rgba(247,162,32,0.15);
            border-radius: 20px;
            padding: 28px;
            width: 100%;
            height: 100%;
            display: flex; align-items: center; justify-content: center;
            position: relative; overflow: hidden;
        }
        .float-card::before {
            content: '';
            position: absolute; top: -40px; right: -40px;
            width: 160px; height: 160px;
            background: radial-gradient(circle, rgba(230,62,28,0.25) 0%, transparent 70%);
        }

        .truck-svg {
            width: 200px;
            filter: drop-shadow(0 12px 36px rgba(230,62,28,0.4));
            animation: truckFloat 3s ease-in-out infinite;
        }
        @keyframes truckFloat {
            0%,100% { transform: translateY(0px) rotate(0deg); }
            50%      { transform: translateY(-8px) rotate(1deg); }
        }

        /* Ping de tracking */
        .track-ping {
            position: absolute; bottom: 22px; left: 22px;
            background: rgba(15,13,11,0.9);
            border: 1px solid rgba(247,162,32,0.3);
            border-radius: 10px;
            padding: 10px 14px;
            display: flex; align-items: center; gap: 10px;
            font-size: 12px;
            animation: fadeUp 0.5s 1.1s ease both;
        }
        .track-ping .dot {
            width: 8px; height: 8px;
            background: #22c55e;
            border-radius: 50%;
            animation: pulse 1.4s ease-in-out infinite;
        }
        .track-ping .ping-text { color: rgba(250,246,239,0.8); }
        .track-ping .ping-id { color: var(--orange); font-weight: 500; }

        /* ── FOOTER ── */
        footer {
            text-align: center;
            padding: 20px 48px 28px;
            font-size: 12px;
            color: rgba(250,246,239,0.2);
            border-top: 1px solid rgba(247,162,32,0.06);
            animation: fadeUp 0.6s 1s ease both;
        }

        /* ── ANIMACIONES ── */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeDown {
            from { opacity: 0; transform: translateY(-16px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeLeft {
            from { opacity: 0; transform: translateX(30px); }
            to   { opacity: 1; transform: translateX(0); }
        }

        /* ── RESPONSIVE ── */
        @media (max-width: 900px) {
            .hero { flex-direction: column; gap: 48px; padding: 40px 24px; text-align: center; }
            .hero-desc { max-width: 100%; }
            .hero-actions { justify-content: center; }
            .stats-row { justify-content: center; flex-wrap: wrap; gap: 20px; }
            header { padding: 20px 24px; }
            .hero-right { order: -1; }
            .truck-illustration { width: 280px; height: 200px; }
            .truck-svg { width: 150px; }
        }
        .logo-img {
         width: 100px;
          height: auto;
        } 
    </style>
</head>
<body>
<div class="bg-grid"></div>
<div class="bg-glow"></div>

<div class="page">
    <!-- HEADER -->
    <header>
        <div class="logo-wrap">
            <!-- Logo SVG basado en el logo de la empresa -->
            <img src="images/logo-empresa.jpeg" class="logo-img">
                <!-- alas -->
                <rect x="0" y="2"  width="26" height="7" rx="3.5" fill="#F7A220"/>
                <rect x="3" y="13" width="22" height="7" rx="3.5" fill="#F7A220"/>
                <rect x="8" y="24" width="16" height="7" rx="3.5" fill="#F7A220"/>
                <!-- cabina camión -->
                <path d="M28 2 Q36 2 38 8 L38 20 Q38 22 36 22 L28 22 Z" fill="#E63E1C"/>
                <rect x="28" y="13" width="10" height="9" rx="2" fill="#E63E1C"/>
                <!-- ruedas -->
                <circle cx="31" cy="30" r="4" fill="#E63E1C"/>
                <circle cx="42" cy="30" r="4" fill="#E63E1C"/>
            </svg>
            <span class="logo-name">Carga<span>   Y   </span>Logistica</span>
        </div>
        <span class="header-badge">Sistema de Rastreo</span>
    </header>

    <!-- HERO -->
    <section class="hero">
        <div class="hero-left">
            <div class="hero-tag">Plataforma activa</div>

            <h1>
            
                <span class="line-accent">Trabajando</span>
                Para Ti
            </h1>

            <p class="hero-desc">
                Rastrea cada paquete, gestiona tus entregas y mantén a tus clientes informados
                desde un solo lugar. Rápido, confiable y siempre al día.
            </p>

            <div class="hero-actions">
                <a href="/login" class="btn-primary">
                    Iniciar sesión
                    <span class="btn-arrow">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                            <path d="M3 8H13M9 4l4 4-4 4" stroke="white" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </span>
                </a>
                <a href="#" class="btn-ghost">
                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                        <circle cx="7" cy="7" r="6" stroke="currentColor" stroke-width="1.2"/>
                        <path d="M5.5 5.2a1.5 1.5 0 1 1 2.1 1.4C7.2 6.9 7 7.3 7 7.8" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"/>
                        <circle cx="7" cy="9.8" r="0.6" fill="currentColor"/>
                    </svg>
    
                </a>
            </div>

            <div class="stats-row">
                <div class="stat-item">
                    <span class="stat-number">12<span>K+</span></span>
                    <span class="stat-label">Envíos activos</span>
                </div>
                <div class="stat-divider"></div>
                <div class="stat-item">
                    <span class="stat-number">98<span>%</span></span>
                    <span class="stat-label">A tiempo</span>
                </div>
                <div class="stat-divider"></div>
                <div class="stat-item">
                    <span class="stat-number">24<span>/7</span></span>
                    <span class="stat-label">Monitoreo</span>
                </div>
            </div>
        </div>

        <!-- Ilustración derecha -->
        <div class="hero-right">
            <div class="truck-illustration">
                <div class="float-card">
                    <!-- Logo grande del camión centrado -->
                    <svg class="truck-svg" viewBox="0 0 200 150" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <!-- alas / speed lines -->
                        <rect x="0"  y="10" width="100" height="28" rx="14" fill="#F7A220"/>
                        <rect x="14" y="52" width="86"  height="26" rx="13" fill="#F7A220"/>
                        <rect x="34" y="92" width="64"  height="22" rx="11" fill="#F7A220"/>
                        <!-- cabina -->
                        <path d="M108 10 Q140 10 148 30 L148 80 Q148 86 142 86 L108 86 Z" fill="#E63E1C"/>
                        <rect x="108" y="52" width="40" height="34" rx="6" fill="#E63E1C"/>
                        <!-- ventana -->
                        <rect x="118" y="18" width="22" height="18" rx="4" fill="rgba(255,255,255,0.2)"/>
                        <!-- franja -->
                        <rect x="108" y="52" width="40" height="5" fill="rgba(247,162,32,0.5)"/>
                        <!-- ruedas -->
                        <circle cx="122" cy="116" r="18" fill="#1A1612" stroke="#E63E1C" stroke-width="4"/>
                        <circle cx="122" cy="116" r="8"  fill="#E63E1C"/>
                        <circle cx="165" cy="116" r="18" fill="#1A1612" stroke="#E63E1C" stroke-width="4"/>
                        <circle cx="165" cy="116" r="8"  fill="#E63E1C"/>
                        <!-- chasis -->
                        <rect x="108" y="86" width="70" height="12" rx="3" fill="#C03010"/>
                    </svg>

                    <!-- Badge tracking en vivo -->
                    <div class="track-ping">
                        <div class="dot"></div>
                        <span class="ping-text">En ruta</span>
                        <span class="ping-id">#TRK-4821</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer>
        © 2026 carga y logistica  · Todos los derechos reservados
    </footer>
</div>
</body>
</html>