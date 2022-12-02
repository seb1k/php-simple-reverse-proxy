A php proxy in 1 file with a minimum of dependency.

Just change the IP address in the first line, and it should be ready to use with a rewrite:

RewriteEngine on
## YOUR RULES
RewriteRule . simple_php_proxy.php [L]
