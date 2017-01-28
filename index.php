<?php 
	require 'lib/functions.php';
	
		$output_gif			=	"gif/source/01.gif";
		$placeholder		=	"Type your message here (optional)";
		
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
		$file_key_stamp	=	rand().'_'.time();
		 $op_frame_name=	$frame_directory.$file_key_stamp;
		
		// Output GIF directory
		$output_gif_dir	=	'gif/output/';
		
		
		

	extract_gif($source_gif,$op_frame_name);
	
	
	foreach (scandir($frame_directory) as $file) {
			if ('.' === $file) continue;
			if ('..' === $file) continue;
			
			
			
			$source	=	$frame_directory.$file;
			
			$image	=	imagecreatefromjpeg($source);
			
			$output	=	$output_frames.$file_key_stamp.'_'.substr($file,-8);
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
		exec('convert   -delay 30   -loop 0   '.$output_frames.$file_key_stamp.'_'.'*.jpg '.$output_gif);
		$image_url	=	$site_url.$output_gif;
		
		
		//$recent_frame_dir	=	'gif/output_frame/'.$image_key.'/';
		
		foreach (scandir($output_frames) as $frames) {
			if ('.' === $frames) continue;
			if ('..' === $frames) continue;
			
			
			
			if(file_exists($output_frames.'/'.$frames)){
				if(filemtime($output_frames.'/'.$frames)+600<=time()){
					unlink($output_frames.'/'.$frames);
				}
			}
			
			
			
		}
}	
?>
<!doctype html>
	<head>
		<meta charset="utf-8" /> 
		<meta name="viewport" content="initial-scale=1.0">
		<meta property="og:image"	content="images/result_image.jpg" />
		<meta property="og:title" 		content="Add text to GIF image Demo" />
		<meta property="og:description" content="Select animation, add your text and save output image or share it." />
		<title>Happy Galentine's Day Everybody</title>
		<meta name="description" content="Select animation, add your text and save output image or share it.">
		<!-- <link rel="stylesheet" href="css/bootstrap.min.css"> -->
		<link rel="stylesheet" href="css/foundation.css?v=1">
		<link rel="stylesheet" href="css/main.css?v=9">
	
		
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
		
		
			<div class="head-section">
				<h1>Create Your Girl Power Candy Heart Valentine</h1>
				<p class="hide-for-small-only">Choose a saying, Customize and Share!</p>
				<p class="hide-for-medium">Write a Message, Choose a Saying and Share!</p>
			</div>
			
					<div class="row top-row">
				<div class="columns small-12 medium-7 small-order-1 medium-order-2">
					<div class="img-wrap" id="img-wrap">
						<img class="output" src="<?php echo $output_gif;?>">
						
						<div class="preview_text">
							
						</div>
					</div>
					
				</div>

				<div class="columns small-12 medium-5 small-order-2 medium-order-1">
					<h2>Choose a Girl Power Saying</h2>
					<form class="form" id="form" action="" method="post">
						<div class="form-group radio-group">
							<div class="radio">
								<input type="radio" class="image_radio" checked name="image" value="01" id="uteruses"> 
								<label for="uteruses">Uteruses Before Duderuses</label>
								<img class="hidden" width="100" src="gif/source/01.gif">
							</div>
							<div class="radio">
								<input type="radio" name="image" class="image_radio" value="02" id="person"> 
								<label for="person">You Are My Person</label>
								<img class="hidden" width="100" src="gif/source/02.gif">
							</div>
							
							<div class="radio">
								<input type="radio" class="image_radio" name="image" value="03" id="wine"> 
								<label for="wine">I'd Share My Wine With You</label>
								<img class="hidden" width="100" src="gif/source/01.gif">
							</div>
							
							<div class="radio">
								<input type="radio" name="image" class="image_radio" value="04" id="femaf"> 
								<label for="femaf">Feminist AF</label>
								<img class="hidden" width="100" src="gif/source/02.gif">
							</div>
							
							<div class="radio">
								<input type="radio" class="image_radio" name="image" value="05" id="boss"> 
								<label for="boss">You're a Boss Lady</label>
								<img class="hidden" width="100" src="gif/source/01.gif">
							</div>
							
							<div class="radio">
								<input type="radio" name="image" class="image_radio" value="06" id="tropical"> 
								<label for="tropical">You're a Beautiful Tropical Fish</label>
								<img class="hidden" width="100" src="gif/source/02.gif">
							</div>

							<div class="radio">
								<input type="radio" name="image" class="image_radio" value="07" id="catlady"> 
								<label for="catlady">Cat Ladies Forever</label>
								<img class="hidden" width="100" src="gif/source/02.gif">
							</div>

							<div class="radio">
								<input type="radio" name="image" class="image_radio" value="08" id="world"> 
								<label for="world">Who Runs The World?</label>
								<img class="hidden" width="100" src="gif/source/02.gif">
							</div>

							<div class="radio">
								<input type="radio" name="image" class="image_radio" value="09" id="ovaries"> 
								<label for="ovaries">Ovaries Before Brovaries</label>
								<img class="hidden" width="100" src="gif/source/02.gif">
							</div>

							<div class="radio">
								<input type="radio" name="image" class="image_radio" value="10" id="smash"> 
								<label for="smash">Smash the Patriarchy</label>
								<img class="hidden" width="100" src="gif/source/02.gif">
							</div>
							
						</div>
						<?php if($placeholder!=''){
						?>
						<div id="desktop-textarea" style="">
							<div class="text-overlay" id="text-entry">
								<h2>Write a personal message:</h2>
								<textarea class="form-control" type="text" id="input_text" name="text"  value="" placeholder="<?php echo $placeholder;?>" maxlength="100" required></textarea>
							</div>
						</div>

					
						
						<div class="form-group action-buttons">
							<button class="button" id="save">
								Save Your Heart
							</button>
							<div  id="loading" class="loading">
								<i class="fa fa-spinner fa-spin fa-lg"></i> 
								Generating Output image...
							</div>
						</div>
							
						<?php
						}
						?>
						
						<?php if($placeholder==''){
						?>
						<p class="text-danger"><a href="<?php echo $_SERVER['PHP_SELF']; ?>"><span class="btn btn-default btn-block"><i class="fa fa-undo"></i> Add New Text</span></a></p>
						
						<?php
						}?>
					
					</form>
				


				</div>



				<div class="columns small-12 small-order-3">
					<?php if($placeholder==''){
						?>
					<h2 class="margin-bottom-0">Share Your Heart!</h2>
							<p>or save to send in email:</p>
				    <div class="stacked-for-small expanded button-group">
					    <a href="#" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u='+encodeURIComponent('<?php echo $image_url;?>'), 'facebook-share-dialog', 'width=626,height=436'); return false;" class="button fb-share">
						    <i class="fa fa-facebook fa-3x"></i> 
						    <div class="social-text">share it</div>
					    </a>
					   
					    <a href="http://www.pinterest.com/pin/create/button/?url=<?php echo $image_url;?>&amp;media=<?php echo $image_url;?>&amp;description=Happy Galentines Day!" data-pin-do="buttonPin" data-pin-config="above" class="button pint-share" target="_blank">
					        <i class="fa fa-pinterest fa-3x"></i> 	
					        <div class="social-text">pin it</div>
					    </a>
					    <a href="https://twitter.com/share?text=Sharing my heart &amp;url=<?php echo $image_url;?>" target="_blank" class="button tweet-share">
							<i class="fa fa-twitter fa-3x"></i><div class="social-text">tweet it</div>
					    </a>
					    <a download="<?php echo $image_url;?>" href="<?php echo $image_url;?>" title="Your Galentine's Heart" class="button download-share">
						    <i class="fa fa-download fa-3x"></i>
						    <div class="social-text">download it</div>
						</a>
					</div>
					<?php 
					}	
					?>
				</div>
			</div>
		</div>
		<script src="js/vendor/what-input.js"></script>
		<script src="js/vendor/modernizr.js"></script>
		<script src="js/script.js?v=2"></script>
		<script>
		delete_frame(111);
		</script>
		

	</body>
<!doctype!>