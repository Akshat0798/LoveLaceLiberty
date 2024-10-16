<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AppVersion;

class AppVersionController extends Controller
{


public function index(){

    $data = AppVersion::where('id','1')->first();
    $title = "App Setting";
    $pageConfigs = ['controller' => 'AppVersionController'];

    return view('admin/app_version/update',compact('data','title','pageConfigs'));

    
}

    public function update(Request $request){ 

     
        

        $request->validate([
            'android_version' => 'required|numeric',
            'ios_version' => 'required|numeric',
          
      ]);

      $AppVersion = AppVersion::find($request->id);
      $AppVersion->android_version = $request->android_version;
      $AppVersion->ios_version = $request->ios_version;
      $AppVersion->android_force_update = $request->android_force_update;
      $AppVersion->ios_force_update = $request->ios_force_update;
      $AppVersion->android_maintenance = $request->android_maintenance;
      $AppVersion->ios_maintenance = $request->ios_maintenance;
      $AppVersion->android_message = $request->android_message;
      $AppVersion->ios_message = $request->ios_message;

      $AppVersion->app_url = $request->app_url;
      $AppVersion->app_message = $request->app_message;
      $AppVersion->ios_app_link = $request->ios_app_link;
      $AppVersion->android_app_link = $request->android_app_link;
      $AppVersion->update();
  
      if ($AppVersion) {
        return redirect()->route('admin.app-version');

      } else {
            return redirect()->back()->with('error', 'Error occured in adding data');
      }



                     
    }
}
