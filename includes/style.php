<?php 
header("Content-type: text/css");
?>


@import "cssVariables.css";
@import "font-awesome.css";

/** MENU DE CATEGORIAS - CATÁLOGO **/

.product-categories{
	width: 90%;
	background-color: var(--myBackgroundColor) !important;
}

.product-categories, .product-categories li, .product-categories li ul{
	padding: 0 !important;
	margin: 0 !important;
	list-style-type: none !important;
}

.product-categories > li{
	border-bottom: 1px solid var(--myMainBorderBottomColor) !important;
	padding: var(--paddingElemento) !important;
}

.product-categories li a{
	font-size: 17px;
	padding: 10px 0px;
	font-weight: bold;
	color: var(--myMainFontColor);
}

.product-categories li{
	float: unset !important;
}

.product-categories li ul li a{
	color: var(--myMainFontColor_child) !important;
	font-weight: 100 !important;
	font-size: 16px;
}


.product-categories li ul li a::after{
	display: none !important;
}

.product-categories li{
	padding: 0px 0px;
	cursor: pointer;
}

.product-categories li .children li{
	transition: 0.5s;
    color: #fff;
	padding: 0 !important;
	margin: 0;
    height: 0;
    transform: scaleY(0);
}

.product-categories li[clicked="clicked"] .children li{
    height: 30px;
    transform: scaleY(1);
}

.product-categories li[clicked="notClicked"] .children li{
    height: 0px;
    transform: scaleY(0);
}

.product-categories .current-cat-parent .children li{
    height: 30px;
    transform: scaleY(1);
}

.product-categories li[clicked="clicked"] .children, .product-categories .current-cat-parent .children{
	padding-top: 10px !important;
}

.product-categories li .current-cat a{
	font-weight: bold !important;
	color: var(--myMainColor_SelectedItem) !important;
}



/* ON HOVER */

/*.product-categories li:hover .children li{
    height: 30px;
    transform: scaleY(1);
}*/

/* SETINHA 	*/
.product-categories li.cat-parent{
	position: relative;
}


.product-categories li.cat-parent::after{
	content: "\f054";
	transition: 0.5s;
	font-family: 'FontAwesome';
	float: right;
	color: var(--myIconColor) !important;
	font-size: 13px;
	position: absolute;
    right: 10px !important;
    top: 15px !important;
	transform: rotate(90deg);
}

#secondary .widget ul li:after{
	right: 5px !important;
    top: 15px !important;
	left: unset !important;
}

.product-categories li.cat-parent[clicked="clicked"]::after{
	transform: rotate(-90deg);
	color: var(--myIconColorClicked) !important;
}
