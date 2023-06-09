<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descripcion',
        'imagen',
        'user_id'
    ];

    public function user()
    {
        // Se agrega 'select' para especificar que campos queremos traer, sino se traerá todo los campos del registro
        return $this->belongsTo(User::class)->select([
            'name',
            'username'
        ]);
    }

    public function comentarios()
    {
        return $this->hasMany(Comentario::class)->latest();
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function checkLike(User $user)
    {
        return $this->likes->contains('user_id', $user->id);
    }
}
