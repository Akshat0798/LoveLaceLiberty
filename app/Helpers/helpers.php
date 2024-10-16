<?php

use Validations as CustomValidations;
use App\Models\Cms;
use Intervention\Image\ImageManagerStatic as Image;
use App\Lib\VIDEOSTREAM;
use App\Lib\PushNotification;
use App\Models\RelevantCategory;
use Twilio\Rest\Client;
use App\Models\TestOfferDeal;
use App\Models\ApiLogs;
use App\Models\PageContent;



/*
 * function getRule to get validations rule by name
 * params string $name, bool $required
 */


if (!function_exists('getRule')) {

    function getRule($name, $required = false, $nullable = false) {
        return CustomValidations::getRule($name, $required, $nullable);
    }

}
if (!function_exists('show_date')) {

    function show_date($date) {
        if ($date) {
            return date(env('DATE_FORMAT_PHP', 'm/d/Y'), strtotime($date));
        }
    }

}
if (!function_exists('db_phone')) {

    function db_phone($phone) {
        if ($phone) {
            return str_replace([' ', '-'], '', $phone);
        } else {
            return $phone;
        }
    }

}

if (!function_exists('prep_url')) {

    function prep_url($str = '') {
        if ($str === 'http://' OR $str === '') {
            return '';
        }
        $url = parse_url($str);
        if (!$url OR ! isset($url['scheme'])) {
            return 'http://' . $str;
        }
        return $str;
    }

}

/* start by yogendra goyal */

if (!function_exists('all_file_upload')) {

    function all_file_upload($file, $path) {
        $extension = $file->getClientOriginalExtension();
        $orignalname = $file->getClientOriginalName();
        if (in_array($extension, ['WAV', 'wav', 'FLAC', 'flac', 'AIFF', 'aiff', 'WMA', 'wma', 'jpg', 'png', 'gif', 'JGP', 'PNG', 'GIF'])) {
            $fileNameExt = time() . "-" . rand(1000, 9999);
            $path = 'storage/app/public/albums/' . $path . '/' . $orignalname;
            move_uploaded_file($file, $path);
            return array(true, $orignalname, $extension, $orignalname);
        } else {
            return array(false, "You can upload the following format:  WAV, FLAC, AIFF, WMA.", '');
        }
    }

}

if (!function_exists('image_upload')) {

    function image_upload($file, $path) {
        $path = public_path('admin/') . $path . '/';
        $imgsize = getimagesize($file);
        $width = $imgsize[0];
        $height = $imgsize[1];
        $imgre = calculateDimensions($width, $height, 450, 450);
        $image = $file;
        $extension = $image->getClientOriginalExtension();
        $fileType = $image->getClientMimeType();
        $orignalname = $file->getClientOriginalName();
        $fileNameExt = time() . "-" . rand(1000, 9999);
        $fileName = $fileNameExt . '.' . $extension;               // renameing image
        $fileNamethum = $fileNameExt . '_thumb.' . $extension;
        if (in_array($extension, ['jpeg', 'jpg', 'JPG', 'JPEG', 'png', 'PNG', 'gif', 'GIF'])) {
            $thumb_img = Image::make($image->getRealPath())->resize($imgre['width'], $imgre['height']);
            $thumb_img->save($path . $fileNamethum, 100);
            $image->move($path, $fileName);
            // $image = $request->banner;
                    
            // if($image!='') {
            //     $png_url = "wlcImg-".rand().'.'.$image->extension();
            //     $image->move(public_path('img/banner/'), $png_url);
            //     $mediaName = 'img/banner/' . $png_url;
            //     $data->banner = $mediaName;
                
            // }
            return array(true, $path . $fileName, $path . $fileNamethum, $extension, $orignalname, $fileType);
        } else {
            return array(false, "file should be in jpeg, jpg,png,gif format / double extension not allow.", '');
        }
    }

}

