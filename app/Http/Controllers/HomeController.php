<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Customer;


class HomeController extends Controller
{
    public function index()
    {
         

        // Pass session data to the view
        return view('home');
    }
}
