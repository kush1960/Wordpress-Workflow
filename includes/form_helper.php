<?php
class Form_Helper {

	private $fields;
	private $errors = array();
	private $form_options = array(
		'method' => 'post',
		'action' => '',
		'form_id'	=> '',
		'wrapper_class' => 'field_wrapper',
		'wrapper_element' => '',
		'wrapper_element_close' => '</div>',
		'submit_label' => '',
		'attributes' => array(),
		'footer_html' => '',
		'splitcols' => false,
		'security'	=> array(),
		'honeypot_alert' => false,
		'auto-fill-values'	=> array(),
		'language'	=> '',
		'anchor_point'	=> ''
	);

	public $countries = array(
		"GB"=>"United Kingdom",
		"AF"=>"Afghanistan",
		"AX"=>"Aland Islands",
		"AL"=>"Albania",
		"DZ"=>"Algeria",
		"AS"=>"American Samoa",
		"AD"=>"Andorra",
		"AO"=>"Angola",
		"AI"=>"Anguilla",
		"AQ"=>"Antarctica",
		"AG"=>"Antigua And Barbuda",
		"AR"=>"Argentina",
		"AM"=>"Armenia",
		"AW"=>"Aruba",
		"AU"=>"Australia",
		"AT"=>"Austria",
		"AZ"=>"Azerbaijan",
		"BS"=>"Bahamas",
		"BH"=>"Bahrain",
		"BD"=>"Bangladesh",
		"BB"=>"Barbados",
		"BY"=>"Belarus",
		"BE"=>"Belgium",
		"BZ"=>"Belize",
		"BJ"=>"Benin",
		"BM"=>"Bermuda",
		"BT"=>"Bhutan",
		"BO"=>"Bolivia, Plurinational State Of",
		"BQ"=>"Bonaire, Sint Eustatius And Saba",
		"BA"=>"Bosnia And Herzegovina",
		"BW"=>"Botswana",
		"BV"=>"Bouvet Island",
		"BR"=>"Brazil",
		"IO"=>"British Indian Ocean Territory",
		"BN"=>"Brunei Darussalam",
		"BG"=>"Bulgaria",
		"BF"=>"Burkina Faso",
		"BI"=>"Burundi",
		"KH"=>"Cambodia",
		"CM"=>"Cameroon",
		"CA"=>"Canada",
		"CV"=>"Cape Verde",
		"KY"=>"Cayman Islands",
		"CF"=>"Central African Republic",
		"TD"=>"Chad",
		"CL"=>"Chile",
		"CN"=>"China",
		"CX"=>"Christmas Island",
		"CC"=>"Cocos (KEELING) Islands",
		"CO"=>"Colombia",
		"KM"=>"Comoros",
		"CG"=>"Congo",
		"CD"=>"Congo, The Democratic Republic Of The",
		"CK"=>"Cook Islands",
		"CR"=>"Costa Rica",
		"CI"=>"Côte d'Ivoire",
		"HR"=>"Croatia",
		"CU"=>"Cuba",
		"CW"=>"Curaçao",
		"CY"=>"Cyprus",
		"CZ"=>"Czech Republic",
		"DK"=>"Denmark",
		"DJ"=>"Djibouti",
		"DM"=>"Dominica",
		"DO"=>"Dominican Republic",
		"EC"=>"Ecuador",
		"EG"=>"Egypt",
		"SV"=>"El Salvador",
		"GQ"=>"Equatorial Guinea",
		"ER"=>"Eritrea",
		"EE"=>"Estonia",
		"ET"=>"Ethiopia",
		"FK"=>"Falkland Islands",
		"FO"=>"Faroe Islands",
		"FJ"=>"Fiji",
		"FI"=>"Finland",
		"FR"=>"France",
		"GF"=>"French Guiana",
		"PF"=>"French Polynesia",
		"TF"=>"French Southern Territories",
		"GA"=>"Gabon",
		"GM"=>"Gambia",
		"GE"=>"Georgia",
		"DE"=>"Germany",
		"GH"=>"Ghana",
		"GI"=>"Gibraltar",
		"GR"=>"Greece",
		"GL"=>"Greenland",
		"GD"=>"Grenada",
		"GP"=>"Guadeloupe",
		"GU"=>"Guam",
		"GT"=>"Guatemala",
		"GG"=>"Guernsey",
		"GN"=>"Guinea",
		"GW"=>"Guinea-Bissau",
		"GY"=>"Guyana",
		"HT"=>"Haiti",
		"HM"=>"Heard Island And Mcdonald Islands",
		"VA"=>"Holy See (VATICAN City State)",
		"HN"=>"Honduras",
		"HK"=>"Hong Kong",
		"HU"=>"Hungary",
		"IS"=>"Iceland",
		"IN"=>"India",
		"ID"=>"Indonesia",
		"IR"=>"Iran, Islamic Republic Of",
		"IQ"=>"Iraq",
		"IE"=>"Ireland",
		"IM"=>"Isle Of Man",
		"IL"=>"Israel",
		"IT"=>"Italy",
		"JM"=>"Jamaica",
		"JP"=>"Japan",
		"JE"=>"Jersey",
		"JO"=>"Jordan",
		"KZ"=>"Kazakhstan",
		"KE"=>"Kenya",
		"KI"=>"Kiribati",
		"KP"=>"Korea, Democratic People's Republic Of",
		"KR"=>"Korea, Republic Of",
		"KW"=>"Kuwait",
		"KG"=>"Kyrgyzstan",
		"LA"=>"Lao People's Democratic Republic",
		"LV"=>"Latvia",
		"LB"=>"Lebanon",
		"LS"=>"Lesotho",
		"LR"=>"Liberia",
		"LY"=>"Libya",
		"LI"=>"Liechtenstein",
		"LT"=>"Lithuania",
		"LU"=>"Luxembourg",
		"MO"=>"Macao",
		"MK"=>"Macedonia, The Former Yugoslav Republic Of",
		"MG"=>"Madagascar",
		"MW"=>"Malawi",
		"MY"=>"Malaysia",
		"MV"=>"Maldives",
		"ML"=>"Mali",
		"MT"=>"Malta",
		"MH"=>"Marshall Islands",
		"MQ"=>"Martinique",
		"MR"=>"Mauritania",
		"MU"=>"Mauritius",
		"YT"=>"Mayotte",
		"MX"=>"Mexico",
		"FM"=>"Micronesia, Federated States Of",
		"MD"=>"Moldova, Republic Of",
		"MC"=>"Monaco",
		"MN"=>"Mongolia",
		"ME"=>"Montenegro",
		"MS"=>"Montserrat",
		"MA"=>"Morocco",
		"MZ"=>"Mozambique",
		"MM"=>"Myanmar",
		"NA"=>"Namibia",
		"NR"=>"Nauru",
		"NP"=>"Nepal",
		"NL"=>"Netherlands",
		"NC"=>"New Caledonia",
		"NZ"=>"New Zealand",
		"NI"=>"Nicaragua",
		"NE"=>"Niger",
		"NG"=>"Nigeria",
		"NU"=>"Niue",
		"NF"=>"Norfolk Island",
		"MP"=>"Northern Mariana Islands",
		"NO"=>"Norway",
		"OM"=>"Oman",
		"PK"=>"Pakistan",
		"PW"=>"Palau",
		"PS"=>"Palestinian Territory, Occupied",
		"PA"=>"Panama",
		"PG"=>"Papua New Guinea",
		"PY"=>"Paraguay",
		"PE"=>"Peru",
		"PH"=>"Philippines",
		"PN"=>"Pitcairn",
		"PL"=>"Poland",
		"PT"=>"Portugal",
		"PR"=>"Puerto Rico",
		"QA"=>"Qatar",
		"RE"=>"Réunion",
		"RO"=>"Romania",
		"RU"=>"Russian Federation",
		"RW"=>"Rwanda",
		"BL"=>"Saint Barthélemy",
		"SH"=>"Saint Helena, Ascension And Tristan Da Cunha",
		"KN"=>"Saint Kitts And Nevis",
		"LC"=>"Saint Lucia",
		"MF"=>"Saint Martin (FRENCH Part)",
		"PM"=>"Saint Pierre And Miquelon",
		"VC"=>"Saint Vincent And The Grenadines",
		"WS"=>"Samoa",
		"SM"=>"San Marino",
		"ST"=>"Sao Tome And Principe",
		"SA"=>"Saudi Arabia",
		"SN"=>"Senegal",
		"RS"=>"Serbia",
		"SC"=>"Seychelles",
		"SL"=>"Sierra Leone",
		"SG"=>"Singapore",
		"SX"=>"Sint Maarten (DUTCH Part)",
		"SK"=>"Slovakia",
		"SI"=>"Slovenia",
		"SB"=>"Solomon Islands",
		"SO"=>"Somalia",
		"ZA"=>"South Africa",
		"GS"=>"South Georgia And The South Sandwich Islands",
		"SS"=>"South Sudan",
		"ES"=>"Spain",
		"LK"=>"Sri Lanka",
		"SD"=>"Sudan",
		"SR"=>"Suriname",
		"SJ"=>"Svalbard And Jan Mayen",
		"SZ"=>"Swaziland",
		"SE"=>"Sweden",
		"CH"=>"Switzerland",
		"SY"=>"Syrian Arab Republic",
		"TW"=>"Taiwan, Province Of China",
		"TJ"=>"Tajikistan",
		"TZ"=>"Tanzania, United Republic Of",
		"TH"=>"Thailand",
		"TL"=>"Timor-Leste",
		"TG"=>"Togo",
		"TK"=>"Tokelau",
		"TO"=>"Tonga",
		"TT"=>"Trinidad And Tobago",
		"TN"=>"Tunisia",
		"TR"=>"Turkey",
		"TM"=>"Turkmenistan",
		"TC"=>"Turks And Caicos Islands",
		"TV"=>"Tuvalu",
		"UG"=>"Uganda",
		"UA"=>"Ukraine",
		"AE"=>"United Arab Emirates",
		"US"=>"United States",
		"UM"=>"United States Minor Outlying Islands",
		"UY"=>"Uruguay",
		"UZ"=>"Uzbekistan",
		"VU"=>"Vanuatu",
		"VE"=>"Venezuela, Bolivarian Republic Of",
		"VN"=>"Viet Nam",
		"VG"=>"Virgin Islands, British",
		"VI"=>"Virgin Islands, U.S.",
		"WF"=>"Wallis And Futuna",
		"EH"=>"Western Sahara",
		"YE"=>"Yemen",
		"ZM"=>"Zambia",
		"ZW"=>"Zimbabwe"
	);

