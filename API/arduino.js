const express = require('express');
const { SerialPort } = require('serialport');
const mysql = require('mysql');
//or
const { ReadlineParser } = require('@serialport/parser-readline');
const app = express();

// Configuração da porta serial para se comunicar com o Arduino
const port = new SerialPort({path:'/dev/ttyACM0', baudRate: 9600 });
const parser = port.pipe(new ReadlineParser({delimiter: '\r\n'}));


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
app.get('/SalvarDados', (req, res) => { // Precisa ficar em loop para enviar ao banco toda vez que tiver uma acao realizada

    parser.on('data', function(data) {
      const dados = data;

      const time = Date().toString();

      console.log(dados);

      db.query("UPDATE registro SET dados = ?, data = ? WHERE id_registro = ?", [dados, time, 1], (err, results) => {
        if(err){
          console.log("ERRO AO SALVAR OS DADOS: " + err);
        }
        else{
          console.log("DADOS INSERIDOS COM SUCESSO");
        }
      })
    });

});

app.get('/ReceberDados', (req, res) => {
  // Execute uma consulta SQL para obter nivel_de_umidade onde 'id' = 1
  const query = 'SELECT nv_umid, nv_temp FROM planta WHERE id =?';

  var id_usuario = 1;


  db.query(query, [id_usuario], (err, results) => {

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

app.listen(3000, () => {
  console.log('API Node.js rodando na porta 3000');
});
