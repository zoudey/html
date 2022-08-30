@extends('layout.mater')
@section('title', 'Thêm mới người dùng')
@section('content-title', 'Thêm mới người dùng')

@section('content')
    {{-- @if ($errors->any())
        <ul class="text-danger">
            Vui Lòng kiểm tra lại
        </ul>
    @endif --}}
    <form action="{{ route('users.store_cate') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Name</label>
            <input type="text" class="form-control" name="name">
            @if ($errors->has('name'))
                <span class="text-danger">{{ $errors->first('name') }}</span>
            @endif
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Danh Mục Cha</label>
            <select name="parent_id" class="form-control" id="">
                <option value="0">Danh Mục Cha</option>
                <?php Showcate($cate); ?>
                {{-- @foreach ($cate as $item)
                    <option value="{{ $item->id }}">{{ $item->name }} {{ $item->parent_id }}</option>
                    @if ($item->children)
                        @foreach ($item->children as $child)
                            <option value="{{ $child->id }}">=>{{ $child->name }} {{ $child->parent_id }}</option>
                            @endif
                        @endforeach
                    @endif
                @endforeach --}}
            </select>
        </div>
        <div>
            <button type="submit" class="btn btn-primary">Tạo mới</button>
            <button type="reset" class="btn btn-warning">Nhập lại</button>
        </div>
    </form>
    <?php
    function Showcate($cate, $parent_id = 0, $char = '')
    {
        foreach ($cate as $key => $item) {
            if ($item->parent_id == $parent_id) {
                echo '<option value="' . $item->id . '">' . $char . $item->name . '</option>';
                unset($cate[$key]);

                Showcate($cate, $item->id, $char . '=>');
            }
        }
    }
    ?>
@endsection
