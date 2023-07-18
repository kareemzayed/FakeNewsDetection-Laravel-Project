<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\User;
use App\Models\Message;
use App\Models\Processes;
use App\Models\Social_Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\MessageRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\UpdatePasswordRequest;

class UserController extends Controller
{
    // Show user profile
    public function profile() {
        return view('profile.profile', [
            'user' => User::findOrFail(auth()->user()->id),
            'social_media' => User::find(auth()->user()->id)->social_media,
        ]);
    }

    // Show History of user
    public function ShowHistory() {
        return view('history', [
            'user' => User::findOrFail(auth()->user()->id),
        ]);
    }

    // Store user photo within the system
    public function StoreUserPhoto($photo) {
        $file_extention = $photo->getClientOriginalExtension();
        $file_name = time() . '.' . $file_extention;
        $path = 'Images/UserImages';
        $photo->move($path, $file_name);
        return $file_name;
    }

    // Update the information of the user
    public function updateInformation(UpdateProfileRequest $request) {
        $user = User::find(auth()->user()->id);
        $social_media = $user->social_media;
        $file_name = null;
        $oldDate = date_create($request->data_of_birth);
        $newDateFormat = date_format($oldDate,"Y-m-d");
        $user->forceFill([
            'name' => $request->name,
            'email' => $request->email,
            'jop_title' => $request->jop_title,
            'data_of_birth' => $newDateFormat,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'gender' => $request->gender,
        ])->save();
        if(isset($request->photo)) {
            $destination = 'Images/UserImages/' . $user->photo;
            if(File::exists($destination)) {
                File::delete($destination);
            }
            $file_name = $this->StoreUserPhoto($request->photo);
            $user->forceFill([
                'photo' => $file_name,
            ])->save();
        }
        if($social_media === null) {
            $social_media = Social_Media::create([
                'user_id' => $user->id,
            ]);
        }
        $social_media->forceFill([
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'linkedin' => $request->linkedin,
            'github' => $request->github,
            'instagram' => $request->instagram,
            'skype' => $request->skype,
        ])->save();
        return redirect()->back()->with('status', 'information-updated');
    }

    // Update password of the user
    public function UpdatePassword(UpdatePasswordRequest $request) {
        $user = Auth::user();
        if (!Auth::attempt(['email' => $user->email, 'password' => $request->password])) {
            return redirect()->back()->withErrors(['password' => 'The current password is incorrect'])
                ->withInput(['tab' => 'updatePassword']);
        }
        elseif($request->newPassword !== $request->confirmPassword) {
            return redirect()->back()->withErrors(['confirmPassword' => 'the confirm password does\'nt match with new password'])
                ->withInput(['tab' => 'updatePassword']);
        }
        else {
            $user->password = Hash::make($request->newPassword);
            $user->save();
            return redirect()->back()->with('status', 'password-updated');
        }
    }

    // Delete user process
    public function DeleteProcess($id) {
        $process = Processes::findOrFail($id);
        $process->delete();
        return redirect()->back()->with('status', 'process-deleted');
    }

    // User can send messages to admins of the systems
    public function SendMessgae(MessageRequest $request) {
        $user_id = Auth::user()->id;
        $message = Message::create([
            'user_id' => $user_id,
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);
        return redirect('home#contact')->with('status', 'Message-sent');
    }

}
