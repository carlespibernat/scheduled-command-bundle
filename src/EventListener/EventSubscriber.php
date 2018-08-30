<?php

namespace ScheduledCommandBundle\EventListener;

use Doctrine\Common\EventSubscriber as EventSubscriberInterface;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use ScheduledCommandBundle\Entity\ScheduledCommand;
use ScheduledCommandBundle\Utils\CommandScheduler;

class EventSubscriber implements EventSubscriberInterface
{
    /** @var CommandScheduler */
    private $commandScheduler;

    public function __construct(CommandScheduler $commandScheduler)
    {
        $this->commandScheduler = $commandScheduler;
    }

    public function getSubscribedEvents()
    {
        return [
            "prePersist",
            "preUpdate",
            "preRemove"
        ];
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $scheduledCommand = $args->getObject();

        if ($scheduledCommand instanceof ScheduledCommand) {

            $result = $this->commandScheduler->scheduleCommand(
                $scheduledCommand->getCommand(),
                $scheduledCommand->getDatetime()
            );

            $scheduledCommand->setJobId($result->getJobId());
            $scheduledCommand->setCommandFile($result->getFilename());
        }
    }

    public function preUpdate(LifecycleEventArgs $args)
    {
        $scheduledCommand = $args->getObject();

        if ($scheduledCommand instanceof ScheduledCommand) {

            $commandScheduler = $this->commandScheduler;
            $commandScheduler->removeScheduledCommand($scheduledCommand->getJobId());
            if (strtoupper(substr(PHP_OS, 0, 3)) !== 'WIN') {
                unlink($scheduledCommand->getCommandFile());
            }

            $result = $commandScheduler->scheduleCommand(
                $scheduledCommand->getCommand(),
                $scheduledCommand->getDatetime()
            );

            $scheduledCommand->setJobId($result->getJobId());
            $scheduledCommand->setCommandFile($result->getFilename());
        }
    }

    public function preRemove(LifecycleEventArgs $args)
    {
        $scheduledCommand = $args->getObject();

        if ($scheduledCommand instanceof ScheduledCommand) {

            $this->commandScheduler->removeScheduledCommand($scheduledCommand->getJobId());
            if (strtoupper(substr(PHP_OS, 0, 3)) !== 'WIN') {
                unlink($scheduledCommand->getCommandFile());
            }

        }
    }
}