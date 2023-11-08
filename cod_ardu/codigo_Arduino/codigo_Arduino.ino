//Sensor de Temperatura DHT11
#include "DHT.h"
 
//Variaveis de recebimento de dados da Porta Serial
static String umid_Recebida;
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
int valvula =  9;
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
  delay(30000);
}
 
void ReceberDados(){

 
    while (Serial.available()) {
    String dados = Serial.readStringUntil('\n');
 
    if (dados.startsWith("UmidadeIdeal:")) {
      umid_Recebida = dados.substring(13);
        umid_Ideal = umid_Recebida.toFloat();
 
    }
 
       if (dados.startsWith("TempIdeal:")) {
      temp_Recebido = dados.substring(10);
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
  float nv_Umidade = analogRead(sensor_Umid);
  float Umidade_Atual = map(nv_Umidade, 0, 1023, 0, 100);

 float tempe_Atual = dht.readTemperature();
  
  // Definicao do estado dos componentes
  static int estadoVal;
  static int estadoVent;

  //Controle da Valvula
  if(Umidade_Atual < umid_Ideal && tempe_Atual <= tempe_Ideal){
    estadoVal = 1;
    digitalWrite(valvula, HIGH);
    Serial.print("Humidade:");
    Serial.print(Umidade_Atual);
    Serial.print("||||");
    Serial.print("Temperatura:");
    Serial.print(tempe_Atual);
    Serial.print("||||");
    Serial.print("Acao:");
    Serial.println("IRRIGACAO");

  }
 
  if(Umidade_Atual >= umid_Ideal){
    estadoVal = 0;
    digitalWrite(valvula, LOW);
 
  }
 
  //Controle da Ventuinha
  if(tempe_Atual > tempe_Ideal && Umidade_Atual >= umid_Ideal){
    estadoVent = 1;
    digitalWrite(vent, HIGH);
        Serial.print("Humidade:");
    Serial.print(Umidade_Atual);
    Serial.print("||||");
    Serial.print("Temperatura:");
    Serial.print(tempe_Atual);
    Serial.print("||||");
    Serial.print("Acao:");
    Serial.println("VENTILACAO");

    
  }
 
  if(tempe_Atual <= tempe_Ideal){
    estadoVent = 0;
    digitalWrite(vent, LOW);
  }

  //Controle da valvula e da Ventuinha

   if(Umidade_Atual < umid_Ideal && tempe_Atual > tempe_Ideal){
    estadoVal = 1;
    digitalWrite(valvula, HIGH);
    Serial.print("Humidade:");
    Serial.print(Umidade_Atual);
    Serial.print("||||");
    Serial.print("Temperatura:");
    Serial.print(tempe_Atual);
    Serial.print("||||");
    Serial.print("Acao:");
    Serial.println("IRRIGACAO && VENTILACAO");

  }

delay(5000);
      
 
}