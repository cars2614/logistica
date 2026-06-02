<x-guest-layout>

    <h2 class="card-title">Bienvenido</h2>
    <p class="card-subtitle">¿Cómo quieres continuar?</p>

    <a href="{{ route('login') }}" class="btn-primary">
        Iniciar sesión
        <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
            <path d="M3 8H13M9 4l4 4-4 4" stroke="white" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </a>

    <div class="divider">o</div>

    <div class="footer-text" style="margin-bottom: 10px;">
        ¿No tienes cuenta aún?
    </div>

    <a href="{{ route('register') }}" class="btn-ghost">
        Crear cuenta nueva
    </a>

</x-guest-layout>
