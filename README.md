Todas as rotas foram testadas no Postaman, não consegui fazer o login, a rota de login, e o controller estão feitos, mas por algum motivo ele não está fazendo a comparação dos dados de forma correta, por isso todas as rotas estão acessíveis sem o login.

Rotas

login (Post localhost:8000/api/loin)
    Esta rota até esta funcionando mas não do jeito certo, ele pega os dados mas sempre retoran a mensagem de usuario ou senha incorreta.

signup (Post localhost:8000/api/signup)
    Dados que devem entrar: name, email e password.

storeClientes (Post localhost:8000/api/storeClientes)
    Tive a ideia de cadastrar o celular e um endereço que vão para suas respectivas tabelas no banco, estes quardaram o id do cliente.
    Dados que devem entrar: (cliente) nome, cpf e password,
    (endereco) estado, cidade, bairro, rua, numero e cep, (telefone) numeroTelefone (na tabela telefone o numero entra na coluna numero, na entrada ficou numeroTelefone pois há o numero que seria o numero da tabela endereco).

indexClientes (Get localhost:8000/api/indexClientes)
    Esta rota retorna só dados "importantes" e está ordenado por id.

showClientes (Put localhost:8000/api/showClientes/1)
    Com esta rota deve ser passado um id como parâmetro , ela retornará todos os dados de um cliente e suas vendas, tambem a possibilidade de filtrar por mes e ano de uma venda ou os dois, esta rota foi feita com push para a entrada de mes e ano.

updateClientes (Put localhost:8000/api/updateClientes/1)
    Esta rota, junto com um parâmetro serve para alterar clientes passando os campos que serão atualizados.

DestoyClientes (Delete localhost:8000/api/destroyClientes/1)
    Esta rota junto com um id de um cliente como parametro apaga por completo um cliente, tambem o telefone e o endereço associado a ele.

storeProdutos (Post localhost:8000/api/storeProdutos)
    Esta rota serve para cadastrar produtos.
    Dados que devem entrar: tipo, nome e preco.

indexProdutos (Get localhost:8000/api/indexProdutos)
    Esta rota retorna só dados "importantes" e está ordenado por ordem alfabetica.

showProdutos (Get localhost:8000/api/showProdutos/1)
    Com esta rota deve ser passado um id como parâmetro , ela retornará todos os dados de um produto.

updateProdutos (Put localhost:8000/api/updateProdutos/1)
    Esta rota, junto com um parâmetro serve para alterar produtos passando os campos que serão atualizados.

deleteProdutos (Delete localhost:8000/api/deleteProdutos/1)
    Esta rota , junto com um id de produto como parametro deleta o produto do id(mas não apaga realmente do banco).

storeVendas (Post)
Esta rota serve para cadastrar uma venda de um produto feita por um cliente.