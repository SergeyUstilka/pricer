<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function category(){
        return $this->belongsTo(Category::class, 'cat_id');
    }
    public function photos(){
        return $this->hasMany(Photo::class, 'product_id', 'id');
    }
    public function mainPhoto(){
    }
    public function orders(){
        return $this->belongsToMany(Order::class,'order_products','product_id');
    }
    static function boot(){
        parent::boot();
        self::creating(function ($model){
            $model->slug = str_slug($model->name);
        });
        self::updating(function ($model){
            $model->slug = str_slug($model->name);
        });
    }
}
