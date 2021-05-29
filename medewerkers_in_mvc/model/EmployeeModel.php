<?php

    function getAllEmployees(){
      // Met het try statement kunnen we code proberen uit te voeren. Wanneer deze
      // mislukt kunnen we de foutmelding afvangen en eventueel de gebruiker een
      // nette foutmelding laten zien. In het catch statement wordt de fout afgevangen
       try {
           // Open de verbinding met de database
           $conn=openDatabaseConnection();
       
           // Zet de query klaar door middel van de prepare method
           $stmt = $conn->prepare("SELECT * FROM employees");

           // Voer de query uit
           $stmt->execute();

           // Haal alle resultaten op en maak deze op in een array
           // In dit geval is het mogelijk dat we meedere medewerkers ophalen, daarom gebruiken we
           // hier de fetchAll functie.
           $result = $stmt->fetchAll();
       }
       // Vang de foutmelding af
       catch(PDOException $e){
           // Zet de foutmelding op het scherm
           echo "Connection failed: " . $e->getMessage();
       }
       // Maak de database verbinding leeg. Dit zorgt ervoor dat het geheugen
       // van de server opgeschoond blijft
       $conn = null;
       // Geef het resultaat terug aan de controller
       return $result;
    }




    function getEmployee($id){
        try {
            // Open de verbinding met de database
            $conn=openDatabaseConnection();
     
            // Zet de query klaar door midel van de prepare method. Voeg hierbij een
            // WHERE clause toe (WHERE id = :id. Deze vullen we later in de code
            $stmt = $conn->prepare("SELECT * FROM employees WHERE id = :id");
            // Met bindParam kunnen we een parameter binden. Dit vult de waarde op de plaats in
            // We vervangen :id in de query voor het id wat de functie binnen is gekomen.
            $stmt->bindParam(":id", $id);

            // Voer de query uit
            $stmt->execute();

            // Haal alle resultaten op en maak deze op in een array
            // In dit geval weten we zeker dat we maar 1 medewerker op halen (de where clause), 
            //daarom gebruiken we hier de fetch functie.
            $result = $stmt->fetch();
        }
        catch(PDOException $e){
            echo "Connection failed: " . $e->getMessage();
        }
        // Maak de database verbinding leeg. Dit zorgt ervoor dat het geheugen
        // van de server opgeschoond blijft
        $conn = null;
        // Geef het resultaat terug aan de controller
        return $result;
     }



    // Maak hier de code om een medewerker toe te voegen
    function createEmployee($data){
        // Variables
        $inputAmount = count($data);
        $array = [];


        // The input of the user gets cleaned up
        for($i = 0; $i < 2; $i++){
            $inputName = "input" . ($i + 1);
            array_push($array, $data[$inputName]);


            $array[$i] = trim($array[$i]);
            $array[$i] = stripslashes($array[$i]);
            $array[$i] = htmlspecialchars($array[$i]); 
        }

    
        if(!$array[0]){
            $array[0] = "[name]";
        }
        if(!$array[1]){
            $array[1] = "[age]";
        }


        try {
            $conn=openDatabaseConnection();

            // Add a new game in the planning, with the information the user has given
            $stmt = $conn->prepare("INSERT INTO employees (name, age) VALUES (:name, :age)");

            // Update the values that are send with it
            $stmt->bindParam(":name", $array[0]);
            $stmt->bindParam(":age", $array[1]);


            $stmt->execute();
            header("location:" . URL);
        }catch(PDOException $e){ 
            echo "Connection failed: " . $e->getMessage();
        }
        $connection = null; 
    }




    // Maak hier de code om een medewerker te bewerken
    function updateEmployee($data){
        // Variables
        $id = $data["id"];
        $array = [];


        // Values
        $employee = getEmployee($id);
        $inputAmount = count($data);



        // All the inputs gets cleaned up
        for($i = 0; $i < 2; $i++){
            $inputName = "input" . ($i + 1);
            array_push($array, $data[$inputName]);


            $array[$i] = trim($array[$i]);
            $array[$i] = stripslashes($array[$i]);
            $array[$i] = htmlspecialchars($array[$i]);  
        }

        // When the input is empty, the array puts the previous information about the employee in the array
        if(!$array[0]){
            $array[0] = $employee["name"];
        }
        if(!$array[1]){
            $array[1] = $employee["age"];
        }


        // Add the data to the employee that the user wanted to chance
        try{
            $conn=openDatabaseConnection();

            $stmt = $conn->prepare("UPDATE employees SET name = :name, age = :age WHERE id = :id");


            // Update the values that are send with it
            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":name", $array[0]);
            $stmt->bindParam(":age", $array[1]);


            $stmt->execute();
            header("location:" . URL);
        }catch(PDOException $e){ 
            echo "Connection failed: " . $e->getMessage();
        }
        $conn = null;
    }




    // Maak hier de code om een medewerker te verwijderen
    function deleteEmployee($id){
        try{
            $conn=openDatabaseConnection();
            
            //1. Delete een medewerker uit de database
            $query = $conn->prepare("DELETE FROM employees WHERE id= :id");
            $query->bindParam(":id", $id);
            $query->execute(); 

            //2. Bouw een url en redirect hierheen
            header("location:" . URL);
        }catch(PDOException $e){ 
            echo "Connection failed: " . $e->getMessage();
        }
        $conn = null;
    }
?>