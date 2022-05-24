<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Tool;
use Illuminate\Support\Facades\Auth;

class ToolController extends Controller
{
    public function index()
    {
        if (Auth::user()) {
            $user = Auth::user();
            $tools = Tool::all()->with(['key' => function ($query) use ($user) {
                $query->where('user_id', $user->id)->orderBy('updated_at', 'desc');
            }, 'game'])->get();
            return view('new.tools', compact('tools'));
        }
    }

}
