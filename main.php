<?php 
    include 'kosar.php';
    $játékosok = $_SESSION['jatekosok'];
    $csapatok = $_SESSION['csapatok'];

    $homepoints = 0;
    $awaypoints = 0;

    $homesubtitutes = array();
    $homeplayers = array();
    $awaysubtitutes = array();
    $awayplayers = array();

    if(isset($_POST['startbutton'])){
        $hometeam = $_POST['hometeam'];
        $awayteam = $_POST['awayteam'];
        $court = $_POST['court'];
        $date = $_POST['date'];
        $referee = $_POST['referee'];
    }
    //Itt dol el h hova kerul a jatekos
    $homeszam = 0;
    foreach($játékosok as $value) {
        if($value[0] == $hometeam){
            if($homeszam < 5){
                array_push($homeplayers, $value[2]);
                $homeszam = $homeszam + 1;
            }
            else{
                array_push($homesubtitutes, $value[2]);
                $homeszam = $homeszam + 1;
            }
        }
    }
    $awayszam = 0;
    foreach($játékosok as $value) {
        if($value[0] == $awayteam){
            if($awayszam < 5){
                array_push($awayplayers, $value[2]);
                $awayszam = $awayszam + 1;
            }
            else{
                array_push($awaysubtitutes, $value[2]);
                $awayszam = $awayszam + 1;
            }
        }
    }

    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kosárlabda</title>
    <link rel="stylesheet" href="style.css">
    <link rel="website icon" type="png" href="images/basketball.png">
</head>
<body style="background-image: url(images/wallpaper.png);">
    <div id="end" class="information">
        <h1 style="text-align:center;">Eredmények</h1>
            <p id="hometeampoint">A hazai csapat 10 pontot szerzett.</p>
            <p id="awayteampoint">A vendég csapat 20 pontot szerzett.</p>
        <button id="nextbutton" onclick="window.location.href='index.php'">Tovább</button>
    </div>
    <h1 style="text-align:center;" id="time">0</h1>
    <div id="main">
        <a class="stop_button" style="text-decoration: none;" href="index.php">Vissza</a>
        <h1>Kosárlabda mérkőzés jegyzőkönyv</h1>
        <div id="h-elvalaszto"></div>
        <div id="home">
            <h1 id="homepoints">0</h1>
            <div class="home-players">
                <div class="players-box" style="float: left; margin-left: -1px;">
                <p style="border-bottom: 2px solid #303030; margin-bottom:1%;">Játékosok a pályán</p>
                    <div id="homeplayers">
                        <?php 
                            foreach($homeplayers as $id => $value) {?>
                                <input type="radio" value="<?php echo $id?>" name="homeplayers"><?php echo $value?></input></br>
                        <?php }?>
                    </div> 
                </div>
                <button class="team-change" onclick="homesubtituteschanged(), homeplayerschanged(), homeplayerchange()"><></button>
                <div class="players-box" style="float: right;">
                <p style="border-bottom: 2px solid #303030; margin-bottom:1%;">Játékosok a kispadon</p>
                    <div id="homesubtitutes">
                        <?php 
                            foreach($homesubtitutes as $id => $value) {?>
                                <input type="radio" value="<?php echo $id?>" name="homesubtitues"><?php echo $value ?></input></br>
                        <?php }?>
                    </div>
                </div>
            </div>
                <div class="points">
                    <label for="home-point" style="font-size: 30px;">Point:</label>
                    <select name="home-point" id="home-point" >
                        <option value="1">1 point</option>
                        <option value="2">2 point</option>
                        <option value="3">3 point</option>
                    </select><br>
                    <button class="point-buttons" style="border: 2px solid red; color: red; font-size: 25px; margin-top: 2.5%;">X</button>
                    <button class="point-buttons" id="plushomepoint" name="plushomepoint" onclick="homeplayerschanged(), homesubtituteschanged(), homepointadd()" style="border: 2px solid green; color: green; font-size: 21.5px; margin-top: 2.5%; margin-left: 5%;">✓</button>
                </div>
        </div>
        <div id="away">
            <h1 id="awaypoints">0</h1>
            <div class="home-players">
                <div class="players-box" id="players-box" style="float: left;">
                <p style="border-bottom: 2px solid #303030; margin-bottom:1%;">Játékosok a pályán</p>
                <div id="awayplayers">
                        <?php 
                            foreach($awayplayers as $id => $value) {?>
                                <input type="radio" value="<?php echo $id?>" name="awayplayers"><?php echo $value ?></input></br>
                        <?php }?>
                    </div>
                </div>
                <button class="team-change" onclick="awayplayerschanged(), awaysubtitueschanged()"><></button>
                <div class="players-box" style="float: right;">
                <p style="border-bottom: 2px solid #303030; margin-bottom:1%;">Játékosok a kispadon</p>
                <div id="awaysubtitutes">
                        <?php 
                            foreach($awaysubtitutes as $id => $value) {?>
                                <input type="radio" value="<?php echo $id?>" name="awaysubtitues"><?php echo $value ?></input></br>
                        <?php }?>
                    </div>
                </div>
            </div>
            <div class="points">
                <label for="away-point" style="font-size: 30px;">Point:</label>
                <select name="away-point" id="away-point">
                    <option value="1">1 point</option>
                    <option value="2">2 point</option>
                    <option value="3">3 point</option>
                </select><br>
                <button class="point-buttons" style="border: 2px solid red; color: red; font-size: 25px; margin-top: 2.5%;">X</button>
                <button class="point-buttons" onclick="awayplayerschanged(), awaysubtitueschanged(), awaypointadd()" style="border: 2px solid green; color: green; font-size: 21.5px; margin-top: 2.5%; margin-left: 5%;">✓</button>
            </div>
        </div>
        <div class="events" id="events">
            <p>Az aréna: <?php echo $court ?></p>
            <p>A mai dátum: <?php echo $date ?></p>
            <p>A játékvezető: <?php echo $referee ?></p>
        </div>
        <button class="stop_button" id="startbutton" name="startbutton" type="submit">Stop</button><br>
    </div>
