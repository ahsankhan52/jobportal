@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @include('message')
                <div class="card shadow-lg">
                    <div class="card-header">Login</div>
                    <form action="{{ route('login.post') }}" method="post">@csrf
                        <div class="card-body">
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

                            <div class="form- mt-2 text-center">
                                <button type="submit" class="btn btn-primary">Login</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection