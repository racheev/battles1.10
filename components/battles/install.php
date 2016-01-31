<?php

// ========================================================================== //

    function info_component_battles(){

        //Описание компонента
        $_component['title']        = 'Битвы титанов';
        $_component['description']  = '';
        $_component['link']         = 'battles';
        $_component['author']       = 'Рачей';
        $_component['internal']     = '0';
        $_component['version']      = '1.10.3';
		$_component['system']     = '1';
        return $_component;

    }

// ========================================================================== //

    function install_component_battles(){

        $inCore     = cmsCore::getInstance();       //подключаем ядро
        $inDB       = cmsDatabase::getInstance();   //подключаем базу данных
        $inConf     = cmsConfig::getInstance();

        include($_SERVER['DOCUMENT_ROOT'].'/includes/dbimport.inc.php');

        dbRunSQL($_SERVER['DOCUMENT_ROOT'].'/components/battles/install.sql', $inConf->db_prefix);

        return true;

    }

// ========================================================================== //

?>
