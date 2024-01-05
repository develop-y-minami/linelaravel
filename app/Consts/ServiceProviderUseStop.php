<?php

namespace App\Consts;

/**
 * ServiceProviderUseStop
 * 
 */
class ServiceProviderUseStop
{
    /**
     * USE
     * 
     */
    public const USE = ['value' => 0, 'name' => '有効'];
    /**
     * STOP
     * 
     */
    public const STOP = ['value' => 1, 'name' => '停止中'];

    /**
     * valueに対応するnameを返却
     * 
     * @param bool value
     * @return string name
     */
    public static function getName($value)
    {
        if ($value == true)
        {
            return \ServiceProviderUseStop::STOP['name'];
        }
        else
        {
            return \ServiceProviderUseStop::USE['name'];
        }
    }
}