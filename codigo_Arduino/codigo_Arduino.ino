//Sensor de Temperatura DHT11
#include "DHT.h"
 
//Variaveis de recebimento de dados da Porta Serial
String umid_Recebida;
static float umid_Ideal;
 
String temp_Recebido;
static float tempe_Ideal;
 
//Sensor de UMIDADE
int sensor_Umid = A0;
 
//Sensor de Temperatura
#define DHTPIN 7
#define DHTTYPE DHT11
DHT dht(DHTPIN, DHTTYPE);
 
 
int lamp = 4;
int valvula =  6;
int vent = 5;
 
void setup() {
  //Iniciando a porta Serial
  Serial.begin(9600);
 
  //Iniando os Sensores
  pinMode(sensor_Umid, INPUT);
  pinMode(lamp, OUTPUT);
  dht.begin();
 
  //Definindo Componentes
  pinMode(valvula, OUTPUT);
  pinMode(vent, OUTPUT);
  //Ligando a Lampada
  digitalWrite(lamp, HIGH);
 
  while (!Serial) {
    ; // Aguardar pela conexão
  }
}
 
void loop() {
 
  ReceberDados();
  Controle();
 
}
 
void ReceberDados(){

 
    while (Serial.available()) {
    String dados = Serial.readStringUntil('\n');
    Serial.println("Dados recebidos da porta serial: ");
    Serial.println(dados);
 
    if (dados.startsWith("UmidadeIdeal:")) {
      umid_Recebida = dados.substring(13);
        umid_Ideal = umid_Recebida.toFloat();
 
    }
 
       if (dados.startsWith("TempeIdeal:")) {
      temp_Recebido = dados.substring(11);
        tempe_Ideal = temp_Recebido.toFloat();
 
    }
  }
  if(umid_Recebida != "" && temp_Recebido != ""){
    Serial.println(umid_Ideal);
    Serial.println(tempe_Ideal);
    umid_Recebida = "";
    temp_Recebido = "";
  }

 
}
 
void Controle(){
  //Variaveis Medidoras
static  float nv_Umidade = analogRead(sensor_Umid);
static  float Umidade_Atual = map(nv_Umidade, 0, 1023, 0, 100);
 
//Controle de estado dos componentes
static char estadoVal = "LOW";
 
static char estadoVent = "LOW";
 
static float tempe_Atual = dht.readTemperature();
  //Controle da Valvula
  if(Umidade_Atual < umid_Ideal){
    estadoVal = "HIGH";
    digitalWrite(valvula, estadoVal);
  }
 
  if(Umidade_Atual >= umid_Ideal){
    estadoVal = "LOW";
    digitalWrite(valvula, estadoVal);
  }
 
  //Controle da Ventuinha
  if(tempe_Atual > tempe_Ideal){
    estadoVent = "HIGH";
    digitalWrite(vent, estadoVent);
  }
 
  if(tempe_Atual <= tempe_Ideal){
    estadoVent = "LOW";
    digitalWrite(vent, estadoVent);
  }
 
  if(estadoVal == "HIGH" || estadoVent == "HIGH"){
    Serial.print(tempe_Atual);
    Serial.print(",");
    Serial.print(Umidade_Atual);
  }
 
      delay(5000);
 
}