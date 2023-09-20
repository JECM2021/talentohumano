<?php
function claves($con) {
    $llave1 = 'sadncy23mdsdi834nmsdncu45bnn534';
    $llave2 = 'jfhy3ndjc9JRNDA9jm4ndjcog45m243';
    $con2 = strrev($con);
    return sha1($llave2 . $llave1 . $llave2 . $con2 . $con . $llave1 . $con2 . $llave1 . $con . $llave2 . $con2 . $llave1 . $llave2 . $llave1);
}
