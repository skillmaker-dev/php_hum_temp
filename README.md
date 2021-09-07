# php_hum_temp
IoT project to monitor Temperature &amp; Humidity in PHP server

![hum_temp_charts](https://user-images.githubusercontent.com/64654197/132410671-d1ed2414-d3c9-48b6-b5a1-cccddb30876e.png)


![IMG_20210902_204314672 NIGHT](https://user-images.githubusercontent.com/64654197/132410297-740b5292-cf44-4900-8911-73a1002acbbe.jpg)


Copy IoTth folder directly to htdocs in xampp then change username,password,servername... in "main_processing.php".<br/>
Import sql database file to your mysql server in phpmyadmin.
Upload the code located in folder "ESP8266 side" to ESP8266

Circuit is very simple: to upload code to your ESP8266 either you use ftdi or you can connect it via arduino,<br/>
<br/>
Connect EN,VCC to arduino's 3.3V<br/>
GND to arduino's GND<br/>
RX to RX<br/>
TX to TX<br/>
GPI0 to GND to be able to connect to ESP8266 <br/>
and don't forget to put Arduino's RESET pin in GND<br/>

after Uploading the code you can now connect your DHT11:<br/>

remove GPIO0 pin from GND<br/>
connect DHT11 VCC to 5V<br/>
DHT11 GND to GND<br/>
DHT11 S to GPIO2 in your ESP8266<br/>
Remove RESET pin from GND<br/>


Now you can type your server's ip address in browser and start monitoring data.


