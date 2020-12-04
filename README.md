# Log HTTP requests to Telegram
> Easy to setup log service in php with notification via telegram. Help to track SSRF, XXE and blind XSS.
Once request received service log request to file and send Telegram message.

## Setting up
1. Set telegram bot api and telegram chat id in `index.php`
2. Upload files to your server.
3. Done! No more setup required.

## Test
Send request to our server: (In my case the address is: metestme.000webhostapp.com).
I use curl. You can visit server via browser.
```
curl https://metestme.000webhostapp.com/
```
And you will receive message in telegram:
![Screenshot](https://raw.githubusercontent.com/w1j3r/loghttptelegram/main/img/screenshot.jpg)
