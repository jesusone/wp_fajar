<?php
	$params = array(
		array(
			"type" => "dropdown",
			"heading" => __("Title Size",'creativ'),
			"param_name" => "zo_title_size",
			"value" => array(
					"H2" => "h2",
					"H3" => "h3",
					"H4" => "h4",
					"H5" => "h5",
					"H6" => "h6"
			)
		),
        array(
            "type" => "dropdown",
            "heading" => __("Style",'creativ'),
            "param_name" => "zo_fancybox_style",
            "value" => array(
                "Default" => "",
                "Large" => "large",
            )
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Align",'creativ'),
            "param_name" => "zo_fancybox_align",
            "value" => array(
                "Left" => "",
                "Right" => "right",
            ),
            "template" => array(
                'zo_fancybox_single--style-2.php'
            )
        ),
	);
