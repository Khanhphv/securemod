<?php
namespace App\Service;

use App\Option;

class OptionService
{
    public function getOption($lang) {
        return Option::select('option', 'value')->where('locate', $lang)->get()->keyBy('option')->pluck('value', 'option');
    }

    public function updateOption($request) {
        foreach ($request->all() as $key => $value) {
            Option::where('option', $key)->where('locate', '=', $request->locate)->update(['value' => $value, 'locate' => $request->locate]);
        }
    }
}
