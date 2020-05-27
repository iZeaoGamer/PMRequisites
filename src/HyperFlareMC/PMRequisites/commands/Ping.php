<?php

declare(strict_types=1);

namespace HyperFlareMC\PMRequisites\commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\utils\TextFormat as TF;

class Ping extends Command{

    public function __construct(){
        parent::__construct(
            "ping",
            "Check your or another player's ping!",
            TF::RED . "Usage: " . TF::GRAY . "/ping or /ping <player>"
        );
        $this->setPermission("pmrequisites.ping");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args){
        if(!$sender->hasPermission("pmrequisites.ping")){
            $sender->sendMessage(TF::RED . "You do not have permission to use this command!");
            return;
        }
        if(!$sender instanceof Player && count($args) === 0){
            $sender->sendMessage(TF::RED . "You must be in-game to check your own ping!");
            return;
        }
        if(!isset($args[0])){
            $playerPing = $sender->getPing();
            if($playerPing >= 250){
                $sender->sendMessage(TF::GREEN . "Your ping is " . TF::RED . $playerPing . "ms");
                return;
            }elseif($playerPing >= 150){
                $sender->sendMessage(TF::GREEN . "Your ping is " . TF::YELLOW . $playerPing . "ms");
                return;
            }elseif($playerPing >= 0){
                $sender->sendMessage(TF::GREEN . "Your ping is " . $playerPing . "ms");
                return;
            }
        }
    }

}