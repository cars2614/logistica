<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido - Carga y Logística Tolima</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&family=Plus+Jakarta+Sans:wght@500;700;800&family=Outfit:wght@500;700;800&family=Lexend:wght@500;700;800&display=swap" rel="stylesheet">
    
    <style>
        /* RESET GENERAL: Quita los márgenes feos que los navegadores ponen por defecto */
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            /* =========================================================================
               🚀 CONTROLADOR ÚNICO DE TIPOGRAFÍA
               Cambia el nombre dentro de las comillas simples para cambiar la letra de TODA la página:
               Opciones: 'Plus Jakarta Sans' | 'Outfit' | 'Lexend' | 'Inter'
               ========================================================================= */
            --tipo-letra: 'Plus Jakarta Sans', sans-serif;

            /* PALETA DE COLORES: Aquí controlas la identidad visual de la app */
            --blue:        #5138dec4; /* Azul principal (Botón y detalles) */
            --blue2:       #6366F1; /* Morado/Índigo para los degradados */
            --dark:        #0e1750e0; /* Color oscuro del fondo principal */
            --dark2:       #0D1220; /* Color oscuro secundario */
            --card-bg:     #23117293; /* Color para fondos de tarjetas (si agregas luego) */
            --cream:       #F0F4FF; /* Blanco crema para que las letras no cansen la vista */
            --text-muted:  rgba(255, 255, 255, 0.7); /* Blanco transparente para textos secundarios */
        }

        html, body {
            font-family: var(--tipo-letra); /* Usa automáticamente la letra que elegiste en la línea 20 */
            background: var(--dark);        /* Aplica el color oscuro al fondo */
            color: var(--cream);            /* Aplica el color crema a las letras generales */
            overflow-x: hidden;             /* Evita que la página se mueva hacia los lados en celulares */
            min-height: 100vh;              /* Obliga a la página a ocupar toda la altura de la pantalla */
        }

        /* ── BLOQUE FONDO ANIMADO ── */
        .bg-grid {
            position: fixed; inset: 0; z-index: 0;
            /* Dibuja las líneas de la cuadrícula azul translúcida */
            background-image:
                linear-gradient(rgba(15, 45, 97, 0.47) 1px, transparent 1px),
                linear-gradient(90deg, rgba(2, 7, 13, 0.44) 1px, transparent 1px);
            background-size: 60px 60px;
            animation: gridDrift 3s linear infinite; /* Activa el movimiento lento de la cuadrícula */
        }
        @keyframes gridDrift { to { background-position: 60px 6px; } } /* Animación del fondo */

        .bg-glow {
            position: fixed; inset: 0; z-index: 0;
            /* Crea las dos luces de neón difuminadas del fondo */
            background:
                radial-gradient(ellipse 70% 55% at 50% 40%, rgba(0, 0, 0, 0.15) 0%, transparent 65%),
                radial-gradient(ellipse 40% 35% at 15% 15%, rgba(59,130,246,0.1) 0%, transparent 55%);
        }

        /* CONTENEDOR PADRE: Mantiene el contenido por encima del fondo animado */
        .page {
            position: relative; z-index: 1;
            min-height: 100vh;
            display: flex; flex-direction: column; /* Organiza el contenido en fila: Header arriba, Hero centro, Footer abajo */
        }

        /* ── BLOQUE SUPERIOR (HEADER) ── */
        header {
            display: flex; align-items: center; justify-content: space-between; /* Separa el logo a la izquierda y el botón a la derecha */
            padding: 22px 48px; /* Espaciado interno de la barra superior */
            border-bottom: 0px solid rgba(28, 106, 230, 0.1); /* Línea delgada debajo del menú */
            animation: fadeDown 2s ease both; /* Animación para que el menú aparezca bajando suavemente */
        }
        .logo-wrap {
            display: flex; align-items: center; gap: 1px; /* Alinea la imagen del logo al lado del texto */
        }
        .logo-info { display: flex; flex-direction: column; gap: 1px; } /* Pone 'Aplicación Web' justo debajo de 'Carga y Logística Tolima' */
        
        .logo-name {
            font-family: var(--tipo-letra); /* Letra del nombre de tu empresa */
            font-weight: 700; 
            font-size: 20px;
            letter-spacing: -0.4px; /* Junta un poquito las letras para que se vea más profesional */
        }
        .logo-sub {
            font-size: 10px; font-weight: 600;
            letter-spacing: 0.1em; text-transform: uppercase; /* Convierte 'Aplicación Web' a mayúsculas */
            color: var(--text-muted);
        }
        .logo-img { width: 120px; height: auto; } /* Controla el tamaño de la imagen de tu logo */

        /* BOTÓN INICIAR SESIÓN */
        .btn-primary {
            display: inline-flex; align-items: center; gap: 20px;
            background: linear-gradient(250deg, var(--blue), var(--blue2)); /* Hace el degradado azul-morado del botón */
            color: #ffffff;
            font-size: 14px; font-weight: 500;
            padding: 11px 22px;
            border-radius: 12px; /* Hace las esquinas del botón redondeadas y suaves */
            text-decoration: none; border: none; cursor: pointer;
            transition: transform 0.1s, box-shadow 0.1s; /* Hace que el efecto al pasar el mouse sea lento y suave */
            box-shadow: 0 8px 30px rgba(23, 13, 13, 0.37); /* Sombra brillante del botón */
        }
        .btn-primary:hover { 
            transform: translateY(-4px); /* Levanta un poquito el botón cuando pones el mouse encima */
            box-shadow: 0 12px 36px rgba(99,102,241,0.5); /* Aumenta el brillo al pasar el mouse */
        }

        /* ── BLOQUE CENTRAL (HERO) ── */
        .hero {
            flex: 10; /* Hace que esta sección use todo el espacio disponible del centro */
            display: flex; flex-direction: column;
            align-items: center; justify-content: center; /* Centra perfectamente el título y el párrafo */
            text-align: center;
            padding: 80px 24px 60px;
        }

        /* TÍTULO PRINCIPAL GIGANTE */
        h1 {
            font-family: var(--tipo-letra); /* Letra del título principal */
            font-weight: 800; /* Letra muy gruesa (Bold) */
            font-size: clamp(38px, 5.5vw, 64px); /* Se encoge automáticamente en celulares y se agranda en computadoras */
            line-height: 1.15;
            letter-spacing: -1.2px;
            margin-bottom: 24px; /* Separa el título del párrafo de abajo */
            animation: fadeUp 0.5s 0.25s ease both; /* Hace que el título suba suavemente al cargar la página */
        }
        /* EL TEXTO EN DEGRADADO ('mueve tu negocio') */
        h1 .accent {
            background: linear-gradient(90deg, var(--blue), var(--blue2)); /* Colores del degradado del título */
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* PÁRRAFO DESCRIPTIVO DEL CENTRO */
        .hero-desc {
            font-size: 16px; font-weight: 400; line-height: 1.7;
            color: rgba(255,255,255,0.6); /* Color gris claro para que sea legible */
            max-width: 540px; /* Limita el ancho del texto para que no se estire feo en pantallas gigantes */
            margin-bottom: 40px;
            animation: fadeUp 0.5s 0.4s ease both;
        }

        /* ── BLOQUE INFERIOR (FOOTER / PIE DE PÁGINA) ── */
        footer {
            text-align: center; /* Centra los textos del final */
            padding: 24px 48px;
            font-size: 12px;
            color: var(--text-muted);
            border-top: 0px solid rgba(255, 255, 255, 0.05); /* Línea divisoria muy sutil arriba del footer */
        }
        /* MARCA REGISTRADA DEL DESARROLLADOR */
        .footer-brand {
            font-family: var(--tipo-letra); /* Letra del Smart Ware */
            margin-top: 4px;
            color: var(--blue); /* Color azul brillante */
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase; /* Todo en mayúsculas: 'SMART WARE' */
        }

        /* ── ANIMACIONES CSS ── */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); } /* Empieza invisible y abajo */
            to   { opacity: 1; transform: translateY(0); }    /* Termina visible en su lugar real */
        }
        @keyframes fadeDown {
            from { opacity: 0; transform: translateY(-16px); } /* Empieza invisible y arriba */
            to   { opacity: 1; transform: translateY(0); }     /* Termina visible en su lugar real */
        }

        /* ── RESPONSIVO (AJUSTES PARA CELULARES) ── */
       @media (max-width: 600px) {
            header { 
                padding: 16px 20px; 
                gap: 12px;
            }
            .logo-wrap {
                gap: 8px; /* Reduce espacio interno en el logo */
            }
            .logo-img { 
                width: 65px; /* Achica un poco el ícono del camión para ganar espacio lateral */
            }
            .logo-name { 
                font-size: 15px; /* Evita que el nombre largo se monte encima del botón */
                line-height: 1.2;
            }
            .logo-sub {
                font-size: 9px;
            }
            .btn-primary {
                padding: 8px 14px; /* Botón ligeramente más compacto pero táctil */
                font-size: 13px;
            }
            .hero { 
                padding: 40px 20px; 
            }
            .hero-desc {
                font-size: 14px; /* Letra un pelín más pequeña para que se lea perfecto en pantallas mini */
            }
    </style>
</head>
<body>

<div class="bg-grid"></div>
<div class="bg-glow"></div>

<div class="page">

    <header>
        <div class="logo-wrap">
            <img src="images/logo-carga.png" class="logo-img" alt="Logo">
            <div class="logo-info">
                <span class="logo-name">Carga y Logística Tolima</span>
                
            </div>
        </div>
        
        <a href="/login" class="btn-primary">Iniciar sesión →</a>
    </header>

    <main class="hero">
        <h1>
            Logística que<br>
            <span class="accent">mueve tu negocio</span>
        </h1>

        <p class="hero-desc">
            Gestiona guías, conductores y rutas en tiempo real. Todo en
            un solo panel, sin complicaciones.
        </p>
    </main>

    <footer>
        <p>© 2026 Carga y Logística · Todos los derechos reservados</p>
        <div class="footer-brand">Smart Ware</div>        
    </footer>

</div>

</body>
</html>