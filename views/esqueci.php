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
                <form method="POST" action="<?php echo BASE_URL;?>login/esqueci_action">
                    
                    <div class="login-form-head">
                        <h4>Esqueci minha senha</h4>
                        <p>Informe o nº de celular cadastrado.</p>
                        <hr>
                        <p>Informe o nº de celular cadastrado.</p>
                        <p>Se for encontrado em nossa base de dados receberá em seu e-mail um link para redefinição de senha.</p>
                    </div>

                    <div class="login-form-body">
                        <!--
                         <div class="form-gp">
                            <label for="txtemail">E-mail</label>
                            <input type="email" id="txtemail" name="txtemail">
                            <i class="ti-email"></i>
                            <div class="text-danger"></div>
                        </div>
                        -->
                        
                        <div class="form-gp">
                            <?php if(!empty($msgErro)) : ;?>
                                <div class="alert alert-danger" role="alert">
                                    Atenção ! <?php echo $msgErro ;?>
                                </div>
                            <?php endif ;?>
                        </div>

                        <div class="form-gp">
                            <?php if(!empty($msgSucesso)) : ;?>
                                <div class="alert alert-success" role="alert">
                                    Atenção ! <?php echo $msgSucesso ;?>
                                </div>
                            <?php endif ;?>
                        </div>

                        <div class="form-gp">
                            <label for="txtcelular">Celular de cadastro</label>
                            <input type="text" id="txtcelular" name="txtcelular" maxlength="14"> 
                            <i class="fa fa-phone"></i>
                            <div class="text-danger"></div>
                        </div>

                        <div class="form-gp">   
                            <?php                                 
                                    //Numeros Aleatorios a cada refresh se alteram
                                    $_SESSION['$numero1_confirmacao'] = rand(1,10);
                                    $_SESSION['$numero2_confirmacao'] = rand(1,6);

                                    //Armazeno o resultado também em uma sessão para comparar com o enviado pelo Usuário pelo campo txtconfirmacao
                                    $_SESSION['resultado_confirmacao_esqueci'] = $_SESSION['$numero1_confirmacao'] + $_SESSION['$numero2_confirmacao'];        
                                    
                                    //Mostrando ao usuário para ele responder com o resultado
                                    echo '<div class="alert alert-info text-center" role="alert">';
                                    echo '<strong>'.$_SESSION['$numero1_confirmacao']." + ".$_SESSION['$numero2_confirmacao'] . " = </strong>";
                                    echo '</div>'
                            ?>
                        </div>

                        <div class="form-gp">                               
                            <label for="txtconfirmacao_cadastro">informe o Resultado</label>
                            <input type="text" id="txtconfirmacao_esqueci" name="txtconfirmacao_esqueci">
                            <i class="fa fa-font"></i> 
                            <div class="text-info"></div>
                        </div>

                        <div class="submit-btn-area mt-5">
                            <button id="form_submit" type="submit">Recuperar senha <i class="ti-arrow-right"></i></button>
                        </div>

                        <div class="form-footer text-center mt-5">
                           <a href="<?php echo BASE_URL;?>login">Voltar</a>
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
