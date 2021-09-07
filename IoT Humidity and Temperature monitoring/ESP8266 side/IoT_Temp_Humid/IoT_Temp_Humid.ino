/*

  IoT project to send Humidity and temperature read from DHT11 to PHP server 

  Made by Anas Chahid

  Github: https://github.com/skillmaker-dev
  Website: anaschahid.netlify.app
    
*/

#include <ESP8266WiFi.h>
#include <ESP8266WiFiMulti.h>
#include <DHT.h>
#define DHTPIN 2
#define DHTTYPE DHT11

#ifndef STASSID
#define STASSID "Your wifi name"
#define STAPSK  "password"
#endif


const char* ssid     = STASSID;
const char* password = STAPSK;

const char* host = "php server ip";
const uint16_t port = 80; //change port based on your server port
float temperature=0.0,humidity=0.0;


DHT dht(DHTPIN, DHTTYPE); 
WiFiClient client;
ESP8266WiFiMulti WiFiMulti;

void setup() {
  Serial.begin(115200);

  // We start by connecting to a WiFi network
  WiFi.mode(WIFI_STA);
  WiFiMulti.addAP(ssid, password);

  Serial.println();
  Serial.println();
  Serial.print("Wait for WiFi... ");

  while (WiFiMulti.run() != WL_CONNECTED) {
    Serial.print(".");
    delay(500);
  }

  Serial.println("");
  
  Serial.println("WiFi connected");
  Serial.println("IP address: ");
  Serial.println(WiFi.localIP());

  delay(500);
}


void loop() {
  Serial.print("connecting to ");
  Serial.print(host);
  Serial.print(':');
  Serial.println(port); 

      

  //if esp can't connect it shows error and retrys again
 if (!client.connect(host, port)) {
    Serial.println("connection failed");
    Serial.println("wait 5 sec...");
    delay(5000);
    return;
  }
      //Reading sensor data
      humidity = dht.readHumidity(); 
      temperature = dht.readTemperature();
      
  // This will send the request to the server
 client.print(String("GET http://SERVER_IP/iotth/index.php?temp=") + (float)humidity + "&hum=" + (float)temperature +
                          " HTTP/1.1\r\n" +
                 "Host: " + host + "\r\n" +
                 "Connection: close\r\n\r\n");
 Serial.println("GET Request sent");
 delay(3000);





                 
    unsigned long timeout = millis();
    while (client.available() == 0) {
        if (millis() - timeout > 1000) {
            Serial.println(">>> Client Timeout !");
            client.stop();
            return;
        }
    }


    Serial.println();
    Serial.println("closing connection");
}
