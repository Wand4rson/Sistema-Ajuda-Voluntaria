<?php
class usuarioController extends controller{

    /*Construtor para verificar se usuário está logado ou não, se não estiver redireciona para Login*/
    public function __construct()
    {
        $user = new Usuario();
           
       //Não esta Logado, envia para Login - Validar somente nos Controllers que Vão Fazer Uso dos Models que não sejam o LoginController //
       if(!$user->estaLogado()) 
       {
           header("Location: ".BASE_URL."login");
           exit;
       }
   }

    /* Carregar dashboard com lista preenchida de solicitações e ajudas */
    public function index(){
        $dados = array();
        $this->loadView('home',$dados);
    }

     /* Carregar dashboard com lista preenchida de solicitações e ajudas */
     public function editar()
     {
        $dados = array();
        $user = new Usuario();
        $dados['usuario'] = $user->getID($_SESSION['user_id']);
        $this->loadTemplate('meus-dados',$dados);
        exit;
    }

    /* Form Editar com dados alterados, recupera as informações do FormEditar e envia para Model Usuarios */
    public function editar_action()
    {
       $dados = array();
       $dados['msgErro'] = '';
       $user = new Usuario();

       if ( (!empty($_POST['txtnomecompleto'])) && (!empty($_POST['txtcidade']))  && (!empty($_POST['txtbairro'])) && (!empty($_POST['txtcep'])) )
        {
           

           $txtnomecompleto = htmlspecialchars(addslashes($_POST['txtnomecompleto']));
           $txtcep          = htmlspecialchars(addslashes($_POST['txtcep']));
           $txtestado       = htmlspecialchars(addslashes($_POST['txtestado']));
           $txtcidade       = htmlspecialchars(addslashes($_POST['txtcidade']));
           $txtbairro       = htmlspecialchars(addslashes($_POST['txtbairro']));
        
           //Tem senha, altera não tem não altera
           if (!empty($_POST['txtsenhaacesso']))
           {
                $txtsenhaacesso  = htmlspecialchars(addslashes($_POST['txtsenhaacesso']));

                if(strlen($txtsenhaacesso) < 6)
                {
                    $_SESSION['msgErro']  = "Senha de acesso deve possuir no mínimo 6 caracteres.<br/>";
                    /*Erro de Validações senhas - carrega view com msgErro*/          
                    $dados['msgErro'] = $_SESSION['msgErro'];
                    $_SESSION['msgErro'] = '';
                    $dados['usuario'] = $user->getID($_SESSION['user_id']);
                    $this->loadTemplate('meus-dados', $dados);
                    exit;
                }
                
           }
           else
           {
                $txtsenhaacesso = '';
           }

            //echo "Nome .: ".$txtnomecompleto."<br> Senha .: ".$txtsenhaacesso."<br> UF .: ".$txtestado."<br> Cidade .: ".$txtcidade."<br> Bairro .: ".$txtbairro."<br>";             
            $user->alterar($txtnomecompleto, $txtsenhaacesso, $txtestado, $txtcidade,$txtbairro,$txtcep);
            header("Location:".BASE_URL."usuario/editar"); //Enviar para Tela de Edição de meus dados
            exit;

       }
       else
       {
           /*Erro de Preenchimento Campos Obrigatórios - carrega view com msgErro*/
           $_SESSION['msgErro'] = 'Campos obrigatórios não preenchidos.';            
           $dados['msgErro'] = $_SESSION['msgErro'];
           $_SESSION['msgErro'] = '';           
           $dados['usuario'] = $user->getID($_SESSION['user_id']);
           $this->loadTemplate('meus-dados', $dados);
           exit;
       }
    }

    

    

}


?>