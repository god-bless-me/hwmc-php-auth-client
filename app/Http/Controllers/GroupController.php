<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function __constrict()
    {
        parent::__construct();
    }

    public function list(Request $request) {
        $limit = $request->input('limit');
        if (!$limit) $limit = 10;
        $list = Role::paginate($limit);
        return view('group/list', [
            'user' => $request->user(),
            'list' => $list,
            'limit' => $limit,
        ]);
    }

    public function create(Request $request)
    {
        if ($request->isMethod('POST')) {
            $this->validate($request, [
                'Group.name' => 'required|min:2|max:20',
            ]);
            $data = $request->input('Group');
            if (Role::create($data)) {
                return redirect('groups');
            }
        }
        return view('group/create', [
            'user' => $request->user(),
        ]);
    }
}
