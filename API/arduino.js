const express = require('express');
const { SerialPort } = require('serialport');
//or
const { ReadlineParser } = require('@serialport/parser-readline');
const mysql = require('mysql');

const app = express();

// Configuração da porta serial para se comunicar com o Arduino
const port = new SerialPort({path:'/dev/ttyACM0', baudRate: 9600 });

const parser = port.pipe(new ReadlineParser({ delimiter: '\r\n' }))

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

//Funcoes para enviar a temperatura e a Umidade para o Banco de dados
function InserirTemp(temperatura) {
  const tempData = {
    temperatura: temperatura,
    timestamp: new Date(),
  };

  db.query('INSERT INTO registro(temperatura) VALUES(?)', tempData, (err, results) => {
    if(err){
      console.log("ERRO AO ENVIAR A TEMPERATURA");
    }
    else{
      console.log("TEMPERATURA SALVA COM SUCESSO");
    }
  });
};

function InserirUmid(umidade) {
  const umidadeData = {
    umidade: umidade,
    timestamp: Date(),
  };

  db.query('INSERT INTO resgistro(umidade) VALUES(?)', umidadeData, (err, results) => {
    if(err){
      console.log("ERRO AO ENVIAR A UMIDADE");
    }
    else{
      console.log("UMIDADE SALVA COM SUCESSO");
    }
  });
}

parser.on('data', (data) => {
  const [temperatura, umidade] = data.split(',').map(parseFloat);

  if(!isNaN(temperatura) && !isNaN(umidade)){
    InserirTemp(temperatura);
    InserirUmid(umidade);
  }
});


// Rota para obter 'nome' e 'nivel_de_umidade' onde 'id' = 1 e enviar para o Arduino
app.get('/obterDados', (req, res) => {
  // Execute uma consulta SQL para obter 'nome' e 'nivel_de_umidade' onde 'id' = 1
  const query = 'SELECT umidade FROM planta WHERE id_usuario =?';

  var id_usuario = 1;


  db.query(query, [id_usuario], (err, results) => {
    if (err) {
      console.error('Erro ao consultar o banco de dados: ' + err);
      res.status(500).send('Erro ao consultar o banco de dados');
    } else if (results.length > 0) {

      const UmidadeIdeal = results[0].umidade;


      // Envie 'nome' e 'nivel_de_umidade' para o Arduino pela porta serial
      port.write(`UmidadeIdeal:${UmidadeIdeal}\n`);


      console.log(`UmidadeIdeal: ${UmidadeIdeal}`);
     

      res.status(200).send('Dados enviados com sucesso para o Arduino');
    } else {
      console.error('Nenhum dado encontrado na tabela');
      res.status(404).send('Nenhum dado encontrado na tabela');
    }
  });
});

app.listen(3000, () => {
  console.log('API Node.js rodando na porta 3000');
});