	public function __construct($form_options = null) {
		if($form_options) {
			foreach($form_options as $key => $option) {
				$this->form_options[$key] = $option;
			}
		}
	}

	public function set_fields($fields) {
		foreach($fields as $field) {
			$this->add_field($field['name'], $field['label'], $field['type'], $field['options']);
		}
	}


	public function generate_numbers ()
	{
		$this->form_options['security'][] = rand(1, 9);
		$this->form_options['security'][] = rand(1, 9);
	}


	public function add_field($name, $label, $type, $options = null) {
		if($this->fields != null && array_key_exists($name, $this->fields)) {
			throw new Exception('Duplicate field name \'' . $name . '\' not allowed');
		}

		$this->fields[$name] = array(
			'name' => $name,
			'label' => $label,
			'type' => $type,
			'options' => $options
		);
	}

	public function display() 
	{

		$attr = '';

		if(!empty($this->form_options['attributes'])) {
			foreach($this->form_options['attributes'] as $key => $attribute) 
			{

				// Check for class attr and status of validation
				if ( $key == 'class' && $this->get_errors() )
				{
					// Add error class to form element.
					$attr .= ' ' . $key . '="' . $attribute . ' has-errors"';					
				}

				$attr .= ' ' . $key . '="' . $attribute . '"';
			}
		}


		/* Are there any errors? */
		$error = $this->get_errors();
		$errors = array_filter($error);
		if (!empty($errors)) 
		{
			echo '<p class="error-alert">We\'re sorry, there\'s a problem submitting your enquiry. Please check you\'ve completed all of the mandatory fields and try again.</p>';
		}

		echo '<form method="' . $this->form_options['method'] . '" enctype="multipart/form-data" action="' . $this->form_options['action'] . ( $this->form_options['anchor_point'] ? $this->form_options['anchor_point'] : null ) . '"' . $attr . '>';

			$this->display_fields();

			echo '<input type="hidden" name="form-id" value="'. $this->form_options['form-id'] .'" />';

		echo '<div class="clear"></div></form>';

	}

