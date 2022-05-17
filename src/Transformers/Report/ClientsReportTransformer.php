<?php

namespace App\Transformers\Report;

use App\Entity\Client;
use App\Entity\EAV\Attribute;
use App\Entity\EAV\AttributeDefinition;
use App\Entity\User;
use App\Transformers\AttributeTransformer;
use App\Transformers\BulkDistributionLineItemTransformer;
use App\Transformers\PartnerTransformer;
use Doctrine\ORM\PersistentCollection;
use League\Fractal\Resource\Item;
use League\Fractal\TransformerAbstract;

class ClientsReportTransformer extends TransformerAbstract
{
    protected $user;

    public function __construct(User $user = null)
    {
        $this->user = $user;
    }

    protected $availableIncludes = [
        'partner',
        'attributes',
        'lastDistribution',
    ];

    public function transform(Client $client)
    {
        $attributes = $client->getAttributes();

        $adults = $this->getAttributeValueByName($attributes, AttributeDefinition::ADULTS_IN_HOME);
        $childGender = $this->getAttributeValueByName($attributes, AttributeDefinition::CLIENT_GENDER);
        $childLivesWith = $this->getAttributeValueByName($attributes, AttributeDefinition::CLIENT_LIVES_WITH);
        $childRace = $this->getAttributeValueByName($attributes, AttributeDefinition::CLIENT_RACE);
        $childrenFiveToSeventeen = $this->getAttributeValueByName($attributes, AttributeDefinition::OLDER_CHILDREN_IN_HOME);
        $childrenUnderFive = $this->getAttributeValueByName($attributes, AttributeDefinition::YOUNG_CHILDREN_IN_HOME);
        $childHealthInsurance = $this->getAttributeValueByName($attributes, AttributeDefinition::CLIENT_HEALTH_INSURANCE);
        $parentHealthInsurance = $this->getAttributeValueByName($attributes, AttributeDefinition::PARENT_HEALTH_INSURANCE);
        $childHaveHealthInsurance = $childHealthInsurance ? 'YES' : 'NO';
        $childHaveMedicaid = 'MISSING';
        $firstDistribution = 'MISSING';
        $isTheChildInDaycare = 'MISSING';
        $nameOfDaycareProvider = 'MISSING';
        $isParentEmployed = $this->getAttributeValueByName($attributes, AttributeDefinition::GUARDIAN_EMPLOYMENT);
        $parentEmploymentStatus = $isParentEmployed ? 'EMPLOYED' : 'NOT EMPLOYED';
        $otherAdultsInHouseholdEmployed = $this->getAttributeValueByName($attributes, AttributeDefinition::OTHER_EMPLOYMENT);
        $otherAdultEmploymentStatus = $otherAdultsInHouseholdEmployed ? 'EMPLOYED' : 'NOT EMPLOYED';
        $monthlyTakeHomePay = $this->getAttributeValueByName($attributes, AttributeDefinition::MONTHLY_TAKE_HOME_PAY);
        $sourcesOfIncome = $this->getAttributeValueByName($attributes, AttributeDefinition::SOURCES_OF_INCOME);
        $zipCode = $this->getAttributeValueByName($attributes, AttributeDefinition::GUARDIAN_ZIP);
        $county = 'MISSING';
        $diaperMobileRoute = $this->getAttributeValueByName($attributes, AttributeDefinition::DIAPER_MOBILE_ROUTE);
        $diaperEvent = 'MISSING';
        $referredByHospital = $this->getAttributeValueByName($attributes, AttributeDefinition::PROGRAM_REFERRAL_HOSPITAL);
        $transportationMethod = $this->getAttributeValueByName($attributes, AttributeDefinition::CLIENT_TRANSPORTATION);
        $diaperSizeNeed = $this->getAttributeValueByName($attributes, AttributeDefinition::CLIENT_DIAPER_SIZE);
        $pickUpLocation = $this->getAttributeValueByName($attributes, AttributeDefinition::PICKUP_METHOD);
        $emailAddress = $this->getAttributeValueByName($attributes, AttributeDefinition::GUARDIAN_EMAIL_ADDRESS);
        $homePhone = $this->getAttributeValueByName($attributes, AttributeDefinition::GUARDIAN_HOME_PHONE);
        $mobilePhone = $this->getAttributeValueByName($attributes, AttributeDefinition::GUARDIAN_MOBILE_PHONE);

        return [
            'clientId' => $client->getId(),
            'id' => $client->getPublicId(),
            'clientType' => ($client->getPartner() && $client->getPartner()->getPartnerType()) ? $client->getPartner()->getPartnerType() : 'Not Set',
            'assignedAgency' => $client->getPartner() ? $client->getPartner()->getTitle() : 'Not Set',
            'adults' => $adults,
            'childDateOfBirth' => $client->getBirthdate()->format('Y-m-d'),
            'childGender' => $childGender,
            'childLivesWith' => $childLivesWith,
            'childRace' => $childRace,
            'childrenFiveToSeventeen' => $childrenFiveToSeventeen,
            'childrenUnderFive' => $childrenUnderFive,
            'childHealthInsurance' => $childHealthInsurance,
            'parentHealthInsurance' => $parentHealthInsurance,
            'childHaveHealthInsurance' => $childHaveHealthInsurance,
            'childHaveMedicaid' => $childHaveMedicaid,
            'familyId' => $client->getFamilyId(),
            'firstDistribution' => $firstDistribution,
            'ageExpiration' => $client->getAgeExpiresAt() ? $client->getAgeExpiresAt()->format('Y-m-d') : '',
            'distributionExpiration' => $client->getDistributionExpiresAt() ? $client->getDistributionExpiresAt()->format('Y-m-d') : '',
            'isTheChildInDaycare' => $isTheChildInDaycare,
            'nameOfDaycareProvider' => $nameOfDaycareProvider,
            'childFirstName' => $client->getName()->getFirstname(),
            'childLastName' => $client->getName()->getLastname(),
            'parentFirstName' => $client->getParentFirstName(),
            'parentLastName' => $client->getParentLastName(),
            'isParentEmployed' => $isParentEmployed,
            'parentEmploymentStatus' => $parentEmploymentStatus,
            'otherAdultsInHouseholdEmployed' => $otherAdultsInHouseholdEmployed,
            'otherAdultEmploymentStatus' => $otherAdultEmploymentStatus,
            'monthlyTakeHomePay' => $monthlyTakeHomePay,
            'sourcesOfIncome' => $sourcesOfIncome,
            'zipCode' => $zipCode,
            'county' => $county,
            'diaperMobileRoute' => $diaperMobileRoute,
            'diaperEvent' => $diaperEvent, //If you are signing up for Direct Distribution at the HappyBottoms Warehouse, how did you find out about this event?
            'referredByHospital' => $referredByHospital, //If you were referred by a hospital, which one?
            'transportationMethod' => $transportationMethod,
            'diaperSizeNeed' => $diaperSizeNeed, //What size diaper does this child need?
            'pickUpLocation' => $pickUpLocation, //Where would you like to pick up diapers?
            'emailAddress' => $emailAddress,
            'homePhone' => $homePhone,
            'mobilePhone' => $mobilePhone,
            'mergedTo' => $client->getMergedToClient() ? $client->getMergedToClient()->getId() : '',
            'mergedDate' => $client->getUpdatedAt()->format('Y-m-d'),
            'creationDate' => $client->getCreatedAt()->format('Y-m-d'),
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

    public function includeAttributes(Client $client)
    {
        return $this->collection($client->getAttributes()->toArray(), new AttributeTransformer($this->user));
    }

    public function includePartner(Client $client)
    {
        return $client->getPartner()
            ? $this->item($client->getPartner(), new PartnerTransformer())
            : $this->primitive(['id' => null]);
    }

    public function includeLastDistribution(Client $client): ?Item
    {
        if ($client->getLastCompleteDistributionLineItem()) {
            return $this->item(
                $client->getLastCompleteDistributionLineItem(),
                new BulkDistributionLineItemTransformer()
            );
        }

        return null;
    }
}
