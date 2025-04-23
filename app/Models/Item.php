<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_code',
        'inc',
        'item_type',
        'item_group',
        'uom',
        'denotation',
        'keyword',
        'description',
        'old_code',
        'cross_ref_1',
        'cross_ref_2',
        'cross_ref_3',
        'functional_location',
        'coa',
        'gl',
        'unit_price',
        'main_supplier',
        'storage_location',
        'max_stock_level',
        'reorder_point',
    ];

    public function selectedByUsers()
    {
        return $this->belongsToMany(User::class, 'item_user')->withTimestamps();
    }


}
