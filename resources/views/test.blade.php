<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body
        {
            min-height: 100vh;
            display:flex;
            align-items: center;
            justify-content: center;
            background: #2400be;
        }

        .box
        {
            height: 350px;
            width: 250px;
            background: #fff;
            position: relative;
            border-radius: 5px;
            box-shadow:  0 0 10px rgba(0,0,0,0.7);
        }

        .box svg
        {
            height: 120px;
            width: 120px;
            position: relative;
            left: 50%;
            top: 50%;
            transform: translate(-50%,-50%) rotate(-90deg);
        }

        .box svg circle
        {
            fill: transparent;
            stroke: #007eff;
            stroke-width: 10;
            stroke-linecap: round;
            stroke-dasharray: 500;
            stroke-dashoffset: 500;
            animation: animate 1s linear infinite;
        }
        @keyframes animate{
            100%
            {
                stroke-dashoffset: 0;
            }
        }
        .box .stop
        {
            height: 110px;
            width: 110px;
            background: transparent;
            border-radius: 50%;
            border: 10px solid #007eff;
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%,-50%);
            display: none;
        }

        .box .progress
        {
            position: absolute;
            bottom: 60px;
            width: 100%;
            text-align: center;
            font-size: 25px;
            font-weight: 800;
            color: #007eff;
            font-family: sans-serif;
        }

        .box .counter
        {
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%,-50%);
            font-size: 20px;
            font-weight: 800;
            color: #007eff;
            font-family: sans-serif;
        }
    </style>
</head>
<body>
    <div class="box">
        <svg>
            <circle cx="60" cy="60" r="50">
            </circle>
        </svg>
        <div class="counter">0</div>
        <div class="stop"></div>
        <div class="progress">
            Progress Bar
        </div>
    </div>

    <script type="text/javascript">


        setTimeout(stopPoint, 1000);

        function stopPoint()
        {
            var stop = document.querySelector(".stop");
            stop.style.display = "block";
        }
    </script>

</body>
</html>

