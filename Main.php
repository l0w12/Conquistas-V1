<?php
/**
 * Created by PhpStorm.
 * User: Samuel
 * Date: 05/03/2019
 * Time: 20:30
 */

use Lop\window\Window;
use pocketmine\event\inventory\InventoryTransactionEvent;
use pocketmine\Player;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\item\Item;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use Lop\window\Task;


class Main extends PluginBase implements Listener
{
    public $c1 = false;
    public $c2 = false;


    public function onEnable()
    {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getLogger()->info("&ePlugin ligado");

        @mkdir($this->getDataFolder());
        $this->saveResource("Minerador.json");
        $this->mine = new Config($this->getDataFolder() . "/Minerador.json", Config::JSON);

        $this->saveResource("Guerreiro.json");
        $this->gerre = new Config($this->getDataFolder() . "/Guerreiro.json", Config::JSON);

        $this->saveResource("gUtils.json");
        $this->gUtils = new Config($this->getDataFolder() . "gUtils.json", Config::JSON);

        $this->saveResource("mUtils.json");
        $this->mUtils = new Config($this->getDataFolder() . "mUtils.json", Config::JSON);
    }

    public function onBreak(BlockBreakEvent $event)
    {
        $player = $event->getPlayer();
        $name = $player->getName();
        $mRank = $this->mUtils->get($name);
        $blocos = $this->mine->get($name);
        $this->mine->set($name, $blocos + 1);
        $this->mine->save();
        if ($blocos == 49) {  // 50 200 1000 5000 10000 50000 100000
            $player->sendMessage("§7(§6Refine§7)§a Conquista §bAdquirida §a(Mineracao II)");
            $player->sendMessage("§aSua kay foi setada a voce, compre caixas e ganhe premios");
            $player->sendTitle("§6Refine§eConquistas", "§fVoce conseguiu a conquista (Mideracao II)", 20, 20, 5);
            $this->mUtils->set($name, $mRank + 1);
            $this->mUtils->save();

        } elseif ($blocos == 199) {
            $player->sendMessage("§7(§6R§eN§7)§a Conquista §bAdquirida §a(Mineracao III)");
            $player->sendTitle("§6Refine§eConquistas", "§fVoce conseguiu a conquista (Mideracao III)", 20, 20, 5);
            $this->mUtils->set($name, $mRank + 1);
            $this->mUtils->save();
        } elseif ($blocos == 999) { // 50 200 1000 5000 10000 50000 100000
            $player->sendMessage("§7(§6R§eN§7)§a Conquista §bAdquirida §a(Mineracao IV)");
            $player->sendTitle("§6Refine§eConquistas", "§fVoce conseguiu a conquista (Mideracao IV)", 20, 20, 5);
            $this->mUtils->set($name, $mRank + 1);
            $this->mUtils->save();
        } elseif ($blocos == 4999) { // 50 200 1000 5000 10000 50000 100000
            $player->sendMessage("§7(§6R§eN§7)§a Conquista §bAdquirida §a(Mineracao V)");
            $player->sendTitle("§6Refine§eConquistas", "§fVoce conseguiu a conquista (Mideracao V)", 20, 20, 5);
            $this->mUtils->set($name, $mRank + 1);
            $this->mUtils->save();
        } elseif ($blocos == 9999) { // 50 200 1000 5000 10000 50000 100000
            $player->sendMessage("§7(§6R§eN§7)§a Conquista §bAdquirida §a(Mineracao VI)");
            $player->sendTitle("§6Refine§eConquistas", "§fVoce conseguiu a conquista (Mideracao VI)", 20, 20, 5);
            $this->mUtils->set($name, $mRank + 1);
            $this->mUtils->save();
        } elseif ($blocos == 49999) { // 50 200 1000 5000 10000 50000 100000
            $player->sendMessage("§7(§6R§eN§7)§a Conquista §bAdquirida §a(Mineracao VII)");
            $player->sendTitle("§6Refine§eConquistas", "§fVoce conseguiu a conquista (Mideracao VII)", 20, 20, 5);
            $this->mUtils->set($name, $mRank + 1);
            $this->mUtils->save();
        } elseif ($blocos == 99999) { // 50 200 1000 5000 10000 50000 100000
            $player->sendMessage("§7(§6R§eN§7)§a Conquista §bAdquirida §a(Mineracao VIII )[Level Maximo])");
            $player->sendTitle("§6Refine§eConquistas", "§fVoce conseguiu a conquista (Mideracao VII) §aLevel Maximo", 20, 20, 5);
            $this->mUtils->set($name, $mRank + 1);
            $this->mUtils->save();
            return;
        }

    }

