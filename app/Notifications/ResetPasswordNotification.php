<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotification extends Notification
{
    use Queueable;

    public $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        // Genera la URL segura para restablecer la contraseña
        $url = url(route('password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));

        return (new MailMessage)
            ->subject('Restablecer contraseña - Carga y Logística Tolima')
            ->greeting('¡Hola!')
            ->line('Recibiste este correo porque hiciste una solicitud para restablecer la contraseña de tu cuenta.')
            ->action('Restablecer Contraseña', $url)
            ->line('Este enlace para restablecer la contraseña expirará en 60 minutos.')
            ->line('Si no realizaste esta solicitud, puedes ignorar este correo de forma segura.')
            ->salutation('Saludos, el equipo de Carga y Logística Tolima.');
    }
}