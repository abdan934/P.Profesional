@extends('layout/template')

@section('isi-konten')
    
     
<div class="container-fluid pt-4 px-4">
    <div class="row vh-100 bg-light rounded align-items-center justify-content-center mx-0">
        
        <div class="col-sm-12 col-xl-6">
            <div class="bg-light rounded h-100 p-4">
                    <div class="testimonial-item text-center">
                        <img class="img-fluid rounded-circle mx-auto mb-4" src="{{asset('img/pekerja.png')}}" style="width: 100px; height: 100px;">
                        <h5 class="mb-1">{{$user->name}}</h5>
                        <p>{{$user->level}}</p>
                        <p class="mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Reprehenderit, quas.</p>
                    </div>
            </div>
        </div>

        {{-- <div class="col-md-6 text-center">
            <h3>This is blank page</h3>
        </div> --}}
    </div>
</div>

{{-- <div class="container-fluid pt-4 px-4">
    <div class="row vh-100 bg-light rounded align-items-center justify-content-center mx-0">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">Hoverable Table</h6>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>John</td>
                            <td>Doe</td>
                            <td>jhon@email.com</td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>mark@email.com</td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td>jacob@email.com</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        
    </div>
</div> --}}



@endsection