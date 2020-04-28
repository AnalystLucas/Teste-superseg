<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>API TESTE</title>
</head>
<body>
    <div class="container text-center">
        <div class="titulo" style="background-color: red;">
            <h1>ESTOQUE</h1>
        </div>
        
        <table class="table table-sm table-responsive" >
            <thead>
                <tr>
                    <th width="20%" >Imagem</th>
                    <th >Nome</th>
                    <th >Codigo</th>
                    <th >Quantidade</th>
                    <th >Preço</th>
                </tr>    
                    
            </thead>

            <tbody id="tabela-produtos">
            </tbody>

        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.0.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>
    
    <script> 
    
    
        $.ajax({
            url: 'https://touchpay-api.amlabs.com.br/api/public/MicroMarket/1/Inventory',
            type: 'GET',
            // dataType: 'json',
            beforeSend: function(api_header){
                api_header.setRequestHeader('Authorization', "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIzIiwianRpIjoiMTg5YTFiMDgtYWVjMi00OGUzLWIxZjItMjE2NjMzMGE4M2RkIiwiaHR0cDovL3NjaGVtYXMubWljcm9zb2Z0LmNvbS93cy8yMDA4LzA2L2lkZW50aXR5L2NsYWltcy9yb2xlIjoiUHVibGljIEFQSSIsImV4cCI6MTg5MzQ2NjgwMCwiaXNzIjoiTWVyY3VyaW8iLCJhdWQiOiIyNjgifQ.nOYlTCgeXX18kwje7aRkuISd7qBXhOBr0YB0h3SHr3g");
            },
            success: function(resposta){
                var dados = Object.values(resposta);
                var dadostable = "";
                var aux = null;
                var teste = null;

                dados.forEach( (element, key)  => {
                    let preco = element.price; 
                    let converter = preco.toString();
                    aux = converter.split(".");


                    if(aux[1].length < 2){
                       teste = aux[0]+"."+aux[1]+"0";
                       preco = teste;
                    }else if(aux[1] >= 2){
                        preco = converter.replace(".",",");
                    } 



                    dadostable += 
                    `<tr>
                    
                        <td align="center"> <img src="${element.imageUrl}" width="45%"</td>
                        <td align="center">${element.description}</td>
                        <td align="center">${element.code}</td>
                        <td align="center">${element.quantity}</td>
                        <td align="center">R$ ${preco.replace(".",",")}</td>
                    
                    </tr>`;
                });

                $("#tabela-produtos").html(dadostable);         
            },
            error: function(){
                alert("Erro não foi possivel conectar com a API !");
            }

        })
    
    </script>
</body>
</html>