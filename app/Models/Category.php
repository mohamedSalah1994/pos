<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    use HasTranslations;
    public $translatable = ['name'];

    protected $fillable = ['name'];

    public function products()
    {
        return $this->hasMany(Product::class);

    }//end of products
}
