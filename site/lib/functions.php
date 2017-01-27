<?php 
	/*
		Function containing Image manupulation using imagick PHP extension_loaded
		@thedijje
		
	*/
	
	
	/*
		Function 		:	get_initial_x
		Description	:	Function return x margin where text input will be start,
								it takes number of character as argument 
								According to image width, it returns close to center alingment position.
		@thedijje
	*/
	function get_initial_x($char){
		$image_width	=	540;
		$mid_point		=	$image_width/2;
		$max_char		=	60;
		$per_char		=	9;
		$char;
		$len_required	=	$char*$per_char;
		
		return $mid_point-($len_required/2);
		
		
	}
	
	
	
	
	
	function set_source_dir(){
		
	
	}
	
	
	function extract_gif($source_gif,$op_frame_name){
		return TRUE;
		// Convert GIF image into frames of jpg to write text
		$extract	=	exec('convert '.$source_gif.' -coalesce '.$op_frame_name.'_%05d.jpg');
		exit();
	}
	
	function add_text_to_frames(){
		 
		
		combine_frame();
	}
	
	
	function combine_frame($output_gif_dir,$output_frames){
		
	}