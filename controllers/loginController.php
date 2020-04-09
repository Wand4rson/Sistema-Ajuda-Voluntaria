<?php

/* ------------------------------------ */
/* Necessario para Uso do PHP Mailer*/
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
/* ------------------------------------ */


class loginController extends controller{

    /* Carregar View Login ao carregar controller */
    public function index()
    {
        $user = new Usuario();

        //$dados = array();
        //$this->loadView('login',$dados);
        

        /* -----------------------------------------------
        Caso usuário já esteja Logado, já redireciona para
        a tela de Home, ou seja não fez logoff.
        Caso não esteja Logado abre tela de Login
        ----------------------------------------------- */ 
      

       if($user->estaLogado()) 
       {
           header("Location: ".BASE_URL."home");
           exit;
       }
       else
       {
            
            //Se sessão não existe cria//
            if (!isset($_SESSION['login_tentativas_erro'])){
                $_SESSION['login_tentativas_erro'] = 0;
            };
            
            $dados = array();
            $this->loadView('login',$dados);
       }
       /* ----------------------------------------------- */
       
    }

     /* Login action, recupera as informações do Form Login e envia para Model Usuarios validar login de acesso */
     public function login_action()
     {
        
        if (!isset($_SESSION['login_tentativas_erro'])){
            $_SESSION['login_tentativas_erro'] = 0;
        };

        $dados = array();
        $dados['msgErro'] = '';  
        
        /* Funcionalidade para Armazenar em Memoria os dados, em caso de erro recupero os campo mantendo-os
        já preenchidos no Form preenchendo os value */
        $dados['txtcelular'] = (isset($_POST['txtcelular']) ? htmlspecialchars(addslashes($_POST['txtcelular'])) : '');


        /* Caso tenha chegado a quantidade de tentativas >=3 de erro faz essa primeira validação do Calculo resolvido e depois continua */
        if($_SESSION['login_tentativas_erro'] >=3) 
        {
            if (!empty($_POST['txtconfirmacao_login']))
            {
                $txtconfirmacao_login = intVal($_POST['txtconfirmacao_login']);
                if($txtconfirmacao_login !== $_SESSION['resultado_confirmacao_login'])
                {
                    $_SESSION['msgErro']  = "Resultado da operação inválido.<br/>";                
                    $dados['msgErro'] = $_SESSION['msgErro'];
                    $_SESSION['msgErro'] = '';
                    $this->loadView('login', $dados);
                    exit;
                }
            }
            else
            {
                $_SESSION['msgErro']  = "Resultado da operação não informado.<br/>";
                $dados['msgErro'] = $_SESSION['msgErro'];
                $_SESSION['msgErro'] = '';
                $this->loadView('login', $dados);
                exit;
            }
        }
        /* Fim Validação Tentativas e Token */



        if ( (!empty($_POST['txtcelular']))  &&  (!empty($_POST['txtsenhaacesso'])) )
         {
            $user = new Usuario();

            $txtcelular      = htmlspecialchars(addslashes($_POST['txtcelular']));
            $txtsenhaacesso  = htmlspecialchars(addslashes($_POST['txtsenhaacesso']));
            //echo "Celular.: ".$txtcelular."<br> Senha .: ".$txtsenhaacesso."<br>"; 

            /*Logou com sucesso, redireciona para dashboard, senão login novamente*/
            if ($user->logar($txtcelular, $txtsenhaacesso) == true)
            {
                $_SESSION['login_tentativas_erro'] = 0; //Fez Login com sucesso zero tentativas erradas

                //Logou corretamente, redireciona para Controller Home//
                header("Location:".BASE_URL."home");
                exit;



                //Comentado em 25/03/2020 - redirecionando para o Home.
                //$dados['usuario'] = $user->getID($_SESSION['user_id']); //Recupera dados do usuário logado e envia para o Home
                //$this->loadTemplate('home', $dados);
                //exit;
            }
            else
            {
                //A cada erro de Login por erro de senha ou celular incremento +  1
                $_SESSION['login_tentativas_erro'] = $_SESSION['login_tentativas_erro'] + 1; 

                $_SESSION['msgErro'] = 'Celular ou senha de acesso informados inválido.';
                //Carrega view cadastre-se com mensagem de erro
                $dados['msgErro'] = $_SESSION['msgErro'];
                $_SESSION['msgErro'] = '';
                $this->loadView('login', $dados);
                exit;
                
            }

        }
        else
        {
            $_SESSION['msgErro'] = 'Campos obrigatórios não preenchidos.';
            //Carrega view cadastre-se com mensagem de erro
            $dados['msgErro'] = $_SESSION['msgErro'];
            $_SESSION['msgErro'] = '';
            $this->loadView('login', $dados);
        }
     }

