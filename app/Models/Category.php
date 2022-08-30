<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'category';

    protected $fillable = [
        'name',
        'parent_id',
    ];
    public function children(){
        return $this->hasMany(Category::class, 'parent_id','id');
    }
}
