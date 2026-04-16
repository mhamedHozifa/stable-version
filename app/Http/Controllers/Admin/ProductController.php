<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $products = Product::paginate(10); // جلب المنتجات
       $categories = Category::all(); // جلب كل التصنيفات للمودال    
        return view('admin.products.index', compact('products','categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //؟
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      $validated = $request->validate([
          'name' => 'required|string|max:255',
          'description' => 'nullable|string',
          'price' => 'required|numeric|min:0',
          'stock' => 'required|integer|min:0',   // <-- أضف هذا السطر

         'category_id' => 'nullable|exists:categories,id',
          'image' => 'nullable|image|max:2048',
          'is_featured' => 'nullable|boolean'
    ]);

    if ($request->hasFile('image'))
      {
        $validated['image'] = $request->file('image')->store('products', 'public');
      }

       Product::create($validated);

       return redirect()->route('products.index')->with('success', 'Product added successfully!');
  }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
public function update(Request $request, Product $product)
    {
       $validated = $request->validate([
           'name' => 'required|string|max:255',
           'description' => 'nullable|string',
           'price' => 'required|numeric|min:0',
          'stock' => 'required|integer|min:0',
           'category_id' => 'nullable|exists:categories,id',
           'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
           'is_featured' => 'nullable|boolean'
        ]);
            $validated['is_featured'] = $request->has('is_featured') ? 1 : 0;
         if ($request->hasFile('image')) {
           if ($product->image)
              {
                Storage::disk('public')->delete($product->image);
              }
             $validated['image'] = $request->file('image')->store('products', 'public');
    }

        $product->update($validated);

        return redirect()->route('products.index')
                     ->with('success', 'تم تحديث المنتج بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
     public function destroy(Product $product)
     {
       if ($product->image) 
        {
          Storage::disk('public')->delete($product->image);
        }
      $product->delete();

      return redirect()->route('products.index')
                       ->with('success', 'تم حذف المنتج بنجاح');
     }
        public function editData(Product $product)
    {
       return response()->json($product);
    }
}