if (!function_exists('video_upload')) {

    function video_upload($file, $path) {
        $path = 'storage/app/public/' . $path . '/';
        
        $extension = $file->getClientOriginalExtension();
        $orignalname = $file->getClientOriginalName();
        $fileNameExt = time() . "-" . rand(1000, 9999);
        $fileName = $fileNameExt . '.' . $extension;               // renameing image
        $fileNamethum = $fileNameExt . '_thumb.' . $extension;
        //if (in_array($extension, ['mp4'])) {
            $file->move($path, $fileName);
            $fileNameExt = time() . "-" . rand(1000, 9999);
            $fileNamethum = makeThumbnailFromVideo($path, $fileName, $fileNameExt);
            //$fileName = convertVideo($path, $fileName, $fileNameExt);
            $fileNamethum['duration'] = secondToMinutes($fileNamethum['duration']);
            return array(true, $path . $fileName, $path . $fileNamethum['thum'], $fileNamethum['duration'], $extension, $orignalname);
        // } else {
        //     return array(false, "file should be in mp4 format / double extension not allow.", '');
        // }
    }

}

if (!function_exists('makeThumbnailFromVideo')) {

    function makeThumbnailFromVideo($path, $tmp_file, $new_file) {
        $MOVIE = new VIDEOSTREAM();
        $tmpPath = $path . $tmp_file;
        $imageFile = $new_file . ".jpg";
        $detail = array();
        $MOVIE->load($tmpPath);
        $r = ($MOVIE->video_info());
        $s = $MOVIE->getDetailInfo();
        $size = $r['size'];
        $szArr = array("width" => $size['width'], "height" => $size['height']);
        $MOVIE->getFrameAtTime(3, 300, 300, 100, $path . basename($imageFile));
        return ['thum' => $imageFile, 'duration' => $r['duration']];
    }

}

if (!function_exists('convertVideo')) {

    function convertVideo($path, $tmp_file, $new_file) {
        $MOVIE = new VIDEOSTREAM();
        $tmpPath = $path . $tmp_file;
        $videoFile = $new_file . ".mp4";
        $detail = array();
        $MOVIE->load($tmpPath);
        $r = ($MOVIE->video_info());
        $s = $MOVIE->getDetailInfo();
        $size = $r['size'];
        $szArr = array("width" => $size['width'], "height" => $size['height']);
        $MOVIE->convertVideo($path . $videoFile);
        return ['video' => $videoFile, 'duration' => $r['duration']];
    }

}

if (!function_exists('file_checker')) {

    function file_checker($file, $filename = null) {
        if( \Request::segment(1)== 'api'){
            if (isset($file) && !empty($file) && file_exists(base_path() . '/' . $file)) {
                $images = url($file);
            } else {
                if ($filename == 'avatar') {
                    $images = url('public/img/avatar.jpg');
                } else if ($filename == 'cover') {
                    $images = url('public/img/cover.jpg');
                } else if ($filename == 'item') {
                    $images = url('public/img/default_profile_background.png');
                } else if ($filename == 'default_profile_background') {
                    $images = url('public/img/default_profile_background.png');
                } else {
                    $images = url('public/img/default.jpeg');
                }
            }
        }else{
            if (isset($file) && !empty($file) && file_exists(base_path() . '/' . $file)) {
                $images = url($file);
            } else {
                if ($filename == 'avatar') {
                    $images = url('public/img/avatar.jpg');
                } else if ($filename == 'cover') {
                    $images = url('public/img/cover.jpg');
                } else if ($filename == 'item') {
                    $images = url('public/img/default_profile_background.png');
                } else if ($filename == 'default_profile_background') {
                    $images = url('public/img/default_profile_background.png');
                } else {
                    $images = url('public/img/default.jpeg');
                }
            }
        }
        return $images;
    }

}

if (!function_exists('file_checker_and_delete')) {

    function file_checker_and_delete($file) {
        if (isset($file) && !empty($file) && file_exists(base_path() . '/' . $file)) {
            unlink($file);
        }
    }

}

if (!function_exists('makeDirectory')) {

    function makeDirectory($path, $mode = 0777, $recursive = false, $force = false) {
        if ($force) {
            if (!file_exists($path)) {
                return @mkdir($path, $mode, $recursive);
            }
        } else {
            if (!file_exists($path)) {
                return mkdir($path, $mode, $recursive);
            }
        }
    }

}

if (!function_exists('makeDelete')) {

    function makeDelete($path) {
        if (file_exists($path)) {
            return rmdir($path);
        }
    }

}

