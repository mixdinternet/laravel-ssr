<?php

namespace Mixdinternet\SSR\Middleware;

use Closure;
use JonnyW\PhantomJs\Client;

class SSRMiddleware
{
    public function handle($request, Closure $next)
    {
        $_server = $request->server();
        $protocol = ($_server['SERVER_PORT'] == 443) ? 'https://' : 'http://';
        $url = $protocol . $_server['HTTP_HOST'] . $_server['REQUEST_URI'];

        if ($_server['REQUEST_METHOD'] != 'GET') {
            return $next($request);
        }

        $fragment = '?_escaped_fragment_=';

        if (strpos($url, $fragment) === false) {
            return $next($request);
        }

        $key = md5($url);
        $content = cache()->get($key, function () use ($key, $url, $fragment) {

            $client = Client::getInstance();
            $client->getEngine()->setPath(config('ssr.phantom_location'));
            $client->isLazy();

            $request = $client->getMessageFactory()->createRequest(str_replace($fragment, '', $url), 'GET');
            $request->setTimeout(config('ssr.timeout'));

            $response = $client->getMessageFactory()->createResponse();

            $client->send($request, $response);

            if ($response->getStatus() === 200) {
                $content = $response->getContent();
                cache()->put($key, $content, config('ssr.lifetime'));

                return $content;
            }
        });

        return response($content);
    }
}