<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Tag
 *
 * @package App\Model
 */
class Tag extends Model
{
    protected $hidden = ['created_at', 'updated_at'];

    protected $fillable = ['id', 'name', 'type', 'created_at', 'updated_at'];
}