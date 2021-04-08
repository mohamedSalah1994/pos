<?php

namespace App\Models;

use App\Models\Order;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use HasFactory;
    use HasTranslations;
    public $translatable = ['name' , 'address'];

    protected $guarded = [];

    public function orders()
    {
        return $this->hasMany(Order::class);

    }//end of orders
}
