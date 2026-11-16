<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    // Lihat + ubah profile sendiri
    public function edit(Request $request)
    {
        $user = $request->user()->load('profile', 'role');

        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = $request->user();

        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => ['required', 'email', Rule::unique('users', 'email')->ignore($user->id)],
            'password' => 'nullable|string|min:6|confirmed',
            'umur'     => 'required|integer|min:0|max:150',
            'alamat'   => 'nullable|string',
            'bio'      => 'nullable|string',
        ]);

        $user->name  = $data['name'];
        $user->email = $data['email'];
        if (! empty($data['password'])) {
            $user->password = $data['password'];
        }
        $user->save();

        $profile = $user->profile ?? new Profile();
        $profile->fill([
            'umur'   => $data['umur'],
            'alamat' => $data['alamat'] ?? '',
            'bio'    => $data['bio'] ?? '',
        ])->save();

        if (! $user->profile_id) {
            $user->profile_id = $profile->id;
            $user->save();
        }

        return redirect()->route('profile.edit')->with('success', 'Profile berhasil diperbarui.');
    }
}
