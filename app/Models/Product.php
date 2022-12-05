<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'product';

    protected $primaryKey = 'prod_code';

    public $incrementing = false;

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    protected $guarded = ['prod_code'];

    protected $casts = [
        'created_at' => 'datetime:d F Y - H:i',
        'updated_at' => 'datetime:d F Y - H:i'
    ];

    public function transDetail()
    {
        return $this->hasOne(Product::class, 'prod_code', 'prod_code');
    }
}
