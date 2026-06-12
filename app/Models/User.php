<?php
<<<<<<< HEAD

namespace App\Models;

=======
 
namespace App\Models;
 
>>>>>>> origin/juana
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
<<<<<<< HEAD
use Spatie\Permission\Traits\HasRoles; // <-- ESTA LÍNEA ES LA CLAVE

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, HasRoles; // <-- HasRoles debe estar aquí

=======
 
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;
 
>>>>>>> origin/juana
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
<<<<<<< HEAD
        'id_rol',
    ];

=======
    ];
 
>>>>>>> origin/juana
    /**
     * The attributes that should be hidden for serialization.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
<<<<<<< HEAD

=======
 
>>>>>>> origin/juana
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
<<<<<<< HEAD

    /**
     * Relación con el modelo Rol
     */
    public function rol()
    {
        return $this->belongsTo(Rol::class, 'id_rol');
    }

    /**
     * Helper para comprobar el rol del usuario
     */
    public function hasRole(string $role): bool
    {
        // Si usas Spatie, hasRole ya existe, pero mantengo tu lógica personalizada
        return $this->rol && $this->rol->nombreRol === $role;
    }

=======
 
>>>>>>> origin/juana
    /**
     * Envía la notificación de restablecimiento de contraseña personalizada en español.
     */
    public function sendPasswordResetNotification($token): void
    {
        $this->notify(new \App\Notifications\ResetPasswordNotification($token));
    }
<<<<<<< HEAD

    public function planillas()
    {
        return $this->hasMany(Planilla::class, 'id_usuario');
    }

    public function guiasAsignadas()
    {
        return $this->hasMany(Guia::class, 'id_repartidor');
    }
=======
>>>>>>> origin/juana
}