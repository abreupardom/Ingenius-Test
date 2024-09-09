<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Proyecto
 *
 * @property $id
 * @property $nombre
 * @property $descripcion
 * @property $archivado
 * @property $usuario_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Tarea[] $tareas
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Proyecto extends Model
{

    protected $perPage = 10;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['nombre', 'descripcion', 'archivado', 'usuario_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tareas()
    {
        return $this->hasMany(\App\Models\Tarea::class, 'id', 'proyecto_id');
    }

}
