<?php

use Carbon\Carbon;

if (!function_exists('autoForm')) {
    function autoForm($elements, $action, $classes = [], $model = null)
    {
        $model_form = null;
        if (!is_array($elements)) {
            $model_form = $elements;
            $elements = new $elements();
            $elements = $elements->getfillable();
            $elements['form_model'] = $model_form;
        }
        $formRepository = new \App\Repositories\FormRepository();
        return $formRepository->autoGenerate($elements, $action, $classes, $model);
    }
}

/**
 * Truncate a string after a given number of words -- limit number of words
 */
if (!function_exists('limit_string_words')) {
    function limit_string_words($text, $words_limit)
    {
        if (str_word_count($text, 0) > $words_limit) {
            $words = str_word_count($text, 2);
            $pos = array_keys($words);
            $text = substr($text, 0, $pos[$words_limit]) . ' ...';
        }
        return $text;
    }
}
/**
 * Get current logged in user
 */
if (!function_exists('getUser')) {
    function getUser($user_id = null)
    {
        if ($user_id)
            return \App\Models\User::whereId($user_id)->first();
        return auth()->user();
    }
}

if (!function_exists('getUserStatus')) {
    function getUserStatus($state)
    {
        return \App\Repositories\StatusRepository::getUserStatus($state);
    }
}

if (!function_exists('userCan')) {
    function userCan($slug)
    {
        return request()->user()->isAllowedTo($slug);
    }
}

if (!function_exists('userHas')) {
    function userHas($user_id, $slug, $section = 'writing')
    {
        return \App\Models\User::where('id', '=', $user_id)->first()->isAllowedTo($slug, $section);
    }
}
if (!function_exists('formatDeadline')) {
    function formatDeadline($date)
    {

        $date = \Carbon\Carbon::createFromTimestamp(strtotime($date));
        if ($date->isPast()) {
            $div_pre = '<strong class="text-danger">';
            $pre = "(late)";
            $days = $date->diffInDays();
            $hours = $date->copy()->addDays($days)->diffInHours();
            $minutes = $date->copy()->addDays($days)->addHours($hours)->diffInMinutes();
            $days_string = $days . 'D ';
            $hours_string = $hours . "H ";
        } else {
            $pre = '';
            $days = $date->diffInDays();
            $hours = $date->copy()->subDays($days)->diffInHours();
            if ($days > 0 || $hours > 5) {
                $div_pre = '<strong class="text-success">';
            } else {
                $div_pre = '<strong class="text-warning">';
            }
            $minutes = $date->copy()->subDays($days)->subHour($hours)->diffInMinutes();
            $days_string = $days . 'D ';
            $hours_string = $hours . "H ";
        }
        if ($days == 0)
            $days_string = "";
        if ($hours == 0)
            $hours_string = "";
        return $div_pre . $days_string . $hours_string . $minutes . "Mins " . $pre . '</strong>';
    }
}

if (!function_exists('formatDeadline1')) {
    function formatDeadline1($date)
    {
        $date = \Carbon\Carbon::createFromTimestamp(strtotime($date));
        if ($date->isPast())
            $div_pre = '<strong class="text-danger">';
        else
            $div_pre = '<strong class="text-success">';

        return $div_pre . $date->isoFormat('ddd, Do MMM Y') . '</strong>';
    }
}

if (!function_exists('getDaysDifference')) {
    function getDaysDifference($date_from, $date_to, $formated = false)
    {
        if (!$date_from)
            return 0;
        if ($date_to)
            $date_to = Carbon::parse($date_to);
        else
            $date_to = Carbon::today();

        $date_from = Carbon::parse($date_from);
        if ($date_to < $date_from)
            return 0;
        $date_diff = $date_to->diffInDaysFiltered(function (Carbon $date) {
            return !$date->isWeekend();
        }, $date_from);

        if (!$formated)
            return $date_diff;
        else
            if ($date_diff > 0)
                $div_pre = '<strong class="text-danger">';
            else
                $div_pre = '<strong class="text-success">';

        return $div_pre . number_format($date_diff) . '</strong>';
    }
}
if (!function_exists('getTimeDifferenceInDaysAndHours')) {
    function getTimeDifferenceInDaysAndHours($date_from, $date_to, $formated = false)
    {
        if (!$date_from)
            return 0;
        if ($date_to)
            $date_to = Carbon::parse($date_to);
        else
            $date_to = Carbon::today();
        $date_from = Carbon::parse($date_from);
        $div_pre = '<strong class="text-info">';
        $days = $date_from->diffInDays($date_to);
        $hours = $date_from->copy()->addDays($days)->diffInHours($date_to);
        $minutes = $date_from->copy()->addDays($days)->addHours($hours)->diffInMinutes($date_to);
        $days_string = ($days == 1) ? $days . 'Day ' : $days . 'Days ';
        $hours_string = ($hours == 1) ? $hours . 'Hr ' : $hours . 'Hrs ';

        if ($days == 0)
            $days_string = "";
        if ($hours == 0)
            $hours_string = "";
        return $div_pre . $days_string . $hours_string . $minutes . "Mins " . '</strong>';
    }
}



if (!function_exists('encryptProperty')) {
    function encryptProperty($data)
    {
        $encryptionKey = env('ENC_KEY');
        $encryption_key = base64_decode($encryptionKey);
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
        $encrypted = openssl_encrypt($data, 'aes-256-cbc', $encryption_key, 0, $iv);
        return base64_encode($encrypted . '::' . $iv);
    }
}

if (!function_exists('decryptProperty')) {
    function decryptProperty($data)
    {
        $encryptionKey = env('ENC_KEY');
        $encryption_key = base64_decode($encryptionKey);
        list($encrypted_data, $iv) = array_pad(explode('::', base64_decode($data), 2),2,null);
        return openssl_decrypt($encrypted_data, 'aes-256-cbc', $encryption_key, 0, $iv);

    }
}
