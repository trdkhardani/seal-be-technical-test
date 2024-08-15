<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = ['project_id'];
    protected $primaryKey = 'project_id';

    public function task()
    {
        return $this->hasMany(Task::class, 'project_id');
    }
}
