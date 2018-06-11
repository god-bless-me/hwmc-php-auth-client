<?php

namespace App\Http\Controllers;

use App\Models\App;
use Illuminate\Http\Request;

class AppController extends Controller
{
    public function list(Request $request)
    {
        $list = App::paginate(10);
        return view('app/list', [
            'list' => $list,
        ]);
    }

//    public function create(Request $request)
//    {
//        if ($request->isMethod('POST')) {
//            $this->validate($request, [
//                'App.name' => 'required|min:2|max:20',
//            ]);
//            $data = $request->input('App');
//            var_dump(json_encode($data));
//            if (App::create($data)) {
//                return redirect('apps');
//            }
//        }
//        return view('app/create', [
//        ]);
//    }
}
