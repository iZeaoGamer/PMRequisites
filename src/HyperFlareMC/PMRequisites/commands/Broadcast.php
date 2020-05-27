<?php

declare(strict_types=1);

namespace HyperFlareMC\PMRequisites\commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Server;
use pocketmine\utils\TextFormat as TF;

class Broadcast extends Command{

    public function __construct(){
        parent::__construct(
            "broadcast",
            "Broadcast a message to the server!",
            TF::RED . "Usage: " . TF::GRAY . "/broadcast <message>",
            ["bc", "bcast"]
        );
        $this->setPermission("pmrequisites.broadcast");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args){
        $server = Server::getInstance();
        if(!$sender->hasPermission("pmrequisites.broadcast")){
            $sender->sendMessage(TF::RED . "You do not have permission to use this command!");
            return;
        }
        if(count($args) === 0){
            $sender->sendMessage($this->usageMessage);
            return;
        }
        if(isset($args[0])){
            $prefix = TF::RED . TF::BOLD . "Server: " . TF::RESET;
            $msg = implode(" ", $args);
            $server->broadcastMessage($prefix . $msg);
        }
    }
}