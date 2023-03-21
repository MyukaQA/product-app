<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class ProductCrud extends Component
{
    use LivewireAlert;

    public $data;

    public $category;

    public $category_id;

    public $name;

    public $stock;

    public $price;

    public $productId;

    protected $rules = [
        'name' => 'required',
        'category_id' => 'required',
        'stock' => 'required',
        'price' => 'required',
    ];

    public function resetFields()
    {
        $this->name = '';
        $this->category_id = null;
        $this->stock = '';
        $this->price = '';
    }

    public function render()
    {
        $this->category = Category::all();
        $this->data = Product::all();

        return view('livewire.product-crud');
    }

    public function storeProduct()
    {
        $this->validate();
        try {
            Product::create([
                'name' => $this->name,
                'category_id' => $this->category_id,
                'stock' => $this->stock,
                'price' => $this->price,
            ]);
            $this->alert('success', 'Barang berhasil dibuat');
            $this->resetFields();
        } catch (\Exception $ex) {
            $this->alert('error', 'ada kesalahan!.');
        }
    }

    public function editProduct($id)
    {
        try {
            $data = Product::findOrFail($id);
            if (! $data) {
                $this->alert('error', 'Data tidak ditemukan!.');
            } else {
                $this->productId = $data->id;
                $this->name = $data->name;
                $this->category_id = $data->category_id;
                $this->stock = $data->stock;
                $this->price = $data->price;
            }
        } catch (\Exception $ex) {
            $this->alert('error', 'ada kesalahan!.');
        }
    }

    public function updateProduct()
    {
        $this->validate();
        try {
            Product::whereId($this->productId)->update([
                'name' => $this->name,
                'category_id' => $this->category_id,
                'stock' => $this->stock,
                'price' => $this->price,
            ]);
            $this->alert('success', 'Barang berhasil diupdate');
            $this->resetFields();
        } catch (\Exception $ex) {
            $this->alert('error', 'ada kesalahan!.');
        }
    }

    public function cancelProduct()
    {
        $this->resetFields();
    }

    public function deleteProduct($id)
    {
        try {
            Product::find($id)->delete();
            $this->alert('success', 'Barang berhasil dihapus');
        } catch(\Exception $e) {
            $this->alert('error', 'ada kesalahan!.');
        }
    }
}
