<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>
<body>
    <form action="student.php" method="GET">
        
    </form> 
    <br><br>
    <form action="student.php" method="POST">
        <legend>Data insert form</legend>
        <label>Name: </label>
        <input type="text" name="name" required><br>
        <label>Last name: </label>
        <input type="text "name="surname" required><br>
        <label>Sidi code: </label>
        <input type="text" name="sidi_code" required><br>
        <label>Tax code: </label>
        <input type="text" name="tax_code" required><br>
        <input type="submit" value="Insert" class="btn btn-success">
        <br>
        <br>


        <input type="submit" value="GET (all)" class="btn btn-primary"><br>
        
        <label for="text_get">get one student</label>
        <select name="id">
            <option selected disabled hidden value="">Student ID</option>
            <?php 
                include('./class/DBConnection.php');

                $db = new DBConnection;
                $db = $db->returnConnection();
                $sql = "SELECT id FROM student ORDER BY id ASC;";
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

                foreach($result as $key) //list of all ids
                {   
                    echo '<option value="' . $key['id'] . '">' . $key['id'] . '</option>';
                }   
            ?>
        </select>
        <input type="submit" value="GET (one)" class="btn btn-primary">
    </form>
</body>
</html>

<!-- curl --header "Content-Type: application/json" --request POST --data '{"_name":"Ciccio", "_surname":"Benve"}' http://localhost:8080  -->