<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    use HasFactory;

    protected $table = 'transaction_detail';

    protected $primaryKey = 'id';

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    protected $guarded = ['id'];

    protected $casts = [
        'created_at' => 'datetime:d F Y - H:i',
        'updated_at' => 'datetime:d F Y - H:i'
    ];

    public function header()
    {
        return $this->belongsTo(TransactionHeader::class, 'doc_number', 'doc_number');
    }

    public function product()
    {
        return $this->hasOne(Product::class, 'prod_code', 'prod_code');
    }
}
