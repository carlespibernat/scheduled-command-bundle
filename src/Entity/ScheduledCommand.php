<?php

namespace ScheduledCommandBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="scheduled_command")
 */
class ScheduledCommand
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $datetime;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $command;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $commandFile;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $jobId;

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return \DateTime
     */
    public function getDatetime(): ?\DateTime
    {
        return $this->datetime;
    }

    /**
     * @param \DateTime $datetime
     */
    public function setDatetime(\DateTime $datetime): void
    {
        $this->datetime = $datetime;
    }

    /**
     * @return string
     */
    public function getCommand(): ?string
    {
        return $this->command;
    }

    /**
     * @param string $command
     */
    public function setCommand(string $command): void
    {
        $this->command = $command;
    }

    /**
     * @return string
     */
    public function getCommandFile(): ?string
    {
        return $this->commandFile;
    }

    /**
     * @param string $commandFile
     */
    public function setCommandFile(string $commandFile): void
    {
        $this->commandFile = $commandFile;
    }

    /**
     * @return int
     */
    public function getJobId(): ?int
    {
        return $this->jobId;
    }

    /**
     * @param int $jobId
     */
    public function setJobId(int $jobId): void
    {
        $this->jobId = $jobId;
    }

    public function __toString()
    {
        return (string) $this->getId();
    }
}