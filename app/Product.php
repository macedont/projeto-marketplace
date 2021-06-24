<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $fillable = ['name', 'description', 'body', 'price', 'slug'];

    public function getNameProduct(): array{
        return ['nome' => 'macedo mulek doido'];
    }

    public function store(){
        return $this->belongsTo(Store::class);
    }

    public function categories(){
        return $this->belongsToMany(Category::class);
    }
}
