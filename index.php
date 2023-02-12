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
                <p style="text-align: center;">Kérlek válassz csapatot! (Hazai)</p>
                    <select style="margin-left: 20%;" id="hometeam" name="hometeam">
                    <?php 
                        foreach($csapatok as $id=>$value) {?>
                            <option value="<?php echo $id?>"><?php echo $value ?></option>
                    <?php }?>
                    </select>
            </div>
            <div id="away">
                <p style="text-align: center;">Kérlek válassz csapatot!(Vendég)</p>
                <select id="awayteam" style="margin-left: 20%;" name="awayteam"><?php 
                        foreach($csapatok as $id=>$value) {?>
                        <option value="<?php echo $id?>"><?php echo $value ?></option>
                    <?php }?>
                </select>
            </div>
            <div id="searchproperties">
                <label for="court">Choose a court:</label>
                <select name="court" id="court" >
                    <option value="Budapest Basketball Aréna">Budapest Basketball Aréna</option>
                    <option value="Győr Basketball Aréna">Győr Basketball Aréna</option>
                    <option value="Pécs Basketball Aréna">Pécs Basketball Aréna</option>
                    <option value="Veresegyház Basketball Aréna">Veresegyház Basketball Aréna</option>
                </select><br>
                <label for="date">Choose a date:</label>
                <input type="date" name="date" id="date"></input><br>
                <label for="referee">Choose a referee:</label>
                <select name="referee" id="referee" >
                    <option value="Ferenc József">Ferenc József</option>
                    <option value="Kis István">Kis István</option>
                    <option value="Mezőkövesdi Péter">Mezőkövesdi Péter</option>
                </select><br>
                <button class="second-buttons" id="startbutton" name="startbutton" type="submit">Start</button><br>
            </div>
        </div>
        </div>
    </form>
    <footer>
        <p>Fejlesztők</p>
        <p>Fellner Milán</p>
        <p>Németh Csaba Bence</p>
        <p><a href="https://github.com/Benceplays/kosarphp" target="_blank">Github</a></p>
    </footer>
</body>
<script>
    var date = new Date();
    var currentDate = date.toISOString().substring(0,10);
    document.getElementById('date').value = currentDate;
</script>
</html>