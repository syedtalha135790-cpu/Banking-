<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $payload['subject'] ?? 'BMS Alert' }}</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #f4f6f8;
            margin: 0;
            padding: 40px 0;
            color: #333333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }
        .header {
            background-color: #1e3c72;
            color: white;
            padding: 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 22px;
            font-weight: bold;
        }
        .content {
            padding: 30px;
        }
        .greeting {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 15px;
        }
        .message {
            line-height: 1.6;
            margin-bottom: 25px;
            color: #555555;
        }
        .details-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
            background-color: #fafbfc;
            border: 1px solid #eaecee;
            border-radius: 8px;
        }
        .details-table td {
            padding: 12px 15px;
            border-bottom: 1px solid #eaecee;
        }
        .details-table tr:last-child td {
            border-bottom: none;
        }
        .label {
            font-weight: bold;
            color: #666666;
            width: 40%;
        }
        .val {
            text-align: right;
            font-weight: 600;
        }
        .footer {
            background-color: #fdfdfd;
            border-top: 1px solid #eaecee;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #888888;
        }
        .support-link {
            color: #1e3c72;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="container">
    <!-- Header -->
    <div class="header">
        <h1>BMS BANKING SYSTEM</h1>
    </div>

    <!-- Content Body -->
    <div class="content">
        <div class="greeting">Hello {{ $payload['recipient_name'] }},</div>
        
        @if($payload['note'])
            <div class="message">{{ $payload['note'] }}</div>
        @endif

        @if(!empty($payload['details']))
            <table class="details-table">
                @foreach($payload['details'] as $key => $val)
                    <tr>
                        <td class="label">{{ $key }}</td>
                        <td class="val">{{ $val }}</td>
                    </tr>
                @endforeach
            </table>
        @endif

        @if($payload['reference_number'])
            <div style="font-size: 11px; color: #aaaaaa; text-align: center;">
                Reference Correlation ID: <strong>{{ $payload['reference_number'] }}</strong>
            </div>
        @endif
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>This is an automated banking notification. Please do not reply directly to this email.</p>
        <p>Need support? Visit our website or email <a href="mailto:support@bmsbank.com" class="support-link">support@bmsbank.com</a></p>
        <p>&copy; {{ date('Y') }} BMS Bank. All rights reserved.</p>
    </div>
</div>

</body>
</html>
