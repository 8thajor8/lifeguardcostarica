<fieldset id="paso-1" >
    <legend>Personal Information</legend>

    <div class="two-col">
        <div class="campo">
            <label for="name">First Name:</label>
            <input type="text" id="name" name="name" placeholder="Your first name" value="<?php echo s($appointment->name); ?>" >
        </div>
        
        <div class="campo">
            <label for="lastname1">Last Name 1:</label>
            <input type="text" id="lastname1" name="lastname1" placeholder="Your first last name" value="<?php echo s($appointment->lastname1); ?>" >
        </div>
        
        <div class="campo">
            <label for="lastname2">Last Name 2:</label>
            <input type="text" id="lastname2" name="lastname2" placeholder="Your second last name" value="<?php echo s($appointment->lastname2); ?>" >
        </div>
        
        <div class="campo">
            <label for="dob">Date of Birth:</label>
            <input type="date" id="dob" name="dob" value="<?php echo s($appointment->dob); ?>" >
        </div>
        
        <div class="campo">
            <label for="id_type">ID Type:</label>
            <select id="id_type" name="id_type">
                <option value="" <?php echo ($appointment->id_type == '') ? 'selected' : ''; ?>>-- Select your ID type --</option>
                <option value="passport" <?php echo ($appointment->id_type == 'passport') ? 'selected' : ''; ?>>Passport</option>
                <option value="costarica" <?php echo ($appointment->id_type == 'costarica') ? 'selected' : ''; ?>>Costa Rican</option>
                <option value="dimex" <?php echo ($appointment->id_type == 'dimex') ? 'selected' : ''; ?>>DIMEX (Resident)</option>
            </select>
        </div>
        
        <div class="campo">
            <label for="id_number">Passport or ID:</label>
            <input type="text" id="id_number" name="id_number" placeholder="Your ID number" value="<?php echo s($appointment->id_number); ?>" >
        </div>
        
        <div class="campo">
        <label for="gender">Gender:</label>
            <select id="gender" name="gender">
                <option value="" <?php echo ($appointment->gender == '') ? 'selected' : ''; ?>>-- Select your Gender --</option>
                <option value="male" <?php echo ($appointment->gender == 'male') ? 'selected' : ''; ?>>Male</option>
                <option value="female" <?php echo ($appointment->gender == 'female') ? 'selected' : ''; ?>>Female</option>
                
            </select>
        </div>
        
        <div class="campo">
            <label for="nationality">Nationality:</label>
            <input type="text" id="nationality" name="nationality" placeholder="Your Nationality" value="<?php echo s($appointment->nationality); ?>" >
        </div>
    </div>
</fieldset>

<fieldset id="paso-2">
    <legend>Contact Information & Location</legend>

    <div class="two-col">
        <div class="campo">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Your email" value="<?php echo s($appointment->email); ?>" >
        </div>
        
        <div class="campo">
            <label for="phone">Phone Number:</label>
            <input type="text" id="phone" name="phone" placeholder="Your phone number" value="<?php echo s($appointment->phone); ?>" >
        </div>
        
        <div class="campo">
            <label for="address">Address:</label>
            <input type="text" id="address" name="address" placeholder="Your street address" value="<?php echo s($appointment->address); ?>" >
        </div>
        
        <div class="campo">
            <label for="province">Province:</label>
            <input type="text" id="province" name="province" placeholder="Province" value="<?php echo s($appointment->province); ?>" >
        </div>
        
        <div class="campo">
            <label for="canton">Canton:</label>
            <input type="text" id="canton" name="canton" placeholder="Canton" value="<?php echo s($appointment->canton); ?>" >
        </div>
        
        <div class="campo">
            <label for="district">District:</label>
            <input type="text" id="district" name="district" placeholder="District" value="<?php echo s($appointment->district); ?>" >
        </div>
    </div>
    
    <div class="campo campo__check">
        <label for="housecall">Book as a HouseCall:</label>
        <input type="checkbox" id="housecall" name="housecall" <?php if ($appointment->housecall == 1) echo 'checked'; ?>>
    </div>

    <div id="housecall_fields" class="housecall_fields">
        <div class="two-col">
            <div class="campo">
                <label for="latitud">Latitude:</label>
                <input type="number" disabled id="latitud" name="latitud" value="<?php echo s($appointment->latitud); ?>" >
            </div>
            
            <div class="campo">
                <label for="longitud">Longitude:</label>
                <input type="number" disabled id="longitud" name="longitud" value="<?php echo s($appointment->longitud); ?>" >
            </div>
        </div>
            
        <div class="google_fields">
            <div class="campo">
                <label for="google_location">Google Maps Link:</label>
                <input type="text" id="google_location" placeholder="Insert your Google Maps Location Link here" name="google_location" value="<?php echo s($appointment->google_location); ?>" >
            </div>

            <button type="button" class="boton" id="convertBtn">Select Address</button>
        </div>
    </div>
    

