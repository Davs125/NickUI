<?php

namespace SoyDavs\NickUI;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use SoyDavs\NickUI\commands\NickCommand;
use SoyDavs\NickUI\commands\UnNickCommand;
use SoyDavs\NickUI\commands\RealNameCommand;
use SoyDavs\NickUI\listeners\ChatListener;

class Main extends PluginBase {

    /** @var Config */
    private $configYml;

    /** @var array<string, array> */
    private $nickData = [];

    public function onEnable(): void {
        $this->saveResource("config.yml");
        $this->configYml = new Config($this->getDataFolder() . "config.yml", Config::YAML);

        // Cargar datos de nicknames si existen
        $this->nickData = $this->configYml->get("nickData", []);

        // Registrar eventos
        $this->getServer()->getPluginManager()->registerEvents(new ChatListener($this), $this);

        // Registrar comandos
        $this->getServer()->getCommandMap()->register("nickui", new NickCommand($this));
        $this->getServer()->getCommandMap()->register("nickui", new UnNickCommand($this));
        $this->getServer()->getCommandMap()->register("nickui", new RealNameCommand($this));

        $this->getLogger()->info("NickUI enabled");
    }

    public function onDisable(): void {
        // Guardar datos de nicknames
        $this->configYml->set("nickData", $this->nickData);
        $this->configYml->save();
    }

    public function getPluginConfig(): Config {
        return $this->configYml;
    }

    public function setPlayerNickData(string $playerName, string $displayName, string $rank): void {
        $this->nickData[strtolower($playerName)] = [
            "displayName" => $displayName,
            "rank" => $rank,
            "realName" => $playerName
        ];
    }

    public function getPlayerNickData(string $playerName): ?array {
        $playerName = strtolower($playerName);
        return $this->nickData[$playerName] ?? null;
    }

    public function removePlayerNickData(string $playerName): void {
        $playerName = strtolower($playerName);
        if (isset($this->nickData[$playerName])) {
            unset($this->nickData[$playerName]);
        }
    }

    public function getRealNameByDisplay(string $displayName): ?string {
        foreach ($this->nickData as $data) {
            if ($data["displayName"] === $displayName) {
                return $data["realName"];
            }
        }
        return null;
    }
}
