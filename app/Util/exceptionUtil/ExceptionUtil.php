<?php

namespace App\Util\exceptionUtil;
use  \Exception;
use function MongoDB\BSON\toJSON;

class ExceptionUtil extends Exception
{

    public function __construct(private readonly ExceptionCase $case,protected  $message ="")
    {

         match ($case){
            ExceptionCase::SYSTEM_MALFUNCTION => parent::__construct($message !=''? $this->message:  "SYSTEM MALFUNCTION"),
            ExceptionCase::BAD_REQUEST => parent::__construct($message !=''? $this->message:  "BAD REQUEST"),
            ExceptionCase::INVALID_CREDENTIAL => parent::__construct( $message !=''? $this->message: "INVALID CREDENTIAL"),
            ExceptionCase::INVALID_OTP => parent::__construct( $message !=''? $this->message: "INVALID OTP"),
            ExceptionCase::NOT_FOUND => parent::__construct( $message !=''? $this->message: "NOT FOUND"),
            ExceptionCase::NOT_SUCCESSFUL => parent::__construct( $message !=''? $this->message: "NOT SUCCESSFUL"),
            ExceptionCase::SOMETHING_WENT_WRONG => parent::__construct( $message !=''? $this->message: "SOMETHING WENT WRONG"),
            ExceptionCase::UNABLE_TO_LOCATE_RECORD => parent::__construct( $message !=''? $this->message:  "UNABLE TO LOCATE RECORD"),
            ExceptionCase::UNAUTHORIZED => parent::__construct( $message !=''? $this->message:  "UNAUTHORIZED"),
            ExceptionCase::UNABLE_TO_CREATE => parent::__construct( $message !=''? $this->message: "UNABLE TO CREATE"),
            ExceptionCase::UNABLE_TO_UPDATE => parent::__construct( $message !=''? $this->message: "UNABLE TO UPDATE"),
            ExceptionCase::INCORRECT_PASSWORD => parent::__construct( $message !=''? $this->message: "INCORRECT PASSWORD"),
            ExceptionCase::LOGIN_NOT_SUCCESSFUL => parent::__construct( $message !=''? $this->message: "LOGIN NOT SUCCESSFUL"),
            ExceptionCase::OTP_EXPIRED => parent::__construct( $message !=''? $this->message: "OTP EXPIRED"),
        };
    }
}

