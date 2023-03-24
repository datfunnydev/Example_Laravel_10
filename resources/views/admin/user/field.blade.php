<div class="form-group">
    <label for="{{ $type }}role_id">{{ __('Chức vụ') }}<span style="color: red">*</span>:</label>
    <div>
        <select id="{{ $type }}role_id" name="role_id" style="width: 100%" class="form-control form-control-solid">
            <option label="Label"></option>
            @if($roles->count() > 0)
                @foreach ($roles as $item)
                    <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                @endforeach
            @endif
        </select>
    </div>
</div>
<div class="form-group">
    <label for="{{ $type }}email">{{ __('Email') }}<span style="color: red">*</span>:</label>
    <input id="{{ $type }}email" name="email" type="text" class="form-control form-control-solid"
           placeholder="{{ __('Email') }}" />
</div>
<div class="form-group">
    <label for="{{ $type }}name">{{ __('Họ và tên') }}<span style="color: red">*</span>:</label>
    <input id="{{ $type }}name" name="name" type="text" class="form-control form-control-solid"
           placeholder="{{ __('Họ và tên') }}" />
</div>
<div class="form-group">
    <label for="{{ $type }}phone">{{ __('Số điện thoại') }}:</label>
    <input id="{{ $type }}phone" name="phone" type="text" class="form-control form-control-solid"
           placeholder="{{ __('Số điện thoại') }}" />
</div>
<div class="form-group">
    <label for="{{ $type }}gender">{{ __('Giới tính') }}:</label>
    <div class="radio-inline">
        <label class="radio">
            <input type="radio" name="gender" value="0" />
            <span></span>{{ __('Nam') }}</label>
        <label class="radio">
            <input type="radio" name="gender" value="1" />
            <span></span>{{ __('Nữ') }}</label>
    </div>
</div>
<div class="form-group">
    <label for="{{ $type }}birthday">{{ __('Ngày sinh') }}:</label>
    <input id="{{ $type }}birthday" name="birthday" type="text" class="form-control form-control-solid" autocomplete="off"
           placeholder="{{ __('Ngày sinh') }}" />
</div>
<div class="form-group">
    <label for="{{ $type }}address">{{ __('Địa chỉ') }}:</label>
    <input id="{{ $type }}address" name="address" type="text" class="form-control form-control-solid"
           placeholder="{{ __('Địa chỉ') }}" />
</div>
