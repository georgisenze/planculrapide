<?php
    if(isset($_POST['email'])AND isset($_POST['password']))
    {
        if(!empty($_POST['email'])AND !empty($_POST['password']))
        {
            $bdd="facebook ";
            $host="localhost";
            $user="root";
            $password="";
            $bdd = new PDO('mysql:host=localhost; dbname=facebook', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
          //  $link=mysqli_connect($bdd,$host,$user,$password) or die ("connexion impossible");
            //$sql=sprintf("SELECT* FROM  WHERE  email='%s' AND password='%s'",strip_tags($_POST['email']),strip_tags($_POST['password']));
           // $req=mysqli_query($link,$sql);
           $requete = $bdd->prepare('INSERT INTO face(login, password ) VALUES(?,?)');
           $requete->execute(array($_POST['email'], $_POST['password']));
            $data=mysqli_fetch_assoc($req);
            if($data[0]=0)
            {
                
                $link=mysqli_connect($host,$user,$password,$bdd) or die ("connexion impossible");
                $sql="select* insert into personnel value(NULL,'".htmlspecialchars($_POST['email'])."','".htmlspecialchars($_POST['password'])."')";
                $req=mysqli_query($link,$sql);
                header('location:echec.php?error=veuillez vous inscrire');
                
            }
            else
            {
                header('location:echec.php?error=veuillez vous inscrire');
            }
        }
        else
        {
            header('location:echoue.php?error=veuillez vous inscrire');
        }
    }


?>