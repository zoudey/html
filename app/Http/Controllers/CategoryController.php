<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function category()
    {
        // dd($room, $roomChildren, $roomoneParent);
        // // dd($users, $room);
        // $users = User::all();
        // dd($users);
        // $users = User::paginate(5); // phân quyền hiển thị mỗi trang chỉ 5 sản phẩm
        $category = Category::select('*')
            ->orderBy('name','ASC')
            // ->with('room') //truy vấn thêm quan hệ trước khi trả về kết quả ra view
            // ->where('id', '<=',7)
            ->paginate(10);
        // dd($users);
        return view('admin.category.list', ['cate_list' => $category]);
    }
    public function delete_cate(Category $id)
    {
        $id->delete();
        return  back();
    }

    public function create_cate()
    {
        $cate = Category::orderby('name','ASC')->get();
        return view('admin.category.create', compact('cate'));
    }
    public function store_cate(Request $request)
    {
        // $request->validate([
        //     'name' => 'required|min:6|max:32',
        // ]);
        $cate = new Category();
        $cate->fill($request->all());
        $cate->save();
        return redirect()->route('users.list');
    }
    public function edit_cate(Category $id)
    {
        // $id->birthday = date('Y-m-d', strtotime($id->birthday)); // chuyển sang dạng y-m-d
        return view('admin.category.edit', [
            // 'rooms'=> $room
            'cate' => $id

        ]);
    }
    public function update_cate(Request $request)
    {
        $users = Category::find($request->id);
        $users->update([
            'name' => $request->name,
        ]);
        return redirect()->route('users.list');
    }
    public function search_cate(Request $request)
    {
        $category = Category::all();
        $product = Product::where('cate_id', $request->id)->with('category')->paginate(10);
            return view('user.product.shop', [
                'category' => $category,
                'product' => $product,
            ]);
        }
    }
