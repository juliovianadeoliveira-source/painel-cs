<?php header("Content-Type: text/html; charset=ISO-8859-1",true);?>
<?php
///--- bloqueia ip
$servidor = "localhost";
    $usuario = "painel";
    $senha = "brunocs";
    $dbname = "bkp_ips";




    $a = getip();
    //$endereco = mysqli_real_escape_string($con, $a);
    
    $con = mysqli_connect($servidor, $usuario, $senha, $dbname );

        $result_usuario = "SELECT * FROM ips_teste WHERE endereco_ip = '$a'";
        $resultado_usuario = mysqli_query($con, $result_usuario);
        $resultado = mysqli_fetch_assoc($resultado_usuario);
        
        //Encontrando um usuário na tabela usuario com os mesmos dados digitado pelo usuario
        if(isset($resultado)){
            echo "
                <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://google.com.br/'>
                <script type=\"text/javascript\">
                    alert(\"VOCE JÁ SOLICITOU SEU TESTE. COMPRE JÁ SEU PLANO\");
                </script>
            ";             
        }else{            
            $result_usuario = "INSERT INTO ips_teste (endereco_ip, data_cadastrada) VALUES ('$a',NOW())";
            $resultado_usuario = mysqli_query($con, $result_usuario);   

            $sql = "DELETE  FROM ips_teste where data_cadastrada <= date_sub(now(), interval 7 day);";
            $resultado = mysqli_query($con, $sql);  
        }
    
function getIp(){
 
    if (!empty($_SERVER['HTTP_CLIENT_IP']))
    { 
        $ip = $_SERVER['HTTP_CLIENT_IP']; 
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
    { 
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR']; 
    }
    else{ 
        $ip = $_SERVER['REMOTE_ADDR']; 
    } 
    return $ip;

 
}
//$a = getip();
//echo '<h1>'.$a.'</h1>';




///---- 
include("conexao.php");
include_once("functions.php");

include_once(Idioma(1));
$idioma = empty($_COOKIE['idioma']) ? "br" : $_COOKIE['idioma'];
$lang = empty($_GET['lang']) ? "" : $_GET['lang'];
if(!empty($lang)) SalvarIdioma($lang);
global $_TRA;
$VerificarInfoSite = VerificarInfoSite();


//Remove os cookies
unset($_SESSION['id'], $_SESSION['usuario'], $_SESSION['acesso']);

$GET = empty($_GET['r']) ? "" : $_GET['r'];
$CadUser = UrlTeste(2, $GET);

//Verificar se o revendedor tem acessos para criar testes
$grupo = "N";
$SQLUrlT = "SELECT RevUrldeTeste FROM rev WHERE CadUser = :CadUser AND grupo = :grupo";
$SQLUrlT = $painel_acessos->prepare($SQLUrlT);
$SQLUrlT->bindParam(':CadUser', $CadUser, PDO::PARAM_STR);
$SQLUrlT->bindParam(':grupo', $grupo, PDO::PARAM_STR);
$SQLUrlT->execute();
$LnUrlT = $SQLUrlT->fetch();
$RevUrldeTeste = $LnUrlT['RevUrldeTeste'];

$VerTeste = VerTeste($CadUser);
$TempoDias = $VerTeste[1] > 1 ? $_TRA['dias'] : $_TRA['dia'];

if( ($VerTeste[0] == 1) && ($RevUrldeTeste == "S") ){
	

$SQL = "SELECT status FROM captcha";
$SQL = $painel_geral->prepare($SQL);
$SQL->execute();
$Ln = $SQL->fetch();
$StatusCaptcha = $Ln['status'];
?>

<!DOCTYPE html>
<html lang="<?php echo $idioma; ?>" class="body-full-height">
    <head>        
        <!-- META SECTION -->
        <title><?php echo $VerificarInfoSite[0]; ?></title>            
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        
        <link rel="icon" href="favicon.ico" type="image/x-icon" />
        <!-- END META SECTION -->
        
        <!-- CSS INCLUDE -->        
        <link rel="stylesheet" type="text/css" id="theme" href="css/<?php echo $VerificarInfoSite[2]; ?>.css"/>
        <!-- EOF CSS INCLUDE -->                               
    </head>
    <body>
        
        <div class="registration-container">            
            <div class="registration-box animated fadeInDown">
                <div class="registration-logo"><?php echo $VerificarInfoSite[0]; ?></div>
				<div class="registration-legenda"><?php echo $VerificarInfoSite[1]; ?></div>
                <div class="registration-body">
                    <div class="registration-title"><strong><?php echo $_TRA['ct']; ?></strong>, <?php echo $VerTeste[1]." ".$TempoDias; ?></div>
                                        
                    <form action="javascript:MDouglasMS();" class="TesteCadastrar form-horizontal" method="post" id="FormLogin">
                    
                    <h4>Opção</h4>
                    <div class="form-group">
                    	<div class="col-md-12">                                        
                    		<select class="form-control select" id="OpcaoForm" name="OpcaoForm">
								<option value="T">Criar Teste</option>
								<option value="D">Descontar Cupom</option>
                    		</select>
                    	</div>
                    </div>
                    
                    <h4><?php echo $_TRA['dp']; ?></h4>
                    <div class="form-group">
                        <div class="col-md-12">
                            <input name="nome" id="nome" type="text" class="form-control" placeholder="<?php echo $_TRA['nome']; ?>"/>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-md-12">
                            <input name="email" id="email" type="text" class="form-control" placeholder="<?php echo $_TRA['email']; ?>"/>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-md-12">
                            <input id="EditarCelular" name="EditarCelular" type="text" class="form-control" placeholder="WhatsApp " />
                        </div>
                    </div>
                    
                    <span id="StatusOpcao">
                    	<h4><?php echo $_TRA['Operadora']; ?></h4>
                    	<div class="form-group">
                    		<div class="col-md-12">                                        
                        		<select class="form-control select" id="Operadora" name="Operadora">
								<?php echo SelectOperadora($CadUser); ?>
                            	</select>
                         	</div>
                    	</div>
                    </span>
                    
                    <?php
					if($StatusCaptcha == "S"){
					?>
                    <div class="form-group">
                   		<center>
                   	 		<div id="StatusCaptcha">
           						<?php include "CaptchaImg.php"; ?>
           					</div>
                        </center>
                    </div>
                    
                    <div class="form-group pointer" onClick="NovoCaptcha()">
                   	 	<div class="col-md-12 text-right">
                    		Novo Captcha
                    	</div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="text" name="captcha" id="captcha" class="form-control" placeholder="Digite o Captcha"/>
                        </div>
                    </div>
                    <?php
					}
					?>
                                         
                    <div class="form-group push-up-30">
                        <div class="col-md-12">
                        	<div id="StatusCadastro"></div>
                            <input name="r" id="r" type="hidden" value="<?php echo $GET; ?>"/>
                            <button onClick="CriarTesteAutomatico()" class="CadastrarTeste btn btn-danger btn-block"><?php echo $_TRA['ct']; ?></button>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="registration-footer">
                    <div class="pull-left">
                        &copy; 2017 <?php echo $VerificarInfoSite[0]; ?>
                    </div>
                    <div class="pull-right">
                       <?php echo $_TRA['Programador']; ?> # <?php echo $VerificarInfoSite[0]; ?>
                    </div>
                </div>
            </div>
            
        </div>
        
        <div id="StatusGeral"></div>  
        
 		 <!-- START PLUGINS -->
        <script type="text/javascript" src="js/plugins/jquery/jquery.min.js"></script>
        <script src="js/jquery.maskedinput.js"></script>
        
        <script type="text/javascript" src="js/plugins/jquery/jquery-ui.min.js"></script>
        <script type="text/javascript" src="js/plugins/bootstrap/bootstrap.min.js"></script>
        <!-- END PLUGINS -->
  		
        <script type='text/javascript' src='js/plugins/bootstrap/bootstrap-select.js'></script>        

        
        <script type="text/javascript" src="js/plugins.js"></script>
        <script type="text/javascript" src="js/actions.js"></script>
        <!-- END TEMPLATE -->
              
    </body>
</html>

<script type="text/javascript">
jQuery("input#EditarCelular")
        .mask("(99) 9999-9999?9")
        .focusout(function (event) {  
            var target, phone, element;  
            target = (event.currentTarget) ? event.currentTarget : event.srcElement;  
            phone = target.value.replace(/\D/g, '');
            element = $(target);  
            element.unmask();  
            if(phone.length > 10) {  
                element.mask("(99) 99999-999?9");  
            } else {  
                element.mask("(99) 9999-9999?9");  
            }  
});
	
<?php
if($StatusCaptcha == "S"){
?>
function NovoCaptcha(){
			
			panel_refresh($(".registration-container"));

			$.post('CaptchaImg.php', function(resposta) {
				
			setTimeout(panel_refresh($(".registration-container")),500);
				
			$("#StatusCaptcha").html('');
			$("#StatusCaptcha").html(resposta);
						
			});
				
}
<?php
}
?>

function CriarTesteAutomatico(){

 
	   var Data = $(".TesteCadastrar").serialize();
		 
		panel_refresh($(".registration-container"));
				
		$.post('EnviarCadTeste.php', Data, function(resposta) {
			
				setTimeout(panel_refresh($(".registration-container")),500);
			
				$("#StatusGeral").html('');
				$("#StatusGeral").append(resposta);

		});


}
	
$(function(){
	$(".TesteCadastrar select[name=OpcaoForm]").change(function(){
		
		var OpcaoForm = $(this).val();
		var CadUser = '<?php echo $CadUser; ?>';
		
		panel_refresh($(".registration-container"));
		
		$.post('ExibirSelectCadOpcao.php', {OpcaoForm: OpcaoForm, CadUser: CadUser}, function(resposta) {
			
				setTimeout(panel_refresh($(".registration-container")),500);
				
				$("#StatusOpcao").html('');
				$("#StatusOpcao").html(resposta);
		});
	});
});

</script>

<?php
}else{
	echo Redirecionar('login.php');
}







?>





