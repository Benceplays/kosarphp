<?php 
include 'kosar.php';
$játékosok = $_SESSION['jatekosok'];
$csapatok = $_SESSION['csapatok'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Basketball</title>
    <link rel="stylesheet" href="style.css">
</head>
<body style="background-image: url(images/wallpaper.png);">
    <form action="main.php" method="post">
        <div>
        <div class="indexmain">
            <div id="home">
                <p style="text-align: center;">Kérlek válassz csapatot!</p>
                    <select style="margin-left: 1%;" id="hometeam" name="hometeam">
                    <?php 
                        foreach($csapatok as $id=>$value) {?>
                            <option value="<?php echo $id?>"><?php echo $value ?></option>
                    <?php }?>
                    </select>
            </div>
            <div id="away">
                <p style="text-align: center;">Kérlek válassz csapatot!</p>
                <select id="awayteam" name="awayteam"><?php 
                        foreach($csapatok as $id=>$value) {?>
                        <option value="<?php echo $id?>"><?php echo $value ?></option>
                    <?php }?>
                </select>
            </div>
            <div id="searchproperties">
                <label for="court">Choose a court:</label>
                <select name="court" id="court" >
                    <option value="bbc">Budapest Basketball Court</option>
                    <option value="gybc">Győr Basketball Court</option>
                    <option value="pbc">Pécs Basketball Court</option>
                    <option value="vbc">Veresegyház Basketball Court</option>
                </select><br>
                <label for="date">Choose a date:</label>
                <input type="date" name="input" id="date"></input><br>
                <label for="referee">Choose a referee:</label>
                <select name="referee" id="referee" >
                    <option value="">Kalamár Rajmund</option>
                    <option value="">Dr.Hetési Ferenc</option>
                </select><br>
                <button class="second-buttons" id="startbutton" name="startbutton" type="submit">Start</button><br>
            </div>
        </div>
        </div>
    </form>
</body>
</html>