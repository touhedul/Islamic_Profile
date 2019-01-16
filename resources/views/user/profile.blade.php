@extends('layouts.user')
@section('title')
    {{ Auth::user()->name }}
@endsection


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Profile</div>
                <div class="card-body">
                    <form class="" method="post" action="{{route('user.update',str_random(20))}}" enctype="multipart/form-data">
                        @method('PATCH')
                        @csrf
                        <label>Profile Image</label><br>
                        @if($userProfile->image)
                        <p style="text-align: center">
                            <img align="middle" height="200px" width="180px"
                                 src="{{asset('profile_images/'.$userProfile->image)}}"/><br>
                        </p>
                        @else
                            <p style="text-align: center">
                            <img align="middle" height="200px" width="180px"
                                 src="{{asset('profile_images/default.jpg')}}"/><br>
                        </p>
                        @endif
                        <input type="file" name="image"/>
                        <br><br>
                        <div class="form-group">
                            <label for="name" class="cols-sm-2 control-label"> Name</label>
                            <input type="text" class="form-control" name="name" id="name"
                                   value="{{$user->name}}"/>
                        </div>
                        <div class="form-group">
                            <label for="email" class="cols-sm-2 control-label">Gender</label>
                            <select name="gender" id="gender" class="form-control">
                                <option class="form-control" value="">Select Gender</option>
                                <option class="form-control" @if($userProfile->gender == "male") selected
                                        @endif value="male">Male
                                </option>
                                <option class="form-control" @if($userProfile->gender == "female") selected
                                        @endif value="female">Female
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name" class="cols-sm-2 control-label">About you</label>
                            <textarea rows="5" cols="20" type="text" class="form-control" name="details"
                                      id="details">{{$userProfile->details}} </textarea>
                        </div>
                        <div class="form-group">
                            <label for="name" class="cols-sm-2 control-label">Division</label>
                            <input type="text" value="{{$userProfile->division}}" class="form-control"
                                   name="division" id="division"/>
                        </div>
                        <div class="form-group">
                            <label for="name" class="cols-sm-2 control-label">Address</label>
                            <input type="text" value="{{$userProfile->address}}" class="form-control" name="address"
                                   id="address"/>
                        </div>
                        <div class="form-group">
                            <label for="name" class="cols-sm-2 control-label">Contact</label>
                            <input type="text" value="{{$userProfile->contact}}" class="form-control" name="contact"
                                   id="contact"/>
                        </div>
                        <div class="form-group">
                            <label for="name" class="cols-sm-2 control-label">Education</label>
                            <input type="text" value="{{$userProfile->education}}" class="form-control"
                                   name="education" id="education"/>
                        </div>
                        <div class="form-group">
                            <label for="name" class="cols-sm-2 control-label">Date Of Birth</label>
                            <input type="date" value="{{$userProfile->dob}}" class="form-control" name="dob"
                                   id="dob"/>
                        </div>
                        <div class="form-group ">
                            <button type="submit" class="btn btn-primary btn-lg btn-block login-button">Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
