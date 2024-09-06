@extends('master')
@section('title', 'Procurement System')

@section('info')
    
    <div class="card">
        <div class="card-body">
            <h1>รายการจัดซื้อจัดจ้าง</h1>
            <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>id</th>
                        <th>ประเภท</th>
                        <th>เหตุผล</th>
                        <th>คณะ</th>
                        <th>วันที่สร้างไฟล์</th>
                        <th>เอกต้องทำถึง</th>
                        <th>เอกต้องทำถึงวันที่</th>
                        <th>ระยะเวลาแล้วเสร็จ</th>
                        <th>การดำเนินการ</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($info as $info)
                        <tr>
                            <td> {{ $info->id }}</td>
                            <td> {{ $info->methode_name }}</td>
                            <td> {{ $info->reason_description }}</td>
                            <td> {{ $info->office_name }}</td>
                            <td> {{ $info->created_at->format('d/m/y') }}</td>
                            <td> {{ $info->attachdorder }}</td>
                            <td> {{ $info->attachdorder_date }}</td>
                            <td> {{ $info->devilvery_time }}</td>
                            <td>
                                <a href="{{ url("page/{$info->id}/edit") }}" role="button"
                                    class="btn btn-sm btn-warning">Edit</a>
                            
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
            <div class="mb-2">
                <a href="{{ url('/page') }}" role="button" class="btn btn-sm btn-danger">Back</a>
            </div>
        </div>
    </div>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
        
    @endif
@endsection
