Up2green
========

1) Installation
--------------------------------

### a) Clone the git Repository

Run the following commands:

    git clone git@github.com:SmartIT-Fr/Up2green.git

### b) Check your System Configuration

Before you begin, make sure that your local system is properly configured
for Symfony. To do this, execute the following:

    php app/check.php

### c) Install the Vendor Libraries

    php bin/vendors install

### d) Access the Application via the Browser and check the config

    http://localhost/Symfony/web/config.php

What's inside?
---------------
The Symfony Standard Edition comes pre-configured with the following bundles:
	
* **FrameworkBundle** - The core Symfony framework bundle
* **SensioFrameworkExtraBundle** - Adds several enhancements, including template
  and routing annotation capability ([documentation](http://symfony.com/doc/current/bundles/SensioFrameworkExtraBundle/index.html))
* **DoctrineBundle** - Adds support for the Doctrine ORM
  ([documentation](http://symfony.com/doc/current/book/doctrine.html))
* **TwigBundle** - Adds support for the Twig templating engine
  ([documentation](http://symfony.com/doc/current/book/templating.html))
* **SecurityBundle** - Adds security by integrating Symfony's security component
  ([documentation](http://symfony.com/doc/current/book/security.html))
* **SwiftmailerBundle** - Adds support for Swiftmailer, a library for sending emails
  ([documentation](http://symfony.com/doc/2.0/cookbook/email.html))
* **MonologBundle** - Adds support for Monolog, a logging library
  ([documentation](http://symfony.com/doc/2.0/cookbook/logging/monolog.html))
* **AsseticBundle** - Adds support for Assetic, an asset processing library
  ([documentation](http://symfony.com/doc/2.0/cookbook/assetic/asset_management.html))
* **JMSSecurityExtraBundle** - Allows security to be added via annotations
  ([documentation](http://symfony.com/doc/current/bundles/JMSSecurityExtraBundle/index.html))
* **WebProfilerBundle** (in dev/test env) - Adds profiling functionality and
  the web debug toolbar
* **SensioDistributionBundle** (in dev/test env) - Adds functionality for configuring
  and working with Symfony distributions
* **SensioGeneratorBundle** (in dev/test env) - Adds code generation capabilities
  ([documentation](http://symfony.com/doc/current/bundles/SensioGeneratorBundle/index.html))
* **AcmeDemoBundle** (in dev/test env) - A demo bundle with some example code

Enjoy!
