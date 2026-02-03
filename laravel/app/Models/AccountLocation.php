<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccountLocation extends Model
{
    protected $primaryKey = 'location_id';

    protected $fillable = [
        'account_id',
        'name',
        'status',
        'county',
        'access',
        'created_by',
    ];

    public function account()
    {
        return $this->belongsTo(Account::class, 'account_id', 'account_id');
    }

    public function cafes()
    {
        return $this->hasMany(Cafe::class, 'location_id', 'location_id');
    }
}
