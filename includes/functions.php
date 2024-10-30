<?php 

defined ('ABSPATH') or die ('No scripts kiddies please!');
if (! Defined ('ABSPATH')) exit; // Sair se acessado diretamente

// Conectando a função de paginaPlugin com o action hook
add_action('admin_menu', 'ccm_paginaPlugin');

// Conectando a função de colocar script no footer com o actionhook
add_action('wp_footer', 'ccm_myScript');
add_action('wp_head', 'ccm_myCSS');

// Define página do plugin
function ccm_paginaPlugin(){

    add_menu_page(
        'Cool Category Menu',
        'Cool Category Menu',
        'manage_options',
        'cool-category-menu-page.php',
        'ccm_verificandoPaginaPlugin'
    );
}

// Verificando Página do Plugin
function ccm_verificandoPaginaPlugin(){
    require_once "cool-category-menu-page.php";
}

// Colocando o script no footer
function ccm_myScript(){
	//wp_enqueue_script('scriptMenu', ccm_pathOfIncludes() . 'scriptMenu.js');
	echo "<script> var listaMenu = document.querySelectorAll('.product-categories > li');

    for(var i = 0; i < listaMenu.length; i++){
        listaMenu[i].addEventListener('click', ativaMenu); 
        //listaMenu[i].setAttribute('clicked', 'notClicked');
    }

    function ativaMenu(e){
        var li = e.target;
        if(li.getAttribute('clicked') == 'clicked'){
            li.setAttribute('clicked',  'notClicked');
        }else{
            li.setAttribute('clicked', 'clicked');
        }
    }
	
    var secondary = document.querySelector('#secondary > section');
    secondary.setAttribute('id', 'myID');
    secondary.setAttribute('class', 'myClasses'); </script>";
}

// Linkar o CSS no head
function ccm_myCSS(){
    //echo "<link id='linkeia' rel='stylesheet' type='text/css' href='/wp-content/plugins/coolCategoryMenu/includes/style.php' >";	
	// Inclue o CSS da maneira correta
	wp_enqueue_style('style', ccm_pathOfIncludes() . 'style.php');
}

function ccm_pathOfIncludes(){
	//return '/wp-content/plugins/coolCategoryMenu/includes/';
	return plugin_dir_url( __FILE__ ); 
}

// Retorna exemplo de como está a lista atualmente
function ccm_myListPreview(){
	$listaMenu = '<ul class="product-categories">
    <li class="cat-item cat-parent current-cat-parent"><a href="">Item 1</a>
        <ul class="children">
            <li class="cat-item current-cat"><a href="">Filho item 1 - 2</a></li>
            <li class="cat-item"><a href="">Filho item 1 - 2</a></li>
        </ul>
    </li>

    <li class="cat-item cat-parent"><a href="">Item 2</a>
        <ul class="children">
        <li class="cat-item"><a href="">Filho item 2 - 1</a></li>
        <li class="cat-item"><a href="">Filho item 2 - 2</a></li>
        </ul>
    </li>

    <li class="cat-item"><a href="">Item 3</a></li>
</ul>';
	
	echo $listaMenu;
}

// Criar tabela de variaveis do CSS
function ccm_createTableCSS(){
	
	global $wpdb; // importante
	$table_name = $wpdb->prefix . 'cssVariables'; // nome da tabela
	$charset_collate = $wpdb->get_charset_collate(); 
	
	$sql = "CREATE TABLE $table_name (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		variable tinytext NOT NULL,
		value tinytext NOT NULL,
		PRIMARY KEY  (id)
	) $charset_collate;"; // Cria tabela
	
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' ); // Importa o arquivo de atualização de tabela
	dbDelta( $sql ); // Coloca tabela
}

