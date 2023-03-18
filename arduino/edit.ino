#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include <SoftwareSerial.h>
#include <Adafruit_Fingerprint.h>
//Fingerprint scanner Pins
#define Finger_Rx 5 //5
#define Finger_Tx 2 //2
#define SERVER_IP "abuad-fingerprint.000webhostapp.com/getdata.php"
#ifndef STASSID
#define STASSID "Joshua"
#define STAPSK "asdfqwerpenp"
const char fingerprint[] PROGMEM = "92 99 1E EC B2 E4 C2 E2 E3 D4 05 9D 5A 31 CB DB 3E 69 12 5C";
SoftwareSerial mySerial(Finger_Rx, Finger_Tx);
Adafruit_Fingerprint finger = Adafruit_Fingerprint(&mySerial);
String postData ;
int FingerID = 0  ;     // The Fingerprint ID from the scanner 
uint8_t id;
#endif

void setup() {

  Serial.begin(115200);
  finger.begin(57600);

  Serial.println();
  Serial.println();
  Serial.println();
  connectToWiFi();
}

void loop() {
  // wait for WiFi connection
  if(WiFi.status() != WL_CONNECTED){
    connectToWiFi();
  }
  if ((WiFi.status() == WL_CONNECTED)) {
    FingerID = getFingerprintID();
    delay(50);    
    //Serial.println(FingerID);
    DisplayFingerprintID();
    ChecktoAddID();
  }

  //delay(10000);
}
void DisplayFingerprintID(){
  //Fingerprint has been detected 
  if (FingerID > 0){
    SendFingerprintID( FingerID ); // Send the Fingerprint ID to the website.     
  }

  //No finger detected
  else if (FingerID == 0){
    //Serial.print("No finger detected");
  
  }
  //---------------------------------------------
  //Didn't find a match
  else if (FingerID == -1){
     Serial.print("Didn't find a match");
     Serial.println("\n");
  }
  //---------------------------------------------
  //Didn't find the scanner or there an error
  else if (FingerID == -2){
     Serial.print("Didn't find the scanner or there an error");
     Serial.println("\n");
  }
}
void SendFingerprintID( int finger ){
  WiFiClientSecure client;
  HTTPClient http;
  Serial.print("[HTTP] begin...\n");
  // configure traged server and url
  postData = "FingerID=" + String(finger);
  client.setFingerprint(fingerprint);
  http.begin(client, "https://" SERVER_IP);  // HTTP
  http.addHeader("Content-Type", "application/x-www-form-urlencoded");

  Serial.print("[HTTP] POST...\n");
  // start connection and send HTTP header and body
  int httpCode = http.POST(postData);

  // httpCode will be negative on error
  if (httpCode > 0) {
    // HTTP header has been send and Server response header has been handled
    Serial.printf("[HTTP] POST... code: %d\n", httpCode);

    // file found at server
    if (httpCode == HTTP_CODE_OK) {
      const String& payload = http.getString();
      Serial.println("*******************************************\n");
          Serial.println("received SendFingerprintID httpcode:\n");
          Serial.println(httpCode);
          Serial.println("received SendFingerprintID payload:\n");
          Serial.println(payload);
          Serial.println("*******************************************\n");
          Serial.println("\n");
    }
  } else {
    Serial.printf("[HTTP] POST... failed, error: %s\n", http.errorToString(httpCode).c_str());
  }

  http.end();
}
int getFingerprintID() {
  uint8_t p = finger.getImage();
  switch (p) {
    case FINGERPRINT_OK:
      //Serial.println("Image taken");
      break;
    case FINGERPRINT_NOFINGER:
      //Serial.println("No finger detected");
      return 0;
    case FINGERPRINT_PACKETRECIEVEERR:
      //Serial.println("Communication error");
      return -2;
    case FINGERPRINT_IMAGEFAIL:
      //Serial.println("Imaging error");
      return -2;
    default:
      //Serial.println("Unknown error");
      return -2;
  }
  // OK success!
  p = finger.image2Tz();
  switch (p) {
    case FINGERPRINT_OK:
      //Serial.println("Image converted");
      break;
    case FINGERPRINT_IMAGEMESS:
      //Serial.println("Image too messy");
      return -1;
    case FINGERPRINT_PACKETRECIEVEERR:
      //Serial.println("Communication error");
      return -2;
    case FINGERPRINT_FEATUREFAIL:
      //Serial.println("Could not find fingerprint features");
      return -2;
    case FINGERPRINT_INVALIDIMAGE:
      //Serial.println("Could not find fingerprint features");
      return -2;
    default:
      //Serial.println("Unknown error");
      return -2;
  }
  // OK converted!
  p = finger.fingerFastSearch();
  if (p == FINGERPRINT_OK) {
    //Serial.println("Found a print match!");
  } else if (p == FINGERPRINT_PACKETRECIEVEERR) {
    //Serial.println("Communication error");
    return -2;
  } else if (p == FINGERPRINT_NOTFOUND) {
    //Serial.println("Did not find a match");
    return -1;
  } else {
    //Serial.println("Unknown error");
    return -2;
  }   
  // found a match!
  //Serial.print("Found ID #"); Serial.print(finger.fingerID); 
  //Serial.print(" with confidence of "); Serial.println(finger.confidence); 

  return finger.fingerID;
}
void ChecktoAddID(){
  WiFiClientSecure client;
  HTTPClient http;
  Serial.print("[HTTP] begin...\n");
  // configure traged server and url
  postData = "Get_Fingerid=get_id";
  client.setFingerprint(fingerprint);
  http.begin(client, "https://" SERVER_IP);  // HTTP
  http.addHeader("Content-Type", "application/x-www-form-urlencoded");

  Serial.print("[HTTP] POST...\n");
  // start connection and send HTTP header and body
  int httpCode = http.POST(postData);

  // httpCode will be negative on error
  if (httpCode > 0) {
    // HTTP header has been send and Server response header has been handled

    // file found at server
    if (httpCode == HTTP_CODE_OK) {
      const String& payload = http.getString();
      if (payload.substring(0, 6) == "add-id") {
          String add_id = payload.substring(6);
          Serial.println(add_id);
          id = add_id.toInt();
          getFingerprintEnroll();
          Serial.println("*******************************************\n");
          Serial.println("received ChecktoAddID httpcode:\n");
          Serial.println(httpCode);
          Serial.println("received ChecktoAddID payload:\n");
          Serial.println(payload);
          Serial.println("*******************************************\n");
          Serial.println("\n");
        }
    }
  } else {
    Serial.printf("Cheking for new id on website", httpCode);
  }

  http.end();
}
uint8_t getFingerprintEnroll() {

  int p = -1;
  Serial.print("Waiting for valid finger to enroll as #"); Serial.println(id);
  while (p != FINGERPRINT_OK) {
    p = finger.getImage();
    switch (p) {
    case FINGERPRINT_OK:
      Serial.println("Image taken");
      break;
    case FINGERPRINT_NOFINGER:
      Serial.println(".");
       delay(5000);
      break;
    case FINGERPRINT_PACKETRECIEVEERR:
      Serial.println("Communication error");
       delay(2000);
      break;
    case FINGERPRINT_IMAGEFAIL:
      Serial.println("Imaging error");
      break;
    default:
      Serial.println("Unknown error");
      break;
    }
  }

  // OK success!

  p = finger.image2Tz(1);
  switch (p) {
    case FINGERPRINT_OK:
      Serial.println("Image converted");
      break;
    case FINGERPRINT_IMAGEMESS:
      Serial.println("Image too messy");
      return p;
    case FINGERPRINT_PACKETRECIEVEERR:
      Serial.println("Communication error");
      return p;
    case FINGERPRINT_FEATUREFAIL:
      Serial.println("Could not find fingerprint features");
      return p;
    case FINGERPRINT_INVALIDIMAGE:
      Serial.println("Could not find fingerprint features");
      return p;
    default:
      Serial.println("Unknown error");
      return p;
  }

  Serial.println("Remove finger");
  delay(2000);
  p = 0;
  while (p != FINGERPRINT_NOFINGER) {
    p = finger.getImage();
  }
  Serial.print("ID "); Serial.println(id);
  p = -1;
  Serial.println("Place same finger again");
  while (p != FINGERPRINT_OK) {
    p = finger.getImage();
    switch (p) {
    case FINGERPRINT_OK:
      Serial.println("Image taken");
      break;
    case FINGERPRINT_NOFINGER:
      Serial.print(".");
        delay(5000);
      break;
    case FINGERPRINT_PACKETRECIEVEERR:
      Serial.println("Communication error");
      delay(2000);
      break;
    case FINGERPRINT_IMAGEFAIL:
      Serial.println("Imaging error");
      break;
    default:
      Serial.println("Unknown error");
      break;
    }
  }

  // OK success!

  p = finger.image2Tz(2);
  switch (p) {
    case FINGERPRINT_OK:
      Serial.println("Image converted");
      break;
    case FINGERPRINT_IMAGEMESS:
      Serial.println("Image too messy");
      return p;
    case FINGERPRINT_PACKETRECIEVEERR:
      Serial.println("Communication error");
      delay(2000);
      return p;
    case FINGERPRINT_FEATUREFAIL:
      Serial.println("Could not find fingerprint features");
      return p;
    case FINGERPRINT_INVALIDIMAGE:
      Serial.println("Could not find fingerprint features");
      return p;
    default:
      Serial.println("Unknown error");
      return p;
  }

  // OK converted!
  Serial.print("Creating model for #");  Serial.println(id);

  p = finger.createModel();
  if (p == FINGERPRINT_OK) {
    Serial.println("Prints matched!");
  } else if (p == FINGERPRINT_PACKETRECIEVEERR) {
    Serial.println("Communication error");
    delay(2000);
    return p;
  } else if (p == FINGERPRINT_ENROLLMISMATCH) {
    Serial.println("Fingerprints did not match");
    return p;
  } else {
    Serial.println("Unknown error");
    return p;
  }

  Serial.print("ID "); Serial.println(id);
  p = finger.storeModel(id);
  if (p == FINGERPRINT_OK) {
    Serial.println("Stored!");
    confirmAdding();
  } else if (p == FINGERPRINT_PACKETRECIEVEERR) {
    Serial.println("Communication error");
    delay(2000);
    return p;
  } else if (p == FINGERPRINT_BADLOCATION) {
    Serial.println("Could not store in that location");
    return p;
  } else if (p == FINGERPRINT_FLASHERR) {
    Serial.println("Error writing to flash");
    return p;
  } else {
    Serial.println("Unknown error");
    return p;
  }

  return p;
}
void confirmAdding(){
  WiFiClientSecure client;
  HTTPClient http;
  Serial.print("[HTTP] begin...\n");
  // configure traged server and url
  postData = "confirm_id=" + String(id);
  client.setFingerprint(fingerprint);
  http.begin(client, "https://" SERVER_IP);  // HTTP
  http.addHeader("Content-Type", "application/x-www-form-urlencoded");
  http.addHeader("Access-Control-Request-Method", "GET");

  Serial.print("[HTTP] POST...\n");
  // start connection and send HTTP header and body
  int httpCode = http.POST(postData);
  // httpCode will be negative on error
  // HTTP header has been send and Server response header has been handled
  // file found at server
  String payload = http.getString();
  Serial.println("*******************************************\n");
  Serial.println("received confirmAdding httpcode:\n");
  Serial.println(httpCode);
  Serial.println("received confirmAdding payload:\n");
  Serial.println(payload);
  Serial.println("*******************************************\n");
  Serial.println("\n");

  http.end();
}
void connectToWiFi(){
  WiFi.begin(STASSID, STAPSK);

  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("");
  Serial.print("Connected! IP address: ");
  Serial.println(WiFi.localIP());
}