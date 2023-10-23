<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Auth\MustVerifyEmail;



class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public static function getPermissionGroups(){

        $permission_groups = DB::table('permissions')->select('group_name')->groupBy('group_name')->get();
        return $permission_groups;
    }// End Method   
    
    public static function getPermissionByGroupName($group_name){

        $permissions = DB::table('permissions')
                        ->select('name','id')
                        ->where('group_name',$group_name)
                        ->get();

        return $permissions;
    }// End Method   

    public static function roleHasPermissions($role,$permissions){

        $hasPermission = true;
        foreach($permissions as $permission){
            if(!$role->hasPermissionTo($permission->name)){
                $hasPermission = false;
            }
            return $hasPermission;
        }
    }

    public function approvals()
    {
        return $this->hasMany(Approval::class, 'user_id');
    }

    public function directorPermission($id)
    {
    return DB::table('model_has_roles')
        ->select('model_has_roles.*', 'roles.*')
        ->leftJoin('roles', 'roles.id', '=', 'model_has_roles.role_id')
        ->where('name', 'PENGARAH PISM')
        ->where('model_id', $id)
        ->get();
    }

    //get user from table Users by role
    public function getUsersWithRole($roleName)
    {
        return $this->select('users.id', 'users.name')
            ->join('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
            ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
            ->where('roles.name', '=', $roleName)
            ->get();
    }
}
