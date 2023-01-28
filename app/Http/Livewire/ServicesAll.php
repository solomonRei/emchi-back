<?php

namespace App\Http\Livewire;

use App\Models\Service;
use App\Models\ServiceAll;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
use Livewire\Component;

class ServicesAll extends Component
{
    use WithPagination;

    protected $services_obj;
    public $services_status = true;
    public $sort_mode = 'DESC';
    public $sort_state = "latest";

    public function mount(): void
    {
        $this->services_obj = ServiceAll::paginate(10)->setPath(route('profile.services'));

        if (isset($_GET['mp']) && !empty($_GET['mp'])) $this->displayUserServices();
        else $this->displayAllServices();
    }
    public function displayAllServices(): void
    {
        if (!$this->services_status)
            $this->resetPage('mp');

        $this->services_obj = ServiceAll::paginate(10)->setPath(route('profile.services'));
        $this->services_status = true;
    }

    public function sortUserServices($sort_mode): void
    {
        $this->sort_mode = $sort_mode;
        $this->displayUserServices();
    }

    public function displayUserServices(): void
    {
        $user = Auth::user();
        $sort = request()->query('sort', 'latest');

        if ($this->services_status) {
            $this->resetPage();
        }

        if($this->sort_mode === 'ASC' || $sort === 'oldest') {
            $this->services_obj = Service::where('user_id', $user->user_id)
                ->whereNot('kind', 'analysis')
                ->orderBy('date', 'ASC')
                ->paginate(10, ['*'], 'mp')
                ->setPath(route('profile.services'));
            $this->sort_state = "oldest";
        }else {
            $this->services_obj = Service::where('user_id', $user->user_id)
                ->whereNot('kind', 'analysis')
                ->orderBy('date', 'DESC')
                ->paginate(10, ['*'], 'mp')
                ->setPath(route('profile.services'));

            $this->sort_state = "latest";
        }

        $this->services_status = false;
    }
    public function render()
    {
        return view('livewire.services-all',  ['services' => $this->services_obj]);
    }
}
