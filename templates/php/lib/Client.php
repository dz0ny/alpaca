<?php

namespace {{call .Fnc.camelize .Pkg.Name}};

use {{call .Fnc.camelize .Pkg.Name}}\HttpClient\HttpClient;

class Client
{
    private $httpClient;

    public function __construct({{if .Api.base_as_arg}}$baseUrl, {{end}}$auth = array(), array $options = array())
    {
        $this->httpClient = new HttpClient({{if .Api.base_as_arg}}$baseUrl, {{end}}$auth, $options);
    }
{{with $data := .}}{{range .Api.classes}}
    /**
     * {{index $data.Doc . "desc"}}{{with (index $data.Api.class . "args")}}
     *{{end}}{{with $class := .}}{{range (index $data.Api.class $class "args")}}
     * @param ${{.}} {{index $data.Doc $class "args" . "desc"}}{{end}}{{end}}
     */
    public function {{call $data.Fnc.camelizeDownFirst .}}({{call $data.Fnc.args.php (index $data.Api.class . "args") true}})
    {
        return new Api\{{call $data.Fnc.camelize .}}({{call $data.Fnc.args.php (index $data.Api.class . "args")}}$this->httpClient);
    }
{{end}}{{end}}
}
