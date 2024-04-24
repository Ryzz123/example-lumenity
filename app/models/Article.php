<?php

namespace Lumenity\Framework\app\models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'articles';

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}