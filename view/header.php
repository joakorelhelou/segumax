<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title><?php echo $title; ?></title>
	<meta name="author" content="Joaquín Rodriguez Elhelou">
	<link href="/img/favicon.png" type="image/x-icon" rel="icon" />
    <link href="/img/favicon.png" type="image/x-icon" rel="shortcut icon">
    <link rel="apple-touch-icon" href="/img/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/img/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/img/apple-touch-icon-114x114.png">

    <?php if($role == 0){ ?>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css" />
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="../css/bootstrap-responsive.css" />
	<link rel="stylesheet" type="text/css" href="../css/bootstrap-responsive.min.css" />
	<link rel="stylesheet" type="text/css" href="../css/styles.css" />
	<?php }else { ?>
	<link rel="stylesheet" type="text/css" href="../../css/bootstrap.css" />
	<link rel="stylesheet" type="text/css" href="../../css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="../../css/bootstrap-responsive.css" />
	<link rel="stylesheet" type="text/css" href="../../css/bootstrap-responsive.min.css" />
	<link rel="stylesheet" type="text/css" href="../../css/styles.css" />
	<link rel="stylesheet" type="text/css" href="../../css/jquery-ui.css" />
	<link rel="stylesheet" type="text/css" href="../../css/table-sort.css" />
	
	<?php } ?>
