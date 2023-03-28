<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Book;

class Author extends Model
{
    use HasFactory;

     /**
     * One to Many Author and Books
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function books()
    {
        # Author has many Books
        # Define a one-to-many relationship.
        return $this->hasMany(Book::class);
    }

    /**
     * Helper method to get all the authors for displaying in a dropdown
     * @return mixed
     */
    public static function getForDropdown()
    {
        return self::orderBy('last_name')->select(['first_name', 'last_name', 'id'])->get();
    }

    /**
     * @return string
     */
    public function getFullName() {
        return $this->first_name.' '.$this->last_name;
    }
}
