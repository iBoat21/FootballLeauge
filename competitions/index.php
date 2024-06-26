<?php
    include "../config/connect.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <header class="header">
            <h1>Dashboard</h1>
        </header>
        <aside class="sidebar">
            <nav>
                <div class="logo">
                <img src="../images/logo.png" alt="Football League Logo">
                </div>
                <ul>
                    <li><a href="#" onclick="window.reload()">Competitions</a></li>
                    <li><a href="create">Add Competitions</a></li>
                </ul>
            </nav>
        </aside>
        <main class="main-content">
            <table>
                <?php
                $sql = "SELECT * FROM competition";
                $qCompetition = mysqli_query($conn, $sql);
                $rows = mysqli_num_rows($qCompetition);
                ?>

                <thead>
                    <th>Team Name</th>
                    <th>Team Banner</th>
                    <th>Teams</th>
                    <th>Button Action</th>
                </thead>
                <tbody>
                    <tr>
                        <?php
                        if ($rows == 0) {
                        ?>
                            <td colspan="4">
                                No Data
                            </td>
                            <?php
                        } else {
                            for ($i = 0; $i < $rows; $i++) {
                                $result = mysqli_fetch_array($qCompetition);
                                $id = $result['id'];
                                $name = $result['name'];
                                $slug = $result['slug'];
                                $banner = $result['banner'];
                                $teams = $result['max_teams'];
                            ?>
                    </tr>
                    <tr>
                        <td><?php echo $name; ?></td>
                        <td><img src="../images/<?php echo $banner; ?>" alt=""></td>
                        <td><?php echo $teams; ?></td>
                        <td><a href="<?php echo $slug;?>">Team Info</a></td>
                    </tr>
            <?php
                            }
                        }
            ?>
                </tbody>
            </table>

        </main>
    </div>
</body>

</html>