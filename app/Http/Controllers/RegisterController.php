<?php

namespace App\Http\Controllers;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\User;
class RegisterController extends Controller
{
// public function register(RegisterRequest $request){
    
//     $user=User::create($request->validate($request->rules()));
    
//     if ($user) {
//         return redirect()->route('login.login')->with("message", "Usuario registrado correctamente");
       
//     } else {
//         return back()->with("error", "Error al registrar usuario");
//     }

// }
public function register(RegisterRequest $request)
    {
     
        $user = User::create($request->validated());

        if ($user) {
          
            $rol = $request->input('rol');

         
            $role = Role::where('name', $rol)->first();

            if ($role) {
           
                $user->assignRole($role);
            } else {
             
                return back()->with("error", "El rol especificado no existe");
            }

           
            // return redirect()->route('login.login')->with("message", "Usuario registrado correctamente");
        } else {
          
            return back()->with("error", "Error al registrar usuario");
        }
    }
}
