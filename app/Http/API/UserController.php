<?php

namespace App\Http\API;

use App\Http\Controllers\Controller;
use App\Mail\CredentialsMail;
use App\Models\Clinic;
use App\Models\Doctor;
use App\Models\Notification;
use App\Models\Payments;
use App\Models\Record;
use App\Models\Service;
use App\Models\ServiceAll;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Hash;
use Log;
use Mail;

/**
 * Class UserController
 * @package App\Http\API
 */
class UserController extends Controller
{
    /**
     * @var \Illuminate\Contracts\Auth\Authenticatable|User|null
     */
    private \Illuminate\Contracts\Auth\Authenticatable|null|User $user;
    /**
     * @var RequestController
     */
    private $API;

    /**
     * UserController constructor.
     */
    public function __construct()
    {
        $this->user = Auth::user();
        $this->API = new RequestController();
    }

    /**
     * @param $phone
     * @return \Illuminate\Http\RedirectResponse
     * @throws \JsonException
     */
    public function getCredentialsHandler($phone): \Illuminate\Http\RedirectResponse
    {
        $response = $this->API->sendResponse([
            'limit' => 100,
            'phone' => $phone,
            'offset' => 0,
        ], 'clients', 'GET');

        if ($response['status'] === 200 && $response['type'] === 'success') {
            $phone_user = $response['response']['data'][0]['phone'];
            $email = $response['response']['data'][0]['email'];

            try {
                $user = User::where('phone', $phone_user)->firstOrFail();
                session()->flash('error', 'Вы уже зарегистрированы в системе.');
                return redirect()->back();
            } catch (ModelNotFoundException $e) {

                $login = Str::random(8);
                $password = Str::random(12);

                $user = new User;
                $user->phone = $phone_user;
                $user->login = $login;
                $user->email = $email;
                $user->password = Hash::make($password);
                $user->save();

                $credentials = ['login' => $login, 'password' => $password];

                // Отправка сообщения на почту
                if (!empty($user->email)) {
                    if (!Mail::to($user->email)->send(new CredentialsMail($user, $login, $password))) {
                        Log::error("Error sending email to " . $user->email);
                    }
                }

                session()->flash('credentials', $credentials);
                return redirect()->back();
            }
        }

        session()->flash('error', 'Вы уже зарегистрированы в системе.');
        return redirect()->back();
    }

    /**
     * @throws \JsonException
     */
    public function getClinics(): void
    {
        $response = $this->API->sendResponse([
            'limit' => 100,
            'offset' => 0,
        ], 'clinics', 'GET');

        if ($response['status'] === 200 && $response['type'] === 'success') {
            foreach ($response['response']['data'] as $clinic) {
                $update_status = Clinic::updateOrCreate(
                    ['clinic_id' => $clinic['id']],
                    [
                        'title' => $clinic['title'],
                        'legal_name' => $clinic['legalName'],
                        'address_country' => $clinic['address']['country'],
                        'address_region' => $clinic['address']['region'],
                        'address_area' => $clinic['address']['area'],
                        'address_city' => $clinic['address']['city'],
                        'address_street' => $clinic['address']['street'],
                        'address_house' => $clinic['address']['house'],
                        'address_flat' => $clinic['address']['flat'],
                    ]
                );
            }
        }
    }

    /**
     * @throws \JsonException
     */
    public function getDoctors(): void
    {
        $response = $this->API->sendResponse([
            'userGroup' => 'medical_staff',
            'limit' => 100,
            'offset' => 0,
        ], 'users', 'GET');

        if ($response['status'] === 200 && $response['type'] === 'success') {
            foreach ($response['response']['data'] as $doctor) {
                $update_status = Doctor::updateOrCreate(
                    ['doctor_id' => $doctor['id']],
                    [
                        'name' => $doctor['name'],
                        'surname' => $doctor['surname'],
                        'secondName' => $doctor['secondName'],
                        'phone' => $doctor['phone'],
                        'currentClinicId' => $doctor['currentClinicId'],
                    ]
                );
            }
        }
    }

