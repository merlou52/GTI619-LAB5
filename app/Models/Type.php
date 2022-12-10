<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    /**
     * Links to Client model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function clients()

    {
        return $this
            ->belongsToMany('App\Models\Client')
            ->withTimestamps();
    }
}
