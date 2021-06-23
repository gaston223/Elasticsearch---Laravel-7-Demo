<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Artist extends Model
{
    use Searchable;
    const SEARCHABLE_FIELDS = ['id', 'name'];

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
        return 'artists_index';
    }

    // Define which fields to search
    public function toSearchableArray()
    {
         return $this->only(self::SEARCHABLE_FIELDS);
    }

}
