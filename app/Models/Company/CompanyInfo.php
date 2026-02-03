<?php

namespace App\Models\Company;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyInfo extends Model
{
    use HasFactory;
    
    protected $table = 'company_infos';

    protected $fillable = [
      'name',
      'company',
      'email_1',
      'email_2',
      'phone_1',
      'phone_2',
      'address',
      'zip_code',
      'city_sr',
      'city_en',
      'country_sr',
      'country_en',
      'website',
      'tax_no',
      'company_no',
    ];
}
