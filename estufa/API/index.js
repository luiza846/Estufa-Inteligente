//Importando e instanciando as bibliotecas
//
//
const { SerialPort } = require('serialport');
const express = require('express');
const req = require('express/lib/request');
const res = require('express/lib/response');
const app = express();

//Definindo a Porta e o BaudRate do Arduino
//
const porta = "/dev/ttyACM0";
const baudrate = 9600;
const arduino = new SerialPort({path:porta, baudRate: baudrate});
//
//Definindo dados que serao enviados e ou recebidos
//
var dados;
//Inicando conexao com o Arduino
//
arduino.on('open', () => {
    console.log("Concexao com Arduino estabelecida");
})

//Criando funcoes
//
//Funcao Enviar os dados do sensor
//
app.post('/enviar', (req,res) => {

    arduino.write(dados, (err) => {
        if(err){
        console.error("Erro ao enviar os dados");
        res.status(500).send("Erro ao enviar dados");
        }
        else{
            console.log("Dados enviados");
        }
    
    })
})

app.post('/salvar', (req,res) => {

    arduino.write(dados, (err) => {
        if(err){
        console.error("Erro ao salvar os dados");
        res.status(500).send("Erro ao salvar dados");
        }
        else{
            console.log("Dados salvos");
        }
    
    })
})

app.get('/verificar', (req, res) => {
    arduino.write(dados, (err) => {
        if(err){
            console.log("Erro ao receber dados");
            res.status(404).send("Erro ao receber dados");
        }
        else{
            console.log("Dado Recebido: ${dados}")
        }
    })
})

