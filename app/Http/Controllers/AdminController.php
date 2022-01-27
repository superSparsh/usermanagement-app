<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    //

    public function adminSettings()
    {
        return view('backend.admin_settings');
    }

    // public function updateAdminSettings(Request $request)
    // {
    //     $admin = (new User())->changeAdminSettings($request);

    //     if ($admin) {
    //         return back()->with('update', 'Settings Has Been Updated');
    //     } else {
    //         return back()->with('error', 'Something Went Wrong');
    //     }
    // }
    public function getUsers()
    {
        $users = (new User())->getUsersData();

        if ($users) {
            return view('backend.users.index', compact("users"));
        } else {
            echo "Error In Loading";
        }
    }

    public function getEditUser($id)
    {
        $admin = (new User())->getDataId($id);
        // dump($admin);

        if ($admin) {
            return view('backend.users.edit', compact('admin'));
        } else {
            echo "Error";
        }
    }

    public function updateUserData(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required', 'string', 'max:255',
            'email' => 'required',
            'role_id' => 'required',
        ]);
        $user_update = (new User())->changeUserData($request, $id);

        if ($user_update) {
            return back()->with('update', 'Profile Updated Successfully');
        } else {
            return back()->with('error', 'Something went wrong');
        }
    }

    public function deleteUser($id)
    {
        $user_delete = (new User())->removeUser($id);
        if ($user_delete) {
            return redirect()->route('admin.users')->with('delete', 'User Deleted Successfully');
        } else {
            return redirect()->route('admin.users')->with('error', 'Something went wrong');
        }
    }

    public function addNewUser()
    {
        return view('backend.users.create');
    }

    public function createNewUser(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required', 'string', 'max:255',
            'email' => 'required', 'string', 'email', 'max:255', 'unique:users',
            'password' => 'required', 'string', 'min:8', 'confirmed',
            'role_id' => 'required'
        ]);
        $user_create = (new User())->newUser($request);
        if ($user_create) {
            return back()->with('new', 'New User Created Successfully');
        } else {
            return back()->with('error', 'Something went wrong');
        }
    }

    public function isUserBlock(Request $request, $id)
    {
        $user_block = (new User())->blockUser($request, $id);
        if ($user_block) {
            return redirect()->route('admin.users')->with('block', 'User Status Updated Successfully');
        } else {
            return redirect()->route('admin.users')->with('error', 'Something went wrong');
        }
    }
}
