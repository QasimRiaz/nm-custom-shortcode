<?php



class NMCustomshortcode {

	

    private static $initiated = false;

    public static function init() {
		if ( ! self::$initiated ) {
			self::init_hooks();
		}
	}


    /** Activation Hook -- Start -- */
   
    public static function nm_custom_shortcode_plugin_activation() {
		
        update_option("nm_custom_shortcode_status","Activate");
        
	}

    /** Activation Hook -- End -- */


    /** Deactivation Hook -- Start -- */

    public static function nm_custom_shortcode_plugin_deactivation() {


        update_option("nm_custom_shortcode_status","");
        unregister_post_type( 'nm-custom-shortcode' );
        flush_rewrite_rules();
		
	}
   
    /** Deactivation Hook -- End -- */

    
    
    /** Register Shortcode  -- Start -- */

    public static function nm_custom_shortcode_loadfrm( $atts ) {
        
        $numberofinputfields = $atts['numberofinpurts'];
        
        
        //$shortcodeHtml = "[formidable id='".$getTheShortcodeObject['frm_id'][0]."' title=true description=true]";

        //return "<script>console.log(".json_encode($shortcodeDetails).")</script><div class='row'><div class='wmshortcodediv'><button class='btn btn-info' onclick='gettheformload(".$atts['id'].")'>".$getTheShortcodeObject['button_label'][0]."</button>".do_shortcode($shortcodeHtml)."</div></div>";
        $listofinputs = "";
        for($i=1; $i <= $numberofinputfields; $i++){


            $listofinputs .= '<div class="col-sm-12 col-lg-4 nminputfield"><input class="form-control form-control-lg namemixinpurts" type="text" placeholder="Enter Name '.$i.'" required></div><br>';


        }

        $outputform = '<form method="post" class="needs-validation" action="javascript:void(0);" onSubmit="genratenewanmes('.$numberofinputfields.')" >
        
                        <div class="row">'.$listofinputs.'<div class="col-sm-12 col-lg-4 nminputfield"><button type="submit" id="genrate" name="genrate"  class="btn btn-primary btn-lg" value="Genrate" >Generate</button></div></div>

        
        </form>
        <div class="row "><div class="col-sm-12 col-lg-12 resultrow"></div></div>
        ';
        
        return $outputform;
    }


    /** Register Shortcode  -- End -- */


    /** Click On button Load Form from formidable  -- Start -- */

    public static function nm_custom_shortcode_resultgenrate() {
        
        


        $numberofinpurts = $_POST['numberofinpurts'];
        $numberofnames = json_decode(stripslashes($_POST['nameslist']), true); //json_decode($_POST['nameslist']);
        
       // for($i=0; $i <= sizeof($numberofnames); $i++){
            
            if($numberofinpurts == 3){

                $numberofnames[1] = $numberofnames[1].''.$numberofnames[2];
            
            }else if($numberofinpurts == 4){

                $numberofnames[1] = $numberofnames[1].''.$numberofnames[2].''.$numberofnames[3];
            

            }
            
            
            $firstname = str_split($numberofnames[0]);
            $secondname = str_split($numberofnames[1]);
            //$thirdname = str_split($numberofnames[2]);
            //$forthname = str_split($numberofnames[3]);
            
        
            $names =""; 
            $names2 ="";
            $result = "";
            foreach($firstname as $index=>$data){

                    // $secondname = str_split($numberofnames[$i+1]);
                
                foreach($secondname as $index2=>$data2){
                
                        $result .= $names.''.$data.''.$data2.' , ';
                       
                    
                }

                $result .= $names.''.$data.''.$numberofnames[1].' , ';
                $names .= $data;
            }

            

            foreach($secondname as $index2=>$data2){
                
                foreach($firstname as $index=>$data){
                
                    $result .= $names2.''.$data2.''.$data.' , ';
                   
                
                }
                $result .= $names2.''.$data2.''.$numberofnames[0].' , ';
                $names2 .= $data2;
            
            }

            

//        }


        $responce['result'] = $result;

        echo json_encode($responce);
        wp_die();
      
    }


   
    /** Plugin dependencies   -- Start -- */

    private static function init_hooks() {
        
		self::$initiated = true;
        
        wp_register_style( 'bootstrapstyle', '//cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css',array(), NMCUSTOMSHORTCODE_VERSION );
        wp_enqueue_style( 'bootstrapstyle' );

        wp_register_style( 'nmstyle', plugin_dir_url( __FILE__ ) . '_inc/css/nmstyle.css', array(), NMCUSTOMSHORTCODE_VERSION );
        wp_enqueue_style( 'nmstyle' );
     
     
        wp_register_script( 'ajaxjquery.js', '//code.jquery.com/jquery-3.6.0.min.js', array(), NMCUSTOMSHORTCODE_VERSION );
		wp_enqueue_script( 'ajaxjquery.js');


        wp_register_script( 'namesmixcushortcode.js', plugin_dir_url( __FILE__ ) . '_inc/js/namesmixcushortcode.js', array(), NMCUSTOMSHORTCODE_VERSION );
		wp_enqueue_script( 'namesmixcushortcode.js');

        wp_register_script( 'bootstrap.js', '//cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js', array(), NMCUSTOMSHORTCODE_VERSION );
		wp_enqueue_script( 'bootstrap.js');



    }
    
    /** Plugin dependencies   -- End -- */

}