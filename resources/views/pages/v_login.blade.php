@extends('layout/login')

@section('konten-login')
<div class="container-fluid">
    <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
        <div class="col-12 col-sm-8 col-md-6 col-lg-6 col-xl-6 ">
            <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <a href="#" class="">
                        <h3 class="text-success col-12"></i>Duta Samudera Karya</h3>
                        <h5>(DSK)</h5>
                    </a>
                </div>
                @include('pesan/pesan_login')
                @if ($errors->any())
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    
                    @foreach ($errors->all() as $item)
                    <li><i class="fa fa-exclamation-circle me-2"></i>{{$item}}</li>
                @endforeach
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
                    <form action="/login" method="POST">
                        @csrf
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control"  name="username" placeholder="Username" required>
                        <label for="floatingInput">Username</label>
                    </div>
                    <div class="form-floating mb-4">
                        <input type="password" class="form-control"  name="password" placeholder="Password" required>
                        <label for="floatingPassword">Password</label>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-4">
                 
                     <a href="#" class="text-success">Lupa Akun</a>
                    </div>
                    <button type="submit"  class="btn btn-success py-3 w-100 mb-4">Masuk</button>
                </form>
                
            </div>
        </div>
    </div>
</div>
@endsection