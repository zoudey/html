@extends('layout.mater')
@section('title', 'Sửa người dùng')
@section('content-title', 'Sửa người dùng')

@section('content')
    <form action="{{ route('users.update_cate', $cate->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label class="form-label">Name</label>
            <input type="text" class="form-control" name="name" value="{{ $cate->name }}" aria-describedby="name">
        </div>
        <div class="form-group">
            <label class="form-label">Đệ quy</label>
            <select name="parent_id" class="form-control">
                @foreach ($category as $item)
                    @if ($item->id == $cate->parent_id)
                        <option selected value="{{ $item->id }}">{{ $item->name }}</option>
                    @else
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <button type="reset" class="btn btn-warning">Nhập lại</button>
    </form>

@endsection
