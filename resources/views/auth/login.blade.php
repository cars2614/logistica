<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Carga y Logística Tolima</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@500;700;800&display=swap" rel="stylesheet">
    
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            /* CONTROLADOR ÚNICO DE TIPOGRAFÍA */
            --tipo-letra: 'Plus Jakarta Sans', sans-serif;

            /* PALETA DE COLORES (IGUAL A LA BIENVENIDA) */
            --blue:        #3B82F6;
            --blue2:       #ff0000;
            --dark:        #070c2be0;
            --card-bg:     rgba(15, 22, 40, 0.65);
            --cream:       #F0F4FF;
            --text-muted:  rgba(255, 255, 255, 0.6);
            --input-bg:    #0d1220;
            --border:      rgba(59, 130, 246, 0.15);
            --danger:      #EF4444;
        }

        html, body {
            font-family: var(--tipo-letra);
            background: var(--dark);
            color: var(--cream);
            overflow-x: hidden;
            min-height: 100vh;
        }

        /* FONDO ANIMADO DE BIENVENIDA */
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
            background: radial-gradient(ellipse 70% 55% at 50% 50%, rgba(99,102,241,0.15) 0%, transparent 65%);
        }

        /* CONTENEDOR CENTRAL */
        .auth-container {
            position: relative; z-index: 1;
            min-height: 100vh;
            display: flex; align-items: center; justify-content: center;
            padding: 24px;
        }

        /* ESTILO INTEGRADO PARA EL GUEST LAYOUT */
        x-guest-layout {
            display: block;
            background: var(--card-bg) !important;
            backdrop-filter: blur(12px) !important;
            -webkit-backdrop-filter: blur(12px) !important;
            width: 100%; max-width: 440px;
            padding: 40px 32px;
            border-radius: 16px;
            border: 1px solid var(--border) !important;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4) !important;
        }

        /* TEXTOS */
        .card-title {
            font-size: 26px !important; font-weight: 800 !important;
            margin-bottom: 8px !important; text-align: center;
            color: #ffffff !important; letter-spacing: -0.5px;
        }
        .card-subtitle {
            font-size: 14px !important; color: var(--text-muted) !important;
            margin-bottom: 32px !important; text-align: center;
        }

        /* ENTRADAS DE TEXTO (INPUTS) */
        .field { margin-bottom: 22px; text-align: left; }
        .field label { display: block; font-size: 13px; font-weight: 600; margin-bottom: 8px; color: var(--cream) !important; }
        
        .field input {
            width: 100% !important;
            background: var(--input-bg) !important;
            background-color: var(--input-bg) !important;
            border: 1px solid var(--border) !important;
            padding: 14px 16px !important;
            border-radius: 10px !important;
            color: #ffffff !important;
            font-family: var(--tipo-letra) !important;
            font-size: 14px !important;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .field input:focus {
            outline: none !important;
            border-color: var(--blue) !important;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.25) !important;
        }

        /* ALERTAS Y ERRORES */
        .field-error { display: block; font-size: 12px; color: var(--danger); margin-top: 6px; font-weight: 500; }
        .alert-success { background: rgba(16, 185, 129, 0.15); border: 1px solid rgba(16, 185, 129, 0.3); color: #34D399; padding: 12px; border-radius: 8px; font-size: 14px; margin-bottom: 20px; text-align: center; }

        /* FILA INTERMEDIA */
        .row-between { display: flex !important; align-items: center !important; justify-content: space-between !important; font-size: 13px !important; margin-bottom: 28px !important; }
        .checkbox-wrap { display: flex !important; align-items: center !important; gap: 8px !important; cursor: pointer !important; color: var(--text-muted) !important; }
        .checkbox-wrap input { width: auto !important; cursor: pointer !important; accent-color: var(--blue); }
        .link-muted { color: var(--text-muted) !important; text-decoration: none !important; }
        .link-muted:hover { color: var(--blue) !important; text-decoration: underline !important; }

        /* BOTÓN DEGRADADO DE INICIAR SESIÓN */
        .btn-primary {
            width: 100% !important;
            background: linear-gradient(135deg, var(--blue), var(--blue2)) !important;
            color: #ffffff !important;
            font-size: 15px !important;
            font-weight: 600 !important;
            font-family: var(--tipo-letra) !important;
            padding: 14px !important;
            border-radius: 10px !important;
            border: none !important;
            cursor: pointer !important;
            display: flex !important; align-items: center !important; justify-content: center !important; gap: 8px !important;
            transition: transform 0.2s, box-shadow 0.2s;
            box-shadow: 0 8px 30px rgba(33, 84, 165, 0.3) !important;
        }
        .btn-primary:hover { transform: translateY(-1px); box-shadow: 0 12px 36px rgba(99,102,241,0.4) !important; }

        /* ELEMENTOS INFERIORES */
        .divider { margin: 24px 0 !important; color: var(--text-muted); font-size: 13px; text-transform: uppercase; text-align: center; }
        .footer-text { font-size: 13px; color: var(--text-muted); text-align: center; }
        .footer-text a { color: var(--blue) !important; text-decoration: none; font-weight: 600; }
        .footer-text a:hover { text-decoration: underline !important; }

        /* RESPONSIVO */
        @media (max-width: 480px) {
            x-guest-layout { padding: 32px 20px; }
        }
    </style>
</head>
<body>

<div class="bg-grid"></div>
<div class="bg-glow"></div>

<div class="auth-container">

    <x-guest-layout>

        <h2 class="card-title">Bienvenido de vuelta</h2>
        <p class="card-subtitle">Ingresa tus credenciales para acceder al panel.</p>

        @if (session('status'))
            <div class="alert-success">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="field">
                <label for="email">Correo electrónico</label>
                <input id="email" type="email" name="email"
                    value="{{ old('email') }}"
                    placeholder="tucorreo@ejemplo.com"
                    required autofocus autocomplete="username">
                @error('email')
                    <span class="field-error">⚠ {{ $message }}</span>
                @enderror
            </div>

            <div class="field">
                <label for="password">Contraseña</label>
                <input id="password" type="password" name="password"
                    placeholder="••••••••"
                    required autocomplete="current-password">
                @error('password')
                    <span class="field-error">⚠ {{ $message }}</span>
                @enderror
            </div>

            <div class="row-between" style="margin-top: 4px;">
                <label class="checkbox-wrap">
                    <input type="checkbox" name="remember">
                    Recordarme
                </label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="link-muted">
                        ¿Olvidaste tu contraseña?
                    </a>
                @endif
            </div>

            <button type="submit" class="btn-primary">
                Iniciar sesión
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                    <path d="M3 8H13M9 4l4 4-4 4" stroke="white" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
        </form>

        <div class="divider">o</div>

        <div class="footer-text">
            ¿No tienes cuenta?
            <a href="{{ route('register') }}">Regístrate aquí</a>
        </div>

    </x-guest-layout>

</div>

</body>
</html>