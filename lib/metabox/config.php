<?php

add_action('cmb2_admin_init','metabox_for_posts');
function metabox_for_posts(){
	$box=new_cmb2_box(array(
		'id'			=>	'additional-box',
		'object_types'	=>	array('post'),
		'title'			=>	__('Additional Fields','comet')
	));

	$box->add_field(array(
		'id'	=>	'_for-video',
		'type'	=>	'oembed',
		'name'	=>	'Video URL'
	));
	$box->add_field(array(
		'id'	=>	'_for-audio',
		'type'	=>	'text',
		'name'	=>	'Audio URL'
	));
	$box->add_field(array(
		'id'	=>	'_for-gallery',
		'type'	=>	'file_list',
		'name'	=>	'Gallery Images'
	));


	$sliders=new_cmb2_box(array(
		'id'			=>	'additional-for-field',
		'object_types'	=>array('comet-slider'),
		'title'			=>'Additional Fields'
	));

	$sliders->add_field(array(
		'name'	=>	'Subtitle',
		'id'	=>	'_slider-subtitle',
		'type'	=>	'text'
	));
	$sliders->add_field(array(
		'name'	=>	'First Button Text',
		'id'	=>	'_first-button-text',
		'type'	=>	'text'
	));
	$sliders->add_field(array(
		'name'	=>	'First Button URL',
		'id'	=>	'_first-button-url',
		'type'	=>	'text'
	));
	$sliders->add_field(array(
		'name'		=>	'First Button Type',
		'id'		=>	'_first-button-type',
		'type'		=>	'select',
		'options'	=>	array(
			'red'	=>	'Red Button',
			'transparent'	=>	'Transparent Button'
		)
	));
}