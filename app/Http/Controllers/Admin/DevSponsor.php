<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Meta;
use App\Models\Sponsor;
use App\Auth\Privilege;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class DevSponsor extends Controller
{
    
    public function index(){
        if(!Privilege::get('S1')){
            return redirect('/dev/home')->with("info","You dont have access");
        }
        $meta = Meta::$data_meta;
        $meta['title'] = 'Admin | Sponsor Setting';
        return view('admin.sponsor',[
            "meta" => $meta,
            "sponsors" => Sponsor::all(),
        ]);
    }

    public function postHandler(Request $request){
        if(!Privilege::get('S1')){
            return redirect('/dev/home')->with("info","You don't have access");
        }
        if($request->submit=="store"){
            $res = $this->store($request);
            return redirect('/dev/sponsor')->with($res['status'],$res['message']);
        }
        if($request->submit=="update"){
            $res = $this->update($request);
            return redirect('/dev/sponsor')->with($res['status'],$res['message']);
        }
        if($request->submit=="destroy"){
            $res = $this->destroy($request);
            return redirect('/dev/sponsor')->with($res['status'],$res['message']);
            // return redirect('/dev/sponsor')->with("info","Fitur hapus sementara dinonaktifkan");
        }else{
            return redirect('/dev/sponsor')->with("info","Submit not found");
        }
    }

    public function store(Request $request){
        
        $validatedData = $request->validate([
            'title' => 'required',
            'type' => 'required',
            'sort' => 'required',
            'logo' => 'required|image|file|max:1024',
        ]);

        $validatedData['class'] = $request->class;
        if($request->class==null){
            $validatedData['class'] = "";
        }

        if($request->file('logo')){
            $validatedData['logo'] = time().".png";
            $request->file('logo')->move(public_path('assets/img/sponsor'), $validatedData['logo']);
            Sponsor::create($validatedData);
            return ['status'=>'success','message'=>'Sponsor added successfully']; 
        }
    }

    public function update(Request $request){
        $validatedData = $request->validate([
            'id' => 'required|numeric',
            'title' => 'required',
            'type' => 'required',
            'sort' => 'required',
        ]);
        $validatedData['class'] = $request->class;

        $sponsor = Sponsor::find($request->id);

        //Check if sponsor is found
        if($sponsor){
            
            //Check if has logo
            if($request->file('logo')){
                
                // Delete old logo
                $logo_path = public_path().'/assets/img/sponsor/'.$sponsor->logo;
                unlink($logo_path);         // Delete logo
                
                // Upload new logo
                $validatedData['logo'] = time().".png";
                $request->file('logo')->move(public_path('assets/img/sponsor'), $validatedData['logo']);
                $sponsor->update($validatedData);
                return ['status'=>'success','message'=>'Sponsor updated successfully']; 
            }else{
                $sponsor->update($validatedData);
                return ['status'=>'success','message'=>'Sponsor updated successfully']; 
            }
        }else{
            return ['status'=>'error','message'=>'Sponsor not found'];
        }
    }

    public function destroy(Request $request){
        
        $validatedData = $request->validate([
            'id'=>'required|numeric',
        ]);

        $sponsor = Sponsor::find($request->id);

        //Check if the sponsor is found
        if($sponsor){
            // Delete logo
            $logo_path = public_path().'/assets/img/sponsor/'.$sponsor->logo;
            unlink($logo_path);         // Delete logo
            // Delete sponsor
            Sponsor::destroy($request->id);    // Delete sponsor
            return ['status'=>'success','message'=>'Sponsor deleted successfully'];
        }else{
            return ['status'=>'error','message'=>'Sponsor not found'];
        }
    }
}
