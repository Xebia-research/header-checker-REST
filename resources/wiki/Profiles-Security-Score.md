In order to determine if a website or application is secure it needs headers to ensure that certain breaches or manipulation can’t happen.
We already have found a lot of headers that a website/application can have, these can be found in the “Best practices” and “X-headers” part of the Wiki.

In order to find out if a website/application is secure, according to our research, we have put the most vital headers for each profile on the wiki “Profile … browser”.

The scores for the headers is divide in four categories:

•	“-“, this means that the header has no value as a security header, however the owner of the browser might still want to use it for other reasons;

•	“low”, this means that the header offers little to almost no security or the header does something very niche;

•	“medium”, this means that the header is a security standard;

•	“high”, this means that the header needs to be in place and working else you have huge security issues.

# Desktop Profiles

| Chrome | | | | | | | | | | |
| ------------- | - | - | - | - | - | - | -| -| -| -|
| X-XSS-Protection| CSP | X-Content-Type-Options| X-Frame-Options (SAMEORIGIn) | Strict-Transport-Security | Public Key Pinning| Referrer-Policy|Cookie security HttpOnly|Cookie security SameSite| Pragma| Cache-Control|  
|medium | low | medium| low| medium| low | - | low| low|high | high|

| Internet  Explorer | | | | | | | |
| ------------- | - | - | - | - | - | - | -| 
|X-XSS-Protection| CSP(basic support) | X-Content-Type-Options| X-Frame-Options(SAMEORIGIn,ALLOW-FROM) | Strict-Transport-Security | Cookie security HttpOnly| Pragma| Cache-Control|  
| medium | low | medium| low | medium| low| high | high | 

| Edge | | | | | | | |
| ------------- | - | - | - | - | - | - | -|
| X-XSS-Protection| CSP | X-Content-Type-Options| X-Frame-Options | Strict-Transport-Security |Cookie security HttpOnly| Pragma| Cache-Control|  
| medium | low | medium | low | medium | low | high  | high |

| Firefox | | | | | | | | |
| ------------- | - | - | - | - | - | - | -| -|
| CSP | X-Content-Type-Options| X-Frame-Options (SAMEORIGIn,ALLOW-FROM) | Strict-Transport-Security | Public Key Pinning| Referrer-Policy|Cookie security HttpOnly|Pragma| Cache-Control|  
| high | medium | low| medium | low | - | low   | high |high  |

| Safari | | | | | | | |
| ------------- | - | - | - | - | - | - | -|
| X-XSS-Protection| CSP | X-Content-Type-Options| X-Frame-Options (SAMEORIGIn,ALLOW-FROM) | Strict-Transport-Security |Cookie security HttpOnly|Pragma| Cache-Control|  
| medium| low | medium| low| low | low | high | high|

# Mobile Profiles

| Android webview | | | | | | | | | |
| ------------- | - | - | - | - | - | - | -| -| -|
| X-XSS-Protection| CSP | X-Content-Type-Options| X-Frame-Options (SAMEORIGIn) | Strict-Transport-Security | Public Key Pinning| Referrer-Policy|Cookie security SameSite| Pragma| Cache-Control|
| medium | low | medium  | low | medium  | low | - | low| high| high| 

| Chrome for Android | | | | | | | | | | |
| ------------- | - | - | - | - | - | - | -| -| -| -|
| X-XSS-Protection| CSP | X-Content-Type-Options| X-Frame-Options (SAMEORIGIn) | Strict-Transport-Security | Public Key Pinning| Referrer-Policy (same-origin, strict-origin, strict-origin-when-cross-origin) |Cookie security HttpOnly|Cookie security SameSite| Pragma| Cache-Control| 
| medium | low | medium  | low | medium  | low | - | low| low| high| high|

| Edge mobile | | | | | | | |
| ------------- | - | - | - | - | - | - | -|
| X-XSS-Protection| CSP | X-Content-Type-Options| X-Frame-Options| Strict-Transport-Security | Cookie security HttpOnly|Pragma| Cache-Control| 
| medium | low| medium | low| medium  | low | high | high|

| Firefox for Android | | | | | | | | | |
| ------------- | - | - | - | - | - | - | -| -| -|
| X-XSS-Protection| CSP | X-Content-Type-Options| X-Frame-Options| Strict-Transport-Security | Public Key Pinning| Referrer-Policy|Cookie security HttpOnly| Pragma| Cache-Control| 
| medium | low | medium | low| medium  | low | - | low| high| high|

| Internet Explorer | | | | |
| ------------- | - | - | - | - | 
| X-Frame-Options | Strict-Transport-Security |Cookie security HttpOnly| Pragma| Cache-Control| 
| medium | high | medium  | high | high | 

| iOS Safari | | | | | | |
| ------------- | - | - | - | - | - | - | 
| X-XSS-Protection| CSP | X-Frame-Options| Strict-Transport-Security | Cookie security HttpOnly| Pragma| Cache-Control| 
| medium | low| low| medium | low| high | high | 