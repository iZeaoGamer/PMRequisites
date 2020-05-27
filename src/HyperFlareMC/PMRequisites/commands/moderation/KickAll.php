<?php

declare(strict_types=1);

namespace HyperFlareMC\PMRequisites\commands\moderation;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat as TF;

class KickAll extends Command{

    public function __construct(){
        parent::__construct(
            "kickall",
            "Kick all players!",
            TF::RED . "Usage: " . TF::GRAY . "/kickall <reason>"
        );
        $this->setPermission("pmrequisites.kickall");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args){
        if(!$sender->hasPermission("pmrequisites.kickall")){
            $sender->sendMessage(TF::RED . "You do not have permission to use this command!");
            return;
        }
        if(count($args) < 1){
            $reason = "Unspecified";
        }else{
            $reason = implode(" ", $args);
        }
        foreach($sender->getServer()->getOnlinePlayers() as $player){
            if($player !== $sender){
                $player->kick($reason, false);
            }
        }
        $sender->sendMessage(TF::GREEN . "Kicked all the players for " . TF::YELLOW . $reason . TF::GREEN . "!");
    }

}