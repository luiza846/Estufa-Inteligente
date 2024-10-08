#include "DHT.h"

// Definições dos pinos e variáveis
#define DHTPIN 7
#define DHTTYPE DHT11
#define SENSOR_UMID A0
#define LAMP 4
#define VALVULA 9
#define VENT 5

const int Sensor_NV_Agua

DHT dht(DHTPIN, DHTTYPE);

float umid_Ideal = 0;
float tempe_Ideal = 0;

void setup() {
  Serial.begin(9600);
  dht.begin();
  
  pinMode(SENSOR_UMID, INPUT);
  pinMode(LAMP, OUTPUT);
  pinMode(VALVULA, OUTPUT);
  pinMode(VENT, OUTPUT);
  pinMode(Sensor_NV_Agua, INPUT);   
  
  // Inicializa a lâmpada desligada
  digitalWrite(LAMP, LOW);
}

void loop() {
  // Recebe e processa dados da serial
  ReceberDados();
  
  // Controle baseado nos dados recebidos
  Controle();
  
  // Controle da lâmpada
  ControleLampada();
  
  delay(2000); // Aguarda 2 segundos antes da próxima iteração
}

void ReceberDados() {
  while (Serial.available()) {
    String dados = Serial.readStringUntil('\n');
    
    if (dados.startsWith("UmidadeIdeal:")) {
      umid_Ideal = dados.substring(13).toFloat(); // Ajusta o índice para o início do valor
    } 
    else if (dados.startsWith("TempIdeal:")) {
      tempe_Ideal = dados.substring(10).toFloat(); // Ajusta o índice para o início do valor
    }
  }
  
  // Imprime os valores recebidos para verificação
  if (umid_Ideal != 0 || tempe_Ideal != 0) {
    Serial.print("Umidade Ideal: ");
    Serial.println(umid_Ideal);
    Serial.print("Temperatura Ideal: ");
    Serial.println(tempe_Ideal);
  }
}

void Controle() {
  float nv_Umidade = analogRead(SENSOR_UMID);
  float Umidade_Atual = map(nv_Umidade, 0, 1023, 0, 100);
  float tempe_Atual = dht.readTemperature();

  // Envia os níveis atuais de umidade e temperatura para a porta serial
  Serial.print("Temperatura Atual: ");
  Serial.print(tempe_Atual);
  Serial.print(", Umidade Atual: ");
  Serial.println(Umidade_Atual);

  // Controle da válvula
  if (Umidade_Atual < umid_Ideal) {
    digitalWrite(VALVULA, HIGH);
  } else {
    digitalWrite(VALVULA, LOW);
  }
  
  // Controle da ventoinha
  if (tempe_Atual > tempe_Ideal) {
    digitalWrite(VENT, LOW);
  } else {
    digitalWrite(VENT, HIGH);
  }
}

void ControleLampada() {
  digitalWrite(LAMP, HIGH);
  delay(12 * 60 * 60 * 1000); // Liga a lâmpada por 12 horas
  digitalWrite(LAMP, LOW);
}
