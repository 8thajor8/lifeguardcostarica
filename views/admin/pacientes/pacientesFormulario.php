<fieldset>
    <legend>Informacion del Paciente</legend>

    <div class="two-col">
        <div class="campo_appointments">
            <label for="patient_name">Nombre:</label>
            <input type="text" id="patient_name" name="patient_name" placeholder="Nombre del Paciente" value="<?php echo s($paciente->patient_name); ?>" >
        </div>
        
        <div class="campo_appointments">
            <label for="patient_lastname1">Apellido 1:</label>
            <input type="text" id="patient_lastname1" name="patient_lastname1" placeholder="Primer Appellido del Paciente" value="<?php echo s($paciente->patient_lastname1); ?>" >
        </div>
        
        <div class="campo_appointments">
            <label for="patient_lastname2">Apellido 2:</label>
            <input type="text" id="patient_lastname2" name="patient_lastname2" placeholder="Segundo Appellido del Paciente" value="<?php echo s($paciente->patient_lastname2); ?>" >
        </div>
        
        <div class="campo_appointments">
            <label for="dob">Fecha Nac.:</label>
            <input type="date" id="dob" name="dob" value="<?php echo s($paciente->dob); ?>" >
        </div>
    </div>
    
    <div class="two-col">
        <div class="campo_appointments">
            <label for="id_type">Tipo ID:</label>
            <select id="id_type" name="id_type">
                <option value="" <?php echo ($paciente->id_type == '') ? 'selected' : ''; ?>>-- Seleccione Tipo de ID --</option>
                <option value="passport" <?php echo ($paciente->id_type == 'passport') ? 'selected' : ''; ?>>Passport</option>
                <option value="costarica" <?php echo ($paciente->id_type == 'costarica') ? 'selected' : ''; ?>>Costa Rica</option>
                <option value="dimex" <?php echo ($paciente->id_type == 'dimex') ? 'selected' : ''; ?>>DIMEX (Resident)</option>
            </select>
        </div>
        
        <div class="campo_appointments">
            <label for="id_number">#Pasaporte o ID:</label>
            <input type="text" id="id_number" name="id_number" placeholder="Numero ID" value="<?php echo s($paciente->id_number); ?>" >
        </div>
        
        <div class="campo_appointments">
        <label for="gender">Genero:</label>
            <select id="gender" name="gender">
                <option value="" <?php echo ($paciente->gender == '') ? 'selected' : ''; ?>>-- Seleccione Genero --</option>
                <option value="male" <?php echo ($paciente->gender == 'male') ? 'selected' : ''; ?>>Masculino</option>
                <option value="female" <?php echo ($paciente->gender == 'female') ? 'selected' : ''; ?>>Femenino</option>
                
            </select>
        </div>
        
        <div class="campo_appointments">
            <label for="nationality">Nacionalidad:</label>
            <input type="text" id="nationality" name="nationality" placeholder="Nacionalidad del Paciente" value="<?php echo s($paciente->nationality); ?>" >
        </div>
    </div>
        
    <div class="two-col">
        <div class="campo_appointments">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Email de Contacto" value="<?php echo s($paciente->email); ?>" >
        </div>
        
        <div class="campo_appointments">
            <label for="phone">Telefono:</label>
            <input type="text" id="phone" name="phone" placeholder="Telefono de Contacto" value="<?php echo s($paciente->phone); ?>" >
        </div>

        <div class="campo_appointments">
            <label for="city">Ciudad de Origen:</label>
            <input type="text" id="city" name="city" placeholder="Ciudad de Origen del Paciente" value="<?php echo s($paciente->city); ?>" >
        </div>
        
        <div class="campo_appointments">
            <label for="country">Pais de Origen:</label>
            <input type="text" id="country" name="country" placeholder="Pais de Origen del Paciente" value="<?php echo s($paciente->country); ?>" >
        </div>
    </div>
</fieldset>