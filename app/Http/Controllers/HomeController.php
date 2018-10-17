<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
//        eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9
//        eyJpc3MiOiJodHRwOi8vYmxvZy5mdW5tYXJ0LmNvbS9hcGkvYXV0aC9sb2dpbiIsImlhdCI6MTUzOTE2NDg2MiwiZXhwIjoxNTM5MTY4NDYyLCJuYmYiOjE1MzkxNjQ4NjIsImp0aSI6IjB2NkVQaU5tRVIxelhmaWsiLCJzdWIiOjEsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjciLCJuYW1lIjoiaHlqIn0
//        m5UB3-DxOe3fbIukFR8NQanhYoa9c7CHZvHR5V4MIsk
        echo date('Y-m-d H:i:s','1539168462');
        dd(base64_decode('eyJpc3MiOiJodHRwOi8vYmxvZy5mdW5tYXJ0LmNvbS9hcGkvYXV0aC9sb2dpbiIsImlhdCI6MTUzOTE2NDg2MiwiZXhwIjoxNTM5MTY4NDYyLCJuYmYiOjE1MzkxNjQ4NjIsImp0aSI6IjB2NkVQaU5tRVIxelhmaWsiLCJzdWIiOjEsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjciLCJuYW1lIjoiaHlqIn0'));
//        return view('home');
    }
}
