<?php
if(empty($_GET["community"])) {
    die("Community error");
}

require_once('json/getjson.php');

$json = getCommunityJSON($_GET["community"]);

if(isset($json)){
    $community = json_decode($json, true);
} else {
    die("Community error");
}

?>

<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--><html lang="en"><!--<![endif]-->


<div class="modal-content">
<div class="close-modal" data-dismiss="modal">
    <div class="lr">
        <div class="rl">
        </div>
    </div>
</div>

<html>
<head>
    <meta charset="utf-8" />
    <title>Freifunk - Gluon Firmware Downloader | Beginner mode</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css" />

    <!-- Wizard Stylesheet -->
    <link rel="stylesheet" href="css/wizard.css">

    <link rel="stylesheet" href="css/beginner.css">

</head>
<body>

<div class="container">

<div class="page-header">
    <h1>Freifunk Installer <small>Beginner mode</small></h1>
</div>


<div class="span12 widget">
    <div class="widget-content form-container">
        <form id="wizard" class="form-horizontal" data-forward-only="false">
            <fieldset class="wizard-step">
                <legend class="wizard-label"><i class="fa fa-cloud-download"></i>
                    Freifunk Software download
                </legend>

                <br/>
                <div class="col-2">
                    <div class="widget-box">
                        <div class="widget-header">
                            <h4><span class="badge">1</span> Hersteller Auswahl</h4>
                        </div>
                        <div class="widget-body">
                            <div class="widget-main">

                                <div class="vendor-query" vendor="">
                                    <div class="vendor vendor-NONE">
                                        ALL
                                    </div>
                                </div>
                                <?php
                                foreach($community as $vendor => $devices)
                                {
                                    echo '<div class="vendor-query" vendor="'.$vendor.'"> ';
                                    echo '<div class="vendor vendor-'. $vendor .'">';
                                    echo $vendor;
                                    echo '</div> </div>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                <br/>
                <div class="col-2">
                    <div class="widget-box">
                        <div class="widget-header">
                            <h4><span class="badge">2</span> Routermodell Auswahl</h4>
                            <input type="text" class="input-medium search-query widget-toolbar" placeholder="Search">
                        </div>
                        <div class="widget-body">
                            <div class="widget-main">
                                <?php
                                foreach($community as $vendor => $devices)
                                {
                                    foreach($devices as $device => $versions)
                                    {
                                        foreach($versions as $version => $val)
                                        {
                                            echo '<div class="router-container"> ';
                                            echo '<div class="router modell-'.str_replace(".", "", $device).'-'.str_replace(".", "", $version). '" onclick="window.location.href = &apos;' . $val['factory']['stable'] . '&apos;">';
                                            echo $vendor . " " . $device . " " . $version;
                                            echo '</div> </div>';
                                        }
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>

            <fieldset class="wizard-step">
                <legend class="wizard-label"><i class="fa fa-upload"></i>
                    Flash Router
                </legend>

                <br/>
                <div class="col-2">
                    <div class="widget-box">
                        <div class="widget-header">
                            <h4><span class="badge">1</span> Router anschliessen</h4>
                        </div>
                        <div class="widget-body">
                            <div class="widget-main">
                                <p><span class="badge">1.1</span> Schliessen sie das Netzteil an den Router an.</p>
                                <p><span class="badge">1.2</span> Verbinden sie nun mit einem Netzwerkkabel die Gelbe Buchse des Freifunkrouters mit ihrem Rechner</p>
                                <img src="img/Gelbe_buchse.png" class="img-responsive center"/>
                            </div>
                        </div>
                    </div>
                </div>

                <br/>
                <div class="col-2">
                    <div class="widget-box">
                        <div class="widget-header">
                            <h4><span class="badge">2</span> Freifunksoftware Upload</h4>
                        </div>
                        <div class="widget-body">
                            <div class="widget-main">
                                <span class="badge">2.1</span>&nbsp;
                                <button id="routerWindow" type="submit" class="btn btn-success" >
                                    <span class="glyphicon glyphicon-new-window"></span> Routeroberfl&auml;che &ouml;ffnen und Einloggen
                                </button>
                                <br/>
                                mit:
                                <div class="input-group col-xs-3 center">
                                    <span class="input-group-addon">User</span>
                                    <input type="text" class="form-control" placeholder="Username" value="admin">
                                </div>
                                <div class="input-group col-xs-3 center">
                                    <span class="input-group-addon">Passwort</span>
                                    <input type="text" class="form-control" placeholder="passwort" value="passwort">
                                </div>

                                <br/>
                                <p><span class="badge">2.2</span> Auf &quot;System Tools&quot; klicken und dann auf &quot;Firmware Upgrade&quot; klicken.</p> <br />
                                <p><span class="badge">2.3</span> Anschlie&szlig;end auf &quot;Browse&quot; klicken und die vorher heruntergeladene Firmware ausw&auml;hlen. Dann auf &quot;Upgrade&quot; klicken.</p> <br />
                                <p><span class="badge">2.4</span> Die Freifunk Firmware wird hochgeladen und installiert, <u class="text-danger">bitte nicht den Stecker ziehen!!</u> </p>

                                <br/>
                                <img src="img/update_install.png" class="img-responsive col-xs-offset-1 col-xs-10"/>
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>

            <fieldset class="wizard-step">
                <legend class="wizard-label"><i class="fa fa-wrench"></i>
                    Configure Router
                </legend>

                <br/>
                <div class="col-2">
                    <div class="widget-box">
                        <div class="widget-header">
                            <h4><span class="badge">1</span> Freifunkrouter einrichten</h4>
                        </div>
                        <div class="widget-body">
                            <div class="widget-main">
                                <p><span class="badge">1.1</span>
                                    <button id="ffRouterWindow" type="submit" class="btn btn-success" >
                                        <span class="glyphicon glyphicon-new-window"></span> Freifunkrouter oberfl&auml;che &ouml;ffnen
                                    </button>
                                </p>

                                <br />
                                <p>
                                    <h4><span class="badge">1.2</span> Name des Knotens:</h4>
                                    Der Knotenname erscheint sp&auml;ter auf der Karte und in den Statistiken.
                                    <img src="" class="img-responsive center-block"/>
                                </p>

                                <br />
                                <p>
                                    <h4><span class="badge">1.3</span> Knoten auf Karte anzeigen:</h4>
                                    Hier k&ouml;nnen Koordinaten hinterlegt werden, um den Freifunkrouters auf der Karte anzuzeigen.
                                    <img src="" class="img-responsive center-block"/>
                                </p>

                                <br />
                                <p>
                                    <h4><span class="badge">1.4</span> Kontakt:</h4>
                                    Mit diesem Kontakt k&ouml;nnen dich andere Freifunkter aus deiner Umgebung kontaktieren.
                                    <br/><i>Vorsicht: Bei manchen Communitys ist diese Info &ouml;ffentlich im Internet einsehbar</i>
                                    <img src="" class="img-responsive center-block"/>
                                </p>

                                <br/>
                                <p><span class="badge">1.5</span>
                                    Jetzt auf Speichern Klicken. Der Freifunkrouter Startet jetzt neu.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>

            <fieldset class="wizard-step">
                <legend class="wizard-label"><i class="fa fa-cogs"></i>
                    Register Router
                </legend>

                <br/>
                <div class="col-2">
                    <div class="widget-box">
                        <div class="widget-header">
                            <h4><span class="badge">1</span> Router registrieren</h4>
                        </div>
                        <div class="widget-body">
                            <div class="widget-main">

                                <!-- hier wird nach community unterschieden email -->
                                <?php
                                switch($_GET["community"]) {
                                    case 'Stuttgart':
                                        echo '<p><span class="badge">1.1</span> Jetzt muss der Freifunkrouter durch senden einer E-Mail an
                                        <a href="mailto:vpn-schluessel@lists.freifunk-stuttgart.net">vpn-schluessel@lists.freifunk-stuttgart.net</a>
                                    angemeldet werden.</p>
                                    <p>Der Nachrichtentext sollte den angezeigten Schl&uuml;ssel enthalten.</p>

                                    <small>Erst nachdem der Schl&uuml;ssel auf dem Freifunk Server eingetragen wurde,<br/>
                                        kann sich dein Freifunkrouter verbinden.</small>';
                                    break;
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                <br/>
                <div class="col-2">
                    <div class="widget-box">
                        <div class="widget-header">
                            <h4><span class="badge">2</span> Router anschliessen</h4>
                        </div>
                        <div class="widget-body">
                            <div class="widget-main">
                                <p><span class="badge">2.1</span> Verbinden sie nun mit dem Netzwerkkabel die blaue Buchse des Freifunkrouters mit ihrem Heimrouter</p>
                                <img src="img/Blaue_buchse.png" class="img-responsive center-block"/>
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>

            <fieldset class="wizard-step">
                <legend class="wizard-label"><i class="fa fa-wifi"></i>
                    Enjoy Freifunk
                </legend>

                <br/>
                <p style="font-size: xx-large;">
                    Willkommen bei Freifunk <?php echo isset($_GET["community"]) ? $_GET["community"] : null ?>

                    <br/>kontakt / weitere info...
                </p>
            </fieldset>
        </form>
    </div>
</div>


<!-- Core Scripts -->
<script src="js/jquery-1.8.3.min.js"></script>
<script src="js/bootstrap.min-2.2.js"></script>

<!-- Wizard -->
<script src="js/wizard.min.js"></script>
<script src="js/jquery.form.min.js"></script>

</div>

</body>
</html>

<script>
var routerURL = "http://192.168.0.1";
var vendor = ""
$(document).ready(function() {
    $('.search-query').keyup(function(){
        var query = $.trim($('.search-query').val()).toLowerCase();
        vendor != "" ? query = vendor + " " + query : null;
        $('div.router-container').each(function(){
            var $this = $(this);
            if($this.text().toLowerCase().indexOf(query) === -1)
                $this.closest('div.router-container').fadeOut();
            else $this.closest('div.router-container').fadeIn();
        });
    });

    $('.vendor-query').on('click', function(){
        $('.search-query').val("");
        var query = $.trim($(this).attr('vendor')).toLowerCase();
        vendor = query;
        $('div.router-container').each(function(){
            var $this = $(this);
            if($this.text().toLowerCase().indexOf(query) === -1)
                $this.closest('div.router-container').fadeOut();
            else $this.closest('div.router-container').fadeIn();
        });
    });

    $('#routerWindow').on('click', function(){
        window.open(routerURL);
    });

    $('#ffRouterWindow').on('click', function(){
        window.open('http://192.168.1.1');
    });
});


;(function( $, window, document, undefined ) {

    $(document).ready(function() {
        if( $.fn.wizard ) {
            $( '#wizard' ).wizard();
        }

    });

}) (jQuery, window, document);
</script>

</div>