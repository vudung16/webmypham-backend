<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slide;
use Illuminate\Support\Facades\File;
use App\Http\Requests\SlideRequest;
use Carbon\Carbon;

class SlideController extends Controller
{
    public function getSlide(Request $request) {
        $slide = Slide::where('slide_status', $request->status)->orderBy('slide_id', 'DESC')->paginate(10);
        if ($slide) {
            $slide->getCollection()->transform(function ($value) {

                return $params = [
                    'slide_id' => $value->slide_id,
                    'slide_status' => $value->slide_status,
                    'slide_image' => env('APP_URL') . '/img/slide/' . $value->slide_image,
                    'created_at' => $value->created_at,
                    'updated_at' => $value->updated_at
                ];
            });
        }
        return $this->responseSuccess($slide);
    }
    public function deleteSlide(Request $request) {
        File::delete(public_path().'/img/slide/'.Slide::find($request->id)->slide_image);
        Slide::find($request->id)->delete();
        return $this->responseSuccess();
    }
    public function createSlide(SlideRequest $request) {
        $validated = $request->validated();
        if($request->hasFile('image')){
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            $path = $request->file('image')->move('img/slide/', $fileNameToStore);

            $slide = new Slide;
            $slide->slide_image = $fileNameToStore;
            $slide->slide_status = $request->status === 'true' ? 1 : 0;
            $slide->save();
            $this->responseSuccess();
        }  else {
            $this->responseError('Có lỗi xảy ra');
        }
    }
    public function updateSlide(SlideRequest $request) {
        $validated = $request->validated();
        $slide_id = $request->slide_id;
        $imageOld = Slide::find($slide_id)->slide_image;

        if($request->hasFile('image')){
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            $path = $request->file('image')->move('img/slide/', $fileNameToStore);
            File::delete(public_path().'/img/slide/'.$imageOld);

            Slide::where('slide_id',$slide_id)->update([
                'slide_image'=> $fileNameToStore,
                'slide_status'=>$request->status === 'true' ? 1 : 0 ,
            ]);
            $this->responseSuccess();

        }   
        else {
            Slide::where('slide_id',$slide_id)->update([
                'slide_status'=>$request->status === 'true' ? 1 : 0 ,
            ]);
            $this->responseSuccess();
        }
    }
}