    /**
     * @throws \JsonException
     */
    public function getAllServices(): void
    {
        if ($this->user->user_id !== 0 && $this->user !== NULL) {
            $response = $this->API->sendResponse([
                'limit' => 100,
                'offset' => 0,
            ], 'entry_types', 'GET');

            if ($response['status'] === 200 && $response['type'] === 'success') {
                foreach ($response['response']['data'] as $service) {
                    $update_status = ServiceAll::updateOrCreate(
                        ['services_all_id' => $service['id']],
                        [
                            'title' => $service['title'],
                            'category_id' => $service['categoryId'],
                            'price' => $service['price'],
                            'clinics_id' => json_encode($service['clinicIds']),
                        ]
                    );
                }
            }
        }
    }

    /**
     * @param $service_id
     * @return array|\Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function getPDF($service_id): array|\Illuminate\Http\RedirectResponse
    {
        if ($this->user->user_id !== 0 && $this->user !== NULL) {
            $validator = Validator::make([
                'service_id' => $service_id
            ], [
                'service_id' => 'required|exists:services,token_pdf',
            ], [
                'service_id.required' => 'ID услуги является обязательным'
            ]);

            if ($validator->fails()) {
//                return redirect('404');
                return redirect()->back()->withErrors("File not found.");
            }

            $service = Service::where('token_pdf', $service_id)->first();
            $this->API->setHeader('Accept-Encoding', 'gzip');
            return $this->API->sendResponseClear([], 'entries/' . $service['service_id'] . '/pdf', 'GET');
        }
    }

    /**
     * @throws \JsonException
     */
    public function getServices(): void
    {
        if ($this->user->user_id !== 0 && $this->user !== NULL) {
            $response = $this->API->sendResponse([
                'clientId' => $this->user->user_id,
                'limit' => 100,
                'offset' => 0,
            ], 'entries', 'GET');

            if ($response['status'] === 200 && $response['type'] === 'success') {
                foreach ($response['response']['data'] as $service) {
                    $update_status = Service::updateOrCreate(
                        ['service_id' => $service['id']],
                        [
                            'user_id' => $this->user->user_id,
                            'title' => $service['title'],
                            'number' => $service['number'],
                            'price' => $service['price'],
                            'date' => $service['date'],
                            'kind' => $service['kind'],
                            'sum' => $service['sum'],
                            'finalSum' => $service['finalsum'],
                            'entryTypeId' => $service['entryTypeId'],
                            'order_id' => $service['orderId'],
                            'clinicId' => $service['clinicId'],
                            'status' => $service['state'],
                            'amount' => $service['amount'],
                            'doctor_id' => $service['userId'],
                            'parentEntryId' => $service['parentEntryId'],
                            'token_pdf' => hash('sha256', time() . $service['title'] . $service['orderId'])
                        ]
                    );

                    // If service complex is ready
                    if ($service['state'] === 'ready') {
                        $notification = Notification::updateOrCreate(
                            ['id' => $update_status->notification_id],
                            [
                                'user_id' => $this->user->id,
                                'name' => 'service',
                                'type' => $service['kind'] === 'analysis' ? 'analysis' : 'service'
                            ]
                        );

                        $update_status->notification_id = $notification->id;
                        $update_status->save();
                    }
                }
            }
        }
    }

    /**
     * @throws \JsonException
     */
    public function getPayments(): void
    {
        if ($this->user->user_id !== 0 && $this->user !== NULL) {
            $response = $this->API->sendResponse([
                'clientId' => $this->user->user_id,
                'limit' => 100,
                'offset' => 0,
            ], 'orders', 'GET');

            if ($response['status'] === 200 && $response['type'] === 'success') {
                foreach ($response['response']['data'] as $payment) {
                    $update_status = Payments::updateOrCreate(
                        ['order_id' => $payment['id']],
                        [
                            'user_id' => $this->user->user_id,
                            'customerId' => $payment['customerId'],
                            'clinic_id' => $payment['clinicId'],
                            'customerType' => $payment['customerType'],
                            'date' => $payment['date'],
                            'orderPaidStatus' => $payment['orderPaidStatus'],
                            'sum' => $payment['sum'],
                            'finalSum' => $payment['finalSum'],
                        ]
                    );

                    $notification = Notification::updateOrCreate(
                        ['id' => $update_status->notification_id],
                        [
                            'user_id' => $this->user->id,
                            'name' => 'payment',
                            'type' => 'payment'
                        ]
                    );

                    $update_status->notification_id = $notification->id;
                    $update_status->save();

                }
            }

        }
    }

