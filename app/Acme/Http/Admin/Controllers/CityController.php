<?php
namespace Admin\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
//use App\Http\Controllers\Controller;
use \Model\City\ModelName as City;

class CityController extends Controller
{
    public function index()
    {
        $cities = City::where('status','<>','deleted')->orderBy('id', 'desc')->get();
        return view('Admin::city.index', [
            'cities' => $cities,
        ]);
    }
    public function create()
    {
        return view('Admin::city.create', [
            'city'  => new City,
        ]);
    }

    public function store(Request $request)
    {        
        $city = City::create($request->except('q'));
        return redirect()->route('admin.city.index');
    }
    public function show($city)
    {
        return view('Admin::city.show', [
            'city' => $city,
        ]);
    }
    public function edit(City $city)
    {
        return view('Admin::city.edit', [
            'city' => $city,
        ]);
    }
    public function update(Request $request, City $city)
    {
        $city->update($request->except('q'));
        return redirect()->route('admin.city.show', $city);
    }
    public function destroy($id)
    {
        //
    }

    // Soft delete function
    public function softDelete(Request $request, $id)
    {
        $city = City::where('id','=',$id)->first();
        $city->status = 'deleted';
        $city->save();
        return redirect()->route('admin.city.index');
    }
}
