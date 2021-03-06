# {{.Pkg.Git.Name}}-python

{{if .Pkg.Official}}Official {{end}}{{.Pkg.Name}} API library client for python

__This library is generated by [alpaca](https://github.com/pksunkara/alpaca)__

## Installation

Make sure you have [pip](https://pypi.python.org/pypi/pip) installed

```bash
$ pip install {{.Pkg.Package}}
```

#### Versions

Works with [ 2.6 / 2.7 / 3.2 / 3.3 ]

## Usage

```python
import {{call .Fnc.underscore .Pkg.Name}}

# Then we instantiate a client (as shown below)
```

### Build a client
{{if .Api.authorization.need_auth}}
__Using this api without authentication gives an error__
{{else}}
##### Without any authentication

```python
client = {{call .Fnc.underscore .Pkg.Name}}.Client({{if .Api.base_as_arg}}'{{.Api.base}}'{{end}})

# If you need to send options
client = {{call .Fnc.underscore .Pkg.Name}}.Client({{if .Api.base_as_arg}}'{{.Api.base}}', {{end}}{}, client_options)
```
{{end}}{{if .Api.authorization.basic}}
##### Basic authentication

```python
auth = { 'username': 'pksunkara', 'password': 'password' }

client = {{call .Fnc.underscore .Pkg.Name}}.Client({{if .Api.base_as_arg}}'{{.Api.base}}', {{end}}auth, client_options)
```
{{end}}{{if .Api.authorization.header}}
##### Authorization header token

```python
client = {{call .Fnc.underscore .Pkg.Name}}.Client({{if .Api.base_as_arg}}'{{.Api.base}}', {{end}}{{if .Api.authorization.oauth}}{'http_header': '1a2b3'}{{else}}'1a2b3'{{end}}, client_options)
```
{{end}}{{if .Api.authorization.oauth}}
##### Oauth acess token

```python
client = {{call .Fnc.underscore .Pkg.Name}}.Client({{if .Api.base_as_arg}}'{{.Api.base}}', {{end}}'1a2b3', client_options)
```

##### Oauth client secret

```python
auth = { 'client_id': '09a8b7', 'client_secret': '1a2b3' }

client = {{call .Fnc.underscore .Pkg.Name}}.Client({{if .Api.base_as_arg}}'{{.Api.base}}', {{end}}auth, client_options)
```
{{end}}
### Client Options

The following options are available while instantiating a client:

 * __base__: Base url for the api
 * __api_version__: Default version of the api (to be used in url)
 * __user_agent__: Default user-agent for all requests
 * __headers__: Default headers for all requests
 * __request_type__: Default format of the request body{{if .Api.response.suffix}}
 * __response_type__: Default format of the response (to be used in url suffix){{end}}

### Response information

__All the callbacks provided to an api call will recieve the response as shown below__

```python
response = client.klass('args').method('args', method_options)

response.code
# >>> 200

response.headers
# >>> {'x-server': 'apache'}
```
{{if .Api.response.formats.html}}
##### HTML/TEXT response

When the response sent by server is either __html__ or __text__, it is not changed in any way

```python
response.body
# >>> 'The username is pksunkara!'
```
{{end}}{{if .Api.response.formats.json}}
##### JSON response

When the response sent by server is __json__, it is decoded into a dict

```python
response.body
# >>> {'user': 'pksunkara'}
```
{{end}}
### Method Options

The following options are available while calling a method of an api:

 * __api_version__: Version of the api (to be used in url)
 * __headers__: Headers for the request
 * __query__: Query parameters for the url
 * __body__: Body of the request
 * __request_type__: Format of the request body{{if .Api.response.suffix}}
 * __response_type__: Format of the response (to be used in url suffix){{end}}

### Request body information

Set __request_type__ in options to modify the body accordingly

##### RAW request

When the value is set to __raw__, don't modify the body at all.

```python
body = 'username=pksunkara'
# >>> 'username=pksunkara'
```
{{if .Api.request.formats.form}}
##### FORM request

When the value is set to __form__, urlencode the body.

```python
body = {'user': 'pksunkara'}
# >>> 'user=pksunkara'
```
{{end}}{{if .Api.request.formats.json}}
##### JSON request

When the value is set to __json__, JSON encode the body.

```python
body = {'user': 'pksunkara'}
# >>> '{"user": "pksunkara"}'
```
{{end}}{{with $data := .}}{{range .Api.classes}}
### {{index $data.Doc . "title"}} api

{{index $data.Doc . "desc"}}{{with (index $data.Api.class . "args")}}

The following arguments are required:
{{end}}{{with $class := .}}{{range (index $data.Api.class . "args")}}
 * __{{.}}__: {{index $data.Doc $class "args" . "desc"}}{{end}}

```python
{{call $data.Fnc.underscore .}} = client.{{call $data.Fnc.underscore .}}({{call $data.Fnc.prnt.python (index $data.Doc . "args") ", " false}})
```
{{range (call $data.Fnc.methods (index $data.Api.class .))}}
##### {{index $data.Doc $class . "title"}} ({{call $data.Fnc.upper (or (index $data.Api.class $class . "method") "get")}} {{index $data.Api.class $class . "path"}})

{{index $data.Doc $class . "desc"}}{{with (index $data.Api.class $class . "params")}}

The following arguments are required:
{{end}}{{with $method := .}}{{range (index $data.Api.class $class . "params")}}{{if .required}}
 * __{{.name}}__: {{index $data.Doc $class $method "params" .name "desc"}}{{end}}{{end}}{{end}}

```python
response = {{call $data.Fnc.underscore $class}}.{{call $data.Fnc.underscore .}}({{call $data.Fnc.prnt.python (index $data.Doc $class . "params") ", " true}}options)
```
{{end}}{{end}}{{end}}{{end}}
## Contributors
Here is a list of [Contributors](https://{{.Pkg.Git.Site}}/{{.Pkg.Git.User}}/{{.Pkg.Git.Name}}-python/contributors)

### TODO

## License
{{.Pkg.License}}

## Bug Reports
Report [here](https://{{.Pkg.Git.Site}}/{{.Pkg.Git.User}}/{{.Pkg.Git.Name}}-python/issues).

## Contact
{{.Pkg.Author.Name}} ({{.Pkg.Author.Email}})
