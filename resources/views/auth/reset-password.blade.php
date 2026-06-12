<x-guest-layout>

    <h2 class="card-title">Nueva contraseña</h2>
    <p class="card-subtitle">Ingresa tu nueva contraseña para restablecer el acceso.</p>

    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div class="field">
            <label for="email">Correo electrónico</label>
            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email', $request->email) }}"
                placeholder="tucorreo@ejemplo.com"
                required
                autofocus
                autocomplete="username"
            >
            @error('email')
                <span class="field-error">⚠ {{ $message }}</span>
            @enderror
        </div>

        <div class="field">
            <label for="password">Nueva contraseña</label>
            <input
                id="password"
                type="password"
                name="password"
                placeholder="Mínimo 8 caracteres"
                required
                autocomplete="new-password"
            >
            @error('password')
                <span class="field-error">⚠ {{ $message }}</span>
            @enderror
        </div>

        <div class="field">
            <label for="password_confirmation">Confirmar contraseña</label>
            <input
                id="password_confirmation"
                type="password"
                name="password_confirmation"
                placeholder="Repite tu nueva contraseña"
                required
                autocomplete="new-password"
            >
            @error('password_confirmation')
                <span class="field-error">⚠ {{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn-primary">
            Restablecer contraseña
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                <path d="M3 8H13M9 4l4 4-4 4" stroke="white" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </button>
    </form>

    <div class="divider">o</div>

    <div class="footer-text">
        ¿Ya recordaste tu contraseña?
        <a href="{{ route('login') }}">Inicia sesión</a>
    </div>

</x-guest-layout>

