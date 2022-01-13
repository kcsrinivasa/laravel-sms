![Laravel](https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg)


# Laravel Send SMS

Hi All!

SMS (Short Message Service) is a text messaging service component of most telephone, Internet, and mobile device systems.

Here is the example focused on send sms using nexmo and twilio. and we will learn how to send simple sms notification using nexmo or twilio.

Nexmo's and Twilio's SMS API allows you to send and receive text messages to users around the globe through simple RESTful APIs.

### Preview
Browser screen
![browser_screen](https://github.com/kcsrinivasa/laravel-sms/blob/main/output/browser_screen.jpg?raw=true)
SMS sent output
![sms_sent_output](https://github.com/kcsrinivasa/laravel-sms/blob/main/output/sms_sent_output.jpg?raw=true)
received sms from nexmo
![nexmo_sms](https://github.com/kcsrinivasa/laravel-sms/blob/main/output/nexmo_sms.jpg?raw=true)
received sms from twilio
![twilio_sms](https://github.com/kcsrinivasa/laravel-sms/blob/main/output/twilio_sms.jpg?raw=true)



### Step 1: Install Laravel
```bash
composer create-project --prefer-dist laravel/laravel sms
```

### Step 2: Create twilio/nexmo account
#### For Twilio
To establish the consensus between the laravel app and Twilio client, we need to have the Twilio key and secret. Hence, go to the dashboard. And, copy both key and secret.


Create twilio account here : [www.twilio.com](https://www.twilio.com/)
![twilio_console](https://github.com/kcsrinivasa/laravel-sms/blob/main/output/twilio_console.jpg?raw=true)

Add test phone numbers to twilio
![twilio_add_number](https://github.com/kcsrinivasa/laravel-sms/blob/main/output/twilio_add_number.jpg?raw=true)

#### For Nexmo

To establish the consensus between the laravel app and Vonyage client, we need to have the Nexmo key and secret. Hence, create the vonyage account. And, copy both key and secret from the Vonyage API dashboard.

Create nexmo account here : [https://dashboard.nexmo.com/sign-in](https://dashboard.nexmo.com/sign-in)
![nexmo_dashboard](https://github.com/kcsrinivasa/laravel-sms/blob/main/output/nexmo_api.jpg?raw=true)

Add test phone numbers to nexmo 
![nexmo_test_numbers](https://github.com/kcsrinivasa/laravel-sms/blob/main/output/nexmo_test_numbers.jpg?raw=true)


### Step 3: Update twilio/nexmo credentials in .env file

```javascript
TWILIO_SID=XXXXXXXXXXXXXXXXX
TWILIO_AUTH_TOKEN=XXXXXXXXXXXXX
TWILIO_FROM=+XXXXXXXXXXX


NEXMO_KEY=XXXXXXXXX
NEXMO_SECRET=XXXXXXXXXXXXX

```

### Step 4: Install  package
Nexmo package
```bash
composer require nexmo/client
```
Twilio package
```bash
composer require twilio/sdk 
```

### Step 5: Create controller
```bash
php artisan make:controller SMSController
```

### Step 6: Add routes
```bash
Route::get('/sms', 'App\Http\Controllers\SMSController@index')->name('sms.index');
Route::get('/sms-send/nexmo', 'App\Http\Controllers\SMSController@send_nexmo_sms')->name('sms.nexmo.send');
Route::get('/sms-send/twilio', 'App\Http\Controllers\SMSController@send_twilio_sms')->name('sms.twilio.send');
```
### Step 7: Add functions in controller
Add below functions in app/Http/Controllers/SMSController.php
```bash
use Twilio\Rest\Client;
 /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('sms.index');
    }

    /**
     * send nexmo sms.
     *
     * @return \Illuminate\Http\Response
     */
    public function send_nexmo_sms()
    {
         try {
  
            $basic  = new \Nexmo\Client\Credentials\Basic(getenv("NEXMO_KEY"), getenv("NEXMO_SECRET"));
            $client = new \Nexmo\Client($basic);
  
            $receiverNumber = "91XXXXXXXXXX";
            $message = "Hi \r\n This is testing from laravel";
  
            $message = $client->message()->send([
                'to' => $receiverNumber,
                'from' => 'Laravel SMS',
                'text' => $message
            ]);
            dd('SMS Sent Successfully.'); 
        } catch (Exception $e) {
            dd("Error: ". $e->getMessage());
        }
    }

    /**
     * send twilio sms.
     *
     * @return \Illuminate\Http\Response
     */
    public function send_twilio_sms()
    {
        $receiverNumber = "+91XXXXXXXXXX";
        $message = "This is testing from laravel twilio";
  
        try {
            $account_sid = getenv("TWILIO_SID");
            $auth_token = getenv("TWILIO_AUTH_TOKEN");
            $twilio_number = getenv("TWILIO_FROM");
  
            $client = new Client($account_sid, $auth_token);
            $sms = $client->messages->create($receiverNumber, [
                'from' => $twilio_number, 
                'body' => $message]);
  
            dd('SMS Sent Successfully. SMS-SID : '.$sms->sid);
        } catch (Exception $e) {
            dd("Error: ". $e->getMessage());
        }
    }
```


### Step 8: Create blade file

Goto "resources\views\sms\index.blade.php" to grab the get routes hyper links
```bash
<a href="{{route('sms.nexmo.send')}}">click here to send sms via nexmo</a>
	 <hr>
<a href="{{route('sms.twilio.send')}}">click here to send sms via twilio</a>
```
### Step 9: Final run and check in browser
```bash
mv server.php index.php
cp public/.htaccess .
```
open in browser
```bash
http://localhost/laravel/sms
```