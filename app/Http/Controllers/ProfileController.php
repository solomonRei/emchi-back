<?php

namespace App\Http\Controllers;

use App\Http\Traits\MetaTags;
use App\Models\Payments;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\API\UserController;

class ProfileController extends Controller
{
    use MetaTags;

    public function profile()
    {
        $user = Auth::user();

        $this->setMeta('Профиль', 'Описание');

        return view('frontend.profile', compact('user'));
    }

    public function services(Request $request)
    {
        $user = Auth::user();

        $this->setMeta('Услуги', 'Описание');

//        $userController = new UserController();
//        $userController->getServices();
        if ($request->date === NULL || $request->date === 'latest') {
            $order = 'DESC';
        }
        else {
            $order = 'ASC';
        }

        $my_services = Service::where('user_id', $user->user_id)
            ->whereNot('kind', 'analysis')
            ->orderBy('date', $order)
            ->paginate(10);

        return view('frontend.services', compact('user', 'my_services'));

    }

    public function payments(Request $request)
    {
        $user = Auth::user();

        $this->setMeta('Платежи', 'Описание');

        if ($request->date === NULL || $request->date === 'latest') {
            $order = 'DESC';
        }
        else {
            $order = 'ASC';
        }

        if ($request->type === 'waiting' && $request->type !== NULL) {
            $payments = Payments::with(['service' => function($q) use($user) {
                $q->where('user_id', $user->user_id);
            }])
                ->where('user_id', $user->user_id)
                ->whereNot('orderPaidStatus', 'fully_paid')
                ->whereNot('orderPaidStatus', 'paid_by_credit')
                ->orderBy('date', $order)
                ->paginate(10);
        }else {
            $payments = Payments::with(['service' => function($q) use($user) {
                $q->where('user_id', $user->user_id);
            }])
                ->where('user_id', $user->user_id)
                ->where('orderPaidStatus', 'fully_paid')
                ->orWhere('orderPaidStatus', 'paid_by_credit')
                ->orderBy('date', $order)
                ->paginate(10);

        }

//        dd($payments);

//        $userController = new UserController();
//        $userController->getPayments();

        return view('frontend.payment', compact('user', 'payments'));

    }

    public function analyzes(Request $request)
    {
        $user = Auth::user();

        $this->setMeta('Анализы', 'Описание');

//        $userController = new UserController();
//        $userController->getServices();
        if ($request->date === NULL || $request->date === 'latest') {
            $order = 'DESC';
        }
        else {
            $order = 'ASC';
        }

        $analyzes = Service::where('user_id', $user->user_id)
            ->where('kind', 'analysis')
            ->orderBy('date', $order)
            ->paginate(10);


        return view('frontend.analyzes', compact('user', 'analyzes'));
    }

    public function records()
    {
        $user = Auth::user();

        $this->setMeta('Записи', 'Описание');

        return view('frontend.records', compact('user'));
    }
}
