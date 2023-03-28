<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Book;

class Tag extends Model
{
    use HasFactory;
     /**
     * Many-to-Many Tags and Books
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function books()
    {
        return $this->belongsToMany(Book::class)->withTimestamps();
    }

    /**
     * Helper method to get all tags authors for displaying in a list of checkboxes
     * @return mixed
     */
    public static function getForCheckboxes()
    {
        return self::orderBy('name')->select(['name', 'id'])->get();
    }
}
