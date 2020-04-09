<?php
    class lancamentoController extends controller
    {
   
        /*Construtor para verificar se usuário está logado ou não, se não estiver redireciona para Login*/
        public function __construct()
        {
            $user = new Usuario();

            if(!$user->estaLogado()) 
            {
                header("Location:".BASE_URL."login");
                exit;
            }

        }

       

        public function index(){

        }

        /*Abre form add lancamentos de ajuda*/
        public function add()
        {
            $dados = array();
            $user = new Usuario();
            $dados['usuario'] = $user->getID($_SESSION['user_id']);
            $this->loadTemplate('lancamento-add', $dados);        
        }

        /*Recupera dados do form lancamentos ajuda e envia para model*/
        public function add_action()
        {
            $dados = array();
            $dados['msgErro'] = '';

            if ( (!empty($_POST['txtsolicitacao']))  &&  (!empty($_POST['txtprioridade'])) )
            {
                $lanc = new Lancamento();

                $txtsolicitacao = htmlspecialchars(addslashes($_POST['txtsolicitacao']));
                $txtprioridade =  htmlspecialchars(addslashes($_POST['txtprioridade'])); 

                $lanc->salvar($txtsolicitacao, $txtprioridade);
                header("Location:".BASE_URL."lancamento/suassolicitacoes");
                exit;
            }
            else
            {
                 $_SESSION['msgErro']  = 'Campos obrigatórios não preenchidos !';

                 /*Erro de Validações - carrega view com msgErro*/          
                 $dados['msgErro'] = $_SESSION['msgErro'];
                 $_SESSION['msgErro'] = '';

                 $user = new Usuario();
                 $dados['usuario'] = $user->getID($_SESSION['user_id']);
                 $this->loadTemplate('lancamento-add', $dados);
                 exit;
                
            }

        }


        /*Recupera dados do form lancamentos ajuda e envia para model*/
        public function ajudar($lanc_id)
        {
            $dados = array();
            
            //echo "Id Lancamento Ajudar .: ".$lanc_id ."<br>";
            //exit;
            
            //if (isset($_POST['btnAjudar']))
            //{
           //     echo "Clicou Ajudar";
           // }

            if  (!empty($lanc_id))
            {
                if(intval($lanc_id))
                {

                    $lanc = new Lancamento();
                    $user = new Usuario();
                    
                    /*Tem o POST do Botão AJUDAR então update no registro com o ID de quem Vai Ajudar
                    No form nao precisa do Action no caso de Editar pois ele ira enviar para o Action que o Abriu
                    Exemplo não precisa desta opção action="echo BASE_URL lancamento/ajudar */
                    if (isset($_POST['btnAjudar']))
                    {
                        $lanc->setVoluntario($lanc_id);
                        header("Location:".BASE_URL."home");
                        exit;
                    }
                    else
                    {

                        /*Carrega View com Detalhes do Lancamento para o ID selecionado
                        Tem somente o ID, então busca e carrega a View preenchida*/                                     
                        $dados['lancamento'] = $lanc->getLancamentoID($lanc_id);
                        $dados['usuario'] = $user->getID($_SESSION['user_id']);
                        $dados['usuario_solicitou_ajuda'] = $user->getID($dados['lancamento']['user_id_precisaajuda']); //Dados do Usuario que Solicitou ajuda, para mostrar ao possivel voluntario
                        $this->loadTemplate('lancamento-ajudar', $dados);                   
                        exit;

                    }

                }
               
            }

        }

        /*Recupera os dados da solicitação e abre form somente para visualização verDetalhes */
        public function verdetalhes($lanc_id)
        {
            $dados = array();
            
           
            if  (!empty($lanc_id))
            {
                if(intval($lanc_id))
                {
                    $lanc = new Lancamento();
                    $user = new Usuario();
            
                    /*Carrega View com Detalhes do Lancamento para o ID selecionado
                    Tem somente o ID, então busca e carrega a View preenchida*/                                     
                    $dados['lancamento'] = $lanc->getLancamentoID($lanc_id);
                    $dados['usuario'] = $user->getID($_SESSION['user_id']); //Usuario Logado
                    $dados['usuario_solicitou_ajuda'] = $user->getID($dados['lancamento']['user_id_precisaajuda']); //Dados do Usuario que Solicitou ajuda, para mostrar ao voluntario
                    $dados['verDetalhes'] = 'sim'; //Somente para não mostrar Botão Quero Ajudar quando estiver vendo somente detalhes
                    $this->loadTemplate('lancamento-ajudar', $dados);                   
                    exit;
                }
               
            }

        }

        
         /*Recupera o ID e efetua o cancelamento da Ajuda, opção pode ser feita somente por
         usuário que aceitou ajudar e por algum motivo não poderá  mais ajudar e envia para o Model os dados*/
         public function cancelarajuda($lanc_id)
         {
             $dados = array();
             
             //echo "Id Lancamento cancelar .: ".$lanc_id ."<br>";
             //exit;
             
             //if (isset($_POST['btnAjudar']))
             //{
            //     echo "quando form Clicou Ajudar";
            // }
 
             if  (!empty($lanc_id))
             {
                 if(intval($lanc_id))
                 {
                    $lanc = new Lancamento();
                    $lanc->setCancelVoluntario($lanc_id);
                    header("Location:".BASE_URL."home");
                    exit;
 
                 }
                
             }
 
         }


         /*Recupera o ID e efetua a conclusão da Ajuda, opção pode ser feita somente por
         usuário que aceitou ajudar e também pelo usuario que lançou o chamado e envia para o Model os dados*/
         public function concluirajuda($lanc_id)
         {
             $dados = array();
             
             //echo "Id Lancamento cancelar .: ".$lanc_id ."<br>";
             //exit;
             
             //if (isset($_POST['btnAjudar']))
             //{
            //     echo "quando form Clicou Ajudar";
            // }
 
             if  (!empty($lanc_id))
             {
                 if(intval($lanc_id))
                 {
                    $lanc = new Lancamento();
                    $lanc->setConcluirAjuda($lanc_id);
                    header("Location:".BASE_URL."home");
                    exit;
 
                 }
                
             }
 
         }


   

    /* -----------------------------------------------------
    INICIO - Metodos para uso na Lista de Suas Solicitações
    -------------------------------------------------------*/

          /* Carrega Lista de Suas Solicitações, ou seja as solicitações 
        lançadas por você ou no caso pelo usuário Logado versão sem os parametros de PAGINAÇÃO
        public function suassolicitacoes() 
        {               
            $dados = array();
            $user = new Usuario();
            $lancamentos = new Lancamento();

            $dados['usuario'] = $user->getID($_SESSION['user_id']);           //Recupera dados do usuário logado e envia para o Home
            $dados['lista'] = $lancamentos->getListaSolicitacoesPorUsuario(); //Pega todos os chamados lançados por você e monta a lista
            $this->loadTemplate('lancamento-lista', $dados);
        }
        */

        /* Carrega Lista de Suas Solicitações, ou seja as solicitações 
        lançadas por você ou no caso pelo usuário Logado com controle de paginação */
        public function suassolicitacoes() 
        {               
            global $config; //para ter acesso ao config
            $dados = array();
            $user = new Usuario();
            $lancamentos = new Lancamento();



            //Inicio paginação//
            $qtde_registros_mostrar_por_pagina = $config['qtde_registros_mostrar_por_pagina'];
            
            /* Recupera o GET da pagina clicada pelo usuario enviado pela URL utilizo ele para definir os Limits inicio e fim para o SQL */
            if (isset($_GET['pagina']))
            {
                $pagina_atual = htmlspecialchars(addslashes(intval($_GET['pagina']))); 
               
                //Caso apresente erro e não retorne a pagina seta 1 como padrão, para evitar erro 
                if ($pagina_atual == '0')
                {
                    $pagina_atual = 1;
                }    
                
                //recupera a página clicada pelo usuário e utiliza a mesma para definir os limits do SQL         
                $limit_sql_inicial = ($qtde_registros_mostrar_por_pagina*$pagina_atual)-$qtde_registros_mostrar_por_pagina;        //recupera e calcula o limit inicial a usar no SQL Limit
                $lista_lctos = $lancamentos->getListaSolicitacoesPorUsuario($limit_sql_inicial,$qtde_registros_mostrar_por_pagina); //Pega todos os chamados lançados por você e monta a lista
            }
            else
            {
                $pagina_atual = 1;                                                                                                  //Não tem pagina no GET URL então não foi clicado em nenhum paginador neste caso inicia da Pagina = 1        
                $limit_sql_inicial = ($qtde_registros_mostrar_por_pagina*$pagina_atual)-$qtde_registros_mostrar_por_pagina;         //recupera e calcula o limit inicial a usar no SQL Limit
                $lista_lctos = $lancamentos->getListaSolicitacoesPorUsuario($limit_sql_inicial,$qtde_registros_mostrar_por_pagina);  //Pega todos os chamados lançados por você e monta a lista
            }

            /* calcula quantos seletores ou links mostrar na view de paginação */
            $qtde_registros_encontrados_db = $lancamentos->getListaSolicitacoesPorUsuario_COUNT();                       //Quantidade de registros encontrados no database sem filtros
            $qtde_seletores_paginas_mostrar = ceil($qtde_registros_encontrados_db / $qtde_registros_mostrar_por_pagina); //Envia para view e fazer o for de quantos paginadores criar
            if ($qtde_seletores_paginas_mostrar == '0') 
            {
                $qtde_seletores_paginas_mostrar = 1;
            }
            //Fim Paginação//



            //Envio para View os resultados - Com Paginação//
            $dados['usuario'] = $user->getID($_SESSION['user_id']);                      //Recupera dados do usuário logado e envia para o Home
            $dados['lista'] = $lista_lctos;                                              //Retorno de todos os lançamentos realizados com os filtros acima
            $dados['qtde_seletores_paginas_mostrar'] = $qtde_seletores_paginas_mostrar;  //Envio para view informando quantos seletores paginacao criar e uso o for para cria-los
            $dados['pagina_atual'] = $pagina_atual;                                      //Envia para o View a pagina atual em que está
            $this->loadTemplate('lancamento-lista', $dados);


            /* SEM PAGINAÇÃO
            $dados['usuario'] = $user->getID($_SESSION['user_id']);     //Recupera dados do usuário logado e envia para o Home
            $dados['lista'] = $lancamentos->getListaSolicitacoesPorUsuario(); //Pega todos os chamados lançados por você e monta a lista
            $this->loadTemplate('lancamento-lista', $dados);
            */
        }


        /*Recupera o ID e efetua o cancelamento da Ajuda que você solicitou só pode ser feito 
        pelo usuario que lançou o chamado e envia para o Model os dados*/
         public function cancelar($lanc_id)
         {
             $dados = array();
             
             //echo "Id Lancamento cancelar .: ".$lanc_id ."<br>";
             //exit;
             
             //if (isset($_POST['btnAjudar']))
             //{
            //     echo "quando form Clicou Ajudar";
            // }
 
             if  (!empty($lanc_id))
             {
                 if(intval($lanc_id))
                 {
                    $lanc = new Lancamento();
                    $lanc->cancelar($lanc_id);
                    header("Location:".BASE_URL."lancamento/suassolicitacoes");
                    exit;
 
                 }
                
             }
 
         }


        /*Recupera o ID e efetua a conclusão da Ajuda que você solicitou só pode ser feito 
        pelo usuario que lançou o chamado e envia para o Model os dados*/
         public function concluir($lanc_id)
         {
             $dados = array();
             
             //echo "Id Lancamento cancelar .: ".$lanc_id ."<br>";
             //exit;
             
             //if (isset($_POST['btnAjudar']))
             //{
            //     echo "quando form Clicou Ajudar";
            // }
 
             if  (!empty($lanc_id))
             {
                 if(intval($lanc_id))
                 {
                    $lanc = new Lancamento();
                    $lanc->concluir($lanc_id);
                    header("Location:".BASE_URL."lancamento/suassolicitacoes");
                    exit;
 
                 }
                
             }
 
         }



         public function editar($lanc_id)
         {  
    
            if(!empty($lanc_id))
            {
                if(intval($lanc_id))
                {
                    $lanc = new Lancamento();
                    $user = new Usuario();
                    $dados = array();
                
                    /*Recebeu os dados via POST então foi confirmado direto do formulário, neste caso envia para o Model Salvar*/
                    if ((!empty($_POST['txtsolicitacao'])) &&  (!empty($_POST['txtprioridade']))) 
                    {
                        $txtsolicitacao = htmlspecialchars(addslashes($_POST['txtsolicitacao']));
                        $txtprioridade = htmlspecialchars(addslashes($_POST['txtprioridade']));

                       
                        $lanc->editar($lanc_id, $txtsolicitacao, $txtprioridade);
                        header("Location:".BASE_URL."lancamento/suassolicitacoes");
                        exit;

                    }
                    else
                    {
                        /*Não teve nenhum envio de POST pega o ID recupera os dados e envia para o View preencher os dados de Edição*/
                        $dados['lancamento'] = $lanc->getLancamentoID($lanc_id);
                        $dados['usuario'] = $user->getID($_SESSION['user_id']);
                        $this->loadTemplate('lancamento-editar', $dados);                   
                        exit;

                    }

                }

            }
        }


    /* -----------------------------------------------------
    FIM - Metodos para uso na Lista de Suas Solicitações
    -------------------------------------------------------*/





    }


?>