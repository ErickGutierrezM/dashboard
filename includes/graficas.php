<script type="text/javascript">
// google.charts.load('current', {'packages': ['line']});
google.charts.load('current', {
    'packages': ['corechart']
});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {
    var data = google.visualization.arrayToDataTable([
        ['Meses', 'Facebook', 'Instagram', 'Google', 'LinkedIn', 'Waze', 'TikTok', 'Spotify'],
        <?php 
        
            $company = $_GET['company'];
            // $query = "SELECT mes_actual AS mes, red_social AS social, SUM(leads) AS total FROM campana_redes WHERE campana_empresa = '".$company."' GROUP BY social, mes ORDER BY 'Septiembre'" ;
            $query = "SELECT mes_actual AS mes, YEAR(fecha_inicio) AS anio, red_social AS social, SUM(leads) AS total FROM campana_redes WHERE campana_empresa = '".$company."' AND YEAR(fecha_inicio) <= YEAR(CURDATE()) GROUP BY social, mes ORDER BY MONTH(fecha_inicio) ASC, mes ASC" ;

            $meses = "";
            $resultado = mysqli_query($conexion, $query);
            while($data = mysqli_fetch_array($resultado)) {
                $facebook = 0;
                $instagram = 0;
                $google = 0;
                $linkedin = 0;
                $waze = 0;
                $tiktok = 0;
                $spotify = 0;

                if($meses != $data['mes']) {
                    $meses = $data['mes'];
                    if($data['social'] == 'Facebook') { 
                        $facebook = $data['total'];
                    }
                    else if($data['social'] == 'Instagram') {
                        $instagram = $data['total'];
                    }
                    else if($data['social'] == 'Google') {
                        $google = $data['total'];
                    }
                    else if($data['social'] == 'LinkedIn') {
                        $linkedin = $data['total'];
                    }
                    else if($data['social'] == 'Waze') {
                        $waze = $data['total'];
                    }
                    else if($data['social'] == 'TikTok') {
                        $tiktok = $data['total'];
                    }
                    else if($data['social'] == 'Spotify') {
                        $spotify = $data['total'];
                    }
                    $datos[] = array("mes"=>$data['mes'], "face"=>$facebook, "insta"=>$instagram, "goog"=>$google, "link"=>$linkedin, "waze"=>$waze, "tik"=>$tiktok, "spoti"=>$spotify);
                } 
                else {
                    $meses = $data['mes'];   
                    if($data['social'] == 'Facebook') {
                        $facebook = $data['total'];
                    }
                    else if($data['social'] == 'Instagram') {
                        $instagram = $data['total'];
                    }
                    else if($data['social'] == 'Google') {
                        $google = $data['total'];
                    }
                    else if($data['social'] == 'LinkedIn') {
                        $linkedin = $data['total'];
                    }
                    else if($data['social'] == 'Waze') {
                        $waze = $data['total'];
                    }
                    else if($data['social'] == 'TikTok') {
                        $tiktok = $data['total'];
                    }
                    else if($data['social'] == 'Spotify') {
                        $spotify = $data['total'];
                    }

                    $mes = array_pop($datos);
                    $facebook += $mes['face'];
                    $instagram += $mes['insta'];
                    $google += $mes['goog'];
                    $linkedin += $mes['link'];
                    $waze += $mes['waze'];
                    $tiktok += $mes['tik'];
                    $spotify += $mes['spoti'];

                    $datos[] = array("mes"=>$data['mes'], "face"=>$facebook, "insta"=>$instagram, "goog"=>$google, "link"=>$linkedin, "waze"=>$waze, "tik"=>$tiktok, "spoti"=>$spotify);
                }
            }
        ?>

        <?php
			foreach ($datos as $key => $value) {
		?>

        ['<?php echo $value['mes']; ?>', <?php echo $value['face']; ?>, <?php echo $value['insta']; ?>,
            <?php echo $value['goog']; ?>, <?php echo $value['link']; ?>, <?php echo $value['waze']; ?>,
            <?php echo $value['tik']; ?>, <?php echo $value['spoti']; ?>],

        <?php
			}		
		?>
    ]);

    var options = {
        selectionMode: 'multiple',
        title: 'Histórico de leads por mes',
        subtitle: 'Se actualiza cada fin de mes',
        animation: {
            duration: 1500,
            startup: true
        },
        // curveType: 'function',
        width: '100%',
        height: '100%',
        chartArea: {
            'backgroundColor': {
                'fill': '#fdfeff',
                'opacity': 100
            },
            left: 50,
            right: 10,
            top: 30,
            bottom: 70,
            width: "100%",
            height: "50%"
        },
        colors: ['#1877f2', '#d6249f', '#0F9D58', '#0073b1', '#33ccff', '#EE1D52', '#1ED760'],
        fontName: 'Roboto',
        fontSize: '14',
        legend: {
            position: 'bottom',
            pagingTextStyle: {
                fontSize: 18
            }
        }
    };
    var chart = new google.visualization.LineChart(document.getElementById('line_chart'));

    google.visualization.events.addListener(chart, 'error', function(googleError) {
        google.visualization.errors.removeError(googleError.id);
        document.getElementById("error_msg").innerHTML = "No se encotraron datos para graficar.";
        document.getElementById('error_msg').classList.add('alert', 'alert-danger', 'text-center');
    });

    // var chart = new google.charts.Line(document.getElementById('line_chart'));

    chart.draw(data, options);
    // chart.draw(data, google.charts.Line.convertOptions(options));

    function resizeHandler() {
        chart.draw(data, options);
    }
    if (window.addEventListener) {
        window.addEventListener('resize', resizeHandler, false);
    } else if (window.attachEvent) {
        window.attachEvent('onresize', resizeHandler);
    }
}
</script>