    /**
     * @throws \JsonException
     */
    public function getAppointments(): void
    {
        $this->user = Auth::user();
        if ($this->user->user_id !== 0 && $this->user !== NULL) {
            $response = $this->API->sendResponse([
                'clientId' => $this->user->user_id,
                'limit' => 100,
                'offset' => 0,
            ], 'appointments', 'GET');

            if ($response['status'] === 200 && $response['type'] === 'success') {
                foreach ($response['response']['data'] as $appointment) {
                    $update_status = Record::updateOrCreate(
                        ['record_id' => $appointment['id']],
                        [
                            'user_id' => $this->user->user_id,
                            'clinic_id' => $appointment['clinicId'],
                            'order_id' => $appointment['orderId'],
                            'doctor_id' => $appointment['userId'],
                            'status' => $appointment['status'],
                            'call_confirmation_status' => $appointment['callConfirmationStatus'],
                            'date' => $appointment['date'],
                            'time' => $appointment['time'],
                            'duration' => (int)$appointment['duration'],
                            'note' => $appointment['note'],
                            'appointment_type' => $appointment['appointmentType']['title']
                        ]
                    );

                    $notification = Notification::updateOrCreate(
                        ['id' => $update_status->notification_id],
                        [
                            'user_id' => $this->user->id,
                            'name' => 'Запись ' . $appointment['date'] . ', в ' . $appointment['time'],
                            'type' => 'record'
                        ]
                    );

                    $update_status->notification_id = $notification->id;
                    $update_status->save();
                }
            }

        }
    }


    /**
     * @return bool
     * @throws \JsonException
     */
    public function processingPayments(): bool
    {
        if ($this->user->user_id !== 0 && $this->user !== NULL) {
            $response = $this->API->sendResponse([
//                'payerId' => $this->user->user_id,
//                'payerType' => 'client',
                'limit' => 100,
                'offset' => 0,
            ], 'payments', 'GET');

            if ($response['status'] === 200 && $response['type'] === 'success') {
                foreach ($response['response']['data'] as $payment) {
                    $update_status = Payments::updateOrCreate(
                        ['order_id' => $payment['order_id']],
                        [
                            'user_id' => $this->user->user_id,
                            'payerType' => $payment['payerType'],
                            'payerId' => $payment['payerId'],
                            'kind' => $payment['kind'],
                            'date' => $payment['date'],
                            'baseKind' => $payment['baseKind'],
                            'totalPaid' => $payment['totalPaid'],
                            'status' => 1
                        ]
                    );
                    if ($update_status) {
                        return true;
                    }
                }
            }
        }
        return false;
    }

    /**
     * @param string $name
     * @param string $surname
     * @param string $lastName
     * @return bool
     * @throws \JsonException
     */
    public function updateUser(string $name = '', string $surname = '', string $lastName = ''): bool
    {

        if ($this->user->user_id === 0 && $this->user !== NULL) {

            $phone = $this->user->phone;

            $response = $this->API->sendResponse([
                'phone' => $phone,
                'limit' => 100,
                'offset' => 0,
            ], 'clients', 'GET');


            if ($response['status'] === 200 && $response['type'] === 'success') {
                $response_header = $response['response']['data'][0];

                $this->user->user_id = $response_header['id'];
                $this->user->name = $response_header['name'];
                $this->user->surname = $response_header['surname'];
                $this->user->secondName = $response_header['secondName'];
                $this->user->email = $response_header['email'];
                $this->user->birthdate = $response_header['birthdate'];
                $this->user->phone = $response_header['phone'];

                $update_status = $this->user->save();

                if ($update_status) {
                    return true;
                }
            }
            return false;
        }

        return true;
    }
}
