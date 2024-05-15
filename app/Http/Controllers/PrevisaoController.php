<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\Pesquisa;
use App\Models\Previsao;
use App\Models\CondicaoClimatica;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Client\ConnectionException;

class PrevisaoController extends Controller
{
    private $weatherstackApiKey = '';
    const API_URL = 'http://api.weatherstack.com/';

    private $errorCodes = [
        404 => 'O recurso solicitado não foi encontrado.',
        101 => 'A chave de acesso fornecida é inválida.',
        102 => 'A conta de usuário está inativa ou bloqueada.',
        103 => 'A função da API solicitada não existe.',
        104 => 'O limite mensal de solicitações da assinatura foi atingido.',
        105 => 'A assinatura atual não suporta esta função da API.',
        601 => 'Foi especificado um valor inválido ou ausente para a consulta.',
        602 => 'A solicitação da API não retornou nenhum resultado.',
        603 => 'Os dados históricos não são suportados no plano de assinatura atual.',
        604 => 'Consultas em massa não são suportadas no plano de assinatura atual.',
        608 => 'Foi especificado um valor inválido para o número de dias de previsão.',
        609 => 'Os dados de previsão do tempo não são suportados no plano de assinatura atual.',
        615 => 'A solicitação da API falhou.'
    ];

    public function index(Request $request)
    {
        $cidade = $request->input('cidade');
        if ($cidade) {
            $pesquisa = new Pesquisa();
            $pesquisa->query = $cidade;
            $pesquisa->save();

            try {
                $previsao = $this->getPrevisaoAtual($cidade);
            } catch (ConnectionException $e) {
                return redirect()->back()->with('error',
                 'Falha ao conectar-se ao serviço de previsão do tempo. Por favor, 
                 tente novamente mais tarde.');
            }
        } else {
            try {
                $previsao = $this->getPrevisaoAtual($this->getCoordenadasIp());
            } catch (ConnectionException $e) {
                return redirect()->back()->with('error',
                 'Falha ao conectar-se ao serviço de previsão do tempo. Por favor,
                  tente novamente mais tarde.');
            }
        }

        if (isset($previsao['current']['weather_code'])) {
            $previsao['current']['descricao_traduzida'] =
             CondicaoClimatica::where('codigo', '=',
              $previsao['current']['weather_code'])->first()->descricao ?? null;
        }

        if (isset($previsao['success']) && !$previsao['success']) {
            $previsao['mensagem_traduzida'] = $this->getInfoErrorTraduzido($previsao['error']['code']);
        }

        $previsao['historicos_pesquisas'] = Pesquisa::orderBy('created_at', 'desc')->get();

        return view('previsao.index', $previsao);
    }

    public function compararPrevisoes(Request $request)
    {
        $primeiraCidade = $request->input('cidade1');
        $segundaCidade = $request->input('cidade2');
        $previsoes = [];
        if ($primeiraCidade) {
            $previsoes['primeiraPrevisao'] = $this->getPrevisaoAtual($primeiraCidade);
            if (isset($previsoes['primeiraPrevisao']['current']['weather_code'])) {
                $previsoes['primeiraPrevisao']['current']['descricao_traduzida'] = 
                CondicaoClimatica::where('codigo', '=',
                 $previsoes['primeiraPrevisao']['current']['weather_code'])->first()->descricao ?? null;
            }
            if (isset(
                $previsoes['primeiraPrevisao']['success']) && !$previsoes['primeiraPrevisao']['success']) {
                $previsoes['primeiraPrevisao']['mensagem_traduzida'] = 
                $this->getInfoErrorTraduzido($previsoes['primeiraPrevisao']['error']['code']);
            }
        }
        if ($segundaCidade) {
            $previsoes['segundaPrevisao'] = $this->getPrevisaoAtual($segundaCidade);
            if (isset($previsoes['segundaPrevisao']['current']['weather_code'])) {
                $previsoes['segundaPrevisao']['current']['descricao_traduzida'] =
                 CondicaoClimatica::where('codigo', '=',
                  $previsoes['segundaPrevisao']['current']['weather_code'])->first()->descricao ?? null;
            }
            if (isset($previsoes['primeiraPrevisao']['success']) && !$previsoes['primeiraPrevisao']['success']) {
                $previsoes['segundaPrevisao']['mensagem_traduzida'] =
                 $this->getInfoErrorTraduzido($previsoes['segundaPrevisao']['error']['code']);
            }
        }

        return view('previsao.compare', $previsoes);
    }

    public function getPrevisaoAtual($local)
    {
        $response =
         Http::timeout(10)->get(
            self::API_URL . "current?access_key=" . $this->weatherstackApiKey . "&query=$local&units=m");
        return $response->json();
    }

    public function nova(Request $request)
    {
        $rules = [
            'cidade' => 'required|string|max:128',
            'temperatura' => 'required|numeric',
            'codigo_previsao' => 'required|integer',
            'descricao' => 'required|string|max:128',
            'icone' => 'required|string|max:512',
            'umidade' => 'required|numeric',
            'indice_uv' => 'required|numeric',
            'visibilidade' => 'required|numeric',
            'data_local' => 'required|date',
            'vento' => 'required|numeric',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->with('error',
             'Ocorreu um erro ao salvar a previsão. Por favor, tente novamente.');
        }

        $previsao = new Previsao();
        $previsao->cidade = $request->cidade;
        $previsao->temperatura = $request->temperatura;
        $previsao->codigo_previsao = $request->codigo_previsao;
        $previsao->descricao = $request->descricao;
        $previsao->icone = $request->icone;
        $previsao->umidade = $request->umidade;
        $previsao->indice_uv = $request->indice_uv;
        $previsao->visibilidade = $request->visibilidade;
        $previsao->data_local = $request->data_local;
        $previsao->vento = $request->vento;
        $previsao->dia_noite = $request->dia_noite == "yes";

        if ($previsao->save()) {
            return redirect()->back()->with('success',
             'Previsão climática salva com sucesso!');
        } else {
            return redirect()->back()->with('error',
             'Ocorreu um erro ao salvar a previsão climática!');
        }
    }

    public function previsoesSalvas()
    {
        $previsoes = Previsao::orderBy('created_at', 'desc')->get();
        return view('previsao.listar', compact('previsoes'));
    }

    public function previsaoSalva($id)
    {
        $previsao = Previsao::find($id);

        if (is_null($previsao)) return redirect()->back()->with('error',
         'Previsão não encontrada!');
        $previsao->descricao_traduzida = CondicaoClimatica::where(
            'codigo', '=',
             $previsao->codigo_previsao)->first()->descricao ?? null;
        return view('previsao.previsao', compact('previsao'));
    }

    public function excluirHistorico($id)
    {
        $pesquisa = Pesquisa::find($id);
        return response()->json($pesquisa->delete());
    }

    public function pesquisarHistoricos(Request $request)
    {
        $query = $request->input('query');
        $historicos = Pesquisa::where(
            'query', 'like', "%{$query}%")->orderBy(
                'created_at', 'desc')->get();
        return response()->json($historicos);
    }

    public function getCoordenadasIp()
    {
        $response = Http::get("http://www.geoplugin.net/json.gp?");
        if ($response->successful()) {
            return $response->json()['geoplugin_city'];
        } else {
            return "Feira de Santana"; 
        }
    }

    public function getInfoErrorTraduzido($codigo)
    {
        if ($this->errorCodes[$codigo]) {
            return  $this->errorCodes[$codigo];
        }
        return "Houve um erro desconhecido, por favor tente novamente mais tarde";
    }
}
