<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Tarea
 *
 * @property $id
 * @property $nombre
 * @property $estado
 * @property $prioridad
 * @property $proyecto_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Proyecto $proyecto
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Tarea extends Model
{

    protected $perPage = 10;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['nombre', 'estado', 'prioridad', 'proyecto_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function proyecto()
    {
        return $this->belongsTo(\App\Models\Proyecto::class, 'proyecto_id', 'id');
    }

    /**
     * Obtiene el icono del estado de la tarea
     * @return string
     */
    public function iconoEstado()
    {
        $iconoEstado = match ($this->estado) {
            'Pendiente' => '<i class="far fa-clock" style="color: #0d6efd"></i>',
            'Completada' => '<i class="far fa-check-circle" style="color: #198754"></i>',
            'En progreso' => '<i class="fa fa-spinner" style="color: #4CAF50"></i>',
            default => '',
        };

        return $iconoEstado;
    }

    /**
     * Obtiene el color de la prioridad de la tarea
     * @return string
     */
    public function colorPrioridad()
    {
        $colorPrioridad = match ($this->prioridad) {
            'Media' => 'text-warning',
            'Alta' => 'text-danger',
            'Baja' => 'text-success',
            default => '', // Valor por defecto si no coincide con ningún caso
        };

        return $colorPrioridad;
    }
}
