<?php

use App\Http\Controllers\MyController;
use App\User;
use Facade\FlareClient\Views;
use Illuminate\Contracts\View\View as ViewView;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// php artisan serve
// http://localhost:8000

Route::get('/', function () {
    return view('Home');
});

//Tạo Route Home
Route::get('Home',function(){
    return "xin chào laravel";
});

//Truyền Tham Số Vào Route
Route::get('SanPham/{sanpham}',function($sanpham){
    return "Ten san pham la ". $sanpham;
});

Route::get('NgayThang/{ngay}/{thang}/{nam}',function($ngay,$thang,$nam){
    echo "Ngay Thang La : " .$ngay.'/'.$thang.'/'.$nam;
})->where(['ngay'=>'[0-9]+']);
// ->where(['hoten'=>'[a-zA-Z]+'])
// [0-9a-zA-Z]+
// [0-9a-zA-Z]{5}

Route::get('HoVaTen/{hoten}',function($hoten){
    echo "Ho Va Ten : " .$hoten;
});

// Định danh route , Lưu Tên Route Để Gọi Lại
Route::get('Route1',['as'=>'Route1',function(){
    echo "Hi Laravel/Route1";
}]);
Route::get('Route3',function(){
    return "Hi Route3";
})->name('Route3');

// Gọi Tên Route (Chuyển Hướng Route)
Route::get('Route2',function(){
    return redirect()->route('Route3');
});

Route::get('user/{id}',function($id){
    return "ID của bạn là : " . $id;
})->name('User');
// $user = route('User');


//Group Route
Route::group(['prefix'=>'MyGroup'],function(){
    //Domain/MyGroup/User1
    Route::get('User1',function(){
        return "Chào User1";
    });
    Route::get('User2',function(){
        return "Chào User2";
    });
    Route::get('User3',function(){
        return "Chào User3";
    });
});



// Call Controller
Route::get('CallController','MyController@Hello');

// Truyền dữ liệu cho controller
Route::get('Thamso/{ten}','MyController@ThamSo');
Route::get('HoTen/{ten}/{namsinh}','MyController@HoTen')->where(['ten'=>'[a-zA-Z]+'])->where(['namsinh'=>'[0-9]+'])->name('HoTen');
Route::get('Xinchao/{name}/{namsinh}','MyController@getXinChao')->name('Xinchao');
Route::get('Tambiet/{name}/{namsinh}','MyController@getTamBiet')->name('Tambiet');
//URL
Route::get('MyRequest','MyController@GetURL');

// Gửi và nhận dữ liệu với request
Route::get('getForm',function(){
    return view('postForm');
});
Route::post('postForm',['as'=>'postForm','uses'=>'MyController@postForm']); 

//Call Views bằng controller
Route::get('Abc/{username}/{password}','Mycontroller@Abc')->name('Abc');
Route::get('Register','Mycontroller@Register')->name('Register');

Route::get('Login',['as'=>'Login','uses'=>'Mycontroller@Login']);
Route::post('postLogin',['as'=>'postLogin','uses'=>'Mycontroller@postLogin']);

//Dùng chung dữ liệu trên Views
View::share('Name',"Đây là views đã đc share");

//Set Cookie
Route::get('setCookie','MyController@setCookie')->name('setCookie');
Route::get('getCookie','Mycontroller@getCookie')->name('getCookie');

//Upload File
Route::get('getFile',function(){
    return view('postFile');
})->name('getFile');
Route::post('postFile',['as'=>'postFile','uses'=>'Mycontroller@postFile']);

//JSON
Route::get('getJson','Mycontroller@getJson');

//Admin Blade Template
Route::get('Blade/{str}','Mycontroller@Blade');
Route::get('Loaitin','Mycontroller@LoaiTin')->name('LoaiTin');
Route::get('Theloai','Mycontroller@TheLoai')->name('TheLoai');
Route::get('Admin','Mycontroller@indexAdmin')->name('Admin');

// User Blade Template
Route::get('Lienhe','Mycontroller@LienHe')->name('Lienhe');
Route::get('User','Mycontroller@indexUser')->name('User');


//Làm Việc Với Database
// Tạo Table
Route::get('Database','Mycontroller@TaoDB')->name('Database');
Route::get('HoaDon','Mycontroller@TaoTable')->name('HoaDon');

// Tạo Table có khóa phụ
Route::get('SanPham','Mycontroller@SanPham')->name('SanPham');

// Xóa 1 cột trong table
Route::get('XoaCollum','Mycontroller@XoaCollum')->name('XoaCollum');

// Thêm 1 cột trong table
Route::get('ThemCollum','Mycontroller@ThemCollum')->name('ThemCollum');

// Đổi tên table
Route::get('DoiTen','Mycontroller@DoiTen')->name('DoiTen');

// Xóa table
Route::get('XoaTable','Mycontroller@XoaTable')->name('XoaTable');


// QueryBuild
Route::get('Query/get','Mycontroller@Query');

Route::get('Schema/create-table','Mycontroller@create_table');



