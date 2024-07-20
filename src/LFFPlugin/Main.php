<?php

namespace LFFPlugin;

use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\Config;
use pocketmine\player\Player;
use LFFPlugin\Command\LFFCommand;

class Main extends PluginBase {

    /** @var Config */
    private $config;

    public function onEnable(): void {
        $this->saveResource("config.yml");
        $this->config = new Config($this->getDataFolder() . "config.yml", Config::YAML);

        $this->getServer()->getCommandMap()->register("lff", new LFFCommand($this));
        $this->getLogger()->info("LFFPlugin ha sido habilitado.
        - Hecho por zFrozead0s para servidores HCF - Factions");
    }

    public function getConfigData(): Config {
        return $this->config;
    }
}
