<?php

namespace App\Http\Controllers;


use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    //Create Data
    // postdata:create
    public function postCreate(Request $request){
        $this->validCheck($request);
        $data=$request->toArray();  
    
        //prepare image file 
        if ($request->hasfile('image')) {
            $image=uniqid().$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$image);
            $data['image']=$image;     
        }
        // create post
        Post::create($data);
        return back()->with(['insertSucces'=>' ပို့စ်ဖန်တီးခြင်းအောင်မြင်ပါသည်။']);
        }


    //create to show post
    public function creat(){
        // fetch or search
        $posts=Post::when(request('key'),function($p){
                $searchKey=request('key');
                $p->orwhere('title','like',"%$searchKey%")
                  ->orwhere('description','like',"%$searchKey%");
        })->orderBy('created_at','desc')->paginate(4);
        return view('create',compact('posts'));
        }
        

        // post delete
        public function postDelete($id){       
            $post=Post::find($id)->delete();
            return back()->with(['DeleteSucces'=>' ပို့စ်ဖျတ်ပြီးပါပြီ']);
        }
                
        // updatepage-fullview
        //preview page
         public function UpdatePage($id){     
            $data=Post::find($id);
            return view('update',compact('data'));
        }
                
        // editpage
        public function editpage($id){
            $data=Post::find($id)->toArray();
            return view('edit',compact('data'));
        }
                
                
        //updatepost
        public function update(Request $request){ 
            $this->validCheck($request);
            $data=$this->getUpdateData($request);
            $id=$request->id;
            $oldImageName=Post::select('image')->where('id',$id)->first()['image'];
            if($request->image==null){
                $data['image']=$oldImageName;
            }
            if ($request->hasfile('image')) { 
                if($oldImageName!=null){
                    Storage::delete('public/'.$oldImageName);
                }
                $image=uniqid().$request->file('image')->getClientOriginalName();
                $request->file('image')->storeAs('public',$image);
                $data['image']=$image;              
            } 
                Post::where('id',$id)->update($data);
                return redirect()->route('post#create')->with(['updateSucces'=>' ပို့စ်ပြုပြင်ခြင်းအောင်မြင်ပါသည်။']);;
        }
                
                
                
        //get update data
        //prepare array for db:update 
        private function getUpdateData($request){
            return[
                    'title'=>$request->title,
                    'description'=>$request->description,
                    'price'=>$request->price,
                    'address'=>$request->address,
                    'rating'=>$request->rating,
                    'image'=>$request->image,
                ];
        }
                
        // get post data
        //prepare array for db-post:create
        private function getPostData($request){
            $response=[
                    'title'=>$request->title,
                    'description'=>$request->description,
                    'price'=>$request->price,
                    'address'=>$request->address,
                    'rating'=>$request->rating,
                ];
            return ($response);
        }
                
            // --------------------------Validation-------------------------------
        // post validation check
        private function validCheck($request){
            $validationRules=[
                'title'=>'required|min:5|unique:posts,title,'.$request->id,
                'description'=>'required',
                'price'=>'required',
                'address'=>'required',
                'image'=>'mimes:jpg,png,jpeg|file',
            ];

            $validationMessage=[
                'title.required'=>'*ဖြည့်ရန်လိုအပ်ပါသည်။',
                'description.required'=>'*ဖြည့်ရန်လိုအပ်ပါသည်။',
                'title.min'=>'အနည်းဆုံးစာလုံးငါးလုံးရှိရပါမည်။',
                'title.unique'=>'ဤခေါင်းစဥ်သည်အသုံးပြုပြီးသားဖြစ်ပါသည်။ထပ်မံကြိုးစားကြည့်ပါ',
                'price.required'=>'*ဖြည့်ရန်လိုအပ်ပါသည်။',
                'address.required'=>'*ဖြည့်ရန်လိုအပ်ပါသည်။',
                'image.mimes'=>"*ပံ့ပိုးမပေးထားသောဖိုင်အမျိုးအစား",
                'image.file'=>"Only file support",
                        
            ];
            Validator::make($request->all(),$validationRules,$validationMessage)->validate();
            }
}
            