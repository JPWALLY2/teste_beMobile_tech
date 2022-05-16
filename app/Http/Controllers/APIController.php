<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Cliente;
use App\Produto;
use App\Venda;
use App\Telefone;
use App\Endereco;

class APIController extends Controller
{
    public function store_users (Request $request){
        // obtém todos os campos
        $dados = $request->all();
        // cria o usuario
        $criado = User::create($dados);

        // verifica se foi criado e printa uma menssagem de sucesso
        if ($criado){
            print("Usuário ". $request->name ." cadastrado com sucesso!");
        // se não foi criado, printa uma mensagem de erro no cadastro
        } else{
            print("Erro ao cadastrar o usuário");
        }
    }


    // CLIENTES
    public function store_clientes (Request $request){
        // obtém todos os campos
        $cliente = new Cliente();
        $cliente->nome = $request->nome;
        $cliente->cpf = $request->cpf;
        // cria o cliente
        $criadoC = $cliente->save();

         // endereço
        $endereco = new Endereco();
        $endereco->cliente_id = $cliente->id;
        $endereco->estado = $request->estado;
        $endereco->cidade = $request->cidade;
        $endereco->rua = $request->rua;
        $endereco->bairro = $request->bairro;
        $endereco->cep = $request->cep;
        $endereco->numero = $request->numero;
        $criadoE = $endereco->save();

        $telefone = new Telefone();
        $telefone->numero= $request->numeroTelefone;
        $telefone->cliente_id = $cliente->id;
        $criadoT = $telefone->save();

        // verifica se foi criado e printa uma menssagem de sucesso
        if ($criadoC && $criadoE && $criadoT){
            print("Cliente ". $request->nome ." cadastrado com sucesso!");
        // se não foi criado, printa uma mensagem de erro no cadastro
        } else{
            print("Erro ao cadastrar o cliente");
        }
    }

    public function update_clientes (Request $request, $id){
        // verifica se o cliente existe
        if(Cliente::where('id', $id)->exists()){
            // pega o cliente com este id
            $cliente = Cliente::find($id);
            // pega o telefone do cliente com este id
            $telefone = Telefone::where('cliente_id', $id)->first();
            // pega o cliente com este id
            $endereco = Endereco::where('cliente_id', $id)->first();
            // ele verifica se os campos nome e cpf são nulos
            // se um deles for nulo ele substitui a solicitação pelo valor já existente
            // se não for nulo ele passa como novo valor
            $cliente->nome = is_null($request->nome) ? $cliente->nome : $request->nome;
            $cliente->cpf = is_null($request->cpf) ? $cliente->cpf : $request->cpf;
            // telefone
            $telefone->numero = is_null($request->numeroTelefone) ? $telefone->numero : $request->numeroTelefone;
            //endereço
            $endereco->estado = is_null($request->estado) ? $endereco->estado : $request->estado;
            $endereco->cidade = is_null($request->cidade) ? $endereco->cidade : $request->cidade;
            $endereco->rua = is_null($request->rua) ? $endereco->rua : $request->rua;
            $endereco->bairro = is_null($request->bairro) ? $endereco->bairro : $request->bairro;
            $endereco->numero = is_null($request->numero) ? $endereco->numero : $request->numero;
            $endereco->cep = is_null($request->cep) ? $endereco->cep : $request->cep;
            // salva as alterações do cliente
            $cliente->save();
            // salva as alterações do telefone do cliente
            $telefone->save();
            // salva as alterações do endereço do cliente
            $endereco->save();
            print("Cliente atualizada com sucesso!");
        // se não existir, printa uma mensagem de erro
        }else{
            print("O cliente não existe");
        }
    }

    public function index_clientes(){
        // pega os clientes 
        $clientes = Cliente::orderBy('id', 'ASC')->get();
        // verifica se existe algum cliente (> 0)
        if($clientes->count() > 0){
            // retorna os clientes
            return response()->json($clientes);
        // verifica se não existe nenhum cliente
        }else{
            // printa uma mensagem de erro
            print('Não existe clientes cadastrados');
        }
    }

    public function show_clientes(Request $request, $id){
        // verifica se o cliente existe
        if(Cliente::where('id', $id)->exists()){
            // pega o produto com este id
            $cliente = Cliente::find($id);
            // pega o telefone do cliente com este id
            $telefone = Telefone::where('cliente_id', $id)->first();
            // pega o cliente com este id
            $endereco = Endereco::where('cliente_id', $id)->first();
            // verifica se existe vendas com este cliente
            if(Venda::where('cliente_id', $id)->exists()){
                // verifica se existe campo ano
                if($request->has('ano')){
                     // pega a venda com este id, pelo ano se form especificado, ordernado pela venda mais recente primeiro
                    $venda = Venda::where('cliente_id', $id)->whereYear('created_at', '=', $request->ano)->orderBy('created_at', 'DESC')->get();
                    // retorno o cliente específico e as vendas deste cliente
                    return response()->json(["Cliente: " , $cliente, "Venda: ", $venda]);
                    // verifica se existe campo mes
                }else if($request->has('mes')){
                     // pega a venda com este id, pelo ano se form especificado, ordernado pela venda mais recente primeiro
                    $venda = Venda::where('cliente_id', $id)->whereMonth('created_at', '=', $request->mes)->orderBy('created_at', 'DESC')->get();
                    // retorno o cliente específico e as vendas deste cliente
                    return response()->json(["Cliente: " , $cliente, "Venda: ", $venda]);
                }else{
                    print("Não existe vendas nesta data");
                }
                // pega a venda com este id, ordernado pela venda mais recente primeiro
                $venda = Venda::where('cliente_id', $id)->orderBy('created_at', 'DESC')->get();
                // retorno o cliente específico e as vendas deste cliente
                return response()->json(["Cliente: " , $cliente, "Venda: ", $venda]);
                }else{
                    // retorno o cliente específico e printa uma mensagem que não ha vendas deste cliente
                    return response()->json(["Cliente: " , $cliente , "não existe venda"]);
                }
        // se não existe
        }else{
            // printa uma mensagem de erro
            print("Produto não encontrado");
        }
    }

