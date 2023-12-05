<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
      content="Fastkart admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities.">
    <meta name="keywords"
      content="admin template, Fastkart admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="{{ asset('backend/images/favicon.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('backend/images/favicon.png') }}" type="image/x-icon">
    <title>Point of Sales PT WINGSFOOD</title>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('backend/css/linearicon.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/vendors/font-awesome.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/vendors/themify.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/ratio.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/remixicon.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/vendors/feather-icon.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/vendors/scrollbar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/vendors/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/vendors/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/vector-map.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/vendors/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/style.css') }}">

    @stack('styles')

    <style>
    .readonly {
        pointer-events: none;
    }
    </style>
  </head>
  <body>
    <div class="tap-top">
      <span class="lnr lnr-chevron-up"></span>
    </div>
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
      <div class="page-header">
        <div class="header-wrapper m-0">
          <div class="header-logo-wrapper p-0">
            <div class="logo-wrapper">
              <a href="index.html">
              <img class="img-fluid main-logo" src="{{ asset('backend/images/logo/1.png') }}" alt="logo">
              <img class="img-fluid white-logo" src="{{ asset('backend/images/logo/1-white.png') }}" alt="logo">
              </a>
            </div>
            <div class="toggle-sidebar">
              <a href="index.html">
                <img src="{{ asset('backend/images/logo/1.png') }}" class="img-fluid" alt="">
              </a>
            </div>
          </div>
          <a href="{{ route('home') }}" type="button" class="btn theme-bg-color btn-sm text-white fw-bold mend-auto">
            Halaman Kasir
          </a>
          <div class="nav-right col-6 pull-right right-header p-0">
            <ul class="nav-menus">
              <li class="profile-nav onhover-dropdown pe-0 me-0">
                <div class="media profile-media">
                  <img class="user-profile rounded-circle" src="https://img.freepik.com/free-icon/user_318-159711.jpg" alt="">
                  <div class="user-name-hide media-body">
                    <span>{{ auth()->user()->name }}</span>
                    <p class="mb-0 font-roboto">{{ auth()->user()->role_name }}<i class="middle ri-arrow-down-s-line"></i></p>
                  </div>
                </div>
                <ul class="profile-dropdown onhover-show-div">
                  <li>
                    <a data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                      href="javascript:void(0)">
                    <i data-feather="log-out"></i>
                    <span>Log out</span>
                    </a>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="page-body-wrapper">
        <div class="sidebar-wrapper">
          <div id="sidebarEffect"></div>
          <div>
            <div class="logo-wrapper logo-wrapper-center">
              <a href="index.html" data-bs-original-title="" title="">
              <img class="img-fluid for-white" src="{{ asset('backend/images/logo/full-white.png') }}" alt="logo">
              </a>
              <div class="back-btn">
                <i class="fa fa-angle-left"></i>
              </div>
            </div>
            <div class="logo-icon-wrapper">
              <a href="index.html">
              <img class="img-fluid main-logo main-white" src="{{ asset('backend/images/logo/logo.png') }}" alt="logo">
              <img class="img-fluid main-logo main-dark" src="{{ asset('backend/images/logo/logo-white.png') }}"
                alt="logo">
              </a>
            </div>
            <nav class="sidebar-main">
              <div class="left-arrow" id="left-arrow">
                <i data-feather="arrow-left"></i>
              </div>
              <div id="sidebar-menu">
                @include('sidebars.backend')
              </div>
              <div class="right-arrow" id="right-arrow">
                <i data-feather="arrow-right"></i>
              </div>
            </nav>
          </div>
        </div>
        <div class="page-body">
          <div class="container-fluid">
            @yield('content')
          </div>
          <div class="container-fluid">
            <footer class="footer">
              <div class="row">
                <div class="col-md-12 footer-copyright text-center">
                  <p class="mb-0">Copyright {{ date('Y') }} © Point of Sale</p>
                </div>
              </div>
            </footer>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
      aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-body">
            <h5 class="modal-title" id="staticBackdropLabel">Logging Out</h5>
            <p>Are you sure you want to log out?</p>
            <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="button-box">
              <button type="button" class="btn btn--no" data-bs-dismiss="modal">No</button>
              <button type="button" class="btn  btn--yes btn-primary" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">Yes</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="{{ asset('backend/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('backend/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('backend/js/icons/feather-icon/feather.min.js') }}"></script>
    <script src="{{ asset('backend/js/icons/feather-icon/feather-icon.js') }}"></script>
    <script src="{{ asset('backend/js/scrollbar/simplebar.js') }}"></script>
    <script src="{{ asset('backend/js/scrollbar/custom.js') }}"></script>
    <script src="{{ asset('backend/js/config.js') }}"></script>
    <script src="{{ asset('backend/js/tooltip-init.js') }}"></script>
    <script src="{{ asset('backend/js/sidebar-menu.js') }}"></script>
    <script src="{{ asset('backend/js/notify/bootstrap-notify.min.js') }}"></script>
    <script src="{{ asset('backend/js/slick.min.js') }}"></script>
    <script src="{{ asset('backend/js/custom-slick.js') }}"></script>
    <script src="{{ asset('backend/js/customizer.js') }}"></script>
    <script src="{{ asset('backend/js/ratio.js') }}"></script>
    <script src="{{ asset('backend/js/sidebareffect.js') }}"></script>
    <script src="{{ asset('backend/js/script.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    @stack('scripts')

    @if (session()->get('success'))
    <script>
    $.notify('<i class="fas fa-check"></i></i><strong>Sukses</strong> {{ session()->get('success') }}', {
        type: 'theme',
        allow_dismiss: true,
        delay: 4000,
        showProgressbar: true,
        timer: 300,
        // timer: 555555500,
        animate: {
            enter: 'animated fadeInDown',
            exit: 'animated fadeOutUp'
        }
    });
    </script>
    @endif

    @if (session()->get('error'))
    <script>
        $.notify('<div class="text-secondary"><i class="fas fa-xmark"></i></i><strong>Error</strong> {{ session()->get('error') }}</div>', {
            type: 'theme',
            allow_dismiss: true,
            delay: 4000,
            showProgressbar: true,
            timer: 300,
            // timer: 555555500,
            animate: {
                enter: 'animated fadeInDown',
                exit: 'animated fadeOutUp'
            }
        });
        </script>
    @endif
  </body>
</html>
