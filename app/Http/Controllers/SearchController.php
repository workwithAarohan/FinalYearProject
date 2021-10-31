<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search()
    {
        return view('partials.search');
    }

    public function searchUsers(Request $request)
    {

        $users = User::where('firstname', 'LIKE', '%'. $request->get('searchField') . '%')->get();

        return json_encode($users);
    }
}
