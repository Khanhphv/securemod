<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ToolController extends Controller
{
    public function index($id = null)
    {
        if ($id == null) {
            return redirect('/');
        }
        exit($id);
    }
}
