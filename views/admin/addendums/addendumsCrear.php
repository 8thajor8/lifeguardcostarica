<main class="contenedor seccion">

    <h1 class="heading_admin">Crear Addendum</h1>

    <a href="/reportes/expediente?id=<?php echo $reporte->id ?>" class="boton boton-azul"> Volver </a>

    <?php
        foreach($errores as $error):
    ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php
        endforeach;
    ?>

   
    <form class="formulario__appointments__admin" method="POST" >
        <input type="hidden" name="patient_id" id="patient_id" value="<?php echo $reporte->patient_id->id ?>">
        <input type="hidden" name="reporte_id" id="reporte_id" value="<?php echo $reporte->id ?>">
        <fieldset class="expediente_fieldset">
            <legend>Informacion del Reporte</legend>

            <div class="two-col">
                <div class="campo_appointments">
                    <label for="patient_name">Paciente:</label>
                    <p><?php echo s($reporte->patient_id->patient_name) . ' ' . s($reporte->patient_id->patient_lastname1); ?>" </p>
                </div>
                
                <div class="campo_appointments">
                    <label for="id_number">#Pasaporte o ID:</label>
                    <p><?php echo s($reporte->patient_id->id_number); ?></p>
                </div>
                
                <div class="campo_appointments">
                    <label for="doctor">Doctor:</label>
                    <p><?php echo ($reporte->doctor->user_titulo->nombre . ' ' . $reporte->doctor->nombre) ?></p>
                </div>
                
                <div class="campo_appointments">
                    <label for="doctor">Reporte#:</label>
                    <p><?php echo $reporte->id ?></p>
                </div>
            </div>
        </fieldset>

        
        <fieldset>
            <legend>Datos de Atencion</legend>

            <div class="two-col">
                <div class="campo_appointments">
                    <label for="date_addendum">Dia de Atencion:</label>
                    <input
                        type="date"
                        id="date_addendum"
                        name="date_addendum"
                        value="<?php echo s($addendum->date_addendum); ?>"
                    />
                </div>

                <div class="campo_appointments">
                    <label for="time_addendum">Hora de Atencion:</label>
                    <input type="time" id="time_addendum" name="time_addendum" value="<?php echo s($addendum->time_addendum); ?>" >
                </div>
            </div>
            
            <div class="campo_appointments">
                <label for="location">Lugar:</label>
                <input type="text" id="location" name="location" placeholder="Lugar de Atencion" value="<?php echo s($addendum->location); ?>" >
            </div>

        </fieldset>

        <div class="table_overflow">
            <fieldset >
                <legend>Signos Vitales</legend>

                <table>
                    <tbody>
                        <tr>
                            <th>Hora</th>
                            <td>
                                <div class="campo_appointments">  
                                    <input type="time" id="time_1" name="time_1" value="<?php echo s($addendum->time_1); ?>" >
                                </div>
                            </td>
                            <td>
                                <div class="campo_appointments">  
                                    <input type="time" id="time_2" name="time_2" value="<?php echo s($addendum->time_2); ?>" >
                                </div>
                            </td>
                            <td>
                                <div class="campo_appointments">  
                                    <input type="time" id="time_3" name="time_3" value="<?php echo s($addendum->time_3); ?>" >
                                </div>
                            </td>
                            <td>
                                <div class="campo_appointments">  
                                    <input type="time" id="time_4" name="time_4" value="<?php echo s($addendum->time_4); ?>" >
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>Pulso (lpm)</th>
                            <td>
                                <div class="campo_appointments">
                                    <input type="text" id="lpm_1" name="lpm_1"  value="<?php echo s($addendum->lpm_1); ?>" >
                                </div>
                            </td>
                            <td>
                                <div class="campo_appointments">
                                    <input type="text" id="lpm_2" name="lpm_2"  value="<?php echo s($addendum->lpm_2); ?>" >
                                </div>
                            </td>
                            <td>
                                <div class="campo_appointments">
                                    <input type="text" id="lpm_3" name="lpm_3"  value="<?php echo s($addendum->lpm_3); ?>" >
                                </div>
                            </td>
                            <td>
                                <div class="campo_appointments">
                                    <input type="text" id="lpm_4" name="lpm_4"  value="<?php echo s($addendum->lpm_4); ?>" >
                                </div>
                            </td>
                            
                        </tr>
                        <tr>
                            <th>Presion Arterial (mmHg)</th>
                                <td>
                                    <div class="campo_appointments">
                                        <input type="text" id="mmhg_1" name="mmhg_1"  value="<?php echo s($addendum->mmhg_1); ?>" >
                                    </div>
                                </td>
                                <td>
                                    <div class="campo_appointments">
                                        <input type="text" id="mmhg_2" name="mmhg_2"  value="<?php echo s($addendum->mmhg_2); ?>" >
                                    </div>
                                </td>
                                <td>
                                    <div class="campo_appointments">
                                        <input type="text" id="mmhg_3" name="mmhg_3"  value="<?php echo s($addendum->mmhg_3); ?>" >
                                    </div>
                                </td>
                                <td>
                                    <div class="campo_appointments">
                                        <input type="text" id="mmhg_4" name="mmhg_4"  value="<?php echo s($addendum->mmhg_4); ?>" >
                                    </div>
                                </td>
                        </tr>
                        <tr>
                            <th>Frecuencia Respiratoria (rpm)</th>
                                <td>
                                    <div class="campo_appointments">
                                        <input type="text" id="rpm_1" name="rpm_1"  value="<?php echo s($addendum->rpm_1); ?>" >
                                    </div>
                                </td>
                                <td>
                                    <div class="campo_appointments">
                                        <input type="text" id="rpm_2" name="rpm_2"  value="<?php echo s($addendum->rpm_2); ?>" >
                                    </div>
                                </td>
                                <td>
                                    <div class="campo_appointments">
                                        <input type="text" id="rpm_3" name="rpm_3"  value="<?php echo s($addendum->rpm_3); ?>" >
                                    </div>
                                </td>
                                <td>
                                    <div class="campo_appointments">
                                        <input type="text" id="rpm_4" name="rpm_4"  value="<?php echo s($addendum->rpm_4); ?>" >
                                    </div>
                                </td>
                        </tr>
                        <tr>
                            <th>Temperatura (°C)</th>
                                <td>
                                    <div class="campo_appointments">
                                        <input type="text" id="temperature_1" name="temperature_1"  value="<?php echo s($addendum->temperature_1); ?>" >
                                    </div>
                                </td>
                                <td>
                                    <div class="campo_appointments">
                                        <input type="text" id="temperature_2" name="temperature_2"  value="<?php echo s($addendum->temperature_2); ?>" >
                                    </div>
                                </td>
                                <td>
                                    <div class="campo_appointments">
                                        <input type="text" id="temperature_3" name="temperature_3"  value="<?php echo s($addendum->temperature_3); ?>" >
                                    </div>
                                </td>
                                <td>
                                    <div class="campo_appointments">
                                        <input type="text" id="temperature_4" name="temperature_4"  value="<?php echo s($addendum->temperature_4); ?>" >
                                    </div>
                                </td>
                        </tr>
                        <tr>
                            <th>Saturación O₂%</th>
                                <td>
                                    <div class="campo_appointments">
                                        <input type="text" id="saturation_1" name="saturation_1"  value="<?php echo s($addendum->saturation_1); ?>" >
                                    </div>
                                </td>
                                <td>
                                    <div class="campo_appointments">
                                        <input type="text" id="saturation_2" name="saturation_2"  value="<?php echo s($addendum->saturation_2); ?>" >
                                    </div>
                                </td>
                                <td>
                                    <div class="campo_appointments">
                                        <input type="text" id="saturation_3" name="saturation_3"  value="<?php echo s($addendum->saturation_3); ?>" >
                                    </div>
                                </td>
                                <td>
                                    <div class="campo_appointments">
                                        <input type="text" id="saturation_4" name="saturation_4"  value="<?php echo s($addendum->saturation_4); ?>" >
                                    </div>
                                </td>
                        </tr>
                        <tr>
                            <th>Glicemia (mg/dl)</th>
                                <td>
                                    <div class="campo_appointments">
                                        <input type="text" id="mgdl_1" name="mgdl_1"  value="<?php echo s($addendum->mgdl_1); ?>" >
                                    </div>
                                </td>
                                <td>
                                    <div class="campo_appointments">
                                        <input type="text" id="mgdl_2" name="mgdl_2"  value="<?php echo s($addendum->mgdl_2); ?>" >
                                    </div>
                                </td>
                                <td>
                                    <div class="campo_appointments">
                                        <input type="text" id="mgdl_3" name="mgdl_3"  value="<?php echo s($addendum->mgdl_3); ?>" >
                                    </div>
                                </td>
                                <td>
                                    <div class="campo_appointments">
                                        <input type="text" id="mgdl_4" name="mgdl_4"  value="<?php echo s($addendum->mgdl_4); ?>" >
                                    </div>
                                </td>
                        </tr>
                        <tr>
                            <th>Glasgow (puntos)</th>
                                <td>
                                    <div class="campo_appointments">
                                        <input type="text" id="glasgow_1" name="glasgow_1"  value="<?php echo s($addendum->glasgow_1); ?>" >
                                    </div>
                                </td>
                                <td>
                                    <div class="campo_appointments">
                                        <input type="text" id="glasgow_2" name="glasgow_2"  value="<?php echo s($addendum->glasgow_2); ?>" >
                                    </div>
                                </td>
                                <td>
                                    <div class="campo_appointments">
                                        <input type="text" id="glasgow_3" name="glasgow_3"  value="<?php echo s($addendum->glasgow_3); ?>" >
                                    </div>
                                </td>
                                <td>
                                    <div class="campo_appointments">
                                        <input type="text" id="glasgow_4" name="glasgow_4"  value="<?php echo s($addendum->glasgow_4); ?>" >
                                    </div>
                                </td>
                        </tr>
                        
                    </tbody>
                </table>

            </fieldset>
        </div>

        <fieldset>
            <legend>Datos Medicos</legend>

            <div class="campo_appointments">
                <label for="objetivo" >Objetivo:</label>
                <textarea name="objetivo" id="objetivo" rows="4"  ><?php echo s($addendum->objetivo); ?></textarea>
            </div>

            <div class="campo_appointments">
                <label for="analisis" >Analisis:</label>
                <textarea name="analisis" id="analisis" rows="4"  ><?php echo s($addendum->analisis); ?></textarea>
            </div>

            <div class="campo_appointments" >
                <label for="diagnostico[]">Diagnostico:</label>
                <div class="input_plus">
                    <input type="text" id="diagnostico" name="diagnostico[]" value="<?php echo s($addendum->diagnostico); ?>" />
                    <button type="button" id="addDiagnostico" onclick="(()=> diagnosticoField())();" >+</button>
                    
                </div>
                <!-- Container to hold new fields -->
                <div id="diagnosticoContainer"></div> 
            </div>

            <div class="campo_appointments" >
                <label for="plan[]">Plan:</label>
                <div class="input_plus">
                    <input type="text" id="plan" name="plan[]" value="<?php echo s($addendum->plan); ?>" />
                    <button type="button" id="addPlan" onclick="(()=> planField())();" >+</button>
                    
                </div>
                <!-- Container to hold new fields -->
                <div id="planContainer"></div> 
            </div>

        </fieldset>


        <fieldset>
            <legend>Datos Doctor</legend>

            <div class="campo_appointments">
                <label for="doctor">Doctor:</label>
                <select name="doctor" id="doctor">
                    <option value="" <?php echo ($addendum->doctor == '') ? 'selected' : ''; ?>>-- Seleccione Usuario --</option>
                    <?php foreach($usuarios as $usuario)  : ?>
                    
                        <option <?php echo $addendum->doctor === $usuario->id ? 'selected' : '' ?> value="<?php echo s($usuario->id); ?>"><?php echo s($usuario->nombre); ?></option>
                        
                    <?php endforeach; ?>
                </select>
            </div>

            

        </fieldset>

        <input type="submit" value="Crear Addendum" class="boton boton-azul">



    </form>

</main>