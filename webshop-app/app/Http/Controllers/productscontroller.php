<?php

namespace App\Http\Controllers;

use App\Models\products;
use Illuminate\Http\Request;

class productscontroller extends Controller
{

    public function edit(products $id)
    {
        return view('edit', ['product' => $id]);
    }


    public function update(Request $request, products $id)
    {
        $formfields = $request->validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'required'
        ]);

        $id->update($formfields);

        return redirect('/admin');
    }
    public function destroy(products $id)
    {
        $id->delete();
        return redirect('/admin');
    }
}
