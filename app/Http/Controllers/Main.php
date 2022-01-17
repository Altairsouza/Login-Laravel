<?php

namespace App\Http\Controllers;

use App\Classes\Enc;
use App\Classes\Logger;
use App\Classes\Nossaclasse;
use App\Http\Requests\LoginRequest;
use App\Models\Usuario;
use App\Classes\Random;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class Main extends Controller
{

    private $Enc;
    private $Logger;

    public function __construct()
    {
        $this->Enc = new Enc();
        $this->Logger = new Logger();
    }

    // =========================================================
    public function index()
    {

        // verificar se o usuario está logado
        if ($this->checkSession()) {
            return redirect()->route('home');
        } else {
            return redirect()->route('login');
        }
    }

    // =========================================================
    private function checkSession()
    {
        return  session()->has('usuario');
    }

    //==============================================
    public function login()
    {
        // verificar se já existe uma sessao(usuario logado pra n ter q mostrar a tela de login novamente)
        if ($this->checkSession()) {
            return redirect()->route('index');
        }

        $erro = session('erro'); // ele está pegando o erro da public function login_submit, dentro dela existe um
        // uma  condicao e dentro dela tem um session falando o erro
        $data = [];
        if (!empty($erro)) {
            $data = [
                'erro' => $erro
            ];
        }


        //apresenta o formulario de login
        return view('login', $data);
    }

    //==============================================
    public function login_submit(LoginRequest $request)
    {

        if (!$request->isMethod('post')) {
            return redirect()->route('index');
        }

        if ($this->checkSession()) {
            return redirect()->route('index');
        }

        //validacao
        $request->validated();

        //verificar dados de login
        $usuario = trim($request->input('text_usuario')); // trim serve pra remover espaços em branco do inico ao fim
        $senha = trim($request->input('text_senha'));

        $usuario =  Usuario::where('usuario', $usuario)->first();

        // VERIFICA SE EXISTE O USUARIO
        if (!$usuario) {

            $this->Logger->log('error',trim($request->input('text_usuario')). ' - Não existe o usuário indicado.');


            session()->flash('erro', ['Não existe o usuário', 'segundo erro!!!']); // o fash é um metodo q só vai ser usada uma vez por sessao
            return redirect()->route('login');
        }


        //verificar se a senha está correnta
        if (!Hash::check($senha, $usuario->senha)) { // o value vai mostrar a senha original e o usuario->senha e a senha
            //criptografada dai eles vao ver se é a msm senha


            //Logger
            $this->Logger->log('error',trim($request->input('text_usuario')). ' - Senha inválida.');

            session()->flash('erro', ['Senha inválida.']); // o fash é um metodo q só vai ser usada uma vez por sessao
            return redirect()->route('login');
        }
        //criar a sessao (se login ok)
        session()->put('usuario', $usuario); // esse usuario ta sendo pego do index e variavel do objeto




       //logger
       $this->Logger->log('info', 'fez o seu login');

        return redirect()->route('home');
    }


    //===============================================================
    public function logout()
    {

        //logger
        $this->Logger->log('info','Fez o seu logout.');

        session()->forget('usuario');
        return redirect()->route('index');
    }








    //======================================================
    public function temp() // só ensinando como adicionar uma pessoa ao banco de dados n  faz parte do codigo login
    {


        $usuario = new \App\Models\Usuario;

        $usuario->usuario = 'maria';
        $usuario->senha = Hash::make('asdasdd');
        $usuario->save();
        echo "ok";
    }

    //==========================================
    // Home (entrada na aplicacao)
    //==========================================
    public function home()
    {



        if (!$this->checkSession()) {
            return redirect()->route('login');
        }

        $data = [
            'usuarios' => Usuario::all()
        ];



        return view('home', $data);
    }








    //===================================================
    public function edit($id_usuario)
    {

        $id_usuario = $this->Enc->encriptar($id_usuario);


        echo " vou editar os dados dos usuarios: $id_usuario";
    }

    //=======================================================
    public function final($hash)
    {

        $hash = $this->Enc->desencriptar($hash);

        echo 'valor:' . $hash;
    }


    //=======================================================
    public function edite($id_usuario)
    {
        $id_usuario = $this->Enc->desencriptar($id_usuario);

        echo 'o usuario a editar é ' . $id_usuario;
    }



    //=======================================================
    public function upload(Request $request){

        // validacao do upload
            $validate = $request->validate(// ele está pegando uma classe nativa do laravel creio eu tem q ser esse nome validate()
                //rules(regras)
                [
                    'ficheiro' => 'required|image|mimes:jpeg|max:12|dimensions:

                    min_width=100,
                    min_height=100,
                    max_width=1000,
                    max_height=500'
                ],
                [
                    'ficheiro.required' => 'A imagem é obrigatória',
                    'ficheiro.image' => 'Deve carregar uma imagem',
                    'ficheiro.mimes' => 'A imagem tem que ser em formato jpg',
                    'ficheiro.max' => 'No máximo com 12 kb',
                    'ficheiro.dimensions' => 'Dimensões inválidas (100x100 max)',
                ]
                );



     //   $request->ficheiro->store('public/images' ); //aqui ele esta dizendo q vai quarda o arquivo(storeAS)('public/imagens) é o local q vai ser salvo
        echo 'terminado';
    }

    //====================================================
    public function lista_ficheiros(){

        $files = Storage::files('public/pdfs'); // dentro do paramentro vou aprofundar mostrando exatamente a pasta q eu quero listar

        echo '<pre>';
        print_r($files);
    }

    //====================================================
    public function download($file) {
            return response()->download("storage/app/public/pdfs/$file");
    }
}
