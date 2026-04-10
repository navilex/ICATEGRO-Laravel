<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grupo;
use Elibyy\TCPDF\Facades\TCPDF;
use Carbon\Carbon;

class GrupoPdfDocumentosController extends Controller
{
    public function documentosEntregados(Grupo $grupo)
    {
        // 1. Cargar relaciones necesarias para evitar múltiples consultas a la BD
        $grupo->load(['listaAlumnos.student', 'plantel', 'curso', 'cursoIcategro']);

        // Verificar que el grupo esté autorizado
        $estatusValidos = ['AUTORIZADO', 'PROCESO', 'CALIFICADO', 'CONCLUIDO'];
        if (!in_array(strtoupper($grupo->estatus), $estatusValidos)) {
            abort(403, 'El grupo debe estar autorizado para visualizar los documentos entregados.');
        }

        // Datos de cabecera
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

        // --- INICIO GENERACIÓN DE FILAS DE ALUMNOS ---
        $filasAlumnos = '';
        $contador = 1;

        foreach ($grupo->listaAlumnos as $item) {
            $student = $item->student;
            // Formato de nombre: APELLIDO 1 / APELLIDO 2 * NOMBRE
            $nombreCompleto = mb_strtoupper("{$student->lastname1} / {$student->lastname2} * {$student->name}");

            // Lógica para calificación (entero si es 10, un decimal si es otro)
            $califRaw = $item->calificacion;
            $califFormateada = ($califRaw == 10) ? "10" : number_format($califRaw, 1);

            $filasAlumnos .= '
                <tr>
                    <td width="3%" align="center">' . $contador++ . '</td>
                    <td width="6%" align="center">' . $student->id . '</td>
                    <td width="12%" align="center">' . $student->matricula . '</td>
                    <td width="30%">' . $nombreCompleto . '</td>
                    <td width="5%" align="center">' . $califFormateada . '</td>
                    <td width="10%" align="center">' . mb_strtoupper($grupo->estatus) . '</td>
                    <td width="10%" align="center">' . mb_strtoupper($item->doc_type ?? 'CONSTANCIA') . '</td>
                    <td width="9%" align="center">' . ($item->folio ?? 'N/A') . '</td>
                    <td width="15%"></td>
                </tr>';
        }
        // --- FIN GENERACIÓN DE FILAS ---

        // Configuración de TCPDF
        $pdf = new \TCPDF('L', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetCreator('ICATEGRO');
        $pdf->SetTitle('Lista de Documentos Entregados - ' . $idGrupo);
        $pdf->SetMargins(10, 10, 10);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetAutoPageBreak(TRUE, 15);
        $pdf->AddPage();

        $html = <<<EOD
        <style>
            .header-title { text-align: center; font-weight: bold; font-size: 12px; }
            .info-table { width: 100%; font-family: helvetica; font-size: 8px; margin-top: 10px; }
            .label { font-weight: bold; }
            .value { border-bottom: 0.5px solid #000; }
            
            /* Estilos para la nueva tabla de alumnos */
            .data-table {
                width: 100%;
                border-collapse: collapse;
                font-family: helvetica;
                font-size: 7.5px;
                margin-top: 20px;
            }
            .data-table th {
                background-color: #E5E5E5;
                font-weight: bold;
                text-align: center;
                border: 1px solid #000;
                padding: 4px;
            }
            .data-table td {
                border: 1px solid #000;
                padding: 4px;
                vertical-align: middle;
            }
        </style>

        <div class="header-title">
            DIRECCION GENERAL DE CENTROS DE FORMACION PARA EL TRABAJO<br>
            INSTUTO DE CAPACITACIÓN PARA EL TRABAJO DEL ESTADO DE GUERRERO<br>
            LISTA DE DOCUMENTOS ENTREGADOS
        </div>

        <div style="border: 1px solid #000; padding: 5px; margin-top: 10px;">
            <table class="info-table" cellpadding="2">
                <tr>
                    <td width="15%"><span class="label">DIRECCION GENERAL:</span></td>
                    <td width="25%" class="value">{$direccionGeneral}</td>
                    <td width="10%"><span class="label">CLAVE CCT:</span></td>
                    <td width="10%" class="value">{$claveCct}</td>
                    <td width="12%"><span class="label">CICLO ESCOLAR:</span></td>
                    <td width="8%" class="value">{$cicloEscolar}</td>
                    <td width="8%"><span class="label">PERIODO:</span></td>
                    <td width="2%" class="value">{$periodo}</td>
                    <td width="10%" align="right">{$fechaImpresion}</td>
                </tr>
            </table>
            <table class="info-table" cellpadding="2">
                <tr>
                    <td width="8%"><span class="label">ID GRUPO:</span></td>
                    <td width="8%" class="value">{$idGrupo}</td>
                    <td width="15%"><span class="label">NÚMERO DE GRUPO:</span></td>
                    <td width="15%" class="value">{$numeroGrupo}</td>
                    <td width="15%"><span class="label">NOMBRE DEL GRUPO:</span></td>
                    <td width="39%" class="value">{$nombreGrupo}</td>
                </tr>
            </table>
            <table class="info-table" cellpadding="2">
                <tr>
                    <td width="12%"><span class="label">FECHA DE INICIO:</span></td>
                    <td width="10%" class="value">{$fechaInicioStr}</td>
                    <td width="15%"><span class="label">FECHA DE TÉRMINO:</span></td>
                    <td width="10%" class="value">{$fechaTerminoStr}</td>
                    <td width="18%"><span class="label">DURACIÓN EN HORAS:</span></td>
                    <td width="8%" class="value">{$duracionHoras}</td>
                    <td width="18%"><span class="label">DURACIÓN EN DÍAS:</span></td>
                    <td width="9%" class="value">{$duracionDias}</td>
                </tr>
            </table>
            <table class="info-table" cellpadding="2">
                <tr>
                    <td width="8%"><span class="label">HORARIO:</span></td>
                    <td width="92%" class="value">{$horario}</td>
                </tr>
            </table>
        </div>

        <br><br>

        <table class="data-table" cellpadding="3">
            <thead>
                <tr>
                    <th width="3%">Num</th>
                    <th width="6%">ID ALUMNO</th>
                    <th width="12%">NUM. DE CONTROL</th>
                    <th width="30%">NOMBRE DEL CAPACITANDO</th>
                    <th width="5%">CALIF.</th>
                    <th width="10%">ESTATUS</th>
                    <th width="10%">DOCUMENTO</th>
                    <th width="9%">FOLIO</th>
                    <th width="15%">FIRMA DE CONFORMIDAD</th>
                </tr>
            </thead>
            <tbody>
                {$filasAlumnos}
            </tbody>
        </table>
EOD;

        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Documentos_Entregados_Grupo_' . $idGrupo . '.pdf', 'I');
    }
}