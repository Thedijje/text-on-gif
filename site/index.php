<?php 
	require 'lib/functions.php';
	
		$output_gif			=	"gif/source/01.gif";
		$placeholder		=	"TYPE YOUR MESSAGE HERE";
		
		if(isset($_POST['text']) OR isset($_GET['text'])){
			$placeholder	=	"";
		}
$image_url	=	"";
$site_url		=	'http://'.$_SERVER['HTTP_HOST'].'/';

if(isset($_POST['text']) OR isset($_GET['text'])){
	$image_key			=	$_POST['image'];
	
	$source_gif			=	'gif/source/'.$image_key.'.gif';
	
		/*
		|	Directory where output frame is to be put after extraxction;
		|	This directory will be switched based on image that user has selected
		*/
		$frame_directory = "gif/frames/".$image_key."/";
		
		/*
		|	Directory where frames to	be kept after writing text;
		*/
		$output_frames 	= "gif/output_frame/".$image_key."/";
		
		// Random name for file for output frame.
		//$output_name		=	'42847fb966c4969e9b197488aedc3956';
		
		//$op_frame_name=	$frame_directory;
		 $op_frame_name=	$frame_directory.md5(rand().'_'.time());
		
		// Output GIF directory
		$output_gif_dir	=	'gif/output/';
		
		
		

	extract_gif($source_gif,$op_frame_name);
	
	
	foreach (scandir($frame_directory) as $file) {
			if ('.' === $file) continue;
			if ('..' === $file) continue;
			
			
			
			$source	=	$frame_directory.$file;
			
			$image	=	imagecreatefromjpeg($source);
			
			$output	=	$output_frames.$file;
			$fontsize	=	"22";
			$text		= $_POST['text'];
			if($text==''){
				$text	=	$_GET['text'];
			}
			
			$text2		=	'';
			
			if(strlen($text)>40){
				$text2	=	substr($text,40,70);
				$text	=	substr($text,0,40).'-';
				
			}
			
			$white		=	imagecolorallocate($image,255,255,255);
			$black		=	imagecolorallocate($image,0,0,0);
			
			$rotation	=	0;
			$origin_x	=	get_initial_x(strlen($text));
			$origin_2x=	get_initial_x(strlen($text2));
			$origin_y	=	410;
			$fonts		= 	"fonts/FrenteH1-Regular.otf";
			
			
			
			$text_1	=	imagettftext($image,$fontsize,$rotation,$origin_x+1,$origin_y,$black,$fonts,$text);
			
			if($text2!=''):
				$text_2	=	imagettftext($image,$fontsize,$rotation,$origin_2x,$origin_y+40,$black,$fonts,$text2);
			endif;
			
			
			imagejpeg($image,$output,99);
			
		
			
		}
		
		$output_gif	=	$output_gif_dir.md5(time().'_'.rand()).'.gif';
		exec('convert   -delay 30   -loop 0   '.$output_frames.'*.jpg '.$output_gif);
		$image_url	=	$site_url.$output_gif;
}	
?>
<!doctype html>
	<head>
		<meta property="og:image"	content="<?php if($image_url!=''){ echo $image_url;}else{ echo "gif/source/01.gif";};?>" />
		<meta property="og:title" 		content="Add text to GIF image Demo" />
		<meta property="og:description" content="Select animation, add your text and save output image or share it." />
		<title>Happy Galentine's Day Everybody</title>
		<meta name="description" content="Select animation, add your text and save output image or share it.">
		<meta name="description" content="Select animation, add your text and save output image or share it.">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/main.css">
	
		
		<script src="https://use.fontawesome.com/c88263cac1.js"></script>
	
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
		<script>
			$(document).ready(function(){
				$('#loading').hide();
			$('#form').submit(function(){
				$('#loading').show();
			});
			});
			
			
		</script>
		
			<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8&appId=925306954235344";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
		
		<style>
			.output{
			border-radius:10px;
			}
			
			img{
			margin:5px;
			border:1px solid #eee;
			padding:3px;
			}
		</style>
	</head>
	<body>
		<div class="container">
			<form class="form" id="form" action="" method="post">
			<div class="img-wrap">
				<img class="output" src="<?php echo $output_gif?>" width="540px">
				<div class="text-overlay" style="text-align:center;height:2em;<?php if($placeholder==''){echo "display:none;";}?>">
					<textarea class="form-control" type="text" id="input_text" name="text" value="" placeholder="<?php echo $placeholder;?>" maxlength="100" required></textarea>
				</div>
				<div class="preview_text">
					
				</div>
			</div>
			<?php if($placeholder==''){
			?>
			<p class="text-center text-danger"><a href="<?php echo $_SERVER['PHP_SELF']; ?>"><i class="fa fa-undo"></i> Add New Text</a></p>
			<?php
			}?>
			
			<div  id="loading" class="loading text-center">
						<i class="fa fa-spinner fa-spin fa-lg"></i> 
						Generating Output image...
			</div>
			<div class="sharing text-center">
			<button  class="btn btn-primary fb-share-button btn-sm" data-href="<?php echo $image_url;?>" data-layout="button" data-size="large" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $image_url;?>"></a></button>
				
				<a href="http://twitter.com/share?text=&url=<?php echo $image_url;?>&hashtags=hashtag1,hashtag2,hashtag3
