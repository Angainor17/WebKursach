<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function uploadFile(Request $request)
    {
        if ($request->isMethod('post')) {

            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $fileName = (uniqid(rand(), true)) .
                    $file->getClientOriginalName();
                $file->move(
                    public_path() . '/uploads', $fileName
                );
            }
        }
    }

    protected function getDateFormat()
    {
        return 'U';
    }
}
