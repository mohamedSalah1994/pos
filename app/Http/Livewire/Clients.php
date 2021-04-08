<?php

namespace App\Http\Livewire;

use App\Models\Order;
use App\Models\Client;
use App\Models\Product;
use Livewire\Component;
use App\Models\Category;

class Clients extends Component
{
    public $show_table = true , $updateMode = false , $showOrdresForm = true;
    public $name , $name_en , $address , $address_en , $phone , $client_id  , $quantity = [] , $ccc;

    protected $rules = [
        'name' => 'required',
        'name_en' => 'required',
        'phone' => 'required|min:1',
        'address' => 'required',
        'address_en' => 'required',
    ];

    public function render()
    {
        $clients = Client::all();
        $categories = Category::with('products')->get();
        // $products = Product::all();
        $orders = Order::all();
        return view('livewire.clients' , compact('clients' , 'categories' , 'orders'));
    }

    public function showformadd()
    {
         $this->show_table = false;
         $this->showOrdresForm = false;
    }

    public function submitForm()
    {
        $this->validate();
        try {

            $clients = new Client();

            $clients->name = ['en' => $this->name_en, 'ar' => $this->name];
            $clients->address = ['en' => $this->address_en, 'ar' => $this->address];
            $clients->phone = $this->phone;

            $clients->save();

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

        $client = Client::where('id', $id)->first();
        $this->client_id = $id;
        $this->name = $client->getTranslation('name', 'ar');
        $this->name_en = $client->getTranslation('name', 'en');
        $this->address = $client->getTranslation('address', 'ar');
        $this->name_en = $client->getTranslation('address', 'en');
        $this->phone = $client->phone;

    }

    public function submitForm_edit()
    {
        $this->validate();

        if ($this->client_id) {
            $client = Client::find($this->client_id);
            $client->update([
                'name' => ['en' => $this->name_en, 'ar' => $this->name],

                'address' => ['ar' => $this->address, 'en' => $this->address_en],
                'phone' => $this->phone,
            ]);

        }
        session()->flash('success', __('site.updated_successfully'));

        $this->show_table = true;
    }

    public function delete($id)
    {
        Client::findOrFail($id)->delete();


        // session()->flash('message_delete', __('site.deleted_successfully'));

         session()->flash('success', __('site.deleted_successfully'));
    }

    public function clearForm()
    {
        $this->name = '';
        $this->name_en = '';
        $this->address = '';
        $this->address_en = '';
        $this->phone = '';


    }
    // --------------------Orders---------------------------
    public function showOrdersForm($id){
        $this->client_id = $id;
        $this->show_table = false;

    }

    public function OrderAdd(){

        dd($this->client_id , $this->quantity );
    }
}
