<?php

namespace weed\deepcommand;

use pocketmine\player\Player;

abstract class BaseArgument {

    public function __construct(
        public string $name
    ){}
    
    abstract public function execute(Player $player, array $args): void;
    
    public function getName(): string {
        return $this->name;
    }

}