<?php

namespace App\Http\Livewire;

use App\Models\Service;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Analyzes extends Component
{
    use WithPagination;

    public $searchTerm;
    public $sort_mode = 'DESC';
    public $sort_state = "latest";

    protected $results;
    private $user;

    public function mount(): void
    {
        $this->user = Auth::user();
        $this->analyzes();
    }

    public function analyzes(): void
    {
        $this->user = Auth::user();
        if($this->sort_mode === 'ASC') {
            $this->results = Service::where('user_id', $this->user->user_id)
//            ->where('kind', 'analysis')
                ->where('status', 'ready')
                ->orderBy('date', 'ASC')
                ->paginate(10)
                ->setPath(route('profile.analyzes'));

            $this->sort_state = "oldest";
        }else{
            $this->results = Service::where('user_id', $this->user->user_id)
//            ->where('kind', 'analysis')
                ->where('status', 'ready')
                ->orderBy('date', 'DESC')
                ->paginate(10)
                ->setPath(route('profile.analyzes'));

            $this->sort_state = "latest";
        }
    }

    public function sortServices($sort_mode): void
    {
        $this->sort_mode = $sort_mode;
        $this->analyzes();
    }

    public function search(): void
    {
        $this->user = Auth::user();
        $this->results = Service::where('title', 'like', "%{$this->searchTerm}%")
            ->where('user_id', $this->user->user_id)
            ->where('status', 'ready')
//            ->where('kind', 'analysis')
            ->paginate(10)
            ->setPath(route('profile.analyzes'));
    }

    public function updated($field): void
    {
        if ($field === 'searchTerm') {
            $this->search();
        }
    }

    public function render()
    {
        return view('livewire.analyzes', ['analyzes' => $this->results]);
    }
}
