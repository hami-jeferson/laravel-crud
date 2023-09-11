<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\CallController;

class FormController extends Controller
{
    use CallController;

    public function create()
    {
        return view('form.create');
    }

    public function update($id)
    {
        $getDetails = $this->fetch(route('customer.show', $id));
        $customer = isset($getDetails['customer'])?$getDetails['customer']:[];

        return view('form.edit', compact('customer'));

    }

    public function destroy($id)
    {
        $delete = $this->fetch(route('customer.destroy', $id),'DELETE');
        return redirect()->back();
    }

}