<script type="text/javascript">
// google.charts.load('current', {'packages': ['line']});
google.charts.load('current', {
    'packages': ['corechart']
});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {
    var data = google.visualization.arrayToDataTable([
        ['Meses', 'Facebook', 'Instagram', 'Google', 'LinkedIn', 'Waze', 'TikTok', 'Spotify'],
        <?php 
            $company_int = $_GET['company'];
            // $query_int = "SELECT mes_actual AS mes, red_social AS social, SUM(interacciones) AS total FROM campana_redes WHERE campana_empresa = '".$company_int."' GROUP BY social, mes ORDER BY 'Septiembre'" ;
            $query_int = "SELECT mes_actual AS mes, YEAR(fecha_inicio) AS anio, red_social AS social, SUM(interacciones) AS total FROM campana_redes WHERE campana_empresa = '".$company_int."' AND YEAR(fecha_inicio) <= YEAR(CURDATE()) GROUP BY social, mes ORDER BY MONTH(fecha_inicio) ASC, mes ASC" ;
            
            $meses_int = "";
            $resultado_int = mysqli_query($conexion, $query_int);
            while($data_int = mysqli_fetch_array($resultado_int)) {
                $facebook_int = 0;
                $instagram_int = 0;
                $google_int = 0;
                $linkedin_int = 0;
                $waze_int = 0;
                $tiktok_int = 0;
                $spotify_int = 0;

                if($meses_int != $data_int['mes']) {
                    $meses_int = $data_int['mes'];
                    if($data_int['social'] == 'Facebook') { 
                        $facebook_int = $data_int['total'];
                    }
                    else if($data_int['social'] == 'Instagram') {
                        $instagram_int = $data_int['total'];
                    }
                    else if($data_int['social'] == 'Google') {
                        $google_int = $data_int['total'];
                    }
                    else if($data_int['social'] == 'LinkedIn') {
                        $linkedin_int = $data_int['total'];
                    }
                    else if($data_int['social'] == 'Waze') {
                        $waze_int = $data_int['total'];
                    }
                    else if($data_int['social'] == 'TikTok') {
                        $tiktok_int = $data_int['total'];
                    }
                    else if($data_int['social'] == 'Spotify') {
                        $spotify_int = $data_int['total'];
                    }
                    $datos_int[] = array("mes"=>$data_int['mes'], "face"=>$facebook_int, "insta"=>$instagram_int, "goog"=>$google_int, "link"=>$linkedin_int, "waze"=>$waze_int, "tik"=>$tiktok_int, "spoti"=>$spotify_int);
                } 
                else {
                    $meses_int = $data_int['mes'];   
                    if($data_int['social'] == 'Facebook') {
                        $facebook_int = $data_int['total'];
                    }
                    else if($data_int['social'] == 'Instagram') {
                        $instagram_int = $data_int['total'];
                    }
                    else if($data_int['social'] == 'Google') {
                        $google_int = $data_int['total'];
                    }
                    else if($data_int['social'] == 'LinkedIn') {
                        $linkedin_int = $data_int['total'];
                    }
                    else if($data_int['social'] == 'Waze') {
                        $waze_int = $data_int['total'];
                    }
                    else if($data_int['social'] == 'TikTok') {
                        $tiktok_int = $data_int['total'];
                    }
                    else if($data_int['social'] == 'Spotify') {
                        $spotify_int = $data_int['total'];
                    }

                    $mes_int = array_pop($datos_int);
                    $facebook_int += $mes_int['face'];
                    $instagram_int += $mes_int['insta'];
                    $google_int += $mes_int['goog'];
                    $linkedin_int += $mes_int['link'];
                    $waze_int += $mes_int['waze'];
                    $tiktok_int += $mes_int['tik'];
                    $spotify_int += $mes_int['spoti'];

                    $datos_int[] = array("mes"=>$data_int['mes'], "face"=>$facebook_int, "insta"=>$instagram_int, "goog"=>$google_int, "link"=>$linkedin_int, "waze"=>$waze_int, "tik"=>$tiktok_int, "spoti"=>$spotify_int);
                }
            }
            ?>
        <?php
            foreach ($datos_int as $key_int => $value_int) {
        ?>['<?php echo $value_int['mes']; ?>', <?php echo $value_int['face']; ?>, <?php echo $value_int['insta']; ?>,
            <?php echo $value_int['goog']; ?>, <?php echo $value_int['link']; ?>,
            <?php echo $value_int['waze']; ?>, <?php echo $value_int['tik']; ?>,
            <?php echo $value_int['spoti']; ?>],
        <?php
            }		
        ?>
    ]);

    var options = {
        selectionMode: 'multiple',
        title: 'Histórico de interacciones por mes',
        subtitle: 'Se actualiza cada fin de mes',
        animation: {
            duration: 1500,
            startup: true
        },
        // curveType: 'function',
        width: '100%',
        height: '100%',
        chartArea: {
            'backgroundColor': {
                'fill': '#fdfeff',
                'opacity': 100
            },
            left: 50,
            right: 10,
            top: 30,
            bottom: 70,
            width: "100%",
            height: "50%"
        },
        colors: ['#1877f2', '#d6249f', '#0F9D58', '#0073b1', '#33ccff', '#EE1D52', '#1ED760'],
        fontName: 'Roboto',
        fontSize: '14',
        legend: {
            position: 'bottom',
            pagingTextStyle: {
                fontSize: 18
            }
        }
    };
    var chart = new google.visualization.LineChart(document.getElementById('line_chart-2'));

    google.visualization.events.addListener(chart, 'error', function(googleError) {
        google.visualization.errors.removeError(googleError.id);
        document.getElementById("error_msg-2").innerHTML = "Nose encotraron datos para graficar.";
        document.getElementById('error_msg-2').classList.add('alert', 'alert-danger', 'text-center');
    });
    // var chart = new google.charts.Line(document.getElementById('line_chart'));
    chart.draw(data, options);
    // chart.draw(data, google.charts.Line.convertOptions(options));

    function resizeHandler() {
        chart.draw(data, options);
    }
    if (window.addEventListener) {
        window.addEventListener('resize', resizeHandler, false);
    } else if (window.attachEvent) {
        window.attachEvent('onresize', resizeHandler);
    }
}
</script>
<script type="text/javascript">
// google.charts.load('current', {'packages': ['line']});
google.charts.load('current', {
    'packages': ['corechart']
});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {
    var data = google.visualization.arrayToDataTable([
        ['Meses', 'Facebook', 'Instagram', 'Google', 'LinkedIn', 'Waze', 'TikTok', 'Spotify'],
        <?php 
            $company_alc = $_GET['company'];
            // $query_alc = "SELECT mes_actual AS mes, red_social AS social, SUM(alcance) AS total FROM campana_redes WHERE campana_empresa = '".$company_alc."' GROUP BY social, mes ORDER BY 'Septiembre'" ;
            $query_alc = "SELECT mes_actual AS mes, YEAR(fecha_inicio) AS anio, red_social AS social, SUM(alcance) AS total FROM campana_redes WHERE campana_empresa = '".$company_alc."' AND YEAR(fecha_inicio) <= YEAR(CURDATE()) GROUP BY social, mes ORDER BY MONTH(fecha_inicio) ASC, mes ASC" ;

            $meses_alc = "";
            $resultado_alc = mysqli_query($conexion, $query_alc);
            while($data_alc = mysqli_fetch_array($resultado_alc)) {
                $facebook_alc = 0;
                $instagram_alc = 0;
                $google_alc = 0;
                $linkedin_alc = 0;
                $waze_alc = 0;
                $tiktok_alc = 0;
                $spotify_alc = 0;

                if($meses_alc != $data_alc['mes']) {
                    $meses_alc = $data_alc['mes'];
                    if($data_alc['social'] == 'Facebook') { 
                        $facebook_alc = $data_alc['total'];
                    }
                    else if($data_alc['social'] == 'Instagram') {
                        $instagram_alc = $data_alc['total'];
                    }
                    else if($data_alc['social'] == 'Google') {
                        $google_alc = $data_alc['total'];
                    }
                    else if($data_alc['social'] == 'LinkedIn') {
                        $linkedin_alc = $data_alc['total'];
                    }
                    else if($data_alc['social'] == 'Waze') {
                        $waze_alc = $data_alc['total'];
                    }
                    else if($data_alc['social'] == 'TikTok') {
                        $tiktok_alc = $data_alc['total'];
                    }
                    else if($data_alc['social'] == 'Spotify') {
                        $spotify_alc = $data_alc['total'];
                    }
                    $datos_alc[] = array("mes"=>$data_alc['mes'], "face"=>$facebook_alc, "insta"=>$instagram_alc, "goog"=>$google_alc, "link"=>$linkedin_alc, "waze"=>$waze_alc, "tik"=>$tiktok_alc, "spoti"=>$spotify_alc);
                } 
                else {
                    $meses_alc = $data_alc['mes'];   
                    if($data_alc['social'] == 'Facebook') { 
                        $facebook_alc = $data_alc['total'];
                    }
                    else if($data_alc['social'] == 'Instagram') {
                        $instagram_alc = $data_alc['total'];
                    }
                    else if($data_alc['social'] == 'Google') {
                        $google_alc = $data_alc['total'];
                    }
                    else if($data_alc['social'] == 'LinkedIn') {
                        $linkedin_alc = $data_alc['total'];
                    }
                    else if($data_alc['social'] == 'Waze') {
                        $waze_alc = $data_alc['total'];
                    }
                    else if($data_alc['social'] == 'TikTok') {
                        $tiktok_alc = $data_alc['total'];
                    }
                    else if($data_alc['social'] == 'Spotify') {
                        $spotify_alc = $data_alc['total'];
                    }

                    $mes_alc = array_pop($datos_alc);
                    $facebook_alc += $mes_alc['face'];
                    $instagram_alc += $mes_alc['insta'];
                    $google_alc += $mes_alc['goog'];
                    $linkedin_alc += $mes_alc['link'];
                    $waze_alc += $mes_alc['waze'];
                    $tiktok_alc += $mes_alc['tik'];
                    $spotify_alc += $mes_alc['spoti'];

                    $datos_alc[] = array("mes"=>$data_alc['mes'], "face"=>$facebook_alc, "insta"=>$instagram_alc, "goog"=>$google_alc, "link"=>$linkedin_alc, "waze"=>$waze_alc, "tik"=>$tiktok_alc, "spoti"=>$spotify_alc);
                }
            }
            ?>
        <?php
            foreach ($datos_alc as $key_alc => $value_alc) {
        ?>['<?php echo $value_alc['mes']; ?>', <?php echo $value_alc['face']; ?>, <?php echo $value_alc['insta']; ?>,
            <?php echo $value_alc['goog']; ?>, <?php echo $value_alc['link']; ?>,
            <?php echo $value_alc['waze']; ?>, <?php echo $value_alc['tik']; ?>,
            <?php echo $value_alc['spoti']; ?>],
        <?php
            }		
        ?>
    ]);

    var options = {
        selectionMode: 'multiple',
        title: 'Histórico del alcance por mes',
        subtitle: 'Se actualiza cada fin de mes',
        animation: {
            duration: 1500,
            startup: true
        },
        // curveType: 'function',
        width: '100%',
        height: '100%',
        chartArea: {
            'backgroundColor': {
                'fill': '#fdfeff',
                'opacity': 100
            },
            left: 50,
            right: 10,
            top: 30,
            bottom: 70,
            width: "100%",
            height: "50%"
        },
        colors: ['#1877f2', '#d6249f', '#0F9D58', '#0073b1', '#33ccff', '#EE1D52', '#1ED760'],
        fontName: 'Roboto',
        fontSize: '14',
        legend: {
            position: 'bottom',
            pagingTextStyle: {
                fontSize: 18
            }
        }
    };
    var chart = new google.visualization.LineChart(document.getElementById('line_chart-3'));

    google.visualization.events.addListener(chart, 'error', function(googleError) {
        google.visualization.errors.removeError(googleError.id);
        document.getElementById("error_msg-3").innerHTML = "Nose encotraron datos para graficar.";
        document.getElementById('error_msg-3').classList.add('alert', 'alert-danger', 'text-center');
    });
    // var chart = new google.charts.Line(document.getElementById('line_chart'));
    chart.draw(data, options);
    // chart.draw(data, google.charts.Line.convertOptions(options));

    function resizeHandler() {
        chart.draw(data, options);
    }
    if (window.addEventListener) {
        window.addEventListener('resize', resizeHandler, false);
    } else if (window.attachEvent) {
        window.attachEvent('onresize', resizeHandler);
    }
}
</script>
<script type="text/javascript">
// google.charts.load('current', {'packages': ['line']});
google.charts.load('current', {
    'packages': ['corechart']
});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {
    var data = google.visualization.arrayToDataTable([
        ['Meses', 'Facebook', 'Instagram', 'Google', 'LinkedIn', 'Waze', 'TikTok', 'Spotify'],
        <?php 
            $company_con = $_GET['company'];
            // $query_con = "SELECT mes_actual AS mes, red_social AS social, SUM(conversiones) AS total FROM campana_redes WHERE campana_empresa = '".$company_con."' GROUP BY social, mes ORDER BY 'Septiembre'" ;
            $query_con = "SELECT mes_actual AS mes, YEAR(fecha_inicio) AS anio, red_social AS social, SUM(conversiones) AS total FROM campana_redes WHERE campana_empresa = '".$company_con."' AND YEAR(fecha_inicio) <= YEAR(CURDATE()) GROUP BY social, mes ORDER BY MONTH(fecha_inicio) ASC, mes ASC" ;

            $meses_con = "";
            $resultado_con = mysqli_query($conexion, $query_con);
            while($data_con = mysqli_fetch_array($resultado_con)) {
                $facebook_con = 0;
                $instagram_con = 0;
                $google_con = 0;
                $linkedin_con = 0;
                $waze_con = 0;
                $tiktok_con = 0;
                $spotify_con = 0;

                if($meses_con != $data_con['mes']) {
                    $meses_con = $data_con['mes'];
                    if($data_con['social'] == 'Facebook') { 
                        $facebook_con = $data_con['total'];
                    }
                    else if($data_con['social'] == 'Instagram') {
                        $instagram_con = $data_con['total'];
                    }
                    else if($data_con['social'] == 'Google') {
                        $google_con = $data_con['total'];
                    }
                    else if($data_con['social'] == 'LinkedIn') {
                        $linkedin_con = $data_con['total'];
                    }
                    else if($data_con['social'] == 'Waze') {
                        $waze_con = $data_con['total'];
                    }
                    else if($data_con['social'] == 'TikTok') {
                        $tiktok_con = $data_con['total'];
                    }
                    else if($data_con['social'] == 'Spotify') {
                        $spotify_con = $data_con['total'];
                    }
                    $datos_con[] = array("mes"=>$data_con['mes'], "face"=>$facebook_con, "insta"=>$instagram_con, "goog"=>$google_con, "link"=>$linkedin_con, "waze"=>$waze_con, "tik"=>$tiktok_con, "spoti"=>$spotify_con);
                } 
                else {
                    $meses_con = $data_con['mes'];   
                    if($data_con['social'] == 'Facebook') {
                        $facebook_con= $data_con['total'];
                    }
                    else if($data_con['social'] == 'Instagram') {
                        $instagram_con = $data_con['total'];
                    }
                    else if($data_con['social'] == 'Google') {
                        $google_con = $data_con['total'];
                    }
                    else if($data_con['social'] == 'LinkedIn') {
                        $linkedin_con = $data_con['total'];
                    }
                    else if($data_con['social'] == 'Waze') {
                        $waze_con = $data_con['total'];
                    }
                    else if($data_con['social'] == 'TikTok') {
                        $tiktok_con = $data_con['total'];
                    }
                    else if($data_con['social'] == 'Spotify') {
                        $spotify_con = $data_con['total'];
                    }

                    $mes_con = array_pop($datos_con);
                    $facebook_con += $mes_con['face'];
                    $instagram_con += $mes_con['insta'];
                    $google_con += $mes_con['goog'];
                    $linkedin_con += $mes_con['link'];
                    $waze_con += $mes_con['waze'];
                    $tiktok_con += $mes_con['tik'];
                    $spotify_con += $mes_con['spoti'];

                    $datos_con[] = array("mes"=>$data_con['mes'], "face"=>$facebook_con, "insta"=>$instagram_con, "goog"=>$google_con, "link"=>$linkedin_con, "waze"=>$waze_con, "tik"=>$tiktok_con, "spoti"=>$spotify_con);
                }
            }
            ?>
        <?php
            foreach ($datos_con as $key_con => $value_con) {
        ?>['<?php echo $value_con['mes']; ?>', <?php echo $value_con['face']; ?>, <?php echo $value_con['insta']; ?>,
            <?php echo $value_con['goog']; ?>, <?php echo $value_con['link']; ?>,
            <?php echo $value_con['waze']; ?>, <?php echo $value_con['tik']; ?>,
            <?php echo $value_con['spoti']; ?>],
        <?php
            }		
        ?>
    ]);

    var options = {
        selectionMode: 'multiple',
        title: 'Histórico de clics por mes',
        subtitle: 'Se actualiza cada fin de mes',
        animation: {
            duration: 1500,
            easing: 'linear',
            startup: true
        },
        // curveType: 'function',
        width: '100%',
        height: '100%',
        chartArea: {
            'backgroundColor': {
                'fill': '#fdfeff',
                'opacity': 100
            },
            left: 50,
            right: 10,
            top: 30,
            bottom: 70,
            width: "100%",
            height: "50%"
        },
        colors: ['#1877f2', '#d6249f', '#0F9D58', '#0073b1', '#33ccff', '#EE1D52', '#1ED760'],
        fontName: 'Roboto',
        fontSize: '14',
        legend: {
            position: 'bottom',
            pagingTextStyle: {
                fontSize: 18
            }
        }
    };
    var chart = new google.visualization.LineChart(document.getElementById('line_chart-4'));

    google.visualization.events.addListener(chart, 'error', function(googleError) {
        google.visualization.errors.removeError(googleError.id);
        document.getElementById("error_msg-4").innerHTML = "Nose encotraron datos para graficar.";
        document.getElementById('error_msg-4').classList.add('alert', 'alert-danger', 'text-center');
    });
    // var chart = new google.charts.Line(document.getElementById('line_chart'));
    chart.draw(data, options);
    // chart.draw(data, google.charts.Line.convertOptions(options));

    function resizeHandler() {
        chart.draw(data, options);
    }
    if (window.addEventListener) {
        window.addEventListener('resize', resizeHandler, false);
    } else if (window.attachEvent) {
        window.attachEvent('onresize', resizeHandler);
    }
}
</script>

