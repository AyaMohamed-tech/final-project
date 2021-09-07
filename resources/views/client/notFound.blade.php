<!DOCTYPE html>
<html lang="en">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@600&display=swap" rel="stylesheet">

<style>
    body,
    html {
        height: 100%;
        width: 100%;
    }

    body {
        margin: 0;
        padding: 0;
        font-family: 'Cairo', sans-serif;
        line-height: 1.5;

    }

    .body-content {
        width: 50%;
        height: 100%;
        margin: auto;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .body-content img {
        width: 380px;
        object-fit: contain;
    }

    .block {
        display: block;
    }

    .aligne-center {
        text-align: center;
    }

    .body-content p {
        color: #565f8d;
        font-size: 18px;
        margin: 6px 0;
    }

    .body-content img {
        margin-bottom: 25px;
    }

    @media screen and (max-width: 600px) {
        .body-content img {
            width: 100%;
        }

        .body-content {
            width: 80%;
        }

        .body-content p {
            
            font-size: 16px;
           
        }
    }
</style>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Unavailable</title>
</head>

<body>
    <div class="body-content">
        <img src="../../../public/frontend/erorr.jpg" alt="">
        <p class="aligne-center">
            <span class="block">the website is under maintenance</span>
            <span class="block">please come back later</span>
        </p>
        <p class="aligne-center">
            <span class="block">الموقع تحت الصيانة</span>
            <span class="block"> يرجي العودة لاحقا</span>
        </p>
        <p>

        </p>
    </div>
</body>

</html>