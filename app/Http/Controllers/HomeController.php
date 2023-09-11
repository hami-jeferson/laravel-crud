<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\CallController;

class HomeController extends Controller
{
    use CallController;
    public function index()
    {
        $getCustomers = $this->fetch(route('customer.index'));
        $customers = isset($getCustomers['customer'])?$getCustomers['customer']:[];
        return view('customer.index', compact('customers'));
    }
}
