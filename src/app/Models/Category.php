<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = ['name'];

    // Category belongs to many blogs
    public function blogs()
    {
        return $this->belongsToMany(Blog::class);
    }
}
