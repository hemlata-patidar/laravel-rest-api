<?php
  namespace App\Models;

  use Illuminate\Database\Eloquent\Model;

  class Account extends Model
  {
    protected $primaryKey = 'account_id';

    protected $fillable = [
      'name',
      'status',
      'eni_enabled',
      'account_type',
      'enable_time_temp_log',
      'enable_eni_facts',
      'enable_cafe_cloning',
      'enable_station_price',
      'enable_station_note',
      'enable_cust_footer_logo',
      'cust_footer_logo',
      'access',
    ];

    public function locations()
    {
      return $this->hasMany(AccountLocation::class, 'account_id', 'account_id');
    }

    public function cafes()
    {
      return $this->hasMany(Cafe::class, 'account_id', 'account_id');
    }
}
