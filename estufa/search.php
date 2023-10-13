<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<input id="searchebar" type="text" name="searchbar" placeholder=" Pesquisar palavra-chave" onkeyup="search()" />

<ul>
    <li class="conteudo">AGATHA</li>
    <li class="conteudo">JOHN</li>
    <li class="conteudo">ALICE</li>
    <li class="conteudo">NOAH</li>
    <li class="conteudo">PETER</li>
</ul>
                <script>
                    function search(){
                        function search_animal() {
                        let input = document.getElementById('searchbar').value
                        input=input.toLowerCase();
                        let x = document.getElementsByClassName('conteudo');
                        
                        for (i = 0; i < x.length; i++) { 
                            if (!x[i].innerHTML.toLowerCase().includes(input)) {
                                x[i].style.display="none";
                            }
                            else {
                                x[i].style.display="list-item";                 
                            }
                        }
                    }
                }
                </script>
</body>
</html>