<?php
namespace App\Http\Controllers;
use Validator;
use Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\{Category,Organisation};
class CategoryController extends Controller
{
    public function index()
    {
        $data = Category::withoutGlobalScopes()->orderBy('id', 'desc')->get();//Category::orderBy('id','desc')->get();
         // Attach organisation count per category
        foreach ($data as $category)
        {
           $category->organisation_count = Organisation::whereJsonContains('category_id', $category->id)->count();
        }
        return view('category.index', compact('data'));
    }
    public function create()
    {
        return view('category.create');
    }
    public function store(Request $request)
    {
        $request->validate([
                'category_name'    =>  'required',
            ]);
            $form_data = array(
                'name'       =>   $request->category_name,
            );
        Category::create($form_data);
        return redirect()->route('categories')->with('success',__('messages.cat_add'));
	}
    public function edit($id)
    {
        $data = Category::findOrFail($id);
        return view('category.edit', compact('data'));
    }
    public function update(Request $request)
    {
            $request->validate([
             'category_name'    =>  'required',
            ]);
           $form_data = array(
                'name'       =>   $request->category_name,
            );
            Category::whereId($request->id)->update($form_data);
            return redirect()->route('categories')->with('success',__('messages.cat_update'));
    }
    public function destroy($id)
    {
        $data = Category::findOrFail($id);
        $data->delete();
         return redirect()->route('categories')->with('success', __('messages.cat_delete'));
    }
}
