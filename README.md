project dir needs to be located in /var/www/html/ for apache to serve <br/>


Clone repo <br/>
Install Apache if not already <br/>
Start and enable Apache  <br/>
Move cloned repo for Apache to serve: “sudo mv /path/to/the/project /var/www/html/” <br/>
Run “composer install” to get project dependencies <br/>
Run project: http://localhost/blog/ <br/>
If issues with access try troubleshooting:  <br/>
	i. sudo chown -R apache:apache /var/www/html/blog <br/>
sudo chmod -R 755 /var/www/html/blog <br/>
	ii. Ensure apache can serve files: “sudo nano /etc/httpd/conf/httpd.conf” 
 <br/> Check <Directory /var/www/html> block and ensure AllowOverride All (restart Apache after) <br/>
	iii. Check apache error logs: “sudo tail -f /var/log/httpd/error_log” <br/>
iv. if still not working, ensure that context of files in project directory are runnable by Apache: check context: “ls -Z /var/www/html/blog/” then after change: “sudo chcon -R -t httpd_sys_content_t /var/www/html/blog” (restart Apache after) <br/>

Run database setup file for sqlite (in browser run “http://localhost/blog/setup_db.php”) <br/>
<br/>	If issues with permissions ex. “Connection failed: SQLSTATE[HY000] [14] unable to open database file” need to change context similar to 7 iv)  
<br/>	i. sudo chown -R apache:apache /var/www/html/blog/data 
<br/>   sudo chmod -R 755 /var/www/html/blog/data
<br/> ii. sudo chcon -R -t httpd_sys_rw_content_t /var/www/html/blog/data

