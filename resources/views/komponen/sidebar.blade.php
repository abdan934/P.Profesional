

<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-light navbar-light mb-3">
        <a href="/dashboard" class="navbar-brand mx-4 mb-3">
            <h5 class="text-success">Duta Samudera Karya</h5>
        </a>
        <div class="d-flex align-items-center ms-4 mb-4">
            <div class="position-relative">
                <img class="rounded-circle" src="{{asset('fotoprofile/'.$user->foto_profile)}}" alt="" style="width: 40px; height: 40px;">
                <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
            </div>
            <div class="ms-3">
                <h6 class="mb-0">{{$user->name}}</h6>
                <span>{{$user->username}}</span>
            </div>
        </div>
        <div class="navbar-nav w-100">
            <a href="/dashboard" class="nav-item nav-link"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
        </div>  
        @if ($user->level === 'Karyawan')
            
        <div class="navbar-nav w-100">
            <a href="/cek-absen-karyawan" class="nav-item nav-link" ><i class="bi bi-calendar2-check-fill"></i> Cek Absensi</a>
        </div>
        @endif
        @if ($user->level !== 'Karyawan'&& $user->level !== 'Pengawas')
        <div class="navbar-nav w-100">
            <a href="/user" class="nav-item nav-link" ><i class="far fa-file-alt me-2"></i> User</a>
        </div>
        <div class="navbar-nav w-100">
            <a href="/hrd" class="nav-item nav-link" ><i class="bi bi-person-square me-2"></i> HRD</a>
        </div>
        <div class="navbar-nav w-100">
            <a href="/pengawas" class="nav-item nav-link" ><i class="bi bi-person-lines-fill me-2"></i> Pengawas</a>
        </div>
        <div class="navbar-nav w-100">
            <a href="/karyawan" class="nav-item nav-link" ><i class="bi bi-file-person-fill me-2"></i> Karyawan</a>
        </div>
        <div class="navbar-nav w-100">
            <a href="/sift" class="nav-item nav-link" ><i class="bi bi-stopwatch"></i>&nbsp;&nbsp; Shift</a>
        </div>
        <div class="navbar-nav w-100">
            <a href="/absensi" class="nav-item nav-link" ><i class="bi bi-card-checklist"></i>&nbsp;&nbsp; Absen</a>
        </div>
        <div class="navbar-nav w-100">
            <a href="/detail-absensi" class="nav-item nav-link" ><i class="bi bi-layout-text-sidebar-reverse"></i>&nbsp;&nbsp; Detail Absen</a>
        </div>
        <div class="navbar-nav w-100">
            <a href="/laporan-kapal" class="nav-item nav-link" ><i class="bi bi-newspaper"></i>&nbsp;&nbsp;Laporan</a>
        </div>
        @endif

        @if ($user->level == 'Pengawas')
        <div class="navbar-nav w-100">
            <a href="/absensi-masuk" class="nav-item nav-link" ><i class="bi bi-clipboard-check"></i>&nbsp;&nbsp;Presensi</a>
        </div>
        @endif

    </nav>
</div>
