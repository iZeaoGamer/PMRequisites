<?php

declare(strict_types=1);

namespace HyperFlareMC\PMRequisites\commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\utils\TextFormat as TF;

class Vanish extends Command{

    public function __construct(){
        parent::__construct(
            "vanish",
            "Switch to vanish mode!",
            TF::RED . "Usage: " . TF::GRAY . "/vanish",
            ["v"]
        );
        $this->setPermission("pmrequisites.vanish");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args){
        if(!$sender->hasPermission("pmrequisites.vanish")){
            $sender->sendMessage(TF::RED . "You do not have permission to use this command!");
            return;
        }
        if(!$sender instanceof Player){
            $sender->sendMessage(TF::RED . "You must be in-game to use this command!");
            return;
        }
        if(count($args) > 0){
            $sender->sendMessage($this->usageMessage);
            return;
        }
        if($sender->isSpectator()){
            $sender->setGamemode(Player::SURVIVAL);
            $sender->sendMessage(TF::GREEN . "Vanish mode disabled!");
        }else{
            $sender->setGamemode(Player::SPECTATOR);
            $sender->sendMessage(TF::GREEN . "Vanish mode enabled!");
        }
    }

}