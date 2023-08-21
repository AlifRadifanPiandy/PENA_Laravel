<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Meta;
use App\Models\Card;
use App\Auth\Privilege;
use Illuminate\Http\Request;

class DevCard extends Controller
{
    public function index(){
        if(!Privilege::get('EC1')){
            return redirect('/dev/home')->with("info","You don't have access");
        }
        $meta = Meta::$data_meta;
        $meta['title'] = "Admin | Card";
        return view('admin.card',[
            "meta" => $meta,
            "cards" => Card::all(),
        ]);
    }

    public function postHandler(Request $request){
        if(!Privilege::get('EC1')){
            return redirect('/dev/home')->with("info","You don't have access");
        }
        if($request->submit=="store"){
            $res = $this->store($request);
            return redirect('/dev/card')->with($res['status'],$res['message']);
        }
        if($request->submit=="update"){
            $res = $this->update($request);
            return redirect('/dev/card')->with($res['status'],$res['message']);
        }
        if($request->submit=="destroy"){
            $res = $this->destroy($request);
            return redirect('/dev/card')->with($res['status'],$res['message']);
            //return redirect('/dev/card')->with("info","The delete feature is temporarily disabled");
        }
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'title'=>'required',
            'description'=>'required',
            'button'=>'required',
            'url'=>'required',
            'show'=>'required',
            'sort'=>'required',
        ]);

        Card::create($validatedData);
        return ['status'=>'success','message'=>'Card added successfully'];
    }

    public function update(Request $request){
        
        // Validate request
        $validatedData = $request->validate([
            'id'=>'required|numeric',
            'title'=>'required',
            'description'=>'required',
            'button'=>'required',
            'url'=>'required',
            'show'=>'required',
            'sort'=>'required',
        ]);
        
        $card = Card::find($request->id);

        //Check if the card is found
        if($card){
            $card->update($validatedData);
            return ['status'=>'success','message'=>'Card edited successfully']; 
        }else{
            return ['status'=>'error','message'=>'Card not found'];
        }
    }

    public function destroy(Request $request){
        
        $validatedData = $request->validate([
            'id'=>'required|numeric',
        ]);

        $card = Card::find($request->id);

        //Check if the card is found
        if($card){
            Card::destroy($request->id);
            return ['status'=>'success','message'=>'Card removed successfully'];
        }else{
            return ['status'=>'error','message'=>'Card not found'];
        }
    }

}
