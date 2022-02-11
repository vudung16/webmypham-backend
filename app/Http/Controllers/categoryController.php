<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Category;
use Illuminate\Support\Facades\DB;
class categoryController extends Controller
{
    public function index(){
        $categorys = DB::table('cosmetics_category')->get();
        return view('admin\category\listcategory', ['categorys' => $categorys]);
    }
    public function addCategory(Request $request){
        $this->validate($request,
            [
                'category_name' => 'required|min:3|max:100',
            ],[
                'category_name.required' => 'Bạn chưa nhập tên',
                'category_name.min' => 'Độ dài tối thiểu là 3 kí tự',
                'category_name.max' => 'Độ dài tối đa là 100 kí tự',
            ]);
        $category = new Category;
        $category->category_name= $request->category_name;
        $category->save();
        return  redirect('admin/category');

    }
    public function deleteCategory($category_id){
        Category::find($category_id)->delete();
    }
    public function detailCategory($category_id){
        return $category = Category::find($category_id);
    }
    public function editCategory(Request $request){
        $this->validate($request,
            [
                'category_name' => 'required|min:3|max:100',
            ],[
                'category_name.required' => 'Bạn chưa nhập tên',
                'category_name.min' => 'Độ dài tối thiểu là 3 kí tự',
                'category_name.max' => 'Độ dài tối đa là 100 kí tự',
            ]);
        $category_id = $request->category_id;
        Category::where('category_id',$category_id)
        ->update([
            'category_name'=> $request->category_name,
        ]);
        return redirect('admin/category');
    }
}
