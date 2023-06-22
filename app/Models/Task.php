<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    /** Tabela representada pelo Model.
     * @var string
     */
    protected $table = 'tasks';

    /**
     * Campos que podem ser preenchidos.
     *
     * @var array<int, string>
     */
    protected $fillable = ['title','description','status',];

    /**
     * Muda a forma como os campos são exibidos.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'id' => 'integer',
        'status' => 'string',
    ];

}
