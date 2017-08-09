<?php
/**
 * Created by PhpStorm.
 * User: RTG
 * Date: 9/8/2017
 * Time: 7:46 PM
 */

namespace RTG\Discord2MCPE;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat as TF;

class Loader extends PluginBase {

    public $config;

    public function onEnable() {
        $this->saveDefaultConfig();
        $this->config = $this->getConfig()->getAll();
    }

    /**
     * @param CommandSender $sender
     * @param Command $command
     * @param string $label
     * @param array $args
     * @return bool
     */
    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args): bool {

        switch (strtolower($cmd->getName())) {

            case "discord":

                    if ($sender->hasPermission("discord.talk")) {

                        $message = implode(" ", $args);
                        $username = $this->config['username'];
                        $avatar = $this->config['avatar'];
                        $url = $this->config['url'];

                        new Redirect($url, $message, $username, $avatar, $sender);

                    } else {
                        $sender->sendMessage(TF::RED . "You have no permission to use this command!");
                    }

                return true;
            break;

        }

    }
}