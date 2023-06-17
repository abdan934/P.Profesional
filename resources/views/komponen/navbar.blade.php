

<nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
    <a href="/dashboard" class="navbar-brand d-flex d-lg-none me-4 align-items-center text-center">
        <img class="img-fluid rounded-square mx-auto mb-1" src="{{asset('img/logo.jpg')}}" style="width: 30px; height: 30px;">
        <h2 class="text-success mb-0">
            &nbsp;DSK
        </h2>
    </a>
    <a href="#" class="sidebar-toggler flex-shrink-0 ">
        <i class="fa fa-bars text-success"></i>
    </a>

    <div class="navbar-nav align-items-center ms-auto">
       
        
        <div class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <img class="rounded-circle me-lg-2" src="{{asset('fotoprofile/'.$user->foto_profile)}}" alt="" style="width: 40px; height: 40px;">
                <span class="d-none d-lg-inline-flex">{{$user->name}}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                <a href="{{url('/myprofile/'.$user->username.'/edit')}}" class="dropdown-item">My Profile</a>
                <a href="/logout" class="dropdown-item">Log Out</a>
            </div>
        </div>
    </div>
</nav>

