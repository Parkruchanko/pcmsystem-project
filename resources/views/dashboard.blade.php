@extends('master')
@section('title', 'Procurement System')

@section('info')
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
        }

        .container-flex {
            flex: 1;
        }

        .card {
            margin: 20px;
        }

        .header {
            background-color: #003366;
            color: white;
            padding: 20px;
            text-align: center;
        }

        .chart {
            padding: 20px;
        }

        .footer {
            background-color: #e9f5ff;
            padding: 15px;
            text-align: center;
            width: 100%;
            position: relative;
            bottom: 0;
        }
    </style>
    </head>

    <body>
        <div class="container-flex">
            <div class="card">
                <div class="card-body">
                    <div class="container">
                        <div class="row text-center">
                            <div class="col-md-3">
                                <div class="card text-white bg-danger mb-3">
                                    <div class="card-body">
                                        <h5 class="card-title">จัดซื้อ</h5>
                                        <p class="card-text">159 รายการ</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card text-white bg-primary mb-3">
                                    <div class="card-body">
                                        <h5 class="card-title">จัดจ้าง</h5>
                                        <p class="card-text">200 รายการ</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card text-white bg-success mb-3">
                                    <div class="card-body">
                                        <h5 class="card-title">วัสดุ</h5>
                                        <p class="card-text">2000 รายการ</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card text-white bg-danger mb-3">
                                    <div class="card-body">
                                        <h5 class="card-title">ครุภัณฑ์</h5>
                                        <p class="card-text">400 รายการ</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="card chart">
                                    <h5 class="card-title">รายการจัดซื้อจัดจ้างภายในปี 2566</h5>
                                    <canvas id="purchaseChart"></canvas>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card chart">
                                    <h5 class="card-title">รายการวัสดุและครุภัณฑ์ ภายในปี 2566</h5>
                                    <canvas id="materialChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            var ctx1 = document.getElementById('purchaseChart').getContext('2d');
            var purchaseChart = new Chart(ctx1, {
                type: 'line',
                data: {
                    labels: ['มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม',
                        'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'
                    ],
                    datasets: [{
                            label: 'จัดซื้อ',
                            data: [10, 20, 30, 40, 30, 20, 50, 40, 30, 50, 40, 60],
                            borderColor: 'yellow',
                            fill: false
                        },
                        {
                            label: 'จัดจ้าง',
                            data: [20, 30, 40, 50, 40, 30, 60, 50, 40, 60, 50, 70],
                            borderColor: 'red',
                            fill: false
                        }
                    ]
                }
            });

            var ctx2 = document.getElementById('materialChart').getContext('2d');
            var materialChart = new Chart(ctx2, {
                type: 'line',
                data: {
                    labels: ['มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม',
                        'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'
                    ],
                    datasets: [{
                            label: 'วัสดุ',
                            data: [30, 40, 50, 60, 50, 40, 70, 60, 50, 70, 60, 80],
                            borderColor: 'green',
                            fill: false
                        },
                        {
                            label: 'ครุภัณฑ์',
                            data: [40, 50, 60, 70, 60, 50, 80, 70, 60, 80, 70, 90],
                            borderColor: 'red',
                            fill: false
                        }
                    ]
                }
            });
        </script>
    </body>
@endsection
