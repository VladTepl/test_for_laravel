<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class RegisterController extends Controller
{
	//функция показывает форму регистрации
	
	public function showRegister()
	{
		return view('auth.register',['title'=>'register']);
	}
	
	//функция валидации данных регистрации пользователя с сохранение в базу данных
	
    public function register(Request $request)
	{
		$credentials = $request->validate([
				
				'name'=>'required|max:20',
				'surname'=>'required|max:30',
				'email'=>'required|email:rfc,dns',
				'password'=>'required|min:4|confirmed',
				'password_confirmation'=>'required'
				],
				[
				'required'=>':attribute должен быть заполнен.',
				'email.email'=>'не корректный :attribute',
				'confirmed'=>'пароли не совпадают',
				'password.min'=>'пароль должен быть не меньше 4 символов'
				]); 
				
	    
	    // сохранение данных пользователя в базу данных
	    
			$user=new User;
			
			$user->name=$request->name;
			$user->surname=$request->surname;
			$user->email=$request->email;
			$user->password=Hash::make($request->password);
			$user->save();
			
		
			
		
			if (Auth::attempt($credentials,$request->get('remember')=='on' ? true : false)){
					 
					$request->session()->regenerate();

					return redirect()->intended(); // направление при успешной аутентификации на домашнюю страницу(на  страницу, с которой был редирект на аутетификацию)
					}
	}
		
}
