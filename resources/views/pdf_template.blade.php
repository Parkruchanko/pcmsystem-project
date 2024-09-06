<!DOCTYPE html>
<html>
<head>
    <title>รายงานข้อมูล</title>
    <style>
        @font-face {
            font-family: 'THSarabunNew';
            src: url('{{ storage_path('fonts/THSarabunNew.ttf') }}') format('truetype');
        }
        body {
            font-family: 'THSarabunNew', sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Document</h1>
    <p>ประเภท: {{ $method_name }}</p>
    <p>คณะ: {{ $office_name }}</p>
    <p>เหตุผล: {{ $reason_description }}</p>
    <p>เอกสารแนบ: {{ $attachdorder }}</p>
</body>
</html>
