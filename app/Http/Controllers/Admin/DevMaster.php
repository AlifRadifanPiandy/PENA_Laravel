<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Meta;
use App\Models\Master;
use App\Auth\Privilege;
use Illuminate\Http\Request;

class DevMaster extends Controller
{
    public function index(){
        if(!Privilege::get('M1')){
            return redirect('/dev/home')->with("info","You dont have access");
        }
        $meta = Meta::$data_meta;
        $meta['title'] = "Admin | Master";
        return view('admin.master',[
            "meta" => $meta,
            "masters" => Master::all(),
        ]);
    }

    public function postHandler(Request $request){
        if(!Privilege::get('M1')){
            return redirect('/dev/home')->with("info","You dont have access");
        }
        if($request->submit=="store"){
            $res = $this->store($request);
            return redirect('/dev/master')->with($res['status'],$res['message']);
        }
        if($request->submit=="update"){
            $res = $this->update($request);
            return redirect('/dev/master')->with($res['status'],$res['message']);
        }
        if($request->submit=="destroy"){
            // $res = $this->destroy($request);
            // return redirect('/dev/faq')->with($res['status'],$res['message']);
            return redirect('/dev/master')->with("info","Fitur hapus sementara dinonaktifkan");
        }
    }

    public function store(Request $request){
        
        $validatedData = $request->validate([
            'code'=>'required',
            'status'=>'required',
        ]);

        Master::create($validatedData);
        return ['status'=>'success','message'=>'Data master berhasil ditambahkan'];
    }

    public function update(Request $request){
        
        $validatedData = $request->validate([
            'id'=>'required|numeric',
            'code'=>'required',
            'status'=>'required',
        ]);
        
        $master = Master::find($request->id);

        //Check if the master is found
        if($master){
            $master->update($validatedData);
            return ['status'=>'success','message'=>'Data master berhasil diedit']; 
        }else{
            return ['status'=>'error','message'=>'Data master tidak ditemukan'];
        }
    }

    public function destroy(Request $request){
        
        $validatedData = $request->validate([
            'id'=>'required|numeric',
        ]);

        $master = Master::find($request->id);

        //Check if the master is found
        if($master){
            Master::destroy($request->id);
            return ['status'=>'success','message'=>'Data master berhasil dihapus'];
        }else{
            return ['status'=>'error','message'=>'Data master tidak ditemukan'];
        }
    }

}
