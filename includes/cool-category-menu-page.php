<div class="wrap">
	<?php 
		if (! Defined ('ABSPATH')) exit; // Sair se acessado diretamente
		wp_enqueue_style('style_dashBoard', ccm_pathOfIncludes() . 'style_dashBoard.css');
		wp_enqueue_style('style', ccm_pathOfIncludes() . 'style.php');
		wp_enqueue_style('uk-grid', ccm_pathOfIncludes() . 'uk-grid.css');
		wp_enqueue_style('font-awesome', ccm_pathOfIncludes() . 'font-awesome.min.css');
	?>
	
    <h1>Cool Category Menu</h1>
	
	<div class="container">
		<div class="bloco">
			<form method="post">
				<fieldset>
					<legend> Cores: </legend>

					<ul class="opcoes">
						<li>
							<label for="myMainFontColor">Font Color - parent element: </label>
							<input class="color-field" type="color" name="myMainFontColor" value="<?php echo ccm_getVariableByAttributeName('myMainFontColor') ?>">
						</li>
						<li>
							<label for="myMainColor_child">Font Color  - child element: </label>
							<input class="color-field" type="color" name="myMainFontColor_child" value="<?php echo ccm_getVariableByAttributeName('myMainFontColor_child') ?>">
						</li>
						<li>
							<label for="myMainColor_SelectedItem">Font Color - selected element: </label>
							<input class="color-field" type="color" name="myMainColor_SelectedItem" value="<?php echo ccm_getVariableByAttributeName('myMainColor_SelectedItem') ?>">
						</li>

						<li>
							<label for="myMainBackgroundColor">Background Color: </label>
							<input class="color-field" type="color" name="myBackgroundColor" value="<?php echo ccm_getVariableByAttributeName('myBackgroundColor') ?>">
						</li>

						<li>
							<label for="myMainBorderBottomColor">Border Bottom Color: </label>
							<input class="color-field" type="color" name="myMainBorderBottomColor" value="<?php echo ccm_getVariableByAttributeName('myMainBorderBottomColor') ?>">
						</li>

						<li>
							<label for="myIconColor">Icon Color: </label>
							<input class="color-field" type="color" name="myIconColor" value="<?php echo ccm_getVariableByAttributeName('myIconColor') ?>">
						</li>

						<li>
							<label for="myIconColorClicked">Icon Color Enabled: </label>
							<input class="color-field" type="color" name="myIconColorClicked" value="<?php echo ccm_getVariableByAttributeName('myIconColorClicked') ?>">
						</li>
					</ul>
				</fieldset>

				<label for="paddingElemento">Element Padding: </label>
				<input class="number-field" side="top" type="number" placeholder="Top" name="myPaddingItem_top" value="<?php echo explode("px ", ccm_getVariableByAttributeName('paddingElemento'))[0] ?>">
				<input class="number-field" side="right" type="number" placeholder="Right" name="myPaddingItem_right" value="<?php echo explode("px ", ccm_getVariableByAttributeName('paddingElemento'))[1] ?>">
				<input class="number-field" side="bottom" type="number" placeholder="Bottom" name="myPaddingItem_bottom" value="<?php echo explode("px ", ccm_getVariableByAttributeName('paddingElemento'))[2] ?>">
				<input class="number-field" side="left" type="number" placeholder="Left" name="myPaddingItem_left" value="<?php echo explode("px ", ccm_getVariableByAttributeName('paddingElemento'))[3] ?>">

				<br>
				<hr>
				<input class="button button-primary" type="submit" value="Save">
			</form>
		</div>
		<div class="bloco_do_menu">
			<?php ccm_myListPreview() ?>
		</div>
	</div>


    <?php echo ccm_createAFile(); ?>
	
</div>

<?php
	// Verifica se o form foi chamado
	if($_SERVER['REQUEST_METHOD']=='POST')
	{
		ccm_atualizaCSS();
		header("Refresh:0"); // Recarrega a página
	} 

	ccm_myScript();
?>