	public function display_fields() {
		
		$i = 0;


		foreach($this->fields as $field) {


			if ($field['options']["wrapper_element"] ){
				echo $field['options']["wrapper_element"];
			}


			if($this->form_options['splitcols'] !== false && $i == 0) {
				echo '<div class="col1">';
			}

			$extras = null;

			if(isset($field['options']['max'])) {
				$extras .= ' maxlength="' . $field['options']['max'] . '"';
			}

			if(isset($field['options']['class'])) {
				$extras .= ' class="' . $field['options']['class'] . '"';
			}

			if(isset($field['options']['placeholder'])) {
				$extras .= ' placeholder="' . $field['options']['placeholder'] . '"';
			}

			if(isset($field['options']['rows'])) {
				$extras .= ' rows="' . $field['options']['rows'] . '"';
			}

			switch($field['type']) {

				case 'text' :
				case 'email' :
				case 'tel' :

					echo '<div class="' . $this->form_options['wrapper_class'] . (isset($field['options']['wrapper_class']) ? ' ' . $field['options']['wrapper_class'] : '') . (!empty($this->errors) && array_key_exists($field['name'], $this->errors) ? ' error' : '') . '" id="txt_' . $field['name'] . '_wrapper">'; 

						echo '<label for="txt_' . $field['name'] . '">' . $field['label'] . '</label>' .
						'<input placeholder="'. $field['options']['placeholder'] .'" type="' . $field['type'] . '" name="' . $field['name'] . '" id="txt_' . $field['name'] . '" ' . ($extras ? $extras : '') . ' value="' . (isset($_POST[$field['name']]) ? htmlentities(stripslashes($_POST[$field['name']])) :  $this->check_auto_fill($field['name']) ) . '" tabindex="'. $field['options']['tabindex'] .'" />';

						if( !empty($this->errors) && array_key_exists($field['name'], $this->errors) ) {
							foreach($this->errors[$field['name']] as $error) {
							echo '<p class="error">' . $error . '</p>';
							}
						}

					echo '</div>';

				break;

				case 'password' :

					echo '<div class="' . $this->form_options['wrapper_class'] . (isset($field['options']['wrapper_class']) ? ' ' . $field['options']['wrapper_class'] : '') . (!empty($this->errors) && array_key_exists($field['name'], $this->errors) ? ' error' : '') . '" id="txt_' . $field['name'] . '_wrapper">'; 

						echo '<label for="txt_' . $field['name'] . '">' . $field['label'] . '</label>' .
						'<input placeholder="'. $field['options']['placeholder'] .'" type="password" name="' . $field['name'] . '" id="txt_' . $field['name'] . '" ' . ($extras ? $extras : '') . ' value="' . (isset($_POST[$field['name']]) ? htmlentities(stripslashes($_POST[$field['name']])) :  $this->check_auto_fill($field['name']) ) . '" tabindex="'. $field['options']['tab_index'] .'"/>';

						if( !empty($this->errors) && array_key_exists($field['name'], $this->errors) ) {
							foreach($this->errors[$field['name']] as $error) {
							echo '<p class="error">' . $error . '</p>';
							}
						}

					echo '</div>';

				break;

				case 'dropdown' :


					$default_value = 'Please select...';

					echo '<div class="' . $this->form_options['wrapper_class'] . (isset($field['options']['wrapper_class']) ? ' ' . $field['options']['wrapper_class'] : '') . (!empty($this->errors) && array_key_exists($field['name'], $this->errors) ? ' error' : '') . '" id="txt_' . $field['name'] . '_wrapper">';
						
						echo '<label for="txt_' . $field['name'] . '">' . $field['label'] . '</label>' .
						'<select name="' . $field['name'] . '" id="txt_' . $field['name'] . '" tabindex="'. $field['options']['tab_index'] .'">' .
						'<option value="0">' . (isset($field['options']['default']) ? $field['options']['default'] : $default_value ) . '</option>';


					foreach($field['options']['choices'] as $value => $choice) 
					{
						echo '<option value="' . $value . '" ' . (isset($_POST[$field['name']]) && $_POST[$field['name']] == $value ? 'selected' : ( $this->check_auto_fill_select($field['name'] , $value) ? 'selected' : '' ) ) . '>' . ( $field['name'] == 'txt_how_heard' ? strtolower( $choice ) :  $choice ). '</option>';
					}

					echo '</select>';

					if( !empty($this->errors) && array_key_exists($field['name'], $this->errors) ) {
						foreach($this->errors[$field['name']] as $error) {
							echo '<p class="error">' . $error . '</p>';
						}
					}

					echo '</div>';

				break;

				case 'checkbox' :

					echo '<div class="' . $this->form_options['wrapper_class'] . (isset($field['options']['wrapper_class']) ? ' ' . $field['options']['wrapper_class'] : '') . (!empty($this->errors) && array_key_exists($field['name'], $this->errors) ? ' error' : '') . '" id="chk_' . $field['name'] . '_wrapper">' . 
						'<label for="chk_' . $field['name'] . '">' . 
						'<input type="checkbox" name="' . $field['name'] . '" id="chk_' . $field['name'] . '" ' . ($extras ? $extras : '') . ' value="' . $field['options']['value'] . '" tabindex="'. $field['options']['tabindex'] .'" /> ' . 
						$field['label'] . '</label>';

					if( !empty($this->errors) && array_key_exists($field['name'], $this->errors) ) {
						foreach($this->errors[$field['name']] as $error) {
							echo '<p class="error">' . $error . '</p>';
						}
					}

					echo '</div>';

				break;

				case 'textarea' :

					echo '<div class="' . $this->form_options['wrapper_class'] . (isset($field['options']['wrapper_class']) ? ' ' . $field['options']['wrapper_class'] : '') . (!empty($this->errors) && array_key_exists($field['name'], $this->errors) ? ' error' : '') . '" id="txt_' . $field['name'] . '_wrapper">';
			
						echo '<label for="txt_' . $field['name'] . '">' . $field['label'] . '</label>' .
						'<textarea tabindex="'. $field['options']['tabindex'] .'" name="' . $field['name'] . '" id="txt_' . $field['name'] . '" ' . ($extras ? $extras : '') . '>' . (isset($_POST[$field['name']]) ? htmlentities(stripslashes($_POST[$field['name']])) : '') . '</textarea>';					
			
						if( !empty($this->errors) && array_key_exists($field['name'], $this->errors) ) {
							foreach($this->errors[$field['name']] as $error) {
								echo '<p class="error">' . $error . '</p>';
							}
						}
			
					echo '</div>';

				break; 


				case 'security' :

					$this->generate_numbers();

					echo '<div class="' . $this->form_options['wrapper_class'] . (isset($field['options']['wrapper_class']) ? ' ' . $field['options']['wrapper_class'] : '') . (!empty($this->errors) && array_key_exists($field['security'], $this->errors) ? ' error' : '') . '" id="txt_' . $field['name'] . '_wrapper">';

						echo '<label for="txt_' . $field['name'] . '">' . $field['label'] . '</label>';

						echo '<input type="hidden" id="security_number_1" name="security_number_1" value="'. $this->form_options['security'][0] .'" />';
						echo '<input type="hidden" id="security_number_2" name="security_number_2" value="'. $this->form_options['security'][1] .'" />';

						echo '<span class="number"><span class="required">*</span>'. $this->form_options['security'][0] .' + '. $this->form_options['security'][1] .' = </span>';

						echo '<input type="text" name="' . $field['name'] . '" id="txt_' . $field['name'] . '" ' . ($extras ? $extras : '') . ' value="' . (isset($_POST[$field['name']]) ? htmlentities(stripslashes($_POST[$field['name']])) : '') . '" tabindex="'. $field['options']['tabindex'] .'" />';

						if( !empty($this->errors) && array_key_exists($field['security'], $this->errors) ) {
						foreach($this->errors[$field['security']] as $error) {
							echo '<p class="error">' . $error . '</p>';
						}
					}


					echo '</div>';

				break; 

				case 'honeypot' :

					echo '<div class="status-field">';

						echo '<input type="text" name="' . $field['name'] . '" id="txt_' . $field['name'] . '" ' . ($extras ? $extras : '') . ' value="" tabindex="-1" />';
						
					echo '</div>';

				break;

				case 'upload' :

					echo '<div class="' . $this->form_options['wrapper_class'] . (isset($field['options']['wrapper_class']) ? ' ' . $field['options']['wrapper_class'] : '') . (!empty($this->errors) && array_key_exists($field['security'], $this->errors) ? ' error' : '') . '" id="txt_' . $field['name'] . '_wrapper">';

						echo '<label for="txt_' . $field['name'] . '[]">' . $field['label'] . '</label>';

						echo '<input type="file" name="' . $field['name'] . '[]" id="txt_' . $field['name'] . '" ' . ($extras ? $extras : '') . ' value="" multiple="" tabindex="'. $field['options']['tabindex'] .'" />';

						if( !empty($this->errors) && array_key_exists($field['upload'], $this->errors) ) {
							foreach($this->errors[$field['upload']] as $error) {
								echo '<p class="error">' . $error . '</p>';
							}
						}

					echo '</div>';

				break; 

				default :
					trigger_error('Unknown field type \'' . $field['type'] . '\'', E_USER_WARNING);

			}

			if ( $field['options']["wrapper_element_close"] ){
				echo $field['options']["wrapper_element_close"];
			}


			if($this->form_options['splitcols'] !== false) {
				if($i == $this->form_options['splitcols']) {
					echo '</div><div class="col2">';
				}

				else if($i == ( count($this->fields) - 1 ) ) {

					echo '<div class="submit_wrapper">' . $this->form_options['footer_html'] . '<input type="submit" tabindex="100" class="form_submit button" value="' . $this->form_options['submit_label'] . '" /></div>';
					
					echo '</div><div class="clear"></div>';
				}
			}

			$i++;
		}

		if ( $this->form_options['splitcols'] == false )
		{
			echo '<div class="submit_wrapper">' . $this->form_options['footer_html'] . '<input type="submit" class="form_submit button" tabindex="100" value="' . $this->form_options['submit_label'] . '" /></div>';

		}
		
		
	}

