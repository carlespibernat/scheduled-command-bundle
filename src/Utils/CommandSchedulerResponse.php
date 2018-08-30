<?php

namespace ScheduledCommandBundle\Utils;

class CommandSchedulerResponse
{
    /** @var string */
    private $filename;

    /** @var int */
    private $jobId;

    /**
     * @return string
     */
    public function getFilename(): ?string
    {
        return $this->filename;
    }

    /**
     * @param string $filename
     */
    public function setFilename(string $filename): void
    {
        $this->filename = $filename;
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
}