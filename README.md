Command Scheduler Symfony bundle
================================

This bundle let you schedule commands using the unix `at` command.  

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
    temp_command_files_dir: hola
```

At the moment this bundle is only working in unix environments where the `at` command
is install, but it would be nice to add Windows compatibility.