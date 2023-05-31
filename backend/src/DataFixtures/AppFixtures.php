<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Entity\Team;
use App\Entity\Country;
use App\Entity\Player;

class AppFixtures extends Fixture
{

    public function load(ObjectManager $manager): void
    {
        $countries = [
            ['Albania', 'https://www.scorebar.com/images/flags/al.webp?w=28&h=21'],
            ['Algeria', 'https://www.scorebar.com/images/flags/dz.webp?w=28&h=21'],
            ['Andorra', 'https://www.scorebar.com/images/flags/ad.webp?w=28&h=21'],
            ['Angola', 'https://www.scorebar.com/images/flags/ao.webp?w=28&h=21'],
            ['Argentina', 'https://www.scorebar.com/images/flags/ar.webp?w=28&h=21'],
            ['Australia', 'https://www.scorebar.com/images/flags/au.webp?w=28&h=21'],
            ['Bahrain', 'https://www.scorebar.com/images/flags/bh.webp?w=28&h=21'],
            ['Belgium', 'https://www.scorebar.com/images/flags/be.webp?w=28&h=21'],
            ['Bhutan', 'https://www.scorebar.com/images/flags/bt.webp?w=28&h=21'],
            ['Brazil', 'https://www.scorebar.com/images/flags/br.webp?w=28&h=21'],
            ['Bulgaria', 'https://www.scorebar.com/images/flags/bg.webp?w=28&h=21'],
            ['Cambodia', 'https://www.scorebar.com/images/flags/kh.webp?w=28&h=21'],
            ['Canada', 'https://www.scorebar.com/images/flags/ca.webp?w=28&h=21'],
            ['Chile', 'https://www.scorebar.com/images/flags/cl.webp?w=28&h=21'],
            ['Colombia', 'https://www.scorebar.com/images/flags/co.webp?w=28&h=21'],
            ['Costa Rica', 'https://www.scorebar.com/images/flags/cr.webp?w=28&h=21'],
            ['Denmark', 'https://www.scorebar.com/images/flags/dk.webp?w=28&h=21'],
            ['Egypt', 'https://www.scorebar.com/images/flags/eg.webp?w=28&h=21'],
            ['France', 'https://www.scorebar.com/images/flags/fr.webp?w=28&h=21'],
            ['Germany', 'https://www.scorebar.com/images/flags/de.webp?w=28&h=21'],
            ['Ghana', 'https://www.scorebar.com/images/flags/gh.webp?w=28&h=21'],
            ['Greece', 'https://www.scorebar.com/images/flags/gr.webp?w=28&h=21'],
            ['Iran', 'https://www.scorebar.com/images/flags/ir.webp?w=28&h=21'],
            ['Iraq', 'https://www.scorebar.com/images/flags/iq.webp?w=28&h=21'],
            ['Italy', 'https://www.scorebar.com/images/flags/it.webp?w=28&h=21'],
            ['Japan', 'https://www.scorebar.com/images/flags/jp.webp?w=28&h=21'],
            ['Kazakhstan', 'https://www.scorebar.com/images/flags/kz.webp?w=28&h=21'],
            ['Kuwait', 'https://www.scorebar.com/images/flags/kw.webp?w=28&h=21'],
            ['Lebanon', 'https://www.scorebar.com/images/flags/lb.webp?w=28&h=21'],
            ['Libya', 'https://www.scorebar.com/images/flags/ly.webp?w=28&h=21'],
            ['Malta', 'https://www.scorebar.com/images/flags/mt.webp?w=28&h=21'],
            ['Oman', 'https://www.scorebar.com/images/flags/om.webp?w=28&h=21'],
            ['Palestinian Territories', 'https://www.scorebar.com/images/flags/ps.webp?w=28&h=21'],
            ['Portugal', 'https://www.scorebar.com/images/flags/pt.webp?w=28&h=21'],
            ['Qatar', 'https://www.scorebar.com/images/flags/qa.webp?w=28&h=21'],
            ['Saudi Arabia', 'https://www.scorebar.com/images/flags/sa.webp?w=28&h=21'],
            ['Sudan', 'https://www.scorebar.com/images/flags/sd.webp?w=28&h=21'],
            ['Sweden', 'https://www.scorebar.com/images/flags/se.webp?w=28&h=21'],
            ['Tajikistan', 'https://www.scorebar.com/images/flags/tj.webp?w=28&h=21'],
            ['Tunisia', 'https://www.scorebar.com/images/flags/tn.webp?w=28&h=21'],
            ['Turkey', 'https://www.scorebar.com/images/flags/tr.webp?w=28&h=21'],
            ['Uruguay', 'https://www.scorebar.com/images/flags/uy.webp?w=28&h=21'],
            ['United Arab Emirates', 'https://www.scorebar.com/images/flags/ae.webp?w=28&h=21'],
            ['Vietnam', 'https://www.scorebar.com/images/flags/vn.webp?w=28&h=21'],
            ['Zimbabwe', 'https://www.scorebar.com/images/flags/zw.webp?w=28&h=21']
        ];

        foreach ($countries as $index => [$name, $flag]) {

            $country = new Country();
            $country->setName($name);
            $country->setFlagFile($flag);
            $manager->persist($country);

            // create teams and players for the first 5 countries
            if($index < 5){

                // Create team associated with the country
                $team = new Team();
                $team->setName($name . ' Football Team');
                $team->setMoneyBalance(500000); // Set the initial money balance
                $team->setCountry($country);
                $manager->persist($team);

                // Create players associated with the team
                for($i = 1; $i <= 11; $i++){
                    
                    $player = new Player();
                    $player->setName($name . ' Football Team Player' . $i);
                    $player->setTeam($team);

                    $manager->persist($player);
                }
            }
        }

        $manager->flush();
    }
}