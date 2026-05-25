<x-guest-layout>

    <h2 class="card-title">¿Olvidaste tu contraseña?</h2>
    <p class="card-subtitle">
        No hay problema. Ingresa tu correo y te enviaremos un enlace para que puedas crear una nueva contraseña.
    </p>

    @if (session('status'))
        <div class="alert-success">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="field">
            <label for="email">Correo electrónico</label>
            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email') }}"
                placeholder="tucorreo@ejemplo.com"
                required
                autofocus
            >
            @error('email')
                <span class="field-error">⚠ {{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn-primary">
            Enviar enlace de recuperación
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

