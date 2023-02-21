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
    <script src="jquery-3.6.0.min.js"></script>
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
            <h1><?php echo $hometeam?></h1>
            <h1 id="homepoints">0</h1>
            <div class="home-players">
                <div class="players-box" id="home-players-box" style="float: left; margin-left: -1px;">
                <p style="border-bottom: 2px solid #303030; margin-bottom:1%;">Játékosok a pályán</p>
                    <div id="homeplayers">
                        <?php 
                            foreach($homeplayers as $id => $value) {?>
                                <input type="radio" value="<?php echo $id?>" name="homeplayers"><?php echo $value; echo $id ?></input></br>
                        <?php }?>
                    </div> 
                </div>
                <button class="team-change" onclick="homesubtituteschanged(), homeplayerschanged(), homeplayerchange()"><></button>
                <div class="players-box" id="home-subtitutes-box" style="float: right;">
                <p style="border-bottom: 2px solid #303030; margin-bottom:1%;">Játékosok a kispadon</p>
                    <div id="homesubtitutes">
                        <?php 
                            foreach($homesubtitutes as $id => $value) {?>
                                <input type="radio" value="<?php echo $id?>" name="homesubtitutes"><?php echo $value; echo $id  ?></input></br>
                        <?php }?>
                    </div>
                </div>
            </div>
                <div class="points">
                    <label for="home-point" style="font-size: 30px;">Pont:</label>
                    <select name="home-point" id="home-point" >
                        <option value="1">1 point</option>
                        <option value="2">2 point</option>
                        <option value="3">3 point</option>
                    </select><br>
                    <button class="point-buttons" onclick="homeplayerschanged(), homesubtituteschanged(), homemistakes()" style="border: 2px solid red; color: red; font-size: 25px; margin-top: 2.5%;">X</button>
                    <button class="point-buttons" id="plushomepoint" name="plushomepoint" onclick="homeplayerschanged(), homesubtituteschanged(), homepointadd()" style="border: 2px solid green; color: green; font-size: 21.5px; margin-top: 2.5%; margin-left: 5%;">✓</button>
                </div>
        </div>
        <div id="away">
            <h1><?php echo $awayteam?></h1>
            <h1 id="awaypoints">0</h1>
            <div class="home-players">
                <div class="players-box" id="players-box" style="float: left;">
                <p style="border-bottom: 2px solid #303030; margin-bottom:1%;">Játékosok a pályán</p>
                <div id="awayplayers">
                        <?php 
                            foreach($awayplayers as $id => $value) {?>
                                <input type="radio" value="<?php echo $id?>" name="awayplayers"><?php echo $value; echo $id  ?></input></br>
                        <?php }?>
                    </div>
                </div>
                <button class="team-change" onclick="awayplayerschanged(), awaysubtituteschanged(), awayplayerchange()"><></button>
                <div class="players-box" style="float: right;">
                <p style="border-bottom: 2px solid #303030; margin-bottom:1%;">Játékosok a kispadon</p>
                <div id="awaysubtitutes">
                        <?php 
                            foreach($awaysubtitutes as $id => $value) {?>
                                <input type="radio" value="<?php echo $id?>" name="awaysubtitutes"><?php echo $value; echo $id ?></input></br>
                        <?php }?>
                    </div>
                </div>
            </div>
            <div class="points">
                <label for="away-point" style="font-size: 30px;">Pont:</label>
                <select name="away-point" id="away-point">
                    <option value="1">1 point</option>
                    <option value="2">2 point</option>
                    <option value="3">3 point</option>
                </select><br>
                <button class="point-buttons" onclick="awayplayerschanged(), awaysubtituteschanged(), awaymistakes()" style="border: 2px solid red; color: red; font-size: 25px; margin-top: 2.5%;">X</button>
                <button class="point-buttons" onclick="awayplayerschanged(), awaysubtituteschanged(), awaypointadd()" style="border: 2px solid green; color: green; font-size: 21.5px; margin-top: 2.5%; margin-left: 5%;">✓</button>
            </div>
        </div>
        <div class="events" id="events">
            <p style="color:#303030;">Az aréna: <?php echo $court ?></p>
            <p style="color:#303030;">A mai dátum: <?php echo $date ?></p>
            <p style="color:#303030;">A játékvezető: <?php echo $referee ?></p>
        </div>
        <button class="stop_button" style="display: none; margin-left:42%;" id="startbutton" name="startbutton" type="submit" onclick="doTimer()">Folytat</button>
        <button class="stop_button" id="stopbutton" name="stopbutton" type="submit" onclick="stopTimer()">Megállít</button><br>
    </div>
