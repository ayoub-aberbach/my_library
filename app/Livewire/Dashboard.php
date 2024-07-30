<?php

namespace App\Livewire;

use App\Models\issueBook;

use Livewire\Component;
use Livewire\Attributes\Layout;

class Dashboard extends Component
{
    #[Layout("components.layouts.app")]
    public function render()
    {
        $latest_issued = issueBook::where("return_date", "")->orWhere("return_date", null)->orderBy("created_at", "DESC")->get();
        return view('livewire.dashboard', [
            'latests' => $latest_issued
        ]);
    }
}
