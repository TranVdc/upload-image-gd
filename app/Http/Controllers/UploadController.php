<?php 
namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Input;
use Validator;
use Redirect;
use View;
use Image;
use Imagick;

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
        // $file = $request->file('image');
		// $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        // $file->move('uploads/original/', $fileName); 

        // $originalImagePath = public_path('uploads/original/' . $fileName);
        // $resizedImage = Image::make($originalImagePath)->resize(800, 600);

        // // Resize the image
        // $resizedImagePath = public_path('uploads/resized/' . $fileName);
        // // Save the resized image
        // $resizedImage->save($resizedImagePath);
        // end gd upload and resize



        // this is purely imagick upload
        $file = $request->file('image');
		$fileName = time() . '_' . uniqid();
        $file->move('uploads/original/', $fileName.'.'.$file->getClientOriginalExtension()); 
        $originalImagePath = public_path('uploads/original/' . $fileName.'.'.$file->getClientOriginalExtension());

        $imagick = new Imagick($originalImagePath);
        $imagick->resizeImage(800, 600, Imagick::FILTER_LANCZOS, 1);

        // Save the resized image
        $resizedImagePath =  public_path('uploads/resized/' . $fileName.'.jpg');
        $imagick->setImageFormat('jpg');
        $imagick->writeImage($resizedImagePath);

        // Clean up resources
        $imagick->clear();
        $imagick->destroy();

        // end is purely imagick upload



		echo 'Image Uploaded Successfully';
	}
}