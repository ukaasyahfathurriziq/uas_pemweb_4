<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>SPK Pemilihan Smartphone</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-NU9Qdz5W+Z1jIXK9+v5t6AqV40FayV/Os5l5B+eDBvXVsZr68W8NjfYXDuwb8QhO9R4dA5c3Zr7Ys5THXcQZw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- Styles -->
        <style>
            html, body {
                background-color: #000000;
                background-image: url('https://images.pexels.com/photos/404280/pexels-photo-404280.jpeg?cs=srgb&dl=pexels-noah-erickson-97554-404280.jpg&fm=jpg');
                background-size: cover;
                background-repeat: no-repeat;
                background-position: center center;
                background-attachment: fixed;
                color: #FFD700;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
                /* background: rgba(0, 0, 0, 0.5);  Hapus latar belakang transparan */
                padding: 20px;
                border-radius: 10px;
            }

            .title {
                font-size: 84px;
                margin-bottom: 20px;
            }

            .bold-title {
                font-weight: bold;
            }

            .links > a {
                color: #FFD700;
                padding: 10px 20px;
                font-size: 16px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
                border: 2px solid #FFD700;
                border-radius: 25px;
                transition: background-color 0.3s, color 0.3s;
            }

            .links > a:hover {
                background-color: #FFD700;
                color: #6495ED;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            footer {
                position: absolute;
                bottom: 20px;
                width: 100%;
                text-align: center;
                color: #FFD700;
                font-size: 14px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <?php if(Route::has('login')): ?>
                <div class="top-right links">
                    <?php if(auth()->guard()->check()): ?>
                        <a href="<?php echo e(url('/home')); ?>">Home</a>
                    <?php else: ?>
                        <a href="<?php echo e(route('login')); ?>">Login</a>
                        <?php if(Route::has('register')): ?>
                            <a href="<?php echo e(route('register')); ?>">Register</a>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <div class="content">
                <div class="title m-b-md">
                    <span class="bold-title">SPK Pemilihan Smartphone</span>
                </div>

                <div class="links">
                    <a href="https://github.com/ukaasyahfathurriziq"><i class="fab fa-github"></i> GitHub</a>
                </div>
            </div>
        </div>

        <footer>
            &copy; <?php echo e(date('Y')); ?> SPK Pemilihan Smartphone. All rights reserved.
        </footer>
    </body>
</html>
<?php /**PATH D:\LaravelSpk_saw\LaravelSpk_Saw\resources\views/welcome.blade.php ENDPATH**/ ?>