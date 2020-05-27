<?php

declare(strict_types=1);

namespace HyperFlareMC\PMRequisites;

use HyperFlareMC\PMRequisites\commands\Broadcast;
use HyperFlareMC\PMRequisites\commands\ClearHotBar;
use HyperFlareMC\PMRequisites\commands\ClearInventory;
use HyperFlareMC\PMRequisites\commands\ClearLag;
use HyperFlareMC\PMRequisites\commands\Compass;
use HyperFlareMC\PMRequisites\commands\Feed;
use HyperFlareMC\PMRequisites\commands\Fly;
use HyperFlareMC\PMRequisites\commands\GetPos;
use HyperFlareMC\PMRequisites\commands\Heal;
use HyperFlareMC\PMRequisites\commands\Nick;
use HyperFlareMC\PMRequisites\commands\Ping;
use HyperFlareMC\PMRequisites\commands\Repair;
use HyperFlareMC\PMRequisites\commands\SetSpawn;
use HyperFlareMC\PMRequisites\commands\Spawn;
use HyperFlareMC\PMRequisites\commands\Sudo;
use HyperFlareMC\PMRequisites\commands\Vanish;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase{

    public function onEnable() : void{
        $this->getServer()->getPluginManager()->registerEvents(new EventListener($this), $this);
        $this->registerCommands();
        $commands = [
            "say",
            "me"
        ];
        $this->unregisterCommands($commands);
    }

    public function registerCommands() : void{
        $this->getServer()->getCommandMap()->registerAll($this->getName(), [
            new Broadcast(),
            new ClearHotBar(),
            new ClearInventory(),
            new ClearLag(),
            new Compass(),
            new Feed(),
            new Fly(),
            new GetPos(),
            new Heal(),
            new Nick(),
            new Ping(),
            new Repair(),
            new SetSpawn(),
            new Spawn(),
            new Sudo(),
            new Vanish(),
        ]);
    }

    /**
     * @param array $commands
     */
    private function unregisterCommands(array $commands) : void{
        $commandMap = $this->getServer()->getInstance()->getCommandMap();
        foreach($commandMap->getCommands() as $cmd){
            if(in_array($cmd->getName(), $commands)){
                $cmd->setLabel("disabled_" . $cmd->getName());
                $commandMap->unregister($cmd);
            }
        }
    }

}
