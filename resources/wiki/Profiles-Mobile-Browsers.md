
Profiles are going to be used by the analyzer which gets them from the database were they are stored. The headers that are in the profiles come from the research documents that show which headers are must haves or best practices.

The headers that are in a profile show which headers could be supported and what types of these headers are supported, that is show in brackets.

# Mobile

| Android webview | | | | | | | | | |
| ------------- | - | - | - | - | - | - | -| -| -|
| X-XSS-Protection| CSP | X-Content-Type-Options| X-Frame-Options (SAMEORIGIn) | Strict-Transport-Security | Public Key Pinning| Referrer-Policy|Cookie security SameSite| Pragma| Cache-Control| 

| Chrome for Android | | | | | | | | | | |
| ------------- | - | - | - | - | - | - | -| -| -| -|
| X-XSS-Protection| CSP | X-Content-Type-Options| X-Frame-Options (SAMEORIGIn) | Strict-Transport-Security | Public Key Pinning| Referrer-Policy (same-origin, strict-origin, strict-origin-when-cross-origin) |Cookie security HttpOnly|Cookie security SameSite| Pragma| Cache-Control| 

| Edge mobile | | | | | | | |
| ------------- | - | - | - | - | - | - | -|
| X-XSS-Protection| CSP | X-Content-Type-Options| X-Frame-Options| Strict-Transport-Security | Cookie security HttpOnly|Pragma| Cache-Control| 

| Firefox for Android | | | | | | | | | |
| ------------- | - | - | - | - | - | - | -| -| -|
| X-XSS-Protection| CSP | X-Content-Type-Options| X-Frame-Options| Strict-Transport-Security | Public Key Pinning| Referrer-Policy|Cookie security HttpOnly| Pragma| Cache-Control| 

| Internet Explorer | | | | |
| ------------- | - | - | - | - | 
| X-Frame-Options | Strict-Transport-Security |Cookie security HttpOnly| Pragma| Cache-Control| 

| iOS Safari | | | | | | |
| ------------- | - | - | - | - | - | - | 
| X-XSS-Protection| CSP | X-Frame-Options| Strict-Transport-Security | Cookie security HttpOnly| Pragma| Cache-Control| 