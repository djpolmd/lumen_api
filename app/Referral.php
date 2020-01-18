<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Referral extends Model
{
    protected $table = 'referral';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'parent_ID', 'child_ID', 'token_url'
    ];

}

