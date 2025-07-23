<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan Kontak Baru</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background-color: #6d705d;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }

        .content {
            background-color: #f9f9f9;
            padding: 20px;
            border-left: 1px solid #ddd;
            border-right: 1px solid #ddd;
        }

        .footer {
            background-color: #f1f1f1;
            padding: 15px;
            text-align: center;
            font-size: 12px;
            color: #666;
            border-radius: 0 0 5px 5px;
            border: 1px solid #ddd;
        }

        .info-item {
            margin-bottom: 15px;
            border-bottom: 1px solid #eee;
            padding-bottom: 15px;
        }

        .info-item:last-child {
            border-bottom: none;
        }

        .label {
            font-weight: bold;
            color: #6d705d;
            display: block;
            margin-bottom: 5px;
        }

        .value {
            margin-left: 10px;
        }

        .message-box {
            background-color: white;
            border-left: 3px solid #6d705d;
            padding: 15px;
            margin-top: 10px;
            border-radius: 0 5px 5px 0;
        }

        .logo {
            max-width: 150px;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Pesan Kontak Baru</h1>
        <p>{{ date('d F Y - H:i') }}</p>
    </div>

    <div class="content">
        <div class="info-item">
            <span class="label">Nama Lengkap:</span>
            <div class="value">{{ $data['nama'] }}</div>
        </div>

        <div class="info-item">
            <span class="label">Nomor WhatsApp:</span>
            <div class="value">{{ $data['whatsapp'] }}</div>
        </div>

        <div class="info-item">
            <span class="label">Email:</span>
            <div class="value">{{ $data['email'] }}</div>
        </div>

        <div class="info-item">
            <span class="label">Layanan yang Dibutuhkan:</span>
            <div class="value">{{ $data['layanan'] ?: 'Tidak disebutkan' }}</div>
        </div>

        <div class="info-item">
            <span class="label">Pesan:</span>
            <div class="message-box">
                {{ $data['pesan'] ?: 'Tidak ada pesan' }}
            </div>
        </div>
    </div>

    <div class="footer">
        <p>Email ini dikirim otomatis dari website Interlife Furniture.</p>
        <p>&copy; {{ date('Y') }} Interlife Furniture. All rights reserved.</p>
    </div>
</body>

</html>
