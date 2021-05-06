# EurocommerceLinker

## Init

```php
$parameters = Parameters::create([
    'login' => 'mylogin',
    'password' => 'mypassword',
    'debug' => false
]);

$gateway = new ApiFactory(
    new SessionFactory()
);

$api = $gateway->create($parameters);
```

## Orders

### Orders::get()

```php
try {
    $response = $api->orders()->get(123456);
    var_dump($response);
} catch (\Exception $e) {
    var_dump($e->getMessage());
}
```

### Orders:all()

```php
try {

    $response = $api->orders()->all();
    var_dump($response);

} catch (\Exception $e) {
    var_dump($e->getMessage());
}
```

### Orders:create()

```php

$delivery = $api->make()->delivery();
$delivery->setCarier(CarierType::POCZTK48OP)
    ->setCurrencyCOD('PLN')
    ->setAmountCOD(12.22)
    ->setAdditionalInfo('Dodatkowe informacje o dostawie, np. numer paczkomatu')
    ->setNote('Notatka dla kuriera');

$positions = $api->make()->positions();

$position = $api->make()->position();
$position
    ->setProductId(377800)
    ->setRefId(279)
    ->setAdditionalId('id#350')
    ->setQuantity(1);

$positions->add($position);

$order = $api->make()->order();
$order->setRefId('123456')
    ->setNumber('#Order:654321')
    ->setSource('api')
    ->setStatus('ROBOCZE')
    ->setComments('Uwagi dla magazynu')
    ->setDelivery($delivery)
    ->setContactPerson('Jan Kowalski')
    ->setPhone('500600700')
    ->setEmail('test@test.dev')
    ->setName1('Nazwa firmy lub imię i nazwisko cz. 1')
    ->setName2('Nazwa firmy lub imię i nazwisko cz. 2')
    ->setName3('Nazwa firmy lub imię i nazwisko cz. 3')
    ->setPostalCode('00-001')
    ->setCountryCode('pl')
    ->setPlace('Warszawa')
    ->setStreet('ulica Nowa 12/1')
    ->setNote('Notatka do zamówienia')
    ->setPositions($positions)
try {
    $response = $api->orders()->create($order);
    var_dump($response);
} catch (\Exception $e) {
    var_dump($e->getMessage());
}
```

### Orders:update()

```php
try {
    $order = $api->orders()->get(123456);
    $order->setName1('Jan Kolwaski');
    $response = $api->orders()->update($order);
    var_dump($response);
} catch (\Exception $e) {
    var_dump($e->getMessage());
}
```

### Orders:delete()

```php
try {
    $response = $api->orders()->delete(123456);
    var_dump($response);
} catch (\Exception $e) {
    var_dump($e->getMessage());
}
```

## Products

### Products::get()

```php
try {
    $response = $api->products()->get(123456);
    var_dump($response);
} catch (\Exception $e) {
    var_dump($e->getMessage());
}
```

### Products::all()

```php
try {
    $response = $api->products()->all();
    var_dump($response);
} catch (\Exception $e) {
    var_dump($e->getMessage());
}
```


### Products::create()

```php
try {
    $product = $api->make()->product();
    $product
        ->setRefId(123456)
        ->setAdditionalId(098765)
        ->setName('Product name')
        ->setSku('1234567890')
        ->setEan('72678640')
        ->setCode128('code128')
        ->setActive(false)
        ->setWeight(2.5)
        ->setLength(10)
        ->setWidth(20)
        ->setHeight(30);

    $response = $api->products()->create($product);
    var_dump($response);
} catch (\Exception $e) {
    var_dump($e->getMessage());
}
```

### Products::update()

```php
try {
    $product = $api->products()->get(123456);;
    $product->setName('New product name')
    $response = $api->products()->update($product);
    var_dump($response);
} catch (\Exception $e) {
    var_dump($e->getMessage());
}
```

## ProductStocks

### ProductStocks::get()

```php
try {
    $response = $api->productStocks()->get(123456);
    var_dump($response);
} catch (\Exception $e) {
    var_dump($e->getMessage());
}
```

### ProductStocks::all()

```php
try {
    $response = $api->productStocks()->all();
    var_dump($response);
} catch (\Exception $e) {
    var_dump($e->getMessage());
}
```

## Komendy

| KOMENDA | OPIS |
| ------ | ------ |
| composer tests | Testy |
| composer phpstan |  PHPStan |
| composer coverage | PHPUnit Coverage |
| composer coverage-html | PHPUnit Coverage HTML (DIR: ./coverage/) |