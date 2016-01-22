Fontis Magento 2 Customer Group Access
======================================

This is a standalone package designed to help extensions limit access to
functionality such as payment methods to certain customer groups.

This is **NOT** a Magento 2 extension. It will not do anything by itself. It is
intended for developers to use while implementing extensions.

The recommended way to install this package is to make your extension depend on
this package in its `composer.json` file. To do so, add the following line to
the `require` section of the file:

```
{
    ...
    "require": {
        ...
        "fontis/customergroupaccess-mage2": "1.0.*",
        ...
    },
    ...
}
```

Once you've added this package as a dependency, follow these instructions for
actually using the package within your extension:

1. Add two settings to your system.xml file, using the relevant source models:
  * This `customer_group_access` with `Fontis\CustomerGroupAccess\Source\CustomerGroupAccess`
  * That `customer_group` with `Fontis\CustomerGroupAccess\Source\CustomerGroup`

2. In your `di.xml` file, define a `virtualType`. The `configPathPrefix` should be
   the section and group IDs that contain the settings you added above.

    ```xml
    <virtualType name="myModuleMyFeatureCustomerGroupAccessCheckFactory" type="Fontis\CustomerGroupAccess\AccessCheckFactory">
        <arguments>
            <argument name="configPathPrefix" xsi:type="string">my_settings_section/my_settings_group</argument>
        </arguments>
    </virtualType>
    ```

   Using this example, the full path to one of the settings would be like so:

    ```
    my_settings_section/my_settings_group/customer_group_access
    ```

3. Use the virtualType to configure the model where your access checks need to
   be performed:

    ```xml
    <type name="MyNamespace\MyModule\Model\MyFeature\MyModel">
        <arguments>
            <argument name="accessCheckFactory" xsi:type="object">myModuleMyFeatureCustomerGroupAccessCheckFactory</argument>
        </arguments>
    </type>
    ```

4. In your model's constructor, accept this class as one of the arguments:

    ```
    Fontis\CustomerGroupAccess\AccessCheckFactory
    ```

5. When you actually need to perform the access check, use the factory to
   create an instance of the access check class. If you need to perform the
   check in the context of a store that isn't the current store, you'll need
   to pass in a store ID:

    ```php
    $accessCheck = $this->accessCheckFactory->create(array("storeId" => $this->getStore()));
    ```

6. Perform the check by calling the `check()` method and passing it a customer
   group ID. If it returns true, they're allowed to use whatever it is you're
   offering. If it returns false, they aren't. Simple!
