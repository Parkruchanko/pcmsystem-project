@extends('master')
@section('info')
<main class="login-form">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <h3 class="card-header text-center">เข้าสู่ระบบ</h3>
                    @if(\Session::has('message'))
                        <div class="alert alert-info">
                            {{ \Session::get('message') }}
                        </div>
                    @endif
                    <div class="card-body">
                        <form method="POST" action="{{ route('postlogin') }}">
                            @csrf
                            <div class="form-group mb-3">
                                <input type="text" placeholder="อีเมล" id="email" class="form-control" name="email" autofocus>
                                @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <div class="form-group mb-3">
                                <input type="password" placeholder="รหัสผ่าน" id="password" class="form-control" name="password">
                                @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                            <div class="form-group mb-3">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> จดจำฉัน
                                    </label>
                                </div>
                            </div>
                            <div class="d-grid mx-auto">
                                <button type="submit" class="btn btn-primary">ล็อกอินเข้าสู่ระบบ</button> <!-- เปลี่ยนจาก <a> เป็น <button> -->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
