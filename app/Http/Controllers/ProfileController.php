<?php

namespace App\Http\Controllers;

use App\Http\Traits\MetaTags;
use App\Models\Notification;
use App\Models\Payments;
use App\Models\Record;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\API\UserController;
use Illuminate\Support\Facades\Validator;

/**
 * Class ProfileController
 * @package App\Http\Controllers
 */
class ProfileController extends Controller
{
    use MetaTags;


    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function profile()
    {
        $user = Auth::user();

        $this->setMeta('Профиль', 'Описание');

        return view('frontend.profile', compact('user'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function services(Request $request)
    {
        $user = Auth::user();

        $this->setMeta('Услуги', 'Описание');

        Notification::where('type', 'service')->where('user_id', $user->id)->update(['status' => 1]);

        return view('frontend.services', compact('user'));

    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function payments(Request $request)
    {
        $user = Auth::user();

        $this->setMeta('Платежи', 'Описание');

        if ($request->date === NULL || $request->date === 'latest') {
            $order = 'DESC';
        } else {
            $order = 'ASC';
        }

        if ($request->type === 'waiting' && $request->type !== NULL) {
            $payments = Payments::with(['service' => function ($q) use ($user) {
                $q->where('user_id', $user->user_id);
            }])
                ->where('user_id', $user->user_id)
                ->whereNot('orderPaidStatus', 'fully_paid')
                ->whereNot('orderPaidStatus', 'paid_by_credit')
                ->orderBy('date', $order)
                ->paginate(10);
        } else {
            $payments = Payments::with(['service' => function ($q) use ($user) {
                $q->where('user_id', $user->user_id);
            }])
                ->where('user_id', $user->user_id)
                ->where('orderPaidStatus', 'fully_paid')
                ->orWhere('orderPaidStatus', 'paid_by_credit')
                ->orderBy('date', $order)
                ->paginate(10);

        }

        Notification::where('type', 'payment')->where('user_id', $user->id)->update(['status' => 1]);

        return view('frontend.payment', compact('user', 'payments'));

    }

    /**
     * @param $id
     * @return array|\Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function getPDF($id)
    {
        return (new UserController())->getPDF($id);
    }

    /**
     * @param $filename
     * @return \Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function downloadFile($filename)
    {
        if (file_exists(storage_path("app/private/").$filename)) {
            return response()->download(storage_path("app/private/").$filename);
        } else {
            return redirect()->back()->withErrors("File not found.");
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function analyzes(Request $request)
    {
        $user = Auth::user();

        $this->setMeta('Анализы', 'Описание');


        Notification::whereHas('services', function ($q) {
            $q->where('kind', 'analysis')->where('status', 'ready');
        })->where('type', 'analysis')->where('user_id', $user->id)->update(['status' => 1]);


        return view('frontend.analyzes', compact('user'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function records(Request $request)
    {
        $user = Auth::user();

        $this->setMeta('Записи', 'Описание');

        if ($request->date === NULL || $request->date === 'latest') {
            $order = 'DESC';
        } else {
            $order = 'ASC';
        }

        if ($request->type === 'canceled' && $request->type !== NULL) {
            $appointments = Record::where('user_id', $user->user_id)
                ->where('status', 'canceled')
                ->orderBy('date', $order)
                ->paginate(2);
        } else {
            $appointments = Record::where('user_id', $user->user_id)
                ->orderBy('date', $order)
                ->paginate(2);

        }

        Notification::whereHas('records', function ($q) {
            $q->whereDate('date', '<', date('Y-m-d'));
        })->where('type', 'record')->where('user_id', $user->id)->update(['status' => 1]);

        $notifications = Notification::whereHas('records', function ($q) {
            $q->whereDate('date', '=', date('Y-m-d'));
        })->get();

        return view('frontend.records', compact('user', 'appointments', 'notifications'));
    }
}