<script type="text/javascript">
// google.charts.load('current', {'packages': ['line']});
// google.charts.load('current', {'packages': ['bar']});
google.charts.load('current', {
    'packages': ['corechart']
});


google.charts.setOnLoadCallback(drawChart);


function drawChart() {
    var data = google.visualization.arrayToDataTable([
        ['Meses', 'Facebook', 'Instagram', 'Twitter', 'Youtube', 'Linkedin', 'Spotify'],
        <?php 
            $company = $_GET['company'];
            // $query_pie = "SELECT mes_comunidad AS mes, SUM(datos_facebook) AS total_face, SUM(datos_intagram) AS total_insta,  SUM(datos_twitter) AS total_twitter, SUM(datos_youtube) AS total_youtube, SUM(datos_linkedin) AS total_linkedin, SUM(datos_spotify) AS total_spotify FROM comunidad WHERE nom_empresa_comu = '".$company."' GROUP BY mes ORDER BY 'Septiembre'" ;
            $query_pie = "SELECT mes_comunidad AS mes, YEAR(creacion_cumu) AS anio, SUM(datos_facebook) AS total_face, SUM(datos_intagram) AS total_insta,  SUM(datos_twitter) AS total_twitter, SUM(datos_youtube) AS total_youtube, SUM(datos_linkedin) AS total_linkedin, SUM(datos_spotify) AS total_spotify FROM comunidad WHERE nom_empresa_comu = '".$company."' AND YEAR(creacion_cumu) <= YEAR(CURDATE()) GROUP BY mes ORDER BY MONTH(creacion_cumu) ASC, mes ASC" ;

            $resultado_pie = mysqli_query($conexion, $query_pie);
            while($data_pie = mysqli_fetch_array($resultado_pie)) {
                $mes_pie = $data_pie['mes'];
                $face_pie = $data_pie['total_face'];
                $insta_pie = $data_pie['total_insta'];
                $twitter_pie = $data_pie['total_twitter'];
                $youtube_pie = $data_pie['total_youtube'];
                $linkedin_pie = $data_pie['total_linkedin'];
                $spotify_pie = $data_pie['total_spotify'];
        ?>

        ['<?php echo $mes_pie; ?>', <?php echo $face_pie; ?>, <?php echo $insta_pie; ?>,
            <?php echo $twitter_pie; ?>, <?php echo $youtube_pie; ?>, <?php echo $linkedin_pie ?>,
            <?php echo $spotify_pie; ?>],

        <?php 
            }
        ?>
    ]);

    // var options = {
    //     chartArea: {
    //         left: 80,
    //         right: 20,
    //         top: 40,
    //         bottom: 40,
    //         width: "100%",
    //         height: "100%"
    //     },
    //     title: 'Histórico de seguidores',
    //     // subtitle: 'Se actualiza cada fin de mes',          
    //     vAxis: {
    //         title: 'Seguidores'
    //     },
    //     hAxis: {
    //         title: 'Meses'
    //     },
    //     seriesType: 'bars',
    //     colors: ['#1877f2', '#d6249f', '#55acee', '#cd201f', '#0077B5', '#1DB954'],
    //     fontName: 'Roboto',
    //     fontSize: '14',
    //     bar: {
    //         groupWidth: "100%"
    //     },
    //     legend: {
    //         position: 'top'
    //     },
    //     animation: {
    //         duration: 1500,
    //         easing: 'linear',
    //         startup: true
    //     }
    // };
    var options = {
        selectionMode: 'multiple',
        chartArea: {
            'backgroundColor': {
                'fill': '#fdfeff',
                'opacity': 100
            },
            left: 80,
            right: 20,
            top: 40,
            bottom: 40,
            width: "100%",
            height: "100%"
        },
        title: 'Histórico de seguidores',
        vAxis: {
            title: 'Seguidores'
        },
        hAxis: {
            title: 'Meses'
        },
        colors: ['#1877f2', '#d6249f', '#55acee', '#cd201f', '#0077B5', '#1DB954'],
        fontName: 'Roboto',
        fontSize: '14',
        legend: {
            position: 'top',
            pagingTextStyle: {
                fontSize: 18
            }
        },
        animation: {
            duration: 1500,
            easing: 'linear',
            startup: true
        }
    };

    // var chart = new google.charts.Bar(document.getElementById('line_chart-5'));
    // chart.draw(data, google.charts.Bar.convertOptions(options));

    var chart = new google.visualization.AreaChart(document.getElementById('line_chart-5'));

    google.visualization.events.addListener(chart, 'error', function(googleError) {
        google.visualization.errors.removeError(googleError.id);
        document.getElementById("error_msg-5").innerHTML = "Nose encotraron datos para graficar.";
        document.getElementById('error_msg-5').classList.add('alert', 'alert-danger', 'text-center');
    });

    chart.draw(data, options);


    function resizeHandler() {
        // chart.draw(data, google.charts.Bar.convertOptions(options));
        chart.draw(data, options);

    }
    if (window.addEventListener) {
        window.addEventListener('resize', resizeHandler, false);
    } else if (window.attachEvent) {
        window.attachEvent('onresize', resizeHandler);
    }
}
</script>

