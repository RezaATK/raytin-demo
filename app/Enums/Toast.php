<?php

namespace App\Enums;

enum Toast: string
{
    const SuccessOp = 'عملیات با موفقیت انجام شد.';
    const FailedOp = 'عملیات با موفقیت انجام نشد';

    const SuccessDelete = 'عملیات حذف با موفقیت انجام شد.';
    const FailedDelete = 'عملیات حذف با موفقیت انجام نشد.';
    const UnAuthorized = 'شما مجاز به انجام این اقدام نمی باشید.';


    const GreenIcon = 'success';
    const RedIcon = 'error';
    const OrangeIcon = 'warning';


    const GreenTimer = 1500;
    const RedTimer = 2500;
    const OrangeTimer = 2000;
}
