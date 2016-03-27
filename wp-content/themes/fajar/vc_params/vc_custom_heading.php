<?php
/**
 * Add custom heading params
 * 
 * @author Fox
 * @since 1.0.0
 */
vc_add_param("vc_custom_heading", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => __("Custom Heading Style", 'fajar'),
	"admin_label" => true,
	"param_name" => "zo_custom_heading",
	"value" => array(
		"Default" => 'default',
		"Title Line Bottom - Style 1" => "style-1"
	)
));