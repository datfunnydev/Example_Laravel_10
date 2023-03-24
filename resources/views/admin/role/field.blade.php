<div class="form-group">
    <label for="{{ $type }}name">{{ __('Tên chức vụ') }}<span style="color: red">*</span>:</label>
    <input id="{{ $type }}name" name="name" type="text" class="form-control form-control-solid"
           placeholder="{{ __('Tên chức vụ') }}" />
</div>
<div class="form-group">
    <label for="{{ $type }}desc">{{ __('Mô tả') }}:</label>
    <input id="{{ $type }}desc" name="desc" type="text" class="form-control form-control-solid"
           placeholder="{{ __('Mô tả') }}" />
</div>
<div class="row mt-4 user-select-none">
    @foreach($permissions as $value)
        <div class="col-md-4">
            <header class="card-header-custom p-1 mb-5">
                <h6 class="font-weight-bolder text-dark">{{ $value->name }}</h6>
            </header>
            <div class="card-text">
                <div class="row">
                    @foreach($value->permission as $item)
                        <div class="col-md-6 mb-1">
                            <div class="checkbox-list">
                                <label class="checkbox">
                                    <input type="checkbox" id="{{ $type }}permission_id_{{ $item->id }}" name="permission_id[]" value="{{ $item->id }}"/>
                                    <span></span>
                                    {{ $item->title }}
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endforeach
</div>

