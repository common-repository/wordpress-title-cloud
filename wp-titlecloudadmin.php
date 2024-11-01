   <?php  
   global $wpdb;
       if($_POST['txtHidden'] == 'Y') {  
           //Form data sent  
            $area = $_POST['ddlSelection'];
            $excludes=$_POST['txtExcludes'];
       
              
			$aProperty=array();
            
            $aProperty['font']=$_POST['txtFont'];
            $aProperty['color']=$_POST['txtColor'];
            $aProperty['smallest']=$_POST['txtSmallest'];
            $aProperty['largest']=$_POST['txtLargest'];
			$aProperty['auto']=$_POST['ddlAuto'];
            
            update_option('wp-titlecloud_area', $area);
		    update_option('wp-titlecloud_styles',json_encode($aProperty));
            $jdata=json_encode($aProperty);
            $oProperty=json_decode($jdata);              			
            
            if($_POST['selectedID']){
                foreach($_POST['selectedID'] as $z){
                    $includes.=$z.",";
                }
                $includes=substr($includes,0,-1);
            update_option('wp-titlecloud_pages', $includes);                 
            }else{
                update_option('wp-titlecloud_pages',0);
            }
           ?>  
            <?php $message="<div class=\"updated\"><p><strong>Options Saved</strong></p><p>$string</p></div>";  ?>  
           <?php  
       } else {  
           //Normal page display  
		   $area=get_option('wp-titlecloud_area');
           $includes=get_option('wp-titlecloud_pages'); 
		   $oProperty= json_decode(get_option('wp-titlecloud_styles'));
		   
       }  
       
       
       $allactivepagesquery = "SELECT ID,post_title from $wpdb->posts where post_status='publish' and post_type='page'";
       $includesArray=explode(',',$includes);
	   $allactivepages = $wpdb->get_results($allactivepagesquery, OBJECT);
       $options="";
       foreach($allactivepages as $x){
        if(in_array($x->ID,$includesArray)){
            $checked="checked='checked'";
        }else{
            $checked="";
        }
       $options.="<input type='checkbox' name='selectedID[]' value='$x->ID' $checked />$x->post_title <small><i>(".get_permalink($x->ID).")</i></small><br />";
       }

       $allactivepagesquery2 = "SELECT ID,post_title from $wpdb->posts where post_status='publish' and post_type='post'";
       $includesArray=explode(',',$includes);
	   $allactivepages = $wpdb->get_results($allactivepagesquery2, OBJECT);
       $options2="";
       foreach($allactivepages as $x){
        if(in_array($x->ID,$includesArray)){
            $checked="checked='checked'";
        }else{
            $checked="";
        }
       $options2.="<input type='checkbox' name='selectedID[]' value='$x->ID' $checked />$x->post_title <small><i>(".get_permalink($x->ID).")</i></small><br />";
       }       
	   
   ?>  
    <?php echo $message;?>
   <div class="wrap">  
      <?php    echo "<h2>" . __( 'Display Options', 'titlecloud_admin' ) . "</h2>"; ?>  
     
       <form name="wptc_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">  
           <input type="hidden" name="txtHidden" value="Y">  
           <?php    echo "<h4>" . __( 'wordpress Title Cloud Display Settings', 'titlecloud_admin' ) . "</h4> "; ?>  
           <p>
				<span style="display:none">select area to display:</span>
				<select name="ddlSelection" style="display:none">
				<option value="none">None</option>
				<option value="wp_footer"  <?php echo( $area=="wp_footer")?"selected='selected'":"" ?>>Footer</option>
				</select><br />
				
				Automatically Add Pages: <select name="ddlAuto">
                                        <option value="1" <?php echo ($oProperty->auto=='1')?'selected':'' ?> >True</option>
										<option value="0" <?php echo ($oProperty->auto=='0')?'selected':'' ?> >False</option>
										</select><br />
                <table width="100%" style="min-height: 300px;" cellpadding="0" cellspacing="0" border="1">
                <tr>
                <td width="50%" valign="top">
                Please check the pages to include:<br />
                <?php echo $options; ?>
                </td>
                <td  valign="top">
				Please Check the posts to include:<br />
				<?php echo $options2; ?>
				</td>
                </tr>
                </table>                
            
		   </p>
		   <p>
		   <h2>Style options</h2>				
			color : <input type="text" value="<?php echo $oProperty->color ?>" name="txtColor" /> e.g: blue, #cccccc, #000<br />
            font family : 	<input type="text" value="<?php echo $oProperty->font ?>" name="txtFont" /> e.g: verdana, tahoma, arial<br />
                    Smallest font size : <input type="text" size="3" value="<?php echo $oProperty->smallest ?>" name="txtSmallest" /> px. <br />
                    Largest font size : <input type="text" size="3" value="<?php echo $oProperty->largest ?>" name="txtLargest" /> px. <br />
                    <br />                    
		   </p><p>
           <input type="submit" name="Submit" value="<?php _e('Update Options', 'titlecloud_admin' ) ?>" />  </p>
           <p>
		   if you want to display the plugin in any part of the page, just add "cloud_rs()" within php lines.
		   </p>  
		   		<hr>

			
       </form>  
   </div>  