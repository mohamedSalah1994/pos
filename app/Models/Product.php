<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    use HasTranslations;
    public $translatable = ['name' , 'description'];
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class);

    }//end fo category
}
