<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App\Sintegra;
use Auth;
use Session;

class ConsultaController extends Controller {

    /**
     * Exibe formulário para consulta
     *
     * @return Response
     */
    public function index()
    {
        $senha = Session::get('user.plain_pass');
        $usuario = Auth::user()->usuario;

        return view('consulta.index', compact('senha', 'usuario'));
    }

    /**
     * Realiza consulta no sistema do Sintegra ES e retorna JSON
     *
     * @return JSON empesa_obj
     */
    public function consultar($cnpj, Request $request)
    {   
        $client = new Client(); //GuzzleHttp\Client
        $url = "http://www.sintegra.es.gov.br/resultado.php";
        
        $body_request['num_cnpj'] = $cnpj;
        $body_request['botao'] = "Consultar";

        $result = $client->post($url, ['form_params'=>$body_request]);

        $response = $result->getBody();

        $response = utf8_encode($response->__toString());

        $fields = [
        'CNPJ', 'Inscrição Estadual', 'Razão Social', 'Logradouro', 'Número', 'Complemento', 'Bairro',
        'Município', 'UF', 'CEP', 'Telefone', 'Atividade Econômica', 'Data de Inicio de Atividade',
        'Situação Cadastral Vigente', 'Data desta Situação Cadastral', 'Regime de Apura&ccedil;&atilde;o', 'Emitente de NFe desde'
        ];

        //Verifica se o sistema retornou cadastro
        if(preg_match ('/<title>Resultado da Consulta ao Sintegra<\/title>/s', $response)){

            //Recupera e limpa os valores dos campos encontrados
            foreach ($fields as $field) {
                preg_match('/((?<='.$field.').*?(?=">))(.*?)(?=<\/td)/s', $response, $matches, PREG_OFFSET_CAPTURE);
                

                if(!empty($matches)){
                    preg_match('/(?=">)(.*)/s', $matches[0][0], $matches2, PREG_OFFSET_CAPTURE);
                    $value = preg_replace('/\">/', '', $matches2[0][0]);
                }

                $empresa_array[html_entity_decode($field)] = html_entity_decode(utf8_encode($value));
            }


            //Armazena os valores em um objeto JSON
            $empresa_obj = json_encode($empresa_array);

            //Salva no banco
            $sintegra = new Sintegra;
            $sintegra->id_usuario = Auth::user()->id;
            $sintegra->cnpj = $empresa_array['CNPJ'];
            $sintegra->json = $empresa_obj;

            $sintegra->save();


        }else{
            $empresa_obj = null;
        }
        

        return  \Response::json($empresa_obj);

    }

    /**
     * Lista todas as consultas realizadas pelo usuário
     *
     * @return View consulta.listar
     */
    public function listar(){
        $consultas = Sintegra::where('id_usuario', '=', Auth::user()->id)->get();
        
        return view('consulta.listar', compact('consultas'));
    }

    /**
     * Exclui registro de consulta
     *
     */
    public function excluir($id){
        $consulta = Sintegra::find($id);

        $consulta->delete();

        return redirect()->intended('/listar');
    }

}