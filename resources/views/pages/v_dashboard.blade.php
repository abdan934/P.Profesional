@extends('layout/template')

@section('isi-konten')
    
     
<div class="container-fluid pt-4 px-4">
    <div class="row vh-100 bg-light rounded align-items-center justify-content-center mx-0">
        
        <div class="col-sm-12 col-xl-6">
            <div class="bg-light rounded h-100 p-4">
                    <div class="testimonial-item text-center">
                        <img class="img-fluid rounded-circle mx-auto mb-4" src="{{asset('fotoprofile/'.$user->foto_profile)}}" style="width: 100px; height: 100px;">
                        <h5 class="mb-1">{{$user->name}}</h5>
                        <p>{{$user->level}}</p>
                        <p class="mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Reprehenderit, quas.</p>
                    </div>
            </div>
        </div>
    </div>
</div>




@endsection