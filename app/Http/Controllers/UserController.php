<?php

namespace App\Http\Controllers;

use App\Http\Requests\postAccountAvatarRequest;
use App\Http\Requests\postAccountPasswordRequest;
use Illuminate\Http\Request;
use Validator, Image, Auth, Config, Str, Hash;
use App\Models\User;
use App\Models\Country;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getAccountEdit()
    {
        $birthday = is_null(Auth::user()->birthday) ? [null, null, null] : explode('-', Auth::user()->birthday);
        $country = Country::find(Auth::user()->nationality);

        if (is_null($country)) :
            $nationality = null;
            $data = ['birthday' => $birthday, 'nationality' => $nationality];
        else :
            $nationality = $country->name;
            $data = ['birthday' => $birthday, 'nationality' => $nationality];
        endif;
        return view('user.account_edit', $data);
    }

    public function postAccountAvatar(postAccountAvatarRequest $request)
    {
        if ($request->hasFile('avatar')) :
            $path = '/' . Auth::id();
            $fileExt = trim($request->file('avatar')->getClientOriginalExtension());
            $upload_path = Config::get('filesystems.disks.uploads_user.root');
            $name = Str::slug(str_replace($fileExt, '', $request->file('avatar')->getClientOriginalName()));

            $filename = rand(1, 999) . '_' . $name . '.' . $fileExt;
            $file_file = $upload_path . '/' . $path . '/' . $filename;

            $u = User::find(Auth::id());
            $aa = $u->avatar;
            $u->avatar = $filename;

            if ($u->save()) :
                if ($request->hasFile('avatar')) :
                    $fl = $request->avatar->storeAs($path, $filename, 'uploads_user');
                    $img = Image::make($file_file);
                    $img->fit(256, 256, function ($constraint) {
                        $constraint->upsize();
                    });
                    $img->save($upload_path . '/' . $path . '/av_' . $filename);
                endif;
                if ($aa) :
                    unlink($upload_path . '/' . $path . '/' . $aa);
                    unlink($upload_path . '/' . $path . '/av_' . $aa);
                endif;
                return back()->with('message', 'Avatar actualizado con éxito.')->with('typealert', 'success');
            endif;
        endif;
    }

    public function postAccountPassword(postAccountPasswordRequest $request)
    {
        $u = User::find(Auth::id());
        if (Hash::check($request->input('apassword'), $u->password)) :
            $u->password = Hash::make($request->input('password'));
            if ($u->save()) :
                return back()->with('message', 'La Contraseña se Actualizo con Éxito.')->with('typealert', 'success');
            endif;
        else :
            return back()->with('message', 'Su contraseña actual es errónea.')->with('typealert', 'danger');
        endif;
    }

    public function postAccountInfo(Request $request)
    {
        $rules = [
            'fullname' => 'required',
            'nationality' => 'required',
            'month' => 'required',
            'year' => 'required',
            'day' => 'required',
        ];
        $messages = [
            'fullname.required' => 'Su nombre es requerido',
            'nationality.required' => 'Su apellido es requerido',
            'month.required' => 'Su mes de nacimiento es requerido',
            'year.required' => 'Su año de nacimiento  es requerido',
            'day.required' => 'Su día de nacimiento es requerido',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) :
            return back()->withErrors($validator)->with('message', 'Se ha producido un error.')->with('typealert', 'danger')->withInput();
        else :
            $u = User::find(Auth::id());
            $u->fullname = e($request->input('fullname'));
            $u->nationality = e($request->input('nationality'));
            $u->birthday = date("Y-m-d", strtotime($request->input('year') . '-' . $request->input('month') . '-' . $request->input('day')));
            if ($u->save()) :
                return back()->with('message', 'La información se actualizo con Éxito.')->with('typealert', 'success');
            endif;
        endif;
    }
}
