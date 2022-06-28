<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;







use App\Models\User;

//контроллер валидации и аунтефикации

class MyAuthController extends Controller    
{
	//фунция показывает форму для аунтефикации
	
    public function showLogin()
	{
		return view('auth.login',['title'=>'login']);
	}
	
	//фикция валидации и аунтефикации
	
	public function authenticate(Request $request)
	{
		
		/*
		$credentials=Validator::make($request->all(),[
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
		
			if($credentials->fails())
			{
				return redirect()->route('login')
											->withErrors($credentials)
											->withInput();
			}else{
				
				return 'Валидация прошла успешно';
			}
				*/
				/*
				if(Auth::attempt($credentials)){
				
				//$request->session()->regenerate();
					return redirect()->intended();
				}
				return back()->withErrors([
				
					'email'=>'Такого пользователя нет в базе данных',
					]);
					*/
					
					// валидация введенных данных в форму
					
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
				
				// аунтефикация пользователя
				
				 if (Auth::attempt($credentials,$request->get('remember')=='on' ? true : false)){
					 
					$request->session()->regenerate();

					return redirect()->intended(); // направление при успешной аунтефикации на домашнюю страницу(на  страницу, с которой был редирект на аунтефикацию)
					}

					return redirect()->route('register')->withErrors([       //направление на авторицазию ,если аунтефикация не состоялась
					'email' => 'Такого пользователя нет в базе данных.
								Пройдите регистрацию.',
						])->withInput();
		
	
		
	}
	

	//функия выхода из системы
	
	public function logout(Request $request)
	{
		Auth::logout();
		
		$request->session()->invalidate();
		$request->session()->regenerateToken();
		
		return redirect('home');
	}
		
}
