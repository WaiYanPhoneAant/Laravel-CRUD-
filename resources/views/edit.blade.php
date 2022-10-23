@extends('master')
@section('content')


<div class="container mt-5">
    <div class="row">
        <form action="{{route('post#update')}}" class="col-md-6 offset-3" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- back btn --}}
            <div class="mb-2">
                <a href="{{route('update#page',$data['id'])}} " class="btn btn-primary back">
                    <i class="fa-solid fa-arrow-left pe-1"></i>back
                </a>
            </div>
            <input type="hidden" name="id" value="{{$data['id']}}">

            {{-- title --}}
            <div class="mb-2">
                <label for="" class="form-label">Title</label>
                <input type="text" name="title" class="form-control title @error('title') is-invalid @enderror" placeholder="Title" value="{{old('title',$data['title'])}}">
                <small class="text-danger">
                    @error('title')
                        {{$message}}
                    @enderror
                </small>
            </div>

            {{-- edit --}}
            <div class="text-group m-1 cursor-pointer">
                <label for="img" class="btn {{$errors->any('message')?"btn-outline-danger":"btn-outline-dark"}}">
                    <i class="fa-regular fa-image mx-2"></i>
                    Edit image
                </label>
                <small class="text-danger">
                    @error('image')
                        {{$message}}
                    @enderror 
                </small>
                <input type="file" style="display: none;" class="form-range" name="image" id="img" value="{{$data['image']}}"></input>
            </div>

            {{-- show img --}}
            <img src="{{asset($data['image']?'storage/'.$data['image']:'404.png')}}" class="img-thumbnail m-auto d-block my-4 " alt="">

            {{-- description --}}
            <div class="mb-2">
                <label for="" class="form-label">Your Post</label>
                <textarea name="description" class="form-control des-text @error('title') is-invalid @enderror" id="" cols="30" rows="10">{{old('description',$data['description'])}}</textarea>
                <small class="text-danger">
                    @error('title')
                        {{$message}}
                    @enderror
                </small>
            </div>

            {{-- price edit and rate --}}
            <div class="text-group mb-2 row">
                {{-- price --}}
                <div class="price col-md-6">
                    <label for="" class="">price</label>
                    <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" placeholder="price" value={{old('price',$data['price'])}}>
                    <small class="text-danger">
                        @error('price')
                            {{$message}}   
                        @enderror
                    </small>
                </div>
                {{-- address --}}
                <div class="price col-md-6">
                    <label for="" class="">location</label>
                    <input type="text" name="address" class="form-control @error('city') is-invalid @enderror" placeholder="location" value={{old('address',$data['address'])}}>
                    <small class="text-danger">
                        @error('address')
                         {{$message}}
                        @enderror
                    </small>
                </div>
                {{-- rate --}}
                <div class="text-group mb-3 row">
                    <label for="" class="">Post Range</label>
                    <div class="text">
                        <i class="fa-solid fa-star text-secondary st st-1"></i>
                        <i class="fa-solid fa-star text-secondary st st-2"></i>
                        <i class="fa-solid fa-star text-secondary st st-3"></i>
                        <i class="fa-solid fa-star text-secondary st st-4"></i>
                        <i class="fa-solid fa-star text-secondary st st-5"></i>
                    </div>
                    
                    {{-- oninput="star(this.value)" onchange="star(this.value)" onfocus="star(this.value)" --}}
                    <input type="range" oninput="rate(this.value)" onchange="rate(this.value)" onfocus="rate(this.value)" class="form-range range"  name="rating" min="0" max="5" value={{old('rating',$data['rating'])}}></input>       
                </div>
            </div>
            <input type="submit" value="Save Change" class="btn btn-success float-end">
        </form>
    </div>
</div>


{{-- for text discard or keep edit valid --}}
<script>
    //descc
    const desc=document.querySelector('.des-text');
    const desc_value=desc.value;
    
    // title
    const title=document.querySelector('.title');
    const title_value=title.value;
    
    //back
    const back=document.querySelector('.back');
    const route=`{{route('update#page',$data['id'])}}`;
    let change_desc=desc.value;
    let change_title=title.value;
    desc.addEventListener('input',()=>{
        change_desc=desc.value;
    })
    title.addEventListener('input',()=>{
        change_title=title.value;
    })
    back.addEventListener('click',()=>{
        if(desc_value!=change_desc || change_title!=title_value){
            console.log(change_title);
            console.log(title_value);
            back.setAttribute('href', '#');
            let check=confirm('Are you sure to discard change');
            if(check){
                
                window.open(route);
            }
            
        }else{
            back.setAttribute('href', route);
        }
    })
    
    
    
    
    
    
</script>
@endsection