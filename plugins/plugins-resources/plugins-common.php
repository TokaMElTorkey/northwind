<?php

/**
 * Copy folder with and sub-folders from source to destinaton
 * @param $msg: source folder path
 * 	  $dst: destination folder path
 */
function recurse_copy($src, $dst) {
    $dir = opendir($src);
    @mkdir($dst);
    while (false !== ( $file = readdir($dir))) {
        if (( $file != '.' ) && ( $file != '..' )) {
            if (is_dir($src . '/' . $file)) {
                recurse_copy($src . '/' . $file, $dst . '/' . $file);
            } else {
                copy($src . '/' . $file, $dst . '/' . $file);
            }
        }
    }
    closedir($dir);
}

#################################################################################
/**
 * Display error messages
 * @param $msg: error message
 * 		  $back_url: pass explicit false to suppress back button
 * @return  html code for a styled error message
 */

function plugin_error_message($msg, $back_url = '') {

    ob_start();
    echo '<div class="panel panel-danger">';
    echo '<div class="panel-heading"><h3 class="panel-title">Error:</h3></div>';
    echo '<div class="panel-body"><p class="text-danger">' . $msg . '</p>';
    if ($back_url !== false) { // explicitly passing false suppresses the back link completely
        echo '<div class="text-center">';
        if ($back_url) {
            echo '<a href="' . $back_url . '" class="btn btn-danger btn-lg vspacer-lg"><i class="glyphicon glyphicon-chevron-left"></i> < Back </a>';
        } else {
            echo '<a href="#" class="btn btn-danger btn-lg vspacer-lg" onclick="history.go(-1); return false;"><i class="glyphicon glyphicon-chevron-left"></i> < Back </a>';
        }
        echo '</div>';
    }
    echo '</div>';
    echo '</div>';
    $out = ob_get_contents();
    ob_end_clean();

    return $out;
}

#################################################################################
/**
 * Get XML file object from hashed project file name 
 * @param $fileHash: md5 hashed project name
 * 		  $projectFile: project file name ( empty var passed by reference )
 * @return  XML project file object 
 */

function getXMLFile($fileHash, &$projectFile) {
    
    try {

        $projects = scandir("../projects");
        $projects = array_diff($projects, array('.', '..'));
        $userProject = $fileHash;
        $projectFile = null;

        foreach ($projects as $project) {
            if ($userProject == md5($project)) {
                $projectFile = $project;
                break;
            }
        }
        if (!$projectFile)
            throw new RuntimeException('Project file not found.');

        // validate simpleXML extension enabled
        if (!function_exists(simpleXML_load_file)) {
            throw new RuntimeException('Please, enable simplexml extention in your php.ini configuration file.');
        }


        // validate that the file is not corrupted
        @$xmlFile = simpleXML_load_file("../projects/$projectFile");
        if (!$xmlFile) {
            throw new RuntimeException('Invalid axp file.');
        }

        return $xmlFile;
    } catch (RuntimeException $e) {
        echo "<br>" . error_message($e->getMessage());
        exit;
    }
}


#################################################################################
/**
 * Check if the current logged-in user is an adminstrator
 * @return  boolean
 */
function isAdmin(){
    $mi = getMemberInfo();
    if( ! ($mi['admin'] && ((is_string($mi['group']) && $mi['group'] =='Admins') || ( is_array($mi['group']) && array_search("Admins" , $mi['group']))))){
        return false;
    }
    return true;
       
}

#################################################################################
/**
 * Check existance/create node in xml table structure
 * @param $table: table xml object
 *        $nodeName: plugin name to be checked/ created
 */
function checkOrCreatePluginNode( $table , $nodeName ){


    if (!isset($table->plugins)){
        $table->addChild("plugins");    
    }
    if (!isset($table->plugins->$nodeName)){
        $table->plugins->addChild($nodeName);   
    } 

}
?>