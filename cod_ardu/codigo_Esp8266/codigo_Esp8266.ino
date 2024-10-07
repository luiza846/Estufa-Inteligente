#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>

const char* ssid = "Miguel";         // Substitua pelo nome da sua rede Wi-Fi
const char* password = "Hunter231020$";    // Substitua pela senha da sua rede Wi-Fi

const char* serverName = "http://labtg1.com.br/GreenCode/estufa/conexao_node.php"; // URL do script PHP

void setup() {
  Serial.begin(115200);  // Usar Serial para comunicação com o Arduino Mega

  WiFi.begin(ssid, password);
}

void loop() {
  if (WiFi.status() == WL_CONNECTED) {
    WiFiClient client;
    HTTPClient http;

    http.begin(client, serverName); // Use WiFiClient com a URL

    int httpCode = http.GET();   // Envia uma solicitação GET

    if (httpCode > 0) {
      String payload = http.getString();
      Serial.println(payload);  // Imprime os dados na porta serial
    } else {
      Serial.println("Erro ao fazer a solicitação");
    }

  } else {
    Serial.println("Não conectado ao Wi-Fi");
  }

  delay(2000); // Espera 2 segundos antes de fazer outra solicitação
}
