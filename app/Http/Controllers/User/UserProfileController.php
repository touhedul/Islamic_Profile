<?php

namespace App\Http\Controllers\User;

use App\Helpers\UserHelper;
use App\Models\User\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use File;

class UserProfileController extends Controller
{
    public function __construct()
    {
        UserHelper::middleware($this);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $salat = UserHelper::getUser();
        return view('user.index',compact('salat'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail(Auth::id());
        $userProfile = UserProfile::where('user_id', Auth::id())->first();
        return view('user.profile', compact('user', 'userProfile'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'gender' => 'nullable | max:6',
            'details' => 'nullable | max:255',
            'division' => 'nullable | max:255',
            'address' => 'nullable | max:255',
            'contact' => 'nullable | max:20',
            'education' => 'nullable | max:255',
            'dob' => 'nullable | date',
            'image' => 'nullable | image'
        ]);

        $user = User::findOrFail(Auth::id());
        $user->name = $request->name;
        $user->save();

//User Profile Update
        $userProfile = UserProfile::where('user_id', Auth::id())->first();
        $userProfile->gender = $request->gender;
        $userProfile->details = $request->details;
        $userProfile->division = $request->division;
        $userProfile->address = $request->address;
        $userProfile->contact = $request->contact;
        $userProfile->education = $request->education;
        $userProfile->dob = $request->dob;

        //saving image
        if ($request->hasFile('image')) {
            File::delete('profile_images/'.$userProfile->image);//delete the previous storage image
            $img = $request->file('image');
            $imageName = rand() . '.' . $img->getClientOriginalExtension();
            $img->move(public_path("profile_images"), $imageName);

        }else{
            $imageName = $userProfile->image;
        }
        $userProfile->image = $imageName;
        $userProfile->save();
        return back()->with('success', 'Profile Update Successful');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
