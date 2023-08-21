<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Meta;
use App\Models\Content;
use App\Auth\Privilege;
use Illuminate\Http\Request;

class DevContent extends Controller
{
    public function index(){
        if(!Privilege::get('C1')){
            return redirect('/dev/home')->with("info","You dont have access");
        }
        $meta = Meta::$data_meta;
        $meta['title'] = "Admin | Konten";
        return view('admin.content',[
            "meta" => $meta,
            "contents" => Content::all(),
        ]);
    }

    public function postHandler(Request $request){
        if(!Privilege::get('C1')){
            return redirect('/dev/home')->with("info","You dont have access");
        }
        if($request->submit=="store"){
            $res = $this->store($request);
            return redirect('/dev/content')->with($res['status'],$res['message']);
        }
        if($request->submit=="update"){
            $res = $this->update($request);
            return redirect('/dev/content')->with($res['status'],$res['message']);
        }
        if($request->submit=="body"){
            $res = $this->body($request);
            return redirect('/dev/registration')->with($res['status'],$res['message']);
        }
        if($request->submit=="destroy"){
            //$res = $this->destroy($request);
            //return redirect('/dev/content')->with($res['status'],$res['message']);
            return redirect('/dev/content')->with("info","Fitur hapus sementara dinonaktifkan");
        }
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'title'=>'required',
            'code'=>'required',
            'body'=>'required',
        ]);

        // Check if the code has not been used
        if(!Content::whereCode($request->code)->first()){
            Content::create($validatedData);
            return ['status'=>'success','message'=>'Kontent berhasil ditambahkan'];
        }else{
            return ['status'=>'error','message'=>'Code telah terpakai'];
        }
    }

    public function update(Request $request){
        
        // Validate request
        $validatedData = $request->validate([
            'id'=>'required|numeric',
            'title'=>'required',
            'code'=>'required',
            'body'=>'required',
        ]);
        
        $content = Content::find($request->id);

        //Check if the content is found
        if($content){
            
            // Check if the code is different from before
            if($content->code!=$request->code){
                
                // Check if the code has not been used
                if(!Content::where('code',$request->code)->first()){
                    
                    // Update data
                    $content->update($validatedData);    
                    return ['status'=>'success','message'=>'Konten berhasil diedit'];
                }else{
                    return ['status'=>'error','message'=>'Code telah terpakai'];
                }
            }else{
                $content->update($validatedData);
                return ['status'=>'success','message'=>'Konten berhasil diedit']; 
            }
        }else{
            return ['status'=>'error','message'=>'Konten tidak ditemukan'];
        }
    }

    public function destroy(Request $request){
        
        $validatedData = $request->validate([
            'id'=>'required|numeric',
        ]);

        $content = Content::find($request->id);

        //Check if the content is found
        if($content){
            Content::destroy($request->id);
            return ['status'=>'success','message'=>'Konten berhasil dihapus'];
        }else{
            return ['status'=>'error','message'=>'Konten tidak ditemukan'];
        }
    }

}
