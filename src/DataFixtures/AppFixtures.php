<?php

namespace App\DataFixtures;

use App\Entity\Product;
use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // Create Categories
        $electronics = new Category();
        $electronics->setName('electronics');
        
        $phones = new Category();
        $phones->setName('phones');
        $electronics->addSubcategory($phones);
        
        $spare_parts = new Category();
        $spare_parts->setName('spare_parts');
        $electronics->addSubcategory($spare_parts);
        
        $appliances = new Category();
        $appliances->setName('appliances');
        
        $refrigerators = new Category();
        $refrigerators->setName('refrigerators');
        $appliances->addSubcategory($refrigerators);
        
        $manager->persist($electronics);
        $manager->persist($phones);
        $manager->persist($spare_parts);
        $manager->persist($appliances);
        $manager->persist($refrigerators);
        
        //Create Products
        $applePhone = new Product();
        $applePhone->setName('Мобильный Телефон Apple');
        $applePhone->setCode('apple-phone');
        $applePhone->setPrice(2000);
        $applePhone->setDescription('Cерия смартфонов, разработанных корпорацией Apple. '
            . 'Работают под управлением операционной системы iOS, представляющей собой '
            . 'упрощённую и оптимизированную для функционирования на мобильном устройстве '
            . 'версию macOS.');
        $applePhone->addCategory($phones);
        
        $appleDisplay = new Product();
        $appleDisplay->setName('Дисплей Apple');
        $appleDisplay->setCode('apple-display');
        $appleDisplay->setPrice(500);
        $appleDisplay->setDescription('ЖК-дисплей, продававшийся компанией Apple Inc., '
            . 'представленный 20 июля 2011 года и производившийся до 2016 года. '
            . 'Единственный дисплей, пришедший на смену Apple LED Cinema Display. '
            . 'Одной из новинок в этом устройстве стал переход от Mini DisplayPort '
            . 'и USB к одному Thunderbolt для передачи данных между компьютером и '
            . 'дисплеем. Увеличенная пропускная способность интерфейса Thunderbolt '
            . 'позволяла добавить порты Gigabit Ethernet и FireWire 800 к этому '
            . 'дисплею. Старые модели компьютеров Mac с Mini DisplayPort, включая '
            . 'все модели, представленные в 2010 году, несовместимы с этим дисплеем.');
        $appleDisplay->addCategory($spare_parts);
        
        $samsungRefrigerator = new Product();
        $samsungRefrigerator->setName('Холодильник Samsung');
        $samsungRefrigerator->setCode('samsung-refrigerator');
        $samsungRefrigerator->setPrice(10000);
        $samsungRefrigerator->setDescription('Технология All-around Cooling позволяет '
            . 'равномерно охлаждать каждый уголок рабочей камеры. Охлажденный воздух '
            . 'циркулирует через множество вентиляционных отверстий, имеющих выходы '
            . 'на каждую полку, благодаря чему в холодильнике поддерживается постоянная '
            . 'температура, и продукты всегда остаются свежими.');
        $samsungRefrigerator->addCategory($refrigerators);
        
        $giftCard = new Product();
        $giftCard->setName('Подарочная Карта');
        $giftCard->setCode('gift-card');
        $giftCard->setPrice(1000);
        $giftCard->setDescription('Подарочная Карта на сумму в 1000 рублей!');
        $giftCard->addCategory($phones);
        $giftCard->addCategory($refrigerators);
        
        $manager->persist($applePhone);
        $manager->persist($appleDisplay);
        $manager->persist($samsungRefrigerator);
        $manager->persist($giftCard);
        
        $manager->flush();
    }
}
