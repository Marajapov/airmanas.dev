<?php
namespace Admin\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use Model\User\ModelName as User;
use Model\Category\ModelName as Category;
use Model\UserSubcategoryTie\ModelName as UserSubcategoryTie;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('Admin::user.index', [
            'users' => $users,
        ]);
    }
    public function create()
    {
        return view('Admin::user.create', [
            'user' => new User(),
            ]);
    }
    public function store(Request $request)
    {
        $user = User::create($request->except('password','categories','subcategories','q'));
        return redirect()->route('admin.user.index');
    }
    public function show(User $user)
    {
        return view('Admin::user.show', ['user' => $user]);
    }
    public function edit(User $user)
    {
        return view('Admin::user.edit', ['user' => $user]);
    }
    public function update(Request $request, User $user)
    {
        $user->update($request->except('q'));

        return redirect()->route('admin.user.show', $user);
    }
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.user.index');
    }
}
