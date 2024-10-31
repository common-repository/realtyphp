<?php
/**
 * Realtyphp_installer class file.
 * 
 * @author Elod Horvath <info@tunedthemes.com>
 * @link http://www.tunedthemes.com/
 * @copyright Copyright &copy; 2012 Elod Horvath
 * @license http://www.gnu.org/licenses/gpl.html
 * @package lib
 * @since 1.0
 */ 

/**
 * Realtyphp_installer class install the Realtyphp plugin for Wordpress.
 * 
 * @author Elod Horvath <info@tunedthemes.com>
 * @package lib
 * @since 1.0
 */
class Realtyphp_installer
{
	
	/**
	 * This is the install function.
	 * This function create database tables and insert data into the tables.	 
	 */
	public static function install()
	{
		if(!is_dir(REALTYPHP_PATH . 'uploads/thumbs'))
        {
		    mkdir(REALTYPHP_PATH . 'uploads', 0775); 
            mkdir(REALTYPHP_PATH . 'uploads/thumbs', 0775);                        
            
        }
                
        
		global $wpdb;
		
		$wpdb->query("
		CREATE  TABLE IF NOT EXISTS `".$wpdb->prefix."realtyphp_listings` (
        `id` INT(11) NOT NULL AUTO_INCREMENT ,
        `user_id` INT(11) NOT NULL ,
  		`offer` INT(11) NOT NULL ,
  		`type` INT(11) NOT NULL ,
  		`price` INT(11) NOT NULL ,
 		`area_size` INT(11) NOT NULL ,
 		`nr_rooms` INT(11) NOT NULL ,
  		`zip` INT(11) NOT NULL ,
  		`city` VARCHAR(100) NOT NULL ,
  		`state_province` INT(11) NOT NULL ,
  		`country` INT(11) NOT NULL ,
  		`title` VARCHAR(100) NOT NULL ,
  		`description` TEXT NOT NULL ,
  		`contact_name` VARCHAR(45) NOT NULL ,
  		`contact_email` VARCHAR(45) NOT NULL ,
  		`contact_phone` VARCHAR(45) NOT NULL ,
 		`contact_display` INT(11) NOT NULL ,
  		`contact_form_email` VARCHAR(45) NOT NULL ,
  		`last_updated` DATETIME NOT NULL ,
  		`date_added` DATETIME NOT NULL ,
  		`listing_name` VARCHAR(200) NOT NULL ,
  		PRIMARY KEY (`id`) ,
  		UNIQUE INDEX `id_UNIQUE` (`id` ASC) )
		ENGINE = InnoDB		
		DEFAULT CHARACTER SET = utf8;
        ");
		
		
		$wpdb->query("
		CREATE  TABLE IF NOT EXISTS `".$wpdb->prefix."realtyphp_listings_pictures` (
  		`id` INT(11) NOT NULL AUTO_INCREMENT ,
  		`listing_id` INT(11) NOT NULL ,
  		`name` VARCHAR(45) NOT NULL ,
 		 PRIMARY KEY (`id`) ,
  		UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
  		INDEX `fk_realtyphp_listings_pictures_realtyphp_listings1` (`listing_id` ASC) ,
  		CONSTRAINT `fk_realtyphp_listings_pictures_realtyphp_listings1`
    	FOREIGN KEY (`listing_id` )
    	REFERENCES `".$wpdb->prefix."realtyphp_listings` (`id` )
    	ON DELETE CASCADE
    	ON UPDATE NO ACTION)
		ENGINE = InnoDB		
		DEFAULT CHARACTER SET = utf8;
		");
		
		
		$wpdb->query("
		CREATE  TABLE IF NOT EXISTS `".$wpdb->prefix."realtyphp_offer` (
  		`id` INT(11) NOT NULL AUTO_INCREMENT ,
  		`label` VARCHAR(45) NOT NULL ,
  		PRIMARY KEY (`id`) ,
  		UNIQUE INDEX `id_UNIQUE` (`id` ASC) )
		ENGINE = InnoDB		
		DEFAULT CHARACTER SET = utf8;
		");
		
		
		$wpdb->query("
		INSERT INTO ".$wpdb->prefix."realtyphp_offer(label) VALUES
		('For sale'),
		('Rent');
		");
		
		
		$wpdb->query("
		CREATE  TABLE IF NOT EXISTS `".$wpdb->prefix."realtyphp_property_types` (
  		`id` INT(11) NOT NULL AUTO_INCREMENT ,
  		`label` VARCHAR(45) NOT NULL ,
  		PRIMARY KEY (`id`) ,
  		UNIQUE INDEX `id_UNIQUE` (`id` ASC) )
		ENGINE = InnoDB		
		DEFAULT CHARACTER SET = utf8;
		");
				
		$wpdb->query("
		INSERT INTO ".$wpdb->prefix."realtyphp_property_types(label) VALUES
		('Apartement'),
		('House'),
		('Plot'),
		('Garage'),
		('Holiday home'),
		('Office'),
		('Commercial'),
		('Industrial'),
		('Agricultural');		
		");
		
		
		
		$wpdb->query("
		CREATE TABLE IF NOT EXISTS ".$wpdb->prefix."realtyphp_countries(
        id INT NOT NULL AUTO_INCREMENT,
        label VARCHAR(45) NOT NULL,        
        PRIMARY KEY (`id`) ,
        UNIQUE INDEX `id_UNIQUE` (`id` ASC) )
        ENGINE = InnoDB       
        DEFAULT CHARACTER SET = utf8;
        ");
        
        $wpdb->query("
		INSERT INTO ".$wpdb->prefix."realtyphp_countries(label) VALUES
		('Hungary'),		
		('United States');		
		");
		
		
		
		$wpdb->query("
		CREATE  TABLE IF NOT EXISTS `".$wpdb->prefix."realtyphp_state_province` (
  		`id` INT(11) NOT NULL AUTO_INCREMENT ,
  		`country_id` INT(11) NOT NULL ,
  		`label` VARCHAR(100) NOT NULL ,
  		PRIMARY KEY (`id`) ,
  		UNIQUE INDEX `id_UNIQUE` (`id` ASC) )  		
		ENGINE = InnoDB		
		DEFAULT CHARACTER SET = utf8;
		");
										
		$wpdb->query("
		INSERT INTO ".$wpdb->prefix."realtyphp_state_province(country_id, label) VALUES
        ('1', '-'),
        ('1', 'Bács-Kiskun'),
        ('1', 'Békés'),
        ('1', 'Baranya'),
        ('1', 'Borsod-Abaúj-Zemplén'),
        ('1', 'Csongrád'),
        ('1', 'Fejér'),
        ('1', 'Győr-Moson-Sopron'),
        ('1', 'Hajdú-Bihar'),
        ('1', 'Heves'),
        ('1', 'Jász-Nagykun-Szolnok'),
        ('1', 'Komárom-Esztergom'),
        ('1', 'Nógrád'),
        ('1', 'Pest'),
        ('1', 'Somogy'),
        ('1', 'Szabolcs-Szatmár-Bereg'),
        ('1', 'Tolna'),
        ('1', 'Vas'),
        ('1', 'Veszprém'),
        ('1', 'Zala'),
        ('2', '-'),
		('2', 'Alabama'),
		('2', 'Alaska'),
		('2', 'Arizona'),
		('2', 'Arkansas'),
		('2', 'California'),
        ('2', 'Colorado'),
		('2', 'Connecticut'),
		('2', 'Delaware'),
		('2', 'Florida'),
		('2', 'Georgia'),
		('2', 'Hawaii'),
		('2', 'Idaho'),
        ('2', 'Illinois'),
		('2', 'Indiana'),
		('2', 'Iowa'),
		('2', 'Kansas'),
		('2', 'Kentucky'),
		('2', 'Louisiana'),
		('2', 'Maine'),
		('2', 'Maryland'),
		('2', 'Massachusetts'),
		('2', 'Michigan'),
		('2', 'Minnesota'),
		('2', 'Mississippi'),
		('2', 'Missouri'),
		('2', 'Montana'),
		('2', 'Nebraska'),
		('2', 'Nevada'),
		('2', 'New Hampshire'),
		('2', 'New Jersey'),
		('2', 'New Mexico'),
		('2', 'New York'),
		('2', 'North Carolina'),
		('2', 'North Dakota'),
		('2', 'Ohio'),
		('2', 'Oklahoma'),
		('2', 'Oregon'),
		('2', 'Pennsylvania'),
		('2', 'Rhode Island'),
		('2', 'South Carolina'),
		('2', 'South Dakota'),
		('2', 'Tennessee'),
		('2', 'Texas'),
		('2', 'Utah'),
		('2', 'Vermont'),
		('2', 'Virginia'),
		('2', 'Washington'),
		('2', 'West Virginia'),
		('2', 'Wisconsin'),
		('2', 'Wyoming');
		"
		);
		
	
		$wpdb->query("
		ALTER TABLE ".$wpdb->prefix."realtyphp_state_province
		ADD CONSTRAINT `fk_realtyphp_state_province_realtyphp_countries`
		FOREIGN KEY (`country_id` )
		REFERENCES `".$wpdb->prefix."realtyphp_countries` (`id` )
		ON DELETE CASCADE
		ON UPDATE NO ACTION;		
		");
		

                if(file_exists(REALTYPHP_PATH . 'application/languages/'. WPLANG .'/realtyphp-'. WPLANG .'.php'))
		{	
		    require_once(REALTYPHP_PATH . 'application/languages/'. WPLANG .'/realtyphp-'. WPLANG .'.php');
		}
		$rp_post = array(
                'post_title'     => defined('Listings') ? Listings : 'Listings',
		'post_content'   => '[realtyphp-listings]',
		'post_type' => 'page',
		'post_status'    => 'publish',
		'comment_status' => 'closed', 
		'ping_status'    => 'closed', 
		'post_author'    => 1
		);
		
		wp_insert_post( $rp_post );
		
		
	}
	
	
	/**
	 * This is the uninstall function.
	 * This function deletes tables of the plugin from the database,
	 * and delete the page of the shortcode.	  	 
	 */
	public static function uninstall()
	{
			
		global $wpdb;
				
		$wpdb->query("
		    DROP TABLE ".$wpdb->prefix."realtyphp_listings_pictures
		");
		
		$wpdb->query("
		    DROP TABLE ".$wpdb->prefix."realtyphp_state_province
		");
		
		$wpdb->query("
		    DROP TABLE ".$wpdb->prefix."realtyphp_listings
		");
		
		$wpdb->query("
		    DROP TABLE ".$wpdb->prefix."realtyphp_countries
		");
		
		$wpdb->query("
		    DROP TABLE ".$wpdb->prefix."realtyphp_property_types
		");				
						
		$wpdb->query("
		    DROP TABLE ".$wpdb->prefix."realtyphp_offer
		");

        $wpdb->query("
		    DELETE FROM ".$wpdb->prefix."posts
		    WHERE post_content = '[realtyphp-listings]'
		");
        
        $photos = glob(''.REALTYPHP_PATH.'uploads/*'); // get all file names
        foreach($photos as $photo){ // iterate files
            if(is_file($photo))
                unlink($photo); // delete file
        } 
        
        $thumbs = glob(''.REALTYPHP_PATH.'uploads/thumbs/*'); // get all file names
        foreach($thumbs as $thumb){ // iterate files
            if(is_file($thumb))
                unlink($thumb); // delete file
        }        
	}
	
	
}


?>