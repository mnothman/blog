project dir needs to be located in /var/www/html/ for apache to serve <br/>

initial setup <br/>
1. Clone repo <br/>
2. Install Apache if not already <br/>
3. Start and enable Apache ex. linux fedora: sudo systemctl start httpd <br/>
4. Move cloned repo for Apache to serve: “sudo mv /path/to/the/project /var/www/html/” <br/>
5. Run “composer install” to get project dependencies <br/>
6. Run project: http://localhost/blog/ <br/>
If issues with access try troubleshooting:  <br/>
	i. sudo chown -R apache:apache /var/www/html/blog <br/>
sudo chmod -R 755 /var/www/html/blog <br/>
	ii. Ensure apache can serve files: “sudo nano /etc/httpd/conf/httpd.conf” 
 <br/> Check <Directory /var/www/html> block and ensure AllowOverride All (restart Apache after) <br/>
	iii. Check apache error logs: “sudo tail -f /var/log/httpd/error_log” <br/>
iv. if still not working, ensure that context of files in project directory are runnable by Apache: check context: “ls -Z /var/www/html/blog/” then after change: “sudo chcon -R -t httpd_sys_content_t /var/www/html/blog” (restart Apache after) <br/>

7. Run database setup file for sqlite (in browser run “http://localhost/blog/setup_db.php”) <br/>
<br/>	If issues with permissions ex. “Connection failed: SQLSTATE[HY000] [14] unable to open database file” need to change context similar to 7 iv)  
<br/>	i. sudo chown -R apache:apache /var/www/html/blog/data 
<br/>   sudo chmod -R 755 /var/www/html/blog/data
<br/> ii. sudo chcon -R -t httpd_sys_rw_content_t /var/www/html/blog/data

<br/> 
Usual usage <br/> 
1. Ensure Apache is started, ex. linux fedora: sudo systemctl start httpd <br/> 
2. Go to: http://localhost/blog/  <br/> 


 <br/> Transfer permissions manually with transfer_permissions.sh and reclaim_permissions.sh. 
<br/> Make executable: chmod +x reclaim_permissions.sh run with: ./reclaim_permissions.sh AND chmod +x transfer_permissions.sh & run with: ./transfer_permissions.sh
<br/> If git is tracking permission changes use this to stop it: git config core.fileMode false

