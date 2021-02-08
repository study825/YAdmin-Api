<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Job
 *
 * @package App\Model
 */
class Job extends Model
{
    protected $hidden = ['created_at', 'updated_at'];

    public function company()
    {
       return $this->hasOne(Company::class, 'id', 'company_id');
    }

}