<script type="text/javascript">
// google.charts.load('current', {'packages': ['line']});
google.charts.load('current', {
    'packages': ['corechart']
});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {
    var data = google.visualization.arrayToDataTable([
        ['Meses', 'Facebook', 'Instagram', 'Google', 'LinkedIn', 'Waze', 'TikTok', 'Spotify'],
        <?php 
            $company_c_m_c = $_GET['company'];
            // $query = "SELECT mes_actual AS mes, red_social AS social, SUM(leads) AS total FROM campana_redes WHERE campana_empresa = '".$company."' GROUP BY social, mes ORDER BY 'Septiembre'" ;
            // $query_c_m_c = "SELECT mes_actual AS mes, YEAR(fecha_inicio) AS anio, red_social AS social, SUM(conversiones) AS total FROM `campana_redes` WHERE campana_empresa = '".$company_c_m_c."' AND YEAR(fecha_inicio) = YEAR(CURDATE()) GROUP BY social, mes ORDER BY MONTH(fecha_inicio) ASC, mes ASC" ;
            $query_c_m_c = "SELECT mes_actual AS mes, YEAR(fecha_inicio) AS anio, red_social AS social, SUM(presu_gastado) / SUM(conversiones) AS total FROM campana_redes WHERE campana_empresa = '".$company_c_m_c."' AND YEAR(fecha_inicio) <= YEAR(CURDATE()) GROUP BY social, mes ORDER BY MONTH(fecha_inicio) ASC, mes ASC" ;

            $meses_c_m_c = "";
            $resultado_c_m_c = mysqli_query($conexion, $query_c_m_c);
            while($data_c_m_c = mysqli_fetch_array($resultado_c_m_c)) {
                $facebook_c_m_c = 0;
                $instagram_c_m_c = 0;
                $google_c_m_c = 0;
                $linkedin_c_m_c = 0;
                $waze_c_m_c = 0;
                $tiktok_c_m_c = 0;
                $spotify_c_m_c = 0;

                if($meses_c_m_c != $data_c_m_c['mes']) {
                    $meses_c_m_c = $data_c_m_c['mes'];
                    if($data_c_m_c['social'] == 'Facebook') { 
                        $facebook_c_m_c = number_format($data_c_m_c['total'], 2);
                    }
                    else if($data_c_m_c['social'] == 'Instagram') {
                        $instagram_c_m_c = number_format($data_c_m_c['total'], 2);
                    }
                    else if($data_c_m_c['social'] == 'Google') {
                        $google_c_m_c = number_format($data_c_m_c['total'], 2);
                    }
                    else if($data_c_m_c['social'] == 'LinkedIn') {
                        $linkedin_c_m_c = number_format($data_c_m_c['total'], 2);
                    }
                    else if($data_c_m_c['social'] == 'Waze') {
                        $waze_c_m_c = number_format($data_c_m_c['total'], 2);
                    }
                    else if($data_c_m_c['social'] == 'TikTok') {
                        $tiktok_c_m_c = number_format($data_c_m_c['total'], 2);
                    }
                    else if($data_c_m_c['social'] == 'Spotify') {
                        $spotify_c_m_c = number_format($data_c_m_c['total'], 2);
                    }

                    $datos_c_m_c[] = array("mes"=>$data_c_m_c['mes'], "face"=>$facebook_c_m_c, "insta"=>$instagram_c_m_c, "goog"=>$google_c_m_c, "link"=>$linkedin_c_m_c, "waze"=>$waze_c_m_c, "tik"=>$tiktok_c_m_c, "spoti"=>$spotify_c_m_c);
                } 
                else {
                    $meses_c_m_c = $data_c_m_c['mes'];   
                    if($data_c_m_c['social'] == 'Facebook') { 
                        $facebook_c_m_c = number_format($data_c_m_c['total'], 2);
                    }
                    else if($data_c_m_c['social'] == 'Instagram') {
                        $instagram_c_m_c = number_format($data_c_m_c['total'], 2);
                    }
                    else if($data_c_m_c['social'] == 'Google') {
                        $google_c_m_c = number_format($data_c_m_c['total'], 2);
                    }
                    else if($data_c_m_c['social'] == 'LinkedIn') {
                        $linkedin_c_m_c = number_format($data_c_m_c['total'], 2);
                    }
                    else if($data_c_m_c['social'] == 'Waze') {
                        $waze_c_m_c = number_format($data_c_m_c['total'], 2);
                    }
                    else if($data_c_m_c['social'] == 'TikTok') {
                        $tiktok_c_m_c = number_format($data_c_m_c['total'], 2);
                    }
                    else if($data_c_m_c['social'] == 'Spotify') {
                        $spotify_c_m_c = number_format($data_c_m_c['total'], 2);
                    }

                    $mes_c_m_c = array_pop($datos_c_m_c);
                    $facebook_c_m_c += $mes_c_m_c['face'];
                    $instagram_c_m_c += $mes_c_m_c['insta'];
                    $google_c_m_c += $mes_c_m_c['goog'];
                    $linkedin_c_m_c += $mes_c_m_c['link'];
                    $waze_c_m_c += $mes_c_m_c['waze'];
                    $tiktok_c_m_c += $mes_c_m_c['tik'];
                    $spotify_c_m_c += $mes_c_m_c['spoti'];

                    $datos_c_m_c[] = array("mes"=>$data_c_m_c['mes'], "face"=>$facebook_c_m_c, "insta"=>$instagram_c_m_c, "goog"=>$google_c_m_c, "link"=>$linkedin_c_m_c, "waze"=>$waze_c_m_c, "tik"=>$tiktok_c_m_c, "spoti"=>$spotify_c_m_c);
                }
            }
        ?>

        <?php
			foreach ($datos_c_m_c as $key_c_m_c => $value_c_m_c) {
		?>['<?php echo $value_c_m_c['mes']; ?>', <?php echo $value_c_m_c['face']; ?>, <?php echo $value_c_m_c['insta']; ?>,
            <?php echo $value_c_m_c['goog']; ?>, <?php echo $value_c_m_c['link']; ?>,
            <?php echo $value_c_m_c['waze']; ?>, <?php echo $value_c_m_c['tik']; ?>,
            <?php echo $value_c_m_c['spoti']; ?>],
        <?php
			}		
		?>
    ]);

    var options = {
        selectionMode: 'multiple',
        title: 'Costo medio por clics',
        subtitle: 'Se actualiza cada fin de mes',
        animation: {
            duration: 1500,
            startup: true
        },
        // curveType: 'function',
        width: '100%',
        height: '100%',
        chartArea: {
            'backgroundColor': {
                'fill': '#fdfeff',
                'opacity': 100
            },
            left: 50,
            right: 10,
            top: 30,
            bottom: 70,
            width: "100%",
            height: "50%"
        },
        colors: ['#1877f2', '#d6249f', '#0F9D58', '#0073b1', '#33ccff', '#EE1D52', '#1ED760'],
        fontName: 'Roboto',
        fontSize: '14',
        legend: {
            position: 'bottom',
            pagingTextStyle: {
                fontSize: 18
            }
        }
    };
    var chart = new google.visualization.LineChart(document.getElementById('line_chart-6'));

    google.visualization.events.addListener(chart, 'error', function(googleError) {
        google.visualization.errors.removeError(googleError.id);
        document.getElementById("error_msg-6").innerHTML = "Nose encotraron datos para graficar.";
        document.getElementById('error_msg-6').classList.add('alert', 'alert-danger', 'text-center');
    });

    // var chart = new google.charts.Line(document.getElementById('line_chart'));
    chart.draw(data, options);
    // chart.draw(data, google.charts.Line.convertOptions(options));

    function resizeHandler() {
        chart.draw(data, options);
    }
    if (window.addEventListener) {
        window.addEventListener('resize', resizeHandler, false);
    } else if (window.attachEvent) {
        window.attachEvent('onresize', resizeHandler);
    }
}
</script>

