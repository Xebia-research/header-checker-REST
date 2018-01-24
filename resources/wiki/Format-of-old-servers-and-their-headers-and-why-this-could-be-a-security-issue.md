* Microsoft Internet Information Services – 45,66%
* Apache – 21,51%
* Nginx – 17,63%


These three webservers provides combined provide more than 82% off all the current web servers. Found in a survey that was held in January 2017, therefor we focus our research on these three provides. If we would include all possible web server provides the list would be too long, and the returns would be minimal. 

https://news.netcraft.com/archives/2017/01/12/january-2017-web-server-survey.html

 
* Microsoft Internet Information Services – 10.8%
* Apache – 48,4%
* Nginx – 35.5%
 
Even though these two sources say wildly different things with regards to which webserver is bigger, the conclusions are still that these three servers are the big three with the rest having less than 15% of the mark share to dived between them.

Because these three servers are the biggest player by far, we therefor focus on these three and what their formatting was with regards to headers.

https://w3techs.com/technologies/overview/web_server/all


# Microsoft Internet Information Services

Version	Releaseyear	Name of accompanying OS
	
1.0	1996	        Windows NT 3.5.1
	
2.0	1996	        Windows NT 4.0 RTM
	
3.0	1996	        Windows NT 4.0 SP3
	
4.0	1997	        Windows NT I.O.P.
	
5.0	2000	        Windows 2000	

5.1	2002	        Windows XP Pro	

6.0	2003	        Windows Server 2003	

7.0	2008	        Windows Vista	

7.5	2009	        Windows 7	

8.0	2012	        Windows 8	

8.5	2013		

10	2017	        Windows 10	

For the format see: 
https://www.microsoft.com/technet/prodtechnol/WindowsServer2003/Library/IIS/676400bc-8969-4aa7-851a-9319490a9bbb.mspx?mfr=true



The W3C Extended log file format is the default log file format for IIS 4.0, 5.0, 5.1, 6.0 and 7.0. It is a customizable ASCII text-based format.

 
Therefor if the header that are given contain the default field and data or some form of default and options in order, then the receiver knowns the server runs IIS 4.0, 5.0, 5.1, 6.0 or 7.0


However since IIS 7.0 the users could remove unwanted response headers that prevent attackers to know that the format was that of IIS 7.0. As well as remove header that contain critical data.
So based on the format you can determine if the server is running version 7.0 or lower


# Apache’s formatting of the headers.

Apache webserver that are usable for the public was version 1.3. The current version of apache is 2.4.27. Every major version of Apache has seen major overhauls. For this research the transition between 2.0 and 2.1 is the biggest since headers were no longer processes in a standard order. 

The four major version Apache are 1.3, 2.0, 2.2, 2.4


## Apache HTTP Server Version 1.3
Order of Processing
The Header directive can occur almost anywhere within the server configuration. It is valid in the main server config and virtual host sections, inside Directory, Location and Files sections, and within .htaccess files. 

The Header directives are processed in the following order: 
1.	main server 
2.	virtual host 
3.	Directory sections and .htaccess 
4.	Location 
5.	Files

## Apache HTTP Server Version 2.0
The directives provided by mod_headers can occur almost anywhere within the server configuration. They are valid in the main server config and virtual host sections, inside Directory, Location and Files sections, and within .htaccess files.

The directives are processed in the following order:
1.	main server
2.	virtual host
3.	Directory sections and .htaccess
4.	Files
5.	Location


## Since Apache HTTP Server Version 2.1 and higher the order of processing is not bound to a particular order.

During the research it was found out that the response headers that are send out by the server depend on the configuration of the webserver. The standard response header though don’t give out which version the webserver is. Because the standards that were found give as a response header:

Time;

Date;

Server(server version);

And after that it depends on whether or not the admin of the webserver server has configured the server.

Conclusions: We haven’t found anything that could link the format of Apache server to a certain version of Apache.


# Nginx

Since Nginx is a fairly new web service, because this is the case there isn’t a lot of legacy surrounding the service. 
So there isn’t a lot of different version that are vastly different from one and another, which is the case with IIS.
Because Nginx is a new player they have the advantage of what NOT to put in the standard configuration files that make the response headers.
Nginx like Apache make their headers based on the installation of the server and files put into the folders as well as any changes made to the .config file.

The standard, untouched, response headers give something back as seen below:

HTTP/1.1:

Server:

Date:

Content-type:

Last-Modified:

Expires:

Cache-Control:



So in conclusion, based on the format people don’t know what version Nginx is running.


# Appendix

IIS:

https://www.microsoft.com/technet/prodtechnol/WindowsServer2003/Library/IIS/676400bc-8969-4aa7-851a-9319490a9bbb.mspx?mfr=true

Apache:
1.3

http://httpd.apache.org/docs/1.3/mod/mod_headers.html

2.0

http://httpd.apache.org/docs/2.0/mod/mod_headers.html

Nginx:

https://serversforhackers.com/c/nginx-caching

https://docs.gitlab.com/omnibus/settings/nginx.html

 


