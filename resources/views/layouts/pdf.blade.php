<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ config('app.name') }}</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 15px;
        }

        .table {
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 15px;
            width: 100%;
        }

        .table.bordered {
            border: 1px solid #ddd;
        }

        .table thead {
            border-bottom: 3px solid #ddd;
        }

        .table tr:not(:last-child) {
            border-bottom: 1px solid #ddd;
        }

        .table th,
        .table td {
            padding: 10px;
        }

        .table th:not(:last-child),
        .table td:not(:last-child) {
            border-right: 1px solid #ddd;
        }

        .table tbody > tr:nth-child(even) {
            background-color: white;
        }

        .table tbody > tr:nth-child(odd) {
            background-color: #f5f5f5;
        }

        .table tfoot {
            border-top: 2px solid #ddd;
        }

        .signatories {
            font-size: 0;
        }

        .signatory {
            display: inline-block;
            font-size: 15px;
            white-space: nowrap;
            vertical-align: top;
            height: 120px;
            width: 50%;
            box-sizing: border-box;
        }

        .signatory > .signatory-info {
            padding: 5px;
            margin-top: 50px;
            width: 100%;
            box-sizing: border-box;
        }

        .signatory > .signatory-info::before {
            border-top: 1px solid #222;
            content: '';
            display: inline-block;
            margin-left: -5px;
            width: 90%;
        }

        .signatory > .signatory-info > span {
            font-size: 12px;
        }

        .serif-font {
            font-family: serif;
        }

        .no-padding {
            padding: 0;
        }

        .no-margin {
            margin: 0;
        }

        .text-center {
            text-align: center;
        }

        .text-left {
            text-align: left;
        }

        .text-right {
            text-align: right;
        }

        .shadow {
            box-shadow: 0 2px 2px rgba(34, 34, 34, 0.25);
        }
    </style>
</head>
<body>
@yield('content')
</body>
</html>