<script type="text/javascript">
google.charts.load('current', {
    packages:['corechart']
});


google.charts.setOnLoadCallback(drawChart);

function drawChart() {
    var data = google.visualization.arrayToDataTable([
        ['Fecha', 'Facebook', 'Instagram', 'Google', 'LinkedIn', 'Waze', 'TikTok', 'Spotify'],

        <?php
            setlocale(LC_ALL,"es_ES");
            $company_gasto = $_GET['company'];
            $month_gasto = $_GET['month'];
            $year_gasto = $_GET['year'];

            $conexion->query("SET lc_time_names = 'es_ES'");	
            $query_gasto = "SELECT * FROM presupuesto_gastado WHERE empresa_gasto = '".$company_gasto."' AND DATE_FORMAT(dia_gasto, '%M') = '".$month_gasto."' AND YEAR(dia_gasto) = '".$year_gasto."' ORDER BY DATE_FORMAT(dia_gasto, '%M') ASC";
            $resGasto=mysqli_query($conexion,$query_gasto);

            while($data=mysqli_fetch_array($resGasto)) {
                $dias = date("j-M-Y", strtotime($data['dia_gasto']));
                $faceGasto = $data['facebook_gasto'];
                $instaGasto = $data['instagram_gasto'];
                $googGasto = $data['google_gasto'];
                $linkGasto = $data['linkedin_gasto'];
                $wazeGasto = $data['waze_gasto'];
                $tiktokGasto = $data['tiktok_gasto'];
                $spotifyGasto = $data['spotify_gasto'];

        ?>
                
                ['<?php echo $dias;?>', <?php echo $faceGasto;?>, <?php echo $instaGasto;?>,
                <?php echo $googGasto;?>, <? echo $linkGasto;?>, <? echo $wazeGasto;?>, 
                <?echo $tiktokGasto;?>, <? echo $spotifyGasto; ?> ],
        <?php      
            }
        ?>

    ]);

    var options = {
        selectionMode: 'multiple',
        title: 'Gasto diario por canal',
        subtitle: 'Se actualiza cada fin de mes',
        animation: {
            duration: 1500,
            easing: 'linear',
            startup: true
        },
        width: '100%',
        height: '100%',
        chartArea: {
            'backgroundColor': {
                'fill': '#fdfeff',
                'opacity': 100
            },
            bottom: 60,
            left: 60,
            right: 20,
            top: '20%',
            width: '100%',
            height: '75%'
        },
        colors: ['#1877f2', '#d6249f', '#0F9D58', '#0073b1', '#33ccff', '#EE1D52', '#1ED760'],
        fontName: 'Roboto',
        fontSize: '14',
        legend: {
            position: 'top',
            maxLines: 1,
            alignment: 'end',
            pagingTextStyle: {
                fontSize: 18
            }
        },
        hAxis: {
            slantedText: true,
            format: 'dd/MM/yyyy'
        }
    };

    var chart = new google.visualization.LineChart(document.getElementById('line_chart-7'));

    google.visualization.events.addListener(chart, 'error', function(googleError) {
        google.visualization.errors.removeError(googleError.id);
        document.getElementById("error_msg-7").innerHTML = "Nose encotraron datos para graficar.";
        document.getElementById('error_msg-7').classList.add('alert', 'alert-danger', 'text-center');
    });

    chart.draw(data, options);


    function resizeHandler() {
        // chart.draw(data, google.charts.Bar.convertOptions(options));
        chart.draw(data, options);

    }
    if (window.addEventListener) {
        window.addEventListener('resize', resizeHandler, false);
    } else if (window.attachEvent) {
        window.attachEvent('onresize', resizeHandler);
    }
}
</script>

