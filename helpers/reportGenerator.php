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
        $image_file = $_SERVER['DOCUMENT_ROOT'] . 'build/img/logo-pdf.png';
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
        $tableWidth = 80; // Table width in percentage (adjusted to 80%)
        $vitalsWidth = 15; // Table width in percentage (you can keep this if needed)
        


        // Add a new page or use the existing one
        $pdf->AddPage();

        
        

        $tableHtml = '<table border="0" cellpadding="3" cellspacing="0" style="width:650px; border-collapse: separate; border: 3px solid black;">';

        // Sample data for the table using string concatenation
        $data = [
            ['<strong>Paciente:</strong> ' . $reporte->patient_id->patient_name . ' ' . $reporte->patient_id->patient_lastname1, '<strong>Fecha de Atencion:</strong> ' . $reporte->date_report],
            ['<strong>ID Paciente:</strong> ' . $reporte->patient_id->id_number, '<strong>Hora de Atencion:</strong> ' . $reporte->time_report],
            ['<strong>Genero:</strong> ' . ($reporte->patient_id->gender == 'male' ? 'Masculino' : 'Femenino') , '<strong>Lugar de Atencion:</strong> ' . $reporte->location],
            ['<strong>Fecha de Nacimiento:</strong> ' . $reporte->patient_id->dob, '<strong>Edad:</strong> ' . $reporte->age ],
            ['<strong>Nacionalidad:</strong> ' . $reporte->patient_id->nationality, '']
        ];

        // Loop through data and create rows
        foreach ($data as $index => $row) {
            $rowColor = '#fFF'; // Alternate colors for rows
            $tableHtml .= '<tr style="background-color: ' . $rowColor . ';">';

            // Set the border for the outer and dividing column
            $tableHtml .= '<td style="border-right: 1px solid black;">' . $row[0] . '</td>'; // Border for left column
            $tableHtml .= '<td style=" width:10px;"></td>'; // Border for right column
            $tableHtml .= '<td >' . $row[1] . '</td>'; // Border for right column
            
            $tableHtml .= '</tr>';
        }


        $tableHtml .= '</table>';
        
        
        $pdf->Cell(15, 0, '', 0, 0, 'C');
        
        
        $html =  $tableHtml ;
       
        $html .= '<div></div>';

        if ($reporte->time_1 || $reporte->time_2 || $reporte->time_3 || $reporte->time_4) {
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
            <table border="0" cellpadding="4" cellspacing="0">
                <thead>
                    <tr style="">
                        <th style="color: #0f3973; text-transform: uppercase; font-weight:bold; font-size:15px">ANTECEDENTES MEDICOS</th>
                    </tr>
                </thead>
                <tbody>
                    <tr >
                        <th style="">' . nl2br(htmlspecialchars($reporte->antecedentes)) . '</th>
                    </tr>
                </tbody>
            </table>
        </div>';
        }

        if ($reporte->motivo){
        $html .= '<div>
            <table border="0" cellpadding="4" cellspacing="0">
                <thead>
                    <tr style=";">
                        <th style="color: #0f3973; text-transform: uppercase; font-weight:bold; font-size:15px">MOTIVO DE CONSULTA</th>
                    </tr>
                </thead>
                <tbody>
                    <tr >
                        <th style="">' . nl2br(htmlspecialchars($reporte->motivo)) . '</th>
                    </tr>
                </tbody>
            </table>
        </div>';
        }


        if ($reporte->padecimiento){
        $html .= '<div>
            <table border="0" cellpadding="4" cellspacing="0">
                <thead>
                    <tr style="">
                        <th style="color: #0f3973; text-transform: uppercase; font-weight:bold; font-size:15px">PADECIMIENTO</th>
                    </tr>
                </thead>
                <tbody>
                    <tr >
                        <th style="">' . nl2br(htmlspecialchars($reporte->padecimiento)) . '</th>
                    </tr>
                </tbody>
            </table>
        </div>';
        }

        if ($reporte->objetivo){
        $html .= '<div>
            <table border="0" cellpadding="4" cellspacing="0">
                <thead>
                    <tr style="">
                        <th style="color: #0f3973; text-transform: uppercase; font-weight:bold; font-size:15px">OBJETIVO</th>
                    </tr>
                </thead>
                <tbody>
                    <tr >
                        <th style="">' . nl2br(htmlspecialchars($reporte->objetivo)) . '</th>
                    </tr>
                </tbody>
            </table>
        </div>';
        }

        if ($reporte->analisis){
        $html .= '<div>
            <table border="0" cellpadding="4" cellspacing="0">
                <thead>
                    <tr style="">
                        <th style="color: #0f3973; text-transform: uppercase; font-weight:bold; font-size:15px">ANALISIS</th>
                    </tr>
                </thead>
                <tbody>
                    <tr >
                        <th style="">' . nl2br(htmlspecialchars($reporte->analisis)) . '</th>
                    </tr>
                </tbody>
            </table>
        </div>';
        }

        if ($reporte->diagnostico){
        $html .= '<div>
            <table border="0" cellpadding="4" cellspacing="0">
                <thead>
                    <tr style="">
                        <th style="color: #0f3973; text-transform: uppercase; font-weight:bold; font-size:15px">DIAGNOSTICO</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td>';

        foreach ($reporte->diagnostico_array as $index => $diagnostico) {
            $html .= '' . ($index + 1) . '. ' . $diagnostico;
            if (count($reporte->diagnostico_array) > 1 && $index < count($reporte->diagnostico_array) - 1) {
                $html .= '<br />';
            }
        }

        $html .= '</td></tr>
                </tbody>
            </table>
        </div>';
        }

        if ($reporte->plan){
        $html .= '<div>
            <table border="0" cellpadding="4" cellspacing="0">
                <thead>
                    <tr style="">
                        <th style="color: #0f3973; text-transform: uppercase; font-weight:bold; font-size:15px">PLAN</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td>';

        foreach ($reporte->plan_array as $index => $plan) {
            $html .= '' . ($index + 1) . '. ' . $plan;
            
            if (count($reporte->plan_array) > 1 && $index < count($reporte->plan_array) - 1) {
                $html .= '<br />';
            }
        }

        $html .= '</td></tr>
                </tbody>
            </table>
        </div>';
        }

        $html .= '<br /><br /><br /><br /><div style=" font-size:18px; text-align: center;">' . $reporte->doctor->user_titulo->nombre .' ' . $reporte->doctor->nombre . ' <br />';
        $html .= '<span style="font-size: 12px;">' . $reporte->doctor->user_especialidad .'</span><br />';
        if ($reporte->doctor->user_codigo){
        $html .= '<span style="font-size: 12px;">' . 'Cod. ' . $reporte->doctor->user_codigo .'</span></div>';
        }

        
        
            
        
        
        // Output the HTML content
        $pdf->writeHTML($html);
        foreach($reporte->addendums as $addendum){
            $pdf->addPage();

            $tableHtmlAddendum = '<table border="0" cellpadding="3" cellspacing="0" style="width:650px; border-collapse: separate; border: 3px solid black;">';

            // Sample data for the table using string concatenation
            $dataAddendum = [
                ['<strong>Paciente:</strong> ' . $reporte->patient_id->patient_name . ' ' . $reporte->patient_id->patient_lastname1, '<strong>Fecha de Atencion:</strong> ' . $addendum->date_addendum],
                ['<strong>ID Paciente:</strong> ' . $reporte->patient_id->id_number, '<strong>Hora de Atencion:</strong> ' . $addendum->time_addendum],
                ['<strong>Genero:</strong> ' . ($reporte->patient_id->gender == 'male' ? 'Masculino' : 'Femenino') , '<strong>Lugar de Atencion:</strong> ' . $addendum->location],
                ['<strong>Fecha de Nacimiento:</strong> ' . $reporte->patient_id->dob, '<strong>Nacionalidad:</strong> ' . $reporte->patient_id->nationality],
            ];

            // Loop through data and create rows
            foreach ($dataAddendum as $index => $row) {
                $rowColor = '#FFF'; // Alternate colors for rows
                $tableHtmlAddendum .= '<tr style="background-color: ' . $rowColor . ';">';

                // Set the border for the outer and dividing column
                $tableHtmlAddendum .= '<td style=" border-right: 1px solid black;">' . $row[0] . '</td>'; // Border for left column
                $tableHtmlAddendum .= '<td style=" width:10px;"></td>'; // Border for right column
                $tableHtmlAddendum .= '<td >' . $row[1] . '</td>'; // Border for right column
                
                $tableHtmlAddendum .= '</tr>';
            }




            $tableHtmlAddendum .= '</table>';
            
            
            
            $pdf->Cell(15, 0, '', 0, 0, 'C');
            
            $html =  $tableHtmlAddendum ;
        
            $html .= '<div><h1 style="text-align: center;">Nota de Evolucion Medica</h1></div>';

            if ($addendum->time_1 || $addendum->time_2 || $addendum->time_3 || $addendum->time_4) {
                $html .= '<div><h2 style="color:#0f3973;">Signos Vitales</h2>';
                

                
                $html .= '
                    <table border="1" cellpadding="4" cellspacing="0" style="width:60%">
                        <tbody>
                            <tr>
                                <td width="60%" style="font-weight: bold;">Hora</td>
                                <td width="15%" style="text-align: center;">' . ($addendum->time_1 ? date("H:i", strtotime($addendum->time_1)) : $addendum->time_1) . '</td>
                                <td width="15%" style="text-align: center;">' . ($addendum->time_2 ? date("H:i", strtotime($addendum->time_2)) : $addendum->time_2) . '</td>
                                <td width="15%" style="text-align: center;">' . ($addendum->time_3 ? date("H:i", strtotime($addendum->time_3)) : $addendum->time_3) . '</td>
                                <td width="15%" style="text-align: center;">' . ($addendum->time_4 ? date("H:i", strtotime($addendum->time_4)) : $addendum->time_4) . '</td>
                            </tr>
                            <tr>
                                <td width="60%" style="font-weight: bold;">Pulso (lpm)</td>
                                <td width="15%" style="text-align: center;">' . $addendum->lpm_1 . '</td>
                                <td width="15%" style="text-align: center;">' . $addendum->lpm_2 . '</td>
                                <td width="15%" style="text-align: center;">' . $addendum->lpm_3 . '</td>
                                <td width="15%" style="text-align: center;">' . $addendum->lpm_4 . '</td>
                            </tr>
                            <tr>
                                <td width="60%" style="font-weight: bold;">Presion Arterial (mmHg)</td>
                                <td width="15%" style="text-align: center;">' . $addendum->mmhg_1 . '</td>
                                <td width="15%" style="text-align: center;">' . $addendum->mmhg_2 . '</td>
                                <td width="15%" style="text-align: center;">' . $addendum->mmhg_3 . '</td>
                                <td width="15%" style="text-align: center;">' . $addendum->mmhg_4 . '</td>
                            </tr>
                            <tr>
                                <td width="60%" style="font-weight: bold;">Frecuencia Respiratoria (rpm)</td>
                                <td width="15%" style="text-align: center;">' . $addendum->rpm_1 . '</td>
                                <td width="15%" style="text-align: center;">' . $addendum->rpm_2 . '</td>
                                <td width="15%" style="text-align: center;">' . $addendum->rpm_3 . '</td>
                                <td width="15%" style="text-align: center;">' . $addendum->rpm_4 . '</td>
                            </tr>
                            <tr>
                                <td width="60%" style="font-weight: bold;">Temperatura (°C)</td>
                                <td width="15%" style="text-align: center;">' . $addendum->temperature_1 . '</td>
                                <td width="15%" style="text-align: center;">' . $addendum->temperature_2 . '</td>
                                <td width="15%" style="text-align: center;">' . $addendum->temperature_3 . '</td>
                                <td width="15%" style="text-align: center;">' . $addendum->temperature_4 . '</td>
                            </tr>
                            <tr>
                                <td width="60%" style="font-weight: bold;">Saturación O₂%</td>
                                <td width="15%" style="text-align: center;">' . $addendum->saturation_1 . '</td>
                                <td width="15%" style="text-align: center;">' . $addendum->saturation_2 . '</td>
                                <td width="15%" style="text-align: center;">' . $addendum->saturation_3 . '</td>
                                <td width="15%" style="text-align: center;">' . $addendum->saturation_4 . '</td>
                            </tr>
                            <tr>
                                <td width="60%" style="font-weight: bold;">Glicemia (mg/dl)</td>
                                <td width="15%" style="text-align: center;">' . $addendum->mgdl_1 . '</td>
                                <td width="15%" style="text-align: center;">' . $addendum->mgdl_2 . '</td>
                                <td width="15%" style="text-align: center;">' . $addendum->mgdl_3 . '</td>
                                <td width="15%" style="text-align: center;">' . $addendum->mgdl_4 . '</td>
                            </tr>
                            <tr>
                                <td width="60%" style="font-weight: bold;">Glasgow (puntos)</td>
                                <td width="15%" style="text-align: center;">' . $addendum->glasgow_1 . '</td>
                                <td width="15%" style="text-align: center;">' . $addendum->glasgow_2 . '</td>
                                <td width="15%" style="text-align: center;">' . $addendum->glasgow_3 . '</td>
                                <td width="15%" style="text-align: center;">' . $addendum->glasgow_4 . '</td>
                            </tr>
                        </tbody>
                    </table></div>
                ';
            }
           
            if ($addendum->objetivo){
                $html .= '<div>
                    <table border="0" cellpadding="4" cellspacing="0">
                        <thead>
                            <tr style="">
                                <th style="color: #0f3973; text-transform: uppercase; font-weight:bold; font-size: 15px">OBJETIVO</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr >
                                <th style="">' . nl2br(htmlspecialchars($addendum->objetivo)) . '</th>
                            </tr>
                        </tbody>
                    </table>
                </div>';
            }

        if ($addendum->analisis){
            $html .= '<div>
                <table border="0" cellpadding="4" cellspacing="0">
                    <thead>
                        <tr style="">
                            <th style="color: #0f3973; text-transform: uppercase; font-weight:bold; font-size: 15px">ANALISIS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr >
                            <th style="">' . nl2br(htmlspecialchars($addendum->analisis)) . '</th>
                        </tr>
                    </tbody>
                </table>
            </div>';
        }

        if ($addendum->diagnostico){
            $html .= '<div>
                <table border="0" cellpadding="4" cellspacing="0">
                    <thead>
                        <tr style="">
                            <th style="color: #0f3973; text-transform: uppercase; font-weight:bold; font-size: 15px">DIAGNOSTICO</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr><td>';

            foreach ($addendum->diagnostico_array as $index => $diagnostico) {
                $html .= '' . ($index + 1) . '. ' . $diagnostico;
                if (count($addendum->diagnostico_array) > 1 && $index < count($addendum->diagnostico_array) - 1) {
                    $html .= '<br />';
                }
            }

            $html .= '</td></tr>
                    </tbody>
                </table>
            </div>';
        }

        if ($addendum->plan){
            $html .= '<div>
                <table border="0" cellpadding="4" cellspacing="0">
                    <thead>
                        <tr style="">
                            <th style="color: #0f3973; text-transform: uppercase; font-weight:bold; font-size: 15px">PLAN</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr><td>';

            foreach ($addendum->plan_array as $index => $plan) {
                $html .= '' . ($index + 1) . '. ' . $plan;
                
                if (count($addendum->plan_array) > 1 && $index < count($addendum->plan_array) - 1) {
                    $html .= '<br />';
                }
            }

            $html .= '</td></tr>
                    </tbody>
                </table>
            </div>';
        }

        $html .= '<br /><br /><br /><br /><div style=" font-size:18px; text-align: center;">' . $addendum->doctor->user_titulo->nombre .' ' . $addendum->doctor->nombre . ' <br />';
        $html .= '<span style="font-size: 12px;">' . $addendum->doctor->user_especialidad .'</span><br />';
        if($addendum->doctor->user_codigo){
        $html .= '<span style="font-size: 12px;">' . 'Cod. ' . $addendum->doctor->user_codigo .'</span></div>';
        }
            $pdf->writeHTML($html);
        }
        // Output the PDF as a string (for download)
        return $pdf->Output('Reporte Medico ' . $reporte->patient_id->patient_name . ' ' .$reporte->patient_id->patient_lastname1.'.pdf', 'I'); // 'I' for inline display, 'D' for download
    }
}