if (!function_exists('renameDirectory')) {

    function renameDirectory($oldpath, $newpath) {
        rename($oldpath, $newpath);
    }

}

function createStatus($status, $id, $array = null, $class = 'changeStatus', $path = null) {
    if (!$array) {
        $array = ['1' => 'Approved', '0' => 'Not Approved'];
    }
    return $html = Form::select('active', $array, $status, ['class' => 'form-control input-border-bottom   ' . $class, 'style' => 'min-width:75px', 'id' => $id, 'data-path' => routeUser($path)]);
}

function createStatusButton($status, $id, $array = null, $class = 'changeStatus', $path = null) {
    $url = routeUser($path);
    if ($status == 0) {
        $html = '<button class="btn btn-danger btn-sm status-change status-inactive" data-path="'.routeUser($path).'" id="'.$id.'" status="'.$status.'" >Inactive</button>';
    }
    else {
        $html = "<button class='btn btn-success btn-sm status-change status-active' data-path='".routeUser($path)."' id='".$id."' status='".$status."' >Active</button>";
    }
    return $html;
}

function createVerify($status, $id, $array = null, $class = 'changeVerify', $path = null) {
    if (!$array) {
        $array = ['1' => 'Verify', '0' => 'Not-verify'];
    }
    return $html = Form::select('confirmed', $array, $status, ['class' => 'form-control ' . $class, 'id' => $id, 'data-path' => $path]);
}

function createEditAction($route, $para, $type = null) {
    if ($type == 'ajax') {
        $html = '<a href="javascript:;" title="' . __('admin_lang.edit') . '"  class="btn btn-xs btn-primary edit-button" data-edit_id ="' . $para['id'] . '"><i class="fas fa-edit"></i></a>';
    } else {
        $html = '<a href="' . routeUser($route, $para) . '" data-toggle="tooltip" data-placement="top" title="' . __('admin_lang.edit') . '"  class="btn btn-xs btn-primary"><i class="fas fa-edit"></i></a>';
    }
    return $html;
}

function createChargeAction($id, $sub_exp_date) {
    $btn = "btn-success";
    $title = "Subscription expire on " . $sub_exp_date;
    if (strtotime($sub_exp_date) < strtotime(date('Y-m-d'))) {
        $btn = "btn-danger";
        $title = "Subscription expired on " . $sub_exp_date;
    }
    $html = '<a title="' . $title . '" href="javascript:void(0)" class="btn btn-xs ' . $btn . ' chargeamt" id="' . $id . '">';
    $html .= '<i class="fas fa-usd" aria-hidden="true"></i>';
    $html .= '</a>';
    return $html;
}

function createViewAction($route, $para) {
    $html = '<a href="' . route($route, $para) . '" data-toggle="tooltip" data-placement="top" title="' . __('admin_lang.view') . '" class="btn btn-xs btn-warning"><i class="fas fa-eye"></i></a>';
    return $html;
}

function createInvoiceAction($route, $para) {
    $html = '<a href="' . routeUser($route, $para) . '" data-toggle="tooltip" data-placement="top" title="' . __('admin_lang.download_invoice') . '" class="btn btn-xs btn-primary"><i class="fa fa-download" aria-hidden="true"></i>
</a>';
    return $html;
}

function createInventoryAction($route, $para) {
    $html = '<a href="' . routeUser($route, $para) . '" data-toggle="tooltip" data-placement="top" title="' . __('admin_lang.create_inventory') . '" class="btn btn-xs btn-primary">Inventory
</a>';
    return $html;
}

function createStockOutAction($route, $para) {
    $html = '<a href="' . routeUser($route, $para) . '" data-toggle="tooltip" data-placement="top" title="' . __('admin_lang.stock_out') . '" class="btn btn-xs btn-success">Stock Out
</a>';
    return $html;
}

function createIntrestedAction($route, $para) {
    $html = '<a href="' . routeUser($route, $para) . '" data-toggle="tooltip" data-placement="top" title="' . __('admin_lang.interested') . '" class="btn btn-xs btn-default"><i class="fas fa-ticket "></i></a>';
    return $html;
}

