<?php


/**
 * Description of maintenance
 *
 * @author Aju
 */
class maintenance_hook {
    
    public function offline_check(){ 
        if(file_exists(APPPATH.'config/config.php')){
            include(APPPATH.'config/config.php');
            
            if(isset($config['maintenance_mode']) && $config['maintenance_mode'] === TRUE){
                include(APPPATH.'views/template/maintenance.php');
                exit;
            }
        }
    }
}
