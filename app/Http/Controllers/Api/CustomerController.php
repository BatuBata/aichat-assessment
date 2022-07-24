<?php

namespace App\Http\Controllers\Api;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\CustomerRepository;

class CustomerController extends Controller
{
    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository       = $customerRepository;
    }

    public function eligibleCheck($customer_id)
    {
        $response           = $this->customerRepository->eligibleCheck($customer_id);
        
        return response()->json($response, $response['code']);
    }

    public function validateSubmission($customer_id)
    {
        $response           = $this->customerRepository->validateSubmission($customer_id);

        return response()->json($response, $response['code']);
    }
}
