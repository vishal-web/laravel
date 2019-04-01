<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fileupload;
use App\Order;
use App\User;
use File;  

class TestController extends Controller
{	

	public $number = '1';
	public $logged_in_user_id;
	
	public function navigation() {
		$data['navigation'] = [
			[ 'title' => 'Signup', 'href' => '/signup'],
			[ 'title' => 'Login', 'href' => '/login' ]
		];
		return $data['navigation'];
	}

	public function index() {
		
		$data['navigation'] = $this->navigation();

		$data['title'] = "Welcome to user dashboard";
		$data['description'] = "This is a template for a simple marketing or informational website. ";


		return view('user/user')->with($data);
		// you can also use compact at the place of with 
		// view('user.user', compact('title'));
	}

	public function login(Request $request) { 
		$data['navigation'] = $this->navigation();
		$data['title'] = 'Login'; 
		return view('user/login')->with($data);
	}

	public function validateLogin(Request $request) {
		$validator = $this->validate($request,[
			'email' => 'required',
			'password' => 'required'
		]);

		$login = \App\User::where($validator)->first();
 		
		if (!empty($login)) {
			session()->put('logged_in',TRUE);
			session()->put(['userdata' => $login->toArray()]);
			return redirect('dashboard');
		}else{
			session()->flash('authErr','You have entered wrong email or password.');
			return redirect('login');
		}
	} 

	public function signup() {
		/*
			session()->put('flash-message','Inserted Data Successfully');
			session()->flush();
			session()->flash('flash-message', 'Task was successful!');
		*/
		$data['navigation'] = $this->navigation();
		$data['title'] = 'Signup'; 
		return view('user/signup')->with($data);
	}

	public function validateSignup(Request $request) {
		$this->validate($request,[
			'name' => 'required',
			'email' => 'required|unique:users',
			'password' => 'required',
			'mobile' => 'required|unique:users,mobile',
		],[
			'mobile.unique' => 'Mobile no has already been taken'
		]); 

		$signupData = \App\User::create($request->input());

		if ($signupData) {
			session('falsh-message','');
		}else{
			session('falsh-message','');
		}

		return redirect('/signup');
	}

	public function dashboard(Request $request) {

		$logged_in_user_id = session()->get('userdata.id');
		if (!$logged_in_user_id) {
			return redirect('/login');
		}

		$data['logged_in_user'] = \App\User::find($logged_in_user_id)->toArray();
		$data['navigation'] = $this->navigation();
		$data['title'] = 'User | Dashboard';

		$data['images'] = Fileupload::all()->toArray();
		return view('user.dashboard')->with($data);
	}

	public function fileupload(Request $request) {

		/*if (!$request->hasFile('file')) {
			return redirect('/dashboard');
		}*/

		$this->validate($request,['file' => 'required|mimes:jpg,png']);

		$file = $request->file('file');


		$new_filename = time().$file->getClientOriginalName();


		echo "File Name - ";
		echo $file->getClientOriginalName();
		echo "<br>"; 

		echo "File Extension - ";
		echo $file->getClientOriginalExtension();
		echo "<br>"; 

		echo "File Real Path - ";
		echo $file->getRealPath();
		echo "<br>"; 

		echo "Display Size - ";
		echo $file->getSize();
		echo "<br>"; 

		echo "Mime Type - ";
		echo $file->getMimeType();
		echo "<br>";

		echo "Upload File to directory - ";
		$destination = "uploads";
		// $file->move($destination,$file->getClientOriginalName());

		$uploadData = ['filename' => $new_filename];
		Fileupload::create($uploadData);
 		
		$file->move($destination,$new_filename);

		return redirect('/dashboard')->with('success','File uploaded Successfully. ');
	}

	public function deleteImage(Request $request) {
		$get_deletion_data = Fileupload::find($request->route('deleteid'));


		if (!empty($get_deletion_data)) {
			
			// Remove file from directory also

			$file_path = public_path().'/uploads/';
			$file_name = $get_deletion_data->toArray()['filename'];

			$file = $file_path.$file_name;

			File::delete($file);		
	
			$get_deletion_data->delete();

			return redirect('/dashboard')->with('success','Image removed successfully.');
		}
		
		return redirect('/dashboard')->with('error','Something went wrong while removing image.');
	}

	public function createOrder(Request $request) {
		$logged_in_user_id = session()->get('userdata.id');

		if (!$logged_in_user_id) {
			return redirect('/login');
		}

		$data['logged_in_user'] = \App\User::find($logged_in_user_id)->toArray();
		$data['navigation'] = $this->navigation();
		$data['title'] = 'User | Create Order';


		$data['images'] = Fileupload::all()->toArray();
		return view('user.create-order')->with($data);
	}

	public function validateOrderForm(Request $request) {
		$data = $this->validate($request,
			[
				'firstname' => 'required',
				'lastname' => 'required',
				'email' => 'required',
				'contact' => 'required',
				'state' => 'required',
				'city' => 'required',
				'landmark' => 'required',
				'address-line1' => 'required',
			],
			[
				'address-line1.required' => 'Address line is required.'
			]
		);
 
		$logged_in_user_id = session()->get('userdata.id');

		$data['user_id'] = $logged_in_user_id;
		$data['shipping_city'] = $data['city'];
		$data['shipping_state'] = $data['state'];
		$data['shipping_landmark'] = $data['landmark'];
		$data['shipping_address1'] = $data['address-line1'];
		$data['shipping_address2'] = '';
 
		$insert_data = Order::create($data);

		if ($insert_data) {
			$message['success'] = 'Order created successfully.';
		} else {
			$message['error'] = 'Something went wrong while creating order.';
		}
		
		return redirect()->back()->with($message);
	}

	public function viewOrder(Request $request) {

		$this->checkUserLoggedIn();

		$order_id = $request->route('order_id');

		$condition = ['id' => $order_id, 'user_id' => $this->logged_in_user_id];
		$order_details = Order::where($condition)->get();

		if (empty($order_details)) {
			return redirect()->back()->with('error','Order not found');
		}

		$data['order_detail'] = $order_details->toArray();

		// $d = Order::with('user')->get()->toArray();

		// $d = User::find(1)->orders()->where('id', 1)->get()->toArray();

		$d = User::find(1)->orders()->where('id', 1)->get()->toArray();

		// $d = User::with('orders')->get()->toArray();

		$d = User::with('orders')->where('id', 1)->get()->toArray();
		
		echo '<pre>';
		print_r($data['order_detail']);
		echo '</pre>'; 
		die();

		$data['title'] = 'User | Order Detail';
		return view('user.order-details')->with($data);
	}

	public function order(Request $request) {

		$this->checkUserLoggedIn();

		$data['orders'] = Order::where('user_id', session()->get('userdata.id'))->get()->toArray();


		$data['title'] = 'User | Order List';

		return view('user.order')->with($data);
	}

	public function checkUserLoggedIn() {
		$logged_in_user_id = session()->get('userdata.id');

		if (!$logged_in_user_id) {
			return redirect('/login');
		}
	}
}