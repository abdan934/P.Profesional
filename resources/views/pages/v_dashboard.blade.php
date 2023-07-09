@extends('layout/template')

@section('isi-konten')
    
<div class="container-fluid pt-4 px-4">
    <div class="row vh-100 bg-light rounded align-items-center justify-content-center mx-0 mb-5">     
        <div class="col-sm-12 col-xl-6">
            <div class="bg-light rounded h-100 p-4">
                    <div class="testimonial-item text-center">
                        <img class="img-fluid rounded-circle mx-auto mb-4" src="{{asset('fotoprofile/'.$user->foto_profile)}}" style="width: 100px; height: 100px;">
                        <h5 class="mb-1">{{$user->name}}</h5>
                        <p>{{$time}}</p>
                        <p class="mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Reprehenderit, quas.</p>
                    </div>
            </div>
        </div>
    </div>
</div>

     @if ($user->level === 'Karyawan')    
     <div class="container-fluid pt-4 px-4">
         <div class="row vh-10 bg-light rounded align-items-center justify-content-center mx-0 mb-5">  

              {{-- Shift 1 --}}
              @if (isset($k_shift1))
              <div class="alert alert-success bg-grass-green col-11 m-3 ">
                 <h2 class="text-light"><i class="bi bi-stopwatch-fill"></i>&nbsp; SHIFT 1 </h2>
                 <h5 class="bg-text-shift mx-4"> 00.00-08.00 </h5>
                 
                 <table class="table table-borderless">
                     <thead class="">
                         <tr class="text-center text-light">
                             <th scope="col">Leader</th>
                             <th scope="col">Kapal</th>
                             <th scope="col">Dermaga</th>
                             <th scope="col">Keterangan</th>
                     </thead>
                     <tbody class="text-center text-light">
                       <td>
                         {{$k_shift1->name_pengawas}}
                       </td>
                       <td>
                        {{$k_shift1->name_kapal}}
                       </td>
                       <td>
                        {{$k_shift1->dermaga}}
                       </td>
                       <td>
                         === Berhasil Absen ===
                       </td>
                     </tbody>
                 </table>
                 
             </div>
              @endif

              {{-- Shift 2 --}}
              @if (isset($k_shift2))
              <div class="alert alert-success bg-grass-green col-11 m-3 ">
                 <h2 class="text-light"><i class="bi bi-stopwatch-fill"></i>&nbsp; SHIFT 2 </h2>
                 <h5 class="bg-text-shift mx-4"> 08.00-16.00 </h5>
                 
                 <table class="table table-borderless">
                     <thead class="">
                         <tr class="text-center text-light">
                             <th scope="col">Leader</th>
                             <th scope="col">Kapal</th>
                             <th scope="col">Dermaga</th>
                             <th scope="col">Keterangan</th>
                     </thead>
                     <tbody class="text-center text-light">
                       <td>
                         {{$k_shift2->name_pengawas}}
                       </td>
                       <td>
                        {{$k_shift2->name_kapal}}
                       </td>
                       <td>
                        {{$k_shift2->dermaga}}
                       </td>
                       <td>
                         === Berhasil Absen ===
                       </td>
                     </tbody>
                 </table>
                 
             </div>
              @endif

              {{-- Shift 3 --}}
              @if (isset($k_shift3))
              <div class="alert alert-success bg-grass-green col-11 m-3 ">
                 <h2 class="text-light"><i class="bi bi-stopwatch-fill"></i>&nbsp; SHIFT 3 </h2>
                 <h5 class="bg-text-shift mx-4"> 16.00-00.00 </h5>
                 
                 <table class="table table-borderless">
                     <thead class="">
                         <tr class="text-center text-light">
                             <th scope="col">Leader</th>
                             <th scope="col">Kapal</th>
                             <th scope="col">Dermaga</th>
                             <th scope="col">Keterangan</th>
                     </thead>
                     <tbody class="text-center text-light">
                       <td>
                         {{$k_shift3->name_pengawas}}
                       </td>
                       <td>
                        {{$k_shift3->name_kapal}}
                       </td>
                       <td>
                        {{$k_shift3->dermaga}}
                       </td>
                       <td>
                         === Berhasil Absen ===
                       </td>
                     </tbody>
                 </table>
                 
             </div>
              @endif


         </div>
     </div>
     @endif






@endsection