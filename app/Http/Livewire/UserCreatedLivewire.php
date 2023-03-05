<?php

namespace App\Http\Livewire;

use Livewire\Component;

class UserCreatedLivewire extends Component
{
    public $showNewOrderNotification = false;

    // Special Syntax: ['echo:{channel},{event}' => '{method}']
    protected $listeners = ['echo:usercreated,UserCreatedEvent' => 'notifyNewOrder'];



    public function notifyNewOrder()
    {
        $this->showNewOrderNotification = true;
    }
    public function render()
    {
        return view('livewire.user-created-livewire');
    }
}