</body>
<script>
var homepoints = 0;
var awaypoints = 0;
var homeplayerid = undefined;
var homesubtitutesid = undefined;
var awayplayerid = undefined;
var awaysubtitutesid = undefined;
const homeplayers = <?php echo json_encode($homeplayers); ?>;
const homesubtitutes = <?php echo json_encode($homesubtitutes); ?>;
const awayplayers = <?php echo json_encode($awayplayers); ?>;
const awaysubtitutes = <?php echo json_encode($awaysubtitutes); ?>;
const jatekosok = <?php echo json_encode($játékosok); ?>;
var minutes= 0;
var seconds = 1;
var time;
var paused = false;
var filteredhomeplayers = [];
var filteredhomesubtitutes = [];
var filteredawayplayers = [];
var filteredawaysubtitutes = [];

function doTimer()   {  
    timedCount();
    document.getElementById('startbutton').style.display = "none";
    paused = false;
}
function stopTimer() { 
    clearTimeout(t);
    document.getElementById('startbutton').style.display = "block";
    paused = true;
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
    document.getElementsByName('homesubtitutes')
    .forEach(radio => {
        if(radio.checked){
            homesubtitutesid = radio.value;
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
function awaysubtituteschanged(){
    document.getElementsByName('awaysubtitutes')
    .forEach(radio => {
        if(radio.checked){
            awaysubtitutesid = radio.value;
        }
    });
}

function homepointadd(){
    if (homeplayerid != undefined && paused == false){
        for (let index = 0; index < jatekosok.length; index++) {
            if(jatekosok[index][2] == homeplayers[homeplayerid]){
                var playernumber = jatekosok[index][1];
            }
        }
        const point = document.getElementById('home-point').value;
        homepoints = homepoints + parseInt(point);
        document.getElementById('homepoints').innerHTML = homepoints;
        const paragraph = document.createElement("p");
        paragraph.innerHTML = minutes+":"+seconds + " | " + playernumber + " " + homeplayers[homeplayerid] + " (Hazai) " + point + " pont";
        document.getElementById('events').appendChild(paragraph);
    }
}
function awaypointadd(){
    if (awayplayerid != undefined && paused == false){
        for (let index = 0; index < jatekosok.length; index++) {
            if(jatekosok[index][2] == awayplayers[awayplayerid]){ var playernumber = jatekosok[index][1]; }
        }
        const point = document.getElementById('away-point').value;
        awaypoints = awaypoints + parseInt(point);
        document.getElementById('awaypoints').innerHTML = awaypoints;
        const paragraph = document.createElement("p");
        paragraph.innerHTML = minutes + ":" + seconds + " | " +  playernumber + " " + awayplayers[awayplayerid] + "(Vendég) " + point + " pont";
        document.getElementById('events').appendChild(paragraph);
    }
}
function homemistakes(){
    if (homeplayerid != undefined && paused == false){
        for (let index = 0; index < jatekosok.length; index++) {
            if(jatekosok[index][2] == homeplayers[homeplayerid]){ var playernumber = jatekosok[index][1]; }
        }
        const point = document.getElementById('home-point').value;
        const paragraph = document.createElement("p");
        paragraph.innerHTML = minutes+":"+seconds + " | " + playernumber + " " + homeplayers[homeplayerid] + " (Hazai) " + point + " pont (KIHAGYVA)" ;
        document.getElementById('events').appendChild(paragraph);
    }
}
function awaymistakes(){
    if (awayplayerid != undefined && paused == false){
        for (let index = 0; index < jatekosok.length; index++) {
            if(jatekosok[index][2] == awayplayers[awayplayerid]){ var playernumber = jatekosok[index][1]; }
        }
        const point = document.getElementById('away-point').value;
        const paragraph = document.createElement("p");
        paragraph.innerHTML = minutes+":"+seconds + " | " + playernumber + " " + awayplayers[awayplayerid] + "(Vendég) " + point + " pont (KIHAGYVA)";
        document.getElementById('events').appendChild(paragraph);
    }
}
function idclear(){
    homeplayerid = undefined;
    homesubtitutesid = undefined;
    awayplayerid = undefined;
    awaysubtitutesid = undefined;
}
function homeplayerchange(){
    if(homeplayerid != undefined && homesubtitutesid != undefined){
        if (filteredhomeplayers.length === 0){
            const paragraph = document.createElement("p");
            paragraph.innerHTML = minutes+":"+seconds + " | " + homeplayers[homeplayerid] + "=>" + homesubtitutes[homesubtitutesid] + " (Csere) (Hazai)";
            document.getElementById('events').appendChild(paragraph);
            homeplayers.push(homesubtitutes[homesubtitutesid]);
            homesubtitutes.push(homeplayers[homeplayerid]);
            delete homeplayers[homeplayerid];
            delete homesubtitutes[homesubtitutesid];
            filteredhomeplayers = homeplayers.filter(function (el) { return el != null; });
            filteredhomesubtitutes = homesubtitutes.filter(function (el) { return el != null; });
        }else{
            const paragraph = document.createElement("p");
            paragraph.innerHTML = minutes+":"+seconds + " | " + filteredhomeplayers[homeplayerid] + "=>" + filteredhomesubtitutes[homesubtitutesid] + " (Csere) (Hazai)";
            document.getElementById('events').appendChild(paragraph);
            filteredhomeplayers.push(filteredhomesubtitutes[homesubtitutesid]);
            filteredhomesubtitutes.push(filteredhomeplayers[homeplayerid]);
            delete filteredhomeplayers[homeplayerid];
            delete filteredhomesubtitutes[homesubtitutesid];           
            filteredhomeplayers = filteredhomeplayers.filter(function (el) { return el != null; });
            filteredhomesubtitutes = filteredhomesubtitutes.filter(function (el) { return el != null; });
        }

        var hazaiplayers = document.getElementById("homeplayers") ;
        var hazaicserek = document.getElementById("homesubtitutes");
        $(hazaiplayers).html("");
        $(hazaicserek).html("");

        var s = "";
        for (let index = 0; index < filteredhomeplayers.length; index++) {
            s += "<input type = 'radio' name = 'homeplayers' value = " + parseInt(index) + ">" + filteredhomeplayers[index] + index + "</input><br>";         
        }
        hazaiplayers.innerHTML = s;
        var k = "";
        for (let index = 0; index < filteredhomesubtitutes.length; index++) {
            k += "<input type = 'radio' name = 'homesubtitutes' value = " + parseInt(index) + ">" + filteredhomesubtitutes[index] + index + "</input><br>";         
        }
        hazaicserek.innerHTML = k;
    }
}
function awayplayerchange(){
    if(awayplayerid != undefined && awaysubtitutesid != undefined){
        if (filteredawayplayers.length === 0){
            const paragraph = document.createElement("p");
            paragraph.innerHTML = minutes+":"+seconds + " | " + awayplayers[awayplayerid] + "=>" + awaysubtitutes[awaysubtitutesid] + " (Csere) (Vendég)";
            document.getElementById('events').appendChild(paragraph);
            awayplayers.push(awaysubtitutes[awaysubtitutesid]);
            awaysubtitutes.push(awayplayers[awayplayerid]);
            delete awayplayers[awayplayerid];
            delete awaysubtitutes[awaysubtitutesid];
            filteredawayplayers = awayplayers.filter(function (el) { return el != null; });
            filteredawaysubtitutes = awaysubtitutes.filter(function (el) { return el != null; });
        }else{
            const paragraph = document.createElement("p");
            paragraph.innerHTML = minutes+":"+seconds + " | " + filteredawayplayers[awayplayerid] + "=>" + filteredawaysubtitutes[awaysubtitutesid] + " (Csere) (Vendég)";
            document.getElementById('events').appendChild(paragraph);
            filteredawayplayers.push(filteredawaysubtitutes[awaysubtitutesid]);
            filteredawaysubtitutes.push(filteredawayplayers[awayplayerid]);
            delete filteredawayplayers[awayplayerid];
            delete filteredawaysubtitutes[awaysubtitutesid];
        
            filteredawayplayers = filteredawayplayers.filter(function (el) { return el != null; });
            filteredawaysubtitutes = filteredawaysubtitutes.filter(function (el) { return el != null; });
        }

        var hazaiplayers = document.getElementById("awayplayers") ;
        var hazaicserek = document.getElementById("awaysubtitutes");
        $(hazaiplayers).html("");
        $(hazaicserek).html("");
        var s = "";
        for (let index = 0; index < filteredawayplayers.length; index++) {
            s += "<input type = 'radio' name = 'awayplayers' value = " + parseInt(index) + ">" + filteredawayplayers[index] + index + "</input><br>";         
        }
        hazaiplayers.innerHTML = s;
        var k = "";
        for (let index = 0; index < filteredawaysubtitutes.length; index++) {
            k += "<input type = 'radio' name = 'awaysubtitutes' value = " + parseInt(index) + ">" + filteredawaysubtitutes[index] + index + "</input><br>";         
        }
        hazaicserek.innerHTML = k;
  
    }
}
timedCount();
function timedCount() {
    $("#time").html(minutes+":"+seconds+"<br>"+(((minutes / 15) | 0) +1 )+". negyed");
    ++seconds;
    if (seconds %60 ==0) { ++minutes; seconds=0; }
    t=setTimeout("timedCount()",1000);
  }
</script>
</html>