<?php
if ( ! defined( 'JM_TC_VERSION' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit();
}

if( class_exists('JM_TC_Options') ) {


	class JM_TC_Preview extends JM_TC_Options {
		
		
		function show_preview($post_ID){
			
			/* most important meta */
			$cardType_arr 		= parent::cardType( $post_ID ) ;
			$creator_arr 		= parent::creatorUsername( true ) ;
			$site_arr			= parent::siteUsername() ;
			$title_arr 			= parent::title( $post_ID );
			$description_arr 	= parent::description( $post_ID );
			$img_arr 			= parent::image( $post_ID );
			
			
			/* secondary meta */
			$product_arr = parent::product( $post_ID );
			$player_arr  = parent::player( $post_ID );
			
			
			$app 			= '';
			$size 			= 16;
			$class  		= 'featured-image';
			$tag			= 'img';
			$close_tag 		= '';
			$src			= 'src';
			$product_meta 	= '';
			
			if( in_array($cardType_arr ,array( 'summary_large_image') ) ) {
				
				$styles = "width:100%;";
				$size   = "100%";	
			}
			
			elseif( in_array($cardType_arr ,array( 'photo') ) ) {
				
				$styles = "width:100%;";
				$size   = "100%";
				
			}

			elseif( in_array($cardType_arr ,array( 'player') ) ) {
				
				$styles 	= "width:100%;";
				$src		= "controls poster";
				$tag    	= "video";
				$close_tag 	= "</video>";
				$size   	= "100%";
				
			}
			
			elseif( in_array($cardType_arr ,array( 'summary' ) ) ) {
				
				$styles = "float:right; width: 60px; height: 60px; margin-left:.6em;";
				$size   = 60;
				
			}
			
			elseif( in_array($cardType_arr ,array( 'product' ) ) ) {
				
				$product_meta  = '<div style="position:relative;">';
			
			
				foreach ($product as $meta => $value) $product_meta .= '<div>'.$value.'</div>';
			
			
				$product_meta .= '</div>';
				
				$styles 	= "float:left; width: 120px; height: 120px; margin-right:.6em;";
				$size    = 120;
			}
			
			elseif( in_array($cardType_arr ,array( 'app') ) ) {
				
				$app = '<div class="gray" style="postion:relative;">Get app</div>';
			}
			
			else {
				
				$styles = "position: absolute; width: 120px; height: 120px; left: 0px; top: 0px;";
			}
			
			
			$output  = '<div class="fake-twt">';
			$output .= '<div class="fake-twt-timeline">';
			$output .= '<div class="fake-twt-tweet">'; 
			
			
			$output .= '<div class="e-content">

							'.get_avatar( false, 16 ).'	
							
							<span>'.__('Name associated with ','jm-tc').$site_arr['site'].'</span>

							<div style="position:relative;">
								<'.$tag.' class="'.$class.'" width="'.$size.'" height="'.$size.'" style="'.$styles.' -webkit-user-drag: none; " '.$src.'="'.$img_arr['image:src'].'">'.$close_tag.'
							</div>

							'
			.$product_meta.
			'
							
							<div style= "position:relative;"><strong>'.$title_arr['title'].'</strong></div>
							<div style= "position:relative;"><em>By '.__('Name associated with ','jm-tc').$creator_arr['creator'].'</em></div><div>'.$description_arr['description'].'</div>
							
							'
			.$app.
			'
							<div style="position:relative;" class="gray"><strong>'.__('View on the web','jm-tc').'<strong></div>
						
						</div>';
			
			$output .= '</div>';
			$output .= '</div>';
			$output .= '</div>';
			
			return $output;
			
		}
		
		
	}
	
	
}