</head>
<body>
<?php
if(isset($role) && isset($page))
{
	if($role == 0){ ?>
<div class="navbar navbar-fixed-top">
    	<div class="navbar-inner">
    		<div class="container">
    			    <ul class="nav">
    			    	<a class="brand" href="#">SeguMax</a>
    					<li <?php if($page == 1) echo 'class="active"' ?>> <a href="login.php">Inicio</a></li>
    					<li class="divider-vertical"></li>
 						<li  <?php if($page == 2) echo 'class="active"' ?>><a href="about.php">Acerca de</a></li>
 						<li class="divider-vertical"></li>
 						<li <?php if($page == 3) echo 'class="active"' ?>><a href="services.php">Servicios</a></li>
 						<li class="divider-vertical"></li>
   					 </ul>
    					<ul class="nav pull-right">
	    					<li class="divider-vertical"></li>
							<li><a href="login.php">Iniciar sesión</a></li>
	    					<li class="divider-vertical"></li>
						</ul>
    		</div>
    	</div>
 </div>
<?php	}elseif ($role == 1){ ?>
		<div class="navbar navbar-fixed-top">
    	<div class="navbar-inner">
    		<div class="container">
    			    <ul class="nav">
    			    	<a class="brand" href="#">SeguMax</a>
    					<li <?php if($page == 1) echo 'class="active"' ?>> <?php if($page > 1){ ?> <a href="../admin/main.php">
    						<?php } else { ?> <a href="main.php"> <?php } ?> Panel</a></li>
    					 <li class="divider-vertical"></li>
 						<li <?php if($page == 2) echo 'class="active"' ?>><a href="../producer/list.php">Productores</a></li>
 						 <li class="divider-vertical"></li>
    					<li <?php if($page == 3) echo 'class="active"' ?>><a href="../company/list.php">Companías</a></li>
    					 <li class="divider-vertical"></li>
    					 <li <?php if($page == 4) echo 'class="active"' ?>><a href="../rfc/list.php">Solicitudes</a></li>
    					 <li class="divider-vertical"></li>
    					 <li <?php if($page == 5) echo 'class="active"' ?>><a href="../coverage/list.php">Coberturas</a></li>
    					 <li class="divider-vertical"></li>
    					 <li <?php if($page == 6) echo 'class="active"' ?>><a href="../customer/list.php">Clientes</a></li>
    					 <li class="divider-vertical"></li>
						 <li <?php if($page == 7) echo 'class="active"' ?>><a href="../admin/list.php">Administradores</a></li>
    					 <li class="divider-vertical"></li>
   					 </ul>
   					 <ul class="nav pull-right">
	  					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user icon-white"></i> <b class="caret"></b></a>
						<ul class="dropdown-menu">
						<li><p style="text-align: center; padding-top: 10px; font-weight: bold; color: #333;"><? echo $_SESSION['userData']['name'].' '.$_SESSION['userData']['surname']; ?><br />
						<span style="color: #999;font-weight: normal;"><? echo $_SESSION['userData']['role']; ?></span></p></li>							
						<li class="divider"></li>
						<li><a href="../admin/view.php?id=<?php echo $_SESSION['userData']['id'] ?>">Perfil</a></li>
						<li><a href="../../index.php?logout=1">Salir</a></li>
						</ul>
						</li>
				</ul>
    		</div>
    	</div>
    </div>

<?php }elseif ($role == 2){ ?>
		<div class="navbar navbar-fixed-top">
    	<div class="navbar-inner">
    		<div class="container">
    			    <ul class="nav">
    			    	<a class="brand" href="#">SeguMax</a>
    					<li <?php if($page == 1) echo 'class="active"' ?>> <?php if($page > 1){ ?> <a href="../producer/main.php">
    						<?php } else { ?> <a href="main.php"> <?php } ?> Panel</a></li>
    					 <li class="divider-vertical"></li>
 						<li <?php if($page == 2) echo 'class="active"' ?>><a href="../company/list.php">Companías</a></li>
 						 <li class="divider-vertical"></li>
    					<li <?php if($page == 3) echo 'class="active"' ?>><a href="../rfc/list.php">Solicitudes</a></li>
    					 <li class="divider-vertical"></li>
    					 <li <?php if($page == 4) echo 'class="active"' ?>><a href="../customer/list.php">Clientes</a></li>
    					 <li class="divider-vertical"></li>    			
 						 <li <?php if($page == 5) echo 'class="active"' ?>><a href="../coverage/list.php">Coberturas</a></li>
 						 <li class="divider-vertical"></li>

   					 </ul>
   					 <ul class="nav pull-right">
   					 	<li><a href="../../help/producer.doc"><i class="icon-question-sign icon-white"></i></a></li>
	  					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user icon-white"></i> <b class="caret"></b></a>
						<ul class="dropdown-menu">
						<li><p style="text-align: center; padding-top: 10px; font-weight: bold; color: #333;"><? echo $_SESSION['userData']['name'].' '.$_SESSION['userData']['surname']; ?><br />
						<span style="color: #999;font-weight: normal;"><? echo $_SESSION['userData']['role']; ?></span></p></li>							
						<li class="divider"></li>
						<li><a href="../producer/view.php?id=<?php echo $_SESSION['userData']['id'] ?>">Perfil</a></li>
						<li><a href="../../index.php?logout=1">Salir</a></li>
						</ul>
						</li>
				</ul>
    		</div>
    	</div>
    </div>

<?php }elseif ($role == 3){ ?>
		<div class="navbar navbar-fixed-top">
    	<div class="navbar-inner">
    		<div class="container">
    			    <ul class="nav">
    			    	<a class="brand" href="#">SeguMax</a>
    					<li <?php if($page == 1) echo 'class="active"' ?>> <?php if($page > 1){ ?> <a href="../company/main.php">
    						<?php } else { ?> <a href="main.php"> <?php } ?> Panel</a></li>
    					 <li class="divider-vertical"></li>
 						<li <?php if($page == 2) echo 'class="active"' ?>><a href="../coverage/list.php">Coberturas</a></li>
 						 <li class="divider-vertical"></li>
    					<li <?php if($page == 3) echo 'class="active"' ?>><a href="../rfc/list.php">Solicitudes</a></li>
    					 <li class="divider-vertical"></li>	
   					 </ul>
   					 <ul class="nav pull-right">
   					 	<li><a href="../../help/company.doc"><i class="icon-question-sign icon-white"></i></a></li>
	  					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user icon-white"></i> <b class="caret"></b></a>
						<ul class="dropdown-menu">
						<li><p style="text-align: center; padding-top: 10px; font-weight: bold; color: #333;"><? echo $_SESSION['userData']['name'].' '.$_SESSION['userData']['surname']; ?><br />
						<span style="color: #999;font-weight: normal;"><? echo $_SESSION['userData']['role']; ?></span></p></li>							
						<li class="divider"></li>
						<li><a href="../company/view.php?id=<?php echo $_SESSION['userData']['id'] ?>">Perfil</a></li>
						<li><a href="../../index.php?logout=1">Salir</a></li>
						</ul>
						</li>
				</ul>
    		</div>
    	</div>
    </div> 
<?php }
 } ?>
 	<div class="title-wrapper">
	<div class="container">
		<div class="row">
			<div class="span12">
				<h2 class="page-title"><?php echo $pageTitle ?></h2>
							</div>
					</div>
	</div>	
</div>
<div class="container">

	<div class="wrap">