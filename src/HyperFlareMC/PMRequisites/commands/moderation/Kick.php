<?php

declare(strict_types=1);

namespace HyperFlareMC\PMRequisites\commands\moderation;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\utils\TextFormat as TF;

class Kick extends Command{

    public function __construct(){
        parent::__construct(
            "kick",
            "Kick a player!",
            TF::RED . "Usage: " . TF::GRAY . "/kick <player> <reason>",
        );
        $this->setPermission("pmrequisites.kick");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args){
        if(!$sender->hasPermission("pmrequisites.kick")){
            $sender->hasPermission(TF::RED . "You do not have permission to use this command!");
            return;
        }
        $name = array_shift($args);
        $reason = trim(implode(" ", $args));

        if(count($args) === 0){
            $sender->sendMessage($this->usageMessage);
            return;
        }elseif(count($args) === 1){
            $reason = "Unspecified";
        }else{
            $reason = implode(" ", $args);
        }

        if(($player = $sender->getServer()->getPlayer($name)) instanceof Player){
            if($player === null){
                $sender->sendMessage(TF::RED . "Player not found!");
                return;
            }
            if($sender === $player){
                $sender->sendMessage(TF::RED . "You can't kick yourself!");
            }
            if($reason !== ""){
                $sender->sendMessage(TF::GREEN . "Successfully kicked " . TF::YELLOW . $player . TF::GREEN . " for " . TF::YELLOW . $reason);
            }else{
                $sender->sendMessage(TF::GREEN . "Successfully kicked " . TF::YELLOW . $player);
            }
            $player->kick($reason, false);
        }else{
            $sender->sendMessage(TF::RED . "Player not found!");
        }
    }
}