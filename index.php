<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link href="assets/bootstrap/css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="assets/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
    <link href="assets/css/styles.css" rel="stylesheet" media="screen">
</head>

<body>
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
            <h1>Pico y Placa, Quito Ecuador.</h1>
            <p class="lead">Saber si puedo conducir en Quito.</p>
            <form id="picoplaca-form" method="post" class="form-horizontal" action="Controller.php" role="form">
                <div class="messages"></div>
                <div class="controls">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="form_name">Número de Placa *</label>
                                <input id="form_placa" type="text" name="placa" class="form-control" placeholder="Escriba número de placa completo" required="required" data-error="El número de Placa es obligatorio." aria-describedby="description_placa">
                                <span id="description_placa" class="help-block">Formato tipo: ABC-123 ó ABC-1234.</span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="col-md-7 col-md-offset-1">
                            <div class="form-group">
                                <label for="form_date">Seleccione Fecha y Hora *</label>
                                <div class="input-group date form_datetime" data-date="2018-01-01T05:25:07Z" data-date-format="d MM yyyy, H:ii p" data-link-field="dtp_input1">
                                    <input id="form_date" class="form-control" name="fecha" size="16" type="text" value="" required="required" placeholder="Seleccione fecha y hora en que desea conducir" readonly data-error="La Fecha y Hora son obligatorios.">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                                </div><br/>
                                <input type="hidden" id="dtp_input1" value="" /><br/>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <input type="submit" class="btn btn-success btn-send" value="Verificar">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <p class="text-muted"><strong>*</strong> Estos campos son obligatorios.</p>
                        </div>
                    </div>
                    <div class="row">
                        <img src="assets/images/perimetro.jpg" class="center-block img-responsive">
                    </div>
                </div>
            </form>
        </div><!-- /.8 -->
    </div> <!-- /.row-->
</div> <!-- /.container-->

<script type="text/javascript" src="assets/jquery-1.8.3.min.js" charset="UTF-8"></script>
<script type="text/javascript" src="assets/validator.js" charset="UTF-8"></script>
<script type="text/javascript" src="assets/bootstrap/js/bootstrap.js"></script>
<script type="text/javascript" src="assets/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="assets/bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.es.js" charset="UTF-8"></script>
<script type="text/javascript" src="assets/js/scripts.js" charset="UTF-8"></script>

<script type="text/javascript">
    $('.form_datetime').datetimepicker({
      //language: 'es',
      weekStart: 1,
      todayBtn:  1,
      autoclose: 1,
      todayHighlight: 1,
      startView: 2,
      forceParse: 0,
      showMeridian: 1
    });
</script>

</body>
</html>
