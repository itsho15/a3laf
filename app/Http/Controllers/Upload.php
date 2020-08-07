<?php
namespace App\Http\Controllers;

use App\Models\File;
use Image;
use Storage;

class Upload extends Controller {

	public static function upload($data = []) {

		if (in_array('new_name', $data)) {
			$new_name = $data['new_name'] === null ? time() : $data['new_name'];
		}

		if (request()->hasFile($data['file']) && $data['upload_type'] == 'single') {
			Storage::has($data['delete_file']) ? Storage::delete($data['delete_file']) : '';
			return request()->file($data['file'])->store($data['path']);

		} elseif (request()->hasFile($data['file']) && $data['upload_type'] == 'multi') {

			$file = request()->file($data['file']);
			if (is_array($file)) {
				/*
						delete old files
				*/

				if ($data['delete_file']) {
					foreach ($data['delete_file'] as $imagedelete) {
						//self::delete($imagedelete['id']);
						Storage::has($imagedelete['full_file']) ? Storage::delete($imagedelete['full_file']) : '';
					}
				}

				foreach ($file as $key => $singleimage) {

					$watermark = Image::make('dist/img/Logo.png')
						->resize(100, 100);
					$photo = Image::make($singleimage)
						->resize(500, 350)->insert($watermark, 'bottom-right', 10, 10)->encode('jpg');

					$size = $singleimage->getSize();
					$mime_type = $singleimage->getMimeType();
					$name = $singleimage->getClientOriginalName();
					$hashname = $singleimage->hashName();

					Storage::put($data['path'] . '/' . $hashname, $photo);

					$add = File::create([
						'name' => $name,
						'size' => $size,
						'file' => $hashname,
						'path' => $data['path'],
						'full_file' => $data['path'] . '/' . $hashname,
						'mime_type' => $mime_type,
						'file_type' => $data['file_type'],
						'relation_id' => $data['relation_id'],
					]);
				}
			} else {
				$size = $file->getSize();
				$mime_type = $file->getMimeType();
				$name = $file->getClientOriginalName();
				$hashname = $file->hashName();

				$file->store($data['path']);

				$add = File::create([
					'name' => $name,
					'size' => $size,
					'file' => $hashname,
					'path' => $data['path'],
					'full_file' => $data['path'] . '/' . $hashname,
					'mime_type' => $mime_type,
					'file_type' => $data['file_type'],
					'relation_id' => $data['relation_id'],
				]);
				return $add->id;
			}

		}
	}

	public static function delete($id) {
		$file = File::find($id);
		if (!empty($file)) {
			Storage::delete($file->full_file);
			$file->delete();
		}
	}

}