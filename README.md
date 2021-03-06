Command Scheduler Symfony bundle
================================

This bundle lets you schedule commands using the unix `at` command.  

Installation
------------
Open a command console, enter your project directory and execute the following command to download the latest stable 
version of this bundle:
```
composer require carles/scheduled-command-bundle
```
This command requires you to have Composer installed globally, as explained in the installation chapter of the 
[Composer documentation](https://getcomposer.org/doc/00-intro.md).

Usage
-----

To schedule a command simply configure a `ScheduledCommand` and persist it:

```php
use CommandSchedulerBundle\Entity\ScheduledCommand;

$scheduledCommand = new ScheduledCommand();

$scheduledCommand->setCommand("echo 'Happy New Year'");
$scheduledCommand->setDatetime(new \DateTime('01-01-2020 00:00:00'));

$this->getDoctrine()->getManager()->persist($scheduledCommand);
$this->getDoctrine()->getManager()->flush();

```

The bundle uses doctrine events to create an `at` job with the configured command. The command 
will be stored in a file under the configured directory.  
The default directory is */tmp*, but feel free to change it in the configuration:
```yaml
scheduled_command:
    temp_command_files_dir: /my/directory
```

At the moment this bundle is only working in unix environments where the `at` command
is installed, but it would be nice to add Windows compatibility in the future.