</fieldset>

<fieldset id="paso-3">
    <legend>Medical Information</legend>
    
    <div class="two-col">
        <div class="campo">
            <label for="doses">Vaccine Doses:</label>
            <select id="doses" name="doses">
                <option value="" <?php echo ($appointment->doses == '') ? 'selected' : ''; ?>>-- Select your latest dose --</option>
                <option value="first_dose" <?php echo ($appointment->doses == 'first_dose') ? 'selected' : ''; ?>>First Dose</option>
                <option value="second_dose" <?php echo ($appointment->doses == 'second_dose') ? 'selected' : ''; ?>>Second Dose</option>
                <option value="third_dose" <?php echo ($appointment->doses == 'third_dose') ? 'selected' : ''; ?>>Third Booster Dose</option>
            </select>
        </div>
    </div>

    <div class="campo campo__check">
        <label for="have_symptoms">Do you currently have COVID-19 symptoms?</label>
        <input type="checkbox" id="have_symptoms" name="have_symptoms" <?php if ($appointment->have_symptoms == 1) echo 'checked'; ?>>
    </div>

    <div id="symptom_fields" class="two-col symptom_fields">
        <div class="campo">
            <label for="current_symptoms">Current Symptoms:</label>
            <input type="text" id="current_symptoms" name="current_symptoms" placeholder="Your Current Symptoms" value="<?php echo s($appointment->current_symptoms); ?>" >
        </div>
        

        <div class="campo">
            <label for="date_symptoms">When did the symptoms start?</label>
            <input
                type="date"
                min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>"
                id="date_symptoms"
                name="date_symptoms"
            />
        </div>
    </div>

    <div class="campo campo__check">
        <label for="proximity">Have you been in close proximity to a person who has tested positive for COVID-19 in the last 10 days?</label>
        <input type="checkbox" id="proximity" name="proximity"  <?php if ($appointment->proximity == 1) echo 'checked'; ?>>
    </div>
    
    <div class="campo campo__check">
        <label for="quarantined">Are you getting tested after being quarantined due to COVID-19?</label>
        <input type="checkbox" id="quarantined" name="quarantined"  <?php if ($appointment->quarantined == 1) echo 'checked'; ?>>
    </div>
    
    <div class="campo">
        <label for="conditions">Medical conditions or chronic diseases</label>
        <input type="text" id="conditions" name="conditions" value="<?php echo s($appointment->conditions); ?>" >
    </div>
</fieldset>

<fieldset id="paso-4">
    <legend>Appointment</legend>

    <div class="campo">
        <label for="date_appointment">Day of Appointment:</label>
        <input
            type="date"
            min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>"
            id="date_appointment"
            name="date_appointment"
        />
    </div>
    
    <div class="campo">
        <label for="location_appointment">Location:</label>
        <select id="location_appointment" name="location_appointment">
            <option value="" <?php echo ($appointment->location_appointment == '') ? 'selected' : ''; ?>>-- Select your desired location --</option>
            <option value="moneteverde" <?php echo ($appointment->location_appointment == 'monteverde') ? 'selected' : ''; ?>>Monteverde</option>
            <option value="cobano" <?php echo ($appointment->location_appointment == 'cobano') ? 'selected' : ''; ?>>Cobano</option>
            <option value="santateresa" <?php echo ($appointment->location_appointment == 'santateresa') ? 'selected' : ''; ?>>Santa Teresa</option>
        </select>
    </div>

    <div class="campo">
        <label for="time_appointment">Time of Appointment:</label>
        <input type="time" id="time_appointment" name="time_appointment" min="08:00" max="16:30" step="1800" value="<?php echo s($appointment->time_appointment); ?>" >
    </div>
</fieldset>


       