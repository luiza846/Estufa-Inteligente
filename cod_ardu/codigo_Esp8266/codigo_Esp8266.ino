#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>

const char* ssid = "Miguel";         // Substitua pelo nome da sua rede Wi-Fi
const char* password = "Hunter231020$";    // Substitua pela senha da sua rede Wi-Fi

const char* parametros = "http://labtg1.com.br/GreenCode/estufa/conexao_node.php"; // URL do script PHP
const char* enviar = "http://labtg1.com.br/GreenCode/estufa/monitora_estufa.php"; // URL do script PHP


float temperaturaAtual = 0.0;
float umidadeAtual = 0.0;

void setup() {
  Serial.begin(115200);  // Usar Serial para comunicação com o Arduino Mega

  WiFi.begin(ssid, password);
}

void loop() {

  ReceberDadosArduino();

  if (WiFi.status() == WL_CONNECTED) {
    WiFiClient client;
    HTTPClient http;

    http.begin(client, parametros); // Use WiFiClient com a URL

    int httpCode = http.GET();   // Envia uma solicitação GET

    if (httpCode > 0) {
      String payload = http.getString();
      Serial.println(payload);  // Imprime os dados na porta serial
    } else {
      Serial.println("Erro ao fazer a solicitação");
    }
    
    http.end();

 // Enviar dados da temperatura e umidade atuais para o segundo script
    http.begin(client, enviar);
    http.addHeader("Content-Type", "application/x-www-form-urlencoded");
    String postData = "temperatura=" + String(temperaturaAtual) + "&umidade=" + String(umidadeAtual);
    
    int httpResponseCode = http.POST(postData);

    if (httpResponseCode > 0) {
      String response = http.getString();
      Serial.println("Resposta do servidor: " + response);
    } else {
      Serial.println("Erro ao enviar dados de temperatura e umidade");
    }

    http.end();

  } else {
    Serial.println("Não conectado ao Wi-Fi");
  }

  delay(2000); // Espera 2 segundos antes de fazer outra solicitação
}

void ReceberDadosArduino() {
  while (Serial.available()) {
    String dados = Serial.readStringUntil('\n');

    if (dados.startsWith("temperatura: ")) {
      temperaturaAtual = dados.substring(12).toFloat();
    } else if (dados.startsWith("umidade: ")) {
      umidadeAtual = dados.substring(8).toFloat();
    }
  }

  Serial.print("Temperatura Atual: ");
  Serial.println(temperaturaAtual);
  Serial.print("Umidade Atual: ");
  Serial.println(umidadeAtual);
}
  
