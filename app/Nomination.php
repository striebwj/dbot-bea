<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nomination extends Model
{
    protected $fillable = [
      'business_name',
      'first_name',
      'last_name',
      'in_dufferin',
      'is_member',
      'nomination',
      'years_in_business',
      'full_time_employees',
      'is_non_profit',
      'is_for_profit',
      'five_years',
      'under_40',
      'is_member',
      'confirmation_employees_10',
      'confirmation_employees_under_10',
    ];
}