    public function onDamage(EntityDamageEvent $e)
    {
        if ($e instanceof EntityDamageByEntityEvent) {
            $p = $e->getDamager();
            $en = $e->getEntity();
            if ($p instanceof Player) {
                if ($en instanceof Player) {
                    $gRank = $this->gUtils->get($p->getName());
                    $matou = $this->gerre->get($p->getName());
                    $this->gerre->set($p->getName(), $matou + 1);
                    $this->gerre->save();
                    if ($matou == 19) {
                        $p->sendMessage("§7(§6R§eN§7)§a Conquista §bAdquirida §a(Guerreiro II)");
                        $p->sendTitle("§6Refine§eConquistas", "§fVoce conseguiu a conquista (Guerreiro II)", 20, 20, 5);
                        $this->gUtils->set($p->getName(), $gRank + 1);
                        $this->gUtils->save();
                    } elseif ($matou == 49) {
                        $p->sendMessage("§7(§6R§eN§7)§a Conquista §bAdquirida §a(Guerreiro III)");
                        $p->sendTitle("§6Refine§eConquistas", "§fVoce conseguiu a conquista (Guerreiro III)", 20, 20, 5);
                        $this->gUtils->set($p->getName(), $gRank + 1);
                        $this->gUtils->save();
                    } elseif ($matou == 99) {
                        $p->sendMessage("§7(§6R§eN§7)§a Conquista §bAdquirida §a(Guerreiro IV)");
                        $p->sendTitle("§6Refine§eConquistas", "§fVoce conseguiu a conquista (Guerreiro IV)", 20, 20, 5);
                        $this->gUtils->set($p->getName(), $gRank + 1);
                        $this->gUtils->save();
                    } elseif ($matou == 199) {
                        $p->sendMessage("§7(§6R§eN§7)§a Conquista §bAdquirida §a(Guerreiro V)");
                        $p->sendTitle("§6Refine§eConquistas", "§fVoce conseguiu a conquista (Guerreiro V)", 20, 20, 5);
                        $this->gUtils->set($p->getName(), $gRank + 1);
                        $this->gUtils->save();
                    } elseif ($matou == 499) {
                        $p->sendMessage("§7(§6R§eN§7)§a Conquista §bAdquirida §a(Guerreiro VI)");
                        $p->sendTitle("§6Refine§eConquistas", "§fVoce conseguiu a conquista (Guerreiro VI)", 20, 20, 5);
                        $this->gUtils->set($p->getName(), $gRank + 1);
                        $this->gUtils->save();
                    } elseif ($matou == 749) {
                        $p->sendMessage("§7(§6R§eN§7)§a Conquista §bAdquirida §a(Guerreiro VII)");
                        $p->sendTitle("§6Refine§eConquistas", "§fVoce conseguiu a conquista (Guerreiro VII)", 20, 20, 5);
                        $this->gUtils->set($p->getName(), $gRank + 1);
                        $this->gUtils->save();
                    } elseif ($matou == 999) {
                        $p->sendMessage("§7(§6R§eN§7)§a Conquista §bAdquirida §a(Guerreiro VIII) [Max Level]");
                        $p->sendTitle("§6Refine§eConquistas", "§fVoce conseguiu a conquista (Guerreiro VIII) §aLevel Maximo", 20, 20, 5);
                        $this->gUtils->set($p->getName(), $gRank + 1);
                        $this->gUtils->save();;
                        return;
                    }
                }
            }
        }
    }


