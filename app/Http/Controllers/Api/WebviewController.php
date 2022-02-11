<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slide;

class WebviewController extends Controller
{
    public function homeSlide() {
        $slide = Slide::where(['slide_status'=> 1])->orderBy('slide_id', 'DESC')->limit(3)->get();
        $banner = Slide::where(['slide_status'=> 0])->orderBy('slide_id', 'DESC')->limit(4)->get();
        
        $array = [];
        $img = '';
        foreach($slide as $sl) {
            $img = env('APP_URL'). '/img/slide/' . $sl->slide_image;
            array_push($array, $img);
        }
        return $this->responseSuccess(['slide' => $array, 'bannner' => $banner]);
    }
}