// Inserir dados CSS
function ccm_colocaDadosCSS() {
	global $wpdb;
	
	$variaveis = [['myMainFontColor', 'green'], ['myBackgroundColor', 'white'], 
['myMainFontColor_child', 'black'], ['myMainColor_SelectedItem', 'black'], ['myMainBorderBottomColor', 'white'], ['paddingElemento', '0px 0px 0px 0px'], ['myIconColor', '#000'], ['myIconColorClicked', '#ccc']];
	
	$table_name = $wpdb->prefix . 'cssVariables';
	
	
	foreach($variaveis as $variavel){
		$wpdb->insert( $table_name, array( 'variable' => $variavel[0], 'value' => $variavel[1]));
	}
	
	ccm_createAFile();
}

// Criando um arquivo css para guardar as variáveis
function ccm_createAFile(){
	global $wpdb;
	$color;
	
	$variaveis = $wpdb->get_results( "SELECT * FROM " . $wpdb->prefix  . "cssvariables");
	
	/* //mostrava os valores coletados 
	foreach($variaveis as $variavel){
		echo $variavel->id . ' | ';
		echo $variavel->variable . ' | ';
		echo $variavel->value;
		$color = $variavel->value;
	}*/
	
	
	// Escreve o arquivo CSS
	$myfile = fopen(dirname(__FILE__) . "/cssVariables.css", "w");
	//$myfile = fopen(pathOfIncludes() . "/cssVariables.css", "w");
	$txt = ":root{";
	fwrite($myfile, $txt);
	
		foreach($variaveis as $variavel){
			$txt = "--".$variavel->variable.": ".$variavel->value.";";
			fwrite($myfile, $txt);
		}

	$txt = "}";
	fwrite($myfile, $txt);
	fclose($myfile);
}


function ccm_atualizaCSS(){
	$myMainFontColor = sanitize_text_field($_POST["myMainFontColor"]);
	$myMainBackGroundColor = sanitize_hex_color($_POST["myBackgroundColor"]);
	$myMainFontColor_child = sanitize_text_field($_POST["myMainFontColor_child"]);
	$myMainColor_SelectedItem = sanitize_text_field($_POST["myMainColor_SelectedItem"]);
	$myMainBorderBottomColor = sanitize_text_field($_POST["myMainBorderBottomColor"]);
	$paddingElemento = [sanitize_text_field($_POST["myPaddingItem_top"]), 
						sanitize_text_field($_POST["myPaddingItem_right"]), 
						sanitize_text_field($_POST["myPaddingItem_bottom"]), 
						sanitize_text_field($_POST["myPaddingItem_left"])];
	$myIconColor = sanitize_text_field($_POST["myIconColor"]);
	$myIconColorClicked = sanitize_text_field($_POST["myIconColorClicked"]);
	
	
	$arrayCSS = [['myMainFontColor', $myMainFontColor], ['myBackgroundColor' ,$myMainBackGroundColor], ['myMainFontColor_child', $myMainFontColor_child], ['myMainColor_SelectedItem', $myMainColor_SelectedItem], ['myMainBorderBottomColor', $myMainBorderBottomColor], ['paddingElemento', $paddingElemento[0] .'px '.$paddingElemento[1].'px '.$paddingElemento[2].'px '.$paddingElemento[3].'px '], ['myIconColor', $myIconColor], ['myIconColorClicked', $myIconColorClicked]];
	
	
	global $wpdb;

	// Upadate data
	
	foreach($arrayCSS as $atributo){
		$wpdb->update('tp1wp_cssvariables', array('value' => $atributo[1]), array('variable' => $atributo[0]));
	}
	
	
	//$wpdb->update('tp1wp_cssvariables', array('value' => $myMainBackGroundColor), array('variable' => 'myBackgroundColor'));
	
	ccm_createAFile();
}

// pega o valor de uma variável no banco de dados
function ccm_getVariableByAttributeName($nomeAtributo){

	global $wpdb;
	$color;

	$variaveis = $wpdb->get_results( "SELECT * FROM " . $wpdb->prefix . " cssvariables WHERE variable='".$nomeAtributo."'");

	return $variaveis[0]->value;
}





