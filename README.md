# Cloudflare PHP Class

Simple PHP class for Cloudflare API

--- 
## Main init
You can require the class through Composer:
```sh
composer require mdobes/cfclass:dev-master
```

```php
$domain = new mdobes\CloudFlare();
$domain->apikey = ""; //Cloudflare API key, not API token!
$domain->email = ""; //Cloudflare Email
```

## Register domain
```php
$domain->name = ""; //Domain
echo $domain->zoneRegister();
```

## Information about domain
```php
$domain->name = ""; //Domain
echo $domain->zoneInfo();
```

## Turn DEV Mode on domain
```php
$domain->zoneid = ""; //Domain ID (Domain id is in zoneInfo());
echo $domain->zoneDevMode('on'); //Value: on or off 
```

## Information about DEV Mode on domain
```php
$domain->zoneid = ""; //Domain ID (Domain id is in zoneInfo());
echo $domain->zoneDevModeInfo();
```

## Domain delete
```php
$domain->zoneid = ""; //Domain ID (Domain id is in zoneInfo());
echo $domain->zoneRemove();
```

## DNS records list
```php
$domain->zoneid = ""; //Domain ID (Domain id is in zoneInfo());
echo $domain->dnsList();
```

## Add DNS record
```php
$domain->zoneid = ""; // Domain ID (Domain id is in zoneInfo());
echo $domain->dnsAdd('A', 'test.werwi.eu', '173.249.28.105', true); //Record type, domain, content, proxied on CloudFlare
```
SRV record:
```php
array(
	'type' => 'SRV',
	'data' => array(
		"name" => "test.werwi.eu",
		"ttl" => 120,
		"service" => "service",
		"proto" => "protocol",
		"weight" => 5,
		"port" => 11,
		"priority" => 0,
		"target" => "target"
		)
)
```


## DNS record update
```php
$domain->zoneid = ""; //Domain ID (Domain id is in zoneInfo());
echo $domain->dnsUpdate('cb231ddd3092f3ed8...', 'A', 'test.werwi.eu', '192.168.0.1', true); //Record ID (in DNS record list), record type, content, proxied on CloudFlare
```

## Remove DNS record
```php
$domain->zoneid = ""; // Domain ID (Domain id is in zoneInfo());
echo $domain->dnsRemove('cb231ddd3092f3ed8...'); //Record ID (in DNS record list)
```
