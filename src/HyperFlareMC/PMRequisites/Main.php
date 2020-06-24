<?php

declare(strict_types=1);

namespace HyperFlareMC\PMRequisites;

use HyperFlareMC\PMRequisites\commands\Adventure;
use HyperFlareMC\PMRequisites\commands\BreakCommand;
use HyperFlareMC\PMRequisites\commands\Broadcast;
use HyperFlareMC\PMRequisites\commands\ClearHand;
use HyperFlareMC\PMRequisites\commands\ClearHotBar;
use HyperFlareMC\PMRequisites\commands\ClearInventory;
use HyperFlareMC\PMRequisites\commands\ClearLag;
use HyperFlareMC\PMRequisites\commands\Compass;
use HyperFlareMC\PMRequisites\commands\Creative;
use HyperFlareMC\PMRequisites\commands\Feed;
use HyperFlareMC\PMRequisites\commands\Fly;
use HyperFlareMC\PMRequisites\commands\GetPos;
use HyperFlareMC\PMRequisites\commands\Heal;
use HyperFlareMC\PMRequisites\commands\moderation\KickAll;
use HyperFlareMC\PMRequisites\commands\Nick;
use HyperFlareMC\PMRequisites\commands\Ping;
use HyperFlareMC\PMRequisites\commands\Rename;
use HyperFlareMC\PMRequisites\commands\Repair;
use HyperFlareMC\PMRequisites\commands\SetSpawn;
use HyperFlareMC\PMRequisites\commands\Spawn;
use HyperFlareMC\PMRequisites\commands\Sudo;
use HyperFlareMC\PMRequisites\commands\SuperVanish;
use HyperFlareMC\PMRequisites\commands\Survival;
use HyperFlareMC\PMRequisites\commands\Vanish;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;

class Main extends PluginBase{

    /**
     * @var array
     */
    private $supervanished = [];

    /**
     * @var array
     */
    private $vanished = [];

    /**
     * @var Config
     */
    private $config;

    /**
     * @var string
     */
    public $superVanishJoinMessage;

    /**
     * @var string
     */
    public $superVanishLeaveMessage;

    public function onEnable() : void{
        $this->vanished = [];
        $this->supervanished = [];
        $this->config = $this->getConfig();
        $this->superVanishJoinMessage = $this->config->get("super-vanish-join");
        $this->superVanishLeaveMessage = $this->config->get("super-vanish-leave");
        $this->getServer()->getPluginManager()->registerEvents(new EventListener($this), $this);
        $commands = [
            "say",
            "me"
        ];
        $this->unregisterCommands($commands);
        $this->registerCommands();
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

    public function registerCommands() : void{
        $this->getServer()->getCommandMap()->registerAll($this->getName(), [
            new Adventure(),
            new BreakCommand(),
            new Broadcast(),
            new ClearHand(),
            new ClearHotBar(),
            new ClearInventory(),
            new ClearLag(),
            new Compass(),
            new Creative(),
            new Feed(),
            new Fly(),
            new GetPos(),
            new Heal(),
            new KickAll(),
            new Nick(),
            new Ping(),
            new Rename(),
            new Repair(),
            new SetSpawn(),
            new Spawn(),
            new Sudo(),
            new SuperVanish($this),
            new Survival(),
            new Vanish($this),
            ]);
    }

    /**
     * @param string $player
     * @return bool
     */
    public function isSuperVanished(string $player): bool{
        if(in_array($player, $this->supervanished)){
            return true;
        }
        return false;
    }

    /**
     * @param Player $target
     * @param bool $mode
     * @param string $type
     */
    public function setVanished(Player $target, bool $mode, string $type): void{
        if($mode === true){
            if($type === "vanish"){
                array_push($this->vanished, $target->getName());
            }else{
                array_push($this->supervanished, $target->getName());
            }
        }else{
            if($type === "vanish"){
                $this->vanished = array_diff($this->vanished, [$target->getName()]);
            }else{
                $this->supervanished = array_diff($this->supervanished, [$target->getName()]);
            }
        }
    }

    /**
     * @param Player $player
     * @return bool
     */
    public function isHidden(Player $player): bool{
        if($this->isVanished($player->getName()) || $this->isSuperVanished($player->getName())){
            return true;
        }
        return false;
    }

    /**
     * @param string $player
     * @return bool
     */
    public function isVanished(string $player): bool{
        if(in_array($player, $this->vanished)){
            return true;
        }
        return false;
    }

}
