<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Đăng nhập</title>

    <!-- Custom fonts for this template-->
    <link href="{{asset("assets")}}/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset("assets")}}/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="" style="background: #09844a">
    <div class="container mt-5">
        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-lg-6 mt-5">

                <div class="card o-hidden border-0 shadow-lg mt-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Bạn hãy tạo mật khẩu mới!</h1>
                                    </div>
                                    <form class="user" method="POST" action="">
                                        @csrf
                                        <div class="form-group">
                                            <label for="">Mật khẩu:</label>
                                            <input type="password" class="form-control" id="exampleInputPassword" name="password" placeholder="Mật Khẩu">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Xác nhận mật khẩu:</label>
                                            <input type="password" class="form-control" id="exampleInputPassword" name="password" placeholder="Mật Khẩu">
                                        </div>
                                        <div class=" py-3">
                                            <button type="submit" class="btn btn-success btn-block">Gửi</button>
                                        </div>
                                        
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{asset("assets")}}/vendor/jquery/jquery.min.js"></script>
    <script src="{{asset("assets")}}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset("assets")}}/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>