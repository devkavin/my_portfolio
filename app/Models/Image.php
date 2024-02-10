<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['project_id', 'url', 'caption'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
