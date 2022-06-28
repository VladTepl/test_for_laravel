<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
	
	//функия показывает домашнюю страницу
	
	public function show()
	{
		return view('auth.home',['title'=>'home']);
	}
}