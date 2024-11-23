<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = ['name', 'email'];

    public static function createMember($data)
    {
        return self::create([
            'name' => $data['name'],
            'email' => $data['email'],
        ]);
    }

    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
