<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Login Administrator</title>
    <link href="{{ asset('Assets/css/styles.css') }}" rel="stylesheet" />
    <link href="{{ asset('Assets/css/bootstrap.css') }}" rel="stylesheet" />

</head>

<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-bold my-4">Silahkan Masuk!</h3>
                                </div>
                                <div class="card-body">
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <strong>Whoops!</strong> Terjadi masalah.<br><br>
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <form method="POST" action="/login">
                                        @csrf
                                        <div class="form-group"><label class="small mb-1"
                                                for="inputEmailAddress">Username</label><input class="form-control py-4"
                                                id="inputEmailAddress" type="email" name="email"
                                                placeholder="Enter email address" /></div>
                                        <div class="form-group"><label class="small mb-1"
                                                for="inputPassword">Password</label><input class="form-control py-4"
                                                id="inputPassword" type="password" name="password"
                                                placeholder="Enter password" /></div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox"><input
                                                    class="custom-control-input" id="rememberPasswordCheck"
                                                    type="checkbox" /><label class="custom-control-label"
                                                    for="rememberPasswordCheck">Remember password</label></div>
                                        </div>
                                        <div
                                            class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <a class="small" href="password.html">Forgot Password?</a><input
                                                type="submit" class="btn btn-primary px-5" value="Login">
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center">
                                    <div class="small"><a href="register.html">Need an account? Sign up!</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Aplikasi Rental Mobil <?php echo date('Y'); ?></div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="{{ asset('Assets/js/scripts.js') }}"></script>
</body>

</html>
