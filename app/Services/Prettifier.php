<?php

namespace App\Services;


class Prettifier
{
    public static function prettifyPrice($price)
    {
        return number_format($price, 2, ',', ' ') . ' руб.';
    }

    public static function prettifyTextArea($text)
    {
        return str_replace("\n", "<br />", $text);
    }

    public static function prettifyTime($time)
    {
        return substr_replace($time, 0, -4);
    }

    public static function prettifyPhone($phone)
    {
        try {
            $matches = [];
            preg_match_all('/(\d{3})(\d{2})(\d{3})(\d{2})(\d{2})/', $phone, $matches);
            if (count($matches) && $phone) {
                return "+{$matches[1][0]} ({$matches[2][0]}) {$matches[3][0]}-{$matches[4][0]}-{$matches[5][0]}";
            }
            return '';
        } catch (\Exception $e) {
            return $phone;
        }
    }

    public static function prettifyPhoneClear($phone)
    {
        return str_replace(['+', '-', '_', ' ', '(', ')'], '', trim($phone));
    }

    public static function percent($price, $percent)
    {
        return $price - $price / 100 * $percent;
    }

    public static function prettifyDate($date)
    {
        return $date->day . ' ' . __('dates.month.long.' . $date->month) . ' ' . $date->year;;
    }

    public static function prettifyDateShort($date)
    {
        return $date->day . ' ' . __('dates.month.long.' . $date->month);
    }
}