<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::query();

        if ($request->has('keyword')) {
            $users = $users->where('id', "{$request['keyword']}")
                        ->orwhere('name', 'like', "%{$request['keyword']}%")
                        ->orwhere('email', 'like', "%{$request['keyword']}%")
                        ->orwhere('phone', 'like', "%{$request['keyword']}%")
                        ->orwhere('postal_code', 'like', "%{$request['keyword']}%")
                        ->orwhere('address', 'like', "%{$request['keyword']}%");
        }

        $users = $users->paginate(15);

        return view('admin.users.index', compact('users'));
    }

    public function changeStatus(User $user)
    {
        $user->update(['deleted_at' => $user->deleted_at ? null : Carbon::now()]);

        return redirect()->route('admin.users.index');
    }
}
