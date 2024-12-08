@extends('layout')
@section('title', 'login')
@section('content')

<!-- <div class="container">
    <div class="mt-5">
         -->

<!-- <div class="alert alert-success">{{session('success')}}</div> -->
<!-- </div>

</div> -->
<div class="loginBox">
    <h1>Login</h1>
    <form class="form">
        @csrf
        <div data-mdb-input-init class="form-outline mb-4">
            <label class="form-label" for="email">Email address</label>
            <input type="text" id="email" class="form-control" name="email" />
            <span class="text-danger" id="emailerr"></span>
        </div>

        <!-- Password input -->
        <div data-mdb-input-init class="form-outline mb-4">
            <label class="form-label" for="password">Password</label>
            <input type="password" id="password" class="form-control" name="password" />
            <span class="text-danger" id="passworderr"></span>
        </div>



        <!-- Submit button -->
        <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block mb-4"
            id="loginbtn">Sign
            in</button>
            <div class="link pb-3">
                <span>I Don't Have An Account <a href="{{route('register')}}">click</a></span>

            </div>
        <div id="loginAlert"></div>

    </form>
</div>

@endsection
@section('script')
<script>
    $(function () {
        function showError(name, message) {
            if (name == 'email' && name == 'password') {
                $('#emailerr').text(message)
                $('#emailerr').show()
                $('#passworderr').text(message)
                $('#passworderr').show()
            }
            else {
                if (name == 'email') {
                    $('#emailerr').text(message)
                    $('#emailerr').show()

                } else {
                    $('#passworderr').text(message)
                    $('#passworderr').show()
                }
            }
        }
        function showMessage(sty, message) {
            $('#loginAlert').html(`<p class=${sty} id='error'><b>${message}</b></p>`)

        }
        $('.form').submit(function (e) {
            e.preventDefault();
            $('#error').remove()
            $('#emailerr').hide()
            $('#passworderr').hide()
            $(`.form input[name='${name}']`).removeClass('error');

            let errors = true
            let email = $('#email').val().trim()
            let emailPattern = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i
            // console.log(email)
            if (email == "") {
                // console.log('mo')
                showError('email', 'Email is required!')
                errors = false
            } else {
                if (!emailPattern.test(email)) {
                    //  alert('not a valid e-mail address');
                    showError('email', 'Not a valid e-mail address!')
                    errors = false
                }

            }
            let password = $('#password').val().trim();
            let passwordPatten = /^.{6,}$/;

            if (password == "") {
                // console.log('mo')
                showError('password', 'password is required!')
                errors = false
            } else {
                if (!passwordPatten.test(password)) {
                    //  alert('not a valid e-mail address');
                    showError('password', 'Minimum 6 characters!')
                    errors = false
                }
            }

            if (errors) {
                // console.log('hia')
                var btn = $('#loginbtn');
                btn.prop('disabled', true);
                btn.text('Please wait...');
                $.ajax({
                    url: '{{route('login.post')}}',
                    method: 'post',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function (res) {
                        console.log(res)
                        btn.prop('disabled', false);
                        btn.text('Sign in');
                        if (res.status == 400) {
                            console.log(res.message, res.message.email)
                            if (res.message.email && res.message.password) {
                                showError('email', res.message.email)
                                showError('password', res.message.password)
                            }
                            else {
                                if (res.message.email) {
                                    showError('email', res.message.email)
                                } else if (res.message.password) {
                                    showError('password', res.message.password)
                                }
                            }
                        }
                        else if (res.status == 401) {
                            console.log(res.message)
                            showMessage('text-danger', res.message)
                        }
                        else {
                            if (res.status == 200 && res.message == "success") {
                                window.location = '{{route('dashboard')}}'
                            }

                        }
                    }
                })
            }
            
        })
    })

</script>

@endsection