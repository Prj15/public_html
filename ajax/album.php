<?php

    $dossier = "img/album/" ;
    $iter = new DirectoryIterator($dossier) ;
    $images = "" ; 
    foreach($iter as $file ) {
        if ( !$file->isDot() && $file->isFile() && strcmp($file->getFilename(), "Thumbs.db") ) {
        // si le fichier existe, et s'il ne s'agit pas du Thumbs.db que windows génère et qu'on aurait rapatrié par erreur
        	$images .= <<<HTML
        	    <a href="{$file->getPath()}/{$file->getFilename()}">
        			<img title="{substr($file->getFilename(), 0, -4)}" alt="{substr($file->getFilename(), 0, -4)}" src="{$file->getPath()}/{$file->getFilename()}"/>
    			</a>
HTML
        }
    }

    echo $images ;
