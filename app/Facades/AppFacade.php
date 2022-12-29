<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static AppSetting sendOtp($mobile, $message)
 * @method static AppSetting saveOtp(array $data)
 * @method static AppSetting getSettingValue(array $setting, $key)
 * @method static AppSetting sendMessageViaMshastra($phone, $text)
 * @method static AppSetting generateInvoiceNumber($prefix = '')
 * @method static AppSetting generateRequestNumber(string $prefix = '', int $length = 15)
 * @method static AppSetting generateActivityLog(string $table, string $action, int $actionRowId = null, int $user_id = null)

 *
 * @see AppSetting
 */
class AppFacade extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'TakeCareAppFacade';
    }
}
