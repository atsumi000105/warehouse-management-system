<?php

namespace App\Reports;

use App\Entity\EAV\Attribute;
use App\Entity\EAV\AttributeDefinition;
use Doctrine\ORM\PersistentCollection;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\IWriter;

class ClientsReportExcel
{
    protected $reportData;

    public function __construct(DistributionTotalsReport $reportData, $products)
    {
        $this->reportData = $reportData;
    }

    public function buildExcel(): IWriter
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->fromArray($this->buildHeaders());

        $dataArr = [];
        foreach ($this->reportData->getRows() as $rowData) {
            $rowArr = [];
            $attributes = $rowData->getAttributes();

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

            $diaperMobileRoute = $this->getAttributeValueByName($attributes, AttributeDefinition::DIAPER_MOBILE_ROUTE);
            $diaperEvent = 'MISSING';
            $referredByHospital = $this->getAttributeValueByName($attributes, AttributeDefinition::PROGRAM_REFERRAL_HOSPITAL);
            $transportationMethod = $this->getAttributeValueByName($attributes, AttributeDefinition::CLIENT_TRANSPORTATION);
            $diaperSizeNeed = $this->getAttributeValueByName($attributes, AttributeDefinition::CLIENT_DIAPER_SIZE);
            $pickUpLocation = $this->getAttributeValueByName($attributes, AttributeDefinition::PICKUP_METHOD);
            $emailAddress = $this->getAttributeValueByName($attributes, AttributeDefinition::GUARDIAN_EMAIL_ADDRESS);
            $homePhone = $this->getAttributeValueByName($attributes, AttributeDefinition::GUARDIAN_HOME_PHONE);
            $mobilePhone = $this->getAttributeValueByName($attributes, AttributeDefinition::GUARDIAN_MOBILE_PHONE);

            $rowArr[] = $rowData->getId();
            $rowArr[] = $rowData->getPublicId();
            $rowArr[] = ($rowData->getPartner() && $rowData->getPartner()->getPartnerType()) ? $rowData->getPartner()->getPartnerType() : 'Not Set';
            $rowArr[] = $rowData->getPartner() ? $rowData->getPartner()->getTitle() : 'Not Set';
            $rowArr[] = $adults;
            $rowArr[] = $rowData->getBirthdate()->format('Y-m-d');
            $rowArr[] = $childGender;
            $rowArr[] = $childLivesWith;
            $rowArr[] = $childRace;
            $rowArr[] = $childrenFiveToSeventeen;
            $rowArr[] = $childrenUnderFive;
            $rowArr[] = $childHealthInsurance;
            $rowArr[] = $parentHealthInsurance;
            $rowArr[] = $childHaveHealthInsurance;
            $rowArr[] = $childHaveMedicaid;
            $rowArr[] = $rowData->getFamilyId();
            $rowArr[] = $firstDistribution;
            $rowArr[] = $rowData->getAgeExpiresAt() ? $rowData->getAgeExpiresAt()->format('Y-m-d') : '';
            $rowArr[] = $rowData->getDistributionExpiresAt() ? $rowData->getDistributionExpiresAt()->format('Y-m-d') : '';
            $rowArr[] = $isTheChildInDaycare;
            $rowArr[] = $nameOfDaycareProvider;
            $rowArr[] = $rowData->getName()->getFirstname();
            $rowArr[] = $rowData->getName()->getLastname();
            $rowArr[] = $rowData->getParentFirstName();
            $rowArr[] = $rowData->getParentLastName();
            $rowArr[] = $isParentEmployed;
            $rowArr[] = $parentEmploymentStatus;
            $rowArr[] = $otherAdultsInHouseholdEmployed;
            $rowArr[] = $otherAdultEmploymentStatus;
            $rowArr[] = $monthlyTakeHomePay;
            $rowArr[] = $sourcesOfIncome;
            $rowArr[] = $zipCode;
            $rowArr[] = $county;
            $rowArr[] = $diaperMobileRoute;
            $rowArr[] = $diaperEvent; //If you are signing up for Direct Distribution at the HappyBottoms Warehouse, how did you find out about this event;
            $rowArr[] = $referredByHospital; //If you were referred by a hospital, which one;
            $rowArr[] = $transportationMethod;
            $rowArr[] = $diaperSizeNeed; //What size diaper does this child need;
            $rowArr[] = $pickUpLocation; //Where would you like to pick up diapers;
            $rowArr[] = $emailAddress;
            $rowArr[] = $homePhone;
            $rowArr[] = $mobilePhone;
            $rowArr[] = $rowData->getMergedToClient() ? $rowData->getMergedToClient()->getId() : '';
            $rowArr[] = $rowData->getUpdatedAt()->format('Y-m-d');
            $rowArr[] = $rowData->getCreatedAt()->format('Y-m-d');

            $rowArr[] = $rowData->getTotal();

            $dataArr[] = $rowArr;
        }

        $sheet->fromArray($dataArr, null, 'A2');

        return IOFactory::createWriter($spreadsheet, 'Xlsx');
    }

    private function buildHeaders()
    {
        $headers = [
            'clientId',
            'id',
            'clientType',
            'assignedAgency',
            'adults',
            'childDateOfBirth',
            'childGender',
            'childLivesWith',
            'childRace',
            'childrenFiveToSeventeen',
            'childrenUnderFive',
            'childHealthInsurance',
            'parentHealthInsurance',
            'childHaveHealthInsurance',
            'childHaveMedicaid',
            'familyId',
            'firstDistribution',
            'ageExpiration',
            'distributionExpiration',
            'isTheChildInDaycare',
            'nameOfDaycareProvider',
            'childFirstName',
            'childLastName',
            'parentFirstName',
            'parentLastName',
            'isParentEmployed',
            'parentEmploymentStatus',
            'otherAdultsInHouseholdEmployed',
            'otherAdultEmploymentStatus',
            'monthlyTakeHomePay',
            'sourcesOfIncome',
            'zipCode',
            'county',
            'diaperMobileRoute',
            'diaperEvent',
            'referredByHospital',
            'transportationMethod',
            'diaperSizeNeed',
            'pickUpLocation',
            'emailAddress',
            'homePhone',
            'mobilePhone',
            'mergedTo',
            'mergedDate',
            'creationDate',
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
