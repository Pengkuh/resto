<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login()
    {
        return view('Auth/login');
    }
    public function register()
    {
        return view('Auth/regist');
    }
    public function storeRegister(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');

        // dd($request->all());

        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email|unique:users',
            'address' => 'required',
            'password' => 'required|min:5',
            'password_confirm' => 'required|min:5|same:password',
        ]);

        $user = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'password' => Hash::make($request->password),
            "created_at" =>  date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),

        ];

        // dd($user);

        DB::table('users')->insert($user);

        $text = "Terima Kasih Telah Melakukan Pendaftaran 
        berikut akun anda :
        email : $request->email
        password : $request->password

        silahkan melakukan login dengan akun yang anda daftarkan terimakasih.
        ";
        $token = "B58s8FPu34t#KnhMvkYd";
        // dd($message);
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.fonnte.com/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'target' => $request->phone,
                'message' => $text,
                'countryCode' => '62', //optional
            ),
            CURLOPT_HTTPHEADER => array(
                "Authorization: $token" //change TOKEN to your actual token
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        if ($user) {
            Session::flash('status', 'success');
            Session::flash('message', "Regist Success Lets Login");
        };

        return view('Auth/login');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();



        return redirect('/login');
    }

    public function authenticating(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('admin')->attempt($credentials)) {
            // dd("here");
            return redirect()->intended('/dashboard');
        }

        if (Auth::guard('web')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/booking');
        }

        Session::flash('status', 'gagal');
        Session::flash('message', 'Wrong');

        return back()->withErrors([
            'email' => 'not records',
        ])->onlyInput('email');
    }
}
