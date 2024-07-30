<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory, HasUuids;

    protected $keyType = 'string';
    
    protected $table = "books";
    protected $fillable = ["id", "title", "page_count", "publish_date", "author_id"];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function issuedBooks()
    {
        return $this->hasMany(issueBook::class);
    }
}
