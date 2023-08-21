<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Meta;
use App\Models\EicCategory;
use App\Auth\Privilege;
use Illuminate\Http\Request;

class DevEicCategory extends Controller
{
    public function index(){
        if(!Privilege::get('EC2')){
            return redirect('/dev/home')->with("info","You dont have access");
        }
        $meta = Meta::$data_meta;
        $meta['title'] = "Admin | EIC Category";
        return view('admin.eic-category',[
            "meta" => $meta,
            "categories" => EicCategory::all(),
        ]);
    }

    public function postHandler(Request $request){
        if(!Privilege::get('EC2')){
            return redirect('/dev/home')->with("info","You dont have access");
        }
        if($request->submit=="store"){
            $res = $this->store($request);
            return redirect('/dev/eic-category')->with($res['status'],$res['message']);
        }
        if($request->submit=="update"){
            $res = $this->update($request);
            return redirect('/dev/eic-category')->with($res['status'],$res['message']);
        }
        if($request->submit=="destroy"){
            //$res = $this->destroy($request);
            //return redirect('/dev/eic-category')->with($res['status'],$res['message']);
            return redirect('/dev/eic-category')->with("info","The delete feature is temporarily disabled");
        }
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'title'=>'required',
            'description'=>'required',
            'icon'=>'required',
            'status'=>'required',
        ]);

        EicCategory::create($validatedData);
        return ['status'=>'success','message'=>'Category added successfully'];
    }

    public function update(Request $request){
        
        // Validate request
        $validatedData = $request->validate([
            'id'=>'required|numeric',
            'title'=>'required',
            'description'=>'required',
            'icon'=>'required',
            'status'=>'required',
        ]);
        
        $eicc = EicCategory::find($request->id);

        //Check if the category is found
        if($eicc){
            $eicc->update($validatedData);
            return ['status'=>'success','message'=>'Category edited successfully']; 
        }else{
            return ['status'=>'error','message'=>'Category not found'];
        }
    }

    public function destroy(Request $request){
        
        $validatedData = $request->validate([
            'id'=>'required|numeric',
        ]);

        $eicc = EicCategory::find($request->id);

        //Check if the category is found
        if($eicc){
            EicCategory::destroy($request->id);
            return ['status'=>'success','message'=>'Category deleted successfully'];
        }else{
            return ['status'=>'error','message'=>'Category not found'];
        }
    }

}
