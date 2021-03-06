<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
// added for Billing service Stripe :
use Laravel\Cashier\Billable;

class User extends Authenticatable
{
    // added for Billing service (Laravel/Cashier)
    use Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
