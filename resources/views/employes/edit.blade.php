@extends('master')

@section('title')
    Update nhân viên
@endsection

@section('content')
    <h1>Update nhân viên {{ $employe->name }}</h1>

    @if (session()->has('success') && !session()->get('success'))
        <div class="alert alert-danger">
            {{ session()->get('error') }}
        </div>
    @endif

    {{-- hiển thị lỗi --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container">
        <form method="post" action="{{ route('employes.update', $employe->id) }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-3 row">
                <label for="first_name" class="col-4 col-form-label">Tên</label>
                <div class="col-8">
                    <input type="text" class="form-control" name="first_name" id="first_name" placeholder="first_name" />
                </div>
            </div>

            <div class="mb-3 row">
                <label for="last_name" class="col-4 col-form-label">Họ</label>
                <div class="col-8">
                    <input type="text" class="form-control" name="last_name" id="last_name" placeholder="last_name" />
                </div>
            </div>

            <div class="mb-3 row">
                <label for="email" class="col-4 col-form-label">Email</label>
                <div class="col-8">
                    <input type="email" class="form-control" name="email" id="email" placeholder="email" />
                </div>
            </div>

            <div class="mb-3 row">
                <label for="phone" class="col-4 col-form-label">Điện thoại</label>
                <div class="col-8">
                    <input type="tel" class="form-control" name="phone" id="phone" placeholder="phone" />
                </div>
            </div>

            <div class="mb-3 row">
                <label for="date_of_birth" class="col-4 col-form-label">Ngày sinh</label>
                <div class="col-8">
                    <input type="date" class="form-control" name="date_of_birth" id="date_of_birth"
                        placeholder="date_of_birth" />
                </div>
            </div>

            <div class="mb-3 row">
                <label for="hire_date" class="col-4 col-form-label">Ngày làm việc</label>
                <div class="col-8">
                    <input type="date" class="form-control" name="hire_date" id="hire_date" placeholder="hire_date" />
                </div>
            </div>

            <div class="mb-3 row">
                <label for="salary" class="col-4 col-form-label">Lương</label>
                <div class="col-8">
                    <input type="text" class="form-control" name="salary" id="salary" placeholder="salary" />
                </div>
            </div>

            <div class="mb-3 row">
                <label for="is_active" class="col-4 col-form-label">Hoạt động</label>
                <div class="col-8">
                    <input type="checkbox" class="form-checkbox" name="is_active" id="is_active" value="1" />
                </div>
            </div>

            <div class="mb-3 row">
                <label for="department_id" class="col-4 col-form-label">Phòng ban</label>
                <div class="col-8">
                    <input type="text" class="form-control" name="department_id" id="department_id"
                        placeholder="department_id" />
                </div>
            </div>

            <div class="mb-3 row">
                <label for="manager_id" class="col-4 col-form-label">Được quản lý</label>
                <div class="col-8">
                    <input type="text" class="form-control" name="manager_id" id="manager_id" placeholder="manager_id" />
                </div>
            </div>

            <div class="mb-3 row">
                <label for="address" class="col-4 col-form-label">Địa chỉ</label>
                <div class="col-8">
                    <input type="text" class="form-control" name="address" id="address" placeholder="address" />
                </div>
            </div>

            <div class="mb-3 row">
                <label for="profile_picture" class="col-4 col-form-label">Ảnh cá nhân</label>
                <div class="col-8">
                    <input type="file" class="form-control" name="profile_picture" id="profile_picture" />
                </div>
            </div>


            <div class="mb-3 row">
                <div class="offset-sm-4 col-sm-8">
                    <button type="submit" class="btn btn-primary">
                        Submit
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
