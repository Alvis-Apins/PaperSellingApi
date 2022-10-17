<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Partner extends Model
{
    use HasFactory;

    protected $fillable = ['company', 'work_field', 'company_size', 'phone', 'email', 'address'];

    public function sale(): HasMany
    {
        return $this->hasMany(Sale::class);
    }
}
