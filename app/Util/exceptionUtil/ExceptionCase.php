<?php

namespace App\Util\exceptionUtil;

enum ExceptionCase
{
    Case SYSTEM_MALFUNCTION;
    Case SOMETHING_WENT_WRONG;
    Case UNABLE_TO_LOCATE_RECORD;
    Case NOT_SUCCESSFUL;
    Case UNAUTHORIZED;
    Case NOT_FOUND;
    Case BAD_REQUEST;
    Case INVALID_CREDENTIAL;
    Case INVALID_OTP;
    Case UNABLE_TO_CREATE;
    Case UNABLE_TO_UPDATE;
    Case INCORRECT_PASSWORD;
    Case OTP_EXPIRED;
    Case LOGIN_NOT_SUCCESSFUL;
}
