<?php
vc_map(array(
    "name" => 'Google Map',
    "base" => "zo_googlemap",
    "icon" => "zo_icon_for_vc",
    "category" => __('Ohyeahthemes Shortcodes', 'ohyeahthemes'),
    "description" => __('Map API V3 Unlimited Style', 'ohyeahthemes'),
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => __('API Key', 'ohyeahthemes'),
            "param_name" => "api",
            "value" => '',
            "description" => __('Enter you api key of map, get key from (https://console.developers.google.com)', 'ohyeahthemes')
        ),
        array(
            "type" => "textfield",
            "heading" => __('Address', 'ohyeahthemes'),
            "param_name" => "address",
            "value" => 'New York, United States',
            "description" => __('Enter address of Map', 'ohyeahthemes')
        ),
        array(
            "type" => "textfield",
            "heading" => __('Coordinate', 'ohyeahthemes'),
            "param_name" => "coordinate",
            "value" => '',
            "description" => __('Enter coordinate of Map, format input (latitude, longitude)', 'ohyeahthemes')
        ),
        array(
            "type" => "checkbox",
            "heading" => __('Click Show Info window', 'ohyeahthemes'),
            "param_name" => "infoclick",
            "value" => array(
                __("Yes, please", 'ohyeahthemes') => true
            ),
            "description" => __('Click a marker and show info window (Default Show).', 'ohyeahthemes')
        ),
        array(
            "type" => "textfield",
            "heading" => __('Marker Coordinate', 'ohyeahthemes'),
            "param_name" => "markercoordinate",
            "value" => '',
            "description" => __('Enter marker coordinate of Map, format input (latitude, longitude)', 'ohyeahthemes')
        ),
        array(
            "type" => "textfield",
            "heading" => __('Marker Title', 'ohyeahthemes'),
            "param_name" => "markertitle",
            "value" => '',
            "description" => __('Enter Title Info windows for marker', 'ohyeahthemes')
        ),
        array(
            "type" => "textarea",
            "heading" => __('Marker Description', 'ohyeahthemes'),
            "param_name" => "markerdesc",
            "value" => '',
            "description" => __('Enter Description Info windows for marker', 'ohyeahthemes')
        ),
        array(
            "type" => "attach_image",
            "heading" => __('Marker Icon', 'ohyeahthemes'),
            "param_name" => "markericon",
            "value" => '',
            "description" => __('Select image icon for marker', 'ohyeahthemes')
        ),
        array(
            "type" => "textarea_raw_html",
            "heading" => __('Marker List', 'ohyeahthemes'),
            "param_name" => "markerlist",
            "value" => '',
            "description" => __('[{"coordinate":"41.058846,-73.539423","icon":"","title":"title demo 1","desc":"desc demo 1"},{"coordinate":"40.975699,-73.717636","icon":"","title":"title demo 2","desc":"desc demo 2"},{"coordinate":"41.082606,-73.469718","icon":"","title":"title demo 3","desc":"desc demo 3"}]', 'ohyeahthemes')
        ),
        array(
            "type" => "textfield",
            "heading" => __('Info Window Max Width', 'ohyeahthemes'),
            "param_name" => "infowidth",
            "value" => '200',
            "description" => __('Set max width for info window', 'ohyeahthemes')
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Map Type", 'ohyeahthemes'),
            "param_name" => "type",
            "value" => array(
                "ROADMAP" => "ROADMAP",
                "HYBRID" => "HYBRID",
                "SATELLITE" => "SATELLITE",
                "TERRAIN" => "TERRAIN"
            ),
            "description" => __('Select the map type.', 'ohyeahthemes')
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Style Template", 'ohyeahthemes'),
            "param_name" => "style",
            "value" => array(
                "Default" => "",
                "Custom" => "custom",
                "Light Monochrome" => "light-monochrome",
                "Blue water" => "blue-water",
                "Midnight Commander" => "midnight-commander",
                "Paper" => "paper",
                "Red Hues" => "red-hues",
                "Hot Pink" => "hot-pink"
            ),
			"dependency" => array(
				"element"=>"type",
				"value" => "ROADMAP"
			),
            "description" => 'Select your heading size for title.'
        ),
        array(
            "type" => "textarea",
            "heading" => __('Custom Template', 'ohyeahthemes'),
            "param_name" => "content",
            "value" => '',
			"dependency" => array(
				"element"=>"style",
				"value" => "custom"
			),
            "description" => __('Get template from http://snazzymaps.com', 'ohyeahthemes')
        ),
        array(
            "type" => "textfield",
            "heading" => __('Zoom', 'ohyeahthemes'),
            "param_name" => "zoom",
            "value" => '13',
            "description" => __('zoom level of map, default is 13', 'ohyeahthemes')
        ),
        array(
            "type" => "textfield",
            "heading" => __('Width', 'ohyeahthemes'),
            "param_name" => "width",
            "value" => 'auto',
            "description" => __('Width of map without pixel, default is auto', 'ohyeahthemes')
        ),
        array(
            "type" => "textfield",
            "heading" => __('Height', 'ohyeahthemes'),
            "param_name" => "height",
            "value" => '350px',
            "description" => __('Height of map without pixel, default is 350px', 'ohyeahthemes')
        ),
        array(
            "type" => "checkbox",
            "heading" => __('Scroll Wheel', 'ohyeahthemes'),
            "param_name" => "scrollwheel",
            "value" => array(
                __("Yes, please", 'ohyeahthemes') => true
            ),
            "description" => __('If false, disables scrollwheel zooming on the map. The scrollwheel is disable by default.', 'ohyeahthemes')
        ),
        array(
            "type" => "checkbox",
            "heading" => __('Pan Control', 'ohyeahthemes'),
            "param_name" => "pancontrol",
            "value" => array(
                __("Yes, please", 'ohyeahthemes') => true
            ),
            "description" => __('Show or hide Pan control.', 'ohyeahthemes')
        ),
        array(
            "type" => "checkbox",
            "heading" => __('Zoom Control', 'ohyeahthemes'),
            "param_name" => "zoomcontrol",
            "value" => array(
                __("Yes, please", 'ohyeahthemes') => true
            ),
            "description" => __('Show or hide Zoom Control.', 'ohyeahthemes')
        ),
        array(
            "type" => "checkbox",
            "heading" => __('Scale Control', 'ohyeahthemes'),
            "param_name" => "scalecontrol",
            "value" => array(
                __("Yes, please", 'ohyeahthemes') => true
            ),
            "description" => __('Show or hide Scale Control.', 'ohyeahthemes')
        ),
        array(
            "type" => "checkbox",
            "heading" => __('Map Type Control', 'ohyeahthemes'),
            "param_name" => "maptypecontrol",
            "value" => array(
                __("Yes, please", 'ohyeahthemes') => true
            ),
            "description" => __('Show or hide Map Type Control.', 'ohyeahthemes')
        ),
        array(
            "type" => "checkbox",
            "heading" => __('Street View Control', 'ohyeahthemes'),
            "param_name" => "streetviewcontrol",
            "value" => array(
                __("Yes, please", 'ohyeahthemes') => true
            ),
            "description" => __('Show or hide Street View Control.', 'ohyeahthemes')
        ),
        array(
            "type" => "checkbox",
            "heading" => __('Over View Map Control', 'ohyeahthemes'),
            "param_name" => "overviewmapcontrol",
            "value" => array(
                __("Yes, please", 'ohyeahthemes') => true
            ),
            "description" => __('Show or hide Over View Map Control.', 'ohyeahthemes')
        )
    )
));

class WPBakeryShortCode_zo_googlemap extends ZoShortcode
{

    protected function content($atts, $content = null)
    {
        return parent::content($atts, $content);
    }
}