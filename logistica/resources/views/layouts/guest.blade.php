<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Carga y Logística') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;700;800&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --blue:         #3B82F6;
            --blue2:        #6366F1;
            --dark:         #080C14;
            --card:         #0F1628;
            --cream:        #F0F4FF;
            --muted:        rgba(240,244,255,0.5);
            --border:       rgba(59,130,246,0.15);
            --input-bg:     rgba(240,244,255,0.05);
            --input-border: rgba(59,130,246,0.2);
        }

        html, body {
            min-height: 100vh;
            font-family: 'DM Sans', sans-serif;
            background: var(--dark);
            color: var(--cream);
        }

        /* ── FONDO ANIMADO ── */
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
                radial-gradient(ellipse 65% 50% at 50% 45%, rgba(99,102,241,0.14) 0%, transparent 65%),
                radial-gradient(ellipse 40% 30% at 10% 10%, rgba(59,130,246,0.08) 0%, transparent 55%);
        }

        /* ── PÁGINA ── */
        .page {
            position: relative; z-index: 1;
            min-height: 100vh;
            display: flex; flex-direction: column;
            align-items: center; justify-content: center;
            padding: 40px 24px;
        }

        /* ── VOLVER ── */
        .back-link {
            position: fixed; top: 28px; left: 36px;
            display: inline-flex; align-items: center; gap: 7px;
            font-size: 13px; color: var(--muted);
            text-decoration: none;
            transition: color 0.2s;
            z-index: 10;
        }
        .back-link:hover { color: var(--cream); }
        .back-link:hover svg { transform: translateX(-3px); }
        .back-link svg { transition: transform 0.2s; }

        /* ── CARD ── */
        .card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 22px;
            padding: 42px 40px;
            width: 100%; max-width: 460px;
            box-shadow: 0 24px 80px rgba(0,0,0,0.4);
            animation: fadeUp 0.45s ease both;
        }
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(22px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* ── LOGO ── */
        .card-header {
            display: flex; align-items: center; gap: 12px;
            padding-bottom: 26px;
            margin-bottom: 28px;
            border-bottom: 1px solid var(--border);
        }
        .card-header img { width: 76px; height: auto; }
        .card-header-info { display: flex; flex-direction: column; gap: 3px; }
        .card-header-name {
            font-family: 'Syne', sans-serif;
            font-weight: 800; font-size: 15px;
        }
        .card-header-sub {
            font-size: 10px; font-weight: 500;
            text-transform: uppercase; letter-spacing: 0.1em;
            color: var(--muted);
        }

        /* ── TÍTULOS ── */
        .card-title {
            font-family: 'Syne', sans-serif;
            font-weight: 800; font-size: 24px;
            letter-spacing: -0.5px;
            margin-bottom: 6px;
        }
        .card-subtitle {
            font-size: 14px; font-weight: 300;
            color: var(--muted); line-height: 1.5;
            margin-bottom: 28px;
        }

        /* ── CAMPOS ── */
        .field { display: flex; flex-direction: column; gap: 7px; margin-bottom: 16px; }
        .field label {
            font-size: 13px; font-weight: 500;
            color: rgba(240,244,255,0.7);
        }
        .field input {
            background: var(--input-bg);
            border: 1px solid var(--input-border);
            border-radius: 10px;
            padding: 13px 16px;
            font-size: 14px; color: var(--cream);
            font-family: 'DM Sans', sans-serif;
            outline: none; width: 100%;
            transition: border-color 0.2s, background 0.2s, box-shadow 0.2s;
        }
        .field input:focus {
            border-color: var(--blue);
            background: rgba(59,130,246,0.07);
            box-shadow: 0 0 0 3px rgba(59,130,246,0.12);
        }
        .field input::placeholder { color: rgba(240,244,255,0.2); }
        .field-error {
            font-size: 12px; color: #f87171;
            display: flex; align-items: center; gap: 4px;
        }

        /* ── BOTONES ── */
        .btn-primary {
            width: 100%;
            display: flex; align-items: center; justify-content: center; gap: 9px;
            background: linear-gradient(135deg, var(--blue), var(--blue2));
            color: #fff;
            font-family: 'DM Sans', sans-serif;
            font-size: 15px; font-weight: 500;
            padding: 14px 24px; border-radius: 11px;
            border: none; cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
            box-shadow: 0 8px 28px rgba(59,130,246,0.32);
            text-decoration: none;
            position: relative; overflow: hidden;
            margin-top: 10px;
        }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 14px 36px rgba(99,102,241,0.45); }
        .btn-primary:active { transform: translateY(0); }

        .btn-ghost {
            width: 100%;
            display: flex; align-items: center; justify-content: center; gap: 9px;
            background: rgba(240,244,255,0.05);
            color: var(--cream);
            font-family: 'DM Sans', sans-serif;
            font-size: 15px; font-weight: 400;
            padding: 14px 24px; border-radius: 11px;
            border: 1px solid rgba(240,244,255,0.1);
            cursor: pointer; text-decoration: none;
            transition: background 0.2s, border-color 0.2s;
            margin-top: 10px;
        }
        .btn-ghost:hover {
            background: rgba(240,244,255,0.09);
            border-color: rgba(240,244,255,0.18);
        }

        /* ── EXTRAS ── */
        .row-between {
            display: flex; align-items: center; justify-content: space-between;
            margin-top: 4px;
        }
        .checkbox-wrap {
            display: flex; align-items: center; gap: 8px;
            font-size: 13px; color: var(--muted); cursor: pointer;
        }
        .checkbox-wrap input[type=checkbox] {
            width: 15px; height: 15px;
            accent-color: var(--blue); cursor: pointer;
        }
        .link-muted {
            font-size: 13px; color: var(--muted);
            text-decoration: none; transition: color 0.2s;
        }
        .link-muted:hover { color: var(--blue); }

        .divider {
            display: flex; align-items: center; gap: 14px;
            margin: 24px 0;
            font-size: 12px; color: var(--muted);
        }
        .divider::before, .divider::after {
            content: ''; flex: 1;
            height: 1px; background: var(--border);
        }

        .footer-text {
            text-align: center;
            font-size: 13px; color: var(--muted);
        }
        .footer-text a {
            color: var(--blue); font-weight: 500;
            text-decoration: none;
        }
        .footer-text a:hover { text-decoration: underline; }

        .alert-success {
            background: rgba(34,197,94,0.1);
            border: 1px solid rgba(34,197,94,0.25);
            color: #4ade80;
            font-size: 13px; padding: 11px 14px;
            border-radius: 9px; margin-bottom: 18px;
        }
    </style>
</head>
<body>
<div class="bg-grid"></div>
<div class="bg-glow"></div>

<a href="/" class="back-link">
    <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
        <path d="M10 3L5 8l5 5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
    Volver al inicio
</a>

<div class="page">
    <div class="card">

        <div class="card-header">
            <img src="/images/logo-carga.png" alt="Logo">
            <div class="card-header-info">
                <span class="card-header-name">Carga y Logística</span>
                <span class="card-header-sub">Sistema Operativo</span>
            </div>
        </div>

        {{ $slot }}

    </div>
</div>
</body>
</html>

