<?php
include("conexao.php");
include_once("functions.php");
include_once(Idioma(1));
if(ProtegePag() == true){
global $_TRA;

$mensagem = empty($_POST['mensagem']) ? "" : $_POST['mensagem'];
$assunto = empty($_POST['assunto']) ? "" : $_POST['assunto'];
$anexo = empty($_FILES['anexo']) ? "" : $_FILES['anexo'];
$UserEmissor = InfoUser(2);
$Comprovante = empty($_POST['Comprovante']) ? "" : $_POST['Comprovante'];
	
	if(empty($assunto)){
		echo MensagemAlerta($_TRA['erro'], $_TRA['aeuco'], "danger");
	}
	elseif(empty($mensagem)){
		echo MensagemAlerta($_TRA['erro'], $_TRA['meuco'], "danger");
	}
	elseif($mensagem == "<p><br></p>"){
		echo MensagemAlerta($_TRA['erro'], $_TRA['meuco'], "danger");
	}
	else{

	if(!empty($_FILES) && $anexo['tmp_name']){ 
	
	$error       = false;
	$ds          = DIRECTORY_SEPARATOR; 
	$storeFolder = 'suporte'.$ds;
	$NomeAnexo = '';
	
	// check image type
	$tempFile = $anexo['tmp_name'];
    $allowedTypes = array(IMAGETYPE_JPEG, IMAGETYPE_GIF, IMAGETYPE_PNG);// list of allowed image types
    $detectedType = exif_imagetype($tempFile);
    $error = !in_array($detectedType, $allowedTypes);
    // end of check

	$ex = explode(".",$anexo['name']);
	$extensao = end($ex);
	
	$fileName = time().'_'.sha1($anexo['name'].time()).'.'.$extensao;
			
	if( ($extensao == "pdf") || ($extensao == "doc") || ($extensao == "docm") ) $error = false;
		if(!$error){
			
			$targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;     
       		$targetFile =  $targetPath. $fileName;
			
			if(move_uploaded_file($tempFile,$targetFile)){
				$NomeAnexo = $fileName;
        	}
		 
		}
		else{
			echo MensagemAlerta($_TRA['erro'], $_TRA['paanfjpgpd'], "danger");
			exit;
		}
	}
	
	//Inserir Resposta
	$VerificarInfoOnline = VerificarInfoOnline();
	$UserReceptor = $VerificarInfoOnline[7];
	
	$SalvarMarcacao = $Comprovante == "S" ? 2 : 5;
	
	$data = time();
	$LidaEmissor = "S";
	$SQL = "INSERT INTO suporte (
			UserEmissor,
			UserReceptor,
            Assunto,
            data,
			anexo,
			Mensagem,
			LidaEmissor,
			Marcacao
			) VALUES (
            :UserEmissor,
			:UserReceptor,
            :Assunto,
            :data,
			:anexo,
			:Mensagem,
			:LidaEmissor,
			:Marcacao
			)";
	$SQL = $painel_geral->prepare($SQL);
	$SQL->bindParam(':UserEmissor', $UserEmissor, PDO::PARAM_STR);
	$SQL->bindParam(':UserReceptor', $UserReceptor, PDO::PARAM_STR);
	$SQL->bindParam(':Assunto', $assunto, PDO::PARAM_STR);
	$SQL->bindParam(':data', $data, PDO::PARAM_STR);
	$SQL->bindParam(':anexo', $NomeAnexo, PDO::PARAM_STR);
	$SQL->bindParam(':Mensagem', $mensagem, PDO::PARAM_STR);
	$SQL->bindParam(':LidaEmissor', $LidaEmissor, PDO::PARAM_STR);
	$SQL->bindParam(':Marcacao', $SalvarMarcacao, PDO::PARAM_STR);
	$SQL->execute(); 
	
	if(empty($SQL)){
		echo MensagemAlerta($_TRA['erro'], $_TRA['erropro'], "danger");
	}
	else{
		echo MensagemAlerta($_TRA['sucesso'], $_TRA['mecs'], "success", "index.php?p=suporte");
	}


	}
}else{
	echo Redirecionar('login.php');
}	
?>