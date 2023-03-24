<?php

namespace App\Http\Controllers\View;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use PDO;
use PDOException;
use Throwable;

class SetupController extends Controller
{
    public function view_step1(): View
    {
        return view('setup.step1');
    }

    public function view_step2(): View
    {
        if (! $this->valid(Session::get('check'))) {
            return $this->view_step1();
        }
        $data = [
            'APP_NAME' => Session::get('env.APP_NAME') ?: str_replace('"', '', config('app.name')),
            'APP_ENV' => Session::get('env.APP_ENV') ?: config('app.env'),
            'APP_DEBUG' => Session::get('env.APP_DEBUG') ?: config('app.debug'),
            'APP_KEY' => Session::get('env.APP_KEY') ?: config('app.key'),
        ];

        return view('setup.step2', [
            'data' => $data,
        ]);
    }

    public function view_step3(): View
    {
        if (! $this->valid(Session::get('check'))) {
            return $this->view_step1();
        }
        if (config('database.default') == 'mysql') {
            $db = config('database.connections.mysql');
        }
        $data = [
            'DB_CONNECTION' => Session::get('env.DB_CONNECTION') ?: config('database.default'),
            'DB_HOST' => Session::get('env.DB_HOST') ?: (isset($db['host']) ? $db['host'] : ''),
            'DB_PORT' => Session::get('env.DB_PORT') ?: (isset($db['port']) ? $db['port'] : ''),
            'DB_DATABASE' => Session::get('env.DB_DATABASE') ?: (isset($db['database']) ? $db['database'] : ''),
            'DB_USERNAME' => Session::get('env.DB_USERNAME') ?: (isset($db['username']) ? $db['username'] : ''),
            'DB_PASSWORD' => Session::get('env.DB_PASSWORD') ?: (isset($db['password']) ? str_replace('"', '', $db['password']) : ''),
        ];

        return view('setup.step3', [
            'data' => $data,
        ]);
    }

    public function view_step4(): View
    {
        if (! $this->valid(Session::get('check'))) {
            return $this->view_step1();
        }
        if (Session::get('env.DB_CONNECTION') == null) {
            $db_type = config('database.default');
        } else {
            $db_type = Session::get('env.DB_CONNECTION');
        }
        if ($db_type == 'mysql') {
            $db = config('database.connections.mysql');
        }
        $dbDatabase = Session::get('env.DB_DATABASE');
        $data = [
            'APP_NAME' => str_replace('"', '', Session::get('env.APP_NAME')) == str_replace('"', '', config('app.name')) ? 'old' : str_replace('"', '', Session::get('env.APP_NAME')),
            'APP_ENV' => Session::get('env.APP_ENV') == config('app.env') ? 'old' : Session::get('APP_ENV'),
            'APP_DEBUG' => Session::get('env.APP_DEBUG') == config('app.debug') ? 'old' : Session::get('env.APP_DEBUG'),
            'APP_KEY' => Session::get('env.APP_KEY') == config('app.key') ? 'old' : Session::get('env.APP_KEY'),
            'DB_CONNECTION' => Session::get('env.DB_CONNECTION') == config('database.default') ? 'old' : Session::get('env.DB_CONNECTION'),
            'DB_HOST' => Session::get('env.DB_HOST') == (isset($db['host']) ? $db['host'] : '') ? 'old' : Session::get('env.DB_HOST'),
            'DB_PORT' => Session::get('env.DB_PORT') == (isset($db['port']) ? $db['port'] : '') ? 'old' : Session::get('env.DB_PORT'),
            'DB_DATABASE' => $dbDatabase == (isset($db['database']) ? $db['database'] : '') ? 'old' : Session::get('env.DB_DATABASE'),
            'DB_USERNAME' => Session::get('env.DB_USERNAME') == (isset($db['username']) ? $db['username'] : '') ? 'old' : Session::get('env.DB_USERNAME'),
            'DB_PASSWORD' => str_replace('"', '', Session::get('env.DB_PASSWORD')) == (isset($db['password']) ? str_replace('"', '', $db['password']) : '') ? 'old' : str_replace('"', '', Session::get('env.DB_PASSWORD')),
        ];

        return view('setup.step4', [
            'data' => $data,
        ]);
    }

    public function view_final(): View
    {
        if (! $this->valid(Session::get('check'))) {
            return $this->view_step1();
        }
        Storage::disk('public')->put('installed', 'Contents');
        Session::flush();

        return view('setup.final');
    }

    public function new_key(): string
    {
        Artisan::call('key:generate', ['--show' => true]);
        $output = (Artisan::output());

        return substr($output, 0, -2);
    }

    public function setup_step2(Request $request): JsonResponse
    {
        $input = $request->all();
        Session::put('env.APP_NAME', '"'.$input['app_name'].'"');
        Session::put('env.APP_ENV', $input['app_env']);
        Session::put('env.APP_DEBUG', $input['app_debug']);
        Session::put('env.APP_KEY', $input['app_key']);

        return $this->success();
    }

    public function setup_step3(Request $request): JsonResponse
    {
        $input = $request->all();
        if ($this->valid($input['db_password'])) {
            Session::put('env.DB_PASSWORD', '"'.$input['db_password'].'"');
        }
        Session::put('env.DB_CONNECTION', $input['db_connection']);
        Session::put('env.DB_HOST', $input['db_host']);
        Session::put('env.DB_PORT', $input['db_port']);
        Session::put('env.DB_DATABASE', $input['db_database']);
        Session::put('env.DB_USERNAME', $input['db_username']);
        if ($input['db_connection'] == 'mysql') {
            try {
                new PDO($input['db_connection'].':host='.$input['db_host'].';port='.$input['db_port'].';dbname='.$input['db_database'], $input['db_username'], $input['db_password'],
                    [
                        PDO::ATTR_TIMEOUT => '5', PDO::ATTR_EMULATE_PREPARES => false,
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_LOCAL_INFILE => true,
                    ]);
            } catch (PDOException) {
                return $this->error();
            }

            return $this->success('Kết nối thành công');
        }

        return $this->error('Loại Database này chưa được hỗ trợ');
    }

    public function setup_step4(): RedirectResponse
    {
        define('STDIN', fopen('php://stdin', 'r'));
        try {
            $this->change_env([
                'APP_NAME' => Session::get('env.APP_NAME'),
                'APP_ENV' => Session::get('env.APP_ENV'),
                'APP_KEY' => Session::get('env.APP_KEY'),
                'APP_DEBUG' => Session::get('env.APP_DEBUG'),
                'APP_URL' => Session::get('env.APP_URL'),
                'LOG_CHANNEL' => Session::get('env.LOG_CHANNEL'),
                'DB_CONNECTION' => Session::get('env.DB_CONNECTION'),
                'DB_HOST' => Session::get('env.DB_HOST'),
                'DB_PORT' => Session::get('env.DB_PORT'),
                'DB_DATABASE' => Session::get('env.DB_DATABASE'),
                'DB_USERNAME' => Session::get('env.DB_USERNAME'),
                'DB_PASSWORD' => Session::get('env.DB_PASSWORD'),
            ]);
            Artisan::call('migrate');
            Artisan::call('db:seed');
            Artisan::call('optimize');
            Artisan::call('view:cache');
            Artisan::call('storage:link');
        } catch (Throwable) {
        }

        return redirect()->to('/setup/final');
    }
}
