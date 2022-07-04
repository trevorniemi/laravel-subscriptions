<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    use \Staudenmeir\EloquentHasManyDeep\HasRelationships;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'id',
        'name',
        'user_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'user_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [

    ];

    /**
     * Get the subscriptions for the company.
     */
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function customerSubscriptions()
    {
        return $this->hasManyThrough(CustomerSubscription::class, Subscription::class);
    }

    public function customers()
    {
        return $this->hasManyDeep(Customer::class, [CustomerSubscription::class, Subscription::class],[
           
            'subscription_id', 
            'company_id', 
            'id',
         ]);
    }
}
