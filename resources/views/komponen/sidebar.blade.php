

<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-light navbar-light">
        <a href="/dashboard" class="navbar-brand mx-4 mb-3">
            <h5 class="text-primary">Duta Samudera Karya</h5>
        </a>
        <div class="d-flex align-items-center ms-4 mb-4">
            <div class="position-relative">
                <img class="rounded-circle" src="img/pekerja.png" alt="" style="width: 40px; height: 40px;">
                <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
            </div>
            <div class="ms-3">
                <h6 class="mb-0">{{$user->name}}</h6>
                <span>{{$user->level}}</span>
            </div>
        </div>
        <div class="navbar-nav w-100">
            <a href="/dashboard" class="nav-item nav-link"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
            <a href="/user" class="nav-item nav-link" ><i class="far fa-file-alt me-2"></i>User</a>
            
        </div>
    </nav>
</div>
