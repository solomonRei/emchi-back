<?php

namespace App\Http\Livewire;

use App\Models\Notification;
use App\Models\Record;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Http\Request;

class Appointments extends Component
{
    use WithPagination;

    protected $appointments;
    public $appointments_status = true;
    public $sort_mode = 'DESC';
    public $sort_state = "latest";

    public function mount(): void
    {
        if (isset($_GET['mp']) && !empty($_GET['mp'])) {
            $this->displayCanceledAppointments();
        }
        else {
            $this->displayAllAppointments();
        }
    }


    public function displayAllAppointments(): void
    {
        $sort = request()->query('sort', 'latest');

        if (!$this->appointments_status) {
            request()->query->set('sort', $this->sort_mode === 'ASC' ? 'oldest' : 'latest');
            $this->resetPage('mp');
        }


        if ($this->sort_mode === 'ASC' || $sort === 'oldest') {
            $this->appointments = Record::where('user_id', Auth::user()->user_id)
                ->orderBy('date', 'ASC')
                ->paginate(2)
                ->setPath(route('profile.records'));

            $this->sort_state = "oldest";
        }else {
            $this->appointments = Record::where('user_id', Auth::user()->user_id)
                ->orderBy('date', 'DESC')
                ->paginate(2)
                ->setPath(route('profile.records'));
        }

        $this->appointments_status = true;
    }

    public function sortAppointments($sort_mode): void
    {
        $this->sort_mode = $sort_mode;

        if ($this->appointments_status) $this->displayAllAppointments();
        else $this->displayCanceledAppointments();
    }

    public function displayCanceledAppointments(): void
    {

        $sort = request()->query('sort', 'latest');

        if ($this->appointments_status) {
            $this->resetPage();

        }

        if ($this->sort_mode === 'ASC' || $sort === 'oldest') {
            $this->appointments = Record::where('user_id', Auth::user()->user_id)
                ->where('status', 'canceled')
                ->orderBy('date', 'ASC')
                ->paginate(2, ['*'], 'mp')
                ->setPath(route('profile.records'));

            $this->sort_state = "oldest";
        }else {
            $this->appointments = Record::where('user_id', Auth::user()->user_id)
                ->where('status', 'canceled')
                ->orderBy('date', 'DESC')
                ->paginate(2, ['*'], 'mp')
                ->setPath(route('profile.records'));

            $this->sort_state = "latest";
        }

        $this->appointments_status = false;
    }
    public function render()
    {
        $notifications = Notification::whereHas('records', function ($q) {
            $q->whereDate('date', '=', date('Y-m-d'));
        })->get();

        return view('livewire.appointments',  ['appointments' => $this->appointments, 'notifications' => $notifications]);
    }
}
