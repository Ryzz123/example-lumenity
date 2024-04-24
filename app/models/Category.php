<?php

namespace Lumenity\Framework\app\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property mixed $description
 * @property mixed $name
 * @method static find(int $id)
 */
class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = ['name', 'description'];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }
}
