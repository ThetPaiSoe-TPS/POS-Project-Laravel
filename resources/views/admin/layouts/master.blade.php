<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Solstice Market Admin Dashboard</title>

    <!-- Custom fonts for this template-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href=" {{ asset('admin/css/sb-admin-2.min.css') }} " rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css" integrity="sha512-dPXYcDub/aeb08c63jRq/k6GaKccl256JQy/AnOq7CAnEZ9FzSL9wSbcZkMp4R26vBsMLFYH4kQ67/bbV8XaCQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .function-icon{
            width: 160px;
        }
    </style>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('adminHome')}}">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Solstice Market</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="{{route('adminHome')}}"><i class="fas fa-fw fa-table"></i><span>Dashboard </span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href=" {{route('category#list')}} "><i class="fa-solid fa-circle-plus"></i></i><span>Category </span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{route('product#create')}}"><i class="fa-solid fa-plus"></i></i><span>Add Products </span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{route('product#list')}}"><i class="fa-solid fa-layer-group"></i><span>Product List </span></a>
            </li>



            @if (Auth::user()->role== 'superadmin')
            <li class="nav-item">
                <a class="nav-link" href="{{route('payment#list')}}"><i class="fa-solid fa-credit-card"></i></i><span>Payment Method </span></a>
            </li>
            @endif

            <li class="nav-item">
                <a class="nav-link" href="{{route('user#saleInfo')}}"><i class="fa-solid fa-circle-info"></i><span>Sale Information </span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{route('order#list')}}"><i class="fa-solid fa-cart-shopping"></i><span>Order Board </span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#"><i class="fa-solid fa-gear"></i></i><span>Setting </span></a>
            </li>

            <li class="nav-item">
                {{-- <a class="nav-link" href=""><i class="fa-solid fa-lock"></i></i></i><span>Change Password </span></a> --}}
                <a class="nav-link" href="{{route('profile#accountProfile#page')}}"><i class="fa-solid fa-lock"></i></i></i><span>Change Password </span></a>
            </li>

            <li class="nav-item">
                {{-- <a class="nav-link" href="#"></i><span>Logout </span></a> --}}
                <form action=" {{ route('logout') }} " method="POST">
                    @csrf
                    <span class="nav-link">
                        <button type="submit" class="btn bg-white text-primary"><i class="fa-solid fa-power-off text-primary"></i>Logout</button>
                    </span>
                </form>
            </li>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">


                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{-- <span class="mr-2 d-none d-lg-inline text-gray-600 small">  </span> --}}
                                <span class="mr-2 d-none d-lg-inline text-primary small"> {{Auth::user()->name}} </span>
                                {{-- <img class="img-profile rounded-circle" src=" "> --}}
                                <img class="img-profile rounded-circle" src=" {{asset(Auth::user()->profile== null?'admin/img/undraw_profile.svg': 'profile/'.Auth::user()->profile)}}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="">
                                <a class="dropdown-item" href="{{route('profile#accountProfile#page')}}">
                                    {{-- <i class="fa-solid fa-user-tie mr-2 text-gray-400"></i> --}}
                                    Profile
                                </a>
                                @if (Auth::user()->role== 'superadmin')
                                <a class="dropdown-item" href="">
                                <a class="dropdown-item" href="{{route('profile#createNewAdminAccount')}}">
                                    <i class="fa-solid fa-user-plus mr-2 text-gray-400"></i>
                                    New Admin
                                </a>
                                @endif

                                @if (Auth::user()->role== 'superadmin')
                                <a class="dropdown-item" href="">
                                <a class="dropdown-item" href="{{route('profile#admin#list')}}">
                                    <i class="fa-solid fa-user-group mr-2 text-gray-400"></i>
                                    Admin List
                                </a>
                                @endif

                                @if (Auth::user()->role== 'superadmin')
                                <a class="dropdown-item" href="">
                                <a class="dropdown-item" href="{{route('profile#admin#list')}}">
                                    <i class="fas fa-users fa-sm fa-fw mr-2 text-gray-400"></i>
                                    User List
                                </a>
                                @endif

                                <a class="dropdown-item" href="  ">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="  ">
                                <a class="dropdown-item" href=" {{route('profile#changepassword#page')}} ">
                                    {{-- <i class="fa-solid fa-key mr-2 text-gray-400"></i> --}}
                                    Change Password
                                </a>
                                <div class="dropdown-divider"></div>

                                <form action=" {{ route('logout') }} " method="POST">
                                    @csrf
                                    <div class="d-flex justify-content-center">
                                        <button type="submit" class="btn btn-dark"><i class="fa-solid fa-power-off mr-2"></i></i>Logout</button>
                                        {{-- <input type="submit" value="Logout" class="btn btn-primary"> --}}
                                    </div>
                                </form>
                                    {{-- <a class="dropdown-item" data-toggle="modal" href="{{ route('logout') }}" class="btn" type="submit" data-target="#logoutModal">

                                    </a> --}}
                            </div>
                        </li>

                    </ul>
                </nav>
                <!-- End of Topbar -->

                @yield('pageContent')
                @include('sweetalert::alert')

            </div> <!--extra -->

            <!-- Scroll to Top Button-->
            <a class="scroll-to-top rounded" href="#page-top">
                <i class="fas fa-angle-up"></i>
            </a>
        </div> <!-- extra -->

    </div> <!-- extra -->

    <!-- Bootstrap core JavaScript-->
    <script src=" {{ asset('admin/vendor/jquery/jquery.min.js') }} "></script>
    <script src=" {{ asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }} "></script>

    <!-- Core plugin JavaScript-->
    <script src=" {{ asset('admin/vendor/jquery-easing/jquery.easing.min.js') }} "></script>

    <!-- Custom scripts for all pages-->
    <script src=" {{ asset('admin/js/sb-admin-2.min.js') }} "></script>

    <!-- Page level plugins -->
    {{-- <script src=" {{ asset('admin/vendor/chart.js/Chart.min.js') }} "></script> --}}

    <!-- Page level custom scripts -->
    {{-- <script src=" {{ asset('admin/js/demo/chart-area-demo.js') }} "></script>
    <script src=" {{ asset('admin/js/demo/chart-pie-demo.js') }} "></script> --}}

    {{-- show onchange image file --}}
    <script>
        function loadFile(event){
            var reader= new FileReader();
            reader.onload= function(){
                var output= document.getElementById('output');
                output.src= reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>

    {{-- jquery script --}}
    @yield('jQueryScript')

</body>

</html>
