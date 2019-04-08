<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use DB;
use Hash;
use Validator;
use Session;
use Route;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserController extends Controller {

	public function __construct(Request $request) {

		$this->middleware(function ($request, $next) {
			checkPermission();
			return $next($request);
		});
	}

	public function index(Request $request) {

		
		$role = Role::where(['name' => 'Admin'])->first();

		/*
			// create a role			
			$role = Role::create(['name' => 'Admin']);

			// create a permission
			$permission = Permission::create(['name' => 'publish-post']);
			
			// assign role to permission
			$role->givePermissionTo($permission);
			
			// assign permission to role
			$permission->assignRole($role);
		*/

		/*
			// get all permissions and assign to role -
			$getPermissions = Permission::all()->toArray();
			
			foreach ($getPermissions as $permission) {
				// assign role to permission
				$role->givePermissionTo(['name' => $permission['name']]); 
			}

			// get role assigned permission 
			$role->getAllPermissions();
		*/

		// assign permission to user 
		auth()->user()->givePermissionTo(['name' => 'publish-post']);

		// get all permissions of a user 
		$userAllPermission = auth()->user()->getAllPermissions()->toArray();

		// assign role or permission to a user  
		auth()->user()->assignRole('Publisher');

		// get permission via role 
		$userPermissionViaRoles = auth()->user()->getPermissionsViaRoles()->toArray();

		// get direct permission
		$userDirectPermission = auth()->user()->getDirectPermissions()->toArray();

		echo '<pre>';
		echo 'User All Permissions'.'<br><br>';
		print_r($userAllPermission);
		echo '<hr>';

		echo 'User Permissions Via Roles'.'<br><br>';
		print_r($userPermissionViaRoles);
		echo '<hr>';

		echo 'User Direct Permissions'.'<br><br>';
		print_r($userDirectPermission); 
		echo '</pre>';
		die();
	
		/*
		return "Hello";
		$data['title'] = '';
		return view('', $data);
		*/
	}

	public function testing() {
		echo "1";
		die();
	}

	public function create(Request $request) {
		$data['title'] = '';
		return view('', $data);
	}

	public function store(Request $request) {
		$data['title'] = '';
		return view('', $data);
	}

	public function show(Request $request) {
		$data['title'] = '';
		return view('', $data);
	}

	public function edit(Request $request) {
		$data['title'] = '';
		return view('', $data);
	}

	public function update(Request $request) {
		$data['title'] = '';
		return view('', $data);
	}

	public function destroy(Request $request) {
		$data['title'] = '';
		return view('', $data);
	}

	public function manageUser(Request $request) {
		$data['users'] = User::all();
		$data['title'] = 'Manage User';
		return view('user.manage-user',$data);
	}

	public function roleManagement(Request $request) {

		$data['permissions'] = Permission::all();

		$data['title'] = 'Role Management';
		return view('user.role-management', $data);
	}

	public function validateRolePermission(Request $request) {
		$validator = Validator::make($request->all(),
			[
				'permission' => 'required'
			]
		);

		if ($validator->fails()) {
			return redirect()->back()->withErrors($validator);
		} else {

			$user = auth()->user();
			$permission = Permission::find($validator->getData(), ['name'])->toArray();
			$permission_assigned = $user->givePermissionTo($permission);

			$username = $user->name;

			if ($permission_assigned) {
				$return['success'] = 'Permission successfully assigned to '.$username;
			} else {
				$return['error'] = 'Something went wrong while assigning permission to '.$username;
			}

			return redirect()->back()->with($return);
		}
	}

	public function createPermission(Request $request) {
		$data['update_id'] = 0;
		$data['form_location'] = '/permission/create';
		$data['title'] = 'Role Management';
		return view('user.create-permission', $data);
	}

	public function assignPermissionToUser(Request $request) {

		$user_id = $request->route('user_id');
		
		$d = User::find($user_id)->roles->toArray();  

		$data['username'] = auth()->user()->name;
		$data['permissions'] = Permission::all();
		$data['roles'] = Role::all();
		$data['update_id'] = 0;
		$data['form_location'] = '/user/'.$user_id.'/permission';
		$data['title'] = 'Role Management';
		return view('user.assign-permission', $data);
	}

	public function assignRoleToUser(Request $request) {

		$user_id = $request->route('user_id');
		
		$user  = User::find($user_id);
		$roles = $user->roles->toArray();
		$roles = !empty($roles) ? array_column($roles,'pivot') : [];
		$roles = !empty($roles) ? array_column($roles,'role_id') : [];

		$data['username'] = $user->name; 
		$data['roles'] = Role::all();
		$data['assigned_roles'] = $roles;
		$data['update_id'] = 0;
		$data['form_location'] = '/user/'.$user_id.'/role';
		$data['title'] = 'Role Management';
		return view('user.assign-role', $data);
	}

	public function validateAssignPermissionToUser(Request $request) {
		
		$submit = $request->input('submit'); 
		$assign_role = $assign_permission = FALSE;

		if ($submit == 'Assign Permissions') {
			$validation_rules = [
				'rules' => [
					'permission' => 'required'
				],
				'rules_label' => [
					'permission.required' => 'Permission is required'
				]
			];
			$assign_permission = TRUE;			
		}

		if ($submit == 'Assign Roles') {
			$validation_rules = [
				'rules' => [
					'role' => 'required'
				],
				'rules_label' => [
					'role.required' => 'Role is required'
				]
			];
			$assign_role = TRUE;
		}

		$validator = Validator::make($request->all(),$validation_rules['rules'],$validation_rules['rules_label']);

		if ($validator->fails()) {
			return redirect()->back()->withErrors($validator);
		} else {
			$user_id = $request->route('user_id');

			$user = User::find($user_id);
			$username = $user->name;

			if ($assign_permission == TRUE) {

				$permissions = Permission::find($validator->getData(), ['name'])->toArray();
				$permission_assigned = $user->givePermissionTo($permissions);

				if ($permission_assigned) {
					$return['success_permission'] = 'Permission successfully assigned to '.$username;
				} else {
					$return['error_permission'] = 'Something went wrong while assigning permission to '.$username;
				}			
			} 

			if ($assign_role == TRUE) {
 
				$role = Role::find($validator->getData()['role'], ['name'])->toArray(); 


				$role_assigned = $user->syncRoles($role);
				
				// only use when u assign sigle role not from multiple role
				// $role_assigned = $user->assignRole($role);

				if ($role_assigned) {
					$return['success_role'] = 'Role successfully assigned to '.$username;
				} else {
					$return['error_role'] = 'Something went wrong while assigning role to '.$username;
				}
			}

			return redirect()->back()->with($return);
		}
	}

	/*
		Roles - Functioning Parts Create , Update, Delete, Assign to Permission
	*/

	public function roleShow(Request $request) {
		$data['title'] = 'Role | List';
		$data['roles'] = Role::all();

		return view('roles.show',$data);
	} 

	public function roleCreate(Request $request) {

		$data['permissions'] = Permission::all();
		$data['update_id'] = 0;
		$data['form_location'] = '/roles/create';
		$data['title'] = 'Role | Create';
		return view('roles.create',$data);
	} 

	public function roleEdit(Request $request) {

		$update_id = $request->route('role_id');

		$role = Role::find($update_id);


		$data['role'] = $role->toArray();
		$data['role_permissions'] = $role->getAllPermissions()->pluck('id')->toArray();


		$data['permissions'] = Permission::all();
		$data['update_id'] = $update_id;
		$data['form_location'] = '/roles/'. $update_id .'/edit';
		$data['title'] = 'Role | Create';
		return view('roles.create',$data);
	} 

	public function roleDestroy(Request $request) {
		$data['title'] = 'Role | Destroy';
		return view('roles.destroy',$data);
	} 

	public function validateCreateRole(Request $request) {
		$validator = Validator::make($request->all(), 
			['name' => 'required' , 'permission' => 'required'],
			['name.required' => 'Role name is required.' , 'permission.required' => 'Permission is required.']
		);

		if (!$validator->fails()) {
			$data = $validator->getData();

			$role = Role::create(['name' => $data['name']]);
			$permissions = Permission::find($data['permission'], ['name'])->toArray();

			$assign_permission_to_role = $role->syncPermissions($permissions);

			if ($assign_permission_to_role) {
				$return['success'] = 'Role has been created successfully.';
			} else {
				$return['error'] = 'Something went wrong while creating role.';
			}

			return redirect()->back()->with($return);
		} else {
			return redirect()->back()->withErrors($validator)->withInput();
		}
	}
 

	public function roleUpdate(Request $request) {
		$validator = Validator::make($request->all(), 
			['name' => 'required' , 'permission' => 'required'],
			['name.required' => 'Role name is required.' , 'permission.required' => 'Permission is required.']
		);

		if (!$validator->fails()) {

			$data = $validator->getData();
			$role_id = $request->route('role_id');
			$role = Role::find($role_id);

			$role->update(['name' => $data['name']]);

			$permissions = Permission::find($data['permission'], ['name'])->toArray();

			$assign_permission_to_role = $role->syncPermissions($permissions);

			if ($assign_permission_to_role) {
				$return['success'] = 'Role updated successfully.';
			} else {
				$return['error'] = 'Something went wrong while updating role.';
			}

			return redirect()->back()->with($return);
		} else {
			return redirect()->back()->withErrors($validator)->withInput();
		}
	}


	/*
		Permission Create, Read, Update, Delete
	*/

	public function permissionShow(Request $request) {
		$data['title'] = 'Permission | List';
		$data['permissions'] = Permission::all();
		return view('permission.show', $data);
	}

	public function permissionCreate(Request $request) {
		$data['update_id'] = 0;
		$data['form_location'] = '/permissions/create';
		$data['title'] = 'Permission | Create';
		return view('permission.create', $data);
	}

	public function permissionEdit(Request $request) {

		$update_id = $request->route('permission_id');


		$data['update_id'] = $update_id;
		$data['permission'] = Permission::find($update_id)->toArray();
		$data['form_location'] = '/permissions/'.$update_id.'/edit';
		$data['title'] = 'Permission | Edit';
		return view('permission.create', $data);
	}

	public function permissionDestroy(Request $request) {
		$permission_id = $request->route('permission_id');

		$permission_delete = Permission::where('id',$permission_id)->delete();
 		
		if ($permission_delete) {
			return redirect()->back()->with(['success' => 'Permission removed successfully']);
		} else {
			return redirect()->back()->with(['error' => 'Something went wrong']);
		}
 	}

	public function validatePermission(Request $request) {

		$update_id = $request->route('permission_id') ? $request->route('permission_id') : 0;

		$validator = Validator::make($request->all(), 
			['name' => 'required'],
			['name.required' => 'Permission is required.']
		);

		if (!$validator->fails()) {

			if ($update_id > 0) {
				
				$permission = Permission::find($update_id)->update(['name' => $validator->getData()['name']]);

				if ($permission) {
					$return['success'] = 'Permission updated successfully.';
				} else {
					$return['error'] = 'Something went wrong while updating permission.';
				}
			} else {

				$permission = Permission::create(['name' => $validator->getData()['name']]);
				if ($permission) {
					$return['success'] = 'New Permission has been created successfully.';
				} else {
					$return['error'] = 'Something went wrong while creating permission.';
				}
			}

			return redirect()->back()->with($return);
		} else {
			return redirect()->back()->withErrors($validator)->withInput();
		}
	}

}
?>