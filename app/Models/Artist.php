<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Artist extends Model
{
    use Searchable;

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];
    protected $hidden = ['created_at', 'updated_at'];

    /**
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function punchlines()
    {
        return $this->hasMany('App\Models\Punchline');
    }

    public function searchableAs()
    {
        return 'artists';
    }

    // Define which fields to search
    public function toSearchableArray()
    {
        return [
            'user_name' => $this->name,  //user_name Prefix to distinguish. Because different tables may have the same fields. mysql The fields in are name,email,created_at. stay es We store user_name，user_email,user_created_at. It can be customized.
        ];
    }

}
