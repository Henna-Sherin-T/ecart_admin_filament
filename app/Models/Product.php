<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Category; 
use App\Models\Tag;

class Product extends Model
{
    use HasFactory;
    public $guarded=[];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function category(){
       return $this->belongsTo(Category::class);
    }
    public function tags(){
        return $this->belongsToMany(Tag::class);
    }
}
