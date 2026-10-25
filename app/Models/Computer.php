<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Computer extends Model
{
    use HasFactory;

    // Campos habilitados para la asignación masiva del CRUD.
    protected $fillable = [
        'number',
        'brand',
    ];

    public function apprentices()
    {
        // Un computador puede estar asociado a varios aprendices.
        return $this->hasMany(Apprentice::class);
    }

        //
    // Imagen principal asociada al computador mediante la relación polimórfica.
    //
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable')->where('is_primary', true);
    }
}
