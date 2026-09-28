<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // La parte pública del sistema solo reconoce aspirante y aprendiz.
    // El rol usuario queda como base institucional, pero no se presenta en el selector.
    public const ROLE_USUARIO = 'usuario';
    public const ROLE_ASPIRANTE = 'aspirante';
    public const ROLE_APRENDIZ = 'aprendiz';
    public const ROLE_ADMIN = 'admin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'last_name',
        'email',
        'address',
        'gender',
        'phone',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Inscripciones realizadas por el usuario.
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    /**
     * Devuelve los roles que el sistema reconoce para la parte pública y administrativa.
     */
    public static function availableRoles(): array
    {
        return [
            self::ROLE_USUARIO,
            self::ROLE_ASPIRANTE,
            self::ROLE_APRENDIZ,
            self::ROLE_ADMIN,
        ];
    }

}
