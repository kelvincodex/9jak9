<?php

namespace App\Http\Service;

use App\Http\Requests\Authentication\ChangePasswordRequest;
use App\Http\Requests\Authentication\CompleteEnrollmentRequest;
use App\Http\Requests\Authentication\CompleteForgottenPasswordRequest;
use App\Http\Requests\Authentication\InitiateEnrollmentRequest;
use App\Http\Requests\Authentication\InitiateForgottenPasswordRequest;
use App\Http\Requests\Authentication\LoginRequest;
use App\Http\Requests\Authentication\ResendOtpRequest;
use App\Mail\OtpMail;
use App\Mail\WelcomeMail;
use App\Models\Customer;
use App\Util\baseUtil\DateTimeUtil;
use App\Util\baseUtil\RandomUtil;
use App\Util\exceptionUtil\ExceptionCase;
use App\Util\exceptionUtil\ExceptionUtil;
use Carbon\Carbon;
use Exception;
use App\Util\baseUtil\ResponseUtil;
use  \Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthenticationService
{
    use ResponseUtil;
    use RandomUtil;
    use DateTimeUtil;

    public function initiateEnrollment(InitiateEnrollmentRequest $request): JsonResponse
    {
        try {
            $otp = $this->OTP();
            //todo validate
            $request->validated($request);

            //todo action

            $customer = Customer::create([
                'customerFirstName'=>$request['customerFirstName'],
                'customerLastName'=>$request['customerLastName'],
                'customerPhoneNo'=>$request['customerPhoneNo'],
                'customerEmail'=>$request['customerEmail'],
                'customerStatus'=>"PENDING",
                'customerOtp'=>$otp,
                'customerOtpExpired'=>$this->addTimestamp(min:"5")
            ]);

            //todo check its successful
            if (!$customer) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_CREATE);
            //todo send email
            $fullName ="{$customer['customerFirstName']} " . " {$customer['customerLastName']}";
           $email =  Mail::to($request['customerEmail'])->send(new OtpMail($fullName,$otp));
           //todo check if not email sent
            if (!$email) throw new ExceptionUtil(ExceptionCase::SOMETHING_WENT_WRONG);

            return $this->SUCCESS_RESPONSE("OTP SENT SUCCESSFUL");
        }catch (Exception $ex){
           return $this->ERROR_RESPONSE($ex->getMessage());
        }

    }

    public function completeEnrollment(CompleteEnrollmentRequest $request): JsonResponse
    {
        try {
            //todo validate
            $request->validated($request);
            //todo action
            //todo check if the email exist
            $customer = Customer::where('customerEmail', $request['customerEmail'])
                ->where('customerStatus', 'PENDING')->first();

            if (!$customer) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_LOCATE_RECORD);
            //todo update customer

            //todo check otp
            if ($request['customerOtp'] != $customer['customerOtp'])
                throw new ExceptionUtil(ExceptionCase::INVALID_OTP);

            //todo check if otp is expired
            if ( $customer['customerOtpExpired'] < $this->dataTime())
                throw new ExceptionUtil(ExceptionCase::OTP_EXPIRED);

            $response = $customer->update([
                'customerPassword'=>Hash::make($request['customerPassword']),
                'customerStatus'=>"ACTIVE",
            ]);

            if (!$response) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_UPDATE);
            $fullName ="{$customer['customerFirstName']} " . " {$customer['customerLastName']}";
            //todo send email
            $email =  Mail::to($request['customerEmail'])
                                ->send(new WelcomeMail($fullName));
            //todo check if not email sent
            if (!$email) throw new ExceptionUtil(ExceptionCase::SOMETHING_WENT_WRONG);
            return $this->SUCCESS_RESPONSE("CREATED  SUCCESSFUL");
        }catch (Exception $ex){
            return $this->ERROR_RESPONSE($ex->getMessage());
        }
    }

    public function initiateForgottenPassword(InitiateForgottenPasswordRequest $request): JsonResponse
    {
        try {
            //todo validation
            $request->validated($request);
            $otp = $this->OTP();
            //todo action
            $customer = Customer::where('customerEmail', $request['customerEmail'])->first();
            if (!$customer) throw  new ExceptionUtil(ExceptionCase::UNABLE_TO_LOCATE_RECORD);
            //todo update otp and expiring date
           $update = $customer->update([
                'customerOtp'=>$otp,
                'customerOtpExpired'=>$this->addTimestamp(min:"5")
            ]);
           //todo check if updated
           if (!$update) throw new ExceptionUtil(ExceptionCase::SOMETHING_WENT_WRONG);

            //todo send email
            $fullName ="{$customer['customerFirstName']} " . " {$customer['customerLastName']}";
           $email =  Mail::to($request['customerEmail'])->send(new OtpMail($fullName,$otp));
            //todo check if not email sent
            if (!$email) throw new ExceptionUtil(ExceptionCase::SOMETHING_WENT_WRONG);

            return $this->SUCCESS_RESPONSE("OTP SENT SUCCESSFUL");
        }catch (Exception $ex){
            return $this->ERROR_RESPONSE($ex->getMessage());
        }
    }

    public function completeForgottenPassword(CompleteForgottenPasswordRequest $request): JsonResponse
    {
        try {
            //todo validate
            $request->validated($request->all());

            //todo action
            $customer = Customer::where('customerOtp', $request['customerOtp'])
                                    ->where('customerEmail', $request['customerEmail'])->first();

            if ($customer['customerOtpExpired'] < $this->dataTime()) throw new ExceptionUtil(ExceptionCase::OTP_EXPIRED);

            $response = $customer->update([
                'customerPassword'=>Hash::make($request['newCustomerPassword'])
            ]);
            if (!$response) throw new ExceptionUtil(ExceptionCase::NOT_SUCCESSFUL);
            return $this->SUCCESS_RESPONSE("PASSWORD CHANGED SUCCESSFULLY");
        }catch (Exception $ex){
            return $this->ERROR_RESPONSE($ex->getMessage());
        }
    }

    public function changePassword(ChangePasswordRequest $request): JsonResponse
    {
        try {
            //todo validate
            $request->validated($request->all());
            $customer = Customer::where('customerEmail', $request['customerEmail'])->first();
            $response = Hash::check($request['oldCustomerPassword'], $customer['customerPassword']);
            if (!$response) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_LOCATE_RECORD, "INVALID PASSWORD, PLS INPUT A VALID PASSWORD");

            return $this->SUCCESS_RESPONSE("CHANGE PASSWORD SUCCESSFUL");
        }catch (Exception $ex){
            return $this->ERROR_RESPONSE($ex->getMessage());
        }
    }

    public function login(LoginRequest $request): JsonResponse
    {
        try {
            //todo validate
            $request->validated($request->all());
            $customer = Customer::where('customerEmail', $request['customerEmail'])->first();
            if (!$customer) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_LOCATE_RECORD, "INVALID EMAIL");
            //todo check if password is same
            $response = Hash::check($request['customerPassword'], $customer['customerPassword']);

            if (!$response) throw new ExceptionUtil(ExceptionCase::INCORRECT_PASSWORD);

            return $this->BASE_RESPONSE(array_merge($customer->toArray(), ['token'=>$customer->createToken("API FOR ". $customer['customerEmail'])->plainTextToken]));
        }catch (Exception $ex){
            return $this->ERROR_RESPONSE($ex->getMessage());
        }
    }

    public function resendOtp(ResendOtpRequest $request): JsonResponse
    {
        try {
            //todo validate
            $request->validated($request->all());

            $otp = $this->OTP();
            //todo actions
            $customer = Customer::where('customerEmail', $request['customerEmail'])->first();

            if (!$customer) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_LOCATE_RECORD, "INVALID EMAIL");

            //todo send email
            //todo send email
            $fullName ="{$customer['customerFirstName']} " . " {$customer['customerLastName']}";
            $email =  Mail::to($request['customerEmail'])->send(new OtpMail($fullName,$otp));

            //todo check if not email sent
            if (!$email) throw new ExceptionUtil(ExceptionCase::SOMETHING_WENT_WRONG);

            return $this->SUCCESS_RESPONSE("OTP SENT SUCCESSFUL");
        }catch (Exception $ex){
            return $this->ERROR_RESPONSE($ex->getMessage());
        }
    }

}
