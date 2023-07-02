<?php 
namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Input;
use Validator;
use Redirect;
use View;
use Image;

class UploadController extends Controller {

	public function view() {
		return view('imageUpload');
	}

	public function upload(Request $request) {


        // this is normal upload
		// $this->validate($request, [
	    // 	'image' => 'mimes:jpeg,bmp,png,heic', //only allow this type extension file.
		// ]);
		
		// 
		// $file = $request->file('image');
		// $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

		// $file->move('uploads', $file->getClientOriginalName()); 
        
        // end normal upload

        
        // this is gd upload and resize
        $file = $request->file('image');
		$fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move('uploads/original/', $fileName); 

        $originalImagePath = public_path('uploads/original/' . $fileName);
        $resizedImage = Image::make($originalImagePath)->resize(800, 600);

        // Resize the image
        $resizedImagePath = public_path('uploads/resized/' . $fileName);
        // Save the resized image
        $resizedImage->save($resizedImagePath);
        // end gd upload and resize


		echo 'Image Uploaded Successfully';
	}
}