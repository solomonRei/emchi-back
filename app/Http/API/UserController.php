<?php

namespace App\Http\API;

use App\Http\Controllers\Controller;
use App\Models\Clinic;
use App\Models\Doctor;
use App\Models\Payments;
use App\Models\Record;
use App\Models\Service;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\API\RequestController;

class UserController extends Controller
{
    private \Illuminate\Contracts\Auth\Authenticatable|null|User $user;
    private $API;

    public function __construct()
    {
        $this->user = Auth::user();
        $this->API = new RequestController();
    }

    public function getClinics()
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

    public function getDoctors()
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
            echo $update_status->count();
        }
    }

    public function getServices()
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
                            'name' => $service['title'],
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
                        ]
                    );
                }
            }
        }
    }

    public function getPayments()
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
                            'clinicId' => $payment['clinicId'],
                            'customerType' => $payment['customerType'],
                            'date' => $payment['date'],
                            'orderPaidStatus' => $payment['orderPaidStatus'],
                            'sum' => $payment['sum'],
                            'finalSum' => $payment['finalSum'],
                        ]
                    );
                }
            }

        }
    }

    public function getAppointments()
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
                            'duration' => (int) $appointment['duration'],
                            'note' => $appointment['note'],
                            'appointment_type' => $appointment['appointmentType']['title']
                        ]
                    );
                }
            }

        }
    }


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

//        $surname = $user_exists && empty($surname) ? $this->user->surname : $surname;
//        $name = $user_exists && empty($name) ? $this->user->name : $name;
//        $lastName = $user_exists && empty($lastName) ? $this->user->lastName : $lastName;

        return true;
    }
}
