<?php

    if(isset($_POST["descarga"])) {

        $name=$_POST["name"];
        $url=$_POST["url"];


        $descarga=new clsDescarga();

        $descarga->name=$name;
        $descarga->url=$url;
       echo $descarga->addUrl();
    }

 ?>


