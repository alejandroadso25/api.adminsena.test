<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    // Campos permitidos para guardar una imagen asociada a cualquier entidad.
    protected $fillable = [
        'imageable_id',
        'imageable_type',
        'path',
        'file_name',
        'original_name',
        'alt_text',
        'is_primary',
        'sort_order',
    ];

    // Convierte los valores booleanos y numéricos al tipado esperado.
    protected $casts = [
        'is_primary' => 'boolean',
        'sort_order' => 'integer',
    ];

    // Permite que la imagen pertenezca a cualquier entidad del sistema.
    public function imageable()
    {
        return $this->morphTo();
    }
}
