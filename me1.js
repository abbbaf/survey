<?php
    $expires = 60*60*24;
    header('Cache-Control: max-age='.$expires.'');
    header('Pragma: public');
    header('Expires: '. gmdate('D, d M Y H:i:s', time()+$expires).'GMT');
?>
user = "<?php echo base64_encode(openssl_random_pseudo_bytes(20)); ?>"