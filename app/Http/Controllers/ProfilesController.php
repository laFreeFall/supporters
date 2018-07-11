<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProfileRequest;
use App\Profile;
use App\User;
use Illuminate\Http\Request;

class ProfilesController extends Controller
{
    public function index(User $user)
    {
        $user->load('profile');

        return view('profile.index', compact('user'));
    }

    public function create()
    {
        $blankProfile = new Profile();

        return view('profile.create', compact('blankProfile'));
    }

    public function store(StoreProfileRequest $request)
    {
        /* Decided not to use avatars name equal to users ids because browser caches images
         * and if user changes his avatar, image name remains the same and browser displays
         * old cached one, only page reload with cache clearing as Ctrl+F5 solves the issue
        $avatarPath = $request->has('avatar') ? $request->file('avatar')->storeAs('images/avatars',
            auth()->id() . '.' .  $request->file('avatar')->getClientOriginalExtension(),
            'public') : null;
        */
        $avatarPath = $request->has('avatar') ? $request->file('avatar')->store('images/avatars','public') : null;

        // Have to manually list form fields because of 'avatar' one which contains instance of UploadedFile by default
        auth()->user()->profile()->create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'bio' => $request->bio,
            'avatar' => $avatarPath
        ]);

        return redirect(route('profile.index', ['user' => auth()->user()]));
    }

    public function edit()
    {
        return view('profile.edit');
    }

    public function update(Profile $profile, StoreProfileRequest $request)
    {
        /* Decided not to use avatars name equal to users ids because browser caches images
         * and if user changes his avatar, image name remains the same and browser displays
         * old cached one, only page reload with cache clearing as Ctrl+F5 solves the issue
        $avatarPath = $request->has('avatar') ? $request->file('avatar')->storeAs('images/avatars',
            auth()->id() . '.' .  $request->file('avatar')->getClientOriginalExtension(),
            'public') : null;
        */
        $avatarPath = $request->has('avatar') ? $request->file('avatar')->store('images/avatars','public') : null;

        // Have to manually list form fields because of 'avatar' one which contains instance of UploadedFile by default
        $profile->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'bio' => $request->bio,
            'avatar' => $avatarPath
        ]);

        return redirect(route('profile.index', ['user' => auth()->user()]));
    }
}
