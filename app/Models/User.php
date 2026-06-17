<?php

namespace App\Models;

use App\Notifications\ResetPasswordNotification;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

 // <-- ESTA LÍNEA ES LA CLAVE

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, HasRoles, Notifiable; // <-- HasRoles debe estar aquí

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Envía la notificación de restablecimiento de contraseña personalizada en español.
     */
    public function sendPasswordResetNotification($token): void
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    public function planillas()
    {
        return $this->hasMany(Planilla::class, 'id_usuario');
    }

    public function guiasAsignadas()
    {
        return $this->hasMany(Guia::class, 'id_repartidor');
    }

    public function repartidor()
    {
        return $this->hasOne(Repartidor::class);
    }

    /**
     * Devuelve la descripción/rol a mostrar en el User Menu de AdminLTE
     */
    public function adminlte_desc()
    {
        // Si usamos Spatie Roles, podríamos hacer: return $this->roles->first()->name ?? 'Usuario';
        // Pero para este caso, fijamos "Administrador del Sistema" o "Rol: Administrador"
        return 'Administrador del Sistema';
    }
}
