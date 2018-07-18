<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProfileRequest;
use App\Profile;
use App\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Instantiate a new ProfileController instance.
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show']]);
    }

    /**
     * Show the form for creating a new user profile.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('create', Profile::class);

        $blankProfile = new Profile();

        return view('profiles.create', compact('blankProfile'));
    }

    /**
     * Store a newly created user`s profile in storage.
     *
     * @param  StoreProfileRequest  $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(StoreProfileRequest $request)
    {
        $this->authorize('create', Profile::class);

        /* Decided not to use avatars name equal to users ids because browser caches images
         * and if user changes his avatar, image name remains the same and browser displays
         * old cached one, only page reload with cache clearing as Ctrl+F5 solves the issue
        $avatarPath = $request->has('avatar') ? $request->file('avatar')->storeAs('images/avatars',
            auth()->id() . '.' .  $request->file('avatar')->getClientOriginalExtension(),
            'public') : null;
        */
        $avatarPath = $request->has('avatar') ? $request->file('avatar')->store('images/avatars','public') : null;

        // Have to manually list form fields because of 'avatar' one which contains instance of UploadedFile by default
        $profile = auth()->user()->profile()->create([
            'username' => $request->username,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'bio' => $request->bio,
            'avatar' => $avatarPath
        ]);

        return redirect(route('profiles.show', ['profile' => $profile]))->with(
            'flash_body', 'Profile has been successfully created'
        );
    }

    /**
     * Display the specified user`s profile.
     *
     * @param  Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        $profile->load('user');

        return view('profiles.show', compact('profile'));
    }

    /**
     * Show the form for editing the authenticated user`s profile.
     *
     * @param  Profile  $profile
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Profile $profile)
    {
        $this->authorize('update', $profile);

        return view('profiles.edit', compact('profile'));
    }

    /**
     * Update the authenticated user`s profile in storage.
     *
     * @param  Profile  $profile
     * @param  StoreProfileRequest  $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Profile $profile, StoreProfileRequest $request)
    {
        $this->authorize('update', $profile);

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
            'username' => $request->username,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'bio' => $request->bio,
            'avatar' => $avatarPath
        ]);

        return redirect(route('profiles.show', ['profile' => $profile]))->with(
            'flash_body', 'Profile has been successfully updated'
        );
    }
}