</body>
<script>
var homepoints = 0;
var awaypoints = 0;
var homeplayerid = null;
var homesubtituesid = null;
var awayplayerid = null;
var awaysubtituesid = null;
var homeplayers = <?php echo json_encode($homeplayers); ?>;
var awayplayers = <?php echo json_encode($awayplayers); ?>;

function homepointadd(){
    if (homeplayerid != null){
        var playernumber = 9;
        const point = document.getElementById('home-point').value;
        homepoints = homepoints + parseInt(point);
        document.getElementById('homepoints').innerHTML = homepoints;
        const paragraph = document.createElement("p");
        paragraph.innerHTML = "12.35 " + playernumber + " " + homeplayers[homeplayerid] + " (Hazai) " + point + " pont";
        document.getElementById('events').appendChild(paragraph);
    }
}

function awaypointadd(){
    if (awayplayerid != null){
        var playernumber = 9;
        const point = document.getElementById('away-point').value;
        awaypoints = awaypoints + parseInt(point);
        document.getElementById('awaypoints').innerHTML = awaypoints;
        const paragraph = document.createElement("p");
        paragraph.innerHTML = "12.35 " + playernumber + " " + awayplayers[awayplayerid] + "(Vendég) " + point + " pont";
        document.getElementById('events').appendChild(paragraph);
    }
}
function homeplayerchange(){
    if(homeplayerid != null || homesubtitutesid != null){
        var homeplayerclear = "<?php unset($homeplayers[3])?>";
        var homesubtitutesclear = "<?php unset($homesubtitutes[2])?>";
        var homeplayerfill = "<?php array_push($homeplayers, $homesubtitutes[2])?>";
        var homesubtitutesfill = "<?php array_push($homesubtitutes, $homeplayers[3])?>";
    }
}
//lekérdezi a radio inputokat
function homeplayerschanged(){
    document.getElementsByName('homeplayers')
    .forEach(radio => {
        if(radio.checked){
            homeplayerid = radio.value;
        }
    });
}
function homesubtituteschanged(){
    document.getElementsByName('homesubtitues')
    .forEach(radio => {
        if(radio.checked){
            homesubtituesid = radio.value;
        }
    });
}
function awayplayerschanged(){
    document.getElementsByName('awayplayers')
    .forEach(radio => {
        if(radio.checked){
            awayplayerid = radio.value;
        }
    });
}
function awaysubtitueschanged(){
    document.getElementsByName('awaysubtitues')
    .forEach(radio => {
        if(radio.checked){
            awaysubtituesid = radio.value;
        }
    });
}
millisec();
var timeinsec = 0;
var maxtime = 120;//30 egy negyed

function millisec(){
        var inst = setInterval(time, 1000);
}

function time(){
    const ido = document.getElementById('time');
    if (timeinsec != maxtime){
        timeinsec++;
        ido.innerHTML = timeinsec;
        console.log(timeinsec);
    }
    else{
        document.getElementById('end').style.display = "block";
        document.getElementById('hometeampoint').innerHTML = "A hazai csapat " + homepoints + " pontot szerzett.";
        document.getElementById('awayteampoint').innerHTML = "A vendég csapat " + awaypoints + " pontot szerzett.";
    }
}
</script>
</html>