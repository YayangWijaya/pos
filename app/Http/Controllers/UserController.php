<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $users = User::when($request->keyword, function ($q) use ($request) {
                            $q->where('name', 'ILIKE', "%" . $request->keyword . "%")
                                ->orWhere('email', 'ILIKE', "%" . $request->keyword . "%")
                                ->orWhere('phone', 'ILIKE', "%" . $request->keyword . "%");
                        })->orderBy('id','desc')->paginate(10000);

        return view('backend.user.index', compact('users'));
    }

    public function create()
    {
        return view('backend.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        User::create($request->all());

        return redirect()->route('user.index')->with('success','Data berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('backend.user.show',compact('user'));
    }

    public function edit(User $user)
    {
        return view('backend.user.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->all());

        return redirect()->route('user.index')->with('success','Data berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('user.index')->with('success','Data berhasil dihapus.');
    }
}