     /*Sair da Aplicação, destroi sessões*/
     public function logout()
     {
        unset($_SESSION['user_nomecompleto']);
        unset($_SESSION['user_id']);
        header("Location:".BASE_URL."login");

    }

    /* Cadastre-se, Abre Form cadastre-se */
    public function cadastre()
    {
        $dados = array();

        /* Verificador Minimo se é Hunano 
        Dois numeros aleatorios para toda vez que é recarregado a pagina 
        mostrar e o total irei salvar em uma sessão que irei Validar na 
        cadastre_action para saber se o usuário digitou corretamente o resultado da soma
        

        --- FOI NECESSARIO NESTE PRIMEIRO MOMENTO TRABALHAR NA VIEW PARA FACILITAR O PROCESSO DE ADAPTAÇÃO AO MVC  ---
       

        $dados['numero1_confirmacao'] = rand(1,10); 
        $dados['numero2_confirmacao'] = rand(1,10);
        $_SESSION['resultado_confirmacao'] = $dados['numero1_confirmacao']  + $dados['numero2_confirmacao']; 
        */

        $this->loadView('cadastre-se',$dados);
    }

     /* Cadastre-se action, recupera as informações do FormCadastro e envia para Model Usuarios */
     public function cadastre_action()
     {
        $dados = array();
        $dados['msgErro'] = '';

        
        /* Funcionalidade para Armazenar em Memoria os dados, em caso de erro recupero os campo mantendo-os
        já preenchidos no Form preenchendo os value */
        $dados['txtnomecompleto'] = (isset($_POST['txtnomecompleto']) ? htmlspecialchars(addslashes($_POST['txtnomecompleto'])) : '');
        $dados['txtcelular'] = (isset($_POST['txtcelular']) ? htmlspecialchars(addslashes($_POST['txtcelular'])) : '');
        $dados['txtemail'] = (isset($_POST['txtemail']) ? htmlspecialchars(addslashes($_POST['txtemail'])) : '');
        $dados['txtcep'] = (isset($_POST['txtcep']) ? htmlspecialchars(addslashes($_POST['txtcep'])) : '');
        $dados['txtestado'] = (isset($_POST['txtestado']) ? htmlspecialchars(addslashes($_POST['txtestado'])) : '');
        $dados['txtcidade'] = (isset($_POST['txtcidade']) ? htmlspecialchars(addslashes($_POST['txtcidade'])) : '');
        $dados['txtbairro'] = (isset($_POST['txtbairro']) ? htmlspecialchars(addslashes($_POST['txtbairro'])) : '');


        if (!empty($_POST['txtconfirmacao_cadastro']))
        {
            $txtconfirmacao_cadastro = intVal($_POST['txtconfirmacao_cadastro']);
            if($txtconfirmacao_cadastro !== $_SESSION['resultado_confirmacao_cadastro'])
            {
                $_SESSION['msgErro']  = "Resultado da operação inválido.<br/>";                
                $dados['msgErro'] = $_SESSION['msgErro'];
                $_SESSION['msgErro'] = '';
                $this->loadView('cadastre-se', $dados);
                exit;
            }
        }
        else
        {
            $_SESSION['msgErro']  = "Resultado da operação não informado.<br/>";
            $dados['msgErro'] = $_SESSION['msgErro'];
            $_SESSION['msgErro'] = '';
            $this->loadView('cadastre-se', $dados);
            exit;
        }

        
        if ( (!empty($_POST['txtnomecompleto']))  &&  (!empty($_POST['txtsenhaacesso']))  &&  (!empty($_POST['txtcelular'])) &&  (!empty($_POST['txtbairro'])) &&  (!empty($_POST['txtcep'])) &&  (!empty($_POST['txtemail'])) )
         {
            $user = new Usuario();

            $txtnomecompleto = htmlspecialchars(addslashes($_POST['txtnomecompleto']));
            $txtcelular      = htmlspecialchars(addslashes($_POST['txtcelular']));
            $txtemail        = htmlspecialchars(addslashes($_POST['txtemail']));
            $txtsenhaacesso  = htmlspecialchars(addslashes($_POST['txtsenhaacesso']));
            $txtsenhaacessoconfirma = htmlspecialchars(addslashes($_POST['txtsenhaacessoconfirma']));
            $txtcep          = htmlspecialchars(addslashes($_POST['txtcep']));
            $txtestado       = htmlspecialchars(addslashes($_POST['txtestado']));
            $txtcidade       = htmlspecialchars(addslashes($_POST['txtcidade']));
            $txtbairro       = htmlspecialchars(addslashes($_POST['txtbairro']));
            //echo "Nome .: ".$txtnomecompleto."<br> Celular.: ".$txtcelular."<br> Email .: ".$txtemail."<br> Senha .: ".$txtsenhaacesso."<br> UF .: ".$txtestado."<br> Cidade .: ".$txtcidade."<br> Bairro .: ".$txtbairro."<br>";             

            if(strlen($txtsenhaacesso) < 6){
                $_SESSION['msgErro']  = "Senha de acesso deve possuir no mínimo 6 caracteres.<br/>";
                /*Erro de Validações senhas - carrega view com msgErro*/          
                $dados['msgErro'] = $_SESSION['msgErro'];
                $_SESSION['msgErro'] = '';
                $this->loadView('cadastre-se', $dados);
                exit;
            }


            if (strcmp($txtsenhaacesso, $txtsenhaacessoconfirma) != 0)
            {
                $_SESSION['msgErro'] = 'Senhas não conferem, digite novamente.';
                
                /*Erro de Validações senhas - carrega view com msgErro*/          
                $dados['msgErro'] = $_SESSION['msgErro'];
                $_SESSION['msgErro'] = '';
                $this->loadView('cadastre-se', $dados);
                exit;
            }

            
            
            if (!$user->existe_cadastro_email($txtemail))
            {
                 if(!$user->existe_cadastro_celular($txtcelular))
                 {
                    $user->salvar($txtnomecompleto, $txtcelular, $txtemail, $txtsenhaacesso, $txtestado, $txtcidade,$txtbairro,$txtcep);
                    header("Location:".BASE_URL."login"); //Enviar para Tela de Login
                    exit;
                 }
                 else{
                    $_SESSION['msgErro'] = 'Já existe um cadastro com o Celular informado. Utilize a redefinição de senha';
                 }
            }
            else{
                $_SESSION['msgErro'] = 'Já existe um cadastro com o E-mail informado. Utilize a redefinição de senha';
            }

            /*Erro de Validações e-mail e celular - carrega view com msgErro*/          
            $dados['msgErro'] = $_SESSION['msgErro'];
            $_SESSION['msgErro'] = '';
            $this->loadView('cadastre-se', $dados);

        }
        else
        {
            /*Erro de Preenchimento Campos Obrigatórios - carrega view com msgErro*/
            $_SESSION['msgErro'] = 'Campos obrigatórios não preenchidos.';            
            $dados['msgErro'] = $_SESSION['msgErro'];

            $_SESSION['msgErro'] = '';
            $this->loadView('cadastre-se', $dados);
        }
     }



