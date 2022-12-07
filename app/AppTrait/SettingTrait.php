<?php
/*
 * File Created: 3/5/22, 7:22 PM
 * Last Modified: 3/5/22, 7:22 PM
 * File: SettingTrait.php
 * Path: C:/wamp64/www/takecare/app/AppTrait/SettingTrait.php
 * Class: SettingTrait.php
 * Copyright (c) $year
 * Created by Ariful Islam
 * All Rights Preserved By
 * If you have any query then knock me at
 * arif98741@gmail.com
 * See my profile @ https://github.com/arif98741
 */

namespace App\AppTrait;

use Illuminate\Support\Facades\DB;

trait SettingTrait
{
    /**
     * @return array
     */
    public function getSettings()
    {
        $settingsData = DB::table('settings')
            ->select('name', 'value')
            ->get();

        $settings = [];
        foreach ($settingsData as $value) {
            $settings[$value->name] = $value->value;
        }

        return $settings;

    }
}