" onclick="javascript:window.open(this.href,
  '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><button  class="btn btn-info btn-sm"><i class="fa fa-twitter fa-fw fa-2x"></i></button></a>
  
  
				<a href="https://plus.google.com/share?url=<?php echo $image_url;?>" onclick="javascript:window.open(this.href,
  '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><button class="btn btn-danger btn-sm"><i class="fa fa-google-plus fa-fw fa-2x"></i></button></a>
  
  
				<a href="http://pinterest.com/pin/create/button/?url=<?php echo $image_url;?>" onclick="javascript:window.open(this.href,
  '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><button class="btn btn-danger btn-sm"><i class="fa fa-pinterest fa-fw fa-2x"></i></button></a>
			</div>
			<div class="form-group radio-group">
			<div class="col-sm-12 radio">
				<label>
					<input type="radio" class="image_radio" checked name="image" value="01"> 
					Uteruses Before Duderuses
				</label>
				<img class="hidden" width="100" src="gif/source/01.gif">
			</div>

			<div class="col-sm-12 radio">
				<label>
					<input type="radio" name="image" class="image_radio" value="02"> 
					You Are My Person
				</label>
				<img class="hidden" width="100" src="gif/source/02.gif">
			</div>
			
			<div class="col-sm-12 radio">
				<label>
					<input type="radio" class="image_radio" name="image" value="03"> 
					I'd Share My Wine With You
				</label>
				<img class="hidden" width="100" src="gif/source/01.gif">
			</div>
			
			<div class="col-sm-12 radio">
				<label>
					<input type="radio" name="image" class="image_radio" value="04"> 
					Feminist AF
				</label>
				<img class="hidden" width="100" src="gif/source/02.gif">
			</div>
			
			<div class="col-sm-12 radio">
				<label>
					<input type="radio" class="image_radio" name="image" value="05"> 
					You're a Boss Lady
				</label>
				<img class="hidden" width="100" src="gif/source/01.gif">
			</div>
			
			<div class="col-sm-12 radio">
				<label>
					<input type="radio" name="image" class="image_radio" value="06"> 
					You're a Beautiful Tropical Fish
				</label>
				<img class="hidden" width="100" src="gif/source/02.gif">
			</div>

			<div class="col-sm-12 radio">
				<label>
					<input type="radio" name="image" class="image_radio" value="07"> 
					Cat Ladies Forever
				</label>
				<img class="hidden" width="100" src="gif/source/02.gif">
			</div>

			<div class="col-sm-12 radio">
				<label>
					<input type="radio" name="image" class="image_radio" value="08"> 
					Who Runs The World?
				</label>
				<img class="hidden" width="100" src="gif/source/02.gif">
			</div>

			<div class="col-sm-12 radio">
				<label>
					<input type="radio" name="image" class="image_radio" value="09"> 
					Ovaries Before Brovaries
				</label>
				<img class="hidden" width="100" src="gif/source/02.gif">
			</div>

			<div class="col-sm-12 radio">
				<label>
					<input type="radio" name="image" class="image_radio" value="10"> 
					Smash the Patriarchy
				</label>
				<img class="hidden" width="100" src="gif/source/02.gif">
			</div>
			
		</div>

				<br>
				<div class="form-group action-buttons">
					<button class="btn btn-primary" id="save">
						Submit
					</button>
					
				</div>
				
				</form>
			
		
		</div>
		<script src="js/script.js"></script>

	</body>
<!doctype!>