    /* Esqueci minha Senha - Abre Form */
    public function esqueci()
    {       
        $dados = array();
        $this->loadView('esqueci',$dados);
    }

     /* Esqueci action, recupera as informações do FormEsqueci e envia para Model Usuarios enviar email para recuperaçao */
    public function esqueci_action()
    {
        global $config; //para ter acesso ao arquivo de configurações

        $dados = array();

        $dados['msgErro'] = '';
        $dados['msgSucesso'] = '';

        $_SESSION['msgErro'] = '';
        $_SESSION['msgSucesso'] = '';


        /* Se não validou o resultado da validação de Humano já sai */
        if (!empty($_POST['txtconfirmacao_esqueci']))
        {
         
            $resultado_informado = intval($_POST['txtconfirmacao_esqueci']);

            if($_SESSION['resultado_confirmacao_esqueci'] !== $resultado_informado)
            {                
                //Carrega view cadastre-se com mensagem de erro e Sucesso
                $_SESSION['msgErro']  = "Resultado da operação inválido.<br/>";  
                $dados['msgErro'] = $_SESSION['msgErro'];
                $_SESSION['msgErro'] = '';                
                $this->loadView('esqueci', $dados);
                exit;
            }

        }
        else
        {
             //Carrega view cadastre-se com mensagem de erro e Sucesso
             $_SESSION['msgErro']  = "Resultado da operação não informado.<br/>";  
             $dados['msgErro'] = $_SESSION['msgErro'];
             $_SESSION['msgErro'] = '';                
             $this->loadView('esqueci', $dados);
             exit;

        }
        /* fim da validação do captcha humano */


        /* Inicio da verificação do celular, existe */

        if ( (!empty($_POST['txtcelular'])) )
         {
            $user = new Usuario();
            $txtcelular      = htmlspecialchars(addslashes($_POST['txtcelular']));

            $result = $user->getDadosPorCelular($txtcelular);
       

            if(!empty($result))
            {
                
                /* Aqui inicio o Uso do phpMailer para Enviar Confirmação de Senha
                - Minha regra de negócio será o sistema irá dar um update na senha do usuário com uma senha aleatória e essa senha irá ser enviada no email do usuário
                - para ele acessar com ela e depois alterar usando o editar dados no sistema
                */

                //print_r($result);

                /*
                echo "<br>Usuario ID    .:" .$usuario_id;
                echo "<br>Usuario Email .:" .$usuario_email;
                echo "<br>Usuario Nome  .:" .$usuario_nome;
                $senha_temporaria = uniqid();
                echo "<br>Senha Temporaria . :" .$senha_temporaria;
                */
               
                $usuario_id    = $result['user_id'];
                $usuario_nome  = $result['user_nomecompleto'];
                $usuario_email = $result['user_email'];
                $senha_temporaria = uniqid();

                $usuario_mensagem = 'Olá <h1>'.$usuario_nome.'</h1> foi solicitado em nosso sistema a recuperação de senha para o email : '.$usuario_email.'
                <br>faça o login com a senha temporaria .: <h3>'.$senha_temporaria.'</h3> e acesse o site https://seudominio.com.br/ajuda/login e em seguida realize a troca da mesma.<br> ATENÇÃO AO COPIAR A SENHA VERIFIQUE SENÃO TEM ESPAÇOS EM BRANCO NA CÓPIA';


                /* INICIANDO O USO DO PHPMAILER NA HOSPEDAGEM FOI NECESSARIO ESTAR FIXO, ESTOU TRABALHANDO PARA TRATAR*/                             
                //require 'https://seudominio.com.br/ajuda/vendor/phpmailer/phpmailer/src/Exception.php';
                //require 'https://seudominio.com.br/ajuda/vendor/phpmailer/phpmailer/src/PHPMailer.php';
                //require 'https://seudominico.com.br/ajuda/vendor/phpmailer/phpmailer/src/SMTP.php';
                
				
				//INICIANDO O USO DO PHPMAILER - LOCALHOST FUNCIONA ASSIM PARA WEB TIVE QUE MUDAR PARA A FORMA ACIMA ME INFORMAR COM SUPORTE PQ NAO FUNCIONOU ASSIM NA HOSPEDAGEM		
                require_once 'vendor/phpmailer/PHPMailer/src/Exception.php';
                require_once 'vendor/phpmailer/PHPMailer/src/PHPMailer.php';
                require_once 'vendor/phpmailer/PHPMailer/src/SMTP.php';
				
                
				
                /*
                Declarado no inicio da classe
                use PHPMailer\PHPMailer\PHPMailer;
                use PHPMailer\PHPMailer\SMTP;
                use PHPMailer\PHPMailer\Exception;
                */


                // Instantiation and passing `true` enables exceptions
                $mail = new PHPMailer();

                try 
                {
                    //Server settings (Configurações)
                    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                    // Enable verbose debug output (Ativar para ver no browser os retornos erro ou sucesso, importante para depuracao)
                    $mail->isSMTP();                                            // Send using SMTP
                    $mail->Host       = $config['mail_smtp_remetente'];         // Set the SMTP server to send through (Normalmente é smtp.seudominio.com.br)
                    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                    $mail->Username   = $config['mail_email_remetente'];        // SMTP username (Normalmente é seuemail@seudominio.com.br)
                    $mail->Password   = $config['mail_senha_remetente'];        // SMTP password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
                    $mail->SMTPSecure = false;                                  // Define se é utilizado SSL/TLS - Mantenha o valor "false"
                    $mail->SMTPAutoTLS = false;                                 // Define se, por padrão, será utilizado TLS - Mantenha o valor "false"

                    //Recipients
                    $mail->setFrom($config['mail_email_remetente'] , 'Sistema de Recuperação de Senha - Ajuda Voluntaria'); //De
                    $mail->addAddress($usuario_email, $usuario_nome);                                                       // Para
                    
                  
                    // Content
                    $mail->isHTML(true);                                                   // Set email format to HTML
                    $mail->CharSet = 'utf-8';                                               // Charset da mensagem (opcional)
                    $mail->Subject = 'Sistema de Recuperação de Senha - Ajuda Voluntaria';
                    $mail->Body    = $usuario_mensagem;
                    $mail->AltBody = $usuario_mensagem;

                    //$mail->send();
                    //echo 'Message has been sent';

                    $enviado = $mail->send();
                    
                    // Exibe uma mensagem de resultado do envio (sucesso/erro)
                    if ($enviado) 
                    {                           
                        $_SESSION['msgSucesso'] = 'E-mail enviado com sucesso ! Confira sua caixa de entrada.';

                        /* Retornou email enviado então altera senha para a Temporaria informada permitindo o usuario de acessar com ela */
                        $user->alterarSenha($usuario_id, $senha_temporaria);
                    } 
                    else 
                    {                            
                        $_SESSION['msgErro'] = 'E-mail não foi enviado, tente novamente ou solicite suporte técnico.';
                    }
                    
                } catch (Exception $e) {
                    //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    $_SESSION['msgErro'] = 'E-mail não foi enviado, tente novamente ou solicite suporte técnico. Erro .:'.$e->getMessage();
                }

            }
            else
            {
                //echo "Nenhuma informação retornada para o celular informado";
            }

            
            //Carrega view cadastre-se com mensagem de erro e Sucesso
            $dados['msgErro'] = $_SESSION['msgErro'];
            $dados['msgSucesso'] = $_SESSION['msgSucesso'];
            $_SESSION['msgErro'] = '';
            $_SESSION['msgSucesso'] = '';
            $this->loadView('esqueci', $dados);
        }
        else
        {
            $_SESSION['msgErro'] = 'Campos obrigatórios não preenchidos.';
            
            //Carrega view cadastre-se com mensagem de erro
            $dados['msgErro'] = $_SESSION['msgErro'];
            $_SESSION['msgErro'] = '';
            $this->loadView('esqueci', $dados);
        }

    }

}


?>