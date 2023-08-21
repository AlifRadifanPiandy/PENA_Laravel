<?php

namespace App\Http\Controllers;

use App\Auth\Privilege;
use App\Helpers\ApiFormatter;
use App\Models\Admin;
use App\Models\Card;
use App\Models\Content;
use App\Models\EicCategory;
use App\Models\Faq;
use App\Models\Gallery;
use App\Models\Master;
use App\Models\Sponsor;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class APIController extends Controller
{

  public function Admin(Admin $admin){  
    if(Privilege::get(6)){
      return ApiFormatter::createApi(200,"Success",$admin);
    }else{
      return ApiFormatter::createApi(401,"You dont have access");
    }
  }

  public function Card(Card $card){   
    if(Privilege::get('EC1')){
      return ApiFormatter::createApi(200,"Success",$card);
    }else{
      return ApiFormatter::createApi(401,"You dont have access");
    }
  }

  public function Content(Content $content){   
    if(Privilege::get('C1')){
      return ApiFormatter::createApi(200,"Success",$content);
    }else{
      return ApiFormatter::createApi(401,"You dont have access");
    }
  }

  public function Faq(Faq $faq){   
    if(Privilege::get('F1')){
      return ApiFormatter::createApi(200,"Success",$faq);
    }else{
      return ApiFormatter::createApi(401,"You dont have access");
    }
  }

  public function Gallery(Gallery $gallery){   
    if(Privilege::get('G1')){
      return ApiFormatter::createApi(200,"Success",$gallery);
    }else{
      return ApiFormatter::createApi(401,"You dont have access");
    }
  }

  public function Master(Master $master){   
    if(Privilege::get('M1')){
      return ApiFormatter::createApi(200,"Success",$master);
    }else{
      return ApiFormatter::createApi(401,"You dont have access");
    }
  }
  
  public function MasterPost(Request $request){  
    try{
      $validatedData = $request->validate([
        'id'=>'required|numeric',
        'status'=>'required',
      ]);
      
      $master = Master::find($request->id);
      
      //Check if master data is found
      if($master){
        //Check if user is authorized
        if(Privilege::get('M1')){
          $master->update($validatedData);
          return ApiFormatter::createApi(200,"Success",$master);
        }else{
          return ApiFormatter::createApi(401,"You dont have access");
        }
      }else{
        return ApiFormatter::createApi(404,"Data not found");
      }
    }catch(Exception $error){
      return ApiFormatter::createApi(400,"Failed!");
    }  
  }

  public function Sponsor(Sponsor $sponsor){   
    if(Privilege::get('S1')){
      return ApiFormatter::createApi(200,"Success",$sponsor);
    }else{
      return ApiFormatter::createApi(401,"You dont have access");
    }
  }

  public function EicCategory(EicCategory $eicc){   
    if(Privilege::get('EC2')){
      return ApiFormatter::createApi(200,"Success",$eicc);
    }else{
      return ApiFormatter::createApi(401,"You dont have access");
    }
  }
  
}
