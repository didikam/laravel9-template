<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
   use HasFactory, SoftDeletes;

   protected $guarded = [
      'id',
      'created_at',
      'updated_at',
      'deleted_at',
   ];

   protected $hidden = [
      'created_at',
      'updated_at',
      'deleted_at',
   ];

   public function getImageAttribute($value)
   {
      if ($value) {
         $http = substr($value, 0, 4);
         if ($http == "http") {
            return $value;
         } else {
            return url('storage/' . $value);
         }
      } else {
         return url('no-image.jpg');
      }
   }
}
