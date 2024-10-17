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
                <div class="card" id="card">
                    <div class="card-header">Register</div>
                    <form action="" method="post" id="registrationForm">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Full name</label>
                                <input type="text" name="name" class="form-control" required>
                                @if($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="name">Email</label>
                                <input type="email" name="email" class="form-control" required>
                                @if($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="name">Password</label>
                                <input type="password" name="password" class="form-control" required>
                                @if($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>

                            <div class="form- mt-2">
                                <button id="btnRegister" class="btn btn-primary">Register</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div id="message"></div>
            </div>
        </div>
    </div>
    <script>
        function S(elem){return document.querySelector(elem);}
        function SA(elem){return document.querySelectorAll(elem);}

        var url = "{{ route('store.employer') }}";
        S("#btnRegister").addEventListener('click', function(){
            const form = S('#registrationForm');
            const message = S('#message');
            const card = S('#card');
            message.innerHTML = '';

            var formData = new FormData(form);

            const button = event.target;
            button.disabled = true;
            button.innerHTML = 'Sending email...';

            fetch(url,{
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                },
                body:formData
            }).then(response => {
                if(response.ok){
                    return response.json();
                }else{
                    throw new Error('Error');
                }

            }).then(data => {
                // button.innerHTML = "Register"
                // button.disabled = false;
                message.innerHTML = `
                    <div class="alert alert-success">
                        Registration was successfull. please check your email to verify it.
                    </div>
                `;
                card.style.display = 'none';
            }).catch(error => {
                button.innerHTML = "Register"
                button.disabled = false;
                message.innerHTML = `
                    <div class="alert alert-danger">
                        Something went wront. please try again.
                    </div>
                `;
            });

        });
    </script>
@endsection