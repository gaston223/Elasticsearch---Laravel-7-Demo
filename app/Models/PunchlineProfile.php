<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class PunchlineProfile extends Model
{

    /*
   |--------------------------------------------------------------------------
   | GLOBAL VARIABLES
   |--------------------------------------------------------------------------
   */

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'punchline_profile';

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];


    /**
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function punchline()
    {
        return $this->belongsTo('App\Models\Punchline');
    }

    /**
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
