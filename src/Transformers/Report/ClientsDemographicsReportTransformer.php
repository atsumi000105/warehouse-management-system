<?php

namespace App\Transformers\Report;

use App\Entity\Client;
use App\Entity\EAV\Attribute;
use App\Entity\EAV\AttributeDefinition;
use App\Entity\User;
use Doctrine\ORM\PersistentCollection;
use Doctrine\Persistence\ObjectManager;
use League\Fractal\TransformerAbstract;

class ClientsDemographicsReportTransformer extends TransformerAbstract
{
    protected $user;

    private $om;

    protected $availableIncludes = [
        'partner',
        'attributes',
    ];

    public function __construct(ObjectManager $om, User $user = null)
    {
        $this->om = $om;
        $this->user = $user;
    }

    public function transform(Client $client)
    {
        $attributes = $client->getAttributes();

        $childRace = $this->getAttributeValueByName($attributes, AttributeDefinition::CLIENT_RACE);
        $childGender = $this->getAttributeValueByName($attributes, AttributeDefinition::CLIENT_GENDER);

        $childHealthInsurance = $this->getAttributeValueByName($attributes, AttributeDefinition::CLIENT_HEALTH_INSURANCE);
        $parentHealthInsurance = $this->getAttributeValueByName($attributes, AttributeDefinition::PARENT_HEALTH_INSURANCE);
        $childHaveHealthInsurance = $childHealthInsurance ? 'YES' : 'NO';
        $parentHaveHealthInsurance = $parentHealthInsurance ? 'YES' : 'NO';
        $isParentEmployed = $this->getAttributeValueByName($attributes, AttributeDefinition::GUARDIAN_EMPLOYMENT);
        $parentEmploymentStatus = $isParentEmployed ? 'EMPLOYED' : 'NOT EMPLOYED';
        $otherAdultsInHouseholdEmployed = $this->getAttributeValueByName($attributes, AttributeDefinition::OTHER_EMPLOYMENT);
        $otherAdultEmploymentStatus = $otherAdultsInHouseholdEmployed ? 'EMPLOYED' : 'NOT EMPLOYED';
        $sourcesOfIncome = $this->getAttributeValueByName($attributes, AttributeDefinition::SOURCES_OF_INCOME);

        $zipCode = $this->getAttributeValueByName($attributes, AttributeDefinition::GUARDIAN_ZIP);

        $county = '';
        $state = '';

        if ($zipCode) {
            $explodedZip = explode('-', $zipCode);

            $zipCode = $explodedZip[0];

            if (isset($explodedZip[1])) {
                $explodedZip = explode(',', $explodedZip[1]);

                if (isset($explodedZip[0])) {
                    $county = $explodedZip[0];
                }

                if (isset($explodedZip[1])) {
                    $state = $explodedZip[1];
                }
            }
        }

        $childLivesWith = $this->getAttributeValueByName($attributes, AttributeDefinition::CLIENT_LIVES_WITH);

        $childHaveMedicaid = 'MISSING';

        return [
            'id' => $client->getId(),
            'parentName' => $client->getParentFirstName() . ' ' . $client->getParentLastName(),
            'client' => $client->getName()->getFirstname() . ' ' . $client->getName()->getLastname(),
            'birthdate' => $client->getBirthdate()->format('Y-m-d'),
            'clientType' => 'Client',
            'agencyId' =>  $client->getPartner() ? $client->getPartner()->getId() : 'Not Set',
            'agencyName' =>  $client->getPartner() ? $client->getPartner()->getTitle() : 'Not Set',
            'childRace' => $childRace,
            'childGender' => $childGender,
            'doesChildHealthInsurance' => $childHaveHealthInsurance,
            'doesParentHealthInsurance' => $parentHaveHealthInsurance,
            'childMedicaid' => $childHaveMedicaid,
            'childHealthInsurance' => $childHealthInsurance,
            'parentHealthInsurance' => $parentHealthInsurance,
            'parentEmployed' => $parentEmploymentStatus,
            'anyOtherEmployed' => $otherAdultEmploymentStatus,
            'sourcesOfIncome' => $sourcesOfIncome,
            'parentCounty' => $county,
            'zipCode' => $zipCode,
            'familyId' => $client->getFamilyId(),
            'childLivesWith' => $childLivesWith,
        ];
    }

    private function getAttributeValueByName(PersistentCollection $attributes, string $name): ?string
    {
        $values = $attributes->map(function (Attribute $attribute) use ($name) {
            if ($attribute->getDefinition()->getName() === $name) {
                return $attribute->getValues();
            }
        })->toArray();

        foreach ($values as $value) {
            if (isset($value[0])) {
                return $value[0];
            }
        }

        return null;
    }
}
