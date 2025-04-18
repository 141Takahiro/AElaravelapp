<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Comment extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'product_id', 'comment', 'review'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function prduct()
    {
        return $this->belongsTo(Product::class);
    }
}
