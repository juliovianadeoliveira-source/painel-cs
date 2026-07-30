<?php
include("conexao.php");
include_once("functions.php");
include_once(Idioma(1));
if(ProtegePag() == true){
global $_TRA;

$error       = false;
$ds          = DIRECTORY_SEPARATOR; 
$storeFolder = 'img'.$ds.'foto';
 
if (!empty($_FILES) && $_FILES['file']['tmp_name']) {    
    
    $tempFile = $_FILES['file']['tmp_name'];
	
	$ex = explode(".",$_FILES['file']['name']);
	$extensao = end($ex);
    $fileName = time().'_'.sha1($_FILES['file']['name'].time()).'.'.$extensao;
    
    // check image type
    $allowedTypes = array(IMAGETYPE_JPEG, IMAGETYPE_GIF, IMAGETYPE_PNG);// list of allowed image types
    $detectedType = exif_imagetype($tempFile);
    $error = !in_array($detectedType, $allowedTypes);
    // end of check
    
    if(!$error){
        
        $targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;     
        $targetFile =  $targetPath. $fileName;
        
        if(move_uploaded_file($tempFile,$targetFile)){
			
		//Verifica a imagem atual e deleta dos arquivos
		$id_user = InfoUser(1);
		$usuario = InfoUser(2);
		$SQLUser = "SELECT `foto` FROM ".SelectTabela()." WHERE `id` = :id AND `usuario` = :usuario";
		$SQLUser = $painel_user->prepare($SQLUser);
		$SQLUser->bindParam(':id', $id_user, PDO::PARAM_INT);
		$SQLUser->bindParam(':usuario', $usuario, PDO::PARAM_STR);
		$SQLUser->execute();
		$LnUser = $SQLUser->fetch();
		
		if(!empty($LnUser['foto'])) unlink($storeFolder.$ds.$LnUser['foto']);

        echo '<div class="cropping-image-wrap"><img src="'.$storeFolder.$ds.$fileName.'" class="img-thumbnail" id="crop_image" value="'.$fileName.'"/></div>';
        }
        
    }else{
        echo '<div class="alert alert-danger">'.$_TRA['efins'].'</div>';
    }
}else{
    echo '<div class="alert alert-danger">'.$_TRA['cvfi'].' O_o</div>';
}



}else{
	echo Redirecionar('login.php');
}	
?>     
