@extends('layout')
@section('title','Login')
@section('content')
  <div class="box1">
  <div class="mt-5">
                <!-- handles errors for laravel -->
            @if($errors->any())
                <div class="col-12">
                    @foreach($errors->all() as $error)
                     <!-- to print the error message -->
                     <div class="alert alert-danger">{{$error}} </div>
                     @endforeach
                </div>
            @endif
                    <!-- handles our errors -->
                    @if(session()->has('error'))
                    <!-- to print the error message -->
                    <div class="alert alert-danger">{{session('error')}}</div>
                    @endif

                    @if(session()->has('success'))
                    <div class="alert alert-success">{{session('success')}}</div>
                    @endif

            </div>
  <form action="{{route('login.post')}}" method="POST" class="ms-auto me-auto mt-3" style="width: 500px">
  <!-- add a token to validate login from your own website -->
    @csrf <!-- laravel will verify this token -->
  <div class="mb-3">
    <label class="form-label">Email address</label>
    <input type="email" class="form-control" name="email" >
    
  <div class="mb-3">
    <label  class="form-label">Password</label>
    <input type="password" class="form-control" name="password">
  </div>
  
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
  </div>
@endsection