function createDefaultAction($route, $para, $class, $icon, $title) {
    $html = '<a href="' . routeUser($route, $para) . '" data-toggle="tooltip" data-placement="top" title="' . __('admin_lang.' . $title) . '" class="btn btn-xs btn-' . $class . '"><i class="fas fa-' . $icon . ' "></i></a>';
    return $html;
}

function createDeleteAction($route, $para, $base_route, $role = null) {
    $html = '<a href="javascript:void(0)" class="btn btn-xs btn-danger del" title="' . __('admin_lang.delete') . '" data-route="' . routeUser($route, $para) . '" data-base_url="' . routeUser($base_route, $role) . '">';
    $html .= '<i class="fas fa-trash"></i>';
    $html .= '</a>';
    return $html;
}

function createFloorAction($route, $para, $base_route, $role = null) {
    $html = '<a href="javascript:void(0)" class="btn btn-xs btn-primary add_floor" title="' . __('admin_lang.add_floor') . '" data-route="' . routeUser($route, $para) . '" data-base_url="' . routeUser($base_route, $role) . '">';
    $html .= __('admin_lang.add_floor');
    $html .= '</a>';
    return $html;
}

// function checkRolePermission($key, $screen = 0) {
//     if(Auth::user()->role_id==1)
//        return true;
//     $role_id = Auth::user()->role_id;
//     $q = \App\Models\Permission::where('role_id', $role_id)->whereHas('getUserPermission', function($q)use($key) {
//         $q->where('name', $key);
//     });
//     $data = $q->count();
//     if ($data > 0) {
//         return true;
//     } else {
//         if ($screen == 0) {
//             echo view('errors.permission_denied');
//             exit;
//         } else {
//             return false;
//         }
//     }
// }

// function checkPermission($user_id, $permission_id) {
//     $data = PermissionRole::where('user_id', $user_id)->where('permission_id', $permission_id)->first();
//     if (isset($data)) {
//         if ($data->permission == 1) {
//             return true;
//         } else {
//             return false;
//         }
//     } else {
//         return false;
//     }
// }


function createSelfDeleteAction($id) {
    $html = '<a href="javascript:void(0)" class="btn btn-xs btn-danger del_dis" id="' . encrypt($id) . '">';
    $html .= '<i class="fa fa-trash"></i>';
    $html .= '</a>';
    return $html;
}

function createEnDeleteAction($id, $school_id = 0) {
    $html = '<a href="javascript:void(0)" class="btn btn-xs btn-danger del_dis" id="' . $id . '" data-school="' . $school_id . '">';
    $html .= '<i class="fa fa-trash"></i>';
    $html .= '</a>';
    return $html;
}

function createLink($url, $val, $target = '') {
    $html = '<a href="' . $url . '" class="custom_link"> ' . $val . '</a>';
    if ($target != '') {
        $html = '<a href="' . $url . '" class="custom_link"> ' . $val . '</a>';
    } else {
        $html = '<a target="_blank" href="' . $url . '" class="custom_link"> ' . $val . '</a>';
    }

    return $html;
}

function YMDDateFormat($date) {
    return date('Y-m-d h:m:A', strtotime($date));
}

function uniqueRandomString($name) {
    $string = substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 4);
    return strtoupper($name . $string);
}

function userUrl($url) {
    if (Auth::user()->role_id == '2') {
        return url('admin/' . $url);
    }
    if (Auth::user()->role_id >= '3') {
        return url('subadmin/' . $url);
    }else {
        return url('admin/' . $url);
    }
}

function redirectUser($url) {
    if (Auth::user()->role_id == '2') {
        return redirect("admin/" . $url);
    } else if (Auth::user()->role_id >= '3') {
        return redirect("subadmin/" . $url);
    } else {
        return redirect("admin/" . $url);
    }
}

function redirectRoute($name, $pream = null) {
    if (isset(Auth::user()->role_id) && Auth::user()->role_id == '2') {
        if (isset($pream)) {
            return redirect()->route('admin.' . $name, $pream);
        } else {
            return redirect()->route('admin.' . $name);
        }
    } else if (Auth::user()->role_id >= '3') {
        if (isset($pream)) {
            return redirect()->route('subadmin.' . $name, $pream);
        } else {
            return redirect()->route('subadmin.' . $name);
        }
    } else {
        if (isset($pream)) {
            return redirect()->route('admin.' . $name, $pream);
        } else {
            return redirect()->route('admin.' . $name);
        }
    }
}

