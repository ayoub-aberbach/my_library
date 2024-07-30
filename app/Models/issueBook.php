<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class issueBook extends Model
{
    use HasFactory, HasUuids;

    protected $keyType = 'string';
    
    protected $table = 'issued_books';
    protected $fillable = ['id', 'book_id', "client", "issue_date", "return_date"];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
