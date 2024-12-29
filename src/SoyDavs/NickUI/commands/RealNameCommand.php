<?php

namespace SoyDavs\NickUI\commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use SoyDavs\NickUI\Main;

class RealNameCommand extends Command {

    private Main $plugin;

    public function __construct(Main $plugin) {
        parent::__construct("realname", "Check the real name of a nicked player", "/realname <player>", []);
        $this->setPermission("nickui.cmd.realname");
        $this->plugin = $plugin;
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): bool {
        if (!$this->testPermission($sender)) {
            return true;
        }

        if (!$sender->isOp()) {
            $sender->sendMessage("§cOnly OPs can use this command.");
            return true;
        }

        if (!isset($args[0])) {
            $sender->sendMessage("Usage: /realname <player>");
            return true;
        }

        $targetDisplayName = $args[0];
        $realName = $this->plugin->getRealNameByDisplay($targetDisplayName);

        if ($realName === null) {
            $sender->sendMessage("§cNo nicked player found with display name §f{$targetDisplayName}.");
        } else {
            $sender->sendMessage("§aThe real name of §f{$targetDisplayName} §ais §f{$realName}.");
        }

        return true;
    }
}
