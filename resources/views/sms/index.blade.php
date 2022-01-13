<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>SMS Test</title>

	<style type="text/css">
     body {
            background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
            height: 100vh;
		    display: flex;
		    align-items: center;
		    justify-content: center;
        }


        @keyframes gradient {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }

    
   body > div > a {
    width: 100%;
    padding: 5px;
    background-color: #fff;
    display: block;
    text-align: center;
    color: #000;
    font-weight: bold;
    font-size: 30px;
    text-decoration: none;
    border-radius: 20px;
}
    </style>
</head>
<body>
<div>
	 <a href="{{route('sms.nexmo.send')}}">click here to send sms via nexmo</a>
	 <hr>
	 <a href="{{route('sms.twilio.send')}}">click here to send sms via twilio</a>
</div>
</body>
</html>