    public function destroy_clientes($id){
        // verifica se o cliente existe
        if(Cliente::where('id', $id)->exists()){
            // pega o id do cliente
            $cliente = Cliente::find($id);
            // deleta o cliente
            $cliente->delete();
            print("Cliente apagado com sucesso!");
        // se não existir, printa uma mensagem de erro
        }else{
            print("O cliente não encontrado");
        }
    }

    // PRODUTOS
    public function store_produtos (Request $request){
        // obtém todos os campos
        $dados = $request->all();
        // cria o produto
        $criado = Produto::create($dados);
        // verifica se foi criado e printa uma menssagem de sucesso
        if ($criado){
            print("Produto ". $request->nome ." cadastrado com sucesso!");
        // se não foi criado, printa uma mensagem de erro no cadastro
        } else{
            print("Erro ao cadastrar o produto");
        }
    }

    public function update_produtos (Request $request, $id){
        // verifica se o produto existe
        if(Produto::where('id', $id)->exists()){
            // pega o produto com este id
            $produto = Produto::find($id);
            // ele verifica se os campos são nulos
            // se um deles for nulo ele substitui a solicitação pelo valor já existente
            // se não for nulo ele passa como novo valor
            $produto->nome = is_null($request->nome) ? $produto->nome : $request->nome;
            $produto->tipo = is_null($request->tipo) ? $produto->tipo : $request->tipo;
            $produto->preco = is_null($request->preco) ? $produto->preco : $request->preco;
            // salva as alterações do produto
            $produto->save();
            print("Produto atualizada com sucesso!");
        // se não existir, printa uma mensagem de erro
        }else{
            print("O Produto não existe");
        }
    }

    public function index_produtos(){
        // pego todos os produtos
        $produtos = Produto::orderBy('nome', 'ASC')->get(['id' , 'nome']);
        // verifica se existe algum produto (> 0)
        if($produtos->count() > 0){
            // retorna os produtos
            return response()->json($produtos);
        // verifica se não existe nenhum produto
        }else{
            // printa uma mensagem de erro
            print('Não existe produtos cadastrados');
        }
    }

    public function show_produtos($id){
        // verifica se o produto existe
        if(Produto::where('id', $id)->exists()){
        // pega o produto com este id
        $produto = Produto::find($id);
        // retorno o produto específico
        return response()->json($produto);
        // se não existe
        }else{
            // printa uma mensagem de erro
            print("Produto não encontrado");
        }
    }

    public function delete_produtos($id){
        // verifica se o produto existe
        if(Produto::where('id', $id)->exists()){
            // pega o id do cliente
            $produto = Produto::find($id);
            // deleta o produto
            $produto->delete();
            print("Produto apagado com sucesso!");
        // se não existir, printa uma mensagem de erro
        }else{
            print("O Produto não encontrado");
        }
    }
    // VENDAS
    public function store_vendas (Request $request){
        // obtém todos os campos
        $dados = $request->all();
        // pega o cliente com este id
        $cliente = Cliente::where('id', $request->cliente_id);
        // pega o produto com este id
        $produto = Produto::where('id', $request->produto_id);

        // troca a "," por "."
        $novoPrecoUnitario = str_replace(',', '.', $request->preco_unitario);  
        // troca a "," por "."
        $novoPrecoTotal = str_replace(',', '.', $request->preco_total);  
    
        // pega o produto com este preco
        $produtoPreco = Produto::where('preco', $novoPrecoUnitario);
        // pega o preço do produto (produto_id)
        $preco = Produto::where('id', $request->produto_id)->get('preco');
        // troca o "." por ""
        $novoPreco = str_replace('.', '', $preco);  

        // multiplica o preço pela quantidade
        $multi = $novoPrecoUnitario * $request->quantidade;
        
        // se o cliente existe e o produto existe
        if($cliente->exists() && $produto->exists()){
            // se o preço existe (se o request->preco_unitario for igual a preco)
            if($produtoPreco->exists()){
                // se o preco_total for igual a multiplicação do preco_unitario * quantidade
                if($novoPrecoTotal == $multi){
                    // cria a venda
                    $criado = Venda::create($dados);
                    // verifica se foi criado e printa uma menssagem de sucesso
                    if ($criado){
                        print("Venda cadastrada com sucesso!");
                    // se não foi criado, printa uma mensagem de erro no cadastro
                    } else{
                        print("Erro ao cadastrar a venda");
                    }
                // se o preco_total não for igual a multiplicação do preco_unitario * quantidade
                }else{
                    // printa uma mensaem de erro
                    print("O valor total deve ser igual ao valor unitário multiplicado pela quantidade ");
                }
             // se o preço não existe (se o request->preco_unitario não for igual a preco)
            }else{
                // printa a mensagem de erro
                print("O Preço unitário informado é diferente do preço do produto");
            }
        } else{
            print("Cliente ou produto não existente");
        }

    }

}
