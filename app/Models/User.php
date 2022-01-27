<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

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
    ];

    public function getDataId($id)
    {
        return User::findorFail($id);
    }


    // public function changeAdminSettings(Request $request)
    // {
    //     $admin = new User();
    //     $admin->name = $request->name;
    //     $admin->email = $request->email;
    //     // $admin->password = $request->password;
    //     if ($admin->save()) {
    //         echo "Data Has Been Updated !";
    //     } else {
    //         echo "Data Has Not Been Updated !";
    //     }
    // }
    public function getUsersData()
    {
        return User::all();
    }

    public function changeUserData(Request $request, $id)
    {
        $user =   $this->getDataId($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role_id = $request->role_id;
        if ($user->save()) {
            return "Data has been updated";
        } else {
            return "Data has not been updated";
        }
    }

    public function removeUser($id)
    {
        $user =  $this->getDataId($id);
        if ($user->delete()) {
            return "User has been deleted";
        } else {
            return "User has not been deleted";
        }
    }

    public function newUser(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role_id = $request->role_id;
        if ($user->save()) {
            return "User has been created";
        } else {
            return "User has not been created";
        }
    }

    public function blockUser(Request $request, $id)
    {
        $user = $this->getDataId($id);
        if ($user->is_blocked == 0) {
            $user->is_blocked = $request->is_blocked;
        } else if ($user->is_blocked == 1) {
            $user->is_blocked = $request->is_blocked;
        } else {
            $user->is_blocked == 0;
        }
        if ($user->save()) {
            return "success";
        } else {
            return "failed";
        }
    }
}
