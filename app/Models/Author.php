<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory, HasUuids;

    protected $keyType = 'string';
    
    protected $table = "authors";
    protected $fillable = ['id', 'firstname', 'lastname'];

    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
