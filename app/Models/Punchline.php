<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Punchline extends Model
{
    use Searchable;
    const SEARCHABLE_FIELDS = ['id', 'description'];
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
        return 'punchlines_index';
    }

    // Define which fields to search
    public function toSearchableArray()
    {
        return $this->only(self::SEARCHABLE_FIELDS);
    }

    public function getIsValidated(): int
    {
        return $this->is_validated;
    }


    /**
     * @param int $isValidated
     */
    public function setIsValidated(int $isValidated)
    {
        $this->is_validated = $isValidated;
    }

    /**
     * @param int $artistId
     */
    public function setArtistId(int $artistId)
    {
        $this->artist_id = $artistId;
    }

    /**
     * @param int $titleId
     */
    public function setTitleId(int $titleId)
    {
        $this->title_id = $titleId;
    }

}
