<?php

namespace Classes;

class Response
{
    protected string $content;
    protected string $headers = "";
    protected int $statusCode;
    protected string $statusText;
    /**
     * @var array <int,string> $statusTexts
     */
    public static array $statusTexts = [
        100 => 'Continue',
        101 => 'Switching Protocols',
        102 => 'Processing',            // RFC2518
        103 => 'Early Hints',
        200 => 'OK',
        201 => 'Created',
        202 => 'Accepted',
        203 => 'Non-Authoritative Information',
        204 => 'No Content',
        205 => 'Reset Content',
        206 => 'Partial Content',
        207 => 'Multi-Status',          // RFC4918
        208 => 'Already Reported',      // RFC5842
        226 => 'IM Used',               // RFC3229
        300 => 'Multiple Choices',
        301 => 'Moved Permanently',
        302 => 'Found',
        303 => 'See Other',
        304 => 'Not Modified',
        305 => 'Use Proxy',
        307 => 'Temporary Redirect',
        308 => 'Permanent Redirect',    // RFC7238
        400 => 'Bad Request',
        401 => 'Unauthorized',
        402 => 'Payment Required',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        406 => 'Not Acceptable',
        407 => 'Proxy Authentication Required',
        408 => 'Request Timeout',
        409 => 'Conflict',
        410 => 'Gone',
        411 => 'Length Required',
        412 => 'Precondition Failed',
        413 => 'Content Too Large',                                           // RFC-ietf-httpbis-semantics
        414 => 'URI Too Long',
        415 => 'Unsupported Media Type',
        416 => 'Range Not Satisfiable',
        417 => 'Expectation Failed',
        418 => 'I\'m a teapot',                                               // RFC2324
        421 => 'Misdirected Request',                                         // RFC7540
        422 => 'Unprocessable Content',                                       // RFC-ietf-httpbis-semantics
        423 => 'Locked',                                                      // RFC4918
        424 => 'Failed Dependency',                                           // RFC4918
        425 => 'Too Early',                                                   // RFC-ietf-httpbis-replay-04
        426 => 'Upgrade Required',                                            // RFC2817
        428 => 'Precondition Required',                                       // RFC6585
        429 => 'Too Many Requests',                                           // RFC6585
        431 => 'Request Header Fields Too Large',                             // RFC6585
        451 => 'Unavailable For Legal Reasons',                               // RFC7725
        500 => 'Internal Server Error',
        501 => 'Not Implemented',
        502 => 'Bad Gateway',
        503 => 'Service Unavailable',
        504 => 'Gateway Timeout',
        505 => 'HTTP Version Not Supported',
        506 => 'Variant Also Negotiates',                                     // RFC2295
        507 => 'Insufficient Storage',                                        // RFC4918
        508 => 'Loop Detected',                                               // RFC5842
        510 => 'Not Extended',                                                // RFC2774
        511 => 'Network Authentication Required',                             // RFC6585
    ];

    /**
     * @param array <string,string> $headers
     */
    public function __construct(string $content = '', int $status = 200, array $headers = [])
    {
        $this->setContent($content);
        $this->setHeaders($headers);
        $this->statusCode = $status;
        $this->statusText = self::$statusTexts[$status] ?? 'unknown status';
    }

    public function __toString(): string
    {
        header(sprintf('HTTP/1.1 %s %s', $this->statusCode, $this->statusText));
        //header('HTTP/1.1' . $this->statusCode . $this->statusText);
        header($this->headers);
        return $this->getContent();
    }

    /**
     * @param array <string,string> $headers
     */
    public function setHeaders(array $headers): void
    {
        $content = '';
        foreach ($headers as $key => $value) {
            $content .= sprintf("%-s %s\r\n", $key . ':', $value);
        }
        $this->headers = $content;
    }

    /**
     * @return $this
     */

    public function setContent(?string $content): static
    {
        $this->content = $content ?? '';

        return $this;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @return $this
     */

    public function sendContent(): static
    {
        echo $this->content;

        return $this;
    }

    /**
     * @return $this
     */

    public function send(): static
    {
        $this->sendContent();

        return $this;
    }
    public static function redirect(string $url): string
    {
        $content = sprintf('<!DOCTYPE html>
        <html>
            <head>
                <meta charset="UTF-8" />
                <meta http-equiv="refresh" content="0;url=\'%1$s\'" />
            </head>
        </html>', htmlspecialchars($url));
        return $content;
    }
}
