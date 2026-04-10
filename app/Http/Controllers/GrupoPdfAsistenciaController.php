<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grupo;
use Elibyy\TCPDF\Facades\TCPDF;
use Carbon\Carbon;

class GrupoPdfAsistenciaController extends Controller
{
    public function listaAsistencia(Grupo $grupo)
    {
        // 1. Carga de relaciones y verificación de estatus
        $grupo->load(['listaAlumnos.student', 'plantel', 'curso', 'cursoIcategro']);

        $estatusValidos = ['AUTORIZADO', 'PROCESO', 'CALIFICADO', 'CONCLUIDO'];
        if (!in_array(strtoupper($grupo->estatus), $estatusValidos)) {
            abort(403, 'El grupo debe estar autorizado para visualizar la lista de asistencia.');
        }

        // 2. Preparación de datos
        $mesInicio = $grupo->fecha_inicio ? strtoupper(Carbon::parse($grupo->fecha_inicio)->locale('es')->translatedFormat('F')) : '??';
        $direccionGeneral = $grupo->plantel ? $grupo->plantel->name : '??';

        $claveCct = '??';
        if ($grupo->tipo_servicio === 'CAE' && $grupo->curso) {
            $claveCct = $grupo->curso->clave ?? '??';
        } elseif ($grupo->tipo_servicio === 'Extensión' && $grupo->cursoIcategro) {
            $claveCct = $grupo->cursoIcategro->clave ?? '??';
        }

        $cicloEscolar = $grupo->ciclo_escolar ?? '??';
        $periodo = $grupo->periodo ?? '??';
        $fechaImpresion = Carbon::now()->format('d/m/Y');

        $idGrupo = $grupo->id;
        $numeroGrupo = $grupo->numero_grupo ?? '??';
        $nombreGrupo = mb_strtoupper($grupo->nombre_curso);

        $fechaInicioStr = $grupo->fecha_inicio ? Carbon::parse($grupo->fecha_inicio)->format('d/m/Y') : '??';
        $fechaTerminoStr = $grupo->fecha_termino ? Carbon::parse($grupo->fecha_termino)->format('d/m/Y') : '??';

        $duracionHoras = $grupo->duracion_horas ?? '??';
        $duracionDias = $grupo->duracion_dias ?? '??';
        $horario = mb_strtoupper($grupo->horario ?? '??');

        $inscritos = $grupo->listaAlumnos;

        // 3. Configuración de TCPDF
        $pdf = new \TCPDF('L', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetCreator('ICATEGRO');
        $pdf->SetAuthor('ICATEGRO');
        $pdf->SetTitle('Lista de Asistencia - Grupo ' . $idGrupo);

        // Márgenes: Superior en 10 para empezar desde arriba con la imagen
        $pdf->SetMargins(10, 10, 10);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetAutoPageBreak(TRUE, 15);
        $pdf->AddPage();

        // 4. Colocar Imagen primero (Banner)
        $rutaImagen = public_path('images/IMPRESIONES_DOCUMENTACION.jpg');
        if (file_exists($rutaImagen)) {
            // X=10, Y=5, Ancho=277 (para cubrir margen a margen en A4 horizontal)
            $pdf->Image($rutaImagen, 10, 5, 277, 22, 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        }

        // 5. Ajustar cursor Y debajo de la imagen para el título
        $pdf->SetY(28);

        // 6. Estilos CSS y Contenido HTML
        $html = <<<EOD
        <style>
            .header-title {
                text-align: center;
                font-weight: bold;
                font-size: 12px;
                line-height: 1.2;
                margin-bottom: 10px;
            }
            .table-container {
                border: 1px solid #000;
                width: 100%;
                margin-top: 10px;
            }
            .info-table {
                width: 100%;
                border-collapse: collapse;
                font-family: helvetica;
                font-size: 8px;
            }
            .info-table td {
                padding: 2px 4px;
                vertical-align: middle;
            }
            .label { font-weight: bold; }
            .value { border-bottom: 0.5px solid #000; }

            .attendance-table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 10px;
                font-size: 7px;
            }
            .attendance-table th {
                border: 1px solid #000;
                font-weight: bold;
                text-align: center;
                background-color: #EEEEEE;
                vertical-align: middle;
            }
            .attendance-table td {
                border: 1px solid #000;
                text-align: center;
                height: 16px;
                vertical-align: middle;
            }
            .col-nombre { text-align: left !important; padding-left: 3px; }
        </style>

        <div class="header-title">
            DIRECCION GENERAL DE CENTROS DE FORMACION PARA EL TRABAJO<br>
            INSTITUTO DE CAPACITACIÓN PARA EL TRABAJO DEL ESTADO DE GUERRERO<br>
            LISTA DE ASISTENCIA DEL MES DE {$mesInicio}
        </div>

        <div class="table-container">
            <table class="info-table" cellpadding="2">
                <tr>
                    <td width="16%"><span class="label">DIRECCION GENERAL:</span></td>
                    <td width="26%" class="value"> {$direccionGeneral}</td>
                    <td width="9%"><span class="label">CLAVE CCT:</span></td>
                    <td width="10%" class="value"> {$claveCct}</td>
                    <td width="10%"><span class="label">CICLO ESCOLAR:</span></td>
                    <td width="6%" class="value"> {$cicloEscolar}</td>
                    <td width="7%"><span class="label">PERIODO:</span></td>
                    <td width="3%" class="value"> {$periodo}</td>
                    <td width="13%" align="right"><span class="label">Fecha:</span> {$fechaImpresion}</td>
                </tr>
            </table>
            
            <table class="info-table" cellpadding="2">
                <tr>
                    <td width="8%"><span class="label">ID GRUPO:</span></td>
                    <td width="8%" class="value"> {$idGrupo}</td>
                    <td width="15%"><span class="label">NÚMERO DE GRUPO:</span></td>
                    <td width="15%" class="value"> {$numeroGrupo}</td>
                    <td width="15%"><span class="label">NOMBRE DEL GRUPO:</span></td>
                    <td width="39%" class="value"> {$nombreGrupo}</td>
                </tr>
            </table>

            <table class="info-table" cellpadding="2">
                <tr>
                    <td width="13%"><span class="label">FECHA DE INICIO:</span></td>
                    <td width="12%" class="value"> {$fechaInicioStr}</td>
                    <td width="15%"><span class="label">FECHA DE TERMINO:</span></td>
                    <td width="12%" class="value"> {$fechaTerminoStr}</td>
                    <td width="15%"><span class="label">DURACION EN HORAS:</span></td>
                    <td width="10%" class="value"> {$duracionHoras}</td>
                    <td width="15%"><span class="label">DURACION EN DIAS:</span></td>
                    <td width="8%" class="value"> {$duracionDias}</td>
                </tr>
            </table>

            <table class="info-table" cellpadding="2">
                <tr>
                    <td width="8%"><span class="label">HORARIO:</span></td>
                    <td width="92%" class="value"> {$horario}</td>
                </tr>
            </table>
        </div>

        <br><br>

        <table class="attendance-table" cellpadding="1">

            <thead>

                <tr>

                    <th width="3%">Num</th>

                    <th width="5%">ID Alumno</th>

                    <th width="12%">NUM. DE CONTROL</th>

                    <th width="24%">NOMBRE DEL ALUMNO</th>

EOD;

        // Generar columnas de los días (1 al 31)

        for ($i = 1; $i <= 31; $i++) {

            $html .= '<th width="1.5%">' . $i . '</th>';

        }

        $html .= <<<EOD

                    <th width="4%">AI</th>

                    <th width="5.5%">Calif. final</th>

                </tr>

            </thead>

            <tbody>

EOD;

        // Iterar sobre los alumnos para llenar la tabla

        foreach ($inscritos as $key => $registro) {

            $alumno = $registro->student;

            $num = $key + 1;

            $idAlumno = $alumno->id;

            $numControl = $alumno->matricula; // Usando el accessor de tu modelo Student

            // Formato de nombre: APELLIDO1 / APELLIDO2 * NOMBRES

            $nombreCompleto = mb_strtoupper($alumno->lastname1 . ' / ' . $alumno->lastname2 . ' * ' . $alumno->name);

            $calificacion = $registro->calificacion ?? '';

            $html .= "<tr>

                <td width=\"3%\">{$num}</td>

                <td width=\"5%\">{$idAlumno}</td>

                <td width=\"12%\">{$numControl}</td>

                <td width=\"24%\" class=\"col-nombre\">{$nombreCompleto}</td>";

            // Celdas vacías para los 31 días

            for ($i = 1; $i <= 31; $i++) {

                $html .= '<td width="1.5%"></td>';

            }

            $html .= "

                <td width=\"4%\"></td>

                <td width=\"5.5%\">{$calificacion}</td>

            </tr>";

        }

        $html .= '</tbody></table>';

        // 7. Escribir el HTML
        $pdf->writeHTML($html, true, false, true, false, '');

        // 8. Salida
        return response($pdf->Output('Lista_Asistencia_Grupo_' . $idGrupo . '.pdf', 'I'))
            ->header('Content-Type', 'application/pdf');
    }
}