@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row">

            <div class="col-md-6">
                <h1>Lookin for a Job?</h1>
                <h3>Please create an account</h3>
                <img src="{{asset('image/register.jpg')}}" alt="">
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Register</div>
                    <form action="{{ route('store.seeker') }}" method="post">@csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Full name</label>
                                <input type="text" name="name" class="form-control">
                                @if($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="name">Email</label>
                                <input type="email" name="email" class="form-control">
                                @if($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="name">Password</label>
                                <input type="password" name="password" class="form-control">
                                @if($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>

                            <div class="form- mt-2">
                                <button type="submit" class="btn btn-primary">Register</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection