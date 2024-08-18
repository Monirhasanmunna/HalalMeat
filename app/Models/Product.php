<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    
    use HasFactory;

    protected $fillable = [
        'id', 
        'name', 
        'category_id', 
        'brand_id', 
        'unit_id', 
        'tax_id', 
        'status',
        'barcode',
        'barcode_path',
    ];


    protected $appends = ['barcodeImg'];


    public function getBarcodeImgAttribute()
    {
        return asset('storage/'.$this->barcode_path);
    }


    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'like', '%' . $search . '%')
                     ->orWhere('barcode', 'like', '%' . $search . '%');
    }
    
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function tax()
    {
        return $this->belongsTo(Tax::class);
    }

    public function details()
    {
        return $this->hasOne(ProductDetails::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
}
