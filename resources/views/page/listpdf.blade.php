@extends('master')
@section('title', 'Procurement System')

@section('info')
    <div class="card">
        <div class="card-body">
            <h1 class="mb-4">รายการจัดซื้อจัดจ้าง</h1>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
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
                        @foreach ($info as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->methode_name }}</td>
                                <td>{{ $item->reason_description }}</td>
                                <td>{{ $item->office_name }}</td>
                                <td>{{ $item->created_at->format('d/m/Y') }}</td>
                                <td>{{ $item->attachdorder }}</td>
                                <td>{{ $item->attachdorder_date }}</td>
                                <td>{{ $item->devilvery_time }}</td>
                                <td>
                                    <a href="{{ url('generate-pdf/' . $item->id) }}" role="button" class="btn btn-sm btn-danger">ดาวน์โหลด PDF</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                <a href="{{ url('/page') }}" role="button" class="btn btn-danger">Back</a>
            </div>

            @if (session('success'))
                <div class="alert alert-success mt-3">
                    {{ session('success') }}
                </div>
            @endif
        </div>
    </div>
@endsection
