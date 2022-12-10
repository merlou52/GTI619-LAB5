<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $fillable = ['first_name', 'last_name'];

    /**
     * Checkd if the current client has the specified type or not
     *
     * @param $type
     * @return bool
     */
    public function client_type($type){
        if ($this->types()->where('name', $type)->first()) {
            return true;
        }
        return false;
    }

    /**
     * Links to Type model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function types()

    {
        return $this
            ->belongsToMany('App\Models\Type')
            ->withTimestamps();
    }
}
