<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Redirect;
use Session;
use App\Igr;
use App\User;
use Hash;
use Input;
use Image;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
	//protecting route
	public function __construct()
	{

		$this->middleware('auth', ['except' => [
		     'index','logout','store','admin'
		 ]]);

	}

	////////////////////////////////////////////////////////////////////////////////////////////////////

	//display login page
	public function index()
	{

		if (Auth::user()) {
			return Redirect::to("/dashboard");
		}

		//setting the menu active
		$sidebar = "dashbaord";
		return view("admin.login",compact("sidebar"));
	}

	//////////////////////////////////////////////////////////////////////////////////////////////////////

	//processing login parameter
	public function store(Request $request)
	{

		if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
			
			return redirect()->intended('/dashboard');
		}else{
			Session::flash("warning","Failed! Invalid login credentails");
			return Redirect::to("/");
		}
	}

	//////////////////////////////////////////////////////////////////////////////////////////////////////

    //Displaying dashboard page
	public function dashboard()
	{
		//setting the side bar
		$sidebar = "dashbaord";
		return view("admin/dashboard",compact("sidebar"));
	}

	///////////////////////////////////////////////////////////////////////////////////////////////////

	//logout from the system
	public function logout()
	{
		if (Auth::check()) {
		    Auth::logout();
		    return redirect('/');
		} else {
	        Auth::logout();
	        return redirect('/');
		}
	}

	//////////////////////////////////////////////////////////////////////////////////////////////////////

	//redirecting to the homepage
	public function admin()
	{
		return Redirect::to("/");
	}

	/////////////////////////////////////////////////////////////////////////////////////////////////

	//onboarding igr
	public function igr()
	{
		$sidebar = "igr";
		$igr = Igr::all();
		return view("agency.igr", compact("sidebar",'igr'));
	}

	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	//storing IGR
	public function igr_store(Request $request)
	{
		//validate
		$this->validate($request, [
		    'state_name' => 'required|min:3',
		    'igr_abbre' => 'required',
		]);

		//checking logo is selected
		if (! Input::file()) {
			Session::flash("warning","Failed! Upload a Logo");
			return Redirect::back();
		}

		//upload logo to the folder
		$image = Input::file('file');
		$filename  = time() . '.' . $image->getClientOriginalExtension();

		$path = public_path('logo/' . $filename);
		
		//resizing the image
		Image::make($image->getRealPath())->resize(220, 49)->save($path);
		$request['logo'] = $filename;
		

		//generate random digit number
		$request['igr_key'] = $this->random_number(11);
		$request['igr_code'] = "IGR".$this->random_number(5);

		//check if the name exist
		if ($igr = Igr::where("state_name",$request->input("state_name"))->first()) {

			Session::flash("warning","Failed! IGR Exist");
			return Redirect::back();
		}

		//insert into db
		if (Igr::create($request->all())) {

			Session::flash("message","Success! IGR Onboarded");
			return Redirect::back();

		}

		//reture response
		Session::flash("warning","Failed! Unable to onboard IGR");
		return Redirect::back();
	}

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	//deleting igr from the portal
	public function delete_igr($id)
	{
		//checking user right
		if ( ! Auth::user()->hasRole('Superadmin')) {

		   Session::flash("warning","You don't have the right to delete MDA");
		   return Redirect::back();
		}

		//deleting the mda
		if ($igr = Igr::where("igr_key",$id)->first()) {
		   $igr->delete();

		   Session::flash("message","Successful! IGR deleted");
		   return Redirect::back();
		}

		Session::flash("warning","Failed! IGR not deleted");
		return Redirect::back();
	}

	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//editing igr biller
	public function edit_igr($id)
	{
		//checking user right
		if ( ! Auth::user()->hasRole('Superadmin')) {

		   Session::flash("warning","You don't have the right to delete MDA");
		   return Redirect::back();
		}

		//checking if the biller exist
		if ($igr = Igr::where("igr_key",$id)->first()) {
			$sidebar = "igr";
			return view("agency.igr_edit",compact("igr","sidebar"));
		}

		Session::flash("warning","Failed! IGR does not exist");
		return Redirect::back();
	}

	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//storing edited biller
	public function edit_igr_store(Request $request)
	{
		//validate
		$this->validate($request, [
		    'state_name' => 'required|min:3',
		    'igr_abbre' => 'required',
		]);

		//checking original logo exist and unlinking
		$igr = Igr::find($request->id);

		//uploading new image
		if (Input::file()) {

			if(file_exists(public_path('logo/' . $igr->logo)) && $igr->logo != null){

				unlink(public_path('logo/' . $igr->logo));
			}

			//upload logo to the folder
			$image = Input::file('file');
			$filename  = time() . '.' . $image->getClientOriginalExtension();

			$path = public_path('logo/' . $filename);
			
			//resizing the image
			Image::make($image->getRealPath())->resize(220, 49)->save($path);

			$igr->update(['state_name'=>$request->state_name,'igr_abbre'=>$request->igr_abbre,"logo"=>$filename]);

			Session::flash("message","Success! Biller edited");
			return Redirect::to("/igr");
		}

		$igr->update(['state_name'=>$request->state_name,'igr_abbre'=>$request->igr_abbre]);

		Session::flash("message","Success! Biller edited");
		return Redirect::to("/igr");
	}

	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	//changing password
	public function change_password()
	{
		$sidebar = "password";
		return view("admin.change_password",compact("sidebar"));
	}


	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	//storing changing password
	public function change_password_store(Request $request)
	{
		//validation
		$this->validate($request, [
		    'old_password' => 'required',
		    'new_password' => 'required',
		    'confirm_new_password' => 'required|same:new_password',
		]);

		//check if old password exist
		if (! Hash::check($request->old_password, Auth::user()->password) ) {

			Session::flash("warning","Failed! Old password does not exist");
			return Redirect::back();
		}

		//hash the new password
		$new_password = Hash::make($request->new_password);

		//insert record i to db
		if ($user = User::find($request->id)) {
			$user->update(["password"=>$new_password]);

			Session::flash("message","Successful! Password changed");
			return Redirect::back();
		}

		Session::flash("warning","Failed! Unable to change password");
		return Redirect::back();
	}


	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	//editing profile
	public function edit_profile()
	{
		$sidebar = "edit_profile";
		return view("admin.edit_profile",compact("sidebar"));
	}

	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	//generating random digit number
	private function random_number($size = 5)
	{
	   $random_number='';
	   $count=0;
	   while ($count < $size ) 
	   {
	      $random_digit = mt_rand(0, 9);
	      $random_number .= $random_digit;
	      $count++;
	   }
	   return $random_number;  
	}

}
