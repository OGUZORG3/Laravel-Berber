<?php

namespace App\Http\Controllers\BerberBackend;

use App\Http\Controllers\Controller;
use App\Models\berber_blog;
use App\Models\berber_detay;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class DefaultController extends Controller
{
    public function index()
    {
        $berber=berber_detay::where('user_id',Auth::user()->id)->pluck('berber_prof_tiklanma');
        $blogs = berber_detay::where('user_id', Auth::user()->id)
            ->select('id')
            ->first();
        if ($blogs) {
            $id = $blogs->id;
            // İşlemleri burada devam ettirin
        }

        $blog=berber_blog::where('blog_creator_id',$id)->count();

        $blogtik=berber_blog::where('blog_creator_id',$id)->sum('tiklanma_sayisi');
        return view('berberbackend.default.index')->with(compact('berber','blog','blogtik'));

    }
   

   public function login()
   {
    return view('berberbackend.default.login');
   }



   public function logout()
   {

    return redirect(route('berber.login'))->with('success','Güvenli Çıkış Yapıldı');
   }
    public function authenticate(Request $request)
    {
        $request->flash();
        $credentials=$request->only('email','password');
        $remember_me=$request->has('remember_me') ? true : false;

        if (Auth::attempt($credentials,$remember_me))
        {
            return redirect()->intended(route('berber.index'));
        } else {
            return back()->with('error','Hatalı Kullanıcı');
        }
    }
    public function kayit(){
        return view('BerberBackend.default.kayit');
    }

    public function store(Request $request)

    {



        if ($request->hasFile('user_file')) {
            $request->validate([
                'user_file' => '|image|mimes:jpg,jpeg,png|max:2048',
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required|Min:6'
            ]);

            $file_name = uniqid() . '.' . $request->user_file->getClientOriginalExtension();
            $request->user_file->move(public_path('../images/users'), $file_name);
        } else {

            $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required|Min:6'
            ]);
            $file_name = null;
        }
        $randomString = uniqid(); // 8 karakter uzunluğunda rastgele bir dize oluşturur

        $randomString = substr(uniqid(), 0, 5);
        $numericOnly = preg_replace("/[^0-9]/", "", $randomString);

        $user2 = berber_detay::insert(
            [
                'user_id' => $numericOnly,
                "created_at" => now(),
                "berber_isim" => $request->name,
                "berber_soyisim" => $request->surname,
                "berber_file" => $file_name,
            ]
        );
        $user = User::insert(
            [
                "id" => $numericOnly,
                "role" => 'berber',
                "name" => $request->name,
                "surname" => $request->surname,
                "email" => $request->email,
                "user_file" => $file_name,
                "password" => Hash::make($request->password),
            ]
        );

        if ($user) {
            return redirect(route('berber.login'))->with('success', 'İşlem Başarılı');
        }
        return back()->with('error', 'İşlem Başarısız');
    }


}
