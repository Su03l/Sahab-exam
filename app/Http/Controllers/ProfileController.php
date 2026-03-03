<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    // profile edit
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    // profile update
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // validate request
        $request->user()->fill($request->validated());

        // check if email is dirty
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        // save user
        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    // profile delete
    public function destroy(Request $request): RedirectResponse
    {
        // validate request
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        // get user
        $user = $request->user();

        // logout user
        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
