<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Company
 *
 * @package App\Model
 */
class Company extends Model
{
    protected $hidden = ['created_at', 'updated_at'];

    public function images()
    {
        return $this->hasMany(Image::class, 'company_id');
    }
}