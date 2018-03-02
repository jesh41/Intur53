<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Validator;
use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Models\Permission;
use Storage;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function acerca()
    {
        return view('admin.about');
    }

    public function ayuda()
    {
        return view('admin.help');
    }

    public function descargarmanual()
    {

        if (Auth::user()->isRole('administrador')) {
            $path = storage_path('archivos/manual_admin.pdf');
        } elseif (Auth::user()->isRole('hotel')) {
            $path = storage_path('archivos/manual_hotel.pdf');
        } elseif (Auth::user()->isRole('intur')) {
            $path = storage_path('archivos/manual_intur.pdf');
        } else {
            return back();
        }

        return response()->download($path);
    }





}
