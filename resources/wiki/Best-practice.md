## Referrer-Policy.
This header identifies the address of the webpage that linked to the resource being requested. By checking the referrer, the new webpage can see where the request originated from.
In most cases that means that when an user clicks a hyperlink, the browser sends a request to the server holding the destination. The header is used for analytics, the Referrer-Policy header allows the user to specify when the browser will set a Referrer header.

SHOULD IT BE USED?

When the owner of a website wants to have a lot of data for analyze with regards to the visitors this header can be used. HOWEVER(!) it may not be in accord with, some, privacy policies since the user’s data is stored and they cannot (re)view it. 

Output:

no-referrer

no-referrer-when-downgrade

origin

origin-when-cross-origin

same-origin

strict-origin

strict-origin-when-cross-origin

unsafe-url



https://www.w3.org/TR/referrer-policy/

https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Referrer-Policy

https://scotthelme.co.uk/a-new-security-header-referrer-policy/

https://docs.nwebsec.com/en/4.2/nwebsec/Configuring-referrerpolicy.html

## Cookies
There are three different options for cookies:

-Secure, will only be served over HTTPS. This prevents someone from reading the cookies in a Man-in-the-Middle attack;

-HttpOnly, cannot be accessed from within JavaScript. So if there is an XSS flaw, attackers can’t immediately steal the cookies;


Output:


Cookie security		Secure,HttpOnly



-SameSite helps defend against Cross-Origin Request Forgery attacks. This is an attack where a different website the user may be visiting inadvertently tricks them into making a request against your site. Generally people defend against this using CSRF tokens, a cookie marked as SameSite won’t be sent to a different site.
However SameSite is at the moment only available in Chrome and Opera.

At the moment there are two modes of Samesite:
SameSite=Strict
SameSite=Lax

Strict
Strict is the most robust protection and will probably protect against all CSRF-attacks. However it's far from user friendly because it [tries] to protect against CSRF that is in GET

Lax
The Lax  attribute solves the above issue by only stopping cookies to be sent cross-domain if it uses "dangerous" HTTP-methods, in this case POST.


Output:

Cookie security		SameSite


https://chloe.re/2016/04/13/goodbye-csrf-samesite-to-the-rescue/

https://wordpress.org/plugins/http-headers/

https://www.owasp.org/index.php/SecureFlag

https://en.wikipedia.org/wiki/Secure_cookies

https://www.owasp.org/index.php/HttpOnly

https://developer.mozilla.org/en-US/docs/Web/HTTP/Cookies

https://www.owasp.org/index.php/SameSite

https://geekflare.com/httponly-secure-cookie-apache/

httpwg.org/http-extensions/draft-ietf-httpbis-cookie-same-site.html

https://serverfault.com/questions/645964/httponly-and-secure-cookies-with-apache-mod-header-for-all-cookies


## -Pragma and cache-controle
Pragma is the HTTP/1.0 implementation and cache-control is the HTTP/1.1 counterpart. Both are meant to prevent the client from caching the response. The reason why Pragma is still in use is because older clients may not support HTTP/1.1.
Pragma could cause some trouble when it is used as a response header, since some clients and proxies will interpret it as such.

Output:

Pragma	no-cache

Cache-Control	Private

Cache-Control	no-cache

Cache-Control	must-revalidate


https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Pragma

https://www.w3.org/Protocols/rfc2616/rfc2616-sec14.html

https://www.keycdn.com/blog/http-cache-headers/


## -Expect-ct.
This is a new http header, that allows web host operators to instruct user agents to expect valid Signed Certificate Timestamps(SCTs) to be served on connections to these hosts. When configured in enforcement mode, user agents(UAs) will remember that hosts expect SCTs and will refuse connections that do not conform to the UA’s Certificate Transparency policy. When configured in report-only mode, UAs will report the lack of valid SCTs to a URI configured by the host, but will allow the connection. By turning on Expect-CT, web host operators can discover misconfigurations in their Certificate Transparency deployments and ensure that misused certificates accepted by UAs are discoverable in Certificate Transparency logs.


Output:

Expect-CT	max-age=86400, enforce, report-uri=”http://....com/ct-report


https://wordpress.org/plugins/http-headers/

https://scotthelme.co.uk/a-new-security-header-expect-ct/

http://httpwg.org/http-extensions/expect-ct.html


