<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\category;
use App\state;
use App\Address;
use DB;

class DropdownController extends Controller
{
    /**
     * Fetch the states as per the country id.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return the json object of the states
     */
    public function country(Request $request){
		$cat_id = input::get('cat_id');
		$state = DB::table('states')->where('countryID', $cat_id)->get();
		return Response::json($state);
	}

	/**
     * Fetch the states as per the country id.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return the json object of the states
     */
	public function states(Request $request, $id){
		$cat_id = $request->id;
		//dd($cat_id);
		return $state = DB::table('states')->where('countryID', $cat_id)->get();
		return json_decode($state);
	}

	/**
     * Fetch the categories as per the parent id
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return the json object of the subcategories
     */
	public function subCategories(Request $request, $id){
		$cat_id = $request->id; 
	 	$subcategories = Category::where('parent_id','=',$cat_id)->get();
	  	return json_decode($subcategories);
  	}

  	/**
     * Fetch the addresses.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return the json object of the addresses
     */
  	public function address(Request $request, $id){
	  	$add_id = $request->id; 
	  	$addresses = DB::table('addresses')
	  					->leftJoin('country', 'country.id', '=', 'addresses.countryID')
	  					->leftJoin('states', 'states.id', '=', 'addresses.stateID')
	  					->select('addresses.*','country.country_name','states.state_name')
	  					->where('addresses.id',$add_id)
	  					->get();
	  	return json_decode($addresses);
	}
}
