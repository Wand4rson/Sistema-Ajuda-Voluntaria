<?php
    class Lancamento extends model{

        /*Pega todas as solicitações de Ajuda onde não foram feitas
         pelo usuário Logado, onde ele possa escolher ajudar ou não de acordo com os 
         filtros estado, cidade e etc com parametros de controle de paginação */
        public function getListaTodasSolicitacoes($limit_sql_inicial,$qtde_registros_mostrar_por_pagina)
        {
            
            $array = array();

            $sql = "SELECT *,
                        (SELECT user_nomecompleto FROM tab_usuarios WHERE user_id=tab_lancamentos.user_id_precisaajuda) AS nome_usuario_solicitante,
                        (SELECT user_nomecompleto FROM tab_usuarios WHERE user_id=tab_lancamentos.user_id_voluntario) AS nome_usuario_voluntario,
                        (SELECT user_nomecompleto FROM tab_usuarios WHERE user_id=tab_lancamentos.user_id_concluido) AS nome_usuario_concluiu
                 FROM tab_lancamentos WHERE user_id_precisaajuda<>:user_id_precisaajuda ORDER BY lanc_datahoralancamento ASC LIMIT $limit_sql_inicial, $qtde_registros_mostrar_por_pagina";

            $sql = $this->db->prepare($sql);
            $sql->bindValue(":user_id_precisaajuda", $_SESSION['user_id']);
            $sql->execute();

            if($sql->rowCount() > 0){
                $array = $sql->fetchAll(PDO::FETCH_ASSOC);
            }

            return $array;

        }

        /*Pega todas as solicitações de Ajuda onde não foram feitas
         pelo usuário Logado, onde ele possa escolher ajudar ou não de acordo com os 
         filtros estado, cidade e etc com parametros de controle de paginação retornando
         COUNT para uso no controle de paginação */

        public function getListaTodasSolicitacoes_COUNT()
        {
            $sql = "SELECT COUNT(*) as qtde_registros_encontrados 
                 FROM tab_lancamentos WHERE user_id_precisaajuda<>:user_id_precisaajuda";

            $sql = $this->db->prepare($sql);
            $sql->bindValue(":user_id_precisaajuda", $_SESSION['user_id']);
            $sql->execute();

            $qtde_registros_encontrados = $sql->fetch();
            return $qtde_registros_encontrados['qtde_registros_encontrados'];
        }



        /*Pega Lançamento por ID para Edição, Visualização e etc. */
        public function getLancamentoID($lanc_id)
        {

            $sql = "SELECT * FROM tab_lancamentos WHERE  lanc_id=:lanc_id";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":lanc_id", $lanc_id);
            $sql->execute();

            if($sql->rowCount() > 0){
                return  $sql->fetch(PDO::FETCH_ASSOC);
            }

        }

         /*Pega todas as solicitações de Ajuda feitas pelo Usuario Logado para editar, excluir e etc 
         com parametros para controle de paginaçao*/
        public function getListaSolicitacoesPorUsuario($limit_sql_inicial,$qtde_registros_mostrar_por_pagina)
        {
            
            $array = array();

            $sql = "SELECT *,
                        (SELECT user_nomecompleto FROM tab_usuarios WHERE user_id=tab_lancamentos.user_id_precisaajuda) AS nome_usuario_solicitante,
                        (SELECT user_nomecompleto FROM tab_usuarios WHERE user_id=tab_lancamentos.user_id_voluntario) AS nome_usuario_voluntario,
                        (SELECT user_nomecompleto FROM tab_usuarios WHERE user_id=tab_lancamentos.user_id_concluido) AS nome_usuario_concluiu
                 FROM tab_lancamentos WHERE user_id_precisaajuda=:user_id_precisaajuda ORDER BY lanc_id DESC LIMIT $limit_sql_inicial, $qtde_registros_mostrar_por_pagina";

            $sql = $this->db->prepare($sql);
            $sql->bindValue(":user_id_precisaajuda", $_SESSION['user_id']);
            $sql->execute();

            if($sql->rowCount() > 0){
                $array = $sql->fetchAll(PDO::FETCH_ASSOC);
            }

            return $array;

        }

        /*Pega todas as solicitações de Ajuda feitas pelo Usuario Logado ,
        retornando o COUNT de quantos registros tem gravados para uso na PAGINAÇÃO*/
        public function getListaSolicitacoesPorUsuario_COUNT()
        {
            $sql = "SELECT COUNT(*) as qtde_registros_encontrados 
                 FROM tab_lancamentos WHERE user_id_precisaajuda=:user_id_precisaajuda";

            $sql = $this->db->prepare($sql);
            $sql->bindValue(":user_id_precisaajuda", $_SESSION['user_id']);
            $sql->execute();

            $qtde_registros_encontrados = $sql->fetch();
            return $qtde_registros_encontrados['qtde_registros_encontrados'];
        }


        /*Incluir Lançamento de Solicitação de Ajuda*/
        public function salvar($lanc_descricao, $lanc_prioridade)
        {

            $sql =" INSERT INTO tab_lancamentos (
                        user_id_precisaajuda,
                        lanc_descricao,
                        lanc_prioridade,
                        ip_lancamento_precisaajuda)
                    VALUES (
                        :user_id_precisaajuda,
                        :lanc_descricao,
                        :lanc_prioridade,
                        :ip_lancamento_precisaajuda);";
                   

            try
            {
              $sql = $this->db->prepare($sql);
              $sql->bindValue(":user_id_precisaajuda", $_SESSION['user_id']);
              $sql->bindValue(":lanc_descricao", $lanc_descricao);
              $sql->bindValue(":lanc_prioridade", $lanc_prioridade);
              $sql->bindValue(":ip_lancamento_precisaajuda", $_SERVER['REMOTE_ADDR']);            				
              $sql->execute();

            }
            catch(PDOException $e)
            {
                echo "Erro salvar solicitação de ajuda  .: ".$e->getMessage();
                exit;
            }
          
        }


        /*Editar Lançamento de Solicitação de Ajuda*/
        public function editar($lanc_id, $lanc_descricao, $lanc_prioridade)
        {
            $sql =" UPDATE tab_lancamentos SET 
                        lanc_descricao=:lanc_descricao,
                        lanc_prioridade=:lanc_prioridade
                    WHERE
                        user_id_precisaajuda=:user_id_precisaajuda AND lanc_id=:lanc_id";
                   

            try
            {
              $sql = $this->db->prepare($sql);
              $sql->bindValue(":lanc_descricao", $lanc_descricao);
              $sql->bindValue(":lanc_prioridade", $lanc_prioridade);
              $sql->bindValue(":user_id_precisaajuda", $_SESSION['user_id']);
              $sql->bindValue(":lanc_id", $lanc_id);            				
              $sql->execute();

            }
            catch(PDOException $e)
            {
                echo "Erro editar solicitação de ajuda  .: ".$e->getMessage();
                exit;
            }
          
        }

         /*Cancelar Lançamento de Solicitação de Ajuda, somente pode ser feito 
         pelo usuário que lançou e não esteja concluido o chamado */
         public function cancelar($lanc_id)
         {
             $sql =" UPDATE tab_lancamentos SET 
                         lanc_status_solicitacao=3
                     WHERE
                         user_id_precisaajuda=:user_id_precisaajuda AND lanc_id=:lanc_id";
                    
 
             try
             {
               $sql = $this->db->prepare($sql);
               $sql->bindValue(":user_id_precisaajuda", $_SESSION['user_id']);
               $sql->bindValue(":lanc_id", $lanc_id);            				
               $sql->execute();
 
             }
             catch(PDOException $e)
             {
                 echo "Erro cancelar solicitação de ajuda  .: ".$e->getMessage();
                 exit;
             }
           
         }

        /*Atualiza no lancamento concluindo o chamado pelo usuario que lançou, esta opção fica 
        disponivel pois pode acontecer de o usuário que se voluntariou a ajudar não encerrar o
        chamado após a ajuda realizada*/
        public function concluir($lanc_id)
        {
            $sql =" UPDATE tab_lancamentos SET 
                user_id_concluido=:user_id_concluido,
                ip_lancamento_concluido=:ip_lancamento_concluido,
                lanc_status_solicitacao=1,
                lanc_datahoraconcluido=now()
            WHERE
                lanc_id=:lanc_id AND user_id_precisaajuda=:user_id_precisaajuda";
                   
            try
            {
              $sql = $this->db->prepare($sql);                        				    
              $sql->bindValue(":user_id_concluido", $_SESSION['user_id']);          //Id de quem ajudou e vai concluir ou do usuário que lançou
              $sql->bindValue(":ip_lancamento_concluido", $_SERVER['REMOTE_ADDR']);
              $sql->bindValue(":lanc_id", $lanc_id);
              $sql->bindValue(":user_id_precisaajuda", $_SESSION['user_id']);        //Somente o Voluntário pode concluir seus aceites de ajuda ou também o Dono do Lançamento.    
              $sql->execute();

            }
            catch(PDOException $e)
            {
                echo "Erro setar conclusao da ajuda pelo usuário que precisa da ajuda  .: ".$e->getMessage();
                exit;
            }
        }




        /*Atualiza no lancamento o Voluntario que aceitou Ajudar*/
        public function setVoluntario($lanc_id)
        {
            $sql =" UPDATE tab_lancamentos SET 
                user_id_voluntario=:user_id_voluntario,
                ip_lancamento_voluntario=:ip_lancamento_voluntario,
                lanc_status_solicitacao=2,
                lanc_datahoravoluntarioaceitou=now()
            WHERE
                lanc_id=:lanc_id";
                   

            try
            {
              $sql = $this->db->prepare($sql);
              $sql->bindValue(":user_id_voluntario", $_SESSION['user_id']);          //Id do voluntario é o mesmo que estara logado
              $sql->bindValue(":ip_lancamento_voluntario", $_SERVER['REMOTE_ADDR']);
              $sql->bindValue(":lanc_id", $lanc_id);            				
              $sql->execute();

            }
            catch(PDOException $e)
            {
                echo "Erro setar voluntario da ajuda  .: ".$e->getMessage();
                exit;
            }

        }

        /*Atualiza no lancamento removendo o Voluntario que aceitou ajudar, está opção só será permitida para chamados aceitos pelo usuario logado
        ou seja ele pode aceitar ajudar e por algum motivo não mais aceitar, sendo assim ele podera retirar sua ajuda*/
        public function setCancelVoluntario($lanc_id)
        {
            $sql =" UPDATE tab_lancamentos SET 
                user_id_voluntario=0,
                ip_lancamento_voluntario='',
                lanc_status_solicitacao=0,
                lanc_datahoravoluntarioaceitou=''
            WHERE
                lanc_id=:lanc_id AND user_id_voluntario=:user_id_voluntario";
                   
            try
            {
              $sql = $this->db->prepare($sql);
              $sql->bindValue(":lanc_id", $lanc_id);            				     
              $sql->bindValue(":user_id_voluntario", $_SESSION['user_id']);          //Id do voluntario que cancelar ajuda deve ser o mesmo que esta vinculado no chamado e deve estar logad                            
              $sql->execute();

            }
            catch(PDOException $e)
            {
                echo "Erro setar cancelamento de voluntario da ajuda  .: ".$e->getMessage();
                exit;
            }

        }

        
        /*Atualiza no lancamento removendo o Voluntario que aceitou ajudar, está opção só será permitida para chamados aceitos pelo usuario logado
        ou seja ele pode aceitar ajudar e por algum motivo não mais aceitar, sendo assim ele podera retirar sua ajuda*/
        public function setConcluirAjuda($lanc_id)
        {
            $sql =" UPDATE tab_lancamentos SET 
                user_id_concluido=:user_id_concluido,
                ip_lancamento_concluido=:ip_lancamento_concluido,
                lanc_status_solicitacao=1,
                lanc_datahoraconcluido=now()
            WHERE
                lanc_id=:lanc_id AND user_id_voluntario=:user_id_voluntario";
                   
            try
            {
              $sql = $this->db->prepare($sql);                        				    
              $sql->bindValue(":user_id_concluido", $_SESSION['user_id']);          //Id do voluntario que cancelar ajuda deve ser o mesmo que esta vinculado no chamado e deve estar logad                            
              $sql->bindValue(":ip_lancamento_concluido", $_SERVER['REMOTE_ADDR']);
              $sql->bindValue(":lanc_id", $lanc_id);
              $sql->bindValue(":user_id_voluntario", $_SESSION['user_id']);        //Somente o Voluntário pode concluir seus aceites de ajuda ou também o Dono do Lançamento.    
              $sql->execute();

            }
            catch(PDOException $e)
            {
                echo "Erro setar conclusao da ajuda  .: ".$e->getMessage();
                exit;
            }

        }

    

    }

?>