<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\CallController;

class FormController extends Controller
{
    use CallController;

    public function create()
    {
        return view('');
    }

    public function store()
    {

    }

    public function update($id)
    {

    }

    public function edit()
    {

    }

    public function destroy($id)
    {
        $this->fetch();
    }
}
