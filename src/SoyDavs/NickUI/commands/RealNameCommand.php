<?php

namespace SoyDavs\NickUI\commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\Server;
use SoyDavs\NickUI\Main;

class RealNameCommand extends Command {

    private Main $plugin;

    public function __construct(Main $plugin) {
        parent::__construct("realname", "View a player's real name", "/realname <player>", []);
        $this->setPermission("nickui.cmd.realname");
        $this->plugin = $plugin;
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): bool {
        if (!$this->testPermission($sender)) {
            return true;
        }

        if (count($args) < 1) {
            $sender->sendMessage("Usage: /realname <player>");
            return false;
        }

        $targetName = strtolower(array_shift($args));
        $nickData = $this->plugin->getPlayerNickData($targetName);

        if ($nickData === null) {
            $sender->sendMessage("§cPlayer not found or does not have a nickname.");
            return true;
        }

        // Check if sender is a Player and has OP permissions
        if ($sender instanceof Player) {
            if (!Server::getInstance()->isOp($sender->getName())) {
                $sender->sendMessage("§cYou do not have permission to use this command.");
                return true;
            }
        }

        $realName = $nickData['realName'] ?? $targetName;
        $sender->sendMessage("§aThe real name of §f{$targetName}§a is §f{$realName}§a.");
        return true;
    }
}
