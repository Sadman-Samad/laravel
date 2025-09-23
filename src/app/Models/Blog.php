<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table = 'blogs';
    protected $fillable = ['title', 'content','image'];
    protected $hidden = ['created_at', 'updated_at'];




    // Blog belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Blog belongs to many categories
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
