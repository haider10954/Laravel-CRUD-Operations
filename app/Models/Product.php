<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'image' => 'array',
    ];

    public function getThumbnail()
    {
        return asset('storage/product_thumbnail/'.$this->thumbnail);
    }

    public static function boot()
    {
        parent::boot();
        
        self::creating(function($product){
            $check = Product::where('slug',str()->slug($product->name))->count();
            if($check < 1)
            {
                $product->slug = str()->slug($product->name);
            }
        });

        self::created(function($product){
            if(empty($product->slug))
            {
                $product->slug = str()->slug($product->name).'-'.$product->id;  
                $product->save(); 
            }
        });

        self::updating(function($product){
            $check = Product::where('slug',str()->slug($product->name))->count();
            if($check < 1)
            {
                $product->slug = str()->slug($product->name);
            }
        });

        self::updated(function($product){
            if(empty($product->slug))
            {
                $product->slug = str()->slug($product->name).'-'.$product->id;  
                $product->save(); 
            }
        });

    }

    public function getCategory()
    {
        return $this->belongsTo(Category::class,'category');
    }

}
