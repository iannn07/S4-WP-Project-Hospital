<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function update(Request $request)
    {
        $user = User::find(auth()->user()->id);
        $user->name = $request->name;

        if ($user->avatar != null) {
            if ($request->hasFile('avatar')) {
                $imagePath = $request->file('avatar')->store('uploads', 'public');
                Storage::delete('uploads/' . $user->avatar);
                $user->avatar = $imagePath;
            }
        } else if ($request->hasFile('avatar')) {
            $imagePath = $request->file('avatar')->store('uploads', 'public');
            $user->avatar = $imagePath;
        } else if (is_null($user->avatar)) {
            // Handle case when there is no profile picture in the database
            $defaultImagePath = 'admin_assets/img/profile-img.png';
            $newImagePath = 'uploads/profile-img.png';
            File::copy($defaultImagePath, 'storage/' . $newImagePath);
            $user->avatar = $newImagePath;
        }

        $user->email = $request->email;
        $user->about = $request->about;
        $user->save();

        if (auth()->user()->role === 'Admin') {
            return redirect()->route('admin.profile');
        } else {
            return redirect()->route('doctor.profile');
        }
    }
}