<script type="text/javascript">
// google.charts.load('current', {'packages': ['line']});
google.charts.load('current', {
    'packages': ['corechart']
});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {
    var data = google.visualization.arrayToDataTable([
        ['Meses', 'Facebook', 'Instagram', 'Google', 'LinkedIn', 'Waze', 'TikTok'],
        <?php 
            $company = $_GET['company'];
            // $query = "SELECT mes_actual AS mes, red_social AS social, SUM(leads) AS total FROM campana_redes WHERE campana_empresa = '".$company."' GROUP BY social, mes ORDER BY 'Septiembre'" ;
           // $query = "SELECT mes_actual AS mes, YEAR(fecha_inicio) AS anio, red_social AS social, SUM(llamadas) AS total FROM campana_redes WHERE campana_empresa = '".$company."' AND YEAR(fecha_inicio) <= YEAR(CURDATE()) GROUP BY social, mes ORDER BY MONTH(fecha_inicio) ASC, mes ASC" ;
            //$query = "SELECT mes_actual AS mes, YEAR(fecha_inicio) AS anio, red_social AS social, SUM(llamadas) AS total FROM campana_redes WHERE campana_empresa = '".$company."' AND YEAR(fecha_inicio) <= YEAR(CURDATE()) GROUP BY social, mes ORDER BY MONTH(fecha_inicio) DESC, mes DESC" ;
            $query = "SELECT mes_actual AS mes, YEAR(fecha_inicio) AS anio, red_social AS social, SUM(llamadas) AS total FROM campana_redes WHERE campana_empresa = '".$company."' AND YEAR(fecha_inicio) <= YEAR(CURDATE()) GROUP BY social, mes ORDER BY mes DESC, YEAR(fecha_inicio) DESC" ;
            $meses = "";
            $resultado = mysqli_query($conexion, $query);
            while($data = mysqli_fetch_array($resultado)) {
                $facebook = 0;
                $instagram = 0;
                $google = 0;
                $linkedin = 0;
                $waze = 0;
                $tiktok = 0;
                $spotify = 0;

                if($meses != $data['mes']) {
                    $meses = $data['mes'];
                    if($data['social'] == 'Facebook') { 
                        $facebook = $data['total'];
                    }
                    else if($data['social'] == 'Instagram') {
                        $instagram = $data['total'];
                    }
                    else if($data['social'] == 'Google') {
                        $google = $data['total'];
                    }
                    else if($data['social'] == 'LinkedIn') {
                        $linkedin = $data['total'];
                    }
                    else if($data['social'] == 'Waze') {
                        $waze = $data['total'];
                    }
                    else if($data['social'] == 'TikTok') {
                        $tiktok = $data['total'];
                    }
                    else if($data['social'] == 'Spotify') {
                        $spotify = $data['total'];
                    }
                    $datos[] = array("mes"=>$data['mes'], "face"=>$facebook, "insta"=>$instagram, "goog"=>$google, "link"=>$linkedin, "waze"=>$waze, "tik"=>$tiktok, "spoti"=>$spotify);
                } 
                else {
                    $meses = $data['mes'];   
                    if($data['social'] == 'Facebook') {
                        $facebook = $data['total'];
                    }
                    else if($data['social'] == 'Instagram') {
                        $instagram = $data['total'];
                    }
                    else if($data['social'] == 'Google') {
                        $google = $data['total'];
                    }
                    else if($data['social'] == 'LinkedIn') {
                        $linkedin = $data['total'];
                    }
                    else if($data['social'] == 'Waze') {
                        $waze = $data['total'];
                    }
                    else if($data['social'] == 'TikTok') {
                        $tiktok = $data['total'];
                    }
                    else if($data['social'] == 'Spotify') {
                        $spotify = $data['total'];
                    }

                    $mes = array_pop($datos);
                    $facebook += $mes['face'];
                    $instagram += $mes['insta'];
                    $google += $mes['goog'];
                    $linkedin += $mes['link'];
                    $waze += $mes['waze'];
                    $tiktok += $mes['tik'];
                    $spotify += $mes['spoti'];

                    $datos[] = array("mes"=>$data['mes'], "face"=>$facebook, "insta"=>$instagram, "goog"=>$google, "link"=>$linkedin, "waze"=>$waze, "tik"=>$tiktok, "spoti"=>$spotify);
                }
            }
        ?>

        <?php
			foreach ($datos as $key => $value) {
		?>

        ['<?php echo $value['mes']; ?>', <?php echo $value['face']; ?>, <?php echo $value['insta']; ?>,
            <?php echo $value['goog']; ?>, <?php echo $value['link']; ?>, <?php echo $value['waze']; ?>,
            <?php echo $value['tik']; ?>, <?php echo $value['spoti']; ?>],

        <?php
			}		
		?>
    ]);

    var options = {
        selectionMode: 'multiple',
        title: 'Histórico de leads por mes',
        subtitle: 'Se actualiza cada fin de mes',
        animation: {
            duration: 1500,
            startup: true
        },
        // curveType: 'function',
        width: '100%',
        height: '100%',
        chartArea: {
            'backgroundColor': {
                'fill': '#fdfeff',
                'opacity': 100
            },
            left: 50,
            right: 10,
            top: 30,
            bottom: 70,
            width: "100%",
            height: "50%"
        },
        colors: ['#1877f2', '#d6249f', '#0F9D58', '#0073b1', '#33ccff', '#EE1D52', '#1ED760'],
        fontName: 'Roboto',
        fontSize: '14',
        legend: {
            position: 'bottom',
            pagingTextStyle: {
                fontSize: 18
            }
        }
    };
    var chart = new google.visualization.LineChart(document.getElementById('line_chart-8'));

    google.visualization.events.addListener(chart, 'error', function(googleError) {
        google.visualization.errors.removeError(googleError.id);
        document.getElementById("error_msg-8").innerHTML = "No se encotraron datos para graficar.";
        document.getElementById('error_msg-8').classList.add('alert', 'alert-danger', 'text-center');
    });

    // var chart = new google.charts.Line(document.getElementById('line_chart'));

    
    // chart.draw(data, google.charts.Line.convertOptions(options));

    function resizeHandler() {
        chart.draw(data, options);
    }
    if (window.addEventListener) {
        window.addEventListener('resize', resizeHandler, false);
    } else if (window.attachEvent) {
        window.attachEvent('onresize', resizeHandler);
    }
}
</script>

