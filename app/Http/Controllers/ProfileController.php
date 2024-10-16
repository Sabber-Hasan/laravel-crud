<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $data = Profile::all();
        return view('crud.index', ['profiles' => $data]);
    }

    public function create()
    {
        return view('crud.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:profiles',
            'profile' => 'nullable|mimes:jpg,png|max:2048',
        ]);

        $profile = new Profile();
        $profile->name = $validated['name'];
        $profile->email = $validated['email'];

        if ($request->hasFile('profile')) {
            $profile->profile = $request->file('profile')->store('profile_pic', 'public');  // Store file in the 'public' disk
        }
        

        $profile->save();

        return redirect()->route('home')->with('success', 'Profile created successfully!');
    }

    public function edit($id)
    {
        $profile = Profile::find($id);
        // dd($profile);
        return view('crud.edit', compact('profile'));
    }

    public function update(Request $request, Profile $profile)
    {
        dd($request->all());
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:profiles,email,' . $profile->id,
            'profile' => 'nullable|mimes:jpg,png|max:2048',
        ]);

        $profile->name = $validated['name'];
        $profile->email = $validated['email'];

        if ($request->hasFile('profile')) {
            // Delete the old profile picture if it exists
            if ($profile->profile) {
                Storage::delete('public/' . $profile->profile);
            }

            // Store the new profile picture
            $profile->profile = $request->file('profile')->store('profile_pic', 'public');
        }

        $profile->save();

        return redirect()->route('home')->with('success', 'Profile updated successfully!');
    }

    public function destroy(Profile $profile)
    {
        // Delete the profile picture if it exists
        if ($profile->profile) {
            Storage::delete('public/' . $profile->profile);
        }

        // Delete the profile from the database
        $profile->delete();

        return redirect()->route('home')->with('success', 'Profile deleted successfully!');
    }
}
