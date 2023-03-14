<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SimiliarPercentageCrud extends Component
{
    public $stringOne, $stringTwo, $result;

    protected $rules = [
        'stringOne' => 'required',
        'stringTwo' => 'required',
    ];

    public function resetFields()
    {
        $this->stringOne = '';
        $this->stringTwo = '';
    }

    public function resetResult()
    {
        $this->result = null;
    }

    public function cancel()
    {
        $this->resetFields();
    }

    public function store()
    {
        $this->validate();
        try {
            $this->result = $this->calculate($this->stringOne, $this->stringTwo);
            $this->resetFields();
        } catch (\Exception $ex) {
            $this->alert('error', 'ada kesalahan!.');
        }
    }

    function calculate($input1, $input2)
    {
        $input1 = strtolower($input1);
        $input2 = strtolower($input2);
        $count = 0;
        $characters = str_split($input1);

        foreach ($characters as $char) {
            if (strpos($input2, $char) !== false) {
                $count++;
            }
        }

        $percentage = ($count / strlen($input1)) * 100;
        return $percentage;
    }

    public function render()
    {
        return view('livewire.similiar-percentage-crud');
    }
}
