<?php

use App\Profile;
use App\HeaderRule;
use Illuminate\Database\Seeder;

class HeaderRuleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        HeaderRule::truncate();

        $apiHeaderRules = collect();
        $webHeaderRules = collect();
        $secureHeaderRules = collect();

        $headerRule = new HeaderRule;
        $headerRule->name = 'X-XSS-Protection';
        $headerRule->description = 'A header feature designed to defend against Cross Site Scripting.';
        $headerRule->validation_type = 'required';
        $headerRule->risk_level = 'medium';
        $headerRule->save();
        $webHeaderRules->push($headerRule);

        $headerRule = new HeaderRule;
        $headerRule->name = 'X-XSS-Protection';
        $headerRule->description = 'A header feature designed to defend against Cross Site Scripting.';
        $headerRule->validation_type = 'regex';
        $headerRule->validation_value = '/^1(; mode=block)?/i';
        $headerRule->risk_level = 'medium';
        $headerRule->save();
        $webHeaderRules->push($headerRule);

        $headerRule = new HeaderRule;
        $headerRule->name = 'Content-Security-Policy'; // Used by Chrome version 25 and later, Firefox version 23 and later, Opera version 19 and later
        $headerRule->description = 'This is considered an improved version of the X-XSS-Protection header which adds another layer of security. With CSP you can define/whitelist content sources. Cannot prevent all XSS attacks, it will limit the impact of those that manage to break in.
        
    Defined by W3C Specs as standard header, used by Chrome version 25 and later, Firefox version 23 and later, Opera version 19 and later.';
        $headerRule->validation_type = 'required';
        $headerRule->risk_level = 'low';
        $headerRule->save();
        $apiHeaderRules->push($headerRule);
        $webHeaderRules->push($headerRule);

        $headerRule = new HeaderRule;
        $headerRule->name = 'Content-Security-Policy'; // Used by Chrome version 25 and later, Firefox version 23 and later, Opera version 19 and later
        $headerRule->description = 'This is considered an improved version of the X-XSS-Protection header which adds another layer of security. With CSP you can define/whitelist content sources. Cannot prevent all XSS attacks, it will limit the impact of those that manage to break in.
        
    Defined by W3C Specs as standard header, used by Chrome version 25 and later, Firefox version 23 and later, Opera version 19 and later.';
        $headerRule->validation_type = 'regex';
        $headerRule->validation_value = '/^default-src|script-src|object-src|style-src|img-src|media-src|frame-src|font-src|connect-src|form-action|script-nonce|plugin-types|reflected-xss/i';
        $headerRule->risk_level = 'low';
        $headerRule->save();
        $apiHeaderRules->push($headerRule);
        $webHeaderRules->push($headerRule);

        $headerRule = new HeaderRule;
        $headerRule->name = 'X-Content-Security-Policy'; // Used by Firefox until version 23, and Internet Explorer version 10
        $headerRule->description = 'This is considered an improved version of the X-XSS-Protection header which adds another layer of security. With CSP you can define/whitelist content sources. Cannot prevent all XSS attacks, it will limit the impact of those that manage to break in.
    
    Used by Firefox until version 23, and Internet Explorer version 10 (which partially implements Content Security Policy).';
        $headerRule->validation_type = 'required';
        $headerRule->risk_level = 'low';
        $headerRule->save();
        $apiHeaderRules->push($headerRule);
        $webHeaderRules->push($headerRule);

        $headerRule = new HeaderRule;
        $headerRule->name = 'X-Content-Security-Policy'; // Used by Firefox until version 23, and Internet Explorer version 10
        $headerRule->description = 'This is considered an improved version of the X-XSS-Protection header which adds another layer of security. With CSP you can define/whitelist content sources. Cannot prevent all XSS attacks, it will limit the impact of those that manage to break in.
    
    Used by Firefox until version 23, and Internet Explorer version 10 (which partially implements Content Security Policy).';
        $headerRule->validation_type = 'regex';
        $headerRule->validation_value = '/^default-src|script-src|object-src|style-src|img-src|media-src|frame-src|font-src|connect-src|form-action|script-nonce|plugin-types|reflected-xss/i';
        $headerRule->risk_level = 'low';
        $headerRule->save();
        $apiHeaderRules->push($headerRule);
        $webHeaderRules->push($headerRule);

        $headerRule = new HeaderRule;
        $headerRule->name = 'X-WebKit-CSP'; // Used by Chrome until version 25
        $headerRule->description = 'This is considered an improved version of the X-XSS-Protection header which adds another layer of security. With CSP you can define/whitelist content sources. Cannot prevent all XSS attacks, it will limit the impact of those that manage to break in.
        
    Used by Chrome until version 25';
        $headerRule->validation_type = 'required';
        $headerRule->risk_level = 'low';
        $headerRule->save();
        $apiHeaderRules->push($headerRule);
        $webHeaderRules->push($headerRule);

        $headerRule = new HeaderRule;
        $headerRule->name = 'X-WebKit-CSP'; // Used by Chrome until version 25
        $headerRule->description = 'This is considered an improved version of the X-XSS-Protection header which adds another layer of security. With CSP you can define/whitelist content sources. Cannot prevent all XSS attacks, it will limit the impact of those that manage to break in.
        
    Used by Chrome until version 25';
        $headerRule->validation_type = 'regex';
        $headerRule->validation_value = '/^default-src|script-src|object-src|style-src|img-src|media-src|frame-src|font-src|connect-src|form-action|script-nonce|plugin-types|reflected-xss/i';
        $headerRule->risk_level = 'low';
        $headerRule->save();
        $apiHeaderRules->push($headerRule);
        $webHeaderRules->push($headerRule);

        $headerRule = new HeaderRule;
        $headerRule->name = 'X-Content-Type-Options';
        $headerRule->description = 'X-Content-Type header prevent “MIME sniffing”. It allows the browser to scan the content and respond away from what the header may instruct. X-Content-Type-Options instruct browsers to set the content type as instructed and never detect the type their own.';
        $headerRule->validation_type = 'required';
        $headerRule->risk_level = 'medium';
        $headerRule->save();
        $apiHeaderRules->push($headerRule);
        $webHeaderRules->push($headerRule);

        $headerRule = new HeaderRule;
        $headerRule->name = 'X-Content-Type-Options';
        $headerRule->description = 'X-Content-Type header prevent “MIME sniffing”. It allows the browser to scan the content and respond away from what the header may instruct. X-Content-Type-Options instruct browsers to set the content type as instructed and never detect the type their own.';
        $headerRule->validation_type = 'regex';
        $headerRule->validation_value = '/nosniff/i';
        $headerRule->risk_level = 'medium';
        $headerRule->save();
        $apiHeaderRules->push($headerRule);
        $webHeaderRules->push($headerRule);

        $headerRule = new HeaderRule;
        $headerRule->name = 'X-Frame-Options';
        $headerRule->description = 'X-Frame-Options header enables clickjacking prevention by disabling iframes on your site. Iframes can be used by hackers to mirror legitimate clicks for their own purposes, this header fully mitigates that risk.';
        $headerRule->validation_type = 'required';
        $headerRule->risk_level = 'medium';
        $headerRule->save();
        $webHeaderRules->push($headerRule);

        $headerRule = new HeaderRule;
        $headerRule->name = 'X-Frame-Options';
        $headerRule->description = 'X-Frame-Options header enables clickjacking prevention by disabling iframes on your site. Iframes can be used by hackers to mirror legitimate clicks for their own purposes, this header fully mitigates that risk.';
        $headerRule->validation_type = 'regex';
        $headerRule->validation_value = '/^DENY|SAMEORIGIN|ALLOW-FROM$/i';
        $headerRule->risk_level = 'medium';
        $headerRule->save();
        $webHeaderRules->push($headerRule);

        $headerRule = new HeaderRule;
        $headerRule->name = 'Strict-Transport-Security';
        $headerRule->description = 'HSTS header prevents browsers from accessing web servers over non-HTTPS connections. This prevent SSLstrip attacks, when hackers launch a Man-in-the-Middle attack. Downside is HSTS can be used to deploy supercookies. All the major browsers support HSTS.';
        $headerRule->validation_type = 'required';
        $headerRule->risk_level = 'medium';
        $headerRule->save();
        $secureHeaderRules->push($headerRule);

        $headerRule = new HeaderRule;
        $headerRule->name = 'Strict-Transport-Security';
        $headerRule->description = 'HSTS header prevents browsers from accessing web servers over non-HTTPS connections. This prevent SSLstrip attacks, when hackers launch a Man-in-the-Middle attack. Downside is HSTS can be used to deploy supercookies. All the major browsers support HSTS.';
        $headerRule->validation_type = 'regex';
        $headerRule->validation_value = '/^max-age=[0-9]*(; includeSubDomains|; preload)*$/i';
        $headerRule->risk_level = 'medium';
        $headerRule->save();
        $secureHeaderRules->push($headerRule);

        $headerRule = new HeaderRule;
        $headerRule->name = 'Cache-Control';
        $headerRule->description = 'Cache-control is the HTTP/1.1 implementation meant to prevent the client from caching the response.';
        $headerRule->validation_type = 'required';
        $headerRule->risk_level = 'high';
        $headerRule->save();
        $apiHeaderRules->push($headerRule);
        $webHeaderRules->push($headerRule);

        $headerRule = new HeaderRule;
        $headerRule->name = 'Cache-Control';
        $headerRule->description = 'Cache-control is the HTTP/1.1 implementation meant to prevent the client from caching the response.';
        $headerRule->validation_type = 'regex';
        $headerRule->validation_value = '/^private|no-cache|must-revalidate$/i';
        $headerRule->risk_level = 'high';
        $headerRule->save();
        $apiHeaderRules->push($headerRule);
        $webHeaderRules->push($headerRule);

        $headerRule = new HeaderRule;
        $headerRule->name = 'Pragma';
        $headerRule->description = 'Pragma is the HTTP/1.0 implementation meant to prevent the client from caching the response.';
        $headerRule->validation_type = 'regex';
        $headerRule->validation_value;
        $headerRule->risk_level = 'high';
        $headerRule->save();
        $apiHeaderRules->push($headerRule);
        $webHeaderRules->push($headerRule);

        $headerRule = new HeaderRule;
        $headerRule->name = 'Pragma';
        $headerRule->description = 'Pragma is the HTTP/1.0 implementation meant to prevent the client from caching the response.';
        $headerRule->validation_type = 'regex';
        $headerRule->validation_value = '/^no-cache$/i';
        $headerRule->risk_level = 'high';
        $headerRule->save();
        $apiHeaderRules->push($headerRule);
        $webHeaderRules->push($headerRule);

        $headerRule = new HeaderRule;
        $headerRule->name = 'Public-Key-Pins';
        $headerRule->description = '';
        $headerRule->validation_type = 'required';
        $headerRule->risk_level = 'low';
        $headerRule->save();
        $secureHeaderRules->push($headerRule);

        $headerRule = new HeaderRule;
        $headerRule->name = 'Referrer-Policy';
        $headerRule->description = 'This header identifies the address of the webpage that linked to the resource being requested. By checking the referrer, the new webpage can see where the request originated from. In most cases that means that when an user clicks a hyperlink, the browser sends a request to the server holding the destination. The header is used for analytics, the Referrer-Policy header allows the user to specify when the browser will set a Referrer header.';
        $headerRule->validation_type = 'required';
        $headerRule->risk_level = '-';
        $headerRule->save();
        $webHeaderRules->push($headerRule);

        $headerRule = new HeaderRule;
        $headerRule->name = 'Referrer-Policy';
        $headerRule->description = 'This header identifies the address of the webpage that linked to the resource being requested. By checking the referrer, the new webpage can see where the request originated from. In most cases that means that when an user clicks a hyperlink, the browser sends a request to the server holding the destination. The header is used for analytics, the Referrer-Policy header allows the user to specify when the browser will set a Referrer header.';
        $headerRule->validation_type = 'regex';
        $headerRule->validation_value = '/^no-referrer|no-referrer-when-downgrade|origin|origin-when-cross-origin|same-origin|strict-origin|strict-origin-when-cross-origin$/';
        $headerRule->risk_level = '-';
        $headerRule->save();
        $webHeaderRules->push($headerRule);

        $headerRule = new HeaderRule;
        $headerRule->name = 'Expect-ct';
        $headerRule->description = 'This is a new http header, that allows web host operators to instruct user agents to expect valid Signed Certificate Timestamps(SCTs) to be served on connections to these hosts. When configured in enforcement mode, user agents(UAs) will remember that hosts expect SCTs and will refuse connections that do not conform to the UA’s Certificate Transparency policy. When configured in report-only mode, UAs will report the lack of valid SCTs to a URI configured by the host, but will allow the connection. By turning on Expect-CT, web host operators can discover misconfigurations in their Certificate Transparency deployments and ensure that misused certificates accepted by UAs are discoverable in Certificate Transparency logs.';
        $headerRule->validation_type = 'required';
        $headerRule->risk_level = '-';
        $headerRule->save();
        $secureHeaderRules->push($headerRule);

        $headerRule = new HeaderRule;
        $headerRule->name = 'Expect-ct';
        $headerRule->description = 'This is a new http header, that allows web host operators to instruct user agents to expect valid Signed Certificate Timestamps(SCTs) to be served on connections to these hosts. When configured in enforcement mode, user agents(UAs) will remember that hosts expect SCTs and will refuse connections that do not conform to the UA’s Certificate Transparency policy. When configured in report-only mode, UAs will report the lack of valid SCTs to a URI configured by the host, but will allow the connection. By turning on Expect-CT, web host operators can discover misconfigurations in their Certificate Transparency deployments and ensure that misused certificates accepted by UAs are discoverable in Certificate Transparency logs.';
        $headerRule->validation_type = 'required';
        $headerRule->validation_value = '/^max-age=[0-9]*, enforce, report-uri=/i';
        $headerRule->risk_level = '-';
        $headerRule->save();
        $secureHeaderRules->push($headerRule);

        $headerRule = new HeaderRule;
        $headerRule->name = 'Set-Cookie';
        $headerRule->description = 'HttpOnly, cannot be accessed from within JavaScript. So if there is an XSS flaw, attackers can’t immediately steal the cookies.';
        $headerRule->validation_type = 'regex';
        $headerRule->validation_value = '/httponly/i';
        $headerRule->risk_level = 'low';
        $headerRule->save();
        $webHeaderRules->push($headerRule);

        $headerRule = new HeaderRule;
        $headerRule->name = 'Set-Cookie';
        $headerRule->description = 'SameSite helps defend against Cross-Origin Request Forgery attacks. This is an attack where a different website the user may be visiting inadvertently tricks them into making a request against your site. Generally people defend against this using CSRF tokens, a cookie marked as SameSite won’t be sent to a different site. However SameSite is at the moment only available in Chrome and Opera.';
        $headerRule->validation_type = 'regex';
        $headerRule->validation_value = '/samesite/i';
        $headerRule->risk_level = 'low';
        $headerRule->save();
        $webHeaderRules->push($headerRule);

        $headerRule = new HeaderRule;
        $headerRule->name = 'x-powered-by';
        $headerRule->description = '';
        $headerRule->validation_type = 'prohibit';
        $headerRule->risk_level = 'high';
        $headerRule->save();
        $apiHeaderRules->push($headerRule);
        $webHeaderRules->push($headerRule);

        $headerRule = new HeaderRule;
        $headerRule->name = 'server';
        $headerRule->description = '';
        $headerRule->validation_type = 'prohibit';
        $headerRule->risk_level = 'high';
        $headerRule->save();
        $apiHeaderRules->push($headerRule);
        $webHeaderRules->push($headerRule);

        $apiProfiles = Profile::whereIdentifier('api')
            ->get();
        $apiProfiles->each(function (Profile $profile) use ($apiHeaderRules) {
            $profile->headerRules()->attach($apiHeaderRules->pluck('id'));
        });

        $webProfiles = Profile::where('identifier', '!=', 'api')
            ->get();
        $webProfiles->each(function (Profile $profile) use ($webHeaderRules) {
            $profile->headerRules()->attach($webHeaderRules->pluck('id'));
        });

        $secureProfiles = Profile::whereIdentifier('secure_connection_https')
            ->get();
        $secureProfiles->each(function (Profile $profile) use ($secureHeaderRules) {
            $profile->headerRules()->attach($secureHeaderRules->pluck('id'));
        });
    }
}
