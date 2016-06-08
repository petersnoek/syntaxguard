<?php

ini_set('display_errors', '1');
error_reporting(E_ERROR);       // hide some notices


if(isset($_POST['action']) && $_POST['action'] == 'submit'){
    /*** Build data ***/
    // Set variables
    $request_url    = 'https://api.syntaxguard.com/v1.0/'.$_POST['endpoint'].urlencode($_POST['value']);
    $request_query  = !empty($_POST['query']) ? '?'.$_POST['query'] : '';

    // Build header
    $header         = array();
    $header[]       = 'X-API-Key: '.$_POST['api_key'];


    /*** Make call ***/
    // Open connection
    $curl           = curl_init();

    // Send data
    curl_setopt($curl, CURLOPT_URL,                $request_url.$request_query);
    curl_setopt($curl, CURLOPT_HTTPHEADER,         $header);
    curl_setopt($curl, CURLOPT_HEADER,             true);
    curl_setopt($curl, CURLOPT_VERBOSE,            true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER,     true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,     false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST,     2);


    // Execute call
    $response       = curl_exec($curl);
    $info           = curl_getinfo($curl);

    // Get response parts
    $header_size    = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
    $content_type   = curl_getinfo($curl, CURLINFO_CONTENT_TYPE);
    $header         = substr($response, 0, $header_size);
    $body           = substr($response, $header_size);

    // Close connection
    curl_close($curl);
}

?>
<!DOCTYPE html>
<!-- Developed by Digital Devils - www.digitaldevils.nl -->

<html>
<head>
    <title>SyntaxGuard API request tester</title>
    <style>
        body {
            font-family: 		'Arial', sans-serif;
        }

        label {
            width: 				150px;
            display: 			inline-block;
            vertical-align: 	top;
        }

        input, textarea {
            padding:			5px;
            width: 				400px;
        }

        input[type="number"] {
            width: 				100px;
        }

        select, button {
            padding:			5px;
            width: 				412px;
        }

        textarea {
            height:				100px;
        }
    </style>
</head>
<body>

