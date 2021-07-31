<?php
namespace SELLERCONTROL;

class Users
{
    public $user;
    public function __construct()
    {
        $this->user = wp_get_current_user();
    }

    public function is_asociado()
    {
        $user = wp_get_current_user();
        
        if (in_array('asociado', (array) $user->roles)) {
            return true;
        }
        return false;
    }

    public function is_admin()
    {
        $user = wp_get_current_user();
        
        if (in_array('administrator', (array) $user->roles)) {
            return true;
        }
        return false;
    }
    
}

