<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Modules\Admin\Entities\Centre;
use App\Notifications\AccountCreated;
use App\Notifications\PasswordReseted;

class UsersController extends Controller
{

    public function index()
    {
        $users = User::whereDoesntHave('roles', function ($query) {
            $query->where('name', 'Client');
        })->get();

        return view('users.index', compact('users'));
    }

    public function createUser()
    {
        return view('users.create');
    }

    public function show(User $user)
    {
       

        return view('users.show', compact('user'));
    }

    public function create()
    {
        //check permissions
        $auth_user = Auth::user();
        if(!$auth_user->hasAnyPermission(['create users'])) {
            abort(403);
        }

        $user = new User;
        $centres = Centre::all();

        $roles = Role::all();
        if(!$auth_user->hasAnyRole(['Super Admin'])){
            $roles = $roles->whereNotIn('id',2); //remove Super Admin role to prevent permission escalatoin
        }

        $temp_password = User::random_password();
        return view('users.create',compact('user','roles','temp_password','centres'));
    }

    public function store(Request $request)
    {
        //check permissions
        $auth_user = Auth::user();
        if(!$auth_user->hasAnyPermission(['create users'])) {
            abort(403);
        }

        $validated_data = $request->validate(
            [
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email|unique:users',
                'phone' => 'required|min:8',
                'roles' => 'required',
                'password' => 'required'
            ]
        );

        $random_password = $request['password']; //User::random_password();

        $new_user = User::create([
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'email' => $request['email'],
            'password' => Hash::make($random_password),
            'phone' => $request['phone'],
            'creator_id' => $auth_user->id,
        ]);

        if($auth_user->hasAnyRole(['Super Admin']) && $request['roles']) {
            $new_user->syncRoles($request['roles']);
        } elseif(in_array('Super Admin',$request['roles'])) {
            return back()->with('warning','Only super admin users can assign these roles');
        } else {
            $new_user->syncRoles($request['roles']);
        }

        $new_user->notify(new AccountCreated($new_user, $random_password, $auth_user));

        return redirect('/users')->with('success','User Created and invited through an email');
    }

    public function edit(User $user)
    {
        // check permissions
        $auth_user = Auth::user();
        if($user->id != $auth_user->id && !$auth_user->hasAnyPermission(['edit users'])) {
            abort(403);
        }

        $roles = Role::all();
        if(!$auth_user->hasAnyRole(['Super Admin'])){
            $roles = $roles->whereNotIn('id',2); //remove Super Admin role to prevent permission escalatoin
        }

        foreach($roles as $role) {
            if($user->hasAnyRole([$role])) {
                $role->selected = true;
            }
        }
        
        return view('users.edit', compact('user','roles'));
    }

    public function update(Request $request, User $user)
    {
        $auth_user = Auth::user();
        //check permissions
        if($user->id != $auth_user->id && !$auth_user->hasAnyPermission(['edit users'])) {
            abort(403);
        }

        $validated_data = $request->validate(
            [
                'first_name' => 'required',
                'last_name' => 'required',
                'phone' => 'required',
                'roles' => 'sometimes'
            ]
        );

        //update the table entry
        $user->update($validated_data);

        //only the super admin can update roles
        if($auth_user->hasAnyRole(['Super Admin']) && $request['roles']) {
            $user->syncRoles($request['roles']);
        } elseif(in_array('Super Admin', $request->filled('roles') ? $request['roles'] : [])) {
            return back()->with('warning','Only super admin users can assign these roles');
        } 

        $user->save();

        //redirect based on who's profile was updated
        if($user->id == Auth::user()->id) {
            return redirect('/users')->with('success','Profile updated');
        } else {
            return redirect('/users')->with('success','User ('.$user->first_name.' '.$user->last_name.') updated');
        }
    }

    public function adminResetPassword(User $user)
    {
        $auth_user = Auth::user();

        if($auth_user->hasAnyRole(['Super Admin'])) {

            $random_password = User::random_password();

            $user->update([
                'password' => Hash::make($random_password),
            ]);

            $user->pw_reset_required = 0; //not mass assignable
            $user->save();

            $user->notify(new PasswordReseted($user, $random_password));

            return redirect('/users')->with('success','Password reseted');
        }
        else {
            abort(403);
        }
    }

    public function toggleActivation(User $user)
    {
        $authorised_user = Auth::user();
        if(!$authorised_user->hasAnyPermission(['activate users'])) {
            return redirect('/users')->with('warning','You do not have permission');
        }

        $user->is_active = !$user->is_active;
        $user->save();

        return redirect('/users')->with('success','User updated.');
    }
}
