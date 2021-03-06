<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Lumen\Auth\Authorizable;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use SoftDeletes;
    use Authenticatable, Authorizable, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_id',
        'company_id',
        'name',
        'email',
        'photo',
        'password'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'deleted_at',
    ];
    protected $table = 'user';
    public $timestamps = false;

    public function role(){
        return $this->belongsTo(Role::class);
    }

    public static function getValidationRules(){
        return [
            'user_name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'photo' => 'mimes:jpeg, png, bmp, webp',
        ];
    }
}
