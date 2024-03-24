<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserAddress extends Model
{
    /**
     * Soft Delete for don't lose data
     */
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     protected $fillable = [
        'id',
        'street', 
        'district', 
        'number', 
        'postal_code', 
        'user_city_id', 
        'user_state_id', 
        'user_id', 
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at','created_at','updated_at'];

    /**
     * Relation for user one to one.
     *
     * @var this
     */
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    /**
     * Relation for cities one to one.
     *
     * @var this
     */
    public function city()
    {
        return $this->hasOne(UserCity::class, 'id', 'user_city_id');
    }

    /**
     * Relation for user one to one.
     *
     * @var this
     */
    public function state()
    {
        return $this->hasOne(UserState::class, 'id', 'user_state_id');
    }
}
