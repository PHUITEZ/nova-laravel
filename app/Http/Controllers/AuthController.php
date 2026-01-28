<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class AuthController extends Controller{
public function showLoginForm(){
return view('auth.login');
}
public function login(Request $request){
$credentials=$request->validate(['email'=>'required|email','password'=>'required']);
if(Auth::attempt($credentials)){
$request->session()->regenerate();
if(Auth::user()->role==='admin'){
return redirect()->route('admin.dashboard');
}
return redirect()->intended(route('home'));
}
return back()->withErrors(['email'=>'Thông Tin Đăng Nhập Không Chính Xác']);
}
public function showRegisterForm(){
return view('auth.register');
}
public function register(Request $request){
$validated=$request->validate(['name'=>'required','email'=>'required|email|unique:users','password'=>'required|min:6|confirmed']);
$user=User::create(['name'=>$validated['name'],'email'=>$validated['email'],'password'=>Hash::make($validated['password']),'role'=>'user']);
Auth::login($user);
return redirect()->route('home');
}
public function logout(Request $request){
Auth::logout();
$request->session()->invalidate();
$request->session()->regenerateToken();
return redirect()->route('home');
}
}