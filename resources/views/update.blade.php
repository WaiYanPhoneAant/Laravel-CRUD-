@extends('master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-6 offset-3 mt-5 bg-light justify-content-between">
                <div class="m-1 d-inline">
                   <a href="{{route('post#home')}}" class=" btn btn-primary text-decoration-none text-white">
                        <i class="fa-solid fa-arrow-left pe-1"></i>back
                   </a>
                </div>
                <div class="m-1 d-inline">
                    <a href="{{route('editpage',$data['id'])}}" class="btn btn-success float-end text-decoration-none text-white">
                        <i class="fa-solid fa-circle-plus me-2"></i>Edit
                    </a>
                 </div>
               
                 {{-- title --}}
                <div class="d-flex justify-content-between">
                    <h3 class="my-3">{{$data['title']}}</h3>
                    <h5 class="my-3 text-black-50" style="font-size: 15px;"><i class="fa-solid fa-calendar-days p-1"></i>{{$data->created_at->format('d-m-Y h:i:A')}}</h5>
                </div>

                
                <div class="d-flex my-3">
                    {{-- price --}}
                    <div class="btn btn-sm btn-dark mx-2">
                        <i class="fa-solid fa-money-bill-1-wave  text-primary"></i>
                        <small>{{$data->price}} kyats</small>
                    </div>
                    
                    {{-- address --}}
                    <div class="btn btn-sm btn-dark mx-2">
                        <span>
                            <i class="fa-solid fa-map-location text-danger "></i>
                            <small>{{$data->address}} </small>
                        </span>
                    </div>

                    {{-- rate --}}
                    <div class="btn btn-sm btn-dark mx-2">
                        <i class="fa-solid fa-star text-warning"></i>
                        <small>{{$data->rating}} </small>
                    </div>
                </div>

                <img src="{{asset($data->image?'storage/'.$data->image:'404.png')}}" class="img-thumbnail m-auto d-block my-4 " alt="">
                 
                {{-- description --}}
                <p class="text-muted">
                    {{$data['description']}}
                </p>
            </div>
        </div>
    </div>

@endsection