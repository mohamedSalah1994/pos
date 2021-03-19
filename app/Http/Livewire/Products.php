<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;

class Products extends Component
{
    public $show_table = true, $updateMode = false, $cat_id;
    public $name,$name_en,$description,$description_en,$category_id,$image,$purchase_price,$sale_price,$stock;

    // protected $rules = [
    //     'name' => 'required|unique',
    //     'name_en' => 'required|unique',
    // ];

    public function render()
    {

        return view('livewire.products', [

            'categories' => Category::all(),
            'products' => Product::all(),
        ]);
    }

    public function showformadd()
    {

        $this->show_table = false;

    }

    public function submitForm()
    {
        $this->validate([
            'name' => 'required|unique:categories,name->ar,' . $this->id,
            'name_en' => 'required|unique:categories,name->en,' . $this->id,

        ]);
        try {

            $categories = new Category();

            $categories->name = ['en' => $this->name_en, 'ar' => $this->name];

            $categories->save();

            session()->flash('message', __('site.added_successfully'));

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

        $category = Category::where('id', $id)->first();
        $this->cat_id = $id;
        $this->name = $category->getTranslation('name', 'ar');
        $this->name_en = $category->getTranslation('name', 'en');

    }

    public function submitForm_edit()
    {
        $this->validate();

        if ($this->cat_id) {
            $category = Category::find($this->cat_id);
            $category->update([
                $category->name = ['ar' => $this->name, 'en' => $this->name_en],
            ]);

        }
        session()->flash('message', __('site.updated_successfully'));

        $this->show_table = true;
    }

    public function delete($id)
    {
        Category::findOrFail($id)->delete();

        session()->flash('message_delete', __('site.deleted_successfully'));

    }

    public function clearForm()
    {
        $this->name = '';
        $this->name_en = '';

    }
}
