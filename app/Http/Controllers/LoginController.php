<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Carbon\Carbon;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        return view('login');
    }

    public function autentikasiLogin(Request $request){

        $validateData = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ],[
            'username.required' => 'Username tidak boleh kosong',
            'password.required' => 'Password tidak boleh kosong',
        ]
        );
        
        if(Auth::attempt($validateData)){
            $request->session()->regenerate();
             if(Auth::user()->level === 'driver'){
                $request->session()->regenerate();

                $this->loginLog(Auth::user()->id, 'driver');

                return redirect()->intended('/driver');

            }
            else if(Auth::user()->level === 'admin'){
                $request->session()->regenerate();

                $this->loginLog(Auth::user()->id, 'admin');

                return redirect()->intended('/admin');

            }else if(Auth::user()->level = 'super_admin'){
                $request->session()->regenerate();

                $this->loginLog(Auth::user()->id, 'super_admin');

                return redirect()->intended('/super-admin');
            }
        }
        return redirect('/')->withErrors(['error' => 'Username atau password tidak valid'])->withInput();
    }

    private function loginLog($userid, $levelUser){
        $loginTime = Carbon::now()->setTimezone('Asia/Jakarta');
        session()->put('login_time', $loginTime);

        $log = new ActivityLog();
        $log->login_time = session()->get('login_time', 'default');
        $log->user_id = $userid;
        $log->user_level = $levelUser;
        $log->action = 'Login';
        $log->description = 'Login ke sistem';
        $log->save();
    }

    public function logout(Request $request){

        $this->logoutLog(Auth::user()->id, 'super_admin');

        $request->session()->flush();;
        Auth::logout();

        return redirect()->route('login');
    }

    private function logoutLog($userid, $levelUser){
        $loginTime = Carbon::now()->setTimezone('Asia/Jakarta');
        session()->put('login_time', $loginTime);

        $log = new ActivityLog();
        $log->login_time = session()->get('login_time', 'default');
        $log->user_id = $userid;
        $log->user_level = $levelUser;
        $log->action = 'Logout';
        $log->description = 'Logout dari sistem';
        $log->save();
    }
}
