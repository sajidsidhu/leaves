<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }
    public function editUser($id): View
    {
        return view('profile.update', [
            'user' => User::find($id),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }
   
    /**
     * Update the user's profile information.
     */
    public function UpdateUser(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = User::find($request->id);
        $user->fill($request->only(['name', 'type', 'active', 'phone', 'email']));
        if($request->password){
            $user->password = Hash::make($request->password);
        }
        $user->save();
        return Redirect::back()->with('success', "User has been updated");
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function users(){
        $users = User::where('id',"!=",Auth::id())->paginate(10);
        return view('profile.list',compact('users'));
    }

    public function updateStatus($id,$status){
        User::where('id',$id)->update(['active'=>$status]);
        return redirect()->back()->with("success","User has been ".( $status ? "Activate" : "Deactivate" ));
        
    }
}
