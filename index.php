<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <title>Конфигуратор</title>
</head>
<body>
    <?php
    require __DIR__.'/vendor/autoload.php';
    require_once __DIR__.'/dompdf/autoload.inc.php';
    use Dompdf\Dompdf;
    $door=new Door;
    $dompdf = new Dompdf();
    $dompdf->loadHtml('hello world');

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'landscape');

// Render the HTML as PDF
$dompdf->render();
// $out=$dompdf->output();
// file_put_contents(filename:'dom.pdf',$out);

// Output the generated PDF to Browser
$dompdf->stream();
    if($_POST["col-door"]){
        

// instantiate and use the dompdf class

// $dompdf->loadHtml('hello world');

// // (Optional) Setup the paper size and orientation
// $dompdf->setPaper('A4', 'landscape');

// // Render the HTML as PDF
// $dompdf->render();
// // $out=$dompdf->output();
// // file_put_contents(filename:'dom.pdf',$out);

// // Output the generated PDF to Browser
// $dompdf->stream();
        $cold = trim($_POST["col-door"]);
        $coldp=trim($_POST["col-doorpl"]);
        $coldb=trim($_POST["col-door-knob"]);
        $widthd=trim($_POST["widthd"]);
        $haightd=trim($_POST["haightd"]);
        $opend=trim($_POST["door-open"]);
        $accs=trim($_POST["accs"]);
        $token="6293804882:AAEV2CZumhJtftAMoHr8zDd7FFFe516DMXw";
        $chat_id="-916541749";
        $cold=$door->colname($cold);
        $coldp=$door->colname($coldp);
        $coldb=$door->colname($coldb);
        $opend=$door->opendname($opend);
        $arrch=array(
            'Цвет двери: '=>$cold,
            'Цвет пленки: '=>$coldp,
            'Цвет пленки: '=>$coldb,
            'Ширина: '=>$widthd,
            'Высота: '=>$haightd,
            'Открывается: '=>$opend,
            'Дополнение: '=>$accs
        );
        foreach($arrch as $key=>$value){
            $txt.="<b>".$key."</b> ".$value."%0A";
        }
        $sendToTelegram=fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$txt}","r");
        conndb();
        $sql = "INSERT INTO config (coldoor, coldoorp,colknob,width,heig,opent,acsas) VALUES ('$cold', '$coldp', '$coldb', $widthd, $haightd, '$opend', '$accs')";
        $mysqli->query($sql);
        cldb();
    }
    function conndb(){
        global $mysqli;
        $mysqli=new mysqli("localhost","root","root","testdoor");
        $mysqli->query("SET NAMES 'utf-8'");
        return $mysqli;
    }
    function cldb(){
        global $mysqli;
        $mysqli->close();
    }
    function resArr($res){
        $arr=array();
            while(($row=$res->fetch_assoc()) != false){
                $arr[]=$row;
            }
            return $arr;
    }
    class Door{
        public $mysqli=false;
        public function colname($cold){
            switch ($cold) {
                case '1':
                    $cold='Краснный';
                    break;
                case '2':
                        $cold='Зеленый';
                    break;
                case '3':
                        $cold='Синий';
                    break;
                case '4':
                        $cold='Белый';
                    break;
                case '5':
                        $cold='Безжевый';
                    break;
                default:
                    $cold='None';
                    break;
            }
            return $cold;
        }
        public function opendname($opend){
            if($opend=='1'){
                $opend='Правое';
            }
            else{$opend='Левое';
            }
            return $opend;
        }
        public function resArr1($res){
            $arr=array();
                while(($row=$res->fetch_assoc()) != false){
                    $arr[]=$row;
                }
                return $arr;
            }
        public function resarRr($res){
                $arr=array();
                while(($row=$res->fetch_assoc()) != false){
                    $arr[]=$row;
                }
                return $arr;
                }
                public function doorvar($lim){
                    global $mysqli;
                    conndb();
                    $res=$mysqli->query("SELECT * FROM `color-door` ORDER BY `id` LIMIT $lim");
                    cldb();
                    return resArr($res);
                }
    }
    ?>
    
    <section class="config">
        <div class="obj-door">
            <div class="width-door" id="width-door">
                <div class="face-door" id="face-door" >
                    <div class="door-knob" id="door-knob"></div>
                </div>
            </div>
            <div class="width-door-inv" id="width-door-inv">
                <div class="face-door-inv" id="face-door-inv">
                    <div class="door-knob-inv" id="door-knob-inv"></div>
                </div>
            </div>
        </div>
        <div class="info">
            <div class="col1">
                <div class="names">Цвет покраски</div>
                <div class="names">Цвет пленки</div>
                <div class="names">Цвет ручки</div>
                <div class="names">Ширина</div>
                <div class="names">Высота</div>
                <div class="names">Открывание</div>
                <div class="names">Аксесс</div>
                <div class="names">Цена</div>
            </div>
            <div class="col2">
                <form action="" method="post">
                    <div id="inp"> 
                        <select name="col-door" id="col-door" onchange="coldoor(this.value);">\
                            <option value="0"> </option>
                            <?$d=$door->doorvar(7);
                            for($i=0;$i<count($d);$i++){echo $d[$i]["namehtml"];}?>
                        </select>
                    </div>
                    <div id="inp">
                        <select name="col-doorpl" id="col-doorpl" onchange="coldoorp(this.value);">
                            <option value="0"> </option>
                            <?$d=$door->doorvar(7);
                            for($i=0;$i<count($d);$i++){echo $d[$i]["namehtml"];}?>
                        </select>
                    </div>
                    <div id="inp">
                        <select name="col-door-knob" id="col-door-knob" onchange="coldoorKnob(this.value);">
                            <option value="0"> </option>
                            <?$d=$door->doorvar(7);
                            for($i=0;$i<count($d);$i++){echo $d[$i]["namehtml"];}?>
                        </select>
                    </div>
                    <div id="inp">
                        <input type="text" id="widthd" name="widthd">
                    </div>
                    <div id="inp">
                        <input type="text" id="haightd" name="haightd">
                    </div>
                    <div id="inp">
                        <select name="door-open" id="door-open" onchange="openn(this.value);">
                            <option value="0"> </option>
                            <option value="1">Правое</option>
                            <option value="2">Левое</option>
                        </select>
                    </div>
                    <div id="inp">
                        <input type="text" id="accs" name="accs" placeholder="a1, a2, a3">
                    </div>
                    <div id="inp">
                        <div id="price">...</div>
                    </div>
                    <input onclick="validat();" type="submit" value="Отправить" class="addms">
                </form>
            </div>
        </div>
    </section>
    <script>
        var price=0;
        var q1=q2=q3=q4=0;
        function clearcoldoor(){
            $('#width-door').removeClass("clred");
            $('#width-door-inv').removeClass("clred");
            $('#width-door').removeClass("clgreen");
            $('#width-door-inv').removeClass("clgreen");
            $('#width-door').removeClass("clblue");
            $('#width-door-inv').removeClass("clblue");
            $('#width-door').removeClass("clwhite");
            $('#width-door-inv').removeClass("clwhite");
            $('#width-door').removeClass("clwheat");
            $('#width-door-inv').removeClass("clwheat");
        }
        function clearcoldoorp(){
            $('#face-door').removeClass("clred");
            $('#face-door-inv').removeClass("clred");
            $('#face-door').removeClass("clgreen");
            $('#face-door-inv').removeClass("clgreen");
            $('#face-door').removeClass("clblue");
            $('#face-door-inv').removeClass("clblue");
            $('#face-door').removeClass("clwhite");
            $('#face-door-inv').removeClass("clwhite");
            $('#face-door').removeClass("clwheat");
            $('#face-door-inv').removeClass("clwheat");
        }
        function clearcoldoorKnob(){
            $('#door-knob').removeClass("clred");
            $('#door-knob-inv').removeClass("clred");
            $('#door-knob').removeClass("clgreen");
            $('#door-knob-inv').removeClass("clgreen");
            $('#door-knob').removeClass("clblue");
            $('#door-knob-inv').removeClass("clblue");
            $('#door-knob').removeClass("clwhite");
            $('#door-knob-inv').removeClass("clwhite");
            $('#door-knob').removeClass("clwheat");
            $('#door-knob-inv').removeClass("clwheat");
        }
        function coldoor(val1){
            if(val1==1){
                clearcoldoor();
                $('#width-door').addClass("clred");
                $('#width-door-inv').addClass("clred");
                q1=100;val();
            }
            else if(val1==2){clearcoldoor();
                $('#width-door').addClass("clgreen");
                $('#width-door-inv').addClass("clgreen");
                q1=200;val();
            }
            else if(val1==3){clearcoldoor();
                $('#width-door').addClass("clblue");
                $('#width-door-inv').addClass("clblue");
                q1=300;val();
            }
            else if(val1==4){clearcoldoor();
                $('#width-door').addClass("clwhite");
                $('#width-door-inv').addClass("clwhite");
                q1=400;val();
            }
            else if(val1==5){clearcoldoor();
                $('#width-door').addClass("clwheat");
                $('#width-door-inv').addClass("clwheat");
                q1=500;val();
            }
            else{
                q1=0;val();
            }
        };
        function coldoorp(val2){
            if(val2==1){//alert(val);
            //coldoor.classList.add('clred');
            clearcoldoorp();
            $('#face-door').addClass("clred");
            $('#face-door-inv').addClass("clred");
            q2=10;val();
            }
            else if(val2==2){clearcoldoorp();
                $('#face-door').addClass("clgreen");
                $('#face-door-inv').addClass("clgreen");
                q2=20;val();
            }
            else if(val2==3){clearcoldoorp();
                $('#face-door').addClass("clblue");
                $('#face-door-inv').addClass("clblue");
                q2=30;val();
            }
            else if(val2==4){clearcoldoorp();
                $('#face-door').addClass("clwhite");
                $('#face-door-inv').addClass("clwhite");
                q2=40;val();
            }
            else if(val2==5){clearcoldoorp();
                $('#face-door').addClass("clwheat");
                $('#face-door-inv').addClass("clwheat");
                q2=50;val();
            }
            else{
                q2=0;val();
            }
        };
        function coldoorKnob(val3){
            if(val3==1){//alert(val);
            //coldoor.classList.add('clred');
            clearcoldoorKnob();
            $('#door-knob').addClass("clred");
            $('#door-knob-inv').addClass("clred");
            q3=50;val();
            }
            else if(val3==2){clearcoldoorKnob();
                $('#door-knob').addClass("clgreen");
                $('#door-knob-inv').addClass("clgreen");
                q3=100;val();
            }
            else if(val3==3){clearcoldoorKnob();
                $('#door-knob').addClass("clblue");
                $('#door-knob-inv').addClass("clblue");
                q3=150;val();
            }
            else if(val3==4){clearcoldoorKnob();
                $('#door-knob').addClass("clwhite");
                $('#door-knob-inv').addClass("clwhite");
                q3=200;val();
            }
            else if(val3==5){clearcoldoorKnob();
                $('#door-knob').addClass("clwheat");
                $('#door-knob-inv').addClass("clwheat");
                q3=250;val();
            }
            else{
                q3=0;val();
            }
        };
        
        function openn(val4){
            if(val4==1){
                $("#door-knob").css({"left":"11%","transition":"all 1s"});$("#door-knob-inv").css({"left":"74%","transition":"all 1s"});
            }
            else if(val4==2){
                $("#door-knob").css({"left":"74%","transition":"all 1s"});$("#door-knob-inv").css({"left":"11%","transition":"all 1s"});
            }
        };
        var inp1=document.getElementById('widthd');
        var inp2=document.getElementById('haightd');
        inp1.oninput = function() {
            if(inp1.value==65){$("#face-door").css({"width":"88%","left":"5%"});$("#face-door-inv").css({"width":"88%","left":"5%"});}
            else if(inp1.value==70){$("#face-door").css({"width":"89%","left":"4%","transition":"all 1s"});$("#face-door-inv").css({"width":"89%","left":"4%","transition":"all 1s"});}
            else if(inp1.value==75){$("#face-door").css({"width":"90%","left":"3%","transition":"all 1s"});$("#face-door-inv").css({"width":"90%","left":"3%","transition":"all 1s"});}
            else if(inp1.value==80){$("#face-door").css({"width":"95%","left":"2%","transition":"all 1s"});$("#face-door-inv").css({"width":"95%","left":"2%","transition":"all 1s"});}
            else if(inp1.value==60){$("#face-door").css({"width":"86%","left":"6%","transition":"all 1s"});$("#face-door-inv").css({"width":"86%","left":"6%","transition":"all 1s"});}
            else if(inp1.value==55){$("#face-door").css({"width":"85%","left":"7%","transition":"all 1s"});$("#face-door-inv").css({"width":"85%","left":"7%","transition":"all 1s"});}
            else if(inp1.value==50){$("#face-door").css({"width":"84%","left":"8%","transition":"all 1s"});$("#face-door-inv").css({"width":"84%","left":"8%","transition":"all 1s"});}
            else if(inp1.value==45){$("#face-door").css({"width":"83%","left":"8%","transition":"all 1s"});$("#face-door-inv").css({"width":"83%","left":"8%","transition":"all 1s"});}
            if(inp1.value<45||inp1.value>80){
                $("#widthd").css({"color":"#ffa0a0"});
                setTimeout(() => {  $("#widthd").css({"color":"black"}); }, 200);
                setTimeout(() => {  $("#widthd").css({"color":"#ffa0a0"}); }, 400);
            }
            else{$("#widthd").css({"color":"green"});setTimeout(() => {  $("#widthd").css({"color":"black"}); }, 200);}};
        inp2.oninput = function() {
            if(inp2.value==200){$("#face-door").css({"top":"3%","height":"93%","transition":"all 1s"});$("#face-door-inv").css({"top":"3%","height":"93%","transition":"all 1s"});}
            else if(inp2.value==197){$("#face-door").css({"top":"4%","height":"92%","transition":"all 1s"});$("#face-door-inv").css({"top":"4%","height":"92%","transition":"all 1s"});}
            else if(inp2.value==194){$("#face-door").css({"top":"5%","height":"91%","transition":"all 1s"});$("#face-door-inv").css({"top":"5%","height":"91%","transition":"all 1s"});}
            else if(inp2.value==190){$("#face-door").css({"top":"6%","height":"88%","transition":"all 1s"});$("#face-door-inv").css({"top":"6%","height":"88%","transition":"all 1s"});}
            else if(inp2.value==188){$("#face-door").css({"top":"7%","height":"85%","transition":"all 1s"});$("#face-door-inv").css({"top":"7%","height":"85%","transition":"all 1s"});}
            else if(inp2.value==208){$("#face-door").css({"top":"2%","height":"94%","transition":"all 1s"});$("#face-door-inv").css({"top":"2%","height":"94%","transition":"all 1s"});}
            else if(inp2.value==211){$("#face-door").css({"top":"1.5%","height":"95%","transition":"all 1s"});$("#face-door-inv").css({"top":"1.5%","height":"95%","transition":"all 1s"});}
            else if(inp2.value==215){$("#face-door").css({"top":"1%","height":"96%","transition":"all 1s"});$("#face-door-inv").css({"top":"1%","height":"96%","transition":"all 1s"});}
            if(inp2.value<188||inp2.value>215){
                $("#haightd").css({"color":"#ffa0a0"});
                setTimeout(() => {  $("#haightd").css({"color":"black"}); }, 200);
                setTimeout(() => {  $("#haightd").css({"color":"#ffa0a0"}); }, 400);
            }
            else{$("#haightd").css({"color":"green"});setTimeout(() => {  $("#haightd").css({"color":"black"}); }, 200);}};
        function val(){
            price=1000+q1+q2+q3+q4;
            document.getElementById('price').textContent =price;
        }
    </script>
</body>
</html>