<?php

namespace App\Http\Controllers;

use App\Http\Requests\BankDetails\CreateBankDetailsRequest;
use App\Http\Requests\BankDetails\ReadByBankDetailsIdRequest;
use App\Http\Requests\BankDetails\UpdateBankDetailsRequest;
use App\Service\BankDetailsService;
use App\Util\baseUtil\ResponseUtil;
use Illuminate\Http\JsonResponse;

class BankDetailsController extends Controller
{
    use ResponseUtil;
    public function __construct(protected BankDetailsService $bankDetailsService){
        //todo no code here
    }
    public function create(CreateBankDetailsRequest $request): JsonResponse
    {
        return $this->bankDetailsService->create($request);
    }
    public function update(UpdateBankDetailsRequest $request): JsonResponse
    {
        return $this->bankDetailsService->update($request);
    }
    public function read(): JsonResponse
    {
        return $this->bankDetailsService->read();
    }
    public function readById(ReadByBankDetailsIdRequest $request): JsonResponse
    {

        return $this->bankDetailsService->readById($request);
    }
    public function delete(ReadByBankDetailsIdRequest $request): JsonResponse
    {
        return $this->bankDetailsService->delete($request);
    }
}
