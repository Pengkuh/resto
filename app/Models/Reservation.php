<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    protected $table = "reservations";

    protected $fillable  = [
        'res_id',
        'res_name_user',
        'res_phone_user',
        'res_email_user',
        'res_total_visitor',
        'res_table_name',
        'res_table_price',
        'res_table_category',
        'res_product_name',
        'res_product_price',
        'res_product_category',
        'res_method_payment',
        'res_name_payment',
        'res_code_payment',
        'res_total',
        'res_status',
        'created_at',
        "updated_at"
    ];
}