function routeUser($name, $pream = null) {
    if (Auth::user()->role_id == '2') {
        if (isset($pream)) {
            return route('admin.' . $name, $pream);
        } else {
            return route('admin.' . $name);
        }
    } else if (Auth::user()->role_id >= '3') {
        if (isset($pream)) {
            return route('subadmin.' . $name, $pream);
        } else {
            return route('subadmin.' . $name);
        }
    } else {
        if (isset($pream)) {
            return route('admin.' . $name, $pream);
        } else {
            return route('admin.' . $name);
        }
    }
}

function routeFormUser($name) {
    if (Auth::user()->role_id == '2') {
        return "admin." . $name;
    } else if (Auth::user()->role_id >= '3') {
        return "subadmin." . $name;
    } else {
        return "admin." . $name;
    }
}

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function calculateDimensions($width, $height, $maxwidth, $maxheight) {

    if ($width != $height) {
        if ($width > $height) {
            $t_width = $maxwidth;
            $t_height = (($t_width * $height) / $width);
            //fix height
            if ($t_height > $maxheight) {
                $t_height = $maxheight;
                $t_width = (($width * $t_height) / $height);
            }
        } else {
            $t_height = $maxheight;
            $t_width = (($width * $t_height) / $height);
            //fix width
            if ($t_width > $maxwidth) {
                $t_width = $maxwidth;
                $t_height = (($t_width * $height) / $width);
            }
        }
    } else
        $t_width = $t_height = min($maxheight, $maxwidth);

    return array('height' => (int) $t_height, 'width' => (int) $t_width);
}

function getSession() {
    $current_date = date('Y');
    $year_array = [];
    $date = '';
    $date_next = '';

    for ($i = 1; $i <= 10; $i++) {
        $b = $current_date + 1;
        $a = $current_date . '-' . substr($b, 2, 2);
        $year_array[$a] = $a;
        $current_date++;
    }
    return $year_array;
}

function secondToMinutes($seconds) {
    $minutes = floor($seconds / 60);
    $secondsleft = $seconds % 60;
    if ($minutes < 10)
        $minutes = "0" . $minutes;
    if ($secondsleft < 10)
        $secondsleft = "0" . $secondsleft;
    return $minutes . "." . $secondsleft;
}
function otpGenrate()
{
   $otp = rand(1958,9999);
   return $otp;
}
function errorApiLog($err,$request) {
    ApiLogs::create(['uri' => $request->route()->uri(), 'request' => json_encode($err),'user_id'=>isset(Auth::user()->id)?Auth::user()->id:'0']);
}


function socketEvent($req,$eventName) {
    $host_name = gethostbyaddr($_SERVER['REMOTE_ADDR']);
    dd($req);
    $ch = curl_init();
    if($host_name == 'ip6-localhost') curl_setopt($ch, CURLOPT_URL,"http://localhost:1988/".$eventName);
    else curl_setopt($ch, CURLOPT_URL,"http://demo.dev9server.com:1988/".$eventName);
    
    curl_setopt($ch, CURLOPT_POST, 1);
    //curl_setopt($ch, CURLOPT_POSTFIELDS,"postvar1=value1&postvar2=value2&postvar3=value3");

    // In real life you should use something like:
     curl_setopt($ch, CURLOPT_POSTFIELDS, 
             http_build_query(array('id' => $req->id)));

    // Receive server response ...
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $server_output = curl_exec($ch);

    curl_close($ch);

    // Further processing ...
    if ($server_output == "OK") {  } else {  }
}

if (!function_exists('base9_decode')) {
    function base9_decode() {
        return '';
    }
} 

function Content($id)
{
  $data = PageContent::find($id);
  return $data;
}

function newDeal($id)
{
  $data = TestOfferDeal::where('deal_id', $id)->first();
  return $data;
}

function getRelevant($id)
{
    $data = RelevantCategory::where('id',$id)->first();
    return $data; 
}