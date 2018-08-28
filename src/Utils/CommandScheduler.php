<?php

namespace ScheduledCommandBundle\Model;

class CommandScheduler
{
    /** @var string */
    private $temporalDirectory;

    public function __construct(string $temporalDirectory)
    {
        $this->temporalDirectory = $temporalDirectory;
    }

    /**
     * Schedules the command at the given datetime. It doesn't work
     * ow Windows environments.
     *
     * Returns false if windows.
     *
     * @param string $command
     * @param \DateTime $datetime
     *
     * @return false|CommandSchedulerResponse
     *
     * @throws \Exception
     */
    public function scheduleCommand(string $command, \DateTime $datetime)
    {
        // If windows
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            throw new \Exception("Command scheduler bundle does not work with Windows OS");
        }

        $uniqid = uniqid();
        $filename = "{$this->temporalDirectory}/$uniqid";
        file_put_contents($filename, $command);
        exec(
            "at -f $filename {$datetime->format('h:i A m/d/Y')} 2>&1",
            $output,
            $returnValue
        );

        // Get the job number from the output
        preg_match('/(?<=job )\S+/i', implode("\n", $output), $match);
        if(sizeof($match) == 0) {
            throw new \Exception('Error : Job Scheduler Failed');
        }

        $return = new CommandSchedulerResponse();

        $return->setFilename($filename);
        $return->setJobId((int) $match[0]);

        return $return;
    }

    /**
     * Removes scheduled command by job id
     *
     * @param $jobId
     */
    public function removeScheduledCommand($jobId)
    {
        if (strtoupper(substr(PHP_OS, 0, 3)) !== 'WIN') {
            exec ("at -r $jobId");
        }
    }
}
