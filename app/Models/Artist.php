<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function punchlines()
    {
        return $this->hasMany('App\Models\Punchline');
    }
}
