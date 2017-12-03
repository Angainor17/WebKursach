<?php
/**
 * Created by PhpStorm.
 * User: angai
 * Date: 16.11.2017
 * Time: 20:41
 */

namespace App\Http\Controllers;


use App;
use Illuminate\Http\Request;


class LanguageController extends Controller
{

    function changeLanguage(Request $request)
    {
        if ($request->ajax()) {
            $reqLocale = $request->locale;
            $request->session()->put('locale', $reqLocale);
            $request->session()->flash('alert-success', 'app.Locale_Change_Success');
            return json_encode($reqLocale);
        }
    }

}