<script type="text/javascript">
// google.charts.load('current', {'packages': ['line']});
google.charts.load('current', {
    'packages': ['corechart']
});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {
    var data2 = google.visualization.arrayToDataTable([
        ['Meses', 'Facebook', 'Instagram', 'Google', 'LinkedIn', 'Waze', 'TikTok'],
        <?php 
            
            $company = $_GET['company'];
            // $query = "SELECT mes_actual AS mes, red_social AS social, SUM(leads) AS total FROM campana_redes WHERE campana_empresa = '".$company."' GROUP BY social, mes ORDER BY 'Septiembre'" ;
           
           $query = "SELECT mes_actual AS mes, YEAR(fecha_inicio) AS anio FROM campana_redes WHERE campana_empresa = '".$company."' GROUP BY mes ORDER BY YEAR(fecha_inicio) ASC;" ;
            //$query = "SELECT mes_actual AS mes, YEAR(fecha_inicio) AS anio FROM campana_redes WHERE campana_empresa = '".$company."' GROUP BY mes ORDER BY  mes DESC, YEAR(fecha_inicio) DESC" ;

            
            $resultado = mysqli_query($conexion, $query);
            while($data = mysqli_fetch_array($resultado)) {
                
                $mes = $data['mes'];
                $anio = $data['anio'];

                $resultado2 = mysqli_query($conexion, "SELECT SUM(llamadas) AS total FROM campana_redes WHERE campana_empresa = '".$company."' AND red_social = 'Facebook' AND mes_actual = '$mes' AND YEAR(fecha_inicio) = '$anio' ORDER BY YEAR(fecha_inicio) DESC; ");
                if ($data2 = mysqli_fetch_array($resultado2)) { if ($data2['total'] > 0) { $face = $data2['total']; } else { $face = 0; } }

                $resultado2 = mysqli_query($conexion, "SELECT SUM(llamadas) AS total FROM campana_redes WHERE campana_empresa = '".$company."' AND red_social = 'Instagram' AND mes_actual = '$mes' AND YEAR(fecha_inicio) = '$anio' ORDER BY YEAR(fecha_inicio) DESC; ");
                if ($data2 = mysqli_fetch_array($resultado2)) { if ($data2['total'] > 0) { $insta = $data2['total']; } else { $insta = 0; } }

                $resultado2 = mysqli_query($conexion, "SELECT SUM(llamadas) AS total FROM campana_redes WHERE campana_empresa = '".$company."' AND red_social = 'Google' AND mes_actual = '$mes' AND YEAR(fecha_inicio) = '$anio' ORDER BY YEAR(fecha_inicio) DESC; ");
                if ($data2 = mysqli_fetch_array($resultado2)) { if ($data2['total'] > 0) { $goog = $data2['total']; } else { $goog = 0; } }

                $resultado2 = mysqli_query($conexion, "SELECT SUM(llamadas) AS total FROM campana_redes WHERE campana_empresa = '".$company."' AND red_social = 'LinkedIn' AND mes_actual = '$mes' AND YEAR(fecha_inicio) = '$anio' ORDER BY YEAR(fecha_inicio) DESC; ");
                if ($data2 = mysqli_fetch_array($resultado2)) { if ($data2['total'] > 0) { $link = $data2['total']; } else { $link = 0; } }

                $resultado2 = mysqli_query($conexion, "SELECT SUM(llamadas) AS total FROM campana_redes WHERE campana_empresa = '".$company."' AND red_social = 'Waze' AND mes_actual = '$mes' AND YEAR(fecha_inicio) = '$anio' ORDER BY YEAR(fecha_inicio) DESC; ");
                if ($data2 = mysqli_fetch_array($resultado2)) { if ($data2['total'] > 0) { $waze = $data2['total']; } else { $waze = 0; } }

                $resultado2 = mysqli_query($conexion, "SELECT SUM(llamadas) AS total FROM campana_redes WHERE campana_empresa = '".$company."' AND red_social = 'TikTok' AND mes_actual = '$mes' AND YEAR(fecha_inicio) = '$anio' ORDER BY YEAR(fecha_inicio) DESC; ");
                if ($data2 = mysqli_fetch_array($resultado2)) { if ($data2['total'] > 0) { $tik = $data2['total']; } else { $tik = 0; } }

                $datos_llamadas[] = array(
                    "mes"=>$mes.' '.$anio, 
                    "face2"=>$face,
                    "insta2"=>$insta,
                    "goog2"=>$goog,
                    "link2"=>$link,
                    "waze2"=>$waze,
                    "tik2"=>$tik
                );

                
            }
        ?>

        <?php
			foreach ($datos_llamadas as $key => $value) {
		?>

        ['<?php echo $value['mes']; ?>', <?php echo $value['face2']; ?>, <?php echo $value['insta2']; ?>, <?php echo $value['goog2']; ?>, <?php echo $value['link2']; ?>, <?php echo $value['waze2']; ?>, <?php echo $value['tik2']; ?> <?php // echo $value['spoti']; ?>],

        <?php 
			}		
		?>
    ]);

    var options = {
        selectionMode: 'multiple',
        title: 'Histórico de llamadas por mes',
        subtitle: 'Se actualiza cada fin de mes',
        animation: {
            duration: 1500,
            startup: true
        },
        // curveType: 'function',
        width: '100%',
        height: '100%',
        chartArea: {
            'backgroundColor': {
                'fill': '#fdfeff',
                'opacity': 100
            },
            left: 50,
            right: 10,
            top: 30,
            bottom: 70,
            width: "100%",
            height: "50%"
        },
        colors: ['#1877f2', '#d6249f', '#0F9D58', '#0073b1', '#33ccff', '#EE1D52', '#1ED760'],
        fontName: 'Roboto',
        fontSize: '14',
        legend: {
            position: 'bottom',
            pagingTextStyle: {
                fontSize: 18
            }
        }
    };
    var chart = new google.visualization.LineChart(document.getElementById('line_chart-9'));
    
    google.visualization.events.addListener(chart, 'error', function(googleError) {
        google.visualization.errors.removeError(googleError.id);
        document.getElementById("error_msg-9").innerHTML = "No se encotraron datos para graficar.";
        document.getElementById('error_msg-9').classList.add('alert', 'alert-danger', 'text-center');
    });

    // var chart = new google.charts.Line(document.getElementById('line_chart'));
    chart.draw(data2, options);
    // chart.draw(data, google.charts.Line.convertOptions(options));

    function resizeHandler() {
        chart.draw(data, options);
    }
    if (window.addEventListener) {
        window.addEventListener('resize', resizeHandler, false);
    } else if (window.attachEvent) {
        window.attachEvent('onresize', resizeHandler);
    }
}
</script>


<script type="text/javascript">
google.charts.load('current', {
    packages:['corechart']
});


google.charts.setOnLoadCallback(drawChart);

function drawChart() {
    var data = google.visualization.arrayToDataTable([
        ['Fecha', 'Facebook', 'Instagram', 'Google', 'LinkedIn', 'Waze', 'TikTok', 'Spotify'],

        <?php
            setlocale(LC_ALL,"es_ES");
            $company_totalGasto = $_GET['company'];
            $month_totalGasto = $_GET['month'];
            $year_totalGasto = $_GET['year'];

            $conexion->query("SET lc_time_names = 'es_ES'");	
            $query_totalGasto = "SELECT dia_gasto, COALESCE(facebook_gasto / NULLIF(leads_gasto_face, 0), 0) as divFace, 
            COALESCE(instagram_gasto / NULLIF(leads_gasto_insta, 0), 0) as divInsta,
            COALESCE(google_gasto / NULLIF(leads_gasto_goog, 0), 0) as divGoog,
            COALESCE(linkedin_gasto / NULLIF(leads_gasto_link, 0), 0) as divLink,
            COALESCE(waze_gasto / NULLIF(leads_gasto_waze, 0), 0) as divWaze,
            COALESCE(tiktok_gasto / NULLIF(leads_gasto_tik, 0), 0) as divTik,
            COALESCE(spotify_gasto / NULLIF(leads_gasto_spoti, 0), 0) as divSpoti FROM presupuesto_gastado WHERE empresa_gasto = '".$company_totalGasto."' AND DATE_FORMAT(dia_gasto, '%M') = '".$month_totalGasto."' AND YEAR(dia_gasto) = '".$year_totalGasto."' ORDER BY DATE_FORMAT(dia_gasto, '%M') ASC";
            $resTotalGasto=mysqli_query($conexion, $query_totalGasto);

            while($dataTotalGasto=mysqli_fetch_array($resTotalGasto)) {

                $diasTotalGasto = date("j-M-Y", strtotime($dataTotalGasto['dia_gasto']));
                $faceTotalGasto = $dataTotalGasto['divFace'];
                $instaTotalGasto = $dataTotalGasto['divInsta'];
                $googTotalGasto = $dataTotalGasto['divGoog'];
                $linkTotalGasto = $dataTotalGasto['divLink'];
                $wazeTotalGasto = $dataTotalGasto['divWaze'];
                $tiktokTotalGasto = $dataTotalGasto['divTik'];
                $spotifyTotalGasto = $dataTotalGasto['divSpoti'];
                // $totalGasto = ($dataTotalGasto['divFace']+$dataTotalGasto['divInsta']+$dataTotalGasto['divGoog']+$dataTotalGasto['divLink']+$dataTotalGasto['divWaze']+$dataTotalGasto['divTik']+$dataTotalGasto['divSpoti'])/7;
        ?>
                ['<?php echo $diasTotalGasto;?>', <?php echo $faceTotalGasto;?>, <?php echo $instaTotalGasto;?>,
                <?php echo $googTotalGasto;?>, <? echo $linkTotalGasto;?>, <? echo $wazeTotalGasto;?>, 
                <?echo $tiktokTotalGasto;?>, <? echo $spotifyTotalGasto; ?>],
        <?php      
            }
        ?>

    ]);

    var options = {
        selectionMode: 'multiple',
        title: 'Costo promedio de lead por día',
        subtitle: 'Se actualiza cada fin de mes',
        animation: {
            duration: 1500,
            easing: 'linear',
            startup: true
        },
        width: '100%',
        height: '100%',
        chartArea: {
            'backgroundColor': {
                'fill': '#fdfeff',
                'opacity': 100
            },
            bottom: 60,
            left: 60,
            right: 20,
            top: '20%',
            width: '100%',
            height: '75%'
        },
        colors: ['#1877f2', '#d6249f', '#0F9D58', '#0073b1', '#33ccff', '#EE1D52', '#1ED760'],
        fontName: 'Roboto',
        fontSize: '14',
        legend: {
            position: 'top',
            maxLines: 1,
            alignment: 'end',
            pagingTextStyle: {
                fontSize: 18
            }
        },
        hAxis: {
            slantedText: true,
            format: 'dd/MM/yyyy'
        }
    };

    var chart = new google.visualization.LineChart(document.getElementById('line_chart-8'));

    google.visualization.events.addListener(chart, 'error', function(googleError) {
        google.visualization.errors.removeError(googleError.id);
        document.getElementById("error_msg-8").innerHTML = "Nose encotraron datos para graficar.";
        document.getElementById('error_msg-8').classList.add('alert', 'alert-danger', 'text-center');
    });

    chart.draw(data, options);


    function resizeHandler() {
        // chart.draw(data, google.charts.Bar.convertOptions(options));
        chart.draw(data, options);

    }
    if (window.addEventListener) {
        window.addEventListener('resize', resizeHandler, false);
    } else if (window.attachEvent) {
        window.attachEvent('onresize', resizeHandler);
    }
}
</script>

TotalGasto

