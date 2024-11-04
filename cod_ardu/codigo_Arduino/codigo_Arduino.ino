#include "DHT.h"

// Variáveis de recebimento de dados da Porta Serial
static String umid_Recebida = "";
static float umid_Ideal = 0.0;

static String temp_Recebido = "";
static float tempe_Ideal = 0.0;

// Sensor de UMIDADE
int sensor_Umid = A0;

// Sensor de Temperatura
#define DHTPIN 7
#define DHTTYPE DHT11
DHT dht(DHTPIN, DHTTYPE);

int lamp = 4;
int valvula = 9;
int vent = 5;
int boia = 2;

void setup() {
  Serial.begin(115200);
  Serial3.begin(115200);


  pinMode(boia, INPUT);
  pinMode(sensor_Umid, INPUT);
  pinMode(lamp, OUTPUT);
  pinMode(valvula, OUTPUT);
  pinMode(vent, OUTPUT);
  dht.begin();

  digitalWrite(lamp, HIGH);

  while (!Serial) {
    ; // Aguardar pela conexão
  }
}

void loop() {
  ReceberDados();
  Controle();
  ControleLampada();
}

void ReceberDados() {
  while (Serial3.available()) {
    String dados = Serial3.readStringUntil('\n');

    if (dados.startsWith("umidade: ")) {
      umid_Recebida = dados.substring(8);
      umid_Ideal = umid_Recebida.toFloat();
    }

    if (dados.startsWith("temperatura: ")) {
      temp_Recebido = dados.substring(12);
      tempe_Ideal = temp_Recebido.toFloat();
    }
  }

  if (umid_Recebida != "" && temp_Recebido != "") {
    Serial.print("Umidade Ideal Recebida: ");
    Serial.println(umid_Ideal);
    Serial.print("Temperatura Ideal Recebida: ");
    Serial.println(tempe_Ideal);
    umid_Recebida = "";
    temp_Recebido = "";
  } else {
    Serial.println("Dados recebidos inválidos ou incompletos.");
  }
}

void Controle() {
  // Variáveis Medidoras
  float nv_Umidade = analogRead(sensor_Umid);
  float Umidade_Atual = map(nv_Umidade, 0, 1023, 0, 100);
  float tempe_Atual = dht.readTemperature();

  int Nivel_Agua = digitalRead(boia);

    Serial.print("Temperatura Atual: ");
    Serial.print(tempe_Atual);
    Serial.print(", Umidade Atual: ");
    Serial.println(Umidade_Atual);


  Serial.println("==============");
  Serial.print("Temperatura Recebida: ");
  Serial.print(temp_Recebido);
  Serial.print(", Umidade Recebida: ");
  Serial.println(umid_Recebida);

  if (Nivel_Agua == HIGH){
    Serial.println("Baixo/Vazio");
  }

  else{
    Serial.println("OK");
  }

  EnviarDadosParaESP(Umidade_Atual, tempe_Atual);

  // Controle da Válvula
  if (Umidade_Atual < umid_Ideal) {
    digitalWrite(valvula, HIGH);
  } else {
    digitalWrite(valvula, LOW);
  }

  // Controle da Ventoinha
  if (tempe_Atual > tempe_Ideal) {
    digitalWrite(vent, LOW);
  } else {
    digitalWrite(vent, HIGH);
  }

  delay(2000); // Espera 2 segundos antes de fazer outra leitura
}

void EnviarDadosParaESP(float umidade, float temperatura) {
  Serial3.print("UmidadeAtual: ");
  Serial3.println(umidade);
  Serial3.print("TemperaturaAtual: ");
  Serial3.println(temperatura);
}


void ControleLampada() {
  static unsigned long lastLampChange = 0;
  unsigned long currentMillis = millis();

  if (currentMillis - lastLampChange >= 12 * 60 * 60 * 1000) { // 12 horas
    if (digitalRead(lamp) == HIGH) {
      digitalWrite(lamp, LOW);
    } else {
      digitalWrite(lamp, HIGH);
    }
    lastLampChange = currentMillis;
  }
}