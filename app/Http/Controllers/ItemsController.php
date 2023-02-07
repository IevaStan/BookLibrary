<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ItemsController extends Controller
{
    public function show($id)
    // public function show($name, $price)
    {
        return view('items/show', [
            'id' => 1,
            'name' => "Apelsinas",
            // 'name' => $name,
            'price' => 1.59
            // 'price' => $price,
        ]);
    }
    public function index()
    {
        $preke1 =
            [
                'id' => 1,
                'name' => "Obuolys",
                'price' => 1.29
            ];
        $preke2 =
            [
                'id' => 2,
                'name' => "Bananas",
                'price' => 1, 79
            ];

        return view('items/index', ['prekes' => [$preke1, $preke2]]);
    }
}
