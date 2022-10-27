<?php

namespace App\Http\Controllers;

use App\Http\Requests\Authentication\ChangePasswordRequest;
use App\Http\Requests\Authentication\CompleteEnrollmentRequest;
use App\Http\Requests\Authentication\CompleteForgottenPasswordRequest;
use App\Http\Requests\Authentication\InitiateEnrollmentRequest;
use App\Http\Requests\Authentication\InitiateForgottenPasswordRequest;
use App\Http\Requests\Authentication\LoginRequest;
use App\Http\Requests\Authentication\ResendOtpRequest;
use App\Http\Service\AuthenticationService;
use App\Http\Service\CustomerService;
use Illuminate\Http\JsonResponse;

class AuthenticationsController extends Controller
{
    protected CustomerService $customerService;
    protected AuthenticationService $authenticationService;

    public function __construct(CustomerService $customerService,AuthenticationService $authenticationService){
        $this->customerService = $customerService;
        $this->authenticationService = $authenticationService;
    }

    public function initiateEnrollment(InitiateEnrollmentRequest $request): JsonResponse
    {
       return $this->authenticationService->initiateEnrollment($request);
    }
    public function completeEnrollment(CompleteEnrollmentRequest $request): JsonResponse
    {
        return $this->authenticationService->completeEnrollment($request);
    }
    public function initiateForgottenPassword(InitiateForgottenPasswordRequest $request): JsonResponse
    {
        return $this->authenticationService->initiateForgottenPassword($request);
    }
    public function completeForgottenPassword(CompleteForgottenPasswordRequest $request): JsonResponse
    {
        return $this->authenticationService->completeForgottenPassword($request);
    }
    public function changePassword(ChangePasswordRequest $request): JsonResponse
    {
        return $this->authenticationService->changePassword($request);
    }
    public function login(LoginRequest $request): JsonResponse
    {
        return $this->authenticationService->login($request);
    }
    public function resendOtp(ResendOtpRequest $request): JsonResponse
    {
        return  $this->authenticationService->resendOtp($request);
    }
}
