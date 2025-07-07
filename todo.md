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
        lien ver employeesFiche.php pour afficher la fichier de l e 
         selectionner fiche 
    index.php
        redirection ver departments.php
    employee_table.php 
        pour affichier les employees
    employeesFiche.php
        fiche -- info de base de l employer 
        list historique salaire + emploi dans la fiche
        mettre un bouton "changer de département" redirection vers ChangeDept.php
    ChangeDept.php
        formulaire Choix Dept et Date debut
        En haut le Dept et Date de debut actuel 
        message erreur si le Date de debut est inferieur a la date actuel
        fontion qui prend id, nouvaaude Dept et date

    moteurRecherche.php
        **** seul 20 lignes en result ****
        lien suivant / precedent pour le 20 prochain
        1 element de l sql en entrer de recherche soit 
            departement || nom emplye || age max / min


        


