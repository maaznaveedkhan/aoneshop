<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ZipCode extends Model
{
    use HasFactory;

   /**
    * Get all of the products for the ZipCode
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
   public function products()
   {
       return $this->belongsToMany(Product::class , 'code_product_zip', 'zip_code_id', 'product_id');
   }
}
