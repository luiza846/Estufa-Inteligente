const express = require('express');
const { SerialPort } = require('serialport');
const mysql = require('mysql');
//or
const { ReadlineParser } = require('@serialport/parser-readline');
const app = express();

// Configuração da porta serial para se comunicar com o Arduino
const port = new SerialPort({path:'/dev/ttyACM0', baudRate: 9600 });
const parser = port.pipe(new ReadlineParser({delimiter: '\r\n'}));


// Configurando arquivo .txt
const fs = require('fs');
const { time } = require('console');

const arquivo = 'dados.txt';
const stream = fs.createWriteStream(arquivo, {flags: 'a'});



// Configuração do banco de dados MySQL
const db = mysql.createConnection({
  host: 'localhost',
  user: 'root',
  password: '',
  database: 'lab',
});

db.connect((err) => {
  if (err) {
    console.error('Erro ao conectar ao banco de dados: ' + err);
  } else {
    console.log('Conectado ao banco de dados');
  }
});


// Comandos API
function EnviarParaArduino(){
app.post('/EnviarDados', (req, res) => {
  // Execute uma consulta SQL para obter nivel_de_umidade onde 'id' = 1
  const query = 'SELECT umidade_ideal, temperatura_ideal FROM planta WHERE id_planta = ?';

  const id_planta = opcaoSelecionada;

  db.query(query, [id_planta], (err, results) => {

    if (err) {
      console.error('Erro ao consultar o banco de dados: ' + err);
      res.status(500).send('Erro ao consultar o banco de dados');
    } else if (results.length > 0) {

      const UmidadeIdeal = results[0].nv_umid;
      const TempIdeal = results[0].nv_temp;



      // Envie 'nome' e 'nivel_de_umidade' para o Arduino pela porta serial
      port.write(`UmidadeIdeal:${UmidadeIdeal}\n`);
      port.write(`TempIdeal:${TempIdeal}\n`);


      console.log(`UmidadeIdeal: ${UmidadeIdeal}\n`);
      console.log(`TempIdeal: ${TempIdeal}\n`);
     

      res.status(200).send('Dados enviados com sucesso para o Arduino');
    } else {
      console.error('Nenhum dado encontrado na tabela');
      res.status(404).send('Nenhum dado encontrado na tabela');
    }
  });
});
}

function Monitorar(){
app.get(`/ReceberDados`, (req, res) => {
  parser.on('data', (data) => {

    const [temp, humid] = data.split(',');

    Salvardados(temp, humid);
    
  });
});
}

// Funcao para salvar dados no arquivo txt

function Salvardados(temp, humid){

  const timestamp = new Date();
  const ano = timestamp.getFullYear();
  const mes = timestamp.getMonth();
  const dia = timestamp.getDay();
  const hora = timestamp.getHours();
  const minutos = timestamp.getMinutes();
  const segundos = timestamp.getSeconds();

  const dados = `${ano}/${mes}/${dia} ${hora}:${minutos}:${segundos} ${temp} ${humid} \n`;

  stream.write(dados, (err) => {

    if(err){
      console.error('ERRO AO SALVAR DADOS: ' + err);
    }
    else{
      console.log("DADOS SALVOS");
    }
  
  });
 
}

// Chamando as funcoes

document.getElementById("btn_cadastrar").addEventListener("click", EnviarParaArduino);

document.getElementById("btn_monitorar").addEventListener("click", Monitorar);

app.listen(3000, () => {
  console.log('API Node.js rodando na porta 3000');
});