    public function onCommand(CommandSender $s, Command $command, $label, array $args)
    {
        switch ($command->getName()) {
            case "con":
                $this->c1 = true;
                $this->c2 = true;
                if ($s instanceof Player) {
                    /*
                    $sword = Item::get(276, 0, 1);
                    $sword->setCustomName("§eGuerreiro\n§fNivel: §7I\n§a0/20\n§7Mate 20 Jogadores");
                    $pick = Item::get(278, 0, 1);
                    $pick->setCustomName("§eMinerador\n§fNivel: §7I\n§a0/50\n§7Minere 50 blocos");
                    $menu->setItem(11, $sword);
                    $menu->setItem(15, $pick);
                    */
                    $blocos = $this->mine->get($s->getName());
                    $matou = $this->gerre->get($s->getName());
                    $mRank = $this->mUtils->get($s->getName());
                    $gRank = $this->gUtils->get($s->getName());
                    $menu = new Window($s, "Conquistas", 0); // 41322
                    if ($mRank == 0) {
                        $m = "50";
                        $pick = Item::get(278, 0, 1);
                        $pick->setCustomName("§eMinerador\n§fNivel: §7I\n§a" . $blocos . "/" . $m . "\n§7Minere " . $m . " blocos");
                        $menu->setItem(15, $pick);

                    } elseif ($mRank == 1) {// 200, 1000, 5000, 10000, 50000, 100000
                        $m = "200";
                        $this->mine->set($s->getName(), $blocos - 50);
                        $pick = Item::get(278, 0, 1);
                        $pick->setCustomName("§eMinerador\n§fNivel: §7II\n§a" . $blocos . "/" . $m . "\n§7Minere " . $m . " blocos");
                        $menu->setItem(15, $pick);


                    } elseif ($mRank == 2) { // 200, 1000, 5000, 10000, 50000, 100000
                        $m = "1000";
                        $this->mine->set($s->getName(), $blocos - 200);
                        $pick = Item::get(278, 0, 1);
                        $pick->setCustomName("§eMinerador\n§fNivel: §7II\n§a" . $blocos . "/" . $m . "\n§7Minere " . $m . " blocos");
                        $menu->setItem(15, $pick);


                    } elseif ($mRank == 3) { // 200, 1000, 5000, 10000, 50000, 100000

                        $m = "5000";
                        $this->mine->set($s->getName(), $blocos - 1000);
                        $pick = Item::get(278, 0, 1);
                        $pick->setCustomName("§eMinerador\n§fNivel: §7IV\n§a" . $blocos . "/" . $m . "\n§7Minere " . $m . " blocos");
                        $menu->setItem(15, $pick);


                    } elseif ($mRank == 4) { // 200, 1000, 5000, 10000, 50000, 100000

                        $m = "10000";
                        $this->mine->set($s->getName(), $blocos - 5000);
                        $pick = Item::get(278, 0, 1);
                        $pick->setCustomName("§eMinerador\n§fNivel: §7V\n§a" . $blocos . "/" . $m . "\n§7Minere " . $m . " blocos");
                        $menu->setItem(15, $pick);


                    } elseif ($mRank == 5) { // 200, 1000, 5000, 10000, 50000, 100000

                        $m = "50000";
                        $this->mine->set($s->getName(), $blocos - 10000);
                        $pick = Item::get(278, 0, 1);
                        $pick->setCustomName("§eMinerador\n§fNivel: §7VI\n§a" . $blocos . "/" . $m . "\n§7Minere " . $m . " blocos");
                        $menu->setItem(15, $pick);

                    } elseif ($mRank == 6) { // 200, 1000, 5000, 10000, 50000, 100000

                        $m = "10000";
                        $this->mine->set($s->getName(), $blocos - 50000);
                        $pick = Item::get(278, 0, 1);
                        $pick->setCustomName("§eMinerador\n§fNivel: §7VII\n§a" . $blocos . "/" . $m . "\n§7Minere " . $m . " blocos");
                        $menu->setItem(15, $pick);


                    } elseif ($blocos += 10000) { // 200, 1000, 5000, 10000, 50000, 100000
                        $m = "10000";
                        $pick = Item::get(278, 0, 1);
                        $pick->setCustomName("§eMinerador\n§fNivel: §7VII\n§a" . $m . "/" . $m . "\n§7Level Maximo");
                        $menu->setItem(15, $pick);

                    }
                    if ($gRank == 0) {
                        $m = "20";
                        $sword = Item::get(276, 0, 1);
                        $sword->setCustomName("§eGuerreiro\n§fNivel: §7I\n§a" . $matou . "/" . $m . "\n§7Mate " . $m . " Jogadores");
                        $menu->setItem(11, $sword);


                    } elseif ($gRank == 1) {
                        $m = "50";
                        $this->gerre->set($s->getName(), $blocos - 20);
                        $sword = Item::get(276, 0, 1);
                        $sword->setCustomName("§eGuerreiro\n§fNivel: §7II\n§a" . $matou . "/" . $m . "\n§7Mate " . $m . " Jogadores");
                        $menu->setItem(11, $sword);


                    } elseif ($gRank == 2) {
                        $m = "100";
                        $this->gerre->set($s->getName(), $blocos - 50);
                        $sword = Item::get(276, 0, 1);
                        $sword->setCustomName("§eGuerreiro\n§fNivel: §7III\n§a" . $matou . "/" . $m . "\n§7Mate " . $m . " Jogadores");
                        $menu->setItem(11, $sword);


                    } elseif ($gRank == 3) {
                        $m = "200";
                        $sword = Item::get(276, 0, 1);
                        $this->gerre->set($s->getName(), $blocos - 100);
                        $sword->setCustomName("§eGuerreiro\n§fNivel: §7IV\n§a" . $matou . "/" . $m . "\n§7Mate " . $m . " Jogadores");
                        $menu->setItem(11, $sword);


                    } elseif ($gRank == 4) {
                        $m = "500";
                        $this->gerre->set($s->getName(), $blocos - 200);
                        $sword = Item::get(276, 0, 1);

                        $sword->setCustomName("§eGuerreiro\n§fNivel: §7V\n§a" . $matou . "/" . $m . "\n§7Mate " . $m . " Jogadores");
                        $menu->setItem(11, $sword);

                    } elseif ($gRank == 5) {


                        $m = "750";
                        $this->gerre->set($s->getName(), $blocos - 500);
                        $sword = Item::get(276, 0, 1);
                        $sword->setCustomName("§eGuerreiro\n§fNivel: §7VI\n§a" . $matou . "/" . $m . "\n§7Mate " . $m . " Jogadores");
                        $menu->setItem(11, $sword);

                    } elseif ($gRank == 6) {

                        $m = "1000";
                        $this->gerre->set($s->getName(), $blocos - 750);
                        $sword = Item::get(276, 0, 1);
                        $sword->setCustomName("§eGuerreiro\n§fNivel: §7VII\n§a" . $matou . "/" . $m . "\n§7Mate " . $m . " Jogadores");
                        $menu->setItem(11, $sword);


                    } elseif ($matou += 1000) {
                        $m = "1000";
                        $sword = Item::get(276, 0, 1);
                        $sword->setCustomName("§eGuerreiro\n§fNivel: §7VII\n§a" . $m . "/" . $m . "\n§7Level Maximo");
                        $menu->setItem(11, $sword);

                    }

                    $s->addWindow($menu);
                    /*
                    $s->sendMessage("§e§lGuerreiro:§r");
                    $s->sendMessage("§a-Mate 20 jogadores ".$matou."/20§r");
                    $s->sendMessage("§a-Mate 50 jogadores ".$matou."/50§r");
                    $s->sendMessage("§a-Mate 100 jogadores ".$matou."/100§r");
                    $s->sendMessage("§a-Mate 200 jogadores ".$matou."/200§r");
                    $s->sendMessage("§a-Mate 500 jogadores ".$matou."/500§r");
                    $s->sendMessage("§a-Mate 750 jogadores ".$matou."/750§r");
                    $s->sendMessage("§a-Mate 1000 jogadores ".$matou."/1000§r");
                    $s->sendMessage("     ");
                    $s->sendMessage("§e§lMinerador:§r");
                    $s->sendMessage("§a-Minere 50 blocos ".$blocos."/50§r");
                    $s->sendMessage("§a-Minere 200 blocos ".$blocos."/200§r");
                    $s->sendMessage("§a-Minere 1000 blocos ".$blocos."/1000§r");
                    $s->sendMessage("§a-Minere 5000 blocos ".$blocos."/5000§r");
                    $s->sendMessage("§a-Minere 10000 blocos ".$blocos."/10000§r");
                    $s->sendMessage("§a-Minere 50000 blocos ".$blocos."/50000§r");
                    $s->sendMessage("§a-Minere 100000 blocos ".$blocos."/100000"); // 200, 1000, 5000, 10000, 50000, 100000
                    */
                    return;
                }
            case "open":
                $this->getServer()->getInstance()->getScheduler()->scheduleRepeatingTask(new Task($this, $s), 1.7);
        }

    }

    public function onClick(InventoryTransactionEvent $e)
    {
        if ($this->c1 == false && $this->c2!= true) {
            $e->setCancelled(false);
        } else {
            $e->setCancelled(true);
        }
    }
}