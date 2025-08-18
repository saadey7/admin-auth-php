<?php

namespace Mughal\AdminAuth\Controllers;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Notifications\EmailVerificationRequest;
use App\Models\EmailVerfication;
use App\Notifications\PasswordResetRequest;
use App\Notifications\PasswordResetSuccess;
use App\Models\PasswordReset;
use App\Models\User;
use App\Models\Admin;
use Validator;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    protected $guard = 'admin';
    use AuthenticatesUsers;
    protected $redirectTo = '/admin';
    protected $loginPath = '/admin/login';
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout');
    }


    public function show_login_form()
    {
        if (Auth::guard('admin')->check()) {
            return redirect('/admin');
        }
        return view('adminauth::admin.auth.login');
    }

    public function process_login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect($this->loginPath)->with('error', $validator->errors());
        }
        $admin = Admin::where('email', $request->email)->first();

        if (!$admin) {
            return redirect($this->loginPath)->with('error','Je e-mail of wachtwoord is ongeldig!');
        }
        if (Auth::guard('admin')->attempt(['email' => $admin->email, 'password' => $request->password], $request->get('remember'))) {
            return redirect('/admin');
        }
        return redirect($this->loginPath)->with('error','Je e-mail of wachtwoord is ongeldig!');
    }

    public function show_signup_form()
    {
        if (Auth::guard('admin')->check()) {
            return redirect('/admin');
        }
        return view('adminauth::admin.auth.register');
    }

    public function process_signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:admins',
            'password' => 'required|min:6',
        ]);
        if ($validator->fails()) {
            return redirect('admin/register')->with('error', $validator->errors());
        }
        Admin::create([
            'name' => trim($request->input('name')),
            'email' => strtolower($request->input('email')),
            'password' => bcrypt($request->input('password')),
        ]);
        return redirect('/admin')->with('success','Je account is aangemaakt');
    }

    public function passwordResetForm()
    {
        if (Auth::guard('admin')->check()) {
            return redirect('/admin');
        }
        return view('adminauth::admin.auth.rest-pass-form');
    }

    public function confirmForm(Request $request)
    {
        if (Auth::guard('admin')->check()) {
            return redirect('/admin');
        }
    
        $email = $request->email;
    
        return view('adminauth::admin.auth.reset-pass-code', compact('email'));
    }
   
    public function forgot(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
        ]);
        if ($validator->fails()) {
            return redirect('admin/reset_password')->with('error','Je e-mail of wachtwoord is ongeldig!');
        }
        $user = Admin::where('email', $request->email)->first();
        if (!$user)
            return redirect('admin/reset_password')->with('error','Gebruiker niet gevonden met dit e-mailadres!');

        $passwordReset = PasswordReset::updateOrCreate(
            ['email' => $user->email],
            [
                'email' => $user->email,
                'pin' => mt_rand(1000, 9999),
            ]
        );
        if ($user && $passwordReset)
            $user->notify(
                new PasswordResetRequest($passwordReset->pin)
            );

        session()->flash('success', 'We hebben jouw wachtwoordresetlink gemaild!');
        return view('adminauth::admin.auth.reset-pass-code', ['email' => $request->email]);
    }
    
    public function resetCodeForm(){
        $email = session('email');
        return view('adminauth::admin.auth.reset-pass-code', ['email' => $email]);
    }

    public function reset(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string|confirmed',
            'pin' => 'required|string'
        ]);
        if ($validator->fails()) {
            return redirect('admin/confirm-form')->with('error',$validator->errors());

        }

        $passwordReset = PasswordReset::where([
            ['pin', $request->pin],
            ['email', $request->email]
        ])->first();
        if (!$passwordReset)
            return redirect('/admin/confirm-form')->with('error','Deze wachtwoordresettoken is ongeldig.');
        $user = Admin::where('email', $passwordReset->email)->first();
        if (!$user)
            return redirect('admin/confirm-form')->with('error', "We kunnen geen gebruiker vinden met dat e-mailadres.");
        $user->password = bcrypt($request->password);
        $user->save();
        $passwordReset->delete();
        $user->notify(new PasswordResetSuccess($passwordReset));
        return redirect('/admin/login')->with('success', "Wachtwoord succesvol gewijzigd");

    }
    
     public function verifyEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with(['error',$validator->errors(), 'email', $request->email]);
        }
        $otp = implode('', $request->input('otp'));
        if($otp){
            $verifyEmail = EmailVerfication::where([
                ['pin', $otp],
                ['email', $request->email]
            ])->first();
            if (!$verifyEmail){
                return redirect()->back()->with(['error','Dit token is ongeldig.', 'email', $request->email]);
            }
            $client = Admin::where('email', $verifyEmail->email)->update(['email_verified_at' => Carbon::now()]);
            $verifyEmail->delete();
            return redirect('/admin/login')->with('success', "E-mail succesvol geverifieerd");
        }else{
            return redirect()->route('admin.change-password')->with('email', $request->email);
        }
    }
    
      public function changePassword()
    {
        if (Auth::guard('admin')->check()) {
            return redirect('/admin');
        }
        $email = session('email');
        return view('adminauth::admin.auth.change-password', compact('email'));
    }
    
    
    public function confirmCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('error',$validator->errors());
        }
        
        $user =Admin::where('email', $request->email)->first();
        if (!$user){
            return redirect()->back()->with('error','Gebruiker niet gevonden met dit e-mailadres!');
        }
        
        $otp = implode('', $request->input('otp'));
        if($otp){
            $passwordReset = PasswordReset::where([
                ['pin', $otp],
                ['email', $request->email]
            ])->first();
            if (!$passwordReset){
                session()->flash('error', 'Deze wachtwoordresettoken is ongeldig.');
                return redirect()->route('admin.resetCodeForm')->with('email', $request->email);
                // session()->flash('error', 'Deze wachtwoordresettoken is ongeldig.');
                // // return view('adminauth::admin.auth.reset-pass-code', ['email' => $request->email]);
                // return redirect('admin/reset_password')->with('error', 'Deze wachtwoordresettoken is ongeldig.');
            }
            session()->forget('success');
            return view('adminauth::admin.auth.change-password', ['email' => $request->email, 'pin' => $otp]);
        }else{
            return redirect()->back()->with('error','Otp is vereist');
        }
    }
    


    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.storelogin');
    }
}