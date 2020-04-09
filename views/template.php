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
    <!-- main wrapper start -->
    <div class="horizontal-main-wrapper">
        <!-- main header area start -->
        <div class="mainheader-area">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-3">
                        <div class="logo">
                            <a href="<?php echo BASE_URL; ?>home"><img src="<?php echo BASE_URL; ?>assets/images/icon/logo2.png" alt="logo"></a>
                        </div>
                    </div>	
                    
                    <!-- profile info & task notification -->
                    <div class="col-md-9 clearfix text-right">                        
                        <div class="clearfix d-md-inline-block d-block">
                            <div class="user-profile m-0">
                                <!-- <img class="avatar user-thumb" src="assets/images/author/avatar.png" alt="avatar"> -->
                                <h4 class="user-name dropdown-toggle" data-toggle="dropdown"><?php echo $viewData['usuario']['user_nomecompleto'];?> <i class="fa fa-angle-down"></i></h4>
                                <div class="dropdown-menu">                            
                                    <a class="dropdown-item" href="<?php echo BASE_URL; ?>usuario/editar">Meus Dados</a>
                                    <a class="dropdown-item" href="<?php echo BASE_URL;?>login/logout">Sair</a>
                                </div>
                            </div>
                        </div>
					</div>
                    <!-- end profile info & task notification -->
					
                </div>
            </div>
        </div>
        <!-- main header area end -->
        <!-- header area start -->
        <div class="header-area header-bottom">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-9  d-none d-lg-block">
                        <div class="horizontal-menu">
                            <nav>
                                <ul id="nav_menu">   
                                    <li><a href="<?php echo BASE_URL; ?>home"><i class="ti-dashboard"></i> <span>Início</span></a></li>

                                    <li>
                                        <a href="javascript:void(0)"><i class="fa fa-heartbeat"></i><span>Suas Solicitações</span></a>
                                        <ul class="submenu">
                                            <li><a href="<?php echo BASE_URL; ?>lancamento/add"><i class="fa fa-plus-square"></i>Solicitar Ajuda</a></li>
                                            <li><a href="<?php echo BASE_URL ;?>lancamento/suassolicitacoes"><i class="fa fa-th-list"></i>Suas Solicitações</a></li>
                                        </ul>
                                    </li>            
                                                            
									<li><a href="<?php echo BASE_URL; ?>usuario/editar"><i class="fa fa-edit"></i> <span>Meus Dados</span></a></li>
									<li><a href="<?php echo BASE_URL;?>login/logout"><i class="fa fa-sign-out"></i> <span>Sair</span></a></li>									
                                </ul>
                            </nav>
                        </div>
					</div>
					
                    <!-- mobile_menu -->
                    <div class="col-12 d-block d-lg-none">
                        <div id="mobile_menu"></div>
                    </div>
                </div>
            </div>
        </div>
		<!-- header area end -->
		
        <!-- page title area end -->
        <div class="main-content-inner">
            <div class="container">
                <!-- Content -->
				<?php $this->loadViewInTemplate($viewName, $viewData); ?>
				<!-- End Content -->
            </div>
        </div>
		<!-- main content area end -->
		
        <!-- footer area start-->
        <footer>
            <div class="footer-area">
                <p>© Copyright <?php echo date('Y') ;?>. Todos os direitos reservados. Template by <a href="https://colorlib.com/wp/" target="blank">Colorlib</a>.</p>
            </div>
        </footer>
        <!-- footer area end-->
    </div>
	<!-- main wrapper start -->
		
	<!-- jquery latest version --> 
    <script src="<?php echo BASE_URL; ?>assets/js/vendor/jquery-2.2.4.min.js"></script>
    <!-- bootstrap 4 js -->
    <script src="<?php echo BASE_URL; ?>assets/js/popper.min.js"></script>
    <script src="<?php echo BASE_URL; ?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo BASE_URL; ?>assets/js/owl.carousel.min.js"></script>
    <script src="<?php echo BASE_URL; ?>assets/js/metisMenu.min.js"></script>
    <script src="<?php echo BASE_URL; ?>assets/js/jquery.slimscroll.min.js"></script>
    <script src="<?php echo BASE_URL; ?>assets/js/jquery.slicknav.min.js"></script>
    <!-- others plugins -->
    <script src="<?php echo BASE_URL; ?>assets/js/plugins.js"></script>
    <script src="<?php echo BASE_URL; ?>assets/js/scripts.js"></script>
</body>

</html>
