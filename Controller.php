<?php

  const HORARIO_PROHIBIDO_MANANA = "7:00am-9:30am";
  const HORARIO_PROHIBIDO_TARDE = "4:00pm-7:30pm";

  const LUNES_LAST_NUM_1 = "1";
  const LUNES_LAST_NUM_2 = "2";

  const MARTES_LAST_NUM_3 = "3";
  const MARTES_LAST_NUM_4 = "4";

  const MIERCOLES_LAST_NUM_5 = "5";
  const MIERCOLES_LAST_NUM_6 = "6";

  const JUEVES_LAST_NUM_7 = "7";
  const JUEVES_LAST_NUM_8 = "8";

  const VIERNES_LAST_NUM_9 = "9";
  const VIERNES_LAST_NUM_0 = "0";

  $placa = $_POST["placa"];
  $fecha = $_POST["fecha"];

  try {
    $result = PuedeConducir($placa, $fecha);
  } catch (Exception $e) {
    // Devolver mensaje negativo
    $responseArray = ["type" => 'danger', "message" => $e->getMessage()];
  }

  // Devolver mensaje satisfactorio
  if (isset($result)) {
     $responseArray = ["type" => 'success', "message" => $result];
  }

   // Si hay una solicitud AJAX, devolver respuesta en JSON
  if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
      header('Content-Type: application/json');
      echo json_encode($responseArray);
  }
  else {
      echo $responseArray;
  }

  function PuedeConducir($placa, $fecha) {
    $mensaje = 'No puedes conducir para esa fecha!!!, tienes Pico y Placa';
    // Obtener el ultimo digito de la placa para verificarlo
    $ultimo_digito = obtenerUltimoDigito($placa);
    // Saber si cae feriado
    $dia_feriado = esDiaFeriado($fecha);
    // Saber si la hora dada esta o no en el rango prohibido
    $horario_prohibido = esHorarioProhibido($fecha);
    // Obtener dia de la semana
    $fecha_formateada = dividirFecha($fecha);
    $dia_semana = $fecha_formateada['dia_semana'];

    if (!$dia_feriado) {
      if ($dia_semana == "Saturday" || $dia_semana == "Sunday") {
        return "Es fin de semana!!!, si puedes conducir";
      }
      switch ($dia_semana) {
        case "Monday":
          if ($ultimo_digito == LUNES_LAST_NUM_1 || $ultimo_digito == LUNES_LAST_NUM_2) {
            if ($horario_prohibido) {
              throw new Exception($mensaje);
            }
          }
        case "Tuesday":
          if ($ultimo_digito == MARTES_LAST_NUM_3 || $ultimo_digito == MARTES_LAST_NUM_4) {
            if ($horario_prohibido) {
              throw new Exception($mensaje);
            }
          }
        case "Wednesday":
          if ($ultimo_digito == MIERCOLES_LAST_NUM_5 || $ultimo_digito == MIERCOLES_LAST_NUM_6) {
            if ($horario_prohibido) {
              throw new Exception($mensaje);
            }
          }
        case "Thursday":
          if ($ultimo_digito == JUEVES_LAST_NUM_7 || $ultimo_digito == JUEVES_LAST_NUM_8) {
            if ($horario_prohibido) {
              throw new Exception($mensaje);
            }
          }
        case "Friday":
          if ($ultimo_digito == VIERNES_LAST_NUM_9 || $ultimo_digito == VIERNES_LAST_NUM_0) {
            if ($horario_prohibido) {
              throw new Exception($mensaje);
            }
          }
        default:
        return "Si puedes conducir para esa fecha!!!";
      }
    }
    return "Ese dia es Feriado, puedes conducir en el horario que desees!!!. " . "Es ". $dia_feriado;
  }

  // Obtener el ultimo digito de la placa
  function obtenerUltimoDigito($placa) {
    return substr($placa, -1);
  }

  // Formatear fecha
  function dividirFecha($fecha) {
    $date = new DateTime($fecha);
    // dia_semana Monday, Tuesday...
    $dia_semana = $date->format("l");
    // dia_mes 1, 2, 3...
    $dia_mes = $date->format("j");
    // mes 01, 02, 03...
    $mes = $date->format("m");

    $fecha = [
      "dia_semana" => $dia_semana,
      "dia_mes" => $dia_mes,
      "mes" => $mes
    ];
    return $fecha;
  }

  // Saber si es dia feriado
  function esDiaFeriado($fecha) {
    $dias_feriados_2018 = [
    "1/01"  => "Año nuevo",
    "12/02" => "Carnaval",
    "13/02" => "Carnaval",
    "30/03" => "Viernes Santo",
    "30/04" => "Día del Trabajo",
    "25/05" => "Batalla del Pichincha",
    "10/08" => "Primer Grito de la Independencia",
    "12/10" => "Independencia de Guayaquil",
    "2/11"  => "Día de los Difuntos",
    "25/12" => "Navidad",
    "29/12" => "Fin de año",
    "30/12" => "Fin de año",
    "31/12" => "Fin de año"
  ];
    $fecha = dividirFecha($fecha);
    $fecha = $fecha["dia_mes"]. "/" . $fecha["mes"];
    foreach ($dias_feriados_2018 as $key => $day) {
      if ($fecha == $key) {
        return $day;
      }
    }
    return FALSE;
  }

  // Saber si una hora determinada es prohibida para conducir.
  function esHorarioProhibido($fecha) {
    // Obtener hora seleccionada por el usuario para conducir
    // en formato 5:30am, 8:45pm.
    $date = new DateTime($fecha);
    $hora_conducir = strtotime($date->format("g:ia"));

    // Obtener horarios de inicio y fin de Pico y Pala.
    $horario_manana = explode("-", HORARIO_PROHIBIDO_MANANA);
    $horario_tarde = explode("-", HORARIO_PROHIBIDO_TARDE);

    // Rangos de horarios de prohibicion en la manana.
    $hora_am_start = strtotime($horario_manana[0]);
    $hora_am_end = strtotime($horario_manana[1]);

    // Rangos de horarios de prohibicion en la tarde.
    $hora_pm_start = strtotime($horario_tarde[0]);
    $hora_pm_end = strtotime($horario_tarde[1]);

    // Si la hora esta en el rango de prohibicion de la manana.
    if ($hora_conducir >= $hora_am_start && $hora_conducir <= $hora_am_end) {
      return TRUE;
    }
    // Si la hora esta en el rango de prohibicion de la tarde.
    elseif ($hora_conducir >= $hora_pm_start && $hora_conducir <= $hora_pm_end) {
      return TRUE;
    }
    else {
      // Si la hora esta fuera de los rangos de prohibicion, es horario NO prohibido.
      // El usuario puede conducir.
      return FALSE;
    }
  }
