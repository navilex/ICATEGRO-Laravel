<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grupo;
use Elibyy\TCPDF\Facades\TCPDF;
use Carbon\Carbon;

class GrupoPdfConstanciasController extends Controller
{
    public function imprimirConstancias(Grupo $grupo)
    {
        // 1. Cargar relaciones
        $grupo->load(['listaAlumnos.student', 'plantel', 'curso', 'cursoIcategro']);

        // Verificar que el grupo esté autorizado
        $estatusValidos = ['AUTORIZADO', 'PROCESO', 'CALIFICADO', 'CONCLUIDO'];
        if (!in_array(strtoupper($grupo->estatus), $estatusValidos)) {
            abort(403, 'El grupo debe estar autorizado para imprimir las constancias.');
        }

        // Datos del grupo
        $direccionGeneral = mb_strtoupper($grupo->plantel ? $grupo->plantel->name : 'DIRECCION GENERAL');
        $claveCct = '??';
        if ($grupo->tipo_servicio === 'CAE' && $grupo->curso) {
            $claveCct = mb_strtoupper($grupo->curso->clave ?? '??');
        } elseif ($grupo->tipo_servicio === 'Extensión' && $grupo->cursoIcategro) {
            $claveCct = mb_strtoupper($grupo->cursoIcategro->clave ?? '??');
        }

        $nombreCurso = mb_strtoupper($grupo->nombre_curso);
        $duracionHoras = $grupo->duracion_horas ?? '??';
        $tipoServicio = $grupo->tipo_servicio ?? '??';
        
        $estado = mb_convert_case($grupo->estado ?? 'Guerrero', MB_CASE_TITLE, "UTF-8");
        $municipio = mb_convert_case($grupo->municipio ?? '', MB_CASE_TITLE, "UTF-8");
        $localidad = mb_convert_case($grupo->localidad ?? '', MB_CASE_TITLE, "UTF-8");
        
        $fechaActual = Carbon::now()->locale('es');
        $dia = $fechaActual->format('d');
        $mes = strtolower($fechaActual->translatedFormat('F'));
        $anio = $fechaActual->format('Y');
        
        $ubicacion = [];
        if(!empty($localidad)) $ubicacion[] = $localidad;
        if(!empty($municipio) && $municipio !== $localidad) $ubicacion[] = $municipio;
        if(!empty($estado)) $ubicacion[] = $estado;
        
        $ubicacionStr = implode(', ', $ubicacion);
        if(empty($ubicacionStr)) $ubicacionStr = 'Guerrero';
        
        $fechaTexto = "{$ubicacionStr}, a {$dia} de {$mes} de {$anio}";

        // Configuración de TCPDF
        $pdf = new \TCPDF('L', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetCreator('ICATEGRO');
        $pdf->SetAuthor('ICATEGRO');
        $pdf->SetTitle('Constancias - Grupo ' . $grupo->id);
        $pdf->SetMargins(15, 20, 15);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetAutoPageBreak(TRUE, 15);
        
        // Alumnos inscritos
        $alumnos = $grupo->listaAlumnos;
        
        if($alumnos->isEmpty()) {
            $pdf->AddPage();
            $pdf->SetFont('helvetica', 'B', 14);
            $pdf->Cell(0, 50, 'No hay alumnos registrados en este grupo.', 0, 1, 'C');
        } else {
            foreach($alumnos as $item) {
                $student = $item->student;
                if(!$student) continue;

                $nombreAlumno = mb_strtoupper(trim("{$student->name} {$student->lastname1} {$student->lastname2}"));
                $curp = mb_strtoupper($student->curp ?? 'SIN CURP');
                $urlAlumno = route('students.show', $student->id);
                
                $pdf->AddPage();
                
                $html = <<<EOD
<style>
    .top-header { font-family: helvetica; font-size: 13px; }
    .title-a { font-family: helvetica; font-size: 24px; font-weight: bold; text-align: center; }
    .curp { font-family: helvetica; font-size: 13px; text-align: center; }
    .course-name { font-family: helvetica; font-size: 22px; font-weight: bold; text-align: center; line-height: 1.4; }
    .details { font-family: helvetica; font-size: 15px; text-align: center; }
    .date { font-family: helvetica; font-size: 14px; text-align: center; }
</style>

<br><br>
<table width="100%">
    <tr>
        <td width="50%" align="center" class="top-header">{$direccionGeneral}</td>
        <td width="50%" align="center" class="top-header">{$claveCct}</td>
    </tr>
</table>

<br><br><br><br>
<div class="title-a">a: {$nombreAlumno}</div>
<div class="curp">{$curp}</div>

<br><br><br><br>
<div class="course-name">{$nombreCurso}</div>

<br><br><br><br>
<table width="100%">
    <tr>
        <td width="50%" align="center" class="details">{$duracionHoras}</td>
        <td width="50%" align="center" class="details">{$tipoServicio}</td>
    </tr>
</table>

<br><br><br><br>
<div class="date">{$fechaTexto}</div>
EOD;

                $pdf->writeHTML($html, true, false, true, false, '');

                // Generar QR (x=240, y=150 es la esquina inferior derecha aproximada en A4 horizontal)
                $styleQR = array(
                    'border' => false,
                    'padding' => 0,
                    'fgcolor' => array(0,0,0),
                    'bgcolor' => false,
                );
                $pdf->write2DBarcode($urlAlumno, 'QRCODE,H', 240, 150, 35, 35, $styleQR, 'N');
            }
        }

        $pdf->Output('Constancias_Grupo_' . $grupo->id . '.pdf', 'I');
    }
}
