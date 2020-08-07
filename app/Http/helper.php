<?php

if (!function_exists('activeGuard')) {
	function activeGuard() {
		foreach (array_keys(config('auth.guards')) as $guard) {
			if (auth()->guard($guard)->check()) {
				return $guard;
			}
		}
		return null;
	}
}
if (!function_exists('up')) {
	function up() {
		return new \App\Http\Controllers\Upload;
	}
}
if (!function_exists('GetCountByModelName')) {
	function GetCountByModelName($Model) {
		return $Model::count();

	}
}

if (!function_exists('setting')) {

	function setting($key, $default = null) {
		if (is_null($key)) {
			return \App\Models\Setting::pluck('val', 'name');
		}

		if (is_array($key)) {
			return \App\Models\Setting::set($key[0], $key[1]);
		}

		$value = \App\Models\Setting::get($key);

		return is_null($value) ? value($default) : $value;
	}
}

if (!function_exists('AuthCan')) {
	function AuthCan($permssion) {
		$authPermssions = auth(activeGuard())->check() ? auth(activeGuard())->user()->getAllPermissions()->pluck('name')->toArray() : [];
		/*
			Check If Permssions Allowed To Current User
		*/
		if (is_array($permssion)) {
			return count(array_diff($permssion, $authPermssions)) ? false : true;
		} else {
			return array_search($permssion, $authPermssions) ? true : false;
		}
	}
}

if (!function_exists('load_dep')) {
	function load_dep($select = null, $dep_hide = null) {

		$departments = \App\Models\Category::selectRaw('name as name')
			->selectRaw('id as id')
			->selectRaw('parent_id as parent')
			->get(['text', 'parent', 'id']);
		$dep_arr = [];
		foreach ($departments as $department) {
			$list_arr = [];
			$list_arr['icon'] = '';
			$list_arr['li_attr'] = '';
			$list_arr['a_attr'] = '';
			$list_arr['children'] = [];

			if ($select !== null and $select == $department->id) {

				$list_arr['state'] = [
					'opened' => true,
					'selected' => true,
					'disabled' => false,
				];
			}

			if ($dep_hide !== null and $dep_hide == $department->id) {

				$list_arr['state'] = [
					'opened' => false,
					'selected' => false,
					'disabled' => true,
					'hidden' => true,
				];
			}

			$list_arr['id'] = $department->id;
			$list_arr['parent'] = $department->parent > 0 ? $department->parent : '#';
			$list_arr['text'] = $department->getTranslation('name', Config::get('app.locale'));
			array_push($dep_arr, $list_arr);
		}

		return json_encode($dep_arr, JSON_UNESCAPED_UNICODE);
	}
}

if (!function_exists('aurl')) {
	function aurl($url = null) {
		return url('admin/' . $url);
	}
}

if (!function_exists('admin')) {
	function admin() {
		return auth()->guard('admin');
	}
}

if (!function_exists('active_menu')) {
	function active_menu($link) {

		if (preg_match('/' . $link . '/i', Request::segment(2))) {
			return ['menu-open', 'display:block'];
		} else {
			return ['', ''];
		}
	}
}

if (!function_exists('lang')) {
	function lang() {
		if (session()->has('lang')) {
			return session('lang');
		} else {
			session()->put('lang', 'ar');
			return 'ar';
		}
	}
}

if (!function_exists('direction')) {
	function direction() {
		if (session()->has('lang')) {
			if (session('lang') == 'ar') {
				return 'rtl';
			} else {
				return 'ltr';
			}
		} else {
			return 'ltr';
		}
	}
}

if (!function_exists('datatable_lang')) {
	function datatable_lang() {
		return ['sProcessing' => trans('admin.sProcessing'),
			'sLengthMenu' => trans('admin.sLengthMenu'),
			'sZeroRecords' => trans('admin.sZeroRecords'),
			'sEmptyTable' => trans('admin.sEmptyTable'),
			'sInfo' => trans('admin.sInfo'),
			'sInfoEmpty' => trans('admin.sInfoEmpty'),
			'sInfoFiltered' => trans('admin.sInfoFiltered'),
			'sInfoPostFix' => trans('admin.sInfoPostFix'),
			'sSearch' => trans('admin.sSearch'),
			'sUrl' => trans('admin.sUrl'),
			'sInfoThousands' => trans('admin.sInfoThousands'),
			'sLoadingRecords' => trans('admin.sLoadingRecords'),
			'oPaginate' => [
				'sFirst' => trans('admin.sFirst'),
				'sLast' => trans('admin.sLast'),
				'sNext' => trans('admin.sNext'),
				'sPrevious' => trans('admin.sPrevious'),
			],
			'oAria' => [
				'sSortAscending' => trans('admin.sSortAscending'),
				'sSortDescending' => trans('admin.sSortDescending'),
			],
		];
	}
}

/////// Validate Helper Functions ///////
if (!function_exists('v_image')) {
	function v_image($ext = null) {
		if ($ext === null) {
			return 'image|mimes:jpg,jpeg,png,gif,bmp';
		} else {
			return 'image|mimes:' . $ext;
		}

	}
}

if (!function_exists('pushNotifications')) {
	function pushNotifications($devices_id, $title, $text, $click_action, $model, $type = 'mobile', $image = '') {
		/*api_key available in:
		Firebase Console -> Project Settings -> CLOUD MESSAGING -> Server key*/
		$data = [
			'registration_ids' => $devices_id,
			"notification" => [
				"title" => $title,
				"text" => $text,
				"sound" => "default",
				"badge" => 0,
				"click_action" => $click_action,
				"image" => $image,
			],
			"priority" => "high",
			'data' => [
				'model' => $model,
			],
		];
		$data_string = json_encode($data);

		$headers = array('Authorization:key=AAAAuEUD9G4:APA91bGXWAdL6clloiiyOelXd37SShEQON3-GVcNO9nOrJi0TM59PfmkuNwG9vmGy-H9dRVc3lygbXt_YNA0t3v5iYC-Bj9uwR4nKR6CFWRWD53qBKVmYiK6T846el1M-fyj68M8cDdk', 'Content-Type:application/json');
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
		$result = curl_exec($ch);
		curl_close($ch);

		return $result;

	}
}

if (!function_exists('contains')) {
	function contains($str, array $arr) {
		foreach ($arr as $a) {
			if (stripos($str, $a) !== false) {
				return true;
			}
		}
		return false;
	}
}
