<?php

namespace App\Traits;

use Carbon\Carbon;
use Exception;

trait Format
{
    public function time_format($date, string $format = 'd-m-Y'): string|null
    {
        if (! $date) {
            return null;
        }
        if ($date instanceof Carbon) {
            return $date->format($format);
        }

        return Carbon::parse($date)->format($format);
    }

    public function text_format_short(string $text, int $limit = 400): string
    {
        $text = $text.' ';
        $text = substr($text, 0, $limit);
        $text = substr($text, 0, strrpos($text, ' '));

        return $text.'...';
    }

    public function number_format_short(float $n, int $precision = 1): string
    {
        $suffixes = ['', 'K', 'M', 'B', 'T', 'Q'];
        $suffixIndex = 0;

        while (abs($n) >= 1000 && $suffixIndex < count($suffixes) - 1) {
            $n /= 1000;
            $suffixIndex++;
        }

        $n_format = number_format($n, $precision);
        if ($precision > 0) {
            $n_format = rtrim($n_format, '0');
            $n_format = rtrim($n_format, '.');
        }

        return $n_format . $suffixes[$suffixIndex];
    }

    public function string2int(string $n): int
    {
        if (! $n) {
            $n = 0;
        }
        $special_chars = ['%', 's', ',', '$', '+', '-'];
        $n = str_replace($special_chars, '', $n);

        return intval($n);
    }

    public function string2bool(string $str): string|null
    {
        $str = strtolower($str);
        if ($str == 'true' || $str == 'false') {
            return $str;
        }

        return null;
    }

    public function string2slug(string $str): string
    {
        $unicode = [
            'a' => 'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
            'd' => 'đ',
            'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
            'i' => 'í|ì|ỉ|ĩ|ị',
            'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
            'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
            'y' => 'ý|ỳ|ỷ|ỹ|ỵ',
            'A' => 'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
            'D' => 'Đ',
            'E' => 'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
            'I' => 'Í|Ì|Ỉ|Ĩ|Ị',
            'O' => 'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            'U' => 'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
            'Y' => 'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
        ];
        foreach ($unicode as $nonUnicode => $uni) {
            $str = preg_replace("/($uni)/i", $nonUnicode, $str);
        }
        $str = str_replace(' ', '-', $str);

        return strtolower($str);
    }

    public function json2array($data = ''): array
    {
        try {
            $decoded_data = json_decode($data, true, 512, JSON_THROW_ON_ERROR);
            if (! is_array($decoded_data)) {
                return [];
            }

            return $decoded_data;
        } catch (Exception) {
        }

        return [];
    }

    public function json2string($data = '', $type = 'value'): string
    {
        $keywords = '';
        $array = $this->json2array($data);
        foreach ($array as $key) {
            $keywords .= $key[$type].',';
        }

        return rtrim($keywords, ',');
    }
}
