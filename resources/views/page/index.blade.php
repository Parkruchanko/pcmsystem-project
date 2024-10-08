@extends('master')
@section('title', 'Procurement System')

@section('info')
    <style>
        body{
            transform: scale(0.8); /* ลดขนาดลง 20% */
            transform-origin: top left; /* จุดศูนย์กลางการย่อขนาดอยู่ที่มุมซ้ายบน */
            width: 125%; /* ปรับขนาดให้พอดีกับการย่อขนาด */
            height: 125%; /* ปรับขนาดให้พอดีกับการย่อขนาด */
        }
        .btn-img {
            width: 80%;
            height: 0;
            padding-bottom: 80%;
            position: relative;
            overflow: hidden;
            border: 1px solid transparent;
            margin: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 15px;
        }

        .btn-img img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        @media (max-width: 576px) {
            .btn-img {
                padding-bottom: 100%;
            }
        }
        
        .alert {
            margin: 1rem;
        }
    </style>
    <div class="content">
        <div class="container py-4">
            <div class="row">
                <div class="col-6 col-md-3 mb-3">
                    <a href="{{ route('page.choiceform') }}" class="btn-img">
                        <img src="{{ asset('images/createpcm.png') }}" alt="Create PCM">
                    </a>
                </div>
                <div class="col-6 col-md-3 mb-3">
                    <a class="btn-img">
                        <img src="{{ asset('images/img1.png') }}" alt="Image 2">
                    </a>
                </div>
                <div class="col-6 col-md-3 mb-3">
                    <a href="{{ route('page.listpdf') }}"class="btn-img">
                        <img src="{{ asset('images/downloadpdf.png') }}" alt="Download PDF">
                    </a>
                </div>
                <div class="col-6 col-md-3 mb-3">
                    <a class="btn-img">
                        <img src="{{ asset('images/img2.png') }}" alt="Image 4">
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-6 col-md-3 mb-3">
                    <a class="btn-img">
                        <img src="{{ asset('images/img3.png') }}" alt="Image 5">
                    </a>
                </div>
                <div class="col-6 col-md-3 mb-3">
                    <a href="{{ route('page.list') }}" class="btn-img">
                        <img src="{{ asset('images/listpcm.png') }}" alt="List PCM">
                    </a>
                </div>
                <div class="col-6 col-md-3 mb-3">
                    <a class="btn-img">
                        <img src="{{ asset('images/img4.png') }}" alt="Image 7">
                    </a>
                </div>
                <div class="col-6 col-md-3 mb-3">
                    <a href="{{ url('/page/history') }}" class="btn-img">
                        <img src="{{ asset('images/logfile.png') }}" alt="Log File">
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-6 col-md-3 mb-3">
                    <a href="{{ url('/summary') }}" class="btn-img">
                        <img src="{{ asset('images/sm.png') }}" alt="Image 9">
                    </a>
                </div>
                <div class="col-6 col-md-3 mb-3">
                    <a class="btn-img">
                        <img src="{{ asset('images/img5.png') }}" alt="Image 10">
                    </a>
                </div>
                <div class="col-6 col-md-3 mb-3">
                    <a href="{{ url('/dashboard') }}" class="btn-img">
                        <img src="{{ asset('images/dashboard.png') }}" alt="Dashboard">
                    </a>
                </div>
                <div class="col-6 col-md-3 mb-3">
                    <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                        @csrf
                        <button class="btn-img">
                            <img src="{{ asset('images/logout.png') }}" alt="Logout">
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

@endsection
