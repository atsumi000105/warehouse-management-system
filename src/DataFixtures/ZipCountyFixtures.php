<?php

namespace App\DataFixtures;

use App\Entity\ZipCounty;
use Doctrine\Persistence\ObjectManager;

class ZipCountyFixtures extends BaseFixture
{
    private $countyIdList = [];

    public function loadData(ObjectManager $manager)
    {
        foreach ($this->getData() as $key => $field) {
            $this->setCountyId($field['county_name']);

            $definition = new ZipCounty();
            $definition->setZipCode($field['zip_code']);
            $definition->setCountyName($field['county_name']);
            $definition->setStateCode($field['state_code']);

            $definition->setCountyId($this->countyIdList[$field['county_name']]['county_id']);

            $manager->persist($definition);

            $this->setReference('zip_county.' . ($key + 1), $definition);

            $manager->flush();
        }
    }

    public function getData(): array
    {
        return [
            [
                'zip_code' => '66015',
                'county_name' => 'Allen County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66039',
                'county_name' => 'Allen County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66716',
                'county_name' => 'Allen County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66720',
                'county_name' => 'Allen County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66732',
                'county_name' => 'Allen County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66742',
                'county_name' => 'Allen County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66748',
                'county_name' => 'Allen County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66749',
                'county_name' => 'Allen County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66751',
                'county_name' => 'Allen County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66755',
                'county_name' => 'Allen County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66758',
                'county_name' => 'Allen County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66772',
                'county_name' => 'Allen County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66014',
                'county_name' => 'Anderson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66015',
                'county_name' => 'Anderson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66032',
                'county_name' => 'Anderson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66033',
                'county_name' => 'Anderson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66039',
                'county_name' => 'Anderson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66072',
                'county_name' => 'Anderson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66080',
                'county_name' => 'Anderson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66091',
                'county_name' => 'Anderson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66093',
                'county_name' => 'Anderson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66095',
                'county_name' => 'Anderson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66758',
                'county_name' => 'Anderson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66002',
                'county_name' => 'Atchison County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66016',
                'county_name' => 'Atchison County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66023',
                'county_name' => 'Atchison County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66041',
                'county_name' => 'Atchison County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66058',
                'county_name' => 'Atchison County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66060',
                'county_name' => 'Atchison County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66088',
                'county_name' => 'Atchison County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66424',
                'county_name' => 'Atchison County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66436',
                'county_name' => 'Atchison County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66439',
                'county_name' => 'Atchison County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66552',
                'county_name' => 'Atchison County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67009',
                'county_name' => 'Barber County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67028',
                'county_name' => 'Barber County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67057',
                'county_name' => 'Barber County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67061',
                'county_name' => 'Barber County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67065',
                'county_name' => 'Barber County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67070',
                'county_name' => 'Barber County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67071',
                'county_name' => 'Barber County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67104',
                'county_name' => 'Barber County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67112',
                'county_name' => 'Barber County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67134',
                'county_name' => 'Barber County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67138',
                'county_name' => 'Barber County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67143',
                'county_name' => 'Barber County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67427',
                'county_name' => 'Barton County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67450',
                'county_name' => 'Barton County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67511',
                'county_name' => 'Barton County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67525',
                'county_name' => 'Barton County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67526',
                'county_name' => 'Barton County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67530',
                'county_name' => 'Barton County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67544',
                'county_name' => 'Barton County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67564',
                'county_name' => 'Barton County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67565',
                'county_name' => 'Barton County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67567',
                'county_name' => 'Barton County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67634',
                'county_name' => 'Barton County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67665',
                'county_name' => 'Barton County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67950',
                'county_name' => 'Barton County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66010',
                'county_name' => 'Bourbon County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66701',
                'county_name' => 'Bourbon County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66711',
                'county_name' => 'Bourbon County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66716',
                'county_name' => 'Bourbon County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66738',
                'county_name' => 'Bourbon County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66741',
                'county_name' => 'Bourbon County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66746',
                'county_name' => 'Bourbon County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66754',
                'county_name' => 'Bourbon County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66755',
                'county_name' => 'Bourbon County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66769',
                'county_name' => 'Bourbon County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66772',
                'county_name' => 'Bourbon County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66775',
                'county_name' => 'Bourbon County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66779',
                'county_name' => 'Bourbon County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66780',
                'county_name' => 'Bourbon County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66041',
                'county_name' => 'Brown County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66094',
                'county_name' => 'Brown County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66424',
                'county_name' => 'Brown County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66425',
                'county_name' => 'Brown County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66434',
                'county_name' => 'Brown County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66439',
                'county_name' => 'Brown County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66515',
                'county_name' => 'Brown County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66516',
                'county_name' => 'Brown County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66527',
                'county_name' => 'Brown County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66532',
                'county_name' => 'Brown County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66534',
                'county_name' => 'Brown County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66550',
                'county_name' => 'Brown County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66840',
                'county_name' => 'Butler County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66842',
                'county_name' => 'Butler County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66866',
                'county_name' => 'Butler County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67002',
                'county_name' => 'Butler County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67008',
                'county_name' => 'Butler County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67010',
                'county_name' => 'Butler County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67012',
                'county_name' => 'Butler County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67017',
                'county_name' => 'Butler County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67037',
                'county_name' => 'Butler County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67039',
                'county_name' => 'Butler County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67041',
                'county_name' => 'Butler County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67042',
                'county_name' => 'Butler County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67045',
                'county_name' => 'Butler County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67072',
                'county_name' => 'Butler County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67074',
                'county_name' => 'Butler County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67114',
                'county_name' => 'Butler County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67123',
                'county_name' => 'Butler County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67131',
                'county_name' => 'Butler County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67132',
                'county_name' => 'Butler County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67133',
                'county_name' => 'Butler County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67144',
                'county_name' => 'Butler County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67146',
                'county_name' => 'Butler County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67154',
                'county_name' => 'Butler County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67228',
                'county_name' => 'Butler County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67230',
                'county_name' => 'Butler County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66801',
                'county_name' => 'Chase County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66838',
                'county_name' => 'Chase County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66840',
                'county_name' => 'Chase County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66843',
                'county_name' => 'Chase County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66845',
                'county_name' => 'Chase County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66846',
                'county_name' => 'Chase County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66850',
                'county_name' => 'Chase County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66858',
                'county_name' => 'Chase County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66862',
                'county_name' => 'Chase County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66869',
                'county_name' => 'Chase County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67024',
                'county_name' => 'Chautauqua County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67334',
                'county_name' => 'Chautauqua County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67344',
                'county_name' => 'Chautauqua County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67346',
                'county_name' => 'Chautauqua County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67347',
                'county_name' => 'Chautauqua County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67352',
                'county_name' => 'Chautauqua County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67353',
                'county_name' => 'Chautauqua County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67355',
                'county_name' => 'Chautauqua County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67360',
                'county_name' => 'Chautauqua County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67361',
                'county_name' => 'Chautauqua County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66713',
                'county_name' => 'Cherokee County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66724',
                'county_name' => 'Cherokee County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66725',
                'county_name' => 'Cherokee County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66728',
                'county_name' => 'Cherokee County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66739',
                'county_name' => 'Cherokee County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66753',
                'county_name' => 'Cherokee County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66762',
                'county_name' => 'Cherokee County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66770',
                'county_name' => 'Cherokee County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66773',
                'county_name' => 'Cherokee County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66778',
                'county_name' => 'Cherokee County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66781',
                'county_name' => 'Cherokee County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66782',
                'county_name' => 'Cherokee County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67336',
                'county_name' => 'Cherokee County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67356',
                'county_name' => 'Cherokee County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67731',
                'county_name' => 'Cheyenne County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67732',
                'county_name' => 'Cheyenne County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67735',
                'county_name' => 'Cheyenne County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67741',
                'county_name' => 'Cheyenne County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67745',
                'county_name' => 'Cheyenne County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67756',
                'county_name' => 'Cheyenne County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67127',
                'county_name' => 'Clark County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67831',
                'county_name' => 'Clark County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67834',
                'county_name' => 'Clark County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67840',
                'county_name' => 'Clark County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67842',
                'county_name' => 'Clark County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67844',
                'county_name' => 'Clark County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67865',
                'county_name' => 'Clark County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66937',
                'county_name' => 'Clay County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66938',
                'county_name' => 'Clay County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66962',
                'county_name' => 'Clay County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67410',
                'county_name' => 'Clay County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67432',
                'county_name' => 'Clay County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67447',
                'county_name' => 'Clay County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67458',
                'county_name' => 'Clay County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67466',
                'county_name' => 'Clay County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67468',
                'county_name' => 'Clay County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67487',
                'county_name' => 'Clay County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66901',
                'county_name' => 'Cloud County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66938',
                'county_name' => 'Cloud County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66948',
                'county_name' => 'Cloud County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67417',
                'county_name' => 'Cloud County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67420',
                'county_name' => 'Cloud County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67436',
                'county_name' => 'Cloud County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67445',
                'county_name' => 'Cloud County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67466',
                'county_name' => 'Cloud County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66015',
                'county_name' => 'Coffey County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66093',
                'county_name' => 'Coffey County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66095',
                'county_name' => 'Coffey County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66758',
                'county_name' => 'Coffey County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66783',
                'county_name' => 'Coffey County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66839',
                'county_name' => 'Coffey County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66852',
                'county_name' => 'Coffey County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66854',
                'county_name' => 'Coffey County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66856',
                'county_name' => 'Coffey County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66857',
                'county_name' => 'Coffey County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66864',
                'county_name' => 'Coffey County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66868',
                'county_name' => 'Coffey County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66871',
                'county_name' => 'Coffey County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67029',
                'county_name' => 'Comanche County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67127',
                'county_name' => 'Comanche County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67155',
                'county_name' => 'Comanche County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67005',
                'county_name' => 'Cowley County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67008',
                'county_name' => 'Cowley County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67019',
                'county_name' => 'Cowley County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67023',
                'county_name' => 'Cowley County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67024',
                'county_name' => 'Cowley County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67038',
                'county_name' => 'Cowley County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67039',
                'county_name' => 'Cowley County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67051',
                'county_name' => 'Cowley County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67072',
                'county_name' => 'Cowley County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67102',
                'county_name' => 'Cowley County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67110',
                'county_name' => 'Cowley County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67119',
                'county_name' => 'Cowley County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67131',
                'county_name' => 'Cowley County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67146',
                'county_name' => 'Cowley County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67156',
                'county_name' => 'Cowley County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66701',
                'county_name' => 'Crawford County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66711',
                'county_name' => 'Crawford County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66712',
                'county_name' => 'Crawford County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66724',
                'county_name' => 'Crawford County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66734',
                'county_name' => 'Crawford County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66735',
                'county_name' => 'Crawford County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66743',
                'county_name' => 'Crawford County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66746',
                'county_name' => 'Crawford County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66753',
                'county_name' => 'Crawford County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66756',
                'county_name' => 'Crawford County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66760',
                'county_name' => 'Crawford County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66762',
                'county_name' => 'Crawford County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66763',
                'county_name' => 'Crawford County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66780',
                'county_name' => 'Crawford County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66781',
                'county_name' => 'Crawford County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67629',
                'county_name' => 'Decatur County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67635',
                'county_name' => 'Decatur County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67643',
                'county_name' => 'Decatur County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67653',
                'county_name' => 'Decatur County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67739',
                'county_name' => 'Decatur County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67749',
                'county_name' => 'Decatur County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67757',
                'county_name' => 'Decatur County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '69026',
                'county_name' => 'Decatur County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66441',
                'county_name' => 'Dickinson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67401',
                'county_name' => 'Dickinson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67410',
                'county_name' => 'Dickinson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67431',
                'county_name' => 'Dickinson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67441',
                'county_name' => 'Dickinson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67448',
                'county_name' => 'Dickinson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67449',
                'county_name' => 'Dickinson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67451',
                'county_name' => 'Dickinson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67458',
                'county_name' => 'Dickinson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67475',
                'county_name' => 'Dickinson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67480',
                'county_name' => 'Dickinson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67482',
                'county_name' => 'Dickinson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67487',
                'county_name' => 'Dickinson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67492',
                'county_name' => 'Dickinson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66002',
                'county_name' => 'Doniphan County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66008',
                'county_name' => 'Doniphan County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66017',
                'county_name' => 'Doniphan County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66024',
                'county_name' => 'Doniphan County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66035',
                'county_name' => 'Doniphan County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66041',
                'county_name' => 'Doniphan County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66087',
                'county_name' => 'Doniphan County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66090',
                'county_name' => 'Doniphan County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66094',
                'county_name' => 'Doniphan County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66532',
                'county_name' => 'Doniphan County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66006',
                'county_name' => 'Douglas County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66021',
                'county_name' => 'Douglas County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66025',
                'county_name' => 'Douglas County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66044',
                'county_name' => 'Douglas County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66045',
                'county_name' => 'Douglas County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66046',
                'county_name' => 'Douglas County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66047',
                'county_name' => 'Douglas County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66049',
                'county_name' => 'Douglas County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66050',
                'county_name' => 'Douglas County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66092',
                'county_name' => 'Douglas County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66409',
                'county_name' => 'Douglas County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66524',
                'county_name' => 'Douglas County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66542',
                'county_name' => 'Douglas County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67054',
                'county_name' => 'Edwards County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67059',
                'county_name' => 'Edwards County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67109',
                'county_name' => 'Edwards County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67519',
                'county_name' => 'Edwards County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67529',
                'county_name' => 'Edwards County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67547',
                'county_name' => 'Edwards County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67552',
                'county_name' => 'Edwards County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67557',
                'county_name' => 'Edwards County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67563',
                'county_name' => 'Edwards County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66736',
                'county_name' => 'Elk County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67047',
                'county_name' => 'Elk County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67122',
                'county_name' => 'Elk County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67137',
                'county_name' => 'Elk County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67344',
                'county_name' => 'Elk County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67345',
                'county_name' => 'Elk County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67346',
                'county_name' => 'Elk County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67349',
                'county_name' => 'Elk County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67352',
                'county_name' => 'Elk County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67353',
                'county_name' => 'Elk County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67548',
                'county_name' => 'Ellis County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67556',
                'county_name' => 'Ellis County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67565',
                'county_name' => 'Ellis County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67601',
                'county_name' => 'Ellis County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67627',
                'county_name' => 'Ellis County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67637',
                'county_name' => 'Ellis County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67640',
                'county_name' => 'Ellis County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67651',
                'county_name' => 'Ellis County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67660',
                'county_name' => 'Ellis County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67663',
                'county_name' => 'Ellis County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67667',
                'county_name' => 'Ellis County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67671',
                'county_name' => 'Ellis County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67674',
                'county_name' => 'Ellis County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67423',
                'county_name' => 'Ellsworth County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67425',
                'county_name' => 'Ellsworth County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67427',
                'county_name' => 'Ellsworth County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => 67439,
                'county_name' => 'Ellsworth County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67444',
                'county_name' => 'Ellsworth County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67450',
                'county_name' => 'Ellsworth County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67454',
                'county_name' => 'Ellsworth County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67459',
                'county_name' => 'Ellsworth County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67464',
                'county_name' => 'Ellsworth County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67490',
                'county_name' => 'Ellsworth County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67835',
                'county_name' => 'Finney County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67838',
                'county_name' => 'Finney County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67839',
                'county_name' => 'Finney County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67846',
                'county_name' => 'Finney County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67851',
                'county_name' => 'Finney County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67853',
                'county_name' => 'Finney County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67868',
                'county_name' => 'Finney County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67871',
                'county_name' => 'Finney County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67880',
                'county_name' => 'Finney County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67563',
                'county_name' => 'Ford County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67801',
                'county_name' => 'Ford County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67834',
                'county_name' => 'Ford County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67835',
                'county_name' => 'Ford County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67841',
                'county_name' => 'Ford County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67842',
                'county_name' => 'Ford County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67844',
                'county_name' => 'Ford County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67865',
                'county_name' => 'Ford County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67876',
                'county_name' => 'Ford County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67882',
                'county_name' => 'Ford County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66006',
                'county_name' => 'Franklin County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66033',
                'county_name' => 'Franklin County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66042',
                'county_name' => 'Franklin County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66064',
                'county_name' => 'Franklin County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66067',
                'county_name' => 'Franklin County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66076',
                'county_name' => 'Franklin County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66078',
                'county_name' => 'Franklin County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66079',
                'county_name' => 'Franklin County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66080',
                'county_name' => 'Franklin County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66091',
                'county_name' => 'Franklin County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66092',
                'county_name' => 'Franklin County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66095',
                'county_name' => 'Franklin County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66524',
                'county_name' => 'Franklin County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66528',
                'county_name' => 'Franklin County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66441',
                'county_name' => 'Geary County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66502',
                'county_name' => 'Geary County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66514',
                'county_name' => 'Geary County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66834',
                'county_name' => 'Geary County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66849',
                'county_name' => 'Geary County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66872',
                'county_name' => 'Geary County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67487',
                'county_name' => 'Geary County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67584',
                'county_name' => 'Gove County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67631',
                'county_name' => 'Gove County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67736',
                'county_name' => 'Gove County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67737',
                'county_name' => 'Gove County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67738',
                'county_name' => 'Gove County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67748',
                'county_name' => 'Gove County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67751',
                'county_name' => 'Gove County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67752',
                'county_name' => 'Gove County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67839',
                'county_name' => 'Gove County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67850',
                'county_name' => 'Gove County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67625',
                'county_name' => 'Graham County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67631',
                'county_name' => 'Graham County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67632',
                'county_name' => 'Graham County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67637',
                'county_name' => 'Graham County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67642',
                'county_name' => 'Graham County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67645',
                'county_name' => 'Graham County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67646',
                'county_name' => 'Graham County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67650',
                'county_name' => 'Graham County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67656',
                'county_name' => 'Graham County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67657',
                'county_name' => 'Graham County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67659',
                'county_name' => 'Graham County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67669',
                'county_name' => 'Graham County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67672',
                'county_name' => 'Graham County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67740',
                'county_name' => 'Graham County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67855',
                'county_name' => 'Grant County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67870',
                'county_name' => 'Grant County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67880',
                'county_name' => 'Grant County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67835',
                'county_name' => 'Gray County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67837',
                'county_name' => 'Gray County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67841',
                'county_name' => 'Gray County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67844',
                'county_name' => 'Gray County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67846',
                'county_name' => 'Gray County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67853',
                'county_name' => 'Gray County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67867',
                'county_name' => 'Gray County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67868',
                'county_name' => 'Gray County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67762',
                'county_name' => 'Greeley County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67879',
                'county_name' => 'Greeley County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66736',
                'county_name' => 'Greenwood County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66777',
                'county_name' => 'Greenwood County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66852',
                'county_name' => 'Greenwood County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66853',
                'county_name' => 'Greenwood County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66854',
                'county_name' => 'Greenwood County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66855',
                'county_name' => 'Greenwood County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66860',
                'county_name' => 'Greenwood County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66863',
                'county_name' => 'Greenwood County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66870',
                'county_name' => 'Greenwood County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67045',
                'county_name' => 'Greenwood County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67047',
                'county_name' => 'Greenwood County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67122',
                'county_name' => 'Greenwood County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67137',
                'county_name' => 'Greenwood County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67836',
                'county_name' => 'Hamilton County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67857',
                'county_name' => 'Hamilton County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67878',
                'county_name' => 'Hamilton County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67003',
                'county_name' => 'Harper County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67004',
                'county_name' => 'Harper County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67009',
                'county_name' => 'Harper County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67018',
                'county_name' => 'Harper County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67036',
                'county_name' => 'Harper County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67049',
                'county_name' => 'Harper County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67058',
                'county_name' => 'Harper County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67061',
                'county_name' => 'Harper County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67118',
                'county_name' => 'Harper County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67138',
                'county_name' => 'Harper County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67150',
                'county_name' => 'Harper County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67159',
                'county_name' => 'Harper County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66866',
                'county_name' => 'Harvey County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67020',
                'county_name' => 'Harvey County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67056',
                'county_name' => 'Harvey County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67062',
                'county_name' => 'Harvey County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67107',
                'county_name' => 'Harvey County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67114',
                'county_name' => 'Harvey County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67117',
                'county_name' => 'Harvey County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67135',
                'county_name' => 'Harvey County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67147',
                'county_name' => 'Harvey County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67151',
                'county_name' => 'Harvey County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67154',
                'county_name' => 'Harvey County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67522',
                'county_name' => 'Harvey County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67546',
                'county_name' => 'Harvey County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67837',
                'county_name' => 'Haskell County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67846',
                'county_name' => 'Haskell County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67870',
                'county_name' => 'Haskell County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67877',
                'county_name' => 'Haskell County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67523',
                'county_name' => 'Hodgeman County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67547',
                'county_name' => 'Hodgeman County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67560',
                'county_name' => 'Hodgeman County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67563',
                'county_name' => 'Hodgeman County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67801',
                'county_name' => 'Hodgeman County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67835',
                'county_name' => 'Hodgeman County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67849',
                'county_name' => 'Hodgeman County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67854',
                'county_name' => 'Hodgeman County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67876',
                'county_name' => 'Hodgeman County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66058',
                'county_name' => 'Jackson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66416',
                'county_name' => 'Jackson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66418',
                'county_name' => 'Jackson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66419',
                'county_name' => 'Jackson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66422',
                'county_name' => 'Jackson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66432',
                'county_name' => 'Jackson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66436',
                'county_name' => 'Jackson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66439',
                'county_name' => 'Jackson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66509',
                'county_name' => 'Jackson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66512',
                'county_name' => 'Jackson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66516',
                'county_name' => 'Jackson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66533',
                'county_name' => 'Jackson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66536',
                'county_name' => 'Jackson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66539',
                'county_name' => 'Jackson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66540',
                'county_name' => 'Jackson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66550',
                'county_name' => 'Jackson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66552',
                'county_name' => 'Jackson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66617',
                'county_name' => 'Jackson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66618',
                'county_name' => 'Jackson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66834',
                'county_name' => 'Jackson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66002',
                'county_name' => 'Jefferson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66044',
                'county_name' => 'Jefferson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66054',
                'county_name' => 'Jefferson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66060',
                'county_name' => 'Jefferson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66066',
                'county_name' => 'Jefferson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66070',
                'county_name' => 'Jefferson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66073',
                'county_name' => 'Jefferson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66086',
                'county_name' => 'Jefferson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66088',
                'county_name' => 'Jefferson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66097',
                'county_name' => 'Jefferson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66419',
                'county_name' => 'Jefferson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66429',
                'county_name' => 'Jefferson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66436',
                'county_name' => 'Jefferson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66512',
                'county_name' => 'Jefferson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66617',
                'county_name' => 'Jefferson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66936',
                'county_name' => 'Jewell County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66939',
                'county_name' => 'Jewell County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66941',
                'county_name' => 'Jewell County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66942',
                'county_name' => 'Jewell County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66948',
                'county_name' => 'Jewell County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66949',
                'county_name' => 'Jewell County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66952',
                'county_name' => 'Jewell County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66956',
                'county_name' => 'Jewell County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66963',
                'county_name' => 'Jewell County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66970',
                'county_name' => 'Jewell County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67420',
                'county_name' => 'Jewell County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67430',
                'county_name' => 'Jewell County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67446',
                'county_name' => 'Jewell County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '68978',
                'county_name' => 'Jewell County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66013',
                'county_name' => 'Johnson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66018',
                'county_name' => 'Johnson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66019',
                'county_name' => 'Johnson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66021',
                'county_name' => 'Johnson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66025',
                'county_name' => 'Johnson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66030',
                'county_name' => 'Johnson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66031',
                'county_name' => 'Johnson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66051',
                'county_name' => 'Johnson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66061',
                'county_name' => 'Johnson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66062',
                'county_name' => 'Johnson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66063',
                'county_name' => 'Johnson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66083',
                'county_name' => 'Johnson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66085',
                'county_name' => 'Johnson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66201',
                'county_name' => 'Johnson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66202',
                'county_name' => 'Johnson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66203',
                'county_name' => 'Johnson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66204',
                'county_name' => 'Johnson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66205',
                'county_name' => 'Johnson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66206',
                'county_name' => 'Johnson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66207',
                'county_name' => 'Johnson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66208',
                'county_name' => 'Johnson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66209',
                'county_name' => 'Johnson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66210',
                'county_name' => 'Johnson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66211',
                'county_name' => 'Johnson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66212',
                'county_name' => 'Johnson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66213',
                'county_name' => 'Johnson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66214',
                'county_name' => 'Johnson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66215',
                'county_name' => 'Johnson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66216',
                'county_name' => 'Johnson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66217',
                'county_name' => 'Johnson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66218',
                'county_name' => 'Johnson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66219',
                'county_name' => 'Johnson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66220',
                'county_name' => 'Johnson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66221',
                'county_name' => 'Johnson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66222',
                'county_name' => 'Johnson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66223',
                'county_name' => 'Johnson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66224',
                'county_name' => 'Johnson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66225',
                'county_name' => 'Johnson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66226',
                'county_name' => 'Johnson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66227',
                'county_name' => 'Johnson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66250',
                'county_name' => 'Johnson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66251',
                'county_name' => 'Johnson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66276',
                'county_name' => 'Johnson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66282',
                'county_name' => 'Johnson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66283',
                'county_name' => 'Johnson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66285',
                'county_name' => 'Johnson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66286',
                'county_name' => 'Johnson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67838',
                'county_name' => 'Kearny County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67851',
                'county_name' => 'Kearny County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67857',
                'county_name' => 'Kearny County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67860',
                'county_name' => 'Kearny County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67880',
                'county_name' => 'Kearny County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67004',
                'county_name' => 'Kingman County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67025',
                'county_name' => 'Kingman County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67035',
                'county_name' => 'Kingman County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67058',
                'county_name' => 'Kingman County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67065',
                'county_name' => 'Kingman County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67068',
                'county_name' => 'Kingman County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67106',
                'county_name' => 'Kingman County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67111',
                'county_name' => 'Kingman County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67112',
                'county_name' => 'Kingman County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67118',
                'county_name' => 'Kingman County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67142',
                'county_name' => 'Kingman County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67159',
                'county_name' => 'Kingman County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67570',
                'county_name' => 'Kingman County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67028',
                'county_name' => 'Kiowa County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67029',
                'county_name' => 'Kiowa County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67054',
                'county_name' => 'Kiowa County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67059',
                'county_name' => 'Kiowa County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67109',
                'county_name' => 'Kiowa County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67155',
                'county_name' => 'Kiowa County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67547',
                'county_name' => 'Kiowa County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67834',
                'county_name' => 'Kiowa County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66753',
                'county_name' => 'Labette County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66776',
                'county_name' => 'Labette County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67330',
                'county_name' => 'Labette County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67332',
                'county_name' => 'Labette County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67333',
                'county_name' => 'Labette County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67335',
                'county_name' => 'Labette County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67336',
                'county_name' => 'Labette County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67341',
                'county_name' => 'Labette County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67342',
                'county_name' => 'Labette County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67351',
                'county_name' => 'Labette County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67354',
                'county_name' => 'Labette County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67356',
                'county_name' => 'Labette County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67518',
                'county_name' => 'Lane County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67584',
                'county_name' => 'Lane County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67839',
                'county_name' => 'Lane County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67846',
                'county_name' => 'Lane County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67850',
                'county_name' => 'Lane County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66002',
                'county_name' => 'Leavenworth County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66007',
                'county_name' => 'Leavenworth County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66012',
                'county_name' => 'Leavenworth County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66020',
                'county_name' => 'Leavenworth County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66027',
                'county_name' => 'Leavenworth County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66043',
                'county_name' => 'Leavenworth County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66044',
                'county_name' => 'Leavenworth County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66048',
                'county_name' => 'Leavenworth County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66052',
                'county_name' => 'Leavenworth County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66054',
                'county_name' => 'Leavenworth County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66086',
                'county_name' => 'Leavenworth County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66097',
                'county_name' => 'Leavenworth County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66109',
                'county_name' => 'Leavenworth County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67418',
                'county_name' => 'Lincoln County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67423',
                'county_name' => 'Lincoln County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67425',
                'county_name' => 'Lincoln County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67439',
                'county_name' => 'Lincoln County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67452',
                'county_name' => 'Lincoln County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67455',
                'county_name' => 'Lincoln County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67467',
                'county_name' => 'Lincoln County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67481',
                'county_name' => 'Lincoln County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67484',
                'county_name' => 'Lincoln County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67490',
                'county_name' => 'Lincoln County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67648',
                'county_name' => 'Lincoln County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66010',
                'county_name' => 'Linn County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66014',
                'county_name' => 'Linn County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66026',
                'county_name' => 'Linn County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66033',
                'county_name' => 'Linn County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66040',
                'county_name' => 'Linn County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66056',
                'county_name' => 'Linn County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66072',
                'county_name' => 'Linn County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66075',
                'county_name' => 'Linn County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66738',
                'county_name' => 'Linn County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66754',
                'county_name' => 'Linn County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66767',
                'county_name' => 'Linn County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67747',
                'county_name' => 'Logan County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67748',
                'county_name' => 'Logan County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67761',
                'county_name' => 'Logan County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67764',
                'county_name' => 'Logan County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67861',
                'county_name' => 'Logan County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67863',
                'county_name' => 'Logan County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67871',
                'county_name' => 'Logan County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66413',
                'county_name' => 'Lyon County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66523',
                'county_name' => 'Lyon County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66801',
                'county_name' => 'Lyon County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66830',
                'county_name' => 'Lyon County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66833',
                'county_name' => 'Lyon County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66835',
                'county_name' => 'Lyon County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66846',
                'county_name' => 'Lyon County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66854',
                'county_name' => 'Lyon County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66860',
                'county_name' => 'Lyon County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66864',
                'county_name' => 'Lyon County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66865',
                'county_name' => 'Lyon County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66868',
                'county_name' => 'Lyon County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67062',
                'county_name' => 'McPherson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67107',
                'county_name' => 'McPherson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67114',
                'county_name' => 'McPherson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67416',
                'county_name' => 'McPherson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67428',
                'county_name' => 'McPherson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67442',
                'county_name' => 'McPherson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67443',
                'county_name' => 'McPherson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67448',
                'county_name' => 'McPherson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67456',
                'county_name' => 'McPherson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67460',
                'county_name' => 'McPherson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67464',
                'county_name' => 'McPherson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67476',
                'county_name' => 'McPherson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67491',
                'county_name' => 'McPherson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67546',
                'county_name' => 'McPherson County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66838',
                'county_name' => 'Marion County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66840',
                'county_name' => 'Marion County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66843',
                'county_name' => 'Marion County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66851',
                'county_name' => 'Marion County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66858',
                'county_name' => 'Marion County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66861',
                'county_name' => 'Marion County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66866',
                'county_name' => 'Marion County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67053',
                'county_name' => 'Marion County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67063',
                'county_name' => 'Marion County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67073',
                'county_name' => 'Marion County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67114',
                'county_name' => 'Marion County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67151',
                'county_name' => 'Marion County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67428',
                'county_name' => 'Marion County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67438',
                'county_name' => 'Marion County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67448',
                'county_name' => 'Marion County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67449',
                'county_name' => 'Marion County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67451',
                'county_name' => 'Marion County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67475',
                'county_name' => 'Marion County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67483',
                'county_name' => 'Marion County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66403',
                'county_name' => 'Marshall County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66404',
                'county_name' => 'Marshall County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66406',
                'county_name' => 'Marshall County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66411',
                'county_name' => 'Marshall County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66412',
                'county_name' => 'Marshall County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66427',
                'county_name' => 'Marshall County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66438',
                'county_name' => 'Marshall County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66508',
                'county_name' => 'Marshall County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66518',
                'county_name' => 'Marshall County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66541',
                'county_name' => 'Marshall County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66544',
                'county_name' => 'Marshall County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66548',
                'county_name' => 'Marshall County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66945',
                'county_name' => 'Marshall County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '68466',
                'county_name' => 'Marshall County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67837',
                'county_name' => 'Meade County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67844',
                'county_name' => 'Meade County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67864',
                'county_name' => 'Meade County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67867',
                'county_name' => 'Meade County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67869',
                'county_name' => 'Meade County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66013',
                'county_name' => 'Miami County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66021',
                'county_name' => 'Miami County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66026',
                'county_name' => 'Miami County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66030',
                'county_name' => 'Miami County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66036',
                'county_name' => 'Miami County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66040',
                'county_name' => 'Miami County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66042',
                'county_name' => 'Miami County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66053',
                'county_name' => 'Miami County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66064',
                'county_name' => 'Miami County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66071',
                'county_name' => 'Miami County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66072',
                'county_name' => 'Miami County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66079',
                'county_name' => 'Miami County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66083',
                'county_name' => 'Miami County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66092',
                'county_name' => 'Miami County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67418',
                'county_name' => 'Mitchell County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67420',
                'county_name' => 'Mitchell County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67430',
                'county_name' => 'Mitchell County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67446',
                'county_name' => 'Mitchell County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67452',
                'county_name' => 'Mitchell County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67478',
                'county_name' => 'Mitchell County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67485',
                'county_name' => 'Mitchell County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66736',
                'county_name' => 'Montgomery County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66757',
                'county_name' => 'Montgomery County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66776',
                'county_name' => 'Montgomery County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67301',
                'county_name' => 'Montgomery County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67333',
                'county_name' => 'Montgomery County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67335',
                'county_name' => 'Montgomery County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67337',
                'county_name' => 'Montgomery County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67340',
                'county_name' => 'Montgomery County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67344',
                'county_name' => 'Montgomery County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67347',
                'county_name' => 'Montgomery County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67351',
                'county_name' => 'Montgomery County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67363',
                'county_name' => 'Montgomery County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67364',
                'county_name' => 'Montgomery County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66834',
                'county_name' => 'Morris County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66835',
                'county_name' => 'Morris County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66838',
                'county_name' => 'Morris County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66846',
                'county_name' => 'Morris County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66849',
                'county_name' => 'Morris County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66859',
                'county_name' => 'Morris County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66872',
                'county_name' => 'Morris County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66873',
                'county_name' => 'Morris County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67449',
                'county_name' => 'Morris County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67855',
                'county_name' => 'Morton County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67862',
                'county_name' => 'Morton County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67950',
                'county_name' => 'Morton County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67953',
                'county_name' => 'Morton County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67954',
                'county_name' => 'Morton County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66403',
                'county_name' => 'Nemaha County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66404',
                'county_name' => 'Nemaha County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66408',
                'county_name' => 'Nemaha County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66415',
                'county_name' => 'Nemaha County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66416',
                'county_name' => 'Nemaha County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66417',
                'county_name' => 'Nemaha County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66428',
                'county_name' => 'Nemaha County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66432',
                'county_name' => 'Nemaha County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66521',
                'county_name' => 'Nemaha County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66522',
                'county_name' => 'Nemaha County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66534',
                'county_name' => 'Nemaha County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66538',
                'county_name' => 'Nemaha County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66540',
                'county_name' => 'Nemaha County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66544',
                'county_name' => 'Nemaha County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66550',
                'county_name' => 'Nemaha County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '68420',
                'county_name' => 'Nemaha County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66720',
                'county_name' => 'Neosho County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66733',
                'county_name' => 'Neosho County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66740',
                'county_name' => 'Neosho County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66748',
                'county_name' => 'Neosho County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66753',
                'county_name' => 'Neosho County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66771',
                'county_name' => 'Neosho County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66772',
                'county_name' => 'Neosho County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66775',
                'county_name' => 'Neosho County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66776',
                'county_name' => 'Neosho County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66780',
                'county_name' => 'Neosho County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67357',
                'county_name' => 'Neosho County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67515',
                'county_name' => 'Ness County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67516',
                'county_name' => 'Ness County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67518',
                'county_name' => 'Ness County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67521',
                'county_name' => 'Ness County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67556',
                'county_name' => 'Ness County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67560',
                'county_name' => 'Ness County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67572',
                'county_name' => 'Ness County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67584',
                'county_name' => 'Ness County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67839',
                'county_name' => 'Ness County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67849',
                'county_name' => 'Ness County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67622',
                'county_name' => 'Norton County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67629',
                'county_name' => 'Norton County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67645',
                'county_name' => 'Norton County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67646',
                'county_name' => 'Norton County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67647',
                'county_name' => 'Norton County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67653',
                'county_name' => 'Norton County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67654',
                'county_name' => 'Norton County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67664',
                'county_name' => 'Norton County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66402',
                'county_name' => 'Osage County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66409',
                'county_name' => 'Osage County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66413',
                'county_name' => 'Osage County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66414',
                'county_name' => 'Osage County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66431',
                'county_name' => 'Osage County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66451',
                'county_name' => 'Osage County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66510',
                'county_name' => 'Osage County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66523',
                'county_name' => 'Osage County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66524',
                'county_name' => 'Osage County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66528',
                'county_name' => 'Osage County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66537',
                'county_name' => 'Osage County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66543',
                'county_name' => 'Osage County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66546',
                'county_name' => 'Osage County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66856',
                'county_name' => 'Osage County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66868',
                'county_name' => 'Osage County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66871',
                'county_name' => 'Osage County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67430',
                'county_name' => 'Osborne County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67437',
                'county_name' => 'Osborne County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67473',
                'county_name' => 'Osborne County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67474',
                'county_name' => 'Osborne County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67485',
                'county_name' => 'Osborne County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67623',
                'county_name' => 'Osborne County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67638',
                'county_name' => 'Osborne County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67648',
                'county_name' => 'Osborne County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67649',
                'county_name' => 'Osborne County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67651',
                'county_name' => 'Osborne County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67658',
                'county_name' => 'Osborne County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67673',
                'county_name' => 'Osborne County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67675',
                'county_name' => 'Osborne County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67401',
                'county_name' => 'Ottawa County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67422',
                'county_name' => 'Ottawa County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67432',
                'county_name' => 'Ottawa County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67436',
                'county_name' => 'Ottawa County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67445',
                'county_name' => 'Ottawa County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67458',
                'county_name' => 'Ottawa County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67466',
                'county_name' => 'Ottawa County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67467',
                'county_name' => 'Ottawa County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67470',
                'county_name' => 'Ottawa County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67480',
                'county_name' => 'Ottawa County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67484',
                'county_name' => 'Ottawa County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67513',
                'county_name' => 'Pawnee County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67519',
                'county_name' => 'Pawnee County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67523',
                'county_name' => 'Pawnee County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67529',
                'county_name' => 'Pawnee County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67547',
                'county_name' => 'Pawnee County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67550',
                'county_name' => 'Pawnee County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67557',
                'county_name' => 'Pawnee County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67559',
                'county_name' => 'Pawnee County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67567',
                'county_name' => 'Pawnee County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67574',
                'county_name' => 'Pawnee County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67575',
                'county_name' => 'Pawnee County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66951',
                'county_name' => 'Phillips County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67621',
                'county_name' => 'Phillips County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67622',
                'county_name' => 'Phillips County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67639',
                'county_name' => 'Phillips County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67644',
                'county_name' => 'Phillips County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67645',
                'county_name' => 'Phillips County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67646',
                'county_name' => 'Phillips County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67647',
                'county_name' => 'Phillips County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67661',
                'county_name' => 'Phillips County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67664',
                'county_name' => 'Phillips County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66407',
                'county_name' => 'Pottawatomie County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66422',
                'county_name' => 'Pottawatomie County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66427',
                'county_name' => 'Pottawatomie County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66432',
                'county_name' => 'Pottawatomie County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66502',
                'county_name' => 'Pottawatomie County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66503',
                'county_name' => 'Pottawatomie County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66520',
                'county_name' => 'Pottawatomie County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66521',
                'county_name' => 'Pottawatomie County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66535',
                'county_name' => 'Pottawatomie County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66536',
                'county_name' => 'Pottawatomie County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66540',
                'county_name' => 'Pottawatomie County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66547',
                'county_name' => 'Pottawatomie County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66549',
                'county_name' => 'Pottawatomie County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67021',
                'county_name' => 'Pratt County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67028',
                'county_name' => 'Pratt County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67035',
                'county_name' => 'Pratt County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67059',
                'county_name' => 'Pratt County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67065',
                'county_name' => 'Pratt County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67066',
                'county_name' => 'Pratt County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67124',
                'county_name' => 'Pratt County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67134',
                'county_name' => 'Pratt County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67557',
                'county_name' => 'Pratt County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67576',
                'county_name' => 'Pratt County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67583',
                'county_name' => 'Pratt County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67701',
                'county_name' => 'Rawlins County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67730',
                'county_name' => 'Rawlins County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67731',
                'county_name' => 'Rawlins County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67732',
                'county_name' => 'Rawlins County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67734',
                'county_name' => 'Rawlins County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67739',
                'county_name' => 'Rawlins County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67744',
                'county_name' => 'Rawlins County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67745',
                'county_name' => 'Rawlins County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67749',
                'county_name' => 'Rawlins County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67753',
                'county_name' => 'Rawlins County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67757',
                'county_name' => 'Rawlins County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67020',
                'county_name' => 'Reno County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67025',
                'county_name' => 'Reno County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67035',
                'county_name' => 'Reno County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67068',
                'county_name' => 'Reno County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67108',
                'county_name' => 'Reno County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67501',
                'county_name' => 'Reno County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67502',
                'county_name' => 'Reno County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67504',
                'county_name' => 'Reno County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67505',
                'county_name' => 'Reno County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67510',
                'county_name' => 'Reno County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67512',
                'county_name' => 'Reno County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67514',
                'county_name' => 'Reno County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67522',
                'county_name' => 'Reno County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67543',
                'county_name' => 'Reno County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67546',
                'county_name' => 'Reno County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67561',
                'county_name' => 'Reno County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67566',
                'county_name' => 'Reno County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67568',
                'county_name' => 'Reno County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67570',
                'county_name' => 'Reno County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67579',
                'county_name' => 'Reno County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67581',
                'county_name' => 'Reno County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67583',
                'county_name' => 'Reno County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67585',
                'county_name' => 'Reno County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66901',
                'county_name' => 'Republic County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66930',
                'county_name' => 'Republic County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66935',
                'county_name' => 'Republic County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66938',
                'county_name' => 'Republic County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66939',
                'county_name' => 'Republic County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66942',
                'county_name' => 'Republic County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66944',
                'county_name' => 'Republic County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66948',
                'county_name' => 'Republic County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66955',
                'county_name' => 'Republic County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66959',
                'county_name' => 'Republic County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66960',
                'county_name' => 'Republic County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66961',
                'county_name' => 'Republic County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66964',
                'county_name' => 'Republic County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66966',
                'county_name' => 'Republic County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '68325',
                'county_name' => 'Republic County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '68327',
                'county_name' => 'Republic County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '68943',
                'county_name' => 'Republic County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67427',
                'county_name' => 'Rice County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67444',
                'county_name' => 'Rice County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67457',
                'county_name' => 'Rice County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67491',
                'county_name' => 'Rice County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67502',
                'county_name' => 'Rice County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67512',
                'county_name' => 'Rice County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67524',
                'county_name' => 'Rice County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67525',
                'county_name' => 'Rice County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67526',
                'county_name' => 'Rice County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67546',
                'county_name' => 'Rice County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67554',
                'county_name' => 'Rice County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67561',
                'county_name' => 'Rice County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67573',
                'county_name' => 'Rice County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67579',
                'county_name' => 'Rice County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66401',
                'county_name' => 'Riley County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66411',
                'county_name' => 'Riley County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66442',
                'county_name' => 'Riley County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66449',
                'county_name' => 'Riley County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66502',
                'county_name' => 'Riley County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66503',
                'county_name' => 'Riley County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66505',
                'county_name' => 'Riley County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66506',
                'county_name' => 'Riley County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66514',
                'county_name' => 'Riley County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66517',
                'county_name' => 'Riley County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66531',
                'county_name' => 'Riley County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66548',
                'county_name' => 'Riley County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66554',
                'county_name' => 'Riley County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66933',
                'county_name' => 'Riley County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67432',
                'county_name' => 'Riley County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67447',
                'county_name' => 'Riley County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67632',
                'county_name' => 'Rooks County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67639',
                'county_name' => 'Rooks County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67644',
                'county_name' => 'Rooks County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67646',
                'county_name' => 'Rooks County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67651',
                'county_name' => 'Rooks County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67657',
                'county_name' => 'Rooks County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67661',
                'county_name' => 'Rooks County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67663',
                'county_name' => 'Rooks County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67669',
                'county_name' => 'Rooks County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67675',
                'county_name' => 'Rooks County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67511',
                'county_name' => 'Rush County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67513',
                'county_name' => 'Rush County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67520',
                'county_name' => 'Rush County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67548',
                'county_name' => 'Rush County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67550',
                'county_name' => 'Rush County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67553',
                'county_name' => 'Rush County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67556',
                'county_name' => 'Rush County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67559',
                'county_name' => 'Rush County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67565',
                'county_name' => 'Rush County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67567',
                'county_name' => 'Rush County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67575',
                'county_name' => 'Rush County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67450',
                'county_name' => 'Russell County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67481',
                'county_name' => 'Russell County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67490',
                'county_name' => 'Russell County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67565',
                'county_name' => 'Russell County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67626',
                'county_name' => 'Russell County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67634',
                'county_name' => 'Russell County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67640',
                'county_name' => 'Russell County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67648',
                'county_name' => 'Russell County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67649',
                'county_name' => 'Russell County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67651',
                'county_name' => 'Russell County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67658',
                'county_name' => 'Russell County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67665',
                'county_name' => 'Russell County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67673',
                'county_name' => 'Russell County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67401',
                'county_name' => 'Saline County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67402',
                'county_name' => 'Saline County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67416',
                'county_name' => 'Saline County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67425',
                'county_name' => 'Saline County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67442',
                'county_name' => 'Saline County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67448',
                'county_name' => 'Saline County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67456',
                'county_name' => 'Saline County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67460',
                'county_name' => 'Saline County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67470',
                'county_name' => 'Saline County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67480',
                'county_name' => 'Saline County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67484',
                'county_name' => 'Saline County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67850',
                'county_name' => 'Scott County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67851',
                'county_name' => 'Scott County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67863',
                'county_name' => 'Scott County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67871',
                'county_name' => 'Scott County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67001',
                'county_name' => 'Sedgwick County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67010',
                'county_name' => 'Sedgwick County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67016',
                'county_name' => 'Sedgwick County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67017',
                'county_name' => 'Sedgwick County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67020',
                'county_name' => 'Sedgwick County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67025',
                'county_name' => 'Sedgwick County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67030',
                'county_name' => 'Sedgwick County',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67031',
                'county_name' => 'Sedgwick County',
                'state_code' => 'KS',
            ],

            [
                'zip_code' => '67037',
                'county_name' => 'Sedgwick',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67039',
                'county_name' => 'Sedgwick',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67050',
                'county_name' => 'Sedgwick',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67052',
                'county_name' => 'Sedgwick',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67055',
                'county_name' => 'Sedgwick',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67060',
                'county_name' => 'Sedgwick',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67067',
                'county_name' => 'Sedgwick',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67101',
                'county_name' => 'Sedgwick',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67106',
                'county_name' => 'Sedgwick',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67108',
                'county_name' => 'Sedgwick',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67110',
                'county_name' => 'Sedgwick',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67118',
                'county_name' => 'Sedgwick',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67120',
                'county_name' => 'Sedgwick',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67133',
                'county_name' => 'Sedgwick',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67135',
                'county_name' => 'Sedgwick',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67147',
                'county_name' => 'Sedgwick',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67149',
                'county_name' => 'Sedgwick',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67201',
                'county_name' => 'Sedgwick',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67202',
                'county_name' => 'Sedgwick',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67203',
                'county_name' => 'Sedgwick',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67204',
                'county_name' => 'Sedgwick',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67205',
                'county_name' => 'Sedgwick',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67206',
                'county_name' => 'Sedgwick',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67207',
                'county_name' => 'Sedgwick',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67208',
                'county_name' => 'Sedgwick',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67209',
                'county_name' => 'Sedgwick',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67210',
                'county_name' => 'Sedgwick',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67211',
                'county_name' => 'Sedgwick',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67212',
                'county_name' => 'Sedgwick',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67213',
                'county_name' => 'Sedgwick',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67214',
                'county_name' => 'Sedgwick',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67215',
                'county_name' => 'Sedgwick',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67216',
                'county_name' => 'Sedgwick',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67217',
                'county_name' => 'Sedgwick',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67218',
                'county_name' => 'Sedgwick',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67219',
                'county_name' => 'Sedgwick',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67220',
                'county_name' => 'Sedgwick',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67221',
                'county_name' => 'Sedgwick',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67223',
                'county_name' => 'Sedgwick',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67226',
                'county_name' => 'Sedgwick',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67227',
                'county_name' => 'Sedgwick',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67228',
                'county_name' => 'Sedgwick',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67230',
                'county_name' => 'Sedgwick',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67232',
                'county_name' => 'Sedgwick',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67235',
                'county_name' => 'Sedgwick',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67260',
                'county_name' => 'Sedgwick',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67275',
                'county_name' => 'Sedgwick',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67276',
                'county_name' => 'Sedgwick',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67277',
                'county_name' => 'Sedgwick',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67278',
                'county_name' => 'Sedgwick',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67859',
                'county_name' => 'Seward',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67869',
                'county_name' => 'Seward',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67870',
                'county_name' => 'Seward',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67877',
                'county_name' => 'Seward',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67901',
                'county_name' => 'Seward',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67905',
                'county_name' => 'Seward',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66050',
                'county_name' => 'Shawnee',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66402',
                'county_name' => 'Shawnee',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66409',
                'county_name' => 'Shawnee',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66420',
                'county_name' => 'Shawnee',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66431',
                'county_name' => 'Shawnee',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66440',
                'county_name' => 'Shawnee',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66512',
                'county_name' => 'Shawnee',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66524',
                'county_name' => 'Shawnee',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66533',
                'county_name' => 'Shawnee',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66536',
                'county_name' => 'Shawnee',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66539',
                'county_name' => 'Shawnee',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66542',
                'county_name' => 'Shawnee',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66546',
                'county_name' => 'Shawnee',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66601',
                'county_name' => 'Shawnee',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66603',
                'county_name' => 'Shawnee',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66604',
                'county_name' => 'Shawnee',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66605',
                'county_name' => 'Shawnee',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66606',
                'county_name' => 'Shawnee',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66607',
                'county_name' => 'Shawnee',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66608',
                'county_name' => 'Shawnee',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66609',
                'county_name' => 'Shawnee',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66610',
                'county_name' => 'Shawnee',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66611',
                'county_name' => 'Shawnee',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66612',
                'county_name' => 'Shawnee',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66614',
                'county_name' => 'Shawnee',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66615',
                'county_name' => 'Shawnee',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66616',
                'county_name' => 'Shawnee',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66617',
                'county_name' => 'Shawnee',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66618',
                'county_name' => 'Shawnee',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66619',
                'county_name' => 'Shawnee',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66620',
                'county_name' => 'Shawnee',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66621',
                'county_name' => 'Shawnee',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66622',
                'county_name' => 'Shawnee',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66624',
                'county_name' => 'Shawnee',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66625',
                'county_name' => 'Shawnee',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66626',
                'county_name' => 'Shawnee',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66628',
                'county_name' => 'Shawnee',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66629',
                'county_name' => 'Shawnee',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66636',
                'county_name' => 'Shawnee',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66637',
                'county_name' => 'Shawnee',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66647',
                'county_name' => 'Shawnee',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66652',
                'county_name' => 'Shawnee',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66653',
                'county_name' => 'Shawnee',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66667',
                'county_name' => 'Shawnee',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66675',
                'county_name' => 'Shawnee',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66683',
                'county_name' => 'Shawnee',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66692',
                'county_name' => 'Shawnee',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66699',
                'county_name' => 'Shawnee',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67631',
                'county_name' => 'Sheridan',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67635',
                'county_name' => 'Sheridan',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67643',
                'county_name' => 'Sheridan',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67650',
                'county_name' => 'Sheridan',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67737',
                'county_name' => 'Sheridan',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67738',
                'county_name' => 'Sheridan',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67740',
                'county_name' => 'Sheridan',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67748',
                'county_name' => 'Sheridan',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67751',
                'county_name' => 'Sheridan',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67752',
                'county_name' => 'Sheridan',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67753',
                'county_name' => 'Sheridan',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67757',
                'county_name' => 'Sheridan',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67732',
                'county_name' => 'Sherman',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67733',
                'county_name' => 'Sherman',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67735',
                'county_name' => 'Sherman',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67741',
                'county_name' => 'Sherman',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67761',
                'county_name' => 'Sherman',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66932',
                'county_name' => 'Smith',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66951',
                'county_name' => 'Smith',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66952',
                'county_name' => 'Smith',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66967',
                'county_name' => 'Smith',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67430',
                'county_name' => 'Smith',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67437',
                'county_name' => 'Smith',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67474',
                'county_name' => 'Smith',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67623',
                'county_name' => 'Smith',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67628',
                'county_name' => 'Smith',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67638',
                'county_name' => 'Smith',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67644',
                'county_name' => 'Smith',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67021',
                'county_name' => 'Stafford',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67526',
                'county_name' => 'Stafford',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67530',
                'county_name' => 'Stafford',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67545',
                'county_name' => 'Stafford',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67550',
                'county_name' => 'Stafford',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67557',
                'county_name' => 'Stafford',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67567',
                'county_name' => 'Stafford',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67576',
                'county_name' => 'Stafford',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67578',
                'county_name' => 'Stafford',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67583',
                'county_name' => 'Stafford',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67855',
                'county_name' => 'Stanton',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67862',
                'county_name' => 'Stanton',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67878',
                'county_name' => 'Stanton',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67901',
                'county_name' => 'Stevens',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67951',
                'county_name' => 'Stevens',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67952',
                'county_name' => 'Stevens',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67954',
                'county_name' => 'Stevens',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67004',
                'county_name' => 'Sumner',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67013',
                'county_name' => 'Sumner',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67018',
                'county_name' => 'Sumner',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67022',
                'county_name' => 'Sumner',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67026',
                'county_name' => 'Sumner',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67031',
                'county_name' => 'Sumner',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67049',
                'county_name' => 'Sumner',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67051',
                'county_name' => 'Sumner',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67103',
                'county_name' => 'Sumner',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67105',
                'county_name' => 'Sumner',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67106',
                'county_name' => 'Sumner',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67110',
                'county_name' => 'Sumner',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67118',
                'county_name' => 'Sumner',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67119',
                'county_name' => 'Sumner',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67120',
                'county_name' => 'Sumner',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67140',
                'county_name' => 'Sumner',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67146',
                'county_name' => 'Sumner',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67152',
                'county_name' => 'Sumner',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67701',
                'county_name' => 'Thomas',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67732',
                'county_name' => 'Thomas',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67734',
                'county_name' => 'Thomas',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67743',
                'county_name' => 'Thomas',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67747',
                'county_name' => 'Thomas',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67748',
                'county_name' => 'Thomas',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67753',
                'county_name' => 'Thomas',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67757',
                'county_name' => 'Thomas',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67764',
                'county_name' => 'Thomas',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67521',
                'county_name' => 'Trego',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67572',
                'county_name' => 'Trego',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67584',
                'county_name' => 'Trego',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67631',
                'county_name' => 'Trego',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67637',
                'county_name' => 'Trego',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67656',
                'county_name' => 'Trego',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67657',
                'county_name' => 'Trego',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67672',
                'county_name' => 'Trego',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66401',
                'county_name' => 'Wabaunsee',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66407',
                'county_name' => 'Wabaunsee',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66413',
                'county_name' => 'Wabaunsee',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66423',
                'county_name' => 'Wabaunsee',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66431',
                'county_name' => 'Wabaunsee',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66501',
                'county_name' => 'Wabaunsee',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66502',
                'county_name' => 'Wabaunsee',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66507',
                'county_name' => 'Wabaunsee',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66526',
                'county_name' => 'Wabaunsee',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66536',
                'county_name' => 'Wabaunsee',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66547',
                'county_name' => 'Wabaunsee',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66610',
                'county_name' => 'Wabaunsee',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66614',
                'county_name' => 'Wabaunsee',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66615',
                'county_name' => 'Wabaunsee',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66833',
                'county_name' => 'Wabaunsee',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66834',
                'county_name' => 'Wabaunsee',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66846',
                'county_name' => 'Wabaunsee',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67741',
                'county_name' => 'Wallace',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67758',
                'county_name' => 'Wallace',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67761',
                'county_name' => 'Wallace',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67762',
                'county_name' => 'Wallace',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66412',
                'county_name' => 'Washington',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66548',
                'county_name' => 'Washington',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66933',
                'county_name' => 'Washington',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66937',
                'county_name' => 'Washington',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66938',
                'county_name' => 'Washington',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66940',
                'county_name' => 'Washington',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66943',
                'county_name' => 'Washington',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66944',
                'county_name' => 'Washington',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66945',
                'county_name' => 'Washington',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66946',
                'county_name' => 'Washington',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66953',
                'county_name' => 'Washington',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66955',
                'county_name' => 'Washington',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66958',
                'county_name' => 'Washington',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66959',
                'county_name' => 'Washington',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66960',
                'county_name' => 'Washington',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66962',
                'county_name' => 'Washington',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66968',
                'county_name' => 'Washington',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67761',
                'county_name' => 'Wichita',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67861',
                'county_name' => 'Wichita',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67863',
                'county_name' => 'Wichita',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67871',
                'county_name' => 'Wichita',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67879',
                'county_name' => 'Wichita',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66710',
                'county_name' => 'Wilson',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66714',
                'county_name' => 'Wilson',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66717',
                'county_name' => 'Wilson',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66720',
                'county_name' => 'Wilson',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66736',
                'county_name' => 'Wilson',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66757',
                'county_name' => 'Wilson',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66759',
                'county_name' => 'Wilson',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66776',
                'county_name' => 'Wilson',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66777',
                'county_name' => 'Wilson',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67047',
                'county_name' => 'Wilson',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67335',
                'county_name' => 'Wilson',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '67352',
                'county_name' => 'Wilson',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66717',
                'county_name' => 'Woodson',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66720',
                'county_name' => 'Woodson',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66736',
                'county_name' => 'Woodson',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66748',
                'county_name' => 'Woodson',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66758',
                'county_name' => 'Woodson',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66761',
                'county_name' => 'Woodson',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66777',
                'county_name' => 'Woodson',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66783',
                'county_name' => 'Woodson',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66852',
                'county_name' => 'Woodson',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66870',
                'county_name' => 'Woodson',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66007',
                'county_name' => 'Wyandotte',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66012',
                'county_name' => 'Wyandotte',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66101',
                'county_name' => 'Wyandotte',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66102',
                'county_name' => 'Wyandotte',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66103',
                'county_name' => 'Wyandotte',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66104',
                'county_name' => 'Wyandotte',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66105',
                'county_name' => 'Wyandotte',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66106',
                'county_name' => 'Wyandotte',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66109',
                'county_name' => 'Wyandotte',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66110',
                'county_name' => 'Wyandotte',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66111',
                'county_name' => 'Wyandotte',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66112',
                'county_name' => 'Wyandotte',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66113',
                'county_name' => 'Wyandotte',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66115',
                'county_name' => 'Wyandotte',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66117',
                'county_name' => 'Wyandotte',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66118',
                'county_name' => 'Wyandotte',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66119',
                'county_name' => 'Wyandotte',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66160',
                'county_name' => 'Wyandotte',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66216',
                'county_name' => 'Wyandotte',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '66217',
                'county_name' => 'Wyandotte',
                'state_code' => 'KS',
            ],
            [
                'zip_code' => '63501',
                'county_name' => 'Adair',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63533',
                'county_name' => 'Adair',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63540',
                'county_name' => 'Adair',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63544',
                'county_name' => 'Adair',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63546',
                'county_name' => 'Adair',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63547',
                'county_name' => 'Adair',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63549',
                'county_name' => 'Adair',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63557',
                'county_name' => 'Adair',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63559',
                'county_name' => 'Adair',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64421',
                'county_name' => 'Andrew',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64423',
                'county_name' => 'Andrew',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64427',
                'county_name' => 'Andrew',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64430',
                'county_name' => 'Andrew',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64436',
                'county_name' => 'Andrew',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64449',
                'county_name' => 'Andrew',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64455',
                'county_name' => 'Andrew',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64457',
                'county_name' => 'Andrew',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64459',
                'county_name' => 'Andrew',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64463',
                'county_name' => 'Andrew',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64480',
                'county_name' => 'Andrew',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64483',
                'county_name' => 'Andrew',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64485',
                'county_name' => 'Andrew',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64494',
                'county_name' => 'Andrew',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64505',
                'county_name' => 'Andrew',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64506',
                'county_name' => 'Andrew',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64507',
                'county_name' => 'Andrew',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '51640',
                'county_name' => 'Atchison',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64428',
                'county_name' => 'Atchison',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64446',
                'county_name' => 'Atchison',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64482',
                'county_name' => 'Atchison',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64487',
                'county_name' => 'Atchison',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64491',
                'county_name' => 'Atchison',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64496',
                'county_name' => 'Atchison',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64498',
                'county_name' => 'Atchison',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63345',
                'county_name' => 'Audrain',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63352',
                'county_name' => 'Audrain',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63359',
                'county_name' => 'Audrain',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63382',
                'county_name' => 'Audrain',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63384',
                'county_name' => 'Audrain',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65231',
                'county_name' => 'Audrain',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65232',
                'county_name' => 'Audrain',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65240',
                'county_name' => 'Audrain',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65243',
                'county_name' => 'Audrain',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65263',
                'county_name' => 'Audrain',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65264',
                'county_name' => 'Audrain',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65265',
                'county_name' => 'Audrain',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65280',
                'county_name' => 'Audrain',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65284',
                'county_name' => 'Audrain',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65285',
                'county_name' => 'Audrain',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64842',
                'county_name' => 'Barry',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64861',
                'county_name' => 'Barry',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64874',
                'county_name' => 'Barry',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65605',
                'county_name' => 'Barry',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65623',
                'county_name' => 'Barry',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65624',
                'county_name' => 'Barry',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65625',
                'county_name' => 'Barry',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65633',
                'county_name' => 'Barry',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65641',
                'county_name' => 'Barry',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65647',
                'county_name' => 'Barry',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65658',
                'county_name' => 'Barry',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65708',
                'county_name' => 'Barry',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65723',
                'county_name' => 'Barry',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65734',
                'county_name' => 'Barry',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65745',
                'county_name' => 'Barry',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65747',
                'county_name' => 'Barry',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65769',
                'county_name' => 'Barry',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65772',
                'county_name' => 'Barry',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64728',
                'county_name' => 'Barton',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64748',
                'county_name' => 'Barton',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64755',
                'county_name' => 'Barton',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64759',
                'county_name' => 'Barton',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64762',
                'county_name' => 'Barton',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64766',
                'county_name' => 'Barton',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64769',
                'county_name' => 'Barton',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64784',
                'county_name' => 'Barton',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64832',
                'county_name' => 'Barton',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64855',
                'county_name' => 'Barton',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65682',
                'county_name' => 'Barton',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64720',
                'county_name' => 'Bates',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64722',
                'county_name' => 'Bates',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64723',
                'county_name' => 'Bates',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64724',
                'county_name' => 'Bates',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64725',
                'county_name' => 'Bates',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64730',
                'county_name' => 'Bates',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64742',
                'county_name' => 'Bates',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64745',
                'county_name' => 'Bates',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64747',
                'county_name' => 'Bates',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64752',
                'county_name' => 'Bates',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64770',
                'county_name' => 'Bates',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64779',
                'county_name' => 'Bates',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64780',
                'county_name' => 'Bates',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64788',
                'county_name' => 'Bates',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64735',
                'county_name' => 'Benton',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64776',
                'county_name' => 'Benton',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65078',
                'county_name' => 'Benton',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65323',
                'county_name' => 'Benton',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65324',
                'county_name' => 'Benton',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65325',
                'county_name' => 'Benton',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65326',
                'county_name' => 'Benton',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65335',
                'county_name' => 'Benton',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65338',
                'county_name' => 'Benton',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65345',
                'county_name' => 'Benton',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65355',
                'county_name' => 'Benton',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65360',
                'county_name' => 'Benton',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65634',
                'county_name' => 'Benton',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65735',
                'county_name' => 'Benton',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65779',
                'county_name' => 'Benton',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63645',
                'county_name' => 'Bollinger',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63655',
                'county_name' => 'Bollinger',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63662',
                'county_name' => 'Bollinger',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63730',
                'county_name' => 'Bollinger',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63750',
                'county_name' => 'Bollinger',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63751',
                'county_name' => 'Bollinger',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63760',
                'county_name' => 'Bollinger',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63764',
                'county_name' => 'Bollinger',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63766',
                'county_name' => 'Bollinger',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63775',
                'county_name' => 'Bollinger',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63781',
                'county_name' => 'Bollinger',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63782',
                'county_name' => 'Bollinger',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63785',
                'county_name' => 'Bollinger',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63787',
                'county_name' => 'Bollinger',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63862',
                'county_name' => 'Bollinger',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63960',
                'county_name' => 'Bollinger',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65010',
                'county_name' => 'Boone',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65039',
                'county_name' => 'Boone',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65063',
                'county_name' => 'Boone',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65201',
                'county_name' => 'Boone',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65202',
                'county_name' => 'Boone',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65203',
                'county_name' => 'Boone',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65205',
                'county_name' => 'Boone',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65211',
                'county_name' => 'Boone',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65212',
                'county_name' => 'Boone',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65215',
                'county_name' => 'Boone',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65216',
                'county_name' => 'Boone',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65217',
                'county_name' => 'Boone',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65218',
                'county_name' => 'Boone',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65240',
                'county_name' => 'Boone',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65243',
                'county_name' => 'Boone',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65255',
                'county_name' => 'Boone',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65256',
                'county_name' => 'Boone',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65279',
                'county_name' => 'Boone',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65284',
                'county_name' => 'Boone',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65299',
                'county_name' => 'Boone',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64401',
                'county_name' => 'Buchanan',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64439',
                'county_name' => 'Buchanan',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64440',
                'county_name' => 'Buchanan',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64443',
                'county_name' => 'Buchanan',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64444',
                'county_name' => 'Buchanan',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64448',
                'county_name' => 'Buchanan',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64454',
                'county_name' => 'Buchanan',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64484',
                'county_name' => 'Buchanan',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64490',
                'county_name' => 'Buchanan',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64501',
                'county_name' => 'Buchanan',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64502',
                'county_name' => 'Buchanan',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64503',
                'county_name' => 'Buchanan',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64504',
                'county_name' => 'Buchanan',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64505',
                'county_name' => 'Buchanan',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64506',
                'county_name' => 'Buchanan',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64507',
                'county_name' => 'Buchanan',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64508',
                'county_name' => 'Buchanan',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63901',
                'county_name' => 'Butler',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63902',
                'county_name' => 'Butler',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63932',
                'county_name' => 'Butler',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63937',
                'county_name' => 'Butler',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63938',
                'county_name' => 'Butler',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63940',
                'county_name' => 'Butler',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63945',
                'county_name' => 'Butler',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63953',
                'county_name' => 'Butler',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63954',
                'county_name' => 'Butler',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63961',
                'county_name' => 'Butler',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63962',
                'county_name' => 'Butler',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63966',
                'county_name' => 'Butler',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63967',
                'county_name' => 'Butler',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64429',
                'county_name' => 'Caldwell',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64465',
                'county_name' => 'Caldwell',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64624',
                'county_name' => 'Caldwell',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64625',
                'county_name' => 'Caldwell',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64637',
                'county_name' => 'Caldwell',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64644',
                'county_name' => 'Caldwell',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64649',
                'county_name' => 'Caldwell',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64650',
                'county_name' => 'Caldwell',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64671',
                'county_name' => 'Caldwell',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63361',
                'county_name' => 'Callaway',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63384',
                'county_name' => 'Callaway',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63388',
                'county_name' => 'Callaway',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65039',
                'county_name' => 'Callaway',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65043',
                'county_name' => 'Callaway',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65059',
                'county_name' => 'Callaway',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65063',
                'county_name' => 'Callaway',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65067',
                'county_name' => 'Callaway',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65069',
                'county_name' => 'Callaway',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65077',
                'county_name' => 'Callaway',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65080',
                'county_name' => 'Callaway',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65101',
                'county_name' => 'Callaway',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65201',
                'county_name' => 'Callaway',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65202',
                'county_name' => 'Callaway',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65231',
                'county_name' => 'Callaway',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65240',
                'county_name' => 'Callaway',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65251',
                'county_name' => 'Callaway',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65262',
                'county_name' => 'Callaway',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65264',
                'county_name' => 'Callaway',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65265',
                'county_name' => 'Callaway',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65020',
                'county_name' => 'Camden',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65037',
                'county_name' => 'Camden',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65047',
                'county_name' => 'Camden',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65049',
                'county_name' => 'Camden',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65052',
                'county_name' => 'Camden',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65065',
                'county_name' => 'Camden',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65079',
                'county_name' => 'Camden',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65324',
                'county_name' => 'Camden',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65326',
                'county_name' => 'Camden',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65536',
                'county_name' => 'Camden',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65556',
                'county_name' => 'Camden',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65567',
                'county_name' => 'Camden',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65591',
                'county_name' => 'Camden',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65634',
                'county_name' => 'Camden',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65786',
                'county_name' => 'Camden',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65787',
                'county_name' => 'Camden',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63701',
                'county_name' => 'Cape Girardeau',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63702',
                'county_name' => 'Cape Girardeau',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63703',
                'county_name' => 'Cape Girardeau',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63730',
                'county_name' => 'Cape Girardeau',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63732',
                'county_name' => 'Cape Girardeau',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63739',
                'county_name' => 'Cape Girardeau',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63740',
                'county_name' => 'Cape Girardeau',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63743',
                'county_name' => 'Cape Girardeau',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63744',
                'county_name' => 'Cape Girardeau',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63745',
                'county_name' => 'Cape Girardeau',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63747',
                'county_name' => 'Cape Girardeau',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63752',
                'county_name' => 'Cape Girardeau',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63755',
                'county_name' => 'Cape Girardeau',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63764',
                'county_name' => 'Cape Girardeau',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63766',
                'county_name' => 'Cape Girardeau',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63769',
                'county_name' => 'Cape Girardeau',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63770',
                'county_name' => 'Cape Girardeau',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63771',
                'county_name' => 'Cape Girardeau',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63775',
                'county_name' => 'Cape Girardeau',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63779',
                'county_name' => 'Cape Girardeau',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63780',
                'county_name' => 'Cape Girardeau',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63781',
                'county_name' => 'Cape Girardeau',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63785',
                'county_name' => 'Cape Girardeau',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64035',
                'county_name' => 'Carroll',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64622',
                'county_name' => 'Carroll',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64623',
                'county_name' => 'Carroll',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64624',
                'county_name' => 'Carroll',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64633',
                'county_name' => 'Carroll',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64638',
                'county_name' => 'Carroll',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64639',
                'county_name' => 'Carroll',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64643',
                'county_name' => 'Carroll',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64668',
                'county_name' => 'Carroll',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64682',
                'county_name' => 'Carroll',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63935',
                'county_name' => 'Carter',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63937',
                'county_name' => 'Carter',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63941',
                'county_name' => 'Carter',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63943',
                'county_name' => 'Carter',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63965',
                'county_name' => 'Carter',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64012',
                'county_name' => 'Cass',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64034',
                'county_name' => 'Cass',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64040',
                'county_name' => 'Cass',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64061',
                'county_name' => 'Cass',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64078',
                'county_name' => 'Cass',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64080',
                'county_name' => 'Cass',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64082',
                'county_name' => 'Cass',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64083',
                'county_name' => 'Cass',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64090',
                'county_name' => 'Cass',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64147',
                'county_name' => 'Cass',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64701',
                'county_name' => 'Cass',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64720',
                'county_name' => 'Cass',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64725',
                'county_name' => 'Cass',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64734',
                'county_name' => 'Cass',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64739',
                'county_name' => 'Cass',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64742',
                'county_name' => 'Cass',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64743',
                'county_name' => 'Cass',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64746',
                'county_name' => 'Cass',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64747',
                'county_name' => 'Cass',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64788',
                'county_name' => 'Cass',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64744',
                'county_name' => 'Cedar',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64756',
                'county_name' => 'Cedar',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64776',
                'county_name' => 'Cedar',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64784',
                'county_name' => 'Cedar',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65601',
                'county_name' => 'Cedar',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65607',
                'county_name' => 'Cedar',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65640',
                'county_name' => 'Cedar',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65649',
                'county_name' => 'Cedar',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65674',
                'county_name' => 'Cedar',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65682',
                'county_name' => 'Cedar',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65785',
                'county_name' => 'Cedar',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63558',
                'county_name' => 'Chariton',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64628',
                'county_name' => 'Chariton',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64658',
                'county_name' => 'Chariton',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64660',
                'county_name' => 'Chariton',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64676',
                'county_name' => 'Chariton',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64681',
                'county_name' => 'Chariton',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65236',
                'county_name' => 'Chariton',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65244',
                'county_name' => 'Chariton',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65246',
                'county_name' => 'Chariton',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65254',
                'county_name' => 'Chariton',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65261',
                'county_name' => 'Chariton',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65281',
                'county_name' => 'Chariton',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65286',
                'county_name' => 'Chariton',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65610',
                'county_name' => 'Christian',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65614',
                'county_name' => 'Christian',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65619',
                'county_name' => 'Christian',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65620',
                'county_name' => 'Christian',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65629',
                'county_name' => 'Christian',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65630',
                'county_name' => 'Christian',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65631',
                'county_name' => 'Christian',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65652',
                'county_name' => 'Christian',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65653',
                'county_name' => 'Christian',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65656',
                'county_name' => 'Christian',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65657',
                'county_name' => 'Christian',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65669',
                'county_name' => 'Christian',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65705',
                'county_name' => 'Christian',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65714',
                'county_name' => 'Christian',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65720',
                'county_name' => 'Christian',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65721',
                'county_name' => 'Christian',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65728',
                'county_name' => 'Christian',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65737',
                'county_name' => 'Christian',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65738',
                'county_name' => 'Christian',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65742',
                'county_name' => 'Christian',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65753',
                'county_name' => 'Christian',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65754',
                'county_name' => 'Christian',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65759',
                'county_name' => 'Christian',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '52626',
                'county_name' => 'Clark',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63430',
                'county_name' => 'Clark',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63432',
                'county_name' => 'Clark',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63435',
                'county_name' => 'Clark',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63445',
                'county_name' => 'Clark',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63453',
                'county_name' => 'Clark',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63465',
                'county_name' => 'Clark',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63466',
                'county_name' => 'Clark',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63472',
                'county_name' => 'Clark',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63473',
                'county_name' => 'Clark',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63474',
                'county_name' => 'Clark',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64024',
                'county_name' => 'Clay',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64048',
                'county_name' => 'Clay',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64060',
                'county_name' => 'Clay',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64062',
                'county_name' => 'Clay',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64068',
                'county_name' => 'Clay',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64069',
                'county_name' => 'Clay',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64072',
                'county_name' => 'Clay',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64073',
                'county_name' => 'Clay',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64077',
                'county_name' => 'Clay',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64089',
                'county_name' => 'Clay',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64116',
                'county_name' => 'Clay',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64117',
                'county_name' => 'Clay',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64118',
                'county_name' => 'Clay',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64119',
                'county_name' => 'Clay',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64144',
                'county_name' => 'Clay',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64151',
                'county_name' => 'Clay',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64155',
                'county_name' => 'Clay',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64156',
                'county_name' => 'Clay',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64157',
                'county_name' => 'Clay',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64158',
                'county_name' => 'Clay',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64161',
                'county_name' => 'Clay',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64165',
                'county_name' => 'Clay',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64166',
                'county_name' => 'Clay',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64167',
                'county_name' => 'Clay',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64188',
                'county_name' => 'Clay',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64492',
                'county_name' => 'Clay',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64048',
                'county_name' => 'Clinton',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64062',
                'county_name' => 'Clinton',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64089',
                'county_name' => 'Clinton',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64429',
                'county_name' => 'Clinton',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64444',
                'county_name' => 'Clinton',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64454',
                'county_name' => 'Clinton',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64465',
                'county_name' => 'Clinton',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64474',
                'county_name' => 'Clinton',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64477',
                'county_name' => 'Clinton',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64490',
                'county_name' => 'Clinton',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64492',
                'county_name' => 'Clinton',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64493',
                'county_name' => 'Clinton',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65023',
                'county_name' => 'Cole',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65032',
                'county_name' => 'Cole',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65040',
                'county_name' => 'Cole',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65053',
                'county_name' => 'Cole',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65058',
                'county_name' => 'Cole',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65074',
                'county_name' => 'Cole',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65076',
                'county_name' => 'Cole',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65101',
                'county_name' => 'Cole',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65102',
                'county_name' => 'Cole',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65103',
                'county_name' => 'Cole',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65104',
                'county_name' => 'Cole',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65105',
                'county_name' => 'Cole',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65106',
                'county_name' => 'Cole',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65107',
                'county_name' => 'Cole',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65108',
                'county_name' => 'Cole',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65109',
                'county_name' => 'Cole',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65110',
                'county_name' => 'Cole',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65111',
                'county_name' => 'Cole',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65018',
                'county_name' => 'Cooper',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65025',
                'county_name' => 'Cooper',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65046',
                'county_name' => 'Cooper',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65068',
                'county_name' => 'Cooper',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65081',
                'county_name' => 'Cooper',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65233',
                'county_name' => 'Cooper',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65237',
                'county_name' => 'Cooper',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65276',
                'county_name' => 'Cooper',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65287',
                'county_name' => 'Cooper',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65301',
                'county_name' => 'Cooper',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65322',
                'county_name' => 'Cooper',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65347',
                'county_name' => 'Cooper',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65348',
                'county_name' => 'Cooper',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65350',
                'county_name' => 'Cooper',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65354',
                'county_name' => 'Cooper',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63080',
                'county_name' => 'Crawford',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65066',
                'county_name' => 'Crawford',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65441',
                'county_name' => 'Crawford',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65446',
                'county_name' => 'Crawford',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65449',
                'county_name' => 'Crawford',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65453',
                'county_name' => 'Crawford',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65456',
                'county_name' => 'Crawford',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65535',
                'county_name' => 'Crawford',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65559',
                'county_name' => 'Crawford',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65560',
                'county_name' => 'Crawford',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65565',
                'county_name' => 'Crawford',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65566',
                'county_name' => 'Crawford',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65586',
                'county_name' => 'Crawford',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64748',
                'county_name' => 'Dade',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64756',
                'county_name' => 'Dade',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64759',
                'county_name' => 'Dade',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65601',
                'county_name' => 'Dade',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65603',
                'county_name' => 'Dade',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65604',
                'county_name' => 'Dade',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65635',
                'county_name' => 'Dade',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65646',
                'county_name' => 'Dade',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65661',
                'county_name' => 'Dade',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65682',
                'county_name' => 'Dade',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65752',
                'county_name' => 'Dade',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65770',
                'county_name' => 'Dade',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65463',
                'county_name' => 'Dallas',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65536',
                'county_name' => 'Dallas',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65590',
                'county_name' => 'Dallas',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65622',
                'county_name' => 'Dallas',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65632',
                'county_name' => 'Dallas',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65644',
                'county_name' => 'Dallas',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65648',
                'county_name' => 'Dallas',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65685',
                'county_name' => 'Dallas',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65722',
                'county_name' => 'Dallas',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65732',
                'county_name' => 'Dallas',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65764',
                'county_name' => 'Dallas',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65767',
                'county_name' => 'Dallas',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65783',
                'county_name' => 'Dallas',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65786',
                'county_name' => 'Dallas',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64429',
                'county_name' => 'Daviess',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64497',
                'county_name' => 'Daviess',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64601',
                'county_name' => 'Daviess',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64620',
                'county_name' => 'Daviess',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64625',
                'county_name' => 'Daviess',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64636',
                'county_name' => 'Daviess',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64640',
                'county_name' => 'Daviess',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64642',
                'county_name' => 'Daviess',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64644',
                'county_name' => 'Daviess',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64647',
                'county_name' => 'Daviess',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64648',
                'county_name' => 'Daviess',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64649',
                'county_name' => 'Daviess',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64654',
                'county_name' => 'Daviess',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64657',
                'county_name' => 'Daviess',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64670',
                'county_name' => 'Daviess',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64689',
                'county_name' => 'Daviess',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64422',
                'county_name' => 'DeKalb',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64429',
                'county_name' => 'DeKalb',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64430',
                'county_name' => 'DeKalb',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64463',
                'county_name' => 'DeKalb',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64469',
                'county_name' => 'DeKalb',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64474',
                'county_name' => 'DeKalb',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64490',
                'county_name' => 'DeKalb',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64494',
                'county_name' => 'DeKalb',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64497',
                'county_name' => 'DeKalb',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64670',
                'county_name' => 'DeKalb',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63629',
                'county_name' => 'Dent',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65401',
                'county_name' => 'Dent',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65440',
                'county_name' => 'Dent',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65462',
                'county_name' => 'Dent',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65501',
                'county_name' => 'Dent',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65532',
                'county_name' => 'Dent',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65541',
                'county_name' => 'Dent',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65542',
                'county_name' => 'Dent',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65560',
                'county_name' => 'Dent',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65608',
                'county_name' => 'Douglas',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65620',
                'county_name' => 'Douglas',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65629',
                'county_name' => 'Douglas',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65637',
                'county_name' => 'Douglas',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65638',
                'county_name' => 'Douglas',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65652',
                'county_name' => 'Douglas',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65689',
                'county_name' => 'Douglas',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65701',
                'county_name' => 'Douglas',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65702',
                'county_name' => 'Douglas',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65704',
                'county_name' => 'Douglas',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65711',
                'county_name' => 'Douglas',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65717',
                'county_name' => 'Douglas',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65720',
                'county_name' => 'Douglas',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65746',
                'county_name' => 'Douglas',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65753',
                'county_name' => 'Douglas',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65755',
                'county_name' => 'Douglas',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65768',
                'county_name' => 'Douglas',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65773',
                'county_name' => 'Douglas',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65775',
                'county_name' => 'Douglas',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63821',
                'county_name' => 'Dunklin',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63822',
                'county_name' => 'Dunklin',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63829',
                'county_name' => 'Dunklin',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63837',
                'county_name' => 'Dunklin',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63847',
                'county_name' => 'Dunklin',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63849',
                'county_name' => 'Dunklin',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63852',
                'county_name' => 'Dunklin',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63853',
                'county_name' => 'Dunklin',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63855',
                'county_name' => 'Dunklin',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63857',
                'county_name' => 'Dunklin',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63863',
                'county_name' => 'Dunklin',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63875',
                'county_name' => 'Dunklin',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63876',
                'county_name' => 'Dunklin',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63877',
                'county_name' => 'Dunklin',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63880',
                'county_name' => 'Dunklin',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63933',
                'county_name' => 'Dunklin',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63005',
                'county_name' => 'Franklin',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63013',
                'county_name' => 'Franklin',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63014',
                'county_name' => 'Franklin',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63015',
                'county_name' => 'Franklin',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63037',
                'county_name' => 'Franklin',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63039',
                'county_name' => 'Franklin',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63041',
                'county_name' => 'Franklin',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63055',
                'county_name' => 'Franklin',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63056',
                'county_name' => 'Franklin',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63060',
                'county_name' => 'Franklin',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63061',
                'county_name' => 'Franklin',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63068',
                'county_name' => 'Franklin',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63069',
                'county_name' => 'Franklin',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63072',
                'county_name' => 'Franklin',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63073',
                'county_name' => 'Franklin',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63077',
                'county_name' => 'Franklin',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63079',
                'county_name' => 'Franklin',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63080',
                'county_name' => 'Franklin',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63084',
                'county_name' => 'Franklin',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63089',
                'county_name' => 'Franklin',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63090',
                'county_name' => 'Franklin',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63091',
                'county_name' => 'Franklin',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65041',
                'county_name' => 'Franklin',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65441',
                'county_name' => 'Franklin',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63014',
                'county_name' => 'Gasconade',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63068',
                'county_name' => 'Gasconade',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63091',
                'county_name' => 'Gasconade',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65014',
                'county_name' => 'Gasconade',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65036',
                'county_name' => 'Gasconade',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65041',
                'county_name' => 'Gasconade',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65051',
                'county_name' => 'Gasconade',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65061',
                'county_name' => 'Gasconade',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65062',
                'county_name' => 'Gasconade',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65066',
                'county_name' => 'Gasconade',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65441',
                'county_name' => 'Gasconade',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65453',
                'county_name' => 'Gasconade',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65559',
                'county_name' => 'Gasconade',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64402',
                'county_name' => 'Gentry',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64438',
                'county_name' => 'Gentry',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64441',
                'county_name' => 'Gentry',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64453',
                'county_name' => 'Gentry',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64463',
                'county_name' => 'Gentry',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64469',
                'county_name' => 'Gentry',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64471',
                'county_name' => 'Gentry',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64475',
                'county_name' => 'Gentry',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64479',
                'county_name' => 'Gentry',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64489',
                'county_name' => 'Gentry',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64499',
                'county_name' => 'Gentry',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64657',
                'county_name' => 'Gentry',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64670',
                'county_name' => 'Gentry',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65604',
                'county_name' => 'Greene',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65610',
                'county_name' => 'Greene',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65612',
                'county_name' => 'Greene',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65617',
                'county_name' => 'Greene',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65619',
                'county_name' => 'Greene',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65648',
                'county_name' => 'Greene',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65721',
                'county_name' => 'Greene',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65725',
                'county_name' => 'Greene',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65738',
                'county_name' => 'Greene',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65742',
                'county_name' => 'Greene',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65757',
                'county_name' => 'Greene',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65765',
                'county_name' => 'Greene',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65770',
                'county_name' => 'Greene',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65781',
                'county_name' => 'Greene',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65801',
                'county_name' => 'Greene',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65802',
                'county_name' => 'Greene',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65803',
                'county_name' => 'Greene',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65804',
                'county_name' => 'Greene',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65805',
                'county_name' => 'Greene',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65806',
                'county_name' => 'Greene',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65807',
                'county_name' => 'Greene',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65808',
                'county_name' => 'Greene',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65809',
                'county_name' => 'Greene',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65810',
                'county_name' => 'Greene',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65814',
                'county_name' => 'Greene',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65890',
                'county_name' => 'Greene',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65897',
                'county_name' => 'Greene',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65898',
                'county_name' => 'Greene',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65899',
                'county_name' => 'Greene',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64635',
                'county_name' => 'Grundy',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64641',
                'county_name' => 'Grundy',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64642',
                'county_name' => 'Grundy',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64648',
                'county_name' => 'Grundy',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64652',
                'county_name' => 'Grundy',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64679',
                'county_name' => 'Grundy',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64683',
                'county_name' => 'Grundy',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '50065',
                'county_name' => 'Harrison',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64424',
                'county_name' => 'Harrison',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64426',
                'county_name' => 'Harrison',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64442',
                'county_name' => 'Harrison',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64456',
                'county_name' => 'Harrison',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64458',
                'county_name' => 'Harrison',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64467',
                'county_name' => 'Harrison',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64471',
                'county_name' => 'Harrison',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64481',
                'county_name' => 'Harrison',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64632',
                'county_name' => 'Harrison',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64636',
                'county_name' => 'Harrison',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64642',
                'county_name' => 'Harrison',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64657',
                'county_name' => 'Harrison',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64670',
                'county_name' => 'Harrison',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64724',
                'county_name' => 'Henry',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64726',
                'county_name' => 'Henry',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64733',
                'county_name' => 'Henry',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64735',
                'county_name' => 'Henry',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64739',
                'county_name' => 'Henry',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64761',
                'county_name' => 'Henry',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64770',
                'county_name' => 'Henry',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64788',
                'county_name' => 'Henry',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65323',
                'county_name' => 'Henry',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65360',
                'county_name' => 'Henry',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64738',
                'county_name' => 'Hickory',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65326',
                'county_name' => 'Hickory',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65355',
                'county_name' => 'Hickory',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65634',
                'county_name' => 'Hickory',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65650',
                'county_name' => 'Hickory',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65668',
                'county_name' => 'Hickory',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65674',
                'county_name' => 'Hickory',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65724',
                'county_name' => 'Hickory',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65727',
                'county_name' => 'Hickory',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65732',
                'county_name' => 'Hickory',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65735',
                'county_name' => 'Hickory',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65767',
                'county_name' => 'Hickory',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65774',
                'county_name' => 'Hickory',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65779',
                'county_name' => 'Hickory',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64437',
                'county_name' => 'Holt',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64446',
                'county_name' => 'Holt',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64451',
                'county_name' => 'Holt',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64466',
                'county_name' => 'Holt',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64470',
                'county_name' => 'Holt',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64473',
                'county_name' => 'Holt',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64487',
                'county_name' => 'Holt',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65230',
                'county_name' => 'Howard',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65243',
                'county_name' => 'Howard',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65248',
                'county_name' => 'Howard',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65250',
                'county_name' => 'Howard',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65254',
                'county_name' => 'Howard',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65256',
                'county_name' => 'Howard',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65274',
                'county_name' => 'Howard',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65279',
                'county_name' => 'Howard',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65281',
                'county_name' => 'Howard',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65548',
                'county_name' => 'Howell',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65609',
                'county_name' => 'Howell',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65626',
                'county_name' => 'Howell',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65637',
                'county_name' => 'Howell',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65688',
                'county_name' => 'Howell',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65689',
                'county_name' => 'Howell',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65692',
                'county_name' => 'Howell',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65775',
                'county_name' => 'Howell',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65777',
                'county_name' => 'Howell',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65788',
                'county_name' => 'Howell',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65789',
                'county_name' => 'Howell',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65790',
                'county_name' => 'Howell',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65793',
                'county_name' => 'Howell',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63620',
                'county_name' => 'Iron',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63621',
                'county_name' => 'Iron',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63623',
                'county_name' => 'Iron',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63624',
                'county_name' => 'Iron',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63625',
                'county_name' => 'Iron',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63631',
                'county_name' => 'Iron',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63636',
                'county_name' => 'Iron',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63650',
                'county_name' => 'Iron',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63654',
                'county_name' => 'Iron',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63656',
                'county_name' => 'Iron',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63663',
                'county_name' => 'Iron',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63675',
                'county_name' => 'Iron',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65439',
                'county_name' => 'Iron',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65440',
                'county_name' => 'Iron',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65456',
                'county_name' => 'Iron',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65565',
                'county_name' => 'Iron',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65566',
                'county_name' => 'Iron',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64013',
                'county_name' => 'Jackson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64014',
                'county_name' => 'Jackson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64015',
                'county_name' => 'Jackson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64016',
                'county_name' => 'Jackson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64029',
                'county_name' => 'Jackson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64030',
                'county_name' => 'Jackson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64034',
                'county_name' => 'Jackson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64050',
                'county_name' => 'Jackson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64051',
                'county_name' => 'Jackson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64052',
                'county_name' => 'Jackson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64053',
                'county_name' => 'Jackson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64054',
                'county_name' => 'Jackson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64055',
                'county_name' => 'Jackson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64056',
                'county_name' => 'Jackson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64057',
                'county_name' => 'Jackson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64058',
                'county_name' => 'Jackson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64061',
                'county_name' => 'Jackson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64063',
                'county_name' => 'Jackson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64064',
                'county_name' => 'Jackson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64065',
                'county_name' => 'Jackson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64066',
                'county_name' => 'Jackson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64070',
                'county_name' => 'Jackson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64074',
                'county_name' => 'Jackson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64075',
                'county_name' => 'Jackson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64080',
                'county_name' => 'Jackson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64081',
                'county_name' => 'Jackson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64082',
                'county_name' => 'Jackson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64086',
                'county_name' => 'Jackson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64088',
                'county_name' => 'Jackson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64101',
                'county_name' => 'Jackson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64102',
                'county_name' => 'Jackson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64105',
                'county_name' => 'Jackson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64106',
                'county_name' => 'Jackson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64108',
                'county_name' => 'Jackson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64109',
                'county_name' => 'Jackson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64110',
                'county_name' => 'Jackson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64111',
                'county_name' => 'Jackson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64112',
                'county_name' => 'Jackson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64113',
                'county_name' => 'Jackson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64114',
                'county_name' => 'Jackson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64120',
                'county_name' => 'Jackson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64121',
                'county_name' => 'Jackson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64123',
                'county_name' => 'Jackson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64124',
                'county_name' => 'Jackson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64125',
                'county_name' => 'Jackson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64126',
                'county_name' => 'Jackson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64127',
                'county_name' => 'Jackson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64128',
                'county_name' => 'Jackson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64129',
                'county_name' => 'Jackson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64130',
                'county_name' => 'Jackson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64131',
                'county_name' => 'Jackson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64132',
                'county_name' => 'Jackson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64133',
                'county_name' => 'Jackson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64134',
                'county_name' => 'Jackson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64136',
                'county_name' => 'Jackson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64137',
                'county_name' => 'Jackson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64138',
                'county_name' => 'Jackson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64139',
                'county_name' => 'Jackson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64141',
                'county_name' => 'Jackson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64145',
                'county_name' => 'Jackson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64146',
                'county_name' => 'Jackson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64147',
                'county_name' => 'Jackson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64148',
                'county_name' => 'Jackson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64149',
                'county_name' => 'Jackson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64170',
                'county_name' => 'Jackson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64171',
                'county_name' => 'Jackson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64179',
                'county_name' => 'Jackson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64180',
                'county_name' => 'Jackson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64183',
                'county_name' => 'Jackson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64184',
                'county_name' => 'Jackson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64185',
                'county_name' => 'Jackson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64187',
                'county_name' => 'Jackson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64188',
                'county_name' => 'Jackson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64192',
                'county_name' => 'Jackson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64193',
                'county_name' => 'Jackson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64194',
                'county_name' => 'Jackson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64196',
                'county_name' => 'Jackson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64197',
                'county_name' => 'Jackson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64198',
                'county_name' => 'Jackson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64733',
                'county_name' => 'Jackson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64784',
                'county_name' => 'Jackson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64999',
                'county_name' => 'Jackson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64748',
                'county_name' => 'Jasper',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64755',
                'county_name' => 'Jasper',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64801',
                'county_name' => 'Jasper',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64802',
                'county_name' => 'Jasper',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64803',
                'county_name' => 'Jasper',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64804',
                'county_name' => 'Jasper',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64830',
                'county_name' => 'Jasper',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64832',
                'county_name' => 'Jasper',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64833',
                'county_name' => 'Jasper',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64834',
                'county_name' => 'Jasper',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64835',
                'county_name' => 'Jasper',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64836',
                'county_name' => 'Jasper',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64840',
                'county_name' => 'Jasper',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64841',
                'county_name' => 'Jasper',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64848',
                'county_name' => 'Jasper',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64849',
                'county_name' => 'Jasper',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64855',
                'county_name' => 'Jasper',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64857',
                'county_name' => 'Jasper',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64859',
                'county_name' => 'Jasper',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64862',
                'county_name' => 'Jasper',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64869',
                'county_name' => 'Jasper',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64870',
                'county_name' => 'Jasper',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64873',
                'county_name' => 'Jasper',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65756',
                'county_name' => 'Jasper',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63010',
                'county_name' => 'Jefferson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63012',
                'county_name' => 'Jefferson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63015',
                'county_name' => 'Jefferson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63016',
                'county_name' => 'Jefferson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63019',
                'county_name' => 'Jefferson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63020',
                'county_name' => 'Jefferson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63023',
                'county_name' => 'Jefferson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63025',
                'county_name' => 'Jefferson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63026',
                'county_name' => 'Jefferson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63028',
                'county_name' => 'Jefferson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63030',
                'county_name' => 'Jefferson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63041',
                'county_name' => 'Jefferson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63047',
                'county_name' => 'Jefferson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63048',
                'county_name' => 'Jefferson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63049',
                'county_name' => 'Jefferson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63050',
                'county_name' => 'Jefferson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63051',
                'county_name' => 'Jefferson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63052',
                'county_name' => 'Jefferson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63053',
                'county_name' => 'Jefferson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63057',
                'county_name' => 'Jefferson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63060',
                'county_name' => 'Jefferson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63065',
                'county_name' => 'Jefferson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63066',
                'county_name' => 'Jefferson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63069',
                'county_name' => 'Jefferson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63070',
                'county_name' => 'Jefferson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63071',
                'county_name' => 'Jefferson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63072',
                'county_name' => 'Jefferson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63087',
                'county_name' => 'Jefferson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63627',
                'county_name' => 'Jefferson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63628',
                'county_name' => 'Jefferson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64011',
                'county_name' => 'Johnson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64019',
                'county_name' => 'Johnson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64020',
                'county_name' => 'Johnson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64037',
                'county_name' => 'Johnson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64040',
                'county_name' => 'Johnson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64061',
                'county_name' => 'Johnson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64070',
                'county_name' => 'Johnson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64076',
                'county_name' => 'Johnson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64080',
                'county_name' => 'Johnson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64093',
                'county_name' => 'Johnson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64726',
                'county_name' => 'Johnson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64733',
                'county_name' => 'Johnson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64747',
                'county_name' => 'Johnson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64761',
                'county_name' => 'Johnson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65305',
                'county_name' => 'Johnson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65332',
                'county_name' => 'Johnson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65336',
                'county_name' => 'Johnson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65337',
                'county_name' => 'Johnson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65351',
                'county_name' => 'Johnson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65360',
                'county_name' => 'Johnson',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63446',
                'county_name' => 'Knox',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63447',
                'county_name' => 'Knox',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63451',
                'county_name' => 'Knox',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63458',
                'county_name' => 'Knox',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63460',
                'county_name' => 'Knox',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63464',
                'county_name' => 'Knox',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63469',
                'county_name' => 'Knox',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63530',
                'county_name' => 'Knox',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63531',
                'county_name' => 'Knox',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63533',
                'county_name' => 'Knox',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63537',
                'county_name' => 'Knox',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63543',
                'county_name' => 'Knox',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63547',
                'county_name' => 'Knox',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63549',
                'county_name' => 'Knox',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63563',
                'county_name' => 'Knox',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65020',
                'county_name' => 'Laclede',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65463',
                'county_name' => 'Laclede',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65470',
                'county_name' => 'Laclede',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65534',
                'county_name' => 'Laclede',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65536',
                'county_name' => 'Laclede',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65543',
                'county_name' => 'Laclede',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65552',
                'county_name' => 'Laclede',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65556',
                'county_name' => 'Laclede',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65567',
                'county_name' => 'Laclede',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65590',
                'county_name' => 'Laclede',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65632',
                'county_name' => 'Laclede',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65662',
                'county_name' => 'Laclede',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65713',
                'county_name' => 'Laclede',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65722',
                'county_name' => 'Laclede',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64001',
                'county_name' => 'Lafayette',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64011',
                'county_name' => 'Lafayette',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64017',
                'county_name' => 'Lafayette',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64020',
                'county_name' => 'Lafayette',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64021',
                'county_name' => 'Lafayette',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64022',
                'county_name' => 'Lafayette',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64037',
                'county_name' => 'Lafayette',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64067',
                'county_name' => 'Lafayette',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64070',
                'county_name' => 'Lafayette',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64071',
                'county_name' => 'Lafayette',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64074',
                'county_name' => 'Lafayette',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64075',
                'county_name' => 'Lafayette',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64076',
                'county_name' => 'Lafayette',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64096',
                'county_name' => 'Lafayette',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64097',
                'county_name' => 'Lafayette',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65321',
                'county_name' => 'Lafayette',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65327',
                'county_name' => 'Lafayette',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64748',
                'county_name' => 'Lawrence',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64848',
                'county_name' => 'Lawrence',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64862',
                'county_name' => 'Lawrence',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64873',
                'county_name' => 'Lawrence',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65604',
                'county_name' => 'Lawrence',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65605',
                'county_name' => 'Lawrence',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65610',
                'county_name' => 'Lawrence',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65612',
                'county_name' => 'Lawrence',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65646',
                'county_name' => 'Lawrence',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65654',
                'county_name' => 'Lawrence',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65664',
                'county_name' => 'Lawrence',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65682',
                'county_name' => 'Lawrence',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65705',
                'county_name' => 'Lawrence',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65707',
                'county_name' => 'Lawrence',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65708',
                'county_name' => 'Lawrence',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65712',
                'county_name' => 'Lawrence',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65723',
                'county_name' => 'Lawrence',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65738',
                'county_name' => 'Lawrence',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65752',
                'county_name' => 'Lawrence',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65756',
                'county_name' => 'Lawrence',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65769',
                'county_name' => 'Lawrence',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63434',
                'county_name' => 'Lewis',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63435',
                'county_name' => 'Lewis',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63438',
                'county_name' => 'Lewis',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63440',
                'county_name' => 'Lewis',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63446',
                'county_name' => 'Lewis',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63447',
                'county_name' => 'Lewis',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63448',
                'county_name' => 'Lewis',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63452',
                'county_name' => 'Lewis',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63454',
                'county_name' => 'Lewis',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63457',
                'county_name' => 'Lewis',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63471',
                'county_name' => 'Lewis',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63473',
                'county_name' => 'Lewis',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63474',
                'county_name' => 'Lewis',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63333',
                'county_name' => 'Lincoln',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63334',
                'county_name' => 'Lincoln',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63343',
                'county_name' => 'Lincoln',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63344',
                'county_name' => 'Lincoln',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63347',
                'county_name' => 'Lincoln',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63348',
                'county_name' => 'Lincoln',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63349',
                'county_name' => 'Lincoln',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63359',
                'county_name' => 'Lincoln',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63362',
                'county_name' => 'Lincoln',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63369',
                'county_name' => 'Lincoln',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63370',
                'county_name' => 'Lincoln',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63377',
                'county_name' => 'Lincoln',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63379',
                'county_name' => 'Lincoln',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63381',
                'county_name' => 'Lincoln',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63383',
                'county_name' => 'Lincoln',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63387',
                'county_name' => 'Lincoln',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63389',
                'county_name' => 'Lincoln',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63390',
                'county_name' => 'Lincoln',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63557',
                'county_name' => 'Linn',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63566',
                'county_name' => 'Linn',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64628',
                'county_name' => 'Linn',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64631',
                'county_name' => 'Linn',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64635',
                'county_name' => 'Linn',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64646',
                'county_name' => 'Linn',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64651',
                'county_name' => 'Linn',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64652',
                'county_name' => 'Linn',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64653',
                'county_name' => 'Linn',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64658',
                'county_name' => 'Linn',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64659',
                'county_name' => 'Linn',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64674',
                'county_name' => 'Linn',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64681',
                'county_name' => 'Linn',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64688',
                'county_name' => 'Linn',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64601',
                'county_name' => 'Livingston',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64624',
                'county_name' => 'Livingston',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64625',
                'county_name' => 'Livingston',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64635',
                'county_name' => 'Livingston',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64638',
                'county_name' => 'Livingston',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64643',
                'county_name' => 'Livingston',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64648',
                'county_name' => 'Livingston',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64656',
                'county_name' => 'Livingston',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64664',
                'county_name' => 'Livingston',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64683',
                'county_name' => 'Livingston',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64686',
                'county_name' => 'Livingston',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64688',
                'county_name' => 'Livingston',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64831',
                'county_name' => 'McDonald',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64843',
                'county_name' => 'McDonald',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64847',
                'county_name' => 'McDonald',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64850',
                'county_name' => 'McDonald',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64854',
                'county_name' => 'McDonald',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64856',
                'county_name' => 'McDonald',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64861',
                'county_name' => 'McDonald',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64863',
                'county_name' => 'McDonald',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64865',
                'county_name' => 'McDonald',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64867',
                'county_name' => 'McDonald',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64868',
                'county_name' => 'McDonald',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65647',
                'county_name' => 'McDonald',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65730',
                'county_name' => 'McDonald',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65745',
                'county_name' => 'McDonald',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65772',
                'county_name' => 'McDonald',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63431',
                'county_name' => 'Macon',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63437',
                'county_name' => 'Macon',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63451',
                'county_name' => 'Macon',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63530',
                'county_name' => 'Macon',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63532',
                'county_name' => 'Macon',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63534',
                'county_name' => 'Macon',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63538',
                'county_name' => 'Macon',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63539',
                'county_name' => 'Macon',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63549',
                'county_name' => 'Macon',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63552',
                'county_name' => 'Macon',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63557',
                'county_name' => 'Macon',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63558',
                'county_name' => 'Macon',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64631',
                'county_name' => 'Macon',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64658',
                'county_name' => 'Macon',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65247',
                'county_name' => 'Macon',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65260',
                'county_name' => 'Macon',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63620',
                'county_name' => 'Madison',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63621',
                'county_name' => 'Madison',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63636',
                'county_name' => 'Madison',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63640',
                'county_name' => 'Madison',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63645',
                'county_name' => 'Madison',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63650',
                'county_name' => 'Madison',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63655',
                'county_name' => 'Madison',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63964',
                'county_name' => 'Madison',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65001',
                'county_name' => 'Maries',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65013',
                'county_name' => 'Maries',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65014',
                'county_name' => 'Maries',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65058',
                'county_name' => 'Maries',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65401',
                'county_name' => 'Maries',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65443',
                'county_name' => 'Maries',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65459',
                'county_name' => 'Maries',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65559',
                'county_name' => 'Maries',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65580',
                'county_name' => 'Maries',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65582',
                'county_name' => 'Maries',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63401',
                'county_name' => 'Marion',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63438',
                'county_name' => 'Marion',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63440',
                'county_name' => 'Marion',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63443',
                'county_name' => 'Marion',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63454',
                'county_name' => 'Marion',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63461',
                'county_name' => 'Marion',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63463',
                'county_name' => 'Marion',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63464',
                'county_name' => 'Marion',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63471',
                'county_name' => 'Marion',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '50147',
                'county_name' => 'Mercer',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64632',
                'county_name' => 'Mercer',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64645',
                'county_name' => 'Mercer',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64661',
                'county_name' => 'Mercer',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64667',
                'county_name' => 'Mercer',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64672',
                'county_name' => 'Mercer',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64673',
                'county_name' => 'Mercer',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64679',
                'county_name' => 'Mercer',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65017',
                'county_name' => 'Miller',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65026',
                'county_name' => 'Miller',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65032',
                'county_name' => 'Miller',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65040',
                'county_name' => 'Miller',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65047',
                'county_name' => 'Miller',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65049',
                'county_name' => 'Miller',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65058',
                'county_name' => 'Miller',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65064',
                'county_name' => 'Miller',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65065',
                'county_name' => 'Miller',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65072',
                'county_name' => 'Miller',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65074',
                'county_name' => 'Miller',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65075',
                'county_name' => 'Miller',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65082',
                'county_name' => 'Miller',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65083',
                'county_name' => 'Miller',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65452',
                'county_name' => 'Miller',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65459',
                'county_name' => 'Miller',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65486',
                'county_name' => 'Miller',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63801',
                'county_name' => 'Mississippi',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63820',
                'county_name' => 'Mississippi',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63823',
                'county_name' => 'Mississippi',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63834',
                'county_name' => 'Mississippi',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63845',
                'county_name' => 'Mississippi',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63881',
                'county_name' => 'Mississippi',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63882',
                'county_name' => 'Mississippi',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65011',
                'county_name' => 'Moniteau',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65018',
                'county_name' => 'Moniteau',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65023',
                'county_name' => 'Moniteau',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65025',
                'county_name' => 'Moniteau',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65026',
                'county_name' => 'Moniteau',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65034',
                'county_name' => 'Moniteau',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65042',
                'county_name' => 'Moniteau',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65046',
                'county_name' => 'Moniteau',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65050',
                'county_name' => 'Moniteau',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65053',
                'county_name' => 'Moniteau',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65055',
                'county_name' => 'Moniteau',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65064',
                'county_name' => 'Moniteau',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65074',
                'county_name' => 'Moniteau',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65081',
                'county_name' => 'Moniteau',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65084',
                'county_name' => 'Moniteau',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65287',
                'county_name' => 'Moniteau',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63437',
                'county_name' => 'Monroe',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63443',
                'county_name' => 'Monroe',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63450',
                'county_name' => 'Monroe',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63456',
                'county_name' => 'Monroe',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63462',
                'county_name' => 'Monroe',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63468',
                'county_name' => 'Monroe',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65240',
                'county_name' => 'Monroe',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65243',
                'county_name' => 'Monroe',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65258',
                'county_name' => 'Monroe',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65260',
                'county_name' => 'Monroe',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65263',
                'county_name' => 'Monroe',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65265',
                'county_name' => 'Monroe',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65275',
                'county_name' => 'Monroe',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65282',
                'county_name' => 'Monroe',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65283',
                'county_name' => 'Monroe',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65285',
                'county_name' => 'Monroe',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63333',
                'county_name' => 'Montgomery',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63350',
                'county_name' => 'Montgomery',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63351',
                'county_name' => 'Montgomery',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63359',
                'county_name' => 'Montgomery',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63361',
                'county_name' => 'Montgomery',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63363',
                'county_name' => 'Montgomery',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63381',
                'county_name' => 'Montgomery',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63384',
                'county_name' => 'Montgomery',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65041',
                'county_name' => 'Montgomery',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65069',
                'county_name' => 'Montgomery',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65264',
                'county_name' => 'Montgomery',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65011',
                'county_name' => 'Morgan',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65026',
                'county_name' => 'Morgan',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65034',
                'county_name' => 'Morgan',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65037',
                'county_name' => 'Morgan',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65038',
                'county_name' => 'Morgan',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65049',
                'county_name' => 'Morgan',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65072',
                'county_name' => 'Morgan',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65078',
                'county_name' => 'Morgan',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65079',
                'county_name' => 'Morgan',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65081',
                'county_name' => 'Morgan',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65084',
                'county_name' => 'Morgan',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65325',
                'county_name' => 'Morgan',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65329',
                'county_name' => 'Morgan',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65345',
                'county_name' => 'Morgan',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65348',
                'county_name' => 'Morgan',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65350',
                'county_name' => 'Morgan',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65354',
                'county_name' => 'Morgan',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63801',
                'county_name' => 'New Madrid',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63822',
                'county_name' => 'New Madrid',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63828',
                'county_name' => 'New Madrid',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63833',
                'county_name' => 'New Madrid',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63837',
                'county_name' => 'New Madrid',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63845',
                'county_name' => 'New Madrid',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63848',
                'county_name' => 'New Madrid',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63851',
                'county_name' => 'New Madrid',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63860',
                'county_name' => 'New Madrid',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63862',
                'county_name' => 'New Madrid',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63863',
                'county_name' => 'New Madrid',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63866',
                'county_name' => 'New Madrid',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63867',
                'county_name' => 'New Madrid',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63868',
                'county_name' => 'New Madrid',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63869',
                'county_name' => 'New Madrid',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63870',
                'county_name' => 'New Madrid',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63873',
                'county_name' => 'New Madrid',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63874',
                'county_name' => 'New Madrid',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63878',
                'county_name' => 'New Madrid',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63879',
                'county_name' => 'New Madrid',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64801',
                'county_name' => 'Newton',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64804',
                'county_name' => 'Newton',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64836',
                'county_name' => 'Newton',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64840',
                'county_name' => 'Newton',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64842',
                'county_name' => 'Newton',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64843',
                'county_name' => 'Newton',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64844',
                'county_name' => 'Newton',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64850',
                'county_name' => 'Newton',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64853',
                'county_name' => 'Newton',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64858',
                'county_name' => 'Newton',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64861',
                'county_name' => 'Newton',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64862',
                'county_name' => 'Newton',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64864',
                'county_name' => 'Newton',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64865',
                'county_name' => 'Newton',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64866',
                'county_name' => 'Newton',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64867',
                'county_name' => 'Newton',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64873',
                'county_name' => 'Newton',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65647',
                'county_name' => 'Newton',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65723',
                'county_name' => 'Newton',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65734',
                'county_name' => 'Newton',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '51630',
                'county_name' => 'Nodaway',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64423',
                'county_name' => 'Nodaway',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64427',
                'county_name' => 'Nodaway',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64428',
                'county_name' => 'Nodaway',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64431',
                'county_name' => 'Nodaway',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64432',
                'county_name' => 'Nodaway',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64433',
                'county_name' => 'Nodaway',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64434',
                'county_name' => 'Nodaway',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64445',
                'county_name' => 'Nodaway',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64455',
                'county_name' => 'Nodaway',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64457',
                'county_name' => 'Nodaway',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64461',
                'county_name' => 'Nodaway',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64468',
                'county_name' => 'Nodaway',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64475',
                'county_name' => 'Nodaway',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64476',
                'county_name' => 'Nodaway',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64479',
                'county_name' => 'Nodaway',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64486',
                'county_name' => 'Nodaway',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64487',
                'county_name' => 'Nodaway',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64489',
                'county_name' => 'Nodaway',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63935',
                'county_name' => 'Oregon',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63941',
                'county_name' => 'Oregon',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65438',
                'county_name' => 'Oregon',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65588',
                'county_name' => 'Oregon',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65606',
                'county_name' => 'Oregon',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65690',
                'county_name' => 'Oregon',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65692',
                'county_name' => 'Oregon',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65775',
                'county_name' => 'Oregon',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65778',
                'county_name' => 'Oregon',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65788',
                'county_name' => 'Oregon',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65791',
                'county_name' => 'Oregon',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65001',
                'county_name' => 'Osage',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65013',
                'county_name' => 'Osage',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65014',
                'county_name' => 'Osage',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65016',
                'county_name' => 'Osage',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65024',
                'county_name' => 'Osage',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65035',
                'county_name' => 'Osage',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65041',
                'county_name' => 'Osage',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65048',
                'county_name' => 'Osage',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65051',
                'county_name' => 'Osage',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65054',
                'county_name' => 'Osage',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65058',
                'county_name' => 'Osage',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65061',
                'county_name' => 'Osage',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65062',
                'county_name' => 'Osage',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65076',
                'county_name' => 'Osage',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65085',
                'county_name' => 'Osage',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65101',
                'county_name' => 'Osage',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65062',
                'county_name' => 'Ozark',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65608',
                'county_name' => 'Ozark',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65609',
                'county_name' => 'Ozark',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65618',
                'county_name' => 'Ozark',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65626',
                'county_name' => 'Ozark',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65637',
                'county_name' => 'Ozark',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65638',
                'county_name' => 'Ozark',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65655',
                'county_name' => 'Ozark',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65666',
                'county_name' => 'Ozark',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65676',
                'county_name' => 'Ozark',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65715',
                'county_name' => 'Ozark',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65729',
                'county_name' => 'Ozark',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65733',
                'county_name' => 'Ozark',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65741',
                'county_name' => 'Ozark',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65755',
                'county_name' => 'Ozark',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65760',
                'county_name' => 'Ozark',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65761',
                'county_name' => 'Ozark',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65762',
                'county_name' => 'Ozark',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65766',
                'county_name' => 'Ozark',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65773',
                'county_name' => 'Ozark',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65784',
                'county_name' => 'Ozark',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65790',
                'county_name' => 'Ozark',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63826',
                'county_name' => 'Pemiscot',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63827',
                'county_name' => 'Pemiscot',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63830',
                'county_name' => 'Pemiscot',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63839',
                'county_name' => 'Pemiscot',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63840',
                'county_name' => 'Pemiscot',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63848',
                'county_name' => 'Pemiscot',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63849',
                'county_name' => 'Pemiscot',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63851',
                'county_name' => 'Pemiscot',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63852',
                'county_name' => 'Pemiscot',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63853',
                'county_name' => 'Pemiscot',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63857',
                'county_name' => 'Pemiscot',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63873',
                'county_name' => 'Pemiscot',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63877',
                'county_name' => 'Pemiscot',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63879',
                'county_name' => 'Pemiscot',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63673',
                'county_name' => 'Perry',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63732',
                'county_name' => 'Perry',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63737',
                'county_name' => 'Perry',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63746',
                'county_name' => 'Perry',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63748',
                'county_name' => 'Perry',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63770',
                'county_name' => 'Perry',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63775',
                'county_name' => 'Perry',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63776',
                'county_name' => 'Perry',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63781',
                'county_name' => 'Perry',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63783',
                'county_name' => 'Perry',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65078',
                'county_name' => 'Pettis',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65301',
                'county_name' => 'Pettis',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65302',
                'county_name' => 'Pettis',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65325',
                'county_name' => 'Pettis',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65332',
                'county_name' => 'Pettis',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65334',
                'county_name' => 'Pettis',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65335',
                'county_name' => 'Pettis',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65336',
                'county_name' => 'Pettis',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65337',
                'county_name' => 'Pettis',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65340',
                'county_name' => 'Pettis',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65345',
                'county_name' => 'Pettis',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65347',
                'county_name' => 'Pettis',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65348',
                'county_name' => 'Pettis',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65350',
                'county_name' => 'Pettis',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65351',
                'county_name' => 'Pettis',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65360',
                'county_name' => 'Pettis',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65401',
                'county_name' => 'Phelps',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65402',
                'county_name' => 'Phelps',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65409',
                'county_name' => 'Phelps',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65436',
                'county_name' => 'Phelps',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65449',
                'county_name' => 'Phelps',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65453',
                'county_name' => 'Phelps',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65457',
                'county_name' => 'Phelps',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65459',
                'county_name' => 'Phelps',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65461',
                'county_name' => 'Phelps',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65462',
                'county_name' => 'Phelps',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65529',
                'county_name' => 'Phelps',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65541',
                'county_name' => 'Phelps',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65542',
                'county_name' => 'Phelps',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65550',
                'county_name' => 'Phelps',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65559',
                'county_name' => 'Phelps',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65560',
                'county_name' => 'Phelps',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63330',
                'county_name' => 'Pike',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63334',
                'county_name' => 'Pike',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63336',
                'county_name' => 'Pike',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63339',
                'county_name' => 'Pike',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63343',
                'county_name' => 'Pike',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63344',
                'county_name' => 'Pike',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63353',
                'county_name' => 'Pike',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63359',
                'county_name' => 'Pike',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63382',
                'county_name' => 'Pike',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63433',
                'county_name' => 'Pike',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63441',
                'county_name' => 'Pike',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63459',
                'county_name' => 'Pike',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64018',
                'county_name' => 'Platte',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64028',
                'county_name' => 'Platte',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64079',
                'county_name' => 'Platte',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64089',
                'county_name' => 'Platte',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64092',
                'county_name' => 'Platte',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64098',
                'county_name' => 'Platte',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64118',
                'county_name' => 'Platte',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64150',
                'county_name' => 'Platte',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64151',
                'county_name' => 'Platte',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64152',
                'county_name' => 'Platte',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64153',
                'county_name' => 'Platte',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64154',
                'county_name' => 'Platte',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64155',
                'county_name' => 'Platte',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64163',
                'county_name' => 'Platte',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64164',
                'county_name' => 'Platte',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64168',
                'county_name' => 'Platte',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64190',
                'county_name' => 'Platte',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64195',
                'county_name' => 'Platte',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64439',
                'county_name' => 'Platte',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64440',
                'county_name' => 'Platte',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64444',
                'county_name' => 'Platte',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64484',
                'county_name' => 'Platte',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65601',
                'county_name' => 'Polk',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65613',
                'county_name' => 'Polk',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65617',
                'county_name' => 'Polk',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65622',
                'county_name' => 'Polk',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65640',
                'county_name' => 'Polk',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65645',
                'county_name' => 'Polk',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65648',
                'county_name' => 'Polk',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65649',
                'county_name' => 'Polk',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65650',
                'county_name' => 'Polk',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65663',
                'county_name' => 'Polk',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65674',
                'county_name' => 'Polk',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65685',
                'county_name' => 'Polk',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65710',
                'county_name' => 'Polk',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65724',
                'county_name' => 'Polk',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65725',
                'county_name' => 'Polk',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65727',
                'county_name' => 'Polk',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65767',
                'county_name' => 'Polk',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65770',
                'county_name' => 'Polk',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65781',
                'county_name' => 'Polk',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65436',
                'county_name' => 'Pulaski',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65452',
                'county_name' => 'Pulaski',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65457',
                'county_name' => 'Pulaski',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65459',
                'county_name' => 'Pulaski',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65461',
                'county_name' => 'Pulaski',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65473',
                'county_name' => 'Pulaski',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65534',
                'county_name' => 'Pulaski',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65550',
                'county_name' => 'Pulaski',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65552',
                'county_name' => 'Pulaski',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65556',
                'county_name' => 'Pulaski',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65583',
                'county_name' => 'Pulaski',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65584',
                'county_name' => 'Pulaski',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63535',
                'county_name' => 'Putnam',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63544',
                'county_name' => 'Putnam',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63551',
                'county_name' => 'Putnam',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63559',
                'county_name' => 'Putnam',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63565',
                'county_name' => 'Putnam',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63567',
                'county_name' => 'Putnam',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64655',
                'county_name' => 'Putnam',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64667',
                'county_name' => 'Putnam',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64672',
                'county_name' => 'Putnam',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63352',
                'county_name' => 'Ralls',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63382',
                'county_name' => 'Ralls',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63401',
                'county_name' => 'Ralls',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63436',
                'county_name' => 'Ralls',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63441',
                'county_name' => 'Ralls',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63456',
                'county_name' => 'Ralls',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63459',
                'county_name' => 'Ralls',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63462',
                'county_name' => 'Ralls',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63467',
                'county_name' => 'Ralls',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63534',
                'county_name' => 'Randolph',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65230',
                'county_name' => 'Randolph',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65239',
                'county_name' => 'Randolph',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65243',
                'county_name' => 'Randolph',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65244',
                'county_name' => 'Randolph',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65247',
                'county_name' => 'Randolph',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65257',
                'county_name' => 'Randolph',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65259',
                'county_name' => 'Randolph',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65260',
                'county_name' => 'Randolph',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65263',
                'county_name' => 'Randolph',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65270',
                'county_name' => 'Randolph',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65278',
                'county_name' => 'Randolph',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65281',
                'county_name' => 'Randolph',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64017',
                'county_name' => 'Ray',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64024',
                'county_name' => 'Ray',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64035',
                'county_name' => 'Ray',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64036',
                'county_name' => 'Ray',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64062',
                'county_name' => 'Ray',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64077',
                'county_name' => 'Ray',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64084',
                'county_name' => 'Ray',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64085',
                'county_name' => 'Ray',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64624',
                'county_name' => 'Ray',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64637',
                'county_name' => 'Ray',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64668',
                'county_name' => 'Ray',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64671',
                'county_name' => 'Ray',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63620',
                'county_name' => 'Reynolds',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63623',
                'county_name' => 'Reynolds',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63625',
                'county_name' => 'Reynolds',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63629',
                'county_name' => 'Reynolds',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63633',
                'county_name' => 'Reynolds',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63638',
                'county_name' => 'Reynolds',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63654',
                'county_name' => 'Reynolds',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63656',
                'county_name' => 'Reynolds',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63665',
                'county_name' => 'Reynolds',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63666',
                'county_name' => 'Reynolds',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63965',
                'county_name' => 'Reynolds',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65440',
                'county_name' => 'Reynolds',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63901',
                'county_name' => 'Ripley',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63931',
                'county_name' => 'Ripley',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63935',
                'county_name' => 'Ripley',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63939',
                'county_name' => 'Ripley',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63941',
                'county_name' => 'Ripley',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63942',
                'county_name' => 'Ripley',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63943',
                'county_name' => 'Ripley',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63945',
                'county_name' => 'Ripley',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63953',
                'county_name' => 'Ripley',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63954',
                'county_name' => 'Ripley',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63955',
                'county_name' => 'Ripley',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '72444',
                'county_name' => 'Ripley',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63301',
                'county_name' => 'St. Charles',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63302',
                'county_name' => 'St. Charles',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63303',
                'county_name' => 'St. Charles',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63304',
                'county_name' => 'St. Charles',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63332',
                'county_name' => 'St. Charles',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63338',
                'county_name' => 'St. Charles',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63341',
                'county_name' => 'St. Charles',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63346',
                'county_name' => 'St. Charles',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63348',
                'county_name' => 'St. Charles',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63357',
                'county_name' => 'St. Charles',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63365',
                'county_name' => 'St. Charles',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63366',
                'county_name' => 'St. Charles',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63367',
                'county_name' => 'St. Charles',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63368',
                'county_name' => 'St. Charles',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63373',
                'county_name' => 'St. Charles',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63376',
                'county_name' => 'St. Charles',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63385',
                'county_name' => 'St. Charles',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63386',
                'county_name' => 'St. Charles',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64724',
                'county_name' => 'St. Clair',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64738',
                'county_name' => 'St. Clair',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64740',
                'county_name' => 'St. Clair',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64744',
                'county_name' => 'St. Clair',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64763',
                'county_name' => 'St. Clair',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64770',
                'county_name' => 'St. Clair',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64776',
                'county_name' => 'St. Clair',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64780',
                'county_name' => 'St. Clair',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64781',
                'county_name' => 'St. Clair',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64783',
                'county_name' => 'St. Clair',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65674',
                'county_name' => 'St. Clair',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65735',
                'county_name' => 'St. Clair',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65774',
                'county_name' => 'St. Clair',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65785',
                'county_name' => 'St. Clair',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63028',
                'county_name' => 'Ste. Genevieve',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63036',
                'county_name' => 'Ste. Genevieve',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63627',
                'county_name' => 'Ste. Genevieve',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63628',
                'county_name' => 'Ste. Genevieve',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63640',
                'county_name' => 'Ste. Genevieve',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63645',
                'county_name' => 'Ste. Genevieve',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63670',
                'county_name' => 'Ste. Genevieve',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63673',
                'county_name' => 'Ste. Genevieve',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63020',
                'county_name' => 'St. Francois',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63028',
                'county_name' => 'St. Francois',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63036',
                'county_name' => 'St. Francois',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63087',
                'county_name' => 'St. Francois',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63601',
                'county_name' => 'St. Francois',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63624',
                'county_name' => 'St. Francois',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63626',
                'county_name' => 'St. Francois',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63628',
                'county_name' => 'St. Francois',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63637',
                'county_name' => 'St. Francois',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63640',
                'county_name' => 'St. Francois',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63645',
                'county_name' => 'St. Francois',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63650',
                'county_name' => 'St. Francois',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63651',
                'county_name' => 'St. Francois',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63653',
                'county_name' => 'St. Francois',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63001',
                'county_name' => 'St. Louis',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63005',
                'county_name' => 'St. Louis',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63006',
                'county_name' => 'St. Louis',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63011',
                'county_name' => 'St. Louis',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63017',
                'county_name' => 'St. Louis',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63021',
                'county_name' => 'St. Louis',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63022',
                'county_name' => 'St. Louis',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63024',
                'county_name' => 'St. Louis',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63025',
                'county_name' => 'St. Louis',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63026',
                'county_name' => 'St. Louis',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63031',
                'county_name' => 'St. Louis',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63032',
                'county_name' => 'St. Louis',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63033',
                'county_name' => 'St. Louis',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63034',
                'county_name' => 'St. Louis',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63038',
                'county_name' => 'St. Louis',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63040',
                'county_name' => 'St. Louis',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63042',
                'county_name' => 'St. Louis',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63043',
                'county_name' => 'St. Louis',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63044',
                'county_name' => 'St. Louis',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63045',
                'county_name' => 'St. Louis',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63049',
                'county_name' => 'St. Louis',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63069',
                'county_name' => 'St. Louis',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63074',
                'county_name' => 'St. Louis',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63088',
                'county_name' => 'St. Louis',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63099',
                'county_name' => 'St. Louis',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63105',
                'county_name' => 'St. Louis',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63114',
                'county_name' => 'St. Louis',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63117',
                'county_name' => 'St. Louis',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63119',
                'county_name' => 'St. Louis',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63120',
                'county_name' => 'St. Louis',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63121',
                'county_name' => 'St. Louis',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63122',
                'county_name' => 'St. Louis',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63123',
                'county_name' => 'St. Louis',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63124',
                'county_name' => 'St. Louis',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63125',
                'county_name' => 'St. Louis',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63126',
                'county_name' => 'St. Louis',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63127',
                'county_name' => 'St. Louis',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63128',
                'county_name' => 'St. Louis',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63129',
                'county_name' => 'St. Louis',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63130',
                'county_name' => 'St. Louis',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63131',
                'county_name' => 'St. Louis',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63132',
                'county_name' => 'St. Louis',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63133',
                'county_name' => 'St. Louis',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63134',
                'county_name' => 'St. Louis',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63135',
                'county_name' => 'St. Louis',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63136',
                'county_name' => 'St. Louis',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63137',
                'county_name' => 'St. Louis',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63138',
                'county_name' => 'St. Louis',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63140',
                'county_name' => 'St. Louis',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63141',
                'county_name' => 'St. Louis',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63143',
                'county_name' => 'St. Louis',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63144',
                'county_name' => 'St. Louis',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63145',
                'county_name' => 'St. Louis',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63146',
                'county_name' => 'St. Louis',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63151',
                'county_name' => 'St. Louis',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63167',
                'county_name' => 'St. Louis',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63198',
                'county_name' => 'St. Louis',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64020',
                'county_name' => 'Saline',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64096',
                'county_name' => 'Saline',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65320',
                'county_name' => 'Saline',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65321',
                'county_name' => 'Saline',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65322',
                'county_name' => 'Saline',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65330',
                'county_name' => 'Saline',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65333',
                'county_name' => 'Saline',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65339',
                'county_name' => 'Saline',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65340',
                'county_name' => 'Saline',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65344',
                'county_name' => 'Saline',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65347',
                'county_name' => 'Saline',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65349',
                'county_name' => 'Saline',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65351',
                'county_name' => 'Saline',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '52537',
                'county_name' => 'Schuyler',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63501',
                'county_name' => 'Schuyler',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63535',
                'county_name' => 'Schuyler',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63541',
                'county_name' => 'Schuyler',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63546',
                'county_name' => 'Schuyler',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63548',
                'county_name' => 'Schuyler',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63561',
                'county_name' => 'Schuyler',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '52537',
                'county_name' => 'Scotland',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '52542',
                'county_name' => 'Scotland',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '52573',
                'county_name' => 'Scotland',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63432',
                'county_name' => 'Scotland',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63442',
                'county_name' => 'Scotland',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63474',
                'county_name' => 'Scotland',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63531',
                'county_name' => 'Scotland',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63536',
                'county_name' => 'Scotland',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63543',
                'county_name' => 'Scotland',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63546',
                'county_name' => 'Scotland',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63555',
                'county_name' => 'Scotland',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63563',
                'county_name' => 'Scotland',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63735',
                'county_name' => 'Scott',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63736',
                'county_name' => 'Scott',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63740',
                'county_name' => 'Scott',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63742',
                'county_name' => 'Scott',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63758',
                'county_name' => 'Scott',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63767',
                'county_name' => 'Scott',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63771',
                'county_name' => 'Scott',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63774',
                'county_name' => 'Scott',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63780',
                'county_name' => 'Scott',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63784',
                'county_name' => 'Scott',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63801',
                'county_name' => 'Scott',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63823',
                'county_name' => 'Scott',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63824',
                'county_name' => 'Scott',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63834',
                'county_name' => 'Scott',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63629',
                'county_name' => 'Shannon',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63638',
                'county_name' => 'Shannon',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65438',
                'county_name' => 'Shannon',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65466',
                'county_name' => 'Shannon',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65479',
                'county_name' => 'Shannon',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65546',
                'county_name' => 'Shannon',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65548',
                'county_name' => 'Shannon',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65560',
                'county_name' => 'Shannon',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65571',
                'county_name' => 'Shannon',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65588',
                'county_name' => 'Shannon',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63434',
                'county_name' => 'Shelby',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63437',
                'county_name' => 'Shelby',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63439',
                'county_name' => 'Shelby',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63440',
                'county_name' => 'Shelby',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63443',
                'county_name' => 'Shelby',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63450',
                'county_name' => 'Shelby',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63451',
                'county_name' => 'Shelby',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63463',
                'county_name' => 'Shelby',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63468',
                'county_name' => 'Shelby',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63469',
                'county_name' => 'Shelby',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63730',
                'county_name' => 'Stoddard',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63735',
                'county_name' => 'Stoddard',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63738',
                'county_name' => 'Stoddard',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63771',
                'county_name' => 'Stoddard',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63801',
                'county_name' => 'Stoddard',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63822',
                'county_name' => 'Stoddard',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63825',
                'county_name' => 'Stoddard',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63833',
                'county_name' => 'Stoddard',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63841',
                'county_name' => 'Stoddard',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63846',
                'county_name' => 'Stoddard',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63850',
                'county_name' => 'Stoddard',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63863',
                'county_name' => 'Stoddard',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63870',
                'county_name' => 'Stoddard',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63936',
                'county_name' => 'Stoddard',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63960',
                'county_name' => 'Stoddard',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65605',
                'county_name' => 'Stone',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65610',
                'county_name' => 'Stone',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65616',
                'county_name' => 'Stone',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65624',
                'county_name' => 'Stone',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65631',
                'county_name' => 'Stone',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65633',
                'county_name' => 'Stone',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65656',
                'county_name' => 'Stone',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65669',
                'county_name' => 'Stone',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65675',
                'county_name' => 'Stone',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65681',
                'county_name' => 'Stone',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65686',
                'county_name' => 'Stone',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65705',
                'county_name' => 'Stone',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65714',
                'county_name' => 'Stone',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65728',
                'county_name' => 'Stone',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65737',
                'county_name' => 'Stone',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65739',
                'county_name' => 'Stone',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65747',
                'county_name' => 'Stone',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65754',
                'county_name' => 'Stone',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63544',
                'county_name' => 'Sullivan',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63545',
                'county_name' => 'Sullivan',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63556',
                'county_name' => 'Sullivan',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63557',
                'county_name' => 'Sullivan',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63560',
                'county_name' => 'Sullivan',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63565',
                'county_name' => 'Sullivan',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63566',
                'county_name' => 'Sullivan',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64601',
                'county_name' => 'Sullivan',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64630',
                'county_name' => 'Sullivan',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64641',
                'county_name' => 'Sullivan',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64645',
                'county_name' => 'Sullivan',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64646',
                'county_name' => 'Sullivan',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64652',
                'county_name' => 'Sullivan',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64655',
                'county_name' => 'Sullivan',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64667',
                'county_name' => 'Sullivan',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65608',
                'county_name' => 'Taney',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65611',
                'county_name' => 'Taney',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65614',
                'county_name' => 'Taney',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65615',
                'county_name' => 'Taney',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65616',
                'county_name' => 'Taney',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65627',
                'county_name' => 'Taney',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65629',
                'county_name' => 'Taney',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65653',
                'county_name' => 'Taney',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65657',
                'county_name' => 'Taney',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65672',
                'county_name' => 'Taney',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65673',
                'county_name' => 'Taney',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65679',
                'county_name' => 'Taney',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65680',
                'county_name' => 'Taney',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65701',
                'county_name' => 'Taney',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65726',
                'county_name' => 'Taney',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65731',
                'county_name' => 'Taney',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65733',
                'county_name' => 'Taney',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65737',
                'county_name' => 'Taney',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65739',
                'county_name' => 'Taney',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65740',
                'county_name' => 'Taney',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65744',
                'county_name' => 'Taney',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65759',
                'county_name' => 'Taney',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65761',
                'county_name' => 'Taney',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65771',
                'county_name' => 'Taney',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '72644',
                'county_name' => 'Taney',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65436',
                'county_name' => 'Texas',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65444',
                'county_name' => 'Texas',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65462',
                'county_name' => 'Texas',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65464',
                'county_name' => 'Texas',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65468',
                'county_name' => 'Texas',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65470',
                'county_name' => 'Texas',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65479',
                'county_name' => 'Texas',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65483',
                'county_name' => 'Texas',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65484',
                'county_name' => 'Texas',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65542',
                'county_name' => 'Texas',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65543',
                'county_name' => 'Texas',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65548',
                'county_name' => 'Texas',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65552',
                'county_name' => 'Texas',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65555',
                'county_name' => 'Texas',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65557',
                'county_name' => 'Texas',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65560',
                'county_name' => 'Texas',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65564',
                'county_name' => 'Texas',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65570',
                'county_name' => 'Texas',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65571',
                'county_name' => 'Texas',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65589',
                'county_name' => 'Texas',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65660',
                'county_name' => 'Texas',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65689',
                'county_name' => 'Texas',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65711',
                'county_name' => 'Texas',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65793',
                'county_name' => 'Texas',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64728',
                'county_name' => 'Vernon',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64741',
                'county_name' => 'Vernon',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64744',
                'county_name' => 'Vernon',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64750',
                'county_name' => 'Vernon',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64752',
                'county_name' => 'Vernon',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64762',
                'county_name' => 'Vernon',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64765',
                'county_name' => 'Vernon',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64767',
                'county_name' => 'Vernon',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64771',
                'county_name' => 'Vernon',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64772',
                'county_name' => 'Vernon',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64778',
                'county_name' => 'Vernon',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64779',
                'county_name' => 'Vernon',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64783',
                'county_name' => 'Vernon',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64784',
                'county_name' => 'Vernon',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64790',
                'county_name' => 'Vernon',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63342',
                'county_name' => 'Warren',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63348',
                'county_name' => 'Warren',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63349',
                'county_name' => 'Warren',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63351',
                'county_name' => 'Warren',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63357',
                'county_name' => 'Warren',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63363',
                'county_name' => 'Warren',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63378',
                'county_name' => 'Warren',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63381',
                'county_name' => 'Warren',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63383',
                'county_name' => 'Warren',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63390',
                'county_name' => 'Warren',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65041',
                'county_name' => 'Warren',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63020',
                'county_name' => 'Washington',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63023',
                'county_name' => 'Washington',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63030',
                'county_name' => 'Washington',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63060',
                'county_name' => 'Washington',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63071',
                'county_name' => 'Washington',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63080',
                'county_name' => 'Washington',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63622',
                'county_name' => 'Washington',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63624',
                'county_name' => 'Washington',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63626',
                'county_name' => 'Washington',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63628',
                'county_name' => 'Washington',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63630',
                'county_name' => 'Washington',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63631',
                'county_name' => 'Washington',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63648',
                'county_name' => 'Washington',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63660',
                'county_name' => 'Washington',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63664',
                'county_name' => 'Washington',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63674',
                'county_name' => 'Washington',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65441',
                'county_name' => 'Washington',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65565',
                'county_name' => 'Washington',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63636',
                'county_name' => 'Wayne',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63655',
                'county_name' => 'Wayne',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63763',
                'county_name' => 'Wayne',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63787',
                'county_name' => 'Wayne',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63934',
                'county_name' => 'Wayne',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63937',
                'county_name' => 'Wayne',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63944',
                'county_name' => 'Wayne',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63950',
                'county_name' => 'Wayne',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63951',
                'county_name' => 'Wayne',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63952',
                'county_name' => 'Wayne',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63956',
                'county_name' => 'Wayne',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63957',
                'county_name' => 'Wayne',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63960',
                'county_name' => 'Wayne',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63964',
                'county_name' => 'Wayne',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63966',
                'county_name' => 'Wayne',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63967',
                'county_name' => 'Wayne',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65632',
                'county_name' => 'Webster',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65636',
                'county_name' => 'Webster',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65644',
                'county_name' => 'Webster',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65648',
                'county_name' => 'Webster',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65652',
                'county_name' => 'Webster',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65662',
                'county_name' => 'Webster',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65706',
                'county_name' => 'Webster',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65713',
                'county_name' => 'Webster',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65742',
                'county_name' => 'Webster',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65746',
                'county_name' => 'Webster',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65757',
                'county_name' => 'Webster',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64420',
                'county_name' => 'Worth',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64441',
                'county_name' => 'Worth',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64456',
                'county_name' => 'Worth',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64458',
                'county_name' => 'Worth',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64475',
                'county_name' => 'Worth',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64486',
                'county_name' => 'Worth',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '64499',
                'county_name' => 'Worth',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65470',
                'county_name' => 'Wright',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65543',
                'county_name' => 'Wright',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65660',
                'county_name' => 'Wright',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65662',
                'county_name' => 'Wright',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65667',
                'county_name' => 'Wright',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65702',
                'county_name' => 'Wright',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65704',
                'county_name' => 'Wright',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65706',
                'county_name' => 'Wright',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65711',
                'county_name' => 'Wright',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65713',
                'county_name' => 'Wright',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65717',
                'county_name' => 'Wright',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '65746',
                'county_name' => 'Wright',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63101',
                'county_name' => 'St. Louis city',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63102',
                'county_name' => 'St. Louis city',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63103',
                'county_name' => 'St. Louis city',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63104',
                'county_name' => 'St. Louis city',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63105',
                'county_name' => 'St. Louis city',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63106',
                'county_name' => 'St. Louis city',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63107',
                'county_name' => 'St. Louis city',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63108',
                'county_name' => 'St. Louis city',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63109',
                'county_name' => 'St. Louis city',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63110',
                'county_name' => 'St. Louis city',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63111',
                'county_name' => 'St. Louis city',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63112',
                'county_name' => 'St. Louis city',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63113',
                'county_name' => 'St. Louis city',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63115',
                'county_name' => 'St. Louis city',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63116',
                'county_name' => 'St. Louis city',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63117',
                'county_name' => 'St. Louis city',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63118',
                'county_name' => 'St. Louis city',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63119',
                'county_name' => 'St. Louis city',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63120',
                'county_name' => 'St. Louis city',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63123',
                'county_name' => 'St. Louis city',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63125',
                'county_name' => 'St. Louis city',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63130',
                'county_name' => 'St. Louis city',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63133',
                'county_name' => 'St. Louis city',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63136',
                'county_name' => 'St. Louis city',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63137',
                'county_name' => 'St. Louis city',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63138',
                'county_name' => 'St. Louis city',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63139',
                'county_name' => 'St. Louis city',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63143',
                'county_name' => 'St. Louis city',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63147',
                'county_name' => 'St. Louis city',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63150',
                'county_name' => 'St. Louis city',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63155',
                'county_name' => 'St. Louis city',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63156',
                'county_name' => 'St. Louis city',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63157',
                'county_name' => 'St. Louis city',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63158',
                'county_name' => 'St. Louis city',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63160',
                'county_name' => 'St. Louis city',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63163',
                'county_name' => 'St. Louis city',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63164',
                'county_name' => 'St. Louis city',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63166',
                'county_name' => 'St. Louis city',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63169',
                'county_name' => 'St. Louis city',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63171',
                'county_name' => 'St. Louis city',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63177',
                'county_name' => 'St. Louis city',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63178',
                'county_name' => 'St. Louis city',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63179',
                'county_name' => 'St. Louis city',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63180',
                'county_name' => 'St. Louis city',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63182',
                'county_name' => 'St. Louis city',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63188',
                'county_name' => 'St. Louis city',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63195',
                'county_name' => 'St. Louis city',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63196',
                'county_name' => 'St. Louis city',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63197',
                'county_name' => 'St. Louis city',
                'state_code' => 'MO',
            ],
            [
                'zip_code' => '63199',
                'county_name' => 'St. Louis city',
                'state_code' => 'MO',
            ],
        ];
    }

    private function setCountyId($countyName): void
    {
        $counties = array_keys($this->countyIdList);

        if (! in_array($countyName, $counties)) {
            $this->countyIdList[$countyName] = [
                'county_id' => rand(10, 9999),
            ];
        }
    }
}
