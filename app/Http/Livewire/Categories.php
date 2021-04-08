<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;

class Categories extends Component
{
    public $show_table = true, $name, $name_en, $updateMode = false, $cat_id , $category_id;
    public $sorted_table = true;


    protected $rules = [
        'name' => 'required|unique',
        'name_en' => 'required|unique',
    ];

    public function sortByCategory($id){

         $this->cat_id = $id;
        $this->show_table = false;

    }

    public function render()
    {

        return view('livewire.categories', [

            'categories' => Category::all(),

            'products' => Product::where('category_id' , $this->cat_id)->get(),

        ]);
    }






    public function showformadd()
    {

         $this->show_table = false;
        $this->sorted_table = false;

    }

    public function submitForm()
    {
        $this->validate([
            'name' => 'required|unique:categories,name->ar,'.$this->id,
            'name_en' => 'required|unique:categories,name->en,'.$this->id,

        ]);
        try {
            $categories = new Category();

            $categories->name = ['en' => $this->name_en, 'ar' => $this->name];

            $categories->save();

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
        $this->sorted_table = false;
        $this->updateMode = true;

        $category = Category::where('id', $id)->first();
         $this->cat_id = $id;
        $this->name = $category->getTranslation('name', 'ar');
        $this->name_en = $category->getTranslation('name', 'en');

    }

    public function submitForm_edit()
    {
        $this->validate([
            'name' => 'required|unique:categories,name->ar,'.$this->id,
            'name_en' => 'required|unique:categories,name->en,'.$this->id,

        ]);

        if ($this->cat_id) {
            $category = Category::find($this->cat_id);
            $category->update([
                
                'name' => ['en' => $this->name_en, 'ar' => $this->name],
            ]);

        }
        session()->flash('success', __('site.updated_successfully'));

        $this->show_table = true;
    }

    public function delete($id)
    {
        Category::findOrFail($id)->delete();


        // session()->flash('message_delete', __('site.deleted_successfully'));

         session()->flash('success', __('site.deleted_successfully'));
    }

    public function clearForm()
    {
        $this->name = '';
        $this->name_en = '';

    }
}
