# Cross Site Scripting Protection (X-XSS)
Chrome and IE have X-XSS-Protection, a header feature designed to defend against Cross Site Scripting.


Output:

X-Xss-Protection deny

X-XSS-Protection: 1; mode=block


# Content Security Policy (CSP)
This is considered an improved version of the X-XSS-Protection header which adds another layer of security. With CSP you can define/whitelist content sources. ALL MAJOR BROWSERS offer full or partial support for CSP.
Cannot prevent all XSS attacks, it will limit the impact of those that manage to break in.


 
- Content-Security-Policy : Defined by W3C Specs as standard header, used by Chrome version 25 and later, Firefox version 23 and later, Opera version 19 and later.
- X-Content-Security-Policy : Used by Firefox until version 23, and Internet Explorer version 10 (which partially implements Content Security Policy).
- X-WebKit-CSP : Used by Chrome until version 25

The supported directives are: 

- default-src : Define loading policy for all resources type in case of a resource type dedicated directive is not defined (fallback),
- script-src : Define which scripts the protected resource can execute,
- object-src : Define from where the protected resource can load plugins,
- style-src : Define which styles (CSS) the user applies to the protected resource,
- img-src : Define from where the protected resource can load images,
- media-src : Define from where the protected resource can load video and audio,
- frame-src : Define from where the protected resource can embed frames,
- font-src : Define from where the protected resource can load fonts,
- connect-src : Define which URIs the protected resource can load using script interfaces,
- form-action : Define which URIs can be used as the action of HTML form elements,
- sandbox : Specifies an HTML sandbox policy that the user agent applies to the protected resource,
- script-nonce : Define script execution by requiring the presence of the specified nonce on script elements,
- plugin-types : Define the set of plugins that can be invoked by the protected resource by limiting the types of resources that can be embedded,
- reflected-xss : Instructs a user agent to activate or deactivate any heuristics used to filter or block reflected cross-site scripting attacks, equivalent to the effects of the non-standard X-XSS-Protection header,
- report-uri : Specifies a URI to which the user agent sends reports about policy violation



Output:

Content-Security-Policy ‘one-of-the-above-directives’


## Browser Sniffing Protection( X-Content-Type-Options)
X-Content-Type header prevent “MIME sniffing”, which is a feature in Internet Explorer and Google Chrome. It allows the browser to scan the content and respond away from what the header may instruct.
X-Content-Type-Options instruct browsers to set the content type as instructed and never detect the type their own.



Output:

X-Content-Type-Options nosniff


## Clickjacking Prevention (X-Frame-Options)
X-Frame-Options header enables clickjacking prevention by disabling iframes on your site. Iframes can be used by hackers to mirror legitimate clicks for their own purposes, this header fully mitigates that risk.
X-Frame-Options is supported by ALL MAJOR browsers.



Output:

X-Frame-Options: DENY

X-Frame-Options: SAMEORIGIN

X-Frame-Options: ALLOW-FROM


## HTTP Strict Transport Security
HSTS header prevents browsers from accessing web servers over non-HTTPS connections. This prevent SSLstrip attacks, when hackers launch a Man-in-the-Middle attack.
Downside is HSTS can be used to deploy supercookies.
All the major browsers support HSTS.



Output:

Strict-Transport-Security: max-age=31536000 (<-can be anything)

Strict-Transport-Security: max-age=86400; includeSubDomains

Strict-Transport-Security: max-age=31536000; includeSubDomains; preload


## HTTP Public Key Pinning (HPKP) 
Public-Key-Pins header instruct browsers which certificate to trust. When a browser meets the header for the first time, it will save that specific pinned certificate. This header helps prevent forged X.509 certificates and rogue attacks in case a certificate authority is compromised.
HOWEVER(!) it is a risky header as many things can go wrong. If one pins the wrong certificate, loses the keys or some other issues arises, it can easily lock users outside a site.  If you pin your site to one set of certificates and then have to deploy a new one, users who have seen the pin will be unable to access your site until the pin expires.
-Because it's tricky to get right, HPKP is mostly used by a handful of high-profile, security-sensitive sites right now. If you decide to turn on HPKP, you should start with a very short max-age value and gradually increase it if you don't have any problems.

Output:

Public-Key-Pins: max-age=2592000; pin-sha256="E9CZ9INDbd+2eRQozYqqbQ2yXLVKB9+xcprMF+44U1g=";

## Appendix

http://www.globaldots.com/8-http-security-headers-best-practices/

https://www.keycdn.com/blog/http-security-headers/

https://blog.appcanary.com/2017/http-security-headers.html

https://www.owasp.org/index.php/OWASP_Secure_Headers_Project#tab=Headers

https://www.owasp.org/index.php/Content_Security_Policy

https://content-security-policy.com/

https://developer.mozilla.org/en-US/docs/Web/HTTP/Public_Key_Pinning

https://developers.google.com/web/updates/2015/09/HPKP-reporting-with-chrome-46
