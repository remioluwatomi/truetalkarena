<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory;

    protected $table = 'admins';
    protected $guarded = array();

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'adm_firstname', 'adm_lastname', 'adm_email', 'adm_password', 'adm_tel', 'adm_level', 'adm_title', 'adm_dp', 'adm_bio', 'adm_status', 'adm_facebook', 'adm_github', 'adm_linkedin', 'remember_token'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'adm_password',
    ];
    public function setPasswordAttribute($password)
    {
        $this->attributes['adm_password'] = bcrypt($password);
    }
}
