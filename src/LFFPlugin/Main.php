<?php

namespace LFFPlugin;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use LFFPlugin\command\LFFCommand;

class Main extends PluginBase {

    /** @var Config */
    private $config;

    public function onEnable(): void {
        $this->saveResource("config.yml");
        $this->config = new Config($this->getDataFolder() . "config.yml", Config::YAML);

        $this->getServer()->getCommandMap()->register("lff", new LFFCommand($this));
        $this->getLogger()->info("LFFPlugin ha sido habilitado.");
    }

    public function getConfig