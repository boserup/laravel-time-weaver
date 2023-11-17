# Laravel Time Weaver
A small footprint package designed for seamlessly tracking and logging the response time of external HTTP requests
within your Laravel applications. Inspired by the realms of science fiction, this package acts as a temporal guardian,
meticulously recording and analyzing the chronicles of your application's interactions with the vast digital cosmos.

## Installation
```bash
composer require boserup/laravel-time-weaver
```

## Getting Started
1. **Configure AWS Credentials:**
   By default Laravel Time Weaver logs to CloudWatch.
   Set the following environment variables to configure AWS credentials:
    - `AWS_REGION`: Your AWS region.
    - `CLOUDWATCH_KEY`: Your CloudWatch access key.
    - `CLOUDWATCH_SECRET`: Your CloudWatch secret key.

2. **Customize Metric Namespace:**
   If you wish to change the default metric namespace from "LaravelTimeWeaver," set the
   `TIME_WEAVER_CLOUDWATCH_METRIC_NAMESPACE` environment variable.

3. **Adjust Metric Name:**
   To modify the default metric name from "ExternalHttpResponseTime," set the `TIME_WEAVER_CLOUDWATCH_METRIC_NAME`
   environment variable.

4. **Toggle Logging for all hosts:**
   By default Laravel Time Weaver will log the response time for all outgoing requests. Toggle this behaviour by setting
   the `TIME_WEAVER_LOG_ALL_HOSTS` environment variable. If set to `false`, you'll need to publish the configuration
   file to define the list of allowed hosts.

   ```bash
   php artisan vendor:publish --tag=time-weaver-config
   ```

## Using a Custom Logger
Laravel Time Weaver allows you to use a custom logger for recording response times. By default, the package ships with
CloudFront metric logging. However, you have the flexibility to implement your own logger by following these steps:

1. **Publish Configuration File:**
   If you haven't already, publish the configuration file using the following command:

   ```bash
   php artisan vendor:publish --tag=time-weaver-config
   ```

   This will create a configuration file `(config/time-weaver.php)` in the `config` directory.

2. **Update Configuration:**
   Open the published configuration file. Within this file, you can customize the logger class.

   ```php
   return [
      // Other configuration options...

      'logger' => \Your\Custom\Logger\CustomLogger::class,

      // Other configuration options...
   ];
   ```
   
   Set the `'logger' attribute to the fully-qualified class name of your custom logger.

3. **Implement Custom Logger:**
    Your custom logger class should implement the `LoggerContract` interface, defined as such:

   ```php
   <?php
   
   namespace Your\Custom\Logger;
   
   use Boserup\LaravelTimeWeaver\Contracts\LoggerContract;
   
   class CustomLogger implements LoggerContract
   {
      public function log(string $hostname, float $time): void
      {
         // Logic goes here...
      }
   }
   
   ?>
   ```

## Contributing
We welcome contributions from fellow time travelers and developers. Feel free to fork the repository, make improvements,
and submit pull requests.

## License
Laravel Time Weaver is open-source software licensed under the MIT license.

Embark on a journey through time and space with Laravel Time Weaver – your trusted companion in unraveling the mysteries
of response time optimization!
