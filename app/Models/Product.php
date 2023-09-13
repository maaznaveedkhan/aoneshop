<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id', 'product_id', 'quantity', 'price'
    ];

    // public function product()
    // {
    //     return $this->belongsTo(Product::class, 'product_id');
    // }

    /**
     * The zipcodes that belong to the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function zip_codes()
    {
        return $this->belongsToMany(ZipCode::class, 'code_product_zip', 'product_id', 'zip_code_id');
    }


}
