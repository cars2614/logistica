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
