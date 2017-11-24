<?php

$view = views_get_view('vista_eventos_interna');
$view->set_display("block");
$view->pre_execute();
$view->execute();
global $base_root;
$path = current_path();
$path_alias = drupal_lookup_path('alias',$path);
$path= $base_root.'/'.$path_alias;			

?>


<script type="application/ld+json">
{
  "@context": "http://schema.org",
  "@type": "ItemList",
  "url": "<?php print $path; ?>",
  "description": "Listado de eventos universidad de los andes",
  "itemListElement": [
  <?php 
  $i=1;
  foreach ($view->result as $item ) {
  	print "{";
  	?>
    
      "@type": "ListItem",
      "position": "<?php print $i ?>",
      "item": {
        "@type": "Event",
        "name": "<?php print $item->_field_data['nid']['entity']->title?>",
        "image": "<?php print file_create_url($item->_field_data['nid']['entity']->field_imagen_eventos['und'][0]['uri'])?>",
        "description": "<?php print $item->_field_data['nid']['entity']->field_descripcion_eventos['und'][0]['value']?>",
		"startDate" : "<?php print $item->_field_data['nid']['entity']->field_fecha_evento_calendario['und'][0]['value']?>",
  		"url" : "<?php print $item->_field_data['nid']['entity']->field_boton_evento['und'][0]['url']?>",
  		"location" : {
	    "@type" : "Place",
	    "name" : "<?php print $item->_field_data['nid']['entity']->title?>",
	    "address" : "<?php print $item->_field_data['nid']['entity']->field_lugar_eventos['und'][0]['value']?>"
	  }







      }

<?php

  if ($item === end($view->result)) {
        print "}";
    }else{
    	print "},";
    }
  $i++;
  }
 
  ?>
    

    ]
}


</script>
	






	<div class="container-fluid miga-de-pan">
		<?php
		if (!empty($GLOBALS["breadcrumb"])){
			$breadcrumb = $GLOBALS["breadcrumb"];
			print $breadcrumb;
		}
		?>
	</div>

	
		
			<div class="title-bloques"> <span></span> <?php print $node->field_titulo_bloque_inferior_m11["und"][0]["value"] ?></div>
			<div class="container">
			<?php

			print $view->render();
			?>
		
		</div>
	<div class="container-fluid block-views-vista-anuncios-home-block">
		<div class="container">

			<?php
			if ($node->field_activar_anuncios_m11["und"][0]["value"] == 1){
				$block = module_invoke('views', 'block_view', 'vista_anuncios_home-block');
				print render($block['content']);
			}
			?>
		</div>
	</div>
	<div class="container-fluid compartir-redes">
		<div class="container">
			<div class="linea-100"></div>
			<?php
			$block = module_invoke('block', 'block_view', '3');
			print render($block['content']);
			?>
			<?php
			/*if ($service_links_rendered):
				print $service_links_rendered;
			endif;*/
			?>
		</div>
	</div>

</div>