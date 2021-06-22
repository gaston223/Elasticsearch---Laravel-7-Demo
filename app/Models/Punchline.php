<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Punchline extends Model
{
    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    //protected $appends = ['table_name'];

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

    public function getTableNameAttribute()
    {
        return 'punchline';
    }
}
