<?php

$siteurl = get_option('SiteURL');

//$emsg = array();

$emsg['welcome']="

Hello $name,
<br><br>
Now you can access <a href='$siteurl'>$siteurl</a> and buy the service.
<br> <br>
You access info:
<br> <br>
User: $login<br>
Password: $password2mail<br>
<br> <br>
Thanks

";

$emsg['buyinfo']="

Hello,
<br><br>
Thanks, follow the important messages: 
<br> <br>
1) Login in <a href='$siteurl/login'>$siteurl/login</a> <br>
2) Menu: Accounts -> Add Account.<br>
3) Inform you telexfree login and Password.<br> 

<br> <br>

";

?>