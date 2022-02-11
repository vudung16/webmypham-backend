<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slide;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\addslide;
class slideController extends Controller
{
    public function index()
    {
        $slides = DB::table('cosmetics_slide')->get();
        return view('admin\Slide\listslide', ['slides' => $slides]);
    }
    public function store(Request $request)
    {
        $this->validate($request,
            [
                'slide_image' => 'required',
            ],[ 
                'slide_image.required' => 'Bạn chưa tải ảnh lên',
            ]);

        if($request->hasFile('slide_image')){
            $filenameWithExt = $request->file('slide_image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('slide_image')->getClientOriginalExtension();
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            $path = $request->file('slide_image')->move('img/slide/', $fileNameToStore);
        }   
        else {
            $fileNameToStore = 'no-image.png';
        }
        $slide = new Slide;
        $slide->slide_image = $fileNameToStore;
        $slide->slide_status = 1;
        $slide->save();
        return redirect('admin/slide');
    }
    public function deleteslide($slide_id){
        File::delete(public_path().'img/slide/'.Slide::find($slide_id)->slide_image);
        Slide::find($slide_id)->delete();
    }
    public function detailslide($slide_id){
		return $slide = Slide::find($slide_id);
	}
    public function editslide(Request $request)
    {
        $this->validate($request,
            [
                'slide_image' => 'required',
            ],[
                'slide_image.required' => 'Bạn chưa tải ảnh lên',
            ]);
        $slide_id = $request->slide_id;
        $imageOld = Slide::find($slide_id)->slide_image;
        
        $slide = new Slide;

        if($request->hasFile('imgslide')){
            $filenameWithExt = $request->file('imgslide')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('imgslide')->getClientOriginalExtension();
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            $path = $request->file('imgslide')->move('img/slide/', $fileNameToStore);
            File::delete(public_path().'/img/slide/'.$imageOld);
        }   
        else {
            $fileNameToStore = $imageOld;
        }
        Slide::where('slide_id',$slide_id)->update([
            'slide_image'=> $fileNameToStore,
            'slide_status'=>$request->slide_status,
        ]);
        return redirect('admin/ slide');
    }
}