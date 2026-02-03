<?php
  namespace App\Models;

  use Illuminate\Database\Eloquent\Model;

  class Cafe extends Model
  {
    protected $primaryKey = 'cafe_id';

    protected $fillable = [
      'account_id',
      'location_id',
      'name',
      'status',
      'menu_type',
      'position',
      'is_default',
      'cost_center',
      'enable_feature_x',
    ];

    public function account()
    {
      return $this->belongsTo(Account::class, 'account_id', 'account_id');
    }

    public function location()
    {
      return $this->belongsTo(AccountLocation::class, 'location_id', 'location_id');
    }
  }