<h1>SyntaxGuard API request (PHP)</h1>
<form action='syntaxguard.php' method='post'>
    <input type='hidden' id='action' name='action' value='submit' />

    <p>
        <label>API key</label>
        <input type='text' id='api_key' name='api_key' value='<?php print($_POST['api_key']); ?>'>
    </p>
    <p>
        <label>Endpoint</label>
        <select id='endpoint' name='endpoint'>
            <optgroup label='clean/'>
                <option value='clean/address-addition/'          <?php if($_POST['endpoint'] == 'clean/address-addition/'){          ?>selected='selected'<?php } ?>>address-addition/</option>
                <option value='clean/address-number/'            <?php if($_POST['endpoint'] == 'clean/address-number/'){            ?>selected='selected'<?php } ?>>address-number/</option>
                <option value='clean/date/'                      <?php if($_POST['endpoint'] == 'clean/date/'){                      ?>selected='selected'<?php } ?>>date/</option>
                <option value='clean/datetime/'                  <?php if($_POST['endpoint'] == 'clean/datetime/'){                  ?>selected='selected'<?php } ?>>datetime/</option>
                <option value='clean/filename/'                  <?php if($_POST['endpoint'] == 'clean/filename/'){                  ?>selected='selected'<?php } ?>>filename/</option>
                <option value='clean/iban/'                      <?php if($_POST['endpoint'] == 'clean/iban/'){                      ?>selected='selected'<?php } ?>>iban/</option>
                <option value='clean/infix/'                     <?php if($_POST['endpoint'] == 'clean/infix/'){                     ?>selected='selected'<?php } ?>>infix/</option>
                <option value='clean/lastname/'                  <?php if($_POST['endpoint'] == 'clean/lastname/'){                  ?>selected='selected'<?php } ?>>lastname/</option>
                <option value='clean/number/'                    <?php if($_POST['endpoint'] == 'clean/number/'){                    ?>selected='selected'<?php } ?>>number/</option>
                <option value='clean/phone/'                     <?php if($_POST['endpoint'] == 'clean/phone/'){                     ?>selected='selected'<?php } ?>>phone/</option>
                <option value='clean/postalcode/'                <?php if($_POST['endpoint'] == 'clean/postalcode/'){                ?>selected='selected'<?php } ?>>postalcode/</option>
                <option value='clean/price/'                     <?php if($_POST['endpoint'] == 'clean/price/'){                     ?>selected='selected'<?php } ?>>price/</option>
                <option value='clean/url/'                       <?php if($_POST['endpoint'] == 'clean/url/'){                       ?>selected='selected'<?php } ?>>url/</option>
            </optgroup>

            <optgroup label='check/'>
                <option value='check/alphanumeric/'              <?php if($_POST['endpoint'] == 'check/alphanumeric/'){              ?>selected='selected'<?php } ?>>alphanumeric/</option>
                <option value='check/between/'                   <?php if($_POST['endpoint'] == 'check/between/'){                   ?>selected='selected'<?php } ?>>between/</option>
                <option value='check/bsn/'                       <?php if($_POST['endpoint'] == 'check/bsn/'){                       ?>selected='selected'<?php } ?>>bsn/</option>
                <option value='check/date/'                      <?php if($_POST['endpoint'] == 'check/date/'){                      ?>selected='selected'<?php } ?>>date/</option>
                <option value='check/date-past/'                 <?php if($_POST['endpoint'] == 'check/date-past/'){                 ?>selected='selected'<?php } ?>>date-past/</option>
                <option value='check/date-past-today/'           <?php if($_POST['endpoint'] == 'check/date-past-today/'){           ?>selected='selected'<?php } ?>>date-past-today/</option>
                <option value='check/date-future/'               <?php if($_POST['endpoint'] == 'check/date-future/'){               ?>selected='selected'<?php } ?>>date-future/</option>
                <option value='check/date-future-today/'         <?php if($_POST['endpoint'] == 'check/date-future-today/'){         ?>selected='selected'<?php } ?>>date-future-today/</option>
                <option value='check/date-today/'                <?php if($_POST['endpoint'] == 'check/date-today/'){                ?>selected='selected'<?php } ?>>date-today/</option>
                <option value='check/datetime/'                  <?php if($_POST['endpoint'] == 'check/datetime/'){                  ?>selected='selected'<?php } ?>>datetime/</option>
                <option value='check/ean/'                       <?php if($_POST['endpoint'] == 'check/ean/'){                       ?>selected='selected'<?php } ?>>ean/</option>
                <option value='check/email/'                     <?php if($_POST['endpoint'] == 'check/email/'){                     ?>selected='selected'<?php } ?>>email/</option>
                <option value='check/email-real/'                <?php if($_POST['endpoint'] == 'check/email-real/'){                ?>selected='selected'<?php } ?>>email-real/</option>
                <option value='check/float/'                     <?php if($_POST['endpoint'] == 'check/float/'){                     ?>selected='selected'<?php } ?>>float/</option>
                <option value='check/iban/'                      <?php if($_POST['endpoint'] == 'check/iban/'){                      ?>selected='selected'<?php } ?>>iban/</option>
                <option value='check/integer/'                   <?php if($_POST['endpoint'] == 'check/integer/'){                   ?>selected='selected'<?php } ?>>integer/</option>
                <option value='check/length/'                    <?php if($_POST['endpoint'] == 'check/length/'){                    ?>selected='selected'<?php } ?>>length/</option>
                <option value='check/minimum/'                   <?php if($_POST['endpoint'] == 'check/minimum/'){                   ?>selected='selected'<?php } ?>>minimum/</option>
                <option value='check/maximum/'                   <?php if($_POST['endpoint'] == 'check/maximum/'){                   ?>selected='selected'<?php } ?>>maximum/</option>
                <option value='check/phone/'                     <?php if($_POST['endpoint'] == 'check/phone/'){                     ?>selected='selected'<?php } ?>>phone/</option>
                <option value='check/postalcode/'                <?php if($_POST['endpoint'] == 'check/postalcode/'){                ?>selected='selected'<?php } ?>>postalcode/</option>
                <option value='check/text/'                      <?php if($_POST['endpoint'] == 'check/text/'){                      ?>selected='selected'<?php } ?>>text/</option>
                <option value='check/url/'                       <?php if($_POST['endpoint'] == 'check/url/'){                       ?>selected='selected'<?php } ?>>url/</option>
                <option value='check/vatnumber/'                 <?php if($_POST['endpoint'] == 'check/vatnumber/'){                 ?>selected='selected'<?php } ?>>vatnumber/</option>
            </optgroup>

            <optgroup label='complete/'>
                <option value='complete/address/'                <?php if($_POST['endpoint'] == 'complete/address/'){                ?>selected='selected'<?php } ?>>address/</option>
            </optgroup>

            <optgroup label='convert/'>
                <option value='convert/currency/'                <?php if($_POST['endpoint'] == 'convert/currency/'){                ?>selected='selected'<?php } ?>>currency/</option>
                <option value='convert/length/'                  <?php if($_POST['endpoint'] == 'convert/length/'){                  ?>selected='selected'<?php } ?>>length/</option>
                <option value='convert/speed/'                   <?php if($_POST['endpoint'] == 'convert/speed/'){                   ?>selected='selected'<?php } ?>>speed/</option>
                <option value='convert/time/'                    <?php if($_POST['endpoint'] == 'convert/time/'){                    ?>selected='selected'<?php } ?>>time/</option>
            </optgroup>

            <optgroup label='compute/'>
                <option value='compute/age/'                     <?php if($_POST['endpoint'] == 'compute/age/'){                     ?>selected='selected'<?php } ?>>age/</option>
                <option value='compute/bmi/'                     <?php if($_POST['endpoint'] == 'compute/bmi/'){                     ?>selected='selected'<?php } ?>>bmi/</option>
                <option value='compute/date-in-business-days/'   <?php if($_POST['endpoint'] == 'compute/date-in-business-days/'){   ?>selected='selected'<?php } ?>>date-in-business-days/</option>
                <option value='compute/business-days-to-date/'   <?php if($_POST['endpoint'] == 'compute/business-days-to-date/'){   ?>selected='selected'<?php } ?>>business-days-to-date/</option>
                <option value='compute/date-in-days/'            <?php if($_POST['endpoint'] == 'compute/date-in-days/'){            ?>selected='selected'<?php } ?>>date-in-days/</option>
                <option value='compute/days-to-date/'            <?php if($_POST['endpoint'] == 'compute/days-to-date/'){            ?>selected='selected'<?php } ?>>days-to-date/</option>
            </optgroup>

            <optgroup label='create/'>
                <option value='create/barcode/'                  <?php if($_POST['endpoint'] == 'create/barcode/'){                  ?>selected='selected'<?php } ?>>barcode/</option>
                <option value='create/barcode-codabar/'          <?php if($_POST['endpoint'] == 'create/barcode-codabar/'){          ?>selected='selected'<?php } ?>>barcode-codabar/</option>
                <option value='create/barcode-code-11/'          <?php if($_POST['endpoint'] == 'create/barcode-code-11/'){          ?>selected='selected'<?php } ?>>barcode-code-11/</option>
                <option value='create/barcode-code-39/'          <?php if($_POST['endpoint'] == 'create/barcode-code-39/'){          ?>selected='selected'<?php } ?>>barcode-code-39/</option>
                <option value='create/barcode-code-39-extended/' <?php if($_POST['endpoint'] == 'create/barcode-code-39-extended/'){ ?>selected='selected'<?php } ?>>barcode-code-39-extended/</option>
                <option value='create/barcode-code-93/'          <?php if($_POST['endpoint'] == 'create/barcode-code-93/'){          ?>selected='selected'<?php } ?>>barcode-code-93/</option>
                <option value='create/barcode-code-128/'         <?php if($_POST['endpoint'] == 'create/barcode-code-128/'){         ?>selected='selected'<?php } ?>>barcode-code-128/</option>
                <option value='create/barcode-ean-8/'            <?php if($_POST['endpoint'] == 'create/barcode-ean-8/'){            ?>selected='selected'<?php } ?>>barcode-ean-8/</option>
                <option value='create/barcode-ean-13/'           <?php if($_POST['endpoint'] == 'create/barcode-ean-13/'){           ?>selected='selected'<?php } ?>>barcode-ean-13/</option>
                <option value='create/barcode-i25/'              <?php if($_POST['endpoint'] == 'create/barcode-i25/'){              ?>selected='selected'<?php } ?>>barcode-i25/</option>
                <option value='create/barcode-isbn/'             <?php if($_POST['endpoint'] == 'create/barcode-isbn/'){             ?>selected='selected'<?php } ?>>barcode-isbn/</option>
                <option value='create/barcode-msi/'              <?php if($_POST['endpoint'] == 'create/barcode-msi/'){              ?>selected='selected'<?php } ?>>barcode-msi/</option>
                <option value='create/barcode-postnet/'          <?php if($_POST['endpoint'] == 'create/barcode-postnet/'){          ?>selected='selected'<?php } ?>>barcode-postnet/</option>
                <option value='create/barcode-s25/'              <?php if($_POST['endpoint'] == 'create/barcode-s25/'){              ?>selected='selected'<?php } ?>>barcode-s25/</option>
                <option value='create/barcode-upc-a/'            <?php if($_POST['endpoint'] == 'create/barcode-upc-a/'){            ?>selected='selected'<?php } ?>>barcode-upc-a/</option>
                <option value='create/barcode-upc-e/'            <?php if($_POST['endpoint'] == 'create/barcode-upc-e/'){            ?>selected='selected'<?php } ?>>barcode-upc-e/</option>
                <option value='create/barcode-upc-ext2/'         <?php if($_POST['endpoint'] == 'create/barcode-upc-ext2/'){         ?>selected='selected'<?php } ?>>barcode-upc-ext2/</option>
                <option value='create/barcode-upc-ext5/'         <?php if($_POST['endpoint'] == 'create/barcode-upc-ext5/'){         ?>selected='selected'<?php } ?>>barcode-upc-ext5/</option>
                <option value='create/password/'                 <?php if($_POST['endpoint'] == 'create/password/'){                 ?>selected='selected'<?php } ?>>password/</option>
                <option value='create/qrcode/'                   <?php if($_POST['endpoint'] == 'create/qrcode/'){                   ?>selected='selected'<?php } ?>>qrcode/</option>
                <option value='create/serial/'                   <?php if($_POST['endpoint'] == 'create/serial/'){                   ?>selected='selected'<?php } ?>>serial/</option>
            </optgroup>

            <optgroup label='constant/'>
                <option value='constant/au/'                     <?php if($_POST['endpoint'] == 'constant/au/'){                     ?>selected='selected'<?php } ?>>au/ (Astronomical Unit)</option>
                <option value='constant/ld/'                     <?php if($_POST['endpoint'] == 'constant/ld/'){                     ?>selected='selected'<?php } ?>>ld/ (Lunar Distance)</option>
                <option value='constant/ly/'                     <?php if($_POST['endpoint'] == 'constant/ly/'){                     ?>selected='selected'<?php } ?>>ly/ (Light Year)</option>
                <option value='constant/pc/'                     <?php if($_POST['endpoint'] == 'constant/pc/'){                     ?>selected='selected'<?php } ?>>pc/ (Parsec)</option>
                <option value='constant/pi/'                     <?php if($_POST['endpoint'] == 'constant/pi/'){                     ?>selected='selected'<?php } ?>>pi/</option>
                <option value='constant/speed-light/'            <?php if($_POST['endpoint'] == 'constant/speed-light/'){            ?>selected='selected'<?php } ?>>speed-light/</option>
                <option value='constant/speed-sound/'            <?php if($_POST['endpoint'] == 'constant/speed-sound/'){            ?>selected='selected'<?php } ?>>speed-sound/</option>
            </optgroup>
        </select>
    </p>
    <p>
        <label>Value</label>
        <input type='text' id='value' name='value' value='<?php print($_POST['value']); ?>'>
    </p>
    <p>
        <label>Querystring</label>
        <input type='text' id='query' name='query' value='<?php print($_POST['query']); ?>'>
    </p>
    <p>
        <label>&nbsp;</label>
        <button type='submit'>Make call</button>
    </p>
</form>
<hr />

<?php if($_POST['action'] == 'submit'){ ?>
    <h3>Request</h3>
    <pre><?php print_r($request_url.$request_query); ?></pre>

    <h2>Result</h2>
    <h3>Header</h3>
    <pre><?php print_r($header); ?></pre>

    <h3>Body</h3>

    <?php if($content_type == 'image/png'){ ?>
        <img src='data:image/png;base64,<?php print($body); ?>' />

    <?php }else{ ?>
        <pre><?php print_r($body); ?></pre>

    <?php } ?>
<?php } ?>

</body>
</html>