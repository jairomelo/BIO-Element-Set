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
			'label' => 'name',
			'name' => 'name',
			'description' => 'A name for some thing',
			'data_type' => 'Tiny Text',
		),
		
	//BIO Vocabulary. Biographycal description
		array(
			'label' => 'olb',
			'name' => 'One-line bio',
			'description' => 'A one-line biography of the person.',
			'data_type' => 'Tiny Text',
		),	
		
		array(
			'label' => 'biography',
			'name' => 'Biography',
			'description' => 'An extended description or account of someones life.',
		),
		
		array(
			'label' => 'keywords',
			'name' => 'Key Words',
			'description' => 'A comma delimited list of key words that describe a person.',
		),
		
		array(
			'label' => 'father',
			'name' => 'Father',
			'description' => 'The biological father of a person, also known as the genitor.',
		),
		
		array(
			'label' => 'child',
			'name' => 'Child',
			'description' => 'A biological child of a person.',
		),
		
		array(
			'label' => 'event',
			'name' => 'Life Event',
			'description' => 'An event associated with a person, group or organization.',
		),
		
		array(
			'label' => 'birth',
			'name' => 'Birth event',
			'description' => 'An birth event associated with a person, group or organization.',
			'_refines'    => 'event',
		),
		
		array(
			'label' => 'death',
			'name' => 'Death event',
			'description' => 'An death event associated with a person, group or organization.',
			'_refines'    => 'event',
		),
	
	//Types of event: this categories refines the Life and Death events
		
		array(
			'label' => 'Event',
			'name' => 'Event',
			'description' => 'An event is an occurrence that brings about a change in the state of affairs for one or more people and/or other agents. Events are assumed to occur over a period of time and may not have precise start and end points.',
			'_refines'    => 'event',
		),
		
		array(
			'label' => 'IndividualEvent',
			'name' => 'Individual Event',
			'description' => 'A type of event that is principally about a single person, group or organization. Other agents may be involved but the event is most significant for the principal agent.',
			'_refines'    => 'Event',
		),
		
    // Categories that refines IndividualEvent
        
        array(
			'label' => 'Birth',
			'name' => 'Birth',
			'description' => 'The event of a person entering into life.',
			'_refines'    => 'birth',
		),
        
        array(
			'label' => 'Adoption',
			'name' => 'Adoption',
			'description' => 'The event of creating of a legal parent/child relationship that does not exist biologically.',
			'_refines'    => 'IndividualEvent',
		),
        
        array(
			'label' => 'Baptism',
			'name' => 'Baptism',
			'description' => 'The ceremonial event held to admit a person to membership of a Christian church.',
			'_refines'    => 'IndividualEvent',
		),
        
        array(
			'label' => 'BarMitzvah',
			'name' => 'BArMitzvah',
			'description' => 'The ceremonial event held when a Jewish boy reaches age 13.',
			'_refines'    => 'IndividualEvent',
		),
		
		array(
			'label' => 'BasMitzvah',
			'name' => 'BAsMitzvah',
			'description' => 'The ceremonial event held when a Jewish girl reaches age 13, also know as Bat Mitzvah.',
			'_refines'    => 'IndividualEvent',
		),
        
        array(
			'label' => 'Enrolment',
			'name' => 'Enrolment',
			'description' => 'The event of a person initiating attendence to a school or other place of learning.',
			'_refines'    => 'IndividualEvent',
		),
        
        array(
			'label' => 'Graduation',
			'name' => 'Graduation',
			'description' => 'The event of a person being awarded educational diplomas or degrees.',
			'_refines'    => 'IndividualEvent',
		),
        
        array(
			'label' => 'NameChange',
			'name' => 'Change of Name',
			'description' => 'The event of a person changing their name.',
			'_refines'    => 'IndividualEvent',
		),
        
        array(
			'label' => 'Emigration',
			'name' => 'Emigration',
			'description' => 'The event of a person leaving their homeland with the intent of residing elsewhere.',
			'_refines'    => 'IndividualEvent',
		),
        
        array(
			'label' => 'Naturalization',
			'name' => 'Naturalization',
			'description' => 'The event of a person obtaining citizenship. Note that the place the naturalization event occurs at may be different from the state the person is obtaining citizenship of.',
			'_refines'    => 'IndividualEvent',
		),
        
        array(
			'label' => 'Imprisonment',
			'name' => 'Imprisonment',
			'description' => 'The event of a person being detained in a jail or prison.',
			'_refines'    => 'IndividualEvent',
		),
        
    // Categories related to Change of Position
        
        array(
			'label' => 'PositionChange',
			'name' => 'Change of Position',
			'description' => 'The event of a person changing the position they hold with an employer.',
			'_refines'    => 'IndividualEvent',
		),
        
        array(
			'label' => 'Accesion',
			'name' => 'Accesion',
			'description' => 'The event of a person succeeding to the right to hold regal power. This event is often automatic on the death of the previous monarch and is usually followed by a coronation event.',
			'_refines'    => 'IndividualEvent',
		),
        
        array(
			'label' => 'Coronation',
			'name' => 'Coronation',
			'description' => 'The ceremonial event of a person being invested with regal power to become a monarch.',
			'_refines'    => 'IndividualEvent',
		),
        
        array(
			'label' => 'Employment',
			'name' => 'Employment',
			'description' => 'The event of a person entering an occupational relationship with an employer.',
			'_refines'    => 'IndividualEvent',
		),
        
        array(
			'label' => 'Inauguration',
			'name' => 'Inauguration',
			'description' => 'The ceremonial event marking the beginning of a person\'s term of office as a leader.',
			'_refines'    => 'IndividualEvent',
		),
        
        array(
			'label' => 'Investiture',
			'name' => 'Investiture',
			'description' => 'The ceremonial event of a person taking a public office or honour.',
			'_refines'    => 'IndividualEvent',
		),
        
        array(
			'label' => 'Ordination',
			'name' => 'Ordination',
			'description' => 'The ceremonial event held when a person receives authority to act in religious matters.',
			'_refines'    => 'IndividualEvent',
		),
        
        array(
			'label' => 'Promotion',
			'name' => 'Promotion',
			'description' => 'The event of a person changing the position they hold with an employer to one with more importance or responsibility.',
			'_refines'    => 'PositionChange',
		),
        
        array(
			'label' => 'Redundancy',
			'name' => 'Redundancy',
			'description' => 'The event of a person involuntarily giving up an office or position that is no longer needed. Redundancy is usually perceived to be the employer\'s fault and is usually due to conditions outside of the employee\'s control.',
			'_refines'    => 'IndividualEvent',
		),
        
        array(
			'label' => 'Dismissal',
			'name' => 'Dismissal',
			'description' => 'The event of a person involuntarily giving up their office or position. Dismissal is often perceived to be the employee\'s fault and may be considered disgraceful.',
			'_refines'    => 'IndividualEvent',
		),
        
        array(
			'label' => 'Resignation',
			'name' => 'Resignation',
			'description' => 'The event of a person voluntarily giving up or quitting their office or position.',
			'_refines'    => 'PositionChange',
		),
        
        array(
			'label' => 'Retirement',
			'name' => 'Retirement',
			'description' => 'The event of a person exiting an occupational relationship with an employer after a qualifying time period. In many cultures retirement is expected and even required once the person reaches a particular age.',
			'_refines'    => 'IndividualEvent',
		),
        
        array(
			'label' => 'Demotion',
			'name' => 'Demotion',
			'description' => 'The event of a person changing the position they hold with an employer to one with less importance or responsibility.',
			'_refines'    => 'PositionChange',
		),
    
    
    // categories associated with Death
        
        array(
			'label' => 'Death',
			'name' => 'Death',
			'description' => 'The event of a person\'s life ending.',
			'_refines'    => 'death',
		),
        
        array(
			'label' => 'Assassination',
			'name' => 'Assassination',
			'description' => 'The event of a person being deliberately targeted and killed.',
			'_refines'    => 'Murder',
		),
        
        array(
			'label' => 'Murder',
			'name' => 'Murder',
			'description' => 'The event of a person being killed unlawfully with intent by the killer.',
			'_refines'    => 'Death',
		),
        
        array(
			'label' => 'Execution',
			'name' => 'Execution',
			'description' => 'The event of a person being deliberately killed as punishment.',
			'_refines'    => 'Death',
		),
        
        array(
			'label' => 'Funeral',
			'name' => 'Funeral',
			'description' => 'The event of marking a person\'s death with a ceremony.',
			'_refines'    => 'IndividualEvent',
		),
        
        array(
			'label' => 'Burial',
			'name' => 'Burial',
			'description' => 'The event of interring the remains of a person\'s body into the ground.',
			'_refines'    => 'IndividualEvent',
		),
        
        array(
			'label' => 'Cremation',
			'name' => 'Cremation',
			'description' => 'The event of disposing of the remains of a person\'s body by fire.',
			'_refines'    => 'IndividualEvent',
		),
        
    // categories that refines Group Event
        
		array(
			'label' => 'GroupEvent',
			'name' => 'Group Event',
			'description' => 'A type of event that is principally about one or more agents and their partnership. Other agents may be involved but the event is most significant for the partner agent.',
			'_refines'    => 'Event',
		),
		
        array(
			'label' => 'Marriage',
			'name' => 'Marriage',
			'description' => 'The event of creating uniting the participants into a new family unit, sometimes accompanied by a formal wedding ceremony. This is intended to cover a broad range of marriages including those given formal legal standing, common-law, or by convention. It is not restricted to marriages of two people of the opposite gender, but also includes polygamous and same-sex unions.',
			'_refines'    => 'GroupEvent',
		),
		
        array(
			'label' => 'Divorce',
			'name' => 'Divorce',
			'description' => 'The event of legally dissolving a marriage.',
			'_refines'    => 'GroupEvent',
		),
		
		array(
			'label' => 'Annulment',
			'name' => 'Annulment',
			'description' => 'The event of declaring a marriage void from the beginning as though it never existed.',
			'_refines'    => 'GroupEvent',
		),
		
	// Properties of an event
	
		array(
			'label' => 'date',
			'name' => 'Date',
			'description' => 'The date at which an event occurred.',
			'_refines'    => 'Event',
		),
		
		array(
			'label' => 'place',
			'name' => 'Place',
			'description' => 'The place at which an event occurred.',
			'_refines'    => 'Event',
		),
		
		array(
			'label' => 'state',
			'name' => 'State',
			'description' => 'A country or independent territory that is involved in an event.',
			'_refines'    => 'Event',
		),
		
		array(
			'label' => 'position',
			'name' => 'Position',
			'description' => 'The employment position or public office involved in an event.',
			'_refines'    => 'Event',
		),
		
	// Properties that relate an event to an agent
	
		array(
			'label' => 'agent',
			'name' => 'Agent',
			'description' => 'A person, organization or group that plays a role in an event.',
			'_refines'    => 'Event',
		),
		
		array(
			'label' => 'parent',
			'name' => 'Parent',
			'description' => 'A person that takes the parent role in an event.',
			'_refines'    => 'Event',
		),
		
		array(
			'label' => 'employer',
			'name' => 'Employer',
			'description' => 'An agent that is involved in an event as an employer.',
			'_refines'    => 'Event',
		),
		
		array(
			'label' => 'officiator',
			'name' => 'Officiator',
			'description' => 'A person that officiates at a ceremonial event.',
			'_refines'    => 'Event',
		),
		
		array(
			'label' => 'organization',
			'name' => 'Organization',
			'description' => 'An organization that plays a role in an event.',
			'_refines'    => 'Event',
		),
		
		array(
			'label' => 'principal',
			'name' => 'Principal',
			'description' => 'A person that takes the primary and most important role in an event. For example the principal in a Birth event would be the child being born and the principal in a Burial event would be the deceased person.',
			'_refines'    => 'Event',
		),
		
		array(
			'label' => 'partner',
			'name' => 'Partner',
			'description' => 'A person that is involved in a event as a partner in a relationship.',
			'_refines'    => 'Event',
		),
		
		array(
			'label' => 'witness',
			'name' => 'Witness',
			'description' => 'A person that witnesses and can bear testimony to the occurrence of an event.',
			'_refines'    => 'Event',
		),
		
		array(
			'label' => 'spectator',
			'name' => 'Spectator',
			'description' => 'A person that is present at and observes the occurrence of at least part of an event.',
			'_refines'    => 'Event',
		),
		
	// Properties that relate an event to another event:
		
		array(
			'label' => 'concurrentEvent',
			'name' => 'Concurrent Event',
			'description' => 'An event that occurs while this event is occurring. The events need not start or conclude at the same times.',
			'_refines'    => 'Event',
		),
		
		array(
			'label' => 'immediatelyPrecedingEvent',
			'name' => 'Immediately Preceding Event',
			'description' => 'An event that occurs and concludes immediately before this event.',
			'_refines'    => 'Event',
		),
		
		array(
			'label' => 'precedingEvent',
			'name' => 'Preceding Event',
			'description' => 'An event that occurs and concludes at some time before this event.',
			'_refines'    => 'Event',
		),
		
		array(
			'label' => 'immediatelyFollowingEvent',
			'name' => 'Immediately Following Event',
			'description' => 'An event that starts immediately after this event.',
			'_refines'    => 'Event',
		),
		
		array(
			'label' => 'followingEvent',
			'name' => 'Following Event',
			'description' => 'An event that starts at some time after this event.',
			'_refines'    => 'Event',
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
