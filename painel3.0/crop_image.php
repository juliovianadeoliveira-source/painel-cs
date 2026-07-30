<?php
include("conexao.php");
include_once("functions.php");

include("image_resizing.php");
$imgr = new imageResizing();

if($_POST['cp_img_path']){    
	
	$ds          = DIRECTORY_SEPARATOR; 
	
    $image = $_POST['cp_img_path'];
    $imgr->load($image);
    
    $imgX = intval($_POST['ic_x']);
    $imgY = intval($_POST['ic_y']);
    $imgW = intval($_POST['ic_w']);
    $imgH = intval($_POST['ic_h']);
    
    $imgr->resize($imgW,$imgH,$imgX,$imgY);    
    
    $imgr->save($image);
	
	$filename = basename($_POST['cp_img_path']);
	
	//Atualiza a imagem no banco de dados
	$id_user = InfoUser(1);
	$usuario = InfoUser(2);
	$SQL = "UPDATE ".SelectTabela()." SET
			foto = :foto
            WHERE id = :id AND usuario = :usuario";
	$SQL = $painel_user->prepare($SQL);
	$SQL->bindParam(':foto', $filename, PDO::PARAM_STR); 
	$SQL->bindParam(':id', $id_user, PDO::PARAM_INT); 
	$SQL->bindParam(':usuario', $usuario, PDO::PARAM_STR); 
	$SQL->execute(); 
	
	$_SESSION['foto'] = $filename;
	
    echo '<img src="'.$_POST['cp_img_path'].'?t='.time().'" class="img-thumbnail"/>';
}
?>     
