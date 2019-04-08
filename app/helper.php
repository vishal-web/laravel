<?php
	function checkPermission() {
		
		if (!Auth::check()) {
			header("location:/login");
    		exit();
		}

		if (Session::get('logged_in_user')) {
			$logged_in_user = Session::get('logged_in_user');
			if (!empty($logged_in_user['roles']) && in_array('Admin', $logged_in_user['roles'])) {
				return TRUE;	
			}

			$currentRoute = Request::route()->getName();

			if (!empty($logged_in_user['permissions']) && in_array($currentRoute, $logged_in_user['permissions'])) {
				return TRUE;
			}
		}
		abort(403, 'Unauthriesd Access : You don\'t have permission to access this area.');
	}	
?>