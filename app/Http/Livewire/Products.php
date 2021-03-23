<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithFileUploads;
use App\DataTables\ProductDataTable;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class Products extends Component
{
    use WithFileUploads;
    public $show_table = true, $updateMode = false;
    public $name, $name_en, $description, $description_en, $category_id, $cat_id,$selectedCategory,$selected,$all_products,
    $image, $purchase_price, $sale_price, $stock, $image_path, $pro_id;
    public $sorted_table = false ;

    protected $rules = [
        'name' => 'required',
        'name_en' => 'required',
        'description' => 'required',
        'description_en' => 'required',
        'category_id' => 'required',
        'purchase_price' => 'required',
        'sale_price' => 'required',

    ];

    public function sortByCategory()
    {
//  $this->cat_id = Category::where('category_id' , $this->cat_id)->get();
         $this->cat_id = $this->selected;
         $this->show_table = false;
         $this->sorted_table = true;


    }



    public function render()
    {


        if ( $this->sorted_table != false && $this->cat_id != null) {
            $categories = Category::all();

             $products = Product::where('category_id' , $this->cat_id)->get();
            return view('livewire.products', compact('categories', 'products'));
        } else {
            $categories = Category::all();
            $products = Product::all();

            return view('livewire.products', compact('categories', 'products'));
        }

    }




    public function showformadd()
    {

        $this->show_table = false;
        $this->sorted_table = false;

    }

    public function submitForm()
    {
        $this->validate();
        try {

            $products = new Product();

            $products->name = ['en' => $this->name_en, 'ar' => $this->name];
            $products->description = ['en' => $this->description_en, 'ar' => $this->description];
            $products->category_id = $this->category_id;
            $products->purchase_price = $this->purchase_price;
            $products->sale_price = $this->sale_price;
            $products->stock = $this->stock;
            if ($this->image) {

                Image::make($this->image)
                    ->resize(300, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })
                    ->save(public_path('uploads/product_images/' . $this->image->hashName()));

                $products->image = $this->image->hashName();

            } //end of if

            $products->save();

            session()->flash('success', __('site.added_successfully'));

            $this->clearForm();
            $this->show_table = true;

        } catch (\Exception $e) {
            $this->catchError = $e->getMessage();
        };
    }

    public function edit($id)
    {
        $this->show_table = false;
        $this->updateMode = true;
        $this->sorted_table=false;


        $product = Product::where('id', $id)->first();
        $this->pro_id = $id;
        $this->name = $product->getTranslation('name', 'ar');
        $this->name_en = $product->getTranslation('name', 'en');
        $this->description = $product->getTranslation('description', 'ar');
        $this->description_en = $product->getTranslation('description', 'en');
        $this->category_id = $product->category_id;
        $this->purchase_price = $product->purchase_price;
        $this->sale_price = $product->sale_price;
        $this->stock = $product->stock;

        if ($this->image) {
            Image::make($this->image)
                ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path('uploads/product_images/' . $this->image->hashName()));

            $product->image = $this->image->hashName();
        }
    }

    public function submitForm_edit()
    {
         $this->validate();

        if ($this->pro_id) {
            $products = Product::find($this->pro_id);
            if ($this->image) {
                Image::make($this->image)
                    ->resize(300, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })
                    ->save(public_path('uploads/product_images/' . $this->image->hashName()));

                $products->image = $this->image->hashName();
            }
            $products->update([
                'name' => ['en' => $this->name_en, 'ar' => $this->name],
                'description' => ['en' => $this->description_en, 'ar' => $this->description],
                'category_id' => $this->category_id,
                'purchase_price' => $this->purchase_price,
                'sale_price' => $this->sale_price,
                'stock' => $this->stock,

            ]);

        }
        // session()->flash('message', __('site.updated_successfully'));
        session()->flash('success', __('site.updated_successfully'));
        $this->show_table = true;
    }

    public function delete(Product $product)
    {
        if ($product->image != 'default.jpg') {

            Storage::disk('public_uploads')->delete('/product_images/' . $product->image);

        }//end of if
        $product->delete();

        session()->flash('message_delete', __('site.deleted_successfully'));

    }

    public function clearForm()
    {
        $this->name = '';
        $this->name_en = '';
        $this->description = '';
        $this->description_en = '';
        $this->category_id = '';
        $this->purchase_price = '';
        $this->sale_price = '';
        $this->stock = '';
        $this->image = '';

    }
}
