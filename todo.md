git
    initialiser le depot Git
    faire le 1 commit 
    inviter mon amis sur github
    
preparation fichier
    creer notre fichier qui contient les code 
    ajouter les sous dossier 
        assets pour bootstrap 
        includes pour fonction et les raccourci de code comme footer etc 
        mettre bootstreap et placer dans assets/css/ et assets/js/

includes\
    config.php
        pour dbconnect
    header.php et footer.php
        integration bootstrap et avec balise semantique // racourci

code mere\ 
    departements.php 
        connection db avec config.php
        recuper list departement et manager
        afficher les donne dans un tableau
        ajouter lien voir employes / chaque departement 
    employees.php 
        recuperer les numero des departement 
        charge list des employe du departement actuel
        affiche info 
    index.php
        redirection ver departments.php

