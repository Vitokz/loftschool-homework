<?php
namespace App\Model;
use \Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    protected $table='users';
    protected $fillable=array('Username','email','password', 'date');

   public static function getPasswordHash(string $password) : string
   {
       return md5($password . 'aabbcc55');
   }
}