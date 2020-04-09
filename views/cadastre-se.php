<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Ajuda Voluntária</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" type="image/png" href="<?php echo BASE_URL; ?>assets/images/icon/favicon.ico">

    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/themify-icons.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/metisMenu.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/slicknav.min.css">
	
	<!-- others css -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/typography.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/default-css.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/styles.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/responsive.css">
    <!-- modernizr css -->
    <script src="<?php echo BASE_URL; ?>assets/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body class="body-bg">
    <div id="preloader">
        <div class="loader"></div>
	</div>
    <!-- preloader area end -->
    
    <!-- login area start -->
    <div class="login-area">
        <div class="container">
            <div class="login-box ptb--100">
                <form method="POST" action="<?php echo BASE_URL;?>login/cadastre_action">
                    
                    <div class="login-form-head">
                        <h4>Cadastre-se</h4>
                        <p>Cadastre-se e seja um Voluntário ou Peça Ajuda, vidas precisam de você.</p>
                    </div>
                    
                    <div class="login-form-body">

                        <div class="form-gp">
                            <?php if(!empty($msgErro)) : ;?>
                                <div class="alert alert-danger" role="alert">
                                    Atenção ! <?php echo $msgErro ;?>
                                </div>
                            <?php endif ;?>
                        </div>

                        <div class="form-gp">
                            <label for="txtnomecompleto">Nome Completo</label>
                            <input type="text" id="txtnomecompleto" name="txtnomecompleto" value="<?php echo (isset($txtnomecompleto) ? $txtnomecompleto : '') ;?>">
                            <i class="ti-user"></i>
                            <div class="text-info"></div>
                        </div>

                        <div class="form-gp">
                            <label for="txtcelular">Celular com WhatsApp</label>
                            <input type="text" id="txtcelular" name="txtcelular" maxlength="14" value="<?php echo (isset($txtcelular) ? $txtcelular : '') ;?>">                            
                            <i class="fa fa-phone"></i>
                            <!-- <div class="text-info">*Formato (00)00000-0000</div> -->
                            <!-- SEM AUTO COMPLETE <input type="text" id="txtcelular" name="txtcelular" maxlength="14" autocomplete="off"> -->
                        </div>

                        <div class="form-gp">
                            <label for="txtemail">E-mail</label>
                            <input type="email" id="txtemail" name="txtemail" value="<?php echo (isset($txtemail) ? $txtemail : '') ;?>">
                            <i class="ti-email"></i>
                            <div class="text-info"></div>
                        </div>

                        <div class="form-gp">
                            <label for="txtsenhaacesso">Senha de acesso</label>
                            <input type="password" id="txtsenhaacesso" name="txtsenhaacesso">
                            <i class="ti-lock"></i>
                            <div class="text-info">* mínimo 6 caracteres</div>
                        </div>

                        <div class="form-gp">
                            <label for="txtsenhaacessoconfirma">Confirme a senha de acesso</label>
                            <input type="password" id="txtsenhaacessoconfirma" name="txtsenhaacessoconfirma">
                            <i class="ti-lock"></i>
                            <div class="text-info"></div>
                        </div>
                    
                        <div class="form-gp">
                            <label for="txtcep">Cep</label>
                            <input type="text" id="txtcep" name="txtcep" maxlength="9" placeholder="99999-999" value="<?php echo (isset($txtcep) ? $txtcep : '') ;?>">
                            <i class="fa fa-font"></i>
                            <!-- <div class="text-info">*Formato 00000-000</div> -->
                            <div id="divtxtceperror" class="text-danger"></div>
                        </div>

                        <?php 
                            /*Se não existe estado, cria um default para evitar erro*/
                            if(!isset($txtestado)) {$txtestado = 'MT';} ?>

                        <div class="form-gp">
                            <label for="txtestado">Estado</label><br>
                            <select class="custom-select" id="txtestado" name="txtestado">                               
                                <option <?php echo ($txtestado == 'AC') ? 'selected':'' ;?> value="AC">Acre</option>
                                <option <?php echo ($txtestado == 'AL') ? 'selected':'' ;?> value="AL">Alagoas</option>
                                <option <?php echo ($txtestado == 'AP') ? 'selected':'' ;?> value="AP">Amapá</option>
                                <option <?php echo ($txtestado == 'AM') ? 'selected':'' ;?> value="AM">Amazonas</option>
                                <option <?php echo ($txtestado == 'BA') ? 'selected':'' ;?> value="BA">Bahia</option>
                                <option <?php echo ($txtestado == 'CE') ? 'selected':'' ;?> value="CE">Ceará</option>
                                <option <?php echo ($txtestado == 'DF') ? 'selected':'' ;?> value="DF">Distrito Federal</option>
                                <option <?php echo ($txtestado == 'ES') ? 'selected':'' ;?> value="ES">Espirito Santo</option>
                                <option <?php echo ($txtestado == 'GO') ? 'selected':'' ;?> value="GO">Goiás</option>
                                <option <?php echo ($txtestado == 'MA') ? 'selected':'' ;?> value="MA">Maranhão</option>
                                <option <?php echo ($txtestado == 'MS') ? 'selected':'' ;?> value="MS">Mato Grosso do Sul</option>
                                <option <?php echo ($txtestado == 'MT') ? 'selected':'' ;?> value="MT">Mato Grosso</option>
                                <option <?php echo ($txtestado == 'MG') ? 'selected':'' ;?> value="MG">Minas Gerais</option>
                                <option <?php echo ($txtestado == 'PA') ? 'selected':'' ;?> value="PA">Pará</option>
                                <option <?php echo ($txtestado == 'PB') ? 'selected':'' ;?> value="PB">Paraíba</option>
                                <option <?php echo ($txtestado == 'PR') ? 'selected':'' ;?> value="PR">Paraná</option>
                                <option <?php echo ($txtestado == 'PE') ? 'selected':'' ;?> value="PE">Pernambuco</option>
                                <option <?php echo ($txtestado == 'PI') ? 'selected':'' ;?> value="PI">Piauí</option>
                                <option <?php echo ($txtestado == 'RJ') ? 'selected':'' ;?> value="RJ">Rio de Janeiro</option>
                                <option <?php echo ($txtestado == 'RN') ? 'selected':'' ;?> value="RN">Rio Grande do Norte</option>
                                <option <?php echo ($txtestado == 'RS') ? 'selected':'' ;?> value="RS">Rio Grande do Sul</option>
                                <option <?php echo ($txtestado == 'RO') ? 'selected':'' ;?> value="RO">Rondônia</option>
                                <option <?php echo ($txtestado == 'RR') ? 'selected':'' ;?> value="RR">Roraima</option>
                                <option <?php echo ($txtestado == 'SC') ? 'selected':'' ;?> value="SC">Santa Catarina</option>
                                <option <?php echo ($txtestado == 'SP') ? 'selected':'' ;?> value="SP">São Paulo</option>
                                <option <?php echo ($txtestado == 'SE') ? 'selected':'' ;?> value="SE">Sergipe</option>
                                <option <?php echo ($txtestado == 'TO') ? 'selected':'' ;?> value="TO">Tocantins</option>
                            </select>                            
                        </div>

                        <div class="form-gp">
                            <label for="txtcidade">Cidade</label>
                            <input type="text" id="txtcidade" name="txtcidade" value="<?php echo (isset($txtcidade) ? $txtcidade : '') ;?>">
                            <i class="fa fa-font"></i>
                            <div class="text-info"></div>
                        </div>

                        <div class="form-gp">
                            <label for="txtbairro">Bairro</label>
                            <input type="text" id="txtbairro" name="txtbairro" value="<?php echo (isset($txtbairro) ? $txtbairro : '') ;?>">
                            <i class="fa fa-font"></i>
                            <div class="text-info"></div>
                        </div>

                        <div class="form-gp">   
                            <?php                                 
                                    //Numeros Aleatorios a cada refresh se alteram
                                    $_SESSION['$numero1_confirmacao'] = rand(1,10);
                                    $_SESSION['$numero2_confirmacao'] = rand(1,6);

                                    //Armazeno o resultado também em uma sessão para comparar com o enviado pelo Usuário pelo campo txtconfirmacao
                                    $_SESSION['resultado_confirmacao_cadastro'] = $_SESSION['$numero1_confirmacao'] + $_SESSION['$numero2_confirmacao'];        
                                    
                                    //Mostrando ao usuário para ele responder com o resultado
                                    echo '<div class="alert alert-info text-center" role="alert">';
                                    echo '<strong>'.$_SESSION['$numero1_confirmacao']." + ".$_SESSION['$numero2_confirmacao'] . " = </strong>";
                                    echo '</div>'
                            ?>
                        </div>

                        <div class="form-gp">                               
                            <label for="txtconfirmacao_cadastro">informe o Resultado</label>
                            <input type="text" id="txtconfirmacao_cadastro" name="txtconfirmacao_cadastro">
                            <i class="fa fa-font"></i> 
                            <div class="text-info"></div>
                        </div>

                        <div class="submit-btn-area">
                            <button id="form_submit" type="submit">Cadastrar <i class="ti-arrow-right"></i></button>
                        </div>

                        <div class="form-footer text-center mt-5">
                            <p class="text-muted">Já tem uma conta ? <a href="<?php echo BASE_URL;?>login">Entre</a></p>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- login area end -->
		
	<!-- jquery latest version --> 
    <script src="<?php echo BASE_URL; ?>assets/js/vendor/jquery-2.2.4.min.js"></script>
    <!-- bootstrap 4 js -->
    <script src="<?php echo BASE_URL; ?>assets/js/popper.min.js"></script>
    <script src="<?php echo BASE_URL; ?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo BASE_URL; ?>assets/js/owl.carousel.min.js"></script>
    <script src="<?php echo BASE_URL; ?>assets/js/metisMenu.min.js"></script>
    <script src="<?php echo BASE_URL; ?>assets/js/jquery.slimscroll.min.js"></script>
    <script src="<?php echo BASE_URL; ?>assets/js/jquery.slicknav.min.js"></script>

    <!-- Utilitarios -->
    <script src="<?php echo BASE_URL; ?>assets/js/jquery.mask.js"></script>
    <script src="<?php echo BASE_URL; ?>assets/js/scripts.js"></script>
    <script src="<?php echo BASE_URL; ?>assets/js/utils.js"></script>
</body>

</html>
