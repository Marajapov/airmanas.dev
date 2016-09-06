<?php

namespace Front\Controllers;

use Request;
use Input;
use App\Http\Requests;
use Model\City\ModelName as City;
use Model\District\ModelName as District;
use Model\Region\ModelName as Region;

class AjaxController extends Controller
{

    // AJAX CALL

    public function getAvailableTickets()
    {
         if(Request::ajax()) {
            $data = Input::all();
            
            dd($data);
            return $result;
        }

    }

    public function loadCities()
    {
        if(Request::ajax()) {
            $data = Input::all();

            $cities = City::where('status','<>','deleted')->where('district_id','=',$data['id'])->get();
            $result = "";
            foreach($cities as $city){
                $result .= '<option value="'.$city->id.'">'.$city->name.'</option>';
            }
            return $result;
        }
    }

    public function loadRegions()
    {
        if(Request::ajax()) {
            $data = Input::all();

            $regions = Region::where('status','<>','deleted')->where('id','=',$data['id'])->get();
            $result = "";
            foreach($regions as $region){
                $result .= '<option value="'.$region->id.'">'.$region->name.'</option>';
            }
            return $result;
        }
    }
}