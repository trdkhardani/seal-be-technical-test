<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = ['position_id'];
    protected $primaryKey = 'position_id';

    public function user()
    {
        return $this->hasMany(User::class, 'position_id');
    }
}
