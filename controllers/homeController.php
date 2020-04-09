<?php
class homeController extends controller {

    /*Construtor para verificar se usuário está logado ou não, se não estiver redireciona para Login*/
    public function __construct()
    {
        //parent::__construct();
        $user = new Usuario();
           
       //Não esta Logado, envia para Login - Validar somente nos Controllers que Vão Fazer Uso dos Models que não sejam o LoginController //
       if(!$user->estaLogado()) 
       {
           header("Location: ".BASE_URL."login");
           exit;
       }
   }


   /* Carrega Lista de Solicitações a ajudar sem paginação 
    public function index() 
	{               
        $dados = array();
        $user = new Usuario();
        $lancamentos = new Lancamento();

        $dados['usuario'] = $user->getID($_SESSION['user_id']);      //Recupera dados do usuário logado e envia para o Home
        $dados['lista'] = $lancamentos->getListaTodasSolicitacoes(); //Pega todos os chamados e monta a lista
        $this->loadTemplate('home', $dados);
    }
  */


    /* Carrega Lista de Solicitações a Ajudar com Paginação */
    public function index() 
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
            $lista_lctos = $lancamentos->getListaTodasSolicitacoes($limit_sql_inicial,$qtde_registros_mostrar_por_pagina);     //Pega todos os chamados lançados por você e monta a lista
        }
        else
        {
            $pagina_atual = 1;                                                                                                  //Não tem pagina no GET URL então não foi clicado em nenhum paginador neste caso inicia da Pagina = 1        
            $limit_sql_inicial = ($qtde_registros_mostrar_por_pagina*$pagina_atual)-$qtde_registros_mostrar_por_pagina;         //recupera e calcula o limit inicial a usar no SQL Limit
            $lista_lctos = $lancamentos->getListaTodasSolicitacoes($limit_sql_inicial,$qtde_registros_mostrar_por_pagina);       //Pega todos os chamados lançados por você e monta a lista
        }

        /* calcula quantos seletores ou links mostrar na view de paginação */
        $qtde_registros_encontrados_db = $lancamentos->getListaTodasSolicitacoes_COUNT();                            //Quantidade de registros encontrados no database sem filtros
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
        $this->loadTemplate('home', $dados);
    }

}