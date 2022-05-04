<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slide;
use Illuminate\Support\Facades\File;

class SlideController extends Controller
{
    public function getSlide(Request $request) {
        $slide = Slide::where('slide_status', $request->status)->orderBy('slide_id', 'DESC')->paginate(10);
        if ($slide) {
            $slide->getCollection()->transform(function ($value) {

                return $params = [
                    'slide_id' => $value->slide_id,
                    'slide_image' => env('APP_URL') . '/img/slide/' . $value->slide_image,
                    'created_at' => $value->created_at,
                    'update_at' => $value->updated_at
                ];
            });
        }
        return $this->responseSuccess($slide);
    }
    public function deleteSlide(Request $request) {
        File::delete(public_path().'img/slide/'.Slide::find($request->id)->slide_image);
        Slide::find($request->id)->delete();
        return $this->responseSuccess();
    }
}
