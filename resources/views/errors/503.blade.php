<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Server is under maintenance</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap');
        body {
            font-family: 'Poppins', sans-serif;
            text-align: center;
        }

        .maintenance-text {
            margin: 0px 300px;
        }

        img {
            width: 30%;
        }

        @media only screen and (max-width: 600px) {
            img {
                width:100%;
            }
            .maintenance-text {
                margin: 0px 20px;
            }
        }
    </style>
</head>
<body>
    
<div class="maintenance-img">
    <img src="{{ env('APP_URL') }}/maintenance.jpg" />
</div>
<div class="maintenance-text">
    <h3>Server is under maintenance</h3>
    Our IT team is doing some maintenance and upgrading. 
    We are apologize for any inconveniences.
</div>

</body>
</html>
