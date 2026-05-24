<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

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
          'is_featured' => 'nullable|boolean',
          'attributes' => 'nullable|array',
          'attributes.*' => 'nullable|string'
    ]);

    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $destinationPath = public_path('images/products');

        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }

        $imageName = uniqid('product_') . '.' . $image->getClientOriginalExtension();
        $image->move($destinationPath, $imageName);
        $validated['image'] = 'images/products/' . $imageName;
    }

      // Save attributes (casts handle JSON conversion)
      $validated['attributes'] = $request->input('attributes', null);

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
       'is_featured' => 'nullable|boolean',
       'attributes' => 'nullable|array',
       'attributes.*' => 'nullable|string'
        ]);
            $validated['is_featured'] = $request->has('is_featured') ? 1 : 0;
      $validated['attributes'] = $request->input('attributes', null);
         if ($request->hasFile('image')) {
             if ($product->image) {
                 $existingImage = public_path($product->image);
                 if (file_exists($existingImage)) {
                     unlink($existingImage);
                 }
             }

             $image = $request->file('image');
             $destinationPath = public_path('images/products');

             if (!file_exists($destinationPath)) {
                 mkdir($destinationPath, 0755, true);
             }

             $imageName = uniqid('product_') . '.' . $image->getClientOriginalExtension();
             $image->move($destinationPath, $imageName);
             $validated['image'] = 'images/products/' . $imageName;
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
       if ($product->image) {
           $existingImage = public_path($product->image);
           if (file_exists($existingImage)) {
               unlink($existingImage);
           }
       }
      $product->delete();

      return redirect()->route('products.index')
                       ->with('success', 'تم حذف المنتج بنجاح');
     }
        public function editData(Product $product)
    {
       return response()->json($product);
    }

    public function publicIndex()
    {
        $products = Product::query()
            ->select(['id', 'name', 'price', 'image', 'description', 'created_at'])
            ->latest()
            ->paginate(12);

        $themePage = 'store';

        return view(theme_view('store'), compact('products', 'themePage'));
    }

    public function publicByCategory(Category $category)
    {
        $products = Product::query()
            ->where('category_id', $category->id)
            ->select(['id', 'name', 'price', 'image', 'description', 'created_at'])
            ->latest()
            ->paginate(12);

        $themePage = 'store';

        return view(theme_view('store'), compact('products', 'category', 'themePage'));
    }

    public function publicShow(Product $product)
    {
        $themePage = 'store';

        return view(theme_view('product'), compact('product', 'themePage'));
    }
}