	public function valid() 
	{

		foreach($this->fields as $field) 
		{

			if( isset($field['options']['required']) && $field['options']['required'] == true ) 
			{
				if($field['type'] == 'dropdown') 
				{
					if( !isset($_POST[$field['name']]) || ( isset($_POST[$field['name']]) && $_POST[$field['name']] == '0' ) ) 
					{

						$this->errors[$field['name']][] = 'This field is required';
						continue;
					}
				}

				else 
				{
					if( !ltrim($_POST[$field['name']]) || !isset($_POST[$field['name']]) || ( isset($_POST[$field['name']]) && $_POST[$field['name']] == '' ) ) 
					{

						$this->errors[$field['name']][] = 'This field is required';
						continue;
					}
				}
			}

			if(isset($field['options']['min'])) 
			{
				if( isset($_POST[$field['name']]) && strlen($_POST[$field['name']]) < $field['options']['min'] ) 
				{

					$this->errors[$field['name']][] = 'This field must be at least ' . $field['options']['min'] . ' characters in length';
				}
			}

			if(isset($field['options']['max'])) 
			{
				if( isset($_POST[$field['name']]) && strlen($_POST[$field['name']]) > $field['options']['max'] ) 
				{

					$this->errors[$field['name']][] = 'This field cannot be over ' . $field['options']['max'] . ' characters in length';
				}
			}

			if($field['type'] == 'email') 
			{
				if( isset($_POST[$field['name']]) && !filter_var($_POST[$field['name']], FILTER_VALIDATE_EMAIL) ) 
				{
					$this->errors[$field['name']][] = 'You must enter a valid email address';
				}
			}

			if( $field['type'] == 'upload' ) 
			{

				if ( empty( $_FILES['file']['name'][0] ) )
				{
					$this->errors[$field['upload']][] = 'Please add a file and try again.';
				}
				else if ( !check_mime_type($_FILES['file']['type'][0]) )
				{
					$this->errors[$field['upload']][] = 'Sorry your file is not valid, please upload a pdf , ppt , xls or doc file and try again.';
				}
				else if ( !check_file_size($_FILES['file']['size'][0]) )
				{
					$this->errors[$field['upload']][] = 'Sorry your file is too large, please try again.';

				}

			}


			if( $field['name'] == 'security' ) 
			{

				if ( (intval($_POST['security_number_1'] ) + intval( $_POST['security_number_2'] ) ) != $_POST['security'])
				{
					$this->errors[$field['security']][] = 'You must answer the security question correctly';
				}
				
			}

			// Additional check for our Honeypot field
			if( $field['name'] == 'status-field' ) 
			{
				// Check to see if our honeypot field was completed.
				if ( $_POST['status-field'] )
				{
					$this->honeypot_alert = true;
				}
			}
				
		}

		if ( isset($_POST['security_number_1']) && $_POST['security_number_2'] && $_POST['security'] == '' )
		{
			$this->errors[$field['security']][] = 'You must answer the security question correctly';
		}


		if(empty($this->errors)) {
			return true;
		}

		return false;

	}

	public function get_errors($field = null) {
		if($field == null) {
			return $this->errors;
		}

		else {
			return $this->errors[$field];
		}
	}

	public function getCountryFromCode($countries,$co)
	{
		return $countries[$co];
	}

	public function check_auto_fill( $field_name )
	{
		// Does the value exist in our auto fill data
		if ( array_key_exists ( $field_name , $this->form_options['auto-fill-values'] ) )
		{

			// Should we return a string or array value
			if ( is_array( $this->form_options['auto-fill-values'][$field_name] ) )
			{
				return $this->form_options['auto-fill-values'][$field_name][0];
			}
			else
			{
				return $this->form_options['auto-fill-values'][$field_name];	
			}
			
		}

	}

	public function check_auto_fill_select( $field_name , $option_value )
	{
		// Does the value exist in our auto fill data
		if ( array_key_exists ( $field_name ,$this->form_options['auto-fill-values'] ) )
		{
			if ($this->form_options['auto-fill-values'][$field_name] ==  $option_value )
			{
				return true;
			}
		}


	}

}