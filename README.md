A php proxy in 1 file with a minimum of dependency.

Just change the IP address in the first lines, and it should be ready to use with a rewrite:

```
RewriteEngine on
### YOUR RULES
RewriteRule . reverse_proxy.php [L]
```
