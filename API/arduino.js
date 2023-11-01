const express = require('express');
const { SerialPort } = require('serialport');
const mysql = require('mysql');

const app = express();

// Configuração da porta serial para se comunicar com o Arduino
const port = new SerialPort({path:'/dev/ttyACM0', baudRate: 9600 });

// Configuração do banco de dados MySQL
const db = mysql.createConnection({
  host: 'localhost',
  user: 'root',
  password: '',
  database: 'estufa_inteligente',
});

db.connect((err) => {
  if (err) {
    console.error('Erro ao conectar ao banco de dados: ' + err);
  } else {
    console.log('Conectado ao banco de dados');
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
