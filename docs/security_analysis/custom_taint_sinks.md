# Custom Taint Sinks

You can define your own taint sinks two ways

## Using a docblock annotation

The `@psalm-taint-sink <taint-type> <param-name>` annotation allows you to define a taint sink.

Any tainted value matching the given [taint type](index.md#taint-types) will be reported as an error by Psalm.

### Example

Here the `PDOWrapper` class has an `exec` method that should not recieve tainted SQL, so we can prevent its insertion:

```php
<?php

class PDOWrapper {
    /**
     * @psalm-taint-sink sql $sql
     */
    public function exec(string $sql) : void {}
}
```

## Using a Psalm plugin

TODO
