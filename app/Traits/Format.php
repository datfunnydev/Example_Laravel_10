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

    public function number_format_short(int $n, int $precision = 1): string
    {
        if ($n < 900) {
            $n_format = number_format($n, $precision);
            $suffix = '';
        } elseif ($n < 900000) {
            $n_format = number_format($n / 1000, $precision);
            $suffix = 'K';
        } elseif ($n < 900000000) {
            $n_format = number_format($n / 1000000, $precision);
            $suffix = 'M';
        } elseif ($n < 900000000000) {
            $n_format = number_format($n / 1000000000, $precision);
            $suffix = 'B';
        } else {
            $n_format = number_format($n / 1000000000000, $precision);
            $suffix = 'T';
        }
        if ($precision > 0) {
            $dot_zero = '.'.str_repeat('0', $precision);
            $n_format = str_replace($dot_zero, '', $n_format);
        }

        return $n_format.$suffix;
    }

    public function int_val($n): int
    {
        if (! $n) {
            $n = 0;
        }
        if (is_string($n)) {
            $str = ['%', 's', ','];
            foreach ($str as $s) {
                if (str_contains($n, $s)) {
                    $n = str_replace($s, '', $n);
                }
            }
        }

        return intval($n);
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
            if (! $data) {
                return [];
            }
            if (! $this->is_json($data)) {
                return [];
            }
            $tmp = json_decode(json_encode($data, true), true);
            if (! is_array($tmp)) {
                $tmp = json_decode($tmp, true);
            }

            return $tmp;
        } catch (Exception) {
        }

        return [];
    }

    public function json2string($data = '', $type = 'value'): string
    {
        if (! $this->is_json($data)) {
            return '';
        }
        $keywords = '';
        $array = $this->json2array($data);
        foreach ($array as $key) {
            $keywords .= $key[$type].',';
        }

        return rtrim($keywords, ',');
    }
}
