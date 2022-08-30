@extends('layout.mater')

@section('title', 'quản lý user')

@section('conten-title', 'quản lý user')

@section('content')
    <div>
        <a href="{{ route('users.create_cate') }}"><button class="btn btn-info">Create</button></a>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên</th>
                <th>Sửa</th>
                <th>Xóa</th>
            </tr>
        </thead>
        <tbody>
            <?php Showcate($cate_list); ?>
            {{-- @foreach ($cate_list as $item)
                <tr>
                    <td>
                        <form action="{{ route('users.edit_cate', ['id' => $item->id]) }}" method="POST">
                            @csrf
                            @method('GET')
                            <button type="submit" class="btn btn-primary">Edit</button>
                        </form>
                    </td>
                    <td>
                        <form action="{{ route('users.delete_cate', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach --}}
        </tbody>

    </table>
    <div>
        {{ $cate_list->links() }}
    </div>
    <?php
    function Showcate($cate_list, $parent_id = 0, $char = '')
    {
        foreach ($cate_list as $key => $item) {
            if ($item->parent_id == $parent_id) {
                echo '<tr>';
                    echo '<td>'. $item->id . '</td>';
                    echo '<td>' . $char . $item->name . '</td>';

                    echo '<td>';
                        echo '<form action="'.route('users.edit_cate', ['id' => $item->id]).'" method="POST">
                            '.csrf_field().'
                            '.method_field('GET').'
                                <button type="submit" class="btn btn-primary">Edit</button>
                            </form>';
                    echo '</td>';
                    echo '<td>';
                        echo '<form action="'.route('users.delete_cate', $item->id).'" method="POST">
                            '.csrf_field().'
                            '.method_field('DELETE').'
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>';
                        echo '</td>';
                echo '</tr>';
                unset($cate_list[$key]);

                Showcate($cate_list, $item->id, $char . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;');
            }
        }
    }
    ?>
@endsection
