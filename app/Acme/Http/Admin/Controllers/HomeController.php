<?php
namespace Admin\Controllers;
class HomeController extends Controller {

	public function __construct()
	{
	}
	public function Home()
	{
		return view('Admin::home', [
        	]);
		
	}
	public function History()
	{
		return view('Admin::layouts.history');
	}

}