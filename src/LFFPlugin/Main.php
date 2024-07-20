<?php

namespace LFFPlugin;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use LFFPlugin\command\LFFCommand;
use LFFPlugin\event\InventoryClickListener;

class Main extends PluginBase {

    /** @var Config */
    private $config;

    public function onEnable(): void {
        $this->saveResource("config.yml");
        $this->config = new Config($this->getDataFolder() . "config.yml", Config::YAML);

        $this->getServer()->getCommandMap()->register("lff", new LFFCommand($this));
        $this->getServer()->getPluginManager()->registerEvents(new InventoryClickListener($this), $this);

        $this->getLogger()->info("LFFPlugin ha sido habilitado.");
    }

    public function getConfigData(): Config {
        return $this->config;
    }
}
