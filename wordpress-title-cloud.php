<?php

Class wordpress_title_cloud{
    
    function show_cloud(){
    
    $oStyle= json_decode(get_option('wp-titlecloud_styles'));   
    $includes=get_option('wp-titlecloud_pages');
    global $wpdb;
    
    $aMin = $wpdb->get_row("SELECT MIN(meta_value) as min FROM $wpdb->postmeta WHERE meta_key ='bezoekers' and meta_value!='0'", ARRAY_A);
    $min=$aMin['min'];
    $oMax= $wpdb->get_results("SELECT meta_value as maxv FROM $wpdb->postmeta WHERE meta_key ='bezoekers'");
    $mx=1;
    foreach($oMax as $mItem){
        if(trim($mItem->maxv)>$mx){

            $mx=$mItem->maxv;
        }
    }
    $max=$mx;
 
    $querystr = "
		SELECT DISTINCT wposts.post_title as title,wposts.ID as ID,wpostmeta.meta_value as meta_value
		FROM $wpdb->posts wposts
		LEFT JOIN $wpdb->postmeta wpostmeta
		ON wposts.ID = wpostmeta.post_id 
		WHERE wpostmeta.meta_key = 'bezoekers' 
        AND wposts.ID  IN ({$includes})
		ORDER BY wposts.post_date DESC
		";

        $pageposts = $wpdb->get_results($querystr, OBJECT);
         $r="";
        foreach($pageposts as $x){
            $f=$x->meta_value;
            $fontsize=($oStyle->largest - $oStyle->smallest) * ($f/ $max) + $oStyle->smallest;
            $r.="<a href='". get_permalink( $x->ID )."' style='font-size:{$fontsize}px' rel='{$x->ID}-{$f}' title='{$x->title}' >".$x->title."</a>, ";
        }
	echo "<div id=\"footer-cloud\">".substr($r,0,-2)."</div>";


    }
    
         function cloud_visit($id){
            $visits=get_post_meta($id, "bezoekers",true);
			$oStyle= json_decode(get_option('wp-titlecloud_styles'));   
            if(  strlen(trim($visits))>0){
            if( $visits==0){
            }else{
                $visits++;
                update_post_meta($id, "bezoekers", $visits);
            }
            }else{
					if($oStyle->auto=='1'){	
					add_post_meta($id, "bezoekers", 1);
                    $included=get_option('wp-titlecloud_pages');
                            if(strlen($included)>1){
                                $included.=",".$id;
                               update_option('wp-titlecloud_pages', $included);                  
                            }
					}else{
					add_post_meta($id, "bezoekers", 0);
					}
        	}
        }
        function titlecloudy_css() {
              $oStyle= json_decode(get_option('wp-titlecloud_styles'));   
      
            	echo "
            	<style type='text/css'>
                /* wordpress title cloud styles*/
            		#footer-cloud a{
            		  color:'{$oStyle->color}';
                      font-family:'{$oStyle->font}';
            		}
            	</style>
            	";
        }
        
        
        
            
}