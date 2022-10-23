@extends('master')


@section('content')



<div class="container mt-5">
    <div class="row">

        {{-- Create section --}}
        <div class="col-md-5 ">
            <div class="p-3">

                {{-- Alert message for success post create --}}
                @if (session('insertSucces'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{session('insertSucces')}}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                
                {{-- Alert message for success post update --}}
                @if (session('updateSucces'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>{{session('updateSucces')}}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                

                {{-- Alert message for success post Delete --}}
                @if (session('DeleteSucces'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{session('DeleteSucces')}}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                
                {{-- create form --}}
                <form action="{{route('postcreate')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{-- post image --}}
                    <div class="text-group mb-3 cursor-pointer">                       
                        <label for="img" class="btn {{$errors->any('message')?"btn-outline-danger":"btn-dark"}}"><i class="fa-regular fa-image mx-2"></i>choose image</label>
                         {{-- validation message --}}
                        <small class="text-danger">
                            @error('image')
                                {{$message}}
                            @enderror   
                        </small>
                        <input type="file" style="display: none;" class="form-range" name="image" id="img">{{old('image')}}</input>
                    </div>

                    {{-- post title --}}
                    <div class="text-group mb-3">
                        <label for="" class="">Post Title</label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" placeholder="Enter Post title" value={{old('title')}}>
                        
                        {{-- validation message --}}
                        <small class="text-danger">
                            @error('title')
                                {{$message}}
                            @enderror    
                        </small>

                    </div>   
                    
                    {{-- post description --}}
                    <div class="text-group mb-3">
                        <label for="" class="">Post Description</label>
                        <textarea class="form-control @error('title') is-invalid @enderror" name="description" id="" cols="30" rows="10" placeholder="Enter Description">{{old('description')}}</textarea>
                        
                        {{-- validation message --}}
                        <small class="text-danger">
                            @error('description')
                                {{$message}}
                            @enderror
                        </small>

                    </div>

                    {{-- price and location --}}
                    <div class="text-group mb-3 row">
                        <div class="price col-md-6">
                            <label for="" class="">price</label>
                            <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" placeholder="price" value={{old('price')}}>
                             
                            {{-- validation message --}}
                            <small class="text-danger">
                                @error('price')
                                    {{$message}}
                                @enderror
                            </small>

                        </div>
                        <div class="price col-md-6">
                            <label for="" class="">location</label>
                            <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" placeholder="location" value={{old('address')}}>
                             
                            {{-- validation message --}}
                            <small class="text-danger">
                                @error('address')
                                    {{$message}}
                                @enderror
                            </small>

                        </div>
                    </div>

                    {{-- post rate --}}
                    <div class="text-group mb-3 row">
                        <label for="" class="">Post Range</label>
                        <div class="text">
                            <i class="fa-solid fa-star text-secondary st st-1"></i>
                            <i class="fa-solid fa-star text-secondary st st-2"></i>
                            <i class="fa-solid fa-star text-secondary st st-3"></i>
                            <i class="fa-solid fa-star text-secondary st st-4"></i>
                            <i class="fa-solid fa-star text-secondary st st-5"></i>
                        </div>
                        <input type="range" class="form-range range" oninput="rate(this.value)" onchange="rate(this.value)" onfocus="rate(this.value)" name="rating" min="0" max="5" value={{old('rating',0)}}></input>       
                    </div>

                    {{-- submit-button --}}
                    <div class="mb-3">
                        <input type="submit" value="Create" class="btn btn-primary">
                    </div>
                </form>

            </div>
        </div>
        {{-- end Create section --}}


        {{-- Show Section --}}

        <div class="col-md-7 mb-3">

            {{-- header & search --}}
            <div class="d-flex justify-content-between">
                <h3 class="my-3 text-success">
                    Total Posts:{{$posts->total()}}
                </h3>
                <form action="{{route('post#create')}}" method="GET">
                    <div class="my-3 float-end d-flex">
                        
                        <input type="text" name='key' placeholder="Search here....." class="form-control" value={{request('key')}}>
                        <input type="submit" class="mx-2 btn btn-secondary" value="Search">
                        
                    </div>
                </form>
            </div>
            {{-- end header & section --}}


            {{-- condition data search --}}
            @if (request('key'))
            <div class="m-3 d-flex justify-content-between" >
                @if ($posts->total()==0)
                <div class="text-danger">No Data founds.Try Again!!!!</div>
                @else
                <div class="  text-success">Found data-({{$posts->total()}}) in "{{request('key')}}"</div>
                @endif
                <a href='{{route('post#create')}}' class=" btn btn-warning" >Clear search</a>
            </div>
            @endif
            
            <div class="data-container">
                @foreach ($posts as $post)
                <div class="post p-3 bg-light shadow mb-3">

                    {{-- post title --}}
                    <div class="d-flex justify-content-between">
                        <h5>{{$post->title}}</h5> 
                        <small class="text-end text-black-50 w-25" style="font-size: 18px">{{ $post->created_at->format('d-m-Y h:i:A') }}</small>
                    </div>

                    {{-- post description --}}
                    <p class="text-muted">
                        {{Str::words($post->description,30,'.....')}}
                    </p>

                    {{-- price --}}
                    <span>
                        <i class="fa-solid fa-money-bill-1-wave p-1 text-primary"></i>
                        <small>{{$post->price}} kyats</small>
                    </span>|
                    {{-- address --}}
                    <span>
                        <i class="fa-solid fa-map-location text-danger"></i>
                        <small>{{$post->address}} </small>
                    </span>|

                    {{-- rate --}}
                    <span>
                        <i class="fa-solid fa-star text-warning"></i>
                        <small>{{$post->rating}} </small>
                    </span>


                    {{-- Delete and Update --}}
                    <div class="text-end mt-3">

                        {{-- for delete --}}
                        <a class="text-decoration-none" href="{{route('post#delete',$post['id'])}}">
                            <button class="btn btn-sm btn-danger">
                                <i class="fa-solid fa-trash m-1"></i>ဖျတ်ရန်
                            </button>
                            
                        </a>
                        {{-- for update --}}
                        <a href="{{route('update#page',$post['id'])}}">
                            <button class="btn btn-sm btn-primary">
                                <i class="fa-solid fa-file-lines m-1"></i>အပြည့်အစုံဖတ်ရန်
                            </button>
                            
                        </a>
                    </div>
                    
                </div>
                @endforeach
                
                {{-- for pagenation ui --}}
                {{$posts->appends(request()->query())->links()}}
            </div>
        </div>
        {{-- end show section --}}
    </div>
</div>


@endsection


