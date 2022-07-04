<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    use \Staudenmeir\EloquentHasManyDeep\HasRelationships;

    protected $guarded = [];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [];

    /**
     * Get the subscriptions for the customer.
     */
    public function customerSubscriptions()
    {
        return $this->hasMany(CustomerSubscription::class);
    }

    public function company() {
        return $this->hasManyDeep(Company::class, [Subscription::class, CustomerSubscription::class],[
            'company_id', 
            'subscription_id', 
            'id',
         ]);
    }
}
