<html lang="fa" dir="rtl">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ config('app.name') }}</title>


        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">

        <style>
            body{
                min-height:100vh;
                background:linear-gradient(135deg,#4f46e5,#06b6d4);
                display:flex;
                align-items:center;
                justify-content:center;
                font-family:tahoma,sans-serif;
            }

            .welcome-card{
                max-width:650px;
                width:100%;
                background:#fff;
                border:none;
                border-radius:24px;
                padding:50px;
                text-align:center;
                box-shadow:0 20px 60px rgba(0,0,0,.15);
            }

            .logo-box{
                width:230px;
                height:90px;
                border-radius:20px;
                margin:auto;
                background:linear-gradient(135deg,#4f46e5,#06b6d4);
                display:flex;
                align-items:center;
                justify-content:center;
                color:white;
                font-size:30px;
                font-weight:bold;
            }

            .login-btn{
                padding:12px 40px;
                border-radius:12px;
                font-size:18px;
                font-weight:600;
            }

            .feature{
                padding:12px;
                border-radius:12px;
                background:#f8fafc;
            }
        </style>


    </head>
    <body>

    <div class="welcome-card">


        <div class="logo-box">
            Company CRM
        </div>

        <h1 class="mt-4 fw-bold">
            سیستم مدیریت CRM
        </h1>

        <p class="text-muted mt-3 mb-4">
            مدیریت کاربران، تسک‌ها، حضور و غیاب و مرخصی‌ها
            در یک محیط یکپارچه و حرفه‌ای
        </p>



        <a href="{{ route('login') }}"
           class="btn btn-primary login-btn">

            ورود به سیستم

        </a>

    </div>

    </body>
    </html>

    </body>
</html>
