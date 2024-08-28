<?php

namespace weed\deepcommand;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;

abstract class BaseCommand extends Command  {

    public array $arguments = [];

    public function __construct($name, $description, $usageMessage, $aliases = [], $permission = null) {
        parent::__construct($name, $description, $usageMessage, $aliases);
        $this->setPermission($permission);
    }
    
    public function execute(CommandSender $sender, string $commandLabel, array $args) {
        if (count($args) === 0) {
            $this->showUsage($sender);
            return;
        }
        
        foreach ($args as $arg) {
            if (isset($this->arguments[$arg])) {
                $this->arguments[$arg]->execute($sender, $args);
                return;
            }
        }
        $this->showUsage($sender);
    }
    
    public function showUsage(CommandSender $sender) {
        $sender->sendMessage($this->getUsage());
    }
    
    public function getArguments() {
        return $this->arguments;
    }
    
    public function getArgument(string $name): ?BaseArgument {
        return $this->arguments[$name] ?? null;
    }
    
    public function addArgument(BaseArgument $argument) {
        $this->arguments[$argument->getName()] = $argument;
    }

}