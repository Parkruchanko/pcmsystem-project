@extends('master')

@section('title', 'Usage History')

@section('info')
<div class="container mt-4">
    

    <!-- ตรวจสอบว่ามีข้อมูลประวัติหรือไม่ -->
    @if($history->isEmpty())
        <div class="alert alert-warning">
            <p>No activity history available.</p>
        </div>
    @else
        <div class="card mb-4">
            <div class="card-header bg-dark text-white">
                <h4>ประวัติการใช้งาน</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>ชื่อผู้ใช้งาน</th> <!-- แสดงชื่อผู้ใช้ -->
                                <th>กิจกรรม</th>
                                <th>รายละเอียด</th>
                                <th>เวลา</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($history as $entry)
                                <tr>
                                    <td>{{ $entry->user ? $entry->user->name : 'Unknown User' }}</td> <!-- แสดงชื่อผู้ใช้ -->
                                    <td>{{ $entry->activity }}</td>
                                    <td>{{ $entry->details }}</td>
                                    <td>{{ $entry->created_at->format('d-m-Y H:i:s') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- ลิงก์สำหรับการแบ่งหน้า -->
                <div class="d-flex justify-content-center">
                    {{ $history->links('pagination::bootstrap-4') }}
                </div>
                <div class="mt-3">
                    <a href="{{ url('/page') }}" role="button" class="btn btn-danger">Back</a>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
