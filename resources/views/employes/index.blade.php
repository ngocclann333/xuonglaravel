@extends('master')

@section('title')
    Danh sách nhân viên
@endsection

@section('content')
    <h1>
        Danh sách nhân viên

        <a class="btn btn-info" href="{{ route('employes.create') }}">Thêm mới</a>
    </h1>

    <div class="table-responsive">
        <table class="table table-primary">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Tên</th>
                    <th scope="col">Họ</th>
                    <th scope="col">Email</th>
                    <th scope="col">Điện thoại</th>
                    <th scope="col">Ngày sinh</th>
                    <th scope="col">Ngày làm việc</th>
                    <th scope="col">Lương</th>
                    <th scope="col">Hoạt động</th>
                    <th scope="col">Phòng ban</th>
                    <th scope="col">Được quản lý</th>
                    <th scope="col">Địa chỉ</th>
                    <th scope="col">Ảnh cá nhân</th>
                    <th scope="col">Ngày tạo</th>
                    <th scope="col">Ngày cập nhật</th>
                    <th scope="col">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $employe)
                    <tr class="">
                        <td scope="row">{{ $employe->id }}</td>
                        <td>{{ $employe->first_name }}</td>
                        <td>{{ $employe->last_name }}</td>
                        <td>{{ $employe->email }}</td>
                        <td>{{ $employe->phone }}</td>
                        <td>{{ $employe->date_of_birth }}</td>
                        <td>{{ $employe->hire_date }}</td>
                        <td>{{ $employe->salary }}</td>
                        <td>
                            {{-- hoạt động --}}
                            @if ($employe->is_active)
                                <span class="badge bg-primary">YES</span>
                            @else
                                <span class="badge bg-danger">NO</span>
                            @endif
                        </td>
                        <td>{{ $employe->department_id }}</td>
                        <td>{{ $employe->manager_id }}</td>
                        <td>{{ $employe->address }}</td>
                        <td>
                            {{-- image --}}
                            @if ($employe->profile_picture)
                                <img src="{{ Storage::url($employe->profile_picture) }}" alt="" width="100px">
                            @endif
                        </td>
                        <td>{{ $employe->created_at }}</td>
                        <td>{{ $employe->updated_at }}</td>
                        <td>
                            {{-- hành động --}}
                            <a class="btn btn-info" href="{{ route('employes.show', $employe) }}">Show</a>
                            <a class="btn btn-secondary" href="{{ route('employes.edit', $employe) }}">Edit</a>

                            <form action="{{ route('employes.destroy', $employe) }}" method="post">
                                @csrf
                                @method('DELETE')

                                <a type="submit" onclick="return confirm('Muốn xóa?')" class="btn btn-success"
                                    href="#">Xóa mềm</a>
                            </form>

                            <form action="{{ route('employes.forceDestroy', $employe) }}" method="post">
                                @csrf
                                @method('DELETE')

                                <a type="submit" onclick="return confirm('Muốn xóa?')" class="btn btn-light"
                                    href="#">Xóa cứng</a>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $data->links() }}
    </div>
@endsection
