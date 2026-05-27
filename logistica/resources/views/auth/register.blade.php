<x-guest-layout>

    <h2 class="card-title">Crear cuenta</h2>
    <p class="card-subtitle">Completa los datos para registrarte en el sistema.</p>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="field">
            <label for="name">Nombre completo</label>
            <input id="name" type="text" name="name"
                value="{{ old('name') }}"
                placeholder="Tu nombre completo"
                required autofocus autocomplete="name">
            @error('name')
                <span class="field-error">⚠ {{ $message }}</span>
            @enderror
        </div>

        <div class="field">
            <label for="email">Correo electrónico</label>
            <input id="email" type="email" name="email"
                value="{{ old('email') }}"
                placeholder="tucorreo@ejemplo.com"
                required autocomplete="username">
            @error('email')
                <span class="field-error">⚠ {{ $message }}</span>
            @enderror
        </div>

        <div class="field">
            <label for="password">Contraseña</label>
            <input id="password" type="password" name="password"
                placeholder="Mínimo 8 caracteres"
                required autocomplete="new-password">
            @error('password')
                <span class="field-error">⚠ {{ $message }}</span>
            @enderror
        </div>

        <div class="field">
            <label for="password_confirmation">Confirmar contraseña</label>
            <input id="password_confirmation" type="password" name="password_confirmation"
                placeholder="Repite tu contraseña"
                required autocomplete="new-password">
            @error('password_confirmation')
                <span class="field-error">⚠ {{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn-primary">
            Crear mi cuenta
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                <path d="M3 8H13M9 4l4 4-4 4" stroke="white" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </button>
    </form>

    <div class="divider">o</div>

    <div class="footer-text">
        ¿Ya tienes cuenta?
        <a href="{{ route('login') }}">Inicia sesión</a>
    </div>

</x-guest-layout>
