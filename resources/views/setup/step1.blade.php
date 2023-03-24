<?php
$laravelVersion = '9.16';
$reqList = [
    '9.16' => [
        'php' => '8.1.0',
        'gd' => true,
        'bolt' => true,
        'openssl' => true,
        'pdo' => true,
        'fileinfo' => true,
        'json' => true,
        'curl' => true,
    ],
];
$strOk = '<i style="color: #22bb33;" class="fa fa-check"></i>';
$strFail = '<i style=" color: red; " class="fa fa-times"></i>';
$strUnknown = '<i class="fa fa-question"></i>';
$requirements = [];
$requirements['php_version'] = version_compare(PHP_VERSION, $reqList[$laravelVersion]['php'], '>=');
$requirements['openssl_enabled'] = extension_loaded('openssl');
$requirements['pdo_enabled'] = defined('PDO::ATTR_DRIVER_NAME');
$requirements['curl_enabled'] = extension_loaded('curl');
$requirements['fileinfo_enabled'] = extension_loaded('fileinfo');
$requirements['gd_enabled'] = extension_loaded('gd');
$requirements['json_enabled'] = extension_loaded('json');
$allValuesAreTrue = count(array_unique($requirements)) === 1;
if ($allValuesAreTrue) {
    session()->put('check', true);
}
?>

@extends('layout.setup')
@section('content')
    <div class="row">
        <div class="col-12 text-center mt-3">
            <ul class="progressbar">
                <li class="active"><a href="/setup/step-1">{{ __('Yêu cầu máy chủ') }}</a></li>
                <li>{{ __('Cài đặt') }}</li>
                <li>{{ __('Cơ sở dữ liệu') }}</li>
                <li>{{ __('Xác nhận') }}</li>
            </ul>
        </div>
    </div>

    <div class="row mt-3 p-5">
        <div class="col-12">
            @if (!$allValuesAreTrue)
                <p class="alert alert-danger">{{ __('Máy chủ của bạn không đáp ứng các yêu cầu sau') }}</p>
            @endif
            <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    PHP <?php
                        if (is_array($reqList[$laravelVersion]['php'])) {
                            $phpVersions = [];
                            foreach ($reqList[$laravelVersion]['php'] as $operator => $version) {
                                $phpVersions[] = "{$operator} {$version}";
                            }
                            echo implode(' && ', $phpVersions);
                        } else {
                            echo '>= ' . $reqList[$laravelVersion]['php'];
                        } ?>
                    <span><?php echo ' ' . ($requirements['php_version'] ? $strOk : $strFail); ?>
                        (<?php echo PHP_VERSION; ?>)</span>
                </li>

                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <?php if ($reqList[$laravelVersion]['openssl']) : ?>
                    <p>OpenSSL PHP Extension</p>
                    <?php endif; ?>
                    <span><?php echo $requirements['openssl_enabled'] ? $strOk : $strFail; ?></span>
                </li>

                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <?php if ($reqList[$laravelVersion]['gd']) : ?>
                    <p>Gd PHP Extension</p>
                    <?php endif; ?>
                    <span><?php echo $requirements['gd_enabled'] ? $strOk : $strFail; ?></span>
                </li>

                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <?php if ($reqList[$laravelVersion]['fileinfo']) : ?>
                    <p>fileinfo PHP Extension</p>
                    <?php endif; ?>
                    <span><?php echo $requirements['fileinfo_enabled'] ? $strOk : $strFail; ?></span>
                </li>

                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <?php if ($reqList[$laravelVersion]['pdo']) : ?>
                    <p>Pdo PHP Extension</p>
                    <?php endif; ?>
                    <span><?php echo $requirements['pdo_enabled'] ? $strOk : $strFail; ?></span>
                </li>

                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <?php if ($reqList[$laravelVersion]['curl']) : ?>
                    <p>Curl PHP Extension</p>
                    <?php endif ?>
                    <span><?php echo $requirements['curl_enabled'] ? $strOk : $strFail; ?></span>
                </li>


                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <?php if ($reqList[$laravelVersion]['json']) : ?>
                    <p>JSON PHP Extension</p>
                    <?php endif ?>
                    <span><?php echo $requirements['json_enabled'] ? $strOk : $strFail; ?></span>
                </li>

            </ul>
        </div>

        @if ($allValuesAreTrue)
            <div class="offset-6 col-6 col-md-6">
                <a href="{{ url('/setup/step-2') }}" id="next" class="btn btn-outline-danger mt-3 float-md-right">
                    {{ __('Tiếp tục') }} <i class="fa fa-angle-right"></i></a>
            </div>
        @endif
    </div>
@endsection
