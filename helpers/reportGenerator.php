<?php

namespace Helper;

use TCPDF;

class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        
        // Get the width of the page
        $pageWidth = $this->getPageWidth();
        
        // Define the image width
        $imageWidth = 70; // You can adjust this based on your image dimensions
        
        // Calculate the x position to center the image
        $xPosition = ($pageWidth - $imageWidth) / 2; 

           // Logo
        $image_file = $_SERVER['DOCUMENT_ROOT'] . 'build/img/logo.png';
        if (!file_exists($image_file)) {
            die("Logo image not found at: " . $image_file);
        }
        $this->Image($image_file, $xPosition, 10, $imageWidth, '', 'PNG', '', 'C', false, 300, '', false, false, 0, false, false, false);
        // Set font
        $this->SetFont('helvetica', 'B', 20);
        
    }
}


class reportGenerator
{
    public function generateReportPDF($reporte)
    {

        
        // Initialize TCPDF and set properties
        $pdf = new MYPDF();
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('LifeGuard Costa Rica');
        $pdf->SetTitle('Reporte Médico #' . $reporte->id);
        $pdf->SetSubject('Reporte Médico');
        $pdf->SetKeywords('TCPDF, PDF, reporte, medical');

        // Set default header and footer data
        $pdf->setHeaderData(PDF_HEADER_LOGO, 30, 'Reporte Médico', "Paciente: {$reporte->patient_id->patient_name} {$reporte->patient_id->patient_lastname1}");
        $pdf->SetMargins(15, 40, 15);
        // Add a page
        $tableWidth = 10; // Table width in percentage
        $vitalsWidth = 15; // Table width in percentage
        $tableCellWidth = $pdf->getPageWidth() * ($tableWidth / 100); // Get the actual width based on the page size

        // Add a new page or use the existing one
        $pdf->AddPage();


        

        $tableHtml = '<table border="0" cellpadding="3" cellspacing="0" style="width: 90%; margin: 10px 50px; border-collapse: collapse;">';

        // Sample data for the table using string concatenation
        $data = [
            ['<strong>Paciente:</strong> ' . $reporte->patient_id->patient_name . ' ' . $reporte->patient_id->patient_lastname1, '<strong>Fecha de Atencion:</strong> ' . $reporte->date_report],
            ['<strong>ID Paciente:</strong> ' . $reporte->patient_id->id_number, '<strong>Hora de Atencion:</strong> ' . $reporte->time_report],
            ['<strong>Genero:</strong> ' . ($reporte->patient_id->gender == 'male' ? 'Masculino' : 'Femenino') , '<strong>Lugar de Atencion:</strong> ' . $reporte->location],
            ['<strong>Fecha de Nacimiento:</strong> ' . $reporte->patient_id->dob, '<strong>Nacionalidad:</strong> ' . $reporte->patient_id->nationality],
        ];

        // Loop through data and create rows
        foreach ($data as $index => $row) {
            $rowColor = ($index % 2 == 0) ? '#e6f7ff' : '#f9f9f9'; // Alternate colors for rows
            $tableHtml .= '<tr style="background-color: ' . $rowColor . ';">';

            // Set the border for the outer and dividing column
            $tableHtml .= '<td style=" border-right: 1px solid black;">' . $row[0] . '</td>'; // Border for left column
            $tableHtml .= '<td >' . $row[1] . '</td>'; // Border for right column
            
            $tableHtml .= '</tr>';
        }


        $tableHtml .= '</table>';
        
        
        
        $pdf->Cell($tableCellWidth, 0, '', 0, 0, 'C');
        
        $html =  $tableHtml ;
       
        $html .= '<div></div>';

        if ($reporte->time_1 || $reporte->time_2 || $reporte->time_3 || $reporte->time_4) {
            $html .= '<div><h2 style="color:#0f3973;">Signos Vitales</h2>';
            $html .= '<div><h2 style="color:#0f3973;">Signos Vitales</h2>';

            
            $html .= '
                <table border="1" cellpadding="4" cellspacing="0" style="width:60%">
                    <tbody>
                        <tr>
                            <td width="60%" style="font-weight: bold;">Hora</td>
                            <td width="15%" style="text-align: center;">' . ($reporte->time_1 ? date("H:i", strtotime($reporte->time_1)) : $reporte->time_1) . '</td>
                            <td width="15%" style="text-align: center;">' . ($reporte->time_2 ? date("H:i", strtotime($reporte->time_2)) : $reporte->time_2) . '</td>
                            <td width="15%" style="text-align: center;">' . ($reporte->time_3 ? date("H:i", strtotime($reporte->time_3)) : $reporte->time_3) . '</td>
                            <td width="15%" style="text-align: center;">' . ($reporte->time_4 ? date("H:i", strtotime($reporte->time_4)) : $reporte->time_4) . '</td>
                        </tr>
                        <tr>
                            <td width="60%" style="font-weight: bold;">Pulso (lpm)</td>
                            <td width="15%" style="text-align: center;">' . $reporte->lpm_1 . '</td>
                            <td width="15%" style="text-align: center;">' . $reporte->lpm_2 . '</td>
                            <td width="15%" style="text-align: center;">' . $reporte->lpm_3 . '</td>
                            <td width="15%" style="text-align: center;">' . $reporte->lpm_4 . '</td>
                        </tr>
                        <tr>
                            <td width="60%" style="font-weight: bold;">Presion Arterial (mmHg)</td>
                            <td width="15%" style="text-align: center;">' . $reporte->mmhg_1 . '</td>
                            <td width="15%" style="text-align: center;">' . $reporte->mmhg_2 . '</td>
                            <td width="15%" style="text-align: center;">' . $reporte->mmhg_3 . '</td>
                            <td width="15%" style="text-align: center;">' . $reporte->mmhg_4 . '</td>
                        </tr>
                        <tr>
                            <td width="60%" style="font-weight: bold;">Frecuencia Respiratoria (rpm)</td>
                            <td width="15%" style="text-align: center;">' . $reporte->rpm_1 . '</td>
                            <td width="15%" style="text-align: center;">' . $reporte->rpm_2 . '</td>
                            <td width="15%" style="text-align: center;">' . $reporte->rpm_3 . '</td>
                            <td width="15%" style="text-align: center;">' . $reporte->rpm_4 . '</td>
                        </tr>
                        <tr>
                            <td width="60%" style="font-weight: bold;">Temperatura (°C)</td>
                            <td width="15%" style="text-align: center;">' . $reporte->temperature_1 . '</td>
                            <td width="15%" style="text-align: center;">' . $reporte->temperature_2 . '</td>
                            <td width="15%" style="text-align: center;">' . $reporte->temperature_3 . '</td>
                            <td width="15%" style="text-align: center;">' . $reporte->temperature_4 . '</td>
                        </tr>
                        <tr>
                            <td width="60%" style="font-weight: bold;">Saturación O₂%</td>
                            <td width="15%" style="text-align: center;">' . $reporte->saturation_1 . '</td>
                            <td width="15%" style="text-align: center;">' . $reporte->saturation_2 . '</td>
                            <td width="15%" style="text-align: center;">' . $reporte->saturation_3 . '</td>
                            <td width="15%" style="text-align: center;">' . $reporte->saturation_4 . '</td>
                        </tr>
                        <tr>
                            <td width="60%" style="font-weight: bold;">Glicemia (mg/dl)</td>
                            <td width="15%" style="text-align: center;">' . $reporte->mgdl_1 . '</td>
                            <td width="15%" style="text-align: center;">' . $reporte->mgdl_2 . '</td>
                            <td width="15%" style="text-align: center;">' . $reporte->mgdl_3 . '</td>
                            <td width="15%" style="text-align: center;">' . $reporte->mgdl_4 . '</td>
                        </tr>
                        <tr>
                            <td width="60%" style="font-weight: bold;">Glasgow (puntos)</td>
                            <td width="15%" style="text-align: center;">' . $reporte->glasgow_1 . '</td>
                            <td width="15%" style="text-align: center;">' . $reporte->glasgow_2 . '</td>
                            <td width="15%" style="text-align: center;">' . $reporte->glasgow_3 . '</td>
                            <td width="15%" style="text-align: center;">' . $reporte->glasgow_4 . '</td>
                        </tr>
                    </tbody>
                </table></div>
            ';
        }

        
        if ($reporte->antecedentes){
        $html .= '<div>
            <table border="1" cellpadding="4" cellspacing="0">
                <thead>
                    <tr style="background-color: #0f3973;">
                        <th style="color: white; text-align: center; text-transform: uppercase; font-weight:bold">ANTECEDENTES MEDICOS</th>
                    </tr>
                </thead>
                <tbody>
                    <tr >
                        <th style="">' . $reporte->antecedentes . '</th>
                    </tr>
                </tbody>
            </table>
        </div>';
        }

        if ($reporte->motivo){
        $html .= '<div>
            <table border="1" cellpadding="4" cellspacing="0">
                <thead>
                    <tr style="background-color: #0f3973;">
                        <th style="color: white; text-align: center; text-transform: uppercase; font-weight:bold">MOTIVO DE CONSULTA</th>
                    </tr>
                </thead>
                <tbody>
                    <tr >
                        <th style="">' . $reporte->motivo . '</th>
                    </tr>
                </tbody>
            </table>
        </div>';
        }


        if ($reporte->padecimiento){
        $html .= '<div>
            <table border="1" cellpadding="4" cellspacing="0">
                <thead>
                    <tr style="background-color: #0f3973;">
                        <th style="color: white; text-align: center; text-transform: uppercase; font-weight:bold">PADECIMIENTO</th>
                    </tr>
                </thead>
                <tbody>
                    <tr >
                        <th style="">' . $reporte->padecimiento . '</th>
                    </tr>
                </tbody>
            </table>
        </div>';
        }

        if ($reporte->objetivo){
        $html .= '<div>
            <table border="1" cellpadding="4" cellspacing="0">
                <thead>
                    <tr style="background-color: #0f3973;">
                        <th style="color: white; text-align: center; text-transform: uppercase; font-weight:bold">OBJETIVO</th>
                    </tr>
                </thead>
                <tbody>
                    <tr >
                        <th style="">' . $reporte->objetivo . '</th>
                    </tr>
                </tbody>
            </table>
        </div>';
        }

        if ($reporte->analisis){
        $html .= '<div>
            <table border="1" cellpadding="4" cellspacing="0">
                <thead>
                    <tr style="background-color: #0f3973;">
                        <th style="color: white; text-align: center; text-transform: uppercase; font-weight:bold">ANALISIS</th>
                    </tr>
                </thead>
                <tbody>
                    <tr >
                        <th style="">' . $reporte->analisis . '</th>
                    </tr>
                </tbody>
            </table>
        </div>';
        }

        if ($reporte->diagnostico){
        $html .= '<div>
            <table border="1" cellpadding="4" cellspacing="0">
                <thead>
                    <tr style="background-color: #0f3973;">
                        <th style="color: white; text-align: center; text-transform: uppercase; font-weight:bold">DIAGNOSTICO</th>
                    </tr>
                </thead>
                <tbody>
                    <tr >
                        <th style="">' . $reporte->diagnostico . '</th>
                    </tr>
                </tbody>
            </table>
        </div>';
        }

        if ($reporte->plan){
        $html .= '<div>
            <table border="1" cellpadding="4" cellspacing="0">
                <thead>
                    <tr style="background-color: #0f3973;">
                        <th style="color: white; text-align: center; text-transform: uppercase; font-weight:bold">PLAN</th>
                    </tr>
                </thead>
                <tbody>
                    <tr >
                        <th style="">' . $reporte->plan . '</th>
                    </tr>
                </tbody>
            </table>
        </div>';
        }

        $html .= '<br /><br /><br /><br /><div style=" font-size:18px; text-align: center;">' . $reporte->doctor->user_titulo->nombre .' ' . $reporte->doctor->nombre . ' <br />';
        $html .= '<span style="font-size: 12px;">' . $reporte->doctor->user_especialidad .'</span><br />';
        $html .= '<span style="font-size: 12px;">' . 'Cod. ' . $reporte->doctor->user_codigo .'</span></div>';
        // Output the HTML content
        $pdf->writeHTML($html);

        // Output the PDF as a string (for download)
        return $pdf->Output('reporte_' . $reporte->id . '.pdf', 'I'); // 'I' for inline display, 'D' for download
    }
}