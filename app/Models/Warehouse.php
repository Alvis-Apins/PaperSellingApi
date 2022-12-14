<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Warehouse extends Model
{
    use HasFactory;

    protected $fillable = ['item', 'type', 'price', 'description', 'amount'];

    public function sale(): BelongsToMany
    {
        return $this->belongsToMany(Sale::class, 'sale_warehouse');
    }
}
