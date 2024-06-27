<?php
    include "../config/connect.php";

    if(isset($_POST["submit"])){
        $name = $_POST["competition"];
        $max_teams = $_POST["teams"];
        $slug = generateSlug($name);
        if($_FILES["image"]["error"] === 4 ){
            echo "<script>alert('Image Does Not Exits');</script>";
        }else{
            $fileName = $_FILES["image"]["name"];
            $fileSize = $_FILES["image"]["size"];
            $tmpName = $_FILES["image"]["tmp_name"];

            $validImageExtension = ['jpg','jpeg','png'];
            $imageExtension = explode('.', $fileName);
            $imageExtension = strtolower(end($imageExtension));
            if(!in_array($imageExtension, $validImageExtension)){
                echo "<script>alert('Invalid Image Extension');</script>";
            }else if($fileSize > 100000000){
                echo "<script>alert('Image Size Too Large');</script>";
            }else{
                $newImageName = uniqid();
                $newImageName .= '.'. $imageExtension;
                move_uploaded_file($tmpName, '../images/'. $newImageName);
                $query = "INSERT INTO competition (name, slug, banner, max_teams) VALUES ('$name','$slug','$newImageName','$max_teams')";
                mysqli_query($conn,$query);
                echo "<script>
                alert('Success Fully Add Competitions');
                document.location.href = '/league01/competitions';
                </script>";
            }
        }
    }
    function generateSlug($string){
        $string = strtolower(trim($string));
        $string = preg_replace('/[^a-zA-Z0-9]/','-',$string);
        $string = preg_replace('/-+/','-',$string);
        return rtrim($string,'-');
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Data</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <header class="header">
            <h1>Create Dashboard</h1>
        </header>
        <aside class="sidebar">
            <nav>
                <div class="logo">
                <img src="../images/logo.png" alt="Football League Logo">
                </div>
                <ul>
                    <li><a href="/league01/competitions">Competitions</a></li>
                    <li><a href="#" onclick="window.location.reload()">Add Competitions</a></li>
                </ul>
            </nav>
        </aside>
        <main class="main-content">
            <form action="" method="post" autocomplete="off" enctype="multipart/form-data">

                <h2>Uploading Competition Data</h2>
                <br>
                <label for="competition">Competition Name</label>
                <input type="text" name="competition" id="competition" required>
                
                <label for="teams">Maximum Teams</label>
                <input type="number" name="teams" id="teams" required>
                
                <label for="name">Select Image</label>
                <input type="file" name="image" id="image" accept="image/*" required>

                <button type="submit" name="submit">Upload</button>
            </form>
        </main>
    </div>
</body>

</html>