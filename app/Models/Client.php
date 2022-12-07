<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $fillable = ['first_name', 'last_name'];


    public function client_type($type){
        if ($this->types()->where('name', $type)->first()) {
            return true;
        }
        return false;
    }


    public function types()

    {
        return $this
            ->belongsToMany('App\Models\Type')
            ->withTimestamps();
    }
}
