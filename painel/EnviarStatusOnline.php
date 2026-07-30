<?php
include("conexao.php");
include_once("functions.php");
include_once(Idioma(1));
if(ProtegePag() == true){
    global $_TRA;

    $ColunaAcesso = array('StatusOnline');
    $VerificarAcesso = VerificarAcesso('status', $ColunaAcesso);
    $StatusOnline = $VerificarAcesso[0];

    $ColunaAdmin = array('UserBloquear');
    $VerificarAcesso = VerificarAcesso('user', $ColunaAdmin);
    $AdminBloquear = $VerificarAcesso[0];

    $ColunaTeste = array('TesteBloquear');
    $VerificarAcessoTeste = VerificarAcesso('teste', $ColunaTeste);
    $TesteBloquear = $VerificarAcessoTeste[0];

    if($StatusOnline == 'S'){

        $caduser = empty($_POST['caduser']) ? '' : $_POST['caduser'];
        $rev = empty($_POST['rev']) ? '' : $_POST['rev'];
        $status = empty($_POST['status']) ? '' : $_POST['status'];
        $perfil = empty($_POST['perfil']) ? '' : $_POST['perfil'];

        if(empty($caduser)){
            echo MensagemAlerta($_TRA['erro'], $_TRA['sur'], "danger");
        }
        elseif(empty($rev)){
            echo MensagemAlerta($_TRA['erro'], $_TRA['edr'], "danger");
        }
        elseif(empty($status)){
            echo MensagemAlerta($_TRA['erro'], $_TRA['sus'], "danger");
        }
        elseif(empty($perfil)){
            echo MensagemAlerta($_TRA['erro'], $_TRA['sup'], "danger");
        }
        else{

            $VerificarStatusOnline = VerificarStatusOnline($caduser, $rev, $status, $perfil);
            $VerificarStatusOnline = VerificarStatusOnline($caduser, $rev, $status, $perfil);

            ?>


            <div class="table-responsive">

                <table id="Tabela" class="table datatable">
                    <thead>
                    <tr>
                        <th><?php echo $_TRA['Status']; ?></th>
                        <th><?php echo $_TRA['nome']; ?></th>
                        <th><?php echo $_TRA['Usuario']; ?></th>
                        <th><?php echo $_TRA['cpor']; ?></th>
                        <th><?php echo $_TRA['ce']; ?></th>
                        <th><?php echo $_TRA['ip']; ?></th>
                        <th><?php echo $_TRA['Perfil']; ?></th>
                        <th><?php echo $_TRA['Canal']; ?></th>
                        <th><?php echo $_TRA['op']; ?></th>
                        <th><?php echo $_TRA['opcoes']; ?></th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php

                    // IMAGENS DO CANAL CLARO - SKY
                    for($i=0; $i<count($VerificarStatusOnline); $i++){

                        $PerfilAtual = "[".$VerificarStatusOnline[$i][4]."]";
                        $canal = "".$VerificarStatusOnline[$i][5]."";
			
			

			//Substituindo caracteres especiais			
			$canal = preg_replace( '/[`^~\'"]/', null, iconv( 'UTF-8', 'ASCII//TRANSLIT', $canal ) );
			//passando para maiusculas todas letras
			$canal = strtoupper($canal);
			//$canal = htmlspecialchars($canal);
			$canal = str_replace('&AMP;', '&', $canal);
						
	
			//variavel para no final verificar se esta conectado
			$removeEspaco = array(" ");
				
                        $perfil = SelecionarPerfil($PerfilAtual);

                        $SQLUser = "SELECT CadUser, nome FROM usuario WHERE usuario = :usuario";
                        $SQLUser = $painel_user->prepare($SQLUser);
                        $SQLUser->bindParam(':usuario', $VerificarStatusOnline[$i][0], PDO::PARAM_STR);
                        $SQLUser->execute();
                        $LnUser = $SQLUser->fetch();
			
			

    if(strstr($canal, 'GLOBALSAT+', true)){$canal = '<img src="img/canais/+Globosat.png">'; }
	else if(strstr($canal, 'GLOBALSAT+ HD', true)){$canal = '<img src="img/canais/+GlobosatHD.png">'; }

	else if(strstr($canal, 'A&E', true)){$canal = '<img src="img/canais/A&E.png">';}
	else if(strstr($canal, 'A&E HD', true)){$canal = '<img src="img/canais/A&EHD.png">';}

	else if(strstr($canal, 'ANIMAL PLANET', true)){$canal = '<img src="img/canais/AnimalPlanet.png">';}
	else if(strstr($canal, 'ANIMAL PLANET HD', true)){$canal = '<img src="img/canais/AnimalPlanetHD.png">';}

	else if(strstr($canal, 'APARECIDA', true)){$canal = '<img src="img/canais/TVAparecida.png">';}
	else if(strstr($canal, 'APARECIDA HD', true)){$canal = '<img src="img/canais/TVAparecidaHD.png">';}
	
	else if(strstr($canal, 'ARTE 1', true)){$canal = '<img src="img/canais/Arte1.png">';}
	else if(strstr($canal, 'ARTE 1', true)){$canal = '<img src="img/canais/Arte1HD.png">';}

	else if(strstr($canal, 'AXN', true)){$canal = '<img src="img/canais/AXN.png">';}
    else if(strstr($canal, 'AXN', true)){$canal = '<img src="img/canais/AXNHD.png">';}

	else if(strstr($canal, 'BAND ALTERNATIVO', true)){$canal = '<img src="img/canais/BandAlternativo.png">';}

	else if(strstr($canal, 'BAND NEWS', true)){$canal = '<img src="img/canais/BandNews.png">';}
	else if(strstr($canal, 'BAND NEWS HD', true)){$canal = '<img src="img/canais/BandNewsHD.png">';}

	else if(strstr($canal, 'BAND SPORT', true)){$canal = '<img src="img/canais/BandSports.png">';}
	else if(strstr($canal, 'BAND SPORT HD', true)){$canal = '<img src="img/canais/BandSportsHD.png">';}

	else if(strstr($canal, 'BANDEIRANTES', true)){$canal = '<img src="img/canais/Bandeirantes.png">';}

	else if(strstr($canal, 'BBB', true)){$canal = '<img src="img/canais/BBB.png">';}

    else if(strstr($canal, 'BIS', true)){$canal = '<img src="img/canais/Bis.png">';}
	else if(strstr($canal, 'BIS HD', true)){$canal = '<img src="img/canais/BisHD.png">';}

	else if(strstr($canal, 'BOA VONTADE', true)){$canal = '<img src="img/canais/BoaVontade.png">';}

	else if(strstr($canal, 'BOOMERANG', true)){$canal = '<img src="img/canais/Boomerang.png">';}
	else if(strstr($canal, 'BOOMERANG HD', true)){$canal = '<img src="img/canais/BoomerangHD.png">';}

	else if(strstr($canal, 'CANAL BRASIL', true)){$canal = '<img src="img/canais/CanalBrasil.png">';}

	else if(strstr($canal, 'CANAL RURAL', true)){$canal = '<img src="img/canais/CanalRural.png">';}

	else if(strstr($canal, 'CANCAO NOVA', true)){$canal = '<img src="img/canais/CancaoNova.png">';}

	else if(strstr($canal, 'CARTOON NETWORK', true)){$canal = '<img src="img/canais/CartoonNetwork.png">';}
	else if(strstr($canal, 'CARTOON NETWORK HD', true)){$canal = '<img src="img/canais/CartoonNetworkHD.png">';}

	else if(strstr($canal, 'CINEMAX', true)){$canal = '<img src="img/canais/Cinemax.png">';}
	else if(strstr($canal, 'CINEMAX HD', true)){$canal = '<img src="img/canais/CinemaxHD.png">';}

	else if(strstr($canal, 'CNNE', true)){$canal = '<img src="img/canais/CNN.png">';}

	else if(strstr($canal, 'CNNI', true)){$canal = '<img src="img/canais/CNN.png">';}

	else if(strstr($canal, 'CNT', true)){$canal = '<img src="img/canais/CNT.png">';}

	else if(strstr($canal, 'COMBATE', true)){$canal = '<img src="img/canais/Combate.png">';}
	else if(strstr($canal, 'COMBATE HD', true)){$canal = '<img src="img/canais/CombateHD.png">';}
	
	else if(strstr($canal, 'COMEDY CENTRAL', true)){$canal = '<img src="img/canais/ComedyCentral.png">';}

	else if(strstr($canal, 'CURTA!', true)){$canal = '<img src="img/canais/Curta!.png">';}

	else if(strstr($canal, 'DESCONECTADO', true)){$canal = '<img src="img/canais/Desconectado.png">';}

    else if(strstr($canal, 'DEUTSCHE WELLE', true)){$canal = '<img src="img/canais/DeutscheWelle.png">';}

	else if(strstr($canal, 'DISCOVERY CHANNEL', true)){$canal = '<img src="img/canais/DiscoveryChannel.png">';}
	else if(strstr($canal, 'DISCOVERY CHANNEL HD', true)){$canal = '<img src="img/canais/DiscoveryChannelHD.png">';}

	else if(strstr($canal, 'DISCOVERY CIVILIZATION', true)){$canal = '<img src="img/canais/DiscoveryCivilization.png">';}

	else if(strstr($canal, 'DISCOVERY H&H', true)){$canal = '<img src="img/canais/DiscoveryH&H.png">';}
    else if(strstr($canal, 'DISCOVERY H&H HD', true)){$canal = '<img src="img/canais/DiscoveryH&HHD.png">';}

    else if(strstr($canal, 'DISCOVERY KIDS', true)){$canal = '<img src="img/canais/DiscoveryKids.png">';}
    else if(strstr($canal, 'DISCOVERY KIDS HD', true)){$canal = '<img src="img/canais/DiscoveryKidsHD.png">';}

    else if(strstr($canal, 'DISCOVERY SCIENCE', true)){$canal = '<img src="img/canais/DiscoveryScience.png">';}

    else if(strstr($canal, 'DISCOVERY THEATER', true)){$canal = '<img src="img/canais/DiscoveryTheater.png">';}
    else if(strstr($canal, 'DISCOVERY THEATER HD', true)){$canal = '<img src="img/canais/DiscoveryTheaterHD.png">';}

    else if(strstr($canal, 'DISCOVERY TL', true)){$canal = '<img src="img/canais/DiscoveryTL.png">';}

    else if(strstr($canal, 'DISCOVERY TURBO', true)){$canal = '<img src="img/canais/DiscoveryTurbo.png">';}
    else if(strstr($canal, 'DISCOVERY TURBO HD', true)){$canal = '<img src="img/canais/DiscoveryTurboHD.png">';}

    else if(strstr($canal, 'DISCOVERY WORLD', true)){$canal = '<img src="img/canais/DiscoveryWorld.png">';}

    else if(strstr($canal, 'DISNEY', true)){$canal = '<img src="img/canais/DisneyChannel.png">';}
    else if(strstr($canal, 'DISNEY HD', true)){$canal = '<img src="img/canais/DisneyChannelHD.png">';}

    else if(strstr($canal, 'DISNEY JUNIOR', true)){$canal = '<img src="img/canais/DisneyJunior.png">';}

    else if(strstr($canal, 'DISNEY XD', true)){$canal = '<img src="img/canais/DisneyXD.png">';}

    else if(strstr($canal, 'E!', true)){$canal = '<img src="img/canais/E.png">';}

    else if(strstr($canal, 'EI MAXX', true)){$canal = '<img src="img/canais/EIMaxx.png">';}
    else if(strstr($canal, 'EI MAXX HD', true)){$canal = '<img src="img/canais/EIMaxxHD.png">';}

    else if(strstr($canal, 'EI MAXX II', true)){$canal = '<img src="img/canais/EIMaxxII.png">';}
    else if(strstr($canal, 'EI MAXX II HD', true)){$canal = '<img src="img/canais/EIMaxxIIHD.png">';}

    else if(strstr($canal, 'EPTV', true)){$canal = '<img src="img/canais/EPTV.png">';}

    else if(strstr($canal, 'EPTV CAMPINAS', true)){$canal = '<img src="img/canais/EPTVCampinas.png">';}

    else if(strstr($canal, 'ESPN', true)){$canal = '<img src="img/canais/ESPN.png">';}
    else if(strstr($canal, 'ESPN HD', true)){$canal = '<img src="img/canais/ESPNHD.png">';}

    else if(strstr($canal, 'ESPN+', true)){$canal = '<img src="img/canais/ESPN+.png">';}
    else if(strstr($canal, 'ESPN+ HD', true)){$canal = '<img src="img/canais/ESPN+HD.png">';}

    else if(strstr($canal, 'ESPN BRASIL', true)){$canal = '<img src="img/canais/ESPNBrasil.png">';}
    else if(strstr($canal, 'ESPN BRASIL HD', true)){$canal = '<img src="img/canais/ESPNBrasilHD.png">';}

    else if(strstr($canal, 'FISH TV', true)){$canal = '<img src="img/canais/FishTV.png">';}

    else if(strstr($canal, 'FOOD NETWORK', true)){$canal = '<img src="img/canais/FoodNetwork.png">';}
    else if(strstr($canal, 'FOOD NETWORK HD', true)){$canal = '<img src="img/canais/FoodNetworkHD.png">';}

    else if(strstr($canal, 'FORMAN', true)){$canal = '<img src="img/canais/Forman.png">';}

    else if(strstr($canal, 'FOX', true)){$canal = '<img src="img/canais/FOX.png">';}
    else if(strstr($canal, 'FOX HD', true)){$canal = '<img src="img/canais/FOXHD.png">';}

    else if(strstr($canal, 'FOX LIFE', true)){$canal = '<img src="img/canais/FoxLife.png">';}
    else if(strstr($canal, 'FOX LIFE HD', true)){$canal = '<img src="img/canais/FoxLifeHD.png">';}

    else if(strstr($canal, 'FOX SPORT', true)){$canal = '<img src="img/canais/FoxSport.png">';}
    else if(strstr($canal, 'FOX SPORT HD', true)){$canal = '<img src="img/canais/FoxSportHD.png">';}

    else if(strstr($canal, 'FOX SPORT 2', true)){$canal = '<img src="img/canais/FoxSport2.png">';}
    else if(strstr($canal, 'FOX SPORT 2 HD', true)){$canal = '<img src="img/canais/FoxSport2HD.png">';}
    
    else if(strstr($canal, 'FUTURA', true)){$canal = '<img src="img/canais/Futura.png">';}

    else if(strstr($canal, 'FX', true)){$canal = '<img src="img/canais/FX.png">';}
    else if(strstr($canal, 'FX HD', true)){$canal = '<img src="img/canais/FXHD.png">';}

    else if(strstr($canal, 'GLITZ', true)){$canal = '<img src="img/canais/Glitz.png">';}

    else if(strstr($canal, 'GLOBO', true)){$canal = '<img src="img/canais/Globo.png">';}
    else if(strstr($canal, 'GLOBO HD', true)){$canal = '<img src="img/canais/GloboHD.png">';}

    else if(strstr($canal, 'GLOBO BAHIA', true)){$canal = '<img src="img/canais/GloboBahia.png">';}

    else if(strstr($canal, 'GLOBO BRASILIA', true)){$canal = '<img src="img/canais/GloboBrasilia.png">';}

    else if(strstr($canal, 'GLOOB', true)){$canal = '<img src="img/canais/Gloob.png">';}
    else if(strstr($canal, 'GLOOB HD', true)){$canal = '<img src="img/canais/GloobHD.png">';}

    else if(strstr($canal, 'GLOBO MINAS', true)){$canal = '<img src="img/canais/GloboMinas.png">';}

    else if(strstr($canal, 'GLOBO NEWS', true)){$canal = '<img src="img/canais/GloboNews.png">';}
    else if(strstr($canal, 'GLOBO NEWS HD', true)){$canal = '<img src="img/canais/GloboNewsHD.png">';}

    else if(strstr($canal, 'GLOBO NORDESTE', true)){$canal = '<img src="img/canais/GloboNordeste.png">';}

    else if(strstr($canal, 'GLOBO RIO', true)){$canal = '<img src="img/canais/GloboRio.png">';}

    else if(strstr($canal, 'GLOBO SP', true)){$canal = '<img src="img/canais/GloboSP.png">';}

    else if(strstr($canal, 'GNT', true)){$canal = '<img src="img/canais/GNT.png">';}
    else if(strstr($canal, 'GNT HD', true)){$canal = '<img src="img/canais/GNTHD.png">';}

    else if(strstr($canal, 'HBO', true)){$canal = '<img src="img/canais/HBO.png">';}
    else if(strstr($canal, 'HBO HD', true)){$canal = '<img src="img/canais/HBOHD.png">';}

    else if(strstr($canal, 'HBO2', true)){$canal = '<img src="img/canais/HBO2.png">';}
    else if(strstr($canal, 'HBO2 HD', true)){$canal = '<img src="img/canais/HBO2HD.png">';}

    else if(strstr($canal, 'HBO FAMILY', true)){$canal = '<img src="img/canais/HBOFamily.png">';}
    else if(strstr($canal, 'HBO FAMILY HD', true)){$canal = '<img src="img/canais/HBOFamilyHD.png">';}

    else if(strstr($canal, 'HBO PLUS', true)){$canal = '<img src="img/canais/HBOPlus.png">';}
    else if(strstr($canal, 'HBO PLUS HD', true)){$canal = '<img src="img/canais/HBOPlusHD.png">';}

    else if(strstr($canal, 'HBO PLUS E', true)){$canal = '<img src="img/canais/HBOPlusE.png">';}

    else if(strstr($canal, 'HBO SIGNATURE', true)){$canal = '<img src="img/canais/HBOSignature.png">';}
    else if(strstr($canal, 'HBO SIGNATURE HD', true)){$canal = '<img src="img/canais/HBOSignatureHD.png">';}

    else if(strstr($canal, 'IDEAL TV', true)){$canal = '<img src="img/canais/IdealTV.png">';}

    else if(strstr($canal, 'ID INVESTIGACAO DISCOVERY', true)){$canal = '<img src="img/canais/IDInvestigacaoDiscovery.png">';}
    else if(strstr($canal, 'ID INESTIGACAO DISCOVERY HD', true)){$canal = '<img src="img/canais/IDInvestigacaoDiscoveryHD.png">';}

    else if(strstr($canal, 'INTER TV CABUGI', true)){$canal = '<img src="img/canais/InterTV.png">';}

    else if(strstr($canal, 'I-SAT', true)){$canal = '<img src="img/canais/I-Sat.png">';}

    else if(strstr($canal, 'LIFETIME', true)){$canal = '<img src="img/canais/Lifetime.png">';}
    else if(strstr($canal, 'LIFETIME HD', true)){$canal = '<img src="img/canais/LifetimeHD.png">';}

    else if(strstr($canal, 'MAX', true)){$canal = '<img src="img/canais/Max.png">';}
    else if(strstr($canal, 'MAX HD VERSAO SD', true)){$canal = '<img src="img/canais/Max.png">';}
    else if(strstr($canal, 'MAX HD', true)){$canal = '<img src="img/canais/MAX HD.png">';}

    else if(strstr($canal, 'MAX PRIME', true)){$canal = '<img src="img/canais/MaxPrime.png">';}
    else if(strstr($canal, 'MAX PRIME', true)){$canal = '<img src="img/canais/MaxPrimeHD.png">';}

    else if(strstr($canal, 'MAX PRIME E', true)){$canal = '<img src="img/canais/MaxPrimeE.png">';}

    else if(strstr($canal, 'MAX UP', true)){$canal = '<img src="img/canais/MaxUp.png">';}
    else if(strstr($canal, 'MAX UP HD', true)){$canal = '<img src="img/canais/MaxUpHD.png">';}

    else if(strstr($canal, 'MEGAPIX', true)){$canal = '<img src="img/canais/Megapix.png">';}
    else if(strstr($canal, 'MEGAPIX HD', true)){$canal = '<img src="img/canais/MegapixHD.png">';}

    else if(strstr($canal, 'MTV', true)){$canal = '<img src="img/canais/MTV.png">';}
    else if(strstr($canal, 'MTV HD', true)){$canal = '<img src="img/canais/MTVHD.png">';}

    else if(strstr($canal, 'MULTISHOW', true)){$canal = '<img src="img/canais/Multishow.png">';}
    else if(strstr($canal, 'MULTISHOW HD', true)){$canal = '<img src="img/canais/MultishowHD.png">';}

    else if(strstr($canal, 'MUSIC BOX BRAZIL', true)){$canal = '<img src="img/canais/MusicBoxBrazil.png">';}
    
    else if(strstr($canal, 'NAT GEO', true)){$canal = '<img src="img/canais/NatGeo.png">';}
    else if(strstr($canal, 'NAT GEO HD', true)){$canal = '<img src="img/canais/NatGeoHD.png">';}

    else if(strstr($canal, 'NATIONAL GEOGRAPHIC', true)){$canal = '<img src="img/canais/NatGeo.png">';}
    else if(strstr($canal, 'NATIONAL GEOGRAPHIC HD', true)){$canal = '<img src="img/canais/NatGeoHD.png">';}

    else if(strstr($canal, 'NATIONAL WILD', true)){$canal = '<img src="img/canais/NatGeoWild.png">';}
    else if(strstr($canal, 'NATIONAL WILD HD', true)){$canal = '<img src="img/canais/NatGeoWildHD.png">';}

    else if(strstr($canal, 'NBR', true)){$canal = '<img src="img/canais/NBR.png">';}

    else if(strstr($canal, 'NHK PREMIUM', true)){$canal = '<img src="img/canais/NHKPremium.png">';}

    else if(strstr($canal, 'NICK', true)){$canal = '<img src="img/canais/Nick.png">';}
    else if(strstr($canal, 'NICKELODEON', true)){$canal = '<img src="img/canais/Nick.png">';}
    else if(strstr($canal, 'NICKELODEON HD', true)){$canal = '<img src="img/canais/NickelodeonHD.png">';}

    else if(strstr($canal, 'NICK JR', true)){$canal = '<img src="img/canais/NickJr.png">';}

    else if(strstr($canal, 'NOVO TEMPO', true)){$canal = '<img src="img/canais/NovoTempo.png">';}

    else if(strstr($canal, 'OFF', true)){$canal = '<img src="img/canais/Off.png">';}
    else if(strstr($canal, 'OFF HD', true)){$canal = '<img src="img/canais/OffHD.png">';}

    else if(strstr($canal, 'PARAMOUNT', true)){$canal = '<img src="img/canais/Paramount.png">';}
    else if(strstr($canal, 'PARAMOUNT HD', true)){$canal = '<img src="img/canais/ParamountHD.png">';}

    else if(strstr($canal, 'PLAYBOY', true)){$canal = '<img src="img/canais/Playboy.png">';}

    else if(strstr($canal, 'PLAY TV', true)){$canal = '<img src="img/canais/PlayTV.png">';}

    else if(strstr($canal, 'POLISHOP', true)){$canal = '<img src="img/canais/Polishop.png">';}

    else if(strstr($canal, 'PREMIERE CLUBES', true)){$canal = '<img src="img/canais/PremiereFC.png">';}

    else if(strstr($canal, 'PREMIERE', true)){$canal = '<img src="img/canais/Premiere1a9.png">';}

    else if(strstr($canal, 'PRIME BOX BRASIL', true)){$canal = '<img src="img/canais/PrimeBoxBrazil.png">';}

    else if(strstr($canal, 'RAI', true)){$canal = '<img src="img/canais/RaiItalia.png">';}

    else if(strstr($canal, 'RBI', true)){$canal = '<img src="img/canais/RBITV.png">';}

    else if(strstr($canal, 'RBS PORTO ALEGRE', true)){$canal = '<img src="img/canais/RBSPortoAlegre.png">';}

    else if(strstr($canal, 'RECORD NEWS', true)){$canal = '<img src="img/canais/RecordNews.png">';}

    else if(strstr($canal, 'RECORD', true)){$canal = '<img src="img/canais/RecordTV.png">';}

    else if(strstr($canal, 'REDE BRASIL', true)){$canal = '<img src="img/canais/RedeBrasil.png">';}

    else if(strstr($canal, 'REDE GLOBO', true)){$canal = '<img src="img/canais/RedeGlobo.png">';}

    else if(strstr($canal, 'REDE TV', true)){$canal = '<img src="img/canais/RedeTV.png">';}

    else if(strstr($canal, 'REDE VIDA', true)){$canal = '<img src="img/canais/RedeVida.png">';}

    else if(strstr($canal, 'RIT', true)){$canal = '<img src="img/canais/RIT.png">';}

    else if(strstr($canal, 'RPC TV PARANAENSE', true)){$canal = '<img src="img/canais/RPCTVParanaense.png">';}

    else if(strstr($canal, 'SBT', true)){$canal = '<img src="img/canais/SBT.png">';}

    else if(strstr($canal, 'SEXHOT', true)){$canal = '<img src="img/canais/SexHot.png">';}

    else if(strstr($canal, 'SEXTREME', true)){$canal = '<img src="img/canais/Sextreme.png">';}

    else if(strstr($canal, 'SHOPTIME', true)){$canal = '<img src="img/canais/Shoptime.png">';}

    else if(strstr($canal, 'SIC', true)){$canal = '<img src="img/canais/SIC.png">';}

    else if(strstr($canal, 'SONY', true)){$canal = '<img src="img/canais/Sony.png">';}
    else if(strstr($canal, 'SONY HD', true)){$canal = '<img src="img/canais/SonyHD.png">';}

    else if(strstr($canal, 'SONY SPIN', true)){$canal = '<img src="img/canais/SonySpin.png">';}

    else if(strstr($canal, 'SPACE', true)){$canal = '<img src="img/canais/Space.png">';}
    else if(strstr($canal, 'SPACE HD', true)){$canal = '<img src="img/canais/SpaceHD.png">';}

    else if(strstr($canal, 'SPORTV', true)){$canal = '<img src="img/canais/SporTV.png">';}
    else if(strstr($canal, 'SPORTV HD', true)){$canal = '<img src="img/canais/SporTVHD.png">';}
    else if(strstr($canal, 'SPORTV ALTERNATIVO', true)){$canal = '<img src="img/canais/SporTVAlternativo.png">';}

    else if(strstr($canal, 'SPORTV2', true)){$canal = '<img src="img/canais/SporTV2.png">';}
    else if(strstr($canal, 'SPORTV2 HD', true)){$canal = '<img src="img/canais/SporTV2HD.png">';}
    else if(strstr($canal, 'SPORTV2 ALTERNATIVO', true)){$canal = '<img src="img/canais/SporTV2Alternativo.png">';}

    else if(strstr($canal, 'SPORTV3', true)){$canal = '<img src="img/canais/SporTV3.png">';}
    else if(strstr($canal, 'SPORTV3 HD', true)){$canal = '<img src="img/canais/SporTV3HD.png">';}

    else if(strstr($canal, 'STUDIO UNUVERSAL', true)){$canal = '<img src="img/canais/StudioUniversal.png">';}

    else if(strstr($canal, 'SYFY', true)){$canal = '<img src="img/canais/SyFy.png">';}

    else if(strstr($canal, 'TBS', true)){$canal = '<img src="img/canais/TBS.png">';}

    else if(strstr($canal, 'TCM', true)){$canal = '<img src="img/canais/TCM.png">';}

    else if(strstr($canal, 'TELECINE ACTION', true)){$canal = '<img src="img/canais/TelecineAction.png">';}
    else if(strstr($canal, 'TELECINE ACTION HD', true)){$canal = '<img src="img/canais/TelecineActionHD.png">';}

    else if(strstr($canal, 'TELECINE CULT', true)){$canal = '<img src="img/canais/TelecineCult.png">';}
    else if(strstr($canal, 'TELECINE CULT HD', true)){$canal = '<img src="img/canais/TelecineCultHD.png">';}

    else if(strstr($canal, 'TELECINE FUN', true)){$canal = '<img src="img/canais/TelecineFun.png">';}
    else if(strstr($canal, 'TELECINE FUN HD', true)){$canal = '<img src="img/canais/TelecineFunHD.png">';}

    else if(strstr($canal, 'TELECINE PIPOCA', true)){$canal = '<img src="img/canais/TelecinePipoca.png">';}
    else if(strstr($canal, 'TELECINE PIPOCA HD', true)){$canal = '<img src="img/canais/TelecinePipocaHD.png">';}

    else if(strstr($canal, 'TELECINE PREMIUM', true)){$canal = '<img src="img/canais/TelecinePremium.png">';}
    else if(strstr($canal, 'TELECINE PREMIUM HD', true)){$canal = '<img src="img/canais/TelecinePremiumHD.png">';}

    else if(strstr($canal, 'TELECINE TOUCH', true)){$canal = '<img src="img/canais/TelecineTouch.png">';}
    else if(strstr($canal, 'TELECINE TOUCH HD', true)){$canal = '<img src="img/canais/TelecineTouchHD.png">';}

    else if(strstr($canal, 'TERRA VIVA', true)){$canal = '<img src="img/canais/TerraViva.png">';}

    else if(strstr($canal, 'TESTE1', true)){$canal = '<img src="img/canais/Teste1.png">';}
    else if(strstr($canal, 'TESTE2', true)){$canal = '<img src="img/canais/Teste2.png">';}

    else if(strstr($canal, 'THE HISTORY CHANNEL', true)){$canal = '<img src="img/canais/TheHistoryChannel.png">';}
    else if(strstr($canal, 'THE HISTORY CHANNEL HD', true)){$canal = '<img src="img/canais/TheHistoryChannelHD.png">';}

    else if(strstr($canal, 'TRAVEL AND LIVING CHANNEL |TLC|', true)){$canal = '<img src="img/canais/TLC.png">';}
    else if(strstr($canal, 'TRAVEL AND LIVING CHANNEL |TLC| HD', true)){$canal = '<img src="img/canais/TLCHD.png">';}

    else if(strstr($canal, 'TLC', true)){$canal = '<img src="img/canais/TLC.png">';}
    else if(strstr($canal, 'TLC HD', true)){$canal = '<img src="img/canais/TLCHD.png">';}

    else if(strstr($canal, 'TRAVEL AND LIVING CHANNEL', true)){$canal = '<img src="img/canais/TLC.png">';}
    else if(strstr($canal, 'TRAVEL AND LIVING CHANNEL HD', true)){$canal = '<img src="img/canais/TLCHD.png">';}

    else if(strstr($canal, 'TNT', true)){$canal = '<img src="img/canais/TNT.png">';}
    else if(strstr($canal, 'TNT HD', true)){$canal = '<img src="img/canais/TNTHD.png">';}

    else if(strstr($canal, 'TNT SERIES', true)){$canal = '<img src="img/canais/TNTSeries.png">';}
    else if(strstr($canal, 'TNT SERIES HD', true)){$canal = '<img src="img/canais/TNTSeriesHD.png">';}

    else if(strstr($canal, 'TOONCAST', true)){$canal = '<img src="img/canais/Tooncast.png">';}

    else if(strstr($canal, 'TRU TV', true)){$canal = '<img src="img/canais/TruTV.png">';}

    else if(strstr($canal, 'TV5 MONDE', true)){$canal = '<img src="img/canais/TV5Monde.png">';}

    else if(strstr($canal, 'TOONCAST', true)){$canal = '<img src="img/canais/Tooncast.png">';}

    else if(strstr($canal, 'TV AMAZONAS', true)){$canal = '<img src="img/canais/TVAmazonas.png">';}

    else if(strstr($canal, 'TV ANHANGUERA GOIANIA', true)){$canal = '<img src="img/canais/TVAnhangueraGoiania.png">';}

    else if(strstr($canal, 'TV APARECIDA', true)){$canal = '<img src="img/canais/TVAparecida.png">';}

    else if(strstr($canal, 'TV BRASIL', true)){$canal = '<img src="img/canais/TVBrasil.png">';}
    
    else if(strstr($canal, 'TV CAMARA', true)){$canal = '<img src="img/canais/TVCamara.png">';}

    else if(strstr($canal, 'TV CENTRO AMERICA', true)){$canal = '<img src="img/canais/TVCentroAmerica.png">';}

    else if(strstr($canal, 'TV CULTURA', true)){$canal = '<img src="img/canais/TVCultura.png">';}

    else if(strstr($canal, 'TV ESCOLA', true)){$canal = '<img src="img/canais/TVEscola.png">';}

    else if(strstr($canal, 'TV ESPANA', true)){$canal = '<img src="img/canais/TVEspana.png">';}

    else if(strstr($canal, 'TV EXEC', true)){$canal = '<img src="img/canais/TVExec.png">';}

    else if(strstr($canal, 'TV JUSTICA', true)){$canal = '<img src="img/canais/TVJustica.png">';}

    else if(strstr($canal, 'TV LIBERAL BELEM', true)){$canal = '<img src="img/canais/TVLiberalBelem.png">';}

    else if(strstr($canal, 'TV RA TIM BUM', true)){$canal = '<img src="img/canais/TVRaTimBum.png">';}

    else if(strstr($canal, 'TV SENADO', true)){$canal = '<img src="img/canais/TVSenado.png">';}

    else if(strstr($canal, 'TV TEM BAURU', true)){$canal = '<img src="img/canais/TVTemBauru.png">';}

    else if(strstr($canal, 'TV TEM SAO JOSE DO RIO PARDO', true)){$canal = '<img src="img/canais/TVTemSaoJosedoRioPardo.png">';}

    else if(strstr($canal, 'TV TEM SOROCABA', true)){$canal = '<img src="img/canais/TVTemSorocaba.png">';}

    else if(strstr($canal, 'TV TRIBUNAS SANTOS', true)){$canal = '<img src="img/canais/TVTribunasSantos.png">';}

    else if(strstr($canal, 'TV VANGUARDA SAO JOSE', true)){$canal = '<img src="img/canais/TVVanguardaSaoJose.png">';}

    else if(strstr($canal, 'TV VERDES MARES FORTALE', true)){$canal = '<img src="img/canais/TVVerdesMaresFortaleza.png">';}

    else if(strstr($canal, 'UNKNOWN (5e3)', true)){$canal = '<img src="img/canais/Atualizacao.png">';}
    else if(strstr($canal, 'UNKNOWN (b56)', true)){$canal = '<img src="img/canais/Atualizacao.png">';}
    else if(strstr($canal, 'UNKNOWN (0)', true)){$canal = '<img src="img/canais/Atualizacao.png">';}
    else if(strstr($canal, 'UNKNOWN (71)', true)){$canal = '<img src="img/canais/Atualizacao.png">';}
    else if(strstr($canal, 'UNKNOWN (9b)', true)){$canal = '<img src="img/canais/Atualizacao.png">';}
    else if(strstr($canal, 'UNKNOWN (d8)', true)){$canal = '<img src="img/canais/Atualizacao.png">';}

    else if(strstr($canal, 'UNIVERSAL CHANNEL', true)){$canal = '<img src="img/canais/UniversalChannel.png">';}
    else if(strstr($canal, 'UNIVERSAL CHANNEL HD', true)){$canal = '<img src="img/canais/UniversalChannelHD.png">';}
    else if(strstr($canal, 'UNIVERSAL TV', true)){$canal = '<img src="img/canais/UniversalTV.png">';}

    else if(strstr($canal, 'VH1 MEGA HITS', true)){$canal = '<img src="img/canais/VH1MegaHits.png">';}
    else if(strstr($canal, 'VH! MEGA HITS HD', true)){$canal = '<img src="img/canais/VH1HD.png">';}

    else if(strstr($canal, 'VIVA', true)){$canal = '<img src="img/canais/Viva.png">';}
    else if(strstr($canal, 'VIVA HD', true)){$canal = '<img src="img/canais/VivaHD.png">';}

    else if(strstr($canal, 'WARNER CHANNEL', true)){$canal = '<img src="img/canais/WarnerChannel.png">';}
    else if(strstr($canal, 'WARNER CHANNEL', true)){$canal = '<img src="img/canais/WarnerChannelHD.png">';}

    else if(strstr($canal, 'WHOOHOO', true)){$canal = '<img src="img/canais/Whoohoo.png">';}

    
	    else if(strstr($canal, 'RADIO', true)){$canal = '<img src="img/canais/Radio.png">';}

			else if(str_replace($removeEspaco, "", $canal) == ""){$canal = '<img src="img/canais/Desconectado.png">';}	
				
				else{$canal = '<img src="img/canais/LogoNaoEncontrada.png">';}






                        if($VerificarStatusOnline[$i][3] == "false"){
                            $status = "<span class=\"pointer label label-warning\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"\" data-original-title=\"".$_TRA['Ocioso']."\">".$_TRA['Ocioso']."</span>";
                        }
                        else{
                            $status = "<span class=\"pointer label label-success\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"\" data-original-title=\"".$_TRA['Online']."\">".$_TRA['Online']."</span>";
                        }

                        echo "	
                                        <tr>
											<td width=\"50\">".$status."</td>
											<td>".$LnUser['nome']."</td>
											<td>".$VerificarStatusOnline[$i][0]."</td>
											<td>".$LnUser['CadUser']."</td>
											<td>".OrganizarHora($VerificarStatusOnline[$i][1])."</td>
											<td><span id=\"StatusIP".$i."\">".$VerificarStatusOnline[$i][2]."&nbsp;<a class=\"label label-info\" Onclick=\"InfoIP('".$VerificarStatusOnline[$i][2]."', '".$VerificarStatusOnline[$i][0]."', '#StatusIP".$i."')\"><i class=\"fa fa-exchange\"></i></a>&nbsp;</span></td>
											<td>".$perfil."</td>
											<td>
											    $canal    
											</td>
											
											<td>".$VerificarStatusOnline[$i][6]."</td>
                  <td><div class=\"form-group\">
											<span id=\"StatusDerrubar".$i."\">
											<a class=\"label label-warning\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"\" data-original-title=\"".$_TRA['Derrubar']."\" Onclick=\"DerrubarUsuario('".$VerificarStatusOnline[$i][0]."', '".$PerfilAtual."', 'StatusDerrubar".$i."')\"><i class=\"fa fa-retweet\"></i></a>&nbsp;";

                        if( ($AdminBloquear == 'S') || ($TesteBloquear == 'S') ){
                            echo "<a class=\"label label-danger\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"\" data-original-title=\"".$_TRA['bloquear']."\" Onclick=\"BloquearStatusUser('".$VerificarStatusOnline[$i][0]."')\"><i class=\"fa fa-lock\"></i></a>&nbsp;";
                        }

                        echo "</span></div></td>";

                        echo "</tr>";
                    }

                    ?>

                    </tbody>
                </table>
            </div>

            <script type="text/javascript" src="js/plugins/datatables/jquery.dataTables.min.js"></script>
            <script type="text/javascript" src="js/DataTables<?php echo Idioma(2); ?>.js"></script>

            <script type="text/javascript" src="js/plugins.js"></script>

            <script type='text/javascript'>
                function DerrubarUsuario(usuario, perfil, status){

                    panel_refresh($(".page-container"));

                    $.post('EnviarDerrubarUser.php', {usuario: usuario, perfil: perfil}, function(resposta) {

                        setTimeout(panel_refresh($(".page-container")),500);

                        $("#"+status+"").html('');
                        $("#"+status+"").html(resposta);
                    });

                }

                <?php
                if( ($AdminBloquear == 'S') || ($TesteBloquear == 'S') ){
                ?>
                function BloquearStatusUser(usuario){

                    var titulo = '<?php echo $_TRA['bloquear']; ?>?';
                    var texto = '<?php echo $_TRA['tcqdba']; ?> '+usuario+'?';
                    var tipo = 'danger';
                    var url = 'EnviarBloquearUserTeste';
                    var fa = 'fa fa-lock';

                    $.post('ScriptAlertaJS.php', {id: usuario, titulo: titulo, texto: texto, tipo: tipo, url: url, fa: fa}, function(resposta) {
                        $("#StatusGeral").html('');
                        $("#StatusGeral").html(resposta);
                    });

                }
                <?php
                }
                ?>

                function InfoIP(ip, usuario, div){

                    $(div).html("<center><img src=\"img/fileinput/loading.gif\"></center>");

                    $.post('InfoIP.php', {ip: ip, usuario: usuario}, function(resposta) {
                        $(div).html('');
                        $(div).html(resposta.trim());
                    });

                }
            </script>


            <?php
        }
    }else{
        echo Redirecionar('index.php');
    }
}else{
    echo Redirecionar('login.php');
}
?>