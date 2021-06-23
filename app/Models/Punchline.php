<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Punchline extends Model
{
    use Searchable;
    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];
    protected $hidden = ['is_validated', 'created_at', 'updated_at'];


    /*
  |--------------------------------------------------------------------------
  | RELATIONS
  |--------------------------------------------------------------------------
  */

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function artist()
    {
        return $this->belongsTo('App\Models\Artist');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function title()
    {
        return $this->belongsTo('App\Models\Title');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany('App\Models\Punchline', 'punchline_id', 'user_id')
            ->withTimestamps()
            ->withPivot(['position']);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function punchline_profile()
    {
        return $this->hasMany('App\Models\PunchlineProfile');
    }

    /**
     * Scope a query to only include published videos.
     */
    public function scopePublished($query)
    {
        return $query->whereNotNull($query->qualifyColumn('created_at'));
    }

    public function searchableAs()
    {
        return 'punchlines';
    }

    // Define which fields to search
    public function toSearchableArray()
    {
        return [
            'user_description' => $this->description,  //user_name Prefix to distinguish. Because different tables may have the same fields. mysql The fields in are name,email,created_at. stay es We store user_name，user_email,user_created_at. It can be customized.
        ];
    }
}
