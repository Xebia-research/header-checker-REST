OAuth is an open standard for access delegation, commonly used as a way for Internet users to grant websites or applications access to their information on other websites but without giving them the passwords.
This mechanism is used by companies such as Google, Facebook, Microsoft and Twitter to permit the users to share information about their accounts with third party applications or websites.


Generally, OAuth provides to clients a "secure delegated access" to server resources on behalf of a resource owner. It specifies a process for resource owners to authorize third-party access to their server resources without sharing their credentials. Designed specifically to work with Hypertext Transfer Protocol (HTTP), OAuth essentially allows access tokens to be issued to third-party clients by an authorization server, with the approval of the resource owner. The third party then uses the access token to access the protected resources hosted by the resource server


OAuth 2.0 is not backwards compatible with OAuth 1.0. OAuth 2.0 provides specific authorization flows for web applications, desktop applications, mobile phones, and living room devices.
Most of the big companies(Google, Facebook and so on) don’t support version 1.0 anymore.


https://en.wikipedia.org/wiki/OAuth


When responding with an access token, the server must also include the additional Cache-Control: no-store and Pragma: no-cache HTTP headers to ensure clients do not cache this request!


https://www.oauth.com/oauth2-servers/access-tokens/access-token-response/


OAuth 2.0 (refresh tokens)
In OAuth2 the access_token sometimes, which is most of the time, has a limited lifetime expectancy. We can assume by the expires_in parameter passed along at the Access Token response stage whether it will live forever or decay in a certain amount of time.


https://www.oauth.com/oauth2-servers/access-tokens/access-token-response/


A successful response could look like this:

{

  "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsIng1dCI6Ik5HVEZ2Z”

  "token_type": "Bearer",
  
  "expires_in": "3600",

  "expires_on": "1388444763",

  "resource": "https://service.contoso.com/",

  "refresh_token": "AwABAAAAvPM1KaPlrEqdFSBzjqfTGAMxZGUTdM0t4B4rTfgV29”

  "scope": "https%3A%2F%2Fgraph.microsoft.com%2Fmail.read",

  "id_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJub25lIn0.eyJhdWQiOiIyZDRkM”

}

-Parameter:	Description


-access_token:	The requested access token. The app can use this token to authenticate to the secured resource, such as a web API.


-token_type:	Indicates the token type value.

 
-expires_in:	How long the access token is valid (in seconds).


-expires_on:	The time when the access token expires. The date is represented as the number of seconds from 1970-01-01T0:0:0Z UTC until the expiration time. This value is used to determine the lifetime of cached tokens.


-resource:	The App ID URI of the web API (secured resource).


-scope:	        Impersonation permissions granted to the client application. The default permission is user_impersonation. The owner of the secured resource can register additional values in Azure AD.


-refresh_token:	An OAuth 2.0 refresh token. The app can use this token to acquire additional access tokens after the current access token expires. Refresh tokens are long-lived, and can be used to retain access to resources for extended periods of time.


-id_token: An unsigned JSON Web Token (JWT). The app can base64Url decode the segments of this token to request information about the user who signed in. The app can cache the values and display them, but it should not rely on them for any authorization or security boundaries.
