<?php
add_plugin_hook('install', 'install');
add_plugin_hook('uninstall', 'uninstall');
add_filter('define_response_contexts', 'bioOutputReponseContext');
add_filter('define_action_contexts', 'bioOutputActionContext');
add_plugin_hook('public_theme_header', 'bioThemeHeader');

function install() {
	$elementSetMetadata = array(
	    'name'        => "Personaje [BIO]", 
	    'description' => "The BIO vocabulary contains terms useful for finding out more about people and their backgrounds and has some cross-over into genealogical information. See http://vocab.org/bio/",
	);
	$elements = array(

	//required FOAF metadata:Person
		array(
			'label' => 'olb',
			'name' => 'One-line bio',
			'description' => 'A name for some thing',
			'data_type' => 'Tiny Text',
		),
		
	//first element for test
    array(
      'label' => 'name',
			'name' => 'name',
			'description' => 'A one-line biography of the person.',
			'data_type' => 'Tiny Text',
    ),
  
  );
	insert_element_set($elementSetMetadata, $elements);
}

function uninstall()
{
	
}

add_filter('admin_items_form_tabs', 'bio_items_form_tabs');

function bio_items_form_tabs($tabs, $item)
{
	unset($tabs['Dublin Core']);
	unset($tabs['Item Type Metadata']);
	return $tabs;
}

function bioOutputReponseContext($context)
{
    $context['bio'] = array('suffix'  => 'bio', 
                            'headers' => array('Content-Type' => 'text/xml'));

    return $context;
}

function bioOutputActionContext($context, $controller)
{
    if ($controller instanceof ItemsController) {
        $context['show'][] = 'bio';
    }

    return $context;
}

function bioThemeHeader()
{
	echo bioOutput();
}
   
function bioOutput()
{
    $request = Zend_Controller_Front::getInstance()->getRequest();

	if ($request->getControllerName() == 'items' && $request->getActionName() == 'show') {
	    return '<link rel="alternate" type="application/rss+xml" href="'.item_uri().'?output=bio" id="bio"/>' . "\n";
	}
}
