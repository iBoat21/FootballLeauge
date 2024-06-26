<?php
include "../config/connect.php";
?>
<?php
isset($_GET['slug']);
$slug = $_GET['slug'];


$sql = "SELECT * FROM competition WHERE slug='$slug'";
$qSlug = mysqli_query($conn, $sql);
$rows = mysqli_num_rows($qSlug);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Slug Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <header class="header">
            <h1>Teams</h1>
        </header>
        <aside class="sidebar">
            <nav>
                <div class="logo">
                    <img src="../images/logo.png" alt="Football League Logo">
                </div>
                <ul>
                    <li><a href="/league01/competitions"">Competitions</a></li>
                    <li><a href="create">Add Competitions</a></li>
                </ul>
            </nav>
        </aside>
        <main class="main-content">
            <?php
            if ($rows == 0) {
            ?>
                <h1>No Data</h1>
            <?php
            } else {
                $result = mysqli_fetch_array($qSlug);
                $name = $result['name'];
                $banner = $result['banner'];
                $teams = $result['max_teams'];
            ?>

                <div class="nested-container">
                    <div class="top">
                        <h1><?php echo $name; ?></h1>
                        <img src="../images/<?php echo $banner; ?>" alt="">
                    </div>
                    <div class="left-mid">
                        <div class="card">
                            <div class="card-title">
                                Max Teams In League
                            </div>
                            <div class="card-content">
                                <?php echo $teams;?>
                            </div>
                        </div>
                    </div>
                    <div class="right-mid">
                    <h2>
                        <center>
                            Allowed Provinces
                        </center>
                    </h2>
                        <?php
                        $id = $result['id'];
                        $sqlProvince = "SELECT provinces.name_thai, provinces.name_english
                                FROM provinces 
                                INNER JOIN competition_provinces
                                ON competition_provinces.province_id = provinces.id
                                WHERE competition_provinces.competition_id=$id  
                        ";
                        $qProvince = mysqli_query($conn, $sqlProvince);
                        $provinceRow = mysqli_num_rows($qProvince);
                        if ($provinceRow == 0) {
                        ?>
                            No Data Fetch
                            <?php
                        } else {
                            for ($i = 0; $i < $provinceRow; $i++) {
                                $resProvince = mysqli_fetch_array($qProvince);
                                $thName = $resProvince['name_thai'];
                                $enName = $resProvince['name_english'];

                            ?>
                                <form action="#">
                                    <label for="th_name"><?php echo $thName; ?></label>
                                    <label for="en_name"><?php echo $enName; ?></label>
                                </form>
                            <?php
                            }
                        }
                            ?>
                    </div>
                </div>
                <?php
                    }
                ?>
        </main>
    </div>
</body>

</html>