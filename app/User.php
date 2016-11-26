<?php

namespace App;

use Backpack\PermissionManager\app\Models\Role;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Backpack\Base\app\Notifications\ResetPasswordNotification as ResetPasswordNotification;
use Backpack\CRUD\CrudTrait; // <------------------------------- this one
use Spatie\Permission\Traits\HasRoles;// <---------------------- and this one

class User extends Authenticatable
{
    use Notifiable;
    use CrudTrait; // <----- this
    use HasRoles; // <------ and this

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'first_name', 'last_name',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function projects()
    {
        return $this->hasMany('App\Models\Projects');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bids()
    {
        return $this->hasMany('App\Models\Bids');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany('App\Models\UserCats');
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        return $this->id($id)
            ->firstOrFail();
    }

    /**
     * @param $query
     * @param $id
     */
    public function scopeId($query, $id)
    {
        $query->where(['id'=>$id]);
    }

//    public function scopeAllFreelancers($query)
//    {
//        $query->join('posts', 'role_id', '=', 3)
//            ->select('users.*', );
//
//    }

//select * from Table1
//where not exists (select * from Table2 where Table2.ПолеA=Table1.ПолеA and Table2.ПолеB=Table1.ПолеB and .... Table2.ПолеX=Table1.ПолеX)
//union select * from Table2
//where not exists (select * from Table1 where Table2.ПолеA=Table1.ПолеA and Table2.ПолеB=Table1.ПолеB and .... Table2.ПолеX=Table1.ПолеX)



    /**
     * @return int
     */
    public function authorId()
    {
        return $this->id;
    }
    /**
     * @return string
     */
    public function getViewForActivity()
    {
        return 'activity.user';
    }
}
