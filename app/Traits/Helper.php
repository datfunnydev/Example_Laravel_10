<?php

namespace App\Traits;

use Exception;
use Illuminate\Http\JsonResponse;

trait Helper
{
    public function move_file($file_name, $new_name, $path, $file): JsonResponse
    {
        try {
            $file_size = number_format($file->getSize() / 1048576, 2);
            if ($file_size > 1) {
                return $this->error('Vui lòng không tải file lớn hơn 1MB');
            }
            if ($this->valid($file_name)) {
                $destinationPath = $path.$file_name;
                if (file_exists($destinationPath)) {
                    unlink($destinationPath);
                }
            }
            try {
                if (! file_exists($path)) {
                    mkdir($path, 0755, true);
                }
            } catch (Exception) {
            }
            $name = $new_name.'.'.$file->getClientOriginalExtension();
            $file->move($path, $name);

            return $this->success($name);
        } catch (Exception) {
            return $this->error('Vui lòng không tải file lớn hơn 1MB');
        }
    }

    public function valid($variable): bool
    {
        if (is_bool($variable)) {
            return $variable;
        }
        if (is_null($variable)) {
            return false;
        }
        if (is_countable($variable) || is_array($variable)) {
            if (count($variable) < 1) {
                return false;
            }
        }
        if (is_int($variable) || is_float($variable)) {
            if ($variable < 1) {
                return false;
            }
        }
        if (is_string($variable)) {
            $variable = strtolower($variable);
            if ($variable == 'true') {
                return true;
            }
            if ($variable == 'null' || $variable == 'undefined' || $variable == 'false' || $variable == '') {
                return false;
            }
        }

        return true;
    }

    public function is_json($string): bool
    {
        json_decode($string);

        return json_last_error() === JSON_ERROR_NONE;
    }

    public function calc_percent($present = 0, $past = 0): string
    {
        if ($present <= 0 && $past <= 0) {
            return '0%';
        }
        if ($present == 0) {
            return '-100%';
        }
        if ($past == 0) {
            return '+100%';
        }
        if ($past < $present) {
            return '+'.abs(round($present / $past * 100, 2)).'%';
        } elseif ($past > $present) {
            $percent = abs(round(100 - $present / $past * 100, 2));
            if ($percent > 100) {
                $percent = 100;
            }

            return '-'.$percent.'%';
        } else {
            return '0%';
        }
    }

    public function change_env($data = []): bool
    {
        if ($this->valid($data)) {
            $env = file_get_contents(base_path().'/.env');
            $env = preg_split('/(\r\n|\n|\r)/', $env);
            foreach ($data as $key => $value) {
                foreach ($env as $env_key => $env_value) {
                    $entry = explode('=', $env_value, 2);
                    if ($entry[0] == $key) {
                        if ($this->valid($value)) {
                            $env[$env_key] = $key.'='.$value;
                        }
                    } else {
                        $env[$env_key] = $env_value;
                    }
                }
            }
            $env = implode("\n", $env);
            file_put_contents(base_path().'/.env', $env);

            return true;
        }

        return false;
    }

    public function get_classes_from_file(string $filename): string
    {
        $namespace = '';
        $lines = file($filename);
        $namespaceLines = preg_grep('/^namespace /', $lines);
        if (is_array($namespaceLines)) {
            $namespaceLine = array_shift($namespaceLines);
            $match = [];
            preg_match('/^namespace (.*);$/', $namespaceLine, $match);
            $namespace = array_pop($match);
        }

        $classes = '';
        $php_code = file_get_contents($filename);
        $tokens = token_get_all($php_code);
        $count = count($tokens);
        for ($i = 2; $i < $count; $i++) {
            if ($tokens[$i - 2][0] == T_CLASS && $tokens[$i - 1][0] == T_WHITESPACE && $tokens[$i][0] == T_STRING) {
                $class_name = $tokens[$i][1];
                if ($namespace !== '') {
                    $classes = $namespace."\\$class_name";
                } else {
                    $classes = $class_name;
                }
            }
        }

        return $classes;
    }
}
