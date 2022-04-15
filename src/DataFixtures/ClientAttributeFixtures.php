<?php

namespace App\DataFixtures;

use App\Entity\EAV\AttributeValue;
use App\Entity\EAV\ClientAttributeDefinition;
use App\Entity\EAV\AttributeDefinition;
use App\Entity\EAV\AttributeOption;
use App\Entity\EAV\PartnerProfileAttributeDefinition;
use App\Entity\PartnerProfile;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Partner;

class ClientAttributeFixtures extends BaseFixture
{
    public function loadData(ObjectManager $manager)
    {
        foreach ($this->getData() as $key => $field) {
            $definition = new ClientAttributeDefinition();
            $definition->setName($field['name']);
            $definition->setLabel($field['label']);
            $definition->setDescription($field['description']);
            $definition->setRequired($field['required']);
            $definition->setType($field['type']);
            $definition->setDisplayInterface($field['interface']);
            $definition->setOrderIndex($field['order_index']);

            if (isset($field['is_displayed_publicly'])) {
                $definition->setIsDisplayedPublicly($field['is_displayed_publicly']);
            }

            if (isset($field['options'])) {
                foreach ($field['options'] as $value => $name) {
                    $option = new AttributeOption();
                    $option->setName($name);
                    $option->setValue($value);
                    $definition->addOption($option);
                }
            }

            $manager->persist($definition);
        }

        $manager->flush();
    }

    public function getData(): array
    {
        return [
            [
                'name' => 'email_address',
                'label' => 'Email Address',
                'description' => 'Enter parent Email Address',
                'required' => false,
                'type' => AttributeDefinition::TYPE_STRING,
                'interface' => AttributeValue::UI_TEXT,
                'order_index' => 0,
                'is_displayed_publicly' => true,
            ],
            [
                'name' => 'home_phone',
                'label' => 'Home Phone',
                'description' => 'Enter Home Phone',
                'required' => false,
                'type' => AttributeDefinition::TYPE_STRING,
                'interface' => AttributeValue::UI_TEXT,
                'order_index' => 1,
                'is_displayed_publicly' => true,

            ],
            [
                'name' => 'mobile_phone',
                'label' => 'Mobile Phone',
                'description' => 'Enter Mobile Phone',
                'required' => true,
                'type' => AttributeDefinition::TYPE_STRING,
                'interface' => AttributeValue::UI_TEXT,
                'order_index' => 2,
                'is_displayed_publicly' => true,
            ],
            [
                'name' => 'designation',
                'label' => 'Your Agency is a',
                'description' => '',
                'required' => true,
                'type' => AttributeDefinition::TYPE_OPTION_LIST,
                'interface' => AttributeValue::UI_CHECKBOX_GROUP,
                'options' => [
                    '501c3' => '501(c)3',
                    'religious' => 'Religious Organization',
                    'government' =>  'Government Organization',
                ],
                'order_index' => 3,
                'is_displayed_publicly' => false,
            ],
            // TODO: UI_CHECKBOX_GROUP
            [
                //TODO: TYPE_FIELD and UI_FILE_UPLOAD
                'name' => 'designation_upload',
                'label' => 'Proof of agency status',
                'description' => 'Please attach one of the following:
                    * 501(c)3 Letter
                    * Letter of Good Standing from Denominational Headquarters
                    * Government Letterhead',
                'required' => true,
                'type' => AttributeDefinition::TYPE_FILE,
                'interface' => AttributeValue::UI_FILE_UPLOAD,
                'order_index' => 4,
                'is_displayed_publicly' => false,
            ],
            [
                'name' => 'mission',
                'label' => 'Describe agency mission/service provided to the community',
                'description' => '',
                'required' => true,
                'type' => AttributeDefinition::TYPE_TEXT,
                'interface' => AttributeValue::UI_TEXTAREA,
                'order_index' => 5,
                'is_displayed_publicly' => false,
            ],
            [
                'name' => 'mailing_address',
                'label' => 'Mailing Address',
                'description' => '',
                'required' => true,
                'type' => AttributeDefinition::TYPE_ADDRESS,
                'interface' => AttributeValue::UI_ADDRESS,
                'order_index' => 6,
                'is_displayed_publicly' => false,
            ],
            [
                'name' => 'zip_code',
                'label' => 'Parent/Guardian Zip Code',
                'description' => '',
                'required' => true,
                'type' => AttributeDefinition::TYPE_ZIPCODE,
                'interface' => AttributeValue::UI_ZIPCODE,
                'order_index' => 6,
                'is_displayed_publicly' => true,
            ],
            [
                'name' => 'child_gender',
                'label' => 'Child Gender',
                'description' => '',
                'required' => true,
                'type' => AttributeDefinition::TYPE_OPTION_LIST,
                'interface' => AttributeValue::UI_RADIO,
                'options' => [
                    'male' => 'Male',
                    'female' => 'Female',
                ],
                'order_index' => 7,
                'is_displayed_publicly' => true,
            ],
            [
                'name' => 'child_lives_with',
                'label' => 'Child Lives with',
                'description' => '',
                'required' => true,
                'type' => AttributeDefinition::TYPE_OPTION_LIST,
                'interface' => AttributeValue::UI_CHECKBOX_GROUP,
                'options' => [
                    'mother' => 'Mother',
                    'father' => 'Father',
                    'grandparent' => 'Grandparent',
                    'foster_parent' => 'Foster Parent',
                    'other' => 'Other Parent/Relative',
                ],
                'order_index' => 7,
                'is_displayed_publicly' => true,
            ],
            [
                'name' => 'child_race',
                'label' => 'Child Race',
                'description' => '',
                'required' => true,
                'type' => AttributeDefinition::TYPE_OPTION_LIST,
                'interface' => AttributeValue::UI_CHECKBOX_GROUP,
                'options' => [
                    'black/african_american' => 'Black/African American',
                    'hispanic/latino' => 'Hispanic/Latino',
                    'white/caucasian' => 'White/Caucasian',
                    'asian' => 'Asian',
                    'native_pacific/other_native_island' => 'Native Pacific/Other Native Island',
                    'american_indian' => 'American Indian',
                    'other' => 'Other',
                ],
                'order_index' => 8,
                'is_displayed_publicly' => true,
            ],
            [
                'name' => 'alternative_pickup_first_name',
                'label' => 'Alternative Pickup First Name',
                'description' => '',
                'required' => false,
                'type' => AttributeDefinition::TYPE_STRING,
                'interface' => AttributeValue::UI_TEXT,
                'order_index' => 9,
                'is_displayed_publicly' => true,
            ],
            [
                'name' => 'alternative_pickup_last_name',
                'label' => 'Alternative Pickup Last Name',
                'description' => '',
                'required' => false,
                'type' => AttributeDefinition::TYPE_STRING,
                'interface' => AttributeValue::UI_TEXT,
                'order_index' => 10,
                'is_displayed_publicly' => true,
            ],
            [
                'name' => 'adults_in_family',
                'label' => 'Adults',
                'description' => '',
                'required' => true,
                'type' => AttributeDefinition::TYPE_INTEGER,
                'interface' => AttributeValue::UI_NUMBER,
                'order_index' => 11,
                'is_displayed_publicly' => true,
            ],
            [
                'name' => 'children_5_to_17',
                'label' => 'Children (5 to 17)',
                'description' => '',
                'required' => true,
                'type' => AttributeDefinition::TYPE_INTEGER,
                'interface' => AttributeValue::UI_NUMBER,
                'order_index' => 12,
                'is_displayed_publicly' => true,
            ],
            [
                'name' => 'children_under_5',
                'label' => 'Children (under 5)',
                'description' => 'Children (under 5) including current child',
                'required' => true,
                'type' => AttributeDefinition::TYPE_INTEGER,
                'interface' => AttributeValue::UI_NUMBER,
                'order_index' => 13,
                'is_displayed_publicly' => true,
            ],
            [
                'name' => 'sources_of_income',
                'label' => 'Sources of Income',
                'description' => '',
                'required' => true,
                'type' => AttributeDefinition::TYPE_OPTION_LIST,
                'interface' => AttributeValue::UI_CHECKBOX_GROUP,
                'options' => [
                    'ssi' => 'SSI',
                    'snap/food_stamps' => 'SNAP/Food Stamps',
                    'tanf' => 'TANF',
                    'housing/subsidized' => 'Housing/subsidized',
                    'housing/unsubsudized' => 'Housing/unsubsudized',
                    'WIC' => 'WIC',
                    'none' => 'None of the above',
                ],
                'order_index' => 14,
                'is_displayed_publicly' => true,
            ],
            [
                'name' => 'parent_employed',
                'label' => 'Is Parent/Guardian employed',
                'description' => '',
                'required' => true,
                'type' => AttributeDefinition::TYPE_OPTION_LIST,
                'interface' => AttributeValue::UI_RADIO,
                'options' => [
                    'yes' => 'Yes',
                    'no' => 'No',
                ],
                'order_index' => 15,
                'is_displayed_publicly' => true,
            ],
            [
                'name' => 'parent_employed_if_yes',
                'label' => 'If Yes',
                'description' => '',
                'required' => true,
                'type' => AttributeDefinition::TYPE_OPTION_LIST,
                'interface' => AttributeValue::UI_RADIO,
                'options' => [
                    'n/a' => 'N/A',
                    'ft' => 'Full Time (FT)',
                    'pt' => 'Part Time (PT)',
                ],
                'order_index' => 16,
                'is_displayed_publicly' => true,
            ],
            [
                'name' => 'monthly_take_home_pay',
                'label' => 'Monthly Take-home Pay',
                'description' => '',
                'required' => false,
                'type' => AttributeDefinition::TYPE_TEXT,
                'interface' => AttributeValue::UI_TEXT,
                'order_index' => 17,
                'is_displayed_publicly' => true,
            ],
            [
                'name' => 'parent_health_insurance',
                'label' => 'Parent Health Insurance',
                'description' => '',
                'required' => true,
                'type' => AttributeDefinition::TYPE_OPTION_LIST,
                'interface' => AttributeValue::UI_SELECT_SINGLE,
                'options' => [
                    'private_insurance' => 'Private Insurance',
                    'medicaid' => 'Medicaid',
                    'uninsured' => 'Uninsured',
                ],
                'order_index' => 18,
                'is_displayed_publicly' => true,
            ],
            [
                'name' => 'child_health_insurance',
                'label' => 'Child Health Insurance',
                'description' => '',
                'required' => true,
                'type' => AttributeDefinition::TYPE_OPTION_LIST,
                'interface' => AttributeValue::UI_SELECT_SINGLE,
                'options' => [
                    'private_insurance' => 'Private Insurance',
                    'medicaid' => 'Medicaid',
                    'uninsured' => 'Uninsured',
                ],
                'order_index' => 19,
                'is_displayed_publicly' => true,
            ],
            /*[
                'name' => 'size_diapers_needed',
                'label' => 'What size of diepers does this child need?',
                'description' => '',
                'required' => true,
                'type' => AttributeDefinition::TYPE_OPTION_LIST,
                'interface' => AttributeValue::UI_SELECT_SINGLE,
                'options' => [
                    'newborn' => 'Private Insurance',
                    'size1' => 'Size 1',
                    'size2' => 'Size 2',
                    'size3' => 'Size 3',
                    'size4' => 'Size 4',
                    'size5' => 'Size 5',
                    'size6' => 'Size 6',
                    'pullup2/3t' => 'Pullup 2/3T',
                    'pullup3/4t' => 'Pullup 3/4T',
                    'pullup4/5t' => 'Pullup 4/5T',
                    'uninsured' => 'Uninsured',
                ],
                'order_index' => 18,
            ],*/
            [
                'name' => 'pickup_location',
                'label' => 'Where would you like to pickup diapers?',
                'description' => '',
                'required' => true,
                'type' => AttributeDefinition::TYPE_OPTION_LIST,
                'interface' => AttributeValue::UI_SELECT_SINGLE,
                'options' => [
                    'Avenue of Life' => 'Avenue of Life - KCK 500 N. 7th St. Tfwy, KC, KS 66101',
                    'CC-Poplar' => 'Catholic Charities of Northeast Kansas - 333 E. Poplar St. Olathe, KS 66061',
                    'CC-87th' => 'Catholic Charities of Northeast Kansas - 9806 W. 87th Street, Overland Park, KS 66212',
                    'CC-WY' => 'Catholic Charities of NE Kansas Wyandotte - 600 Minnesota Avenue Kansas City, KS 66101',
                    'CC-SJ' => 'Catholic Charities Kansas City St. Joseph -4001 Blue Parkway Suite 250 Kansas City, MO 64130',
                    'CAC' => 'Community Assistance Council -10901 Blue Ridge Blvd. Kansas City, MO 64134',
                    'Grandview WIC' => 'Grandview WIC - 11902 Blue Ridge Blvd. Grandview, MO 64030',
                    'Independence WIC' => 'Independence WIC - 529 E US Hwy 24 Independence, MO 64050',
                    'KCPS-HeadStart' => 'Kansas City Kansas Public Schools Head Start',
                    'Mimis Pantry' => 'Mimi\'s Pantry -2255 NW Vivion Road Kansas City, MO 64150',
                    'MSMBC' => 'Mt. Sinai Missionary Baptist Church - 3634 Brooklyn Avenue Kansas City, MO 64109',
                    'SA-Ind' => 'Salvation Army Independence - 14700 E Truman Road Independence, MO 64050',
                    'True Light' => 'True Light Family Resource Center - 712 E. 31st St. KCMO 64109',
                    'Wayne Minder' => 'Wayne Minder Community Center',
                ],
                'order_index' => 20,
                'is_displayed_publicly' => false,
            ],
            [
                'name' => 'transportation_mode',
                'label' => 'What is your mode of transportation?',
                'description' => '',
                'required' => true,
                'type' => AttributeDefinition::TYPE_OPTION_LIST,
                'interface' => AttributeValue::UI_SELECT_SINGLE,
                'options' => [
                    'Personal Vehicle' => 'Personal Vehicle',
                    'Ride Share' => 'Ride Share',
                    'Public Transportation' => 'Public Transportation',
                    'No Transportation' => 'No Transportation',
                ],
                'order_index' => 21,
                'is_displayed_publicly' => true,
            ],
            [
                //TODO: TYPE_URL and UI_URL
                'name' => 'website',
                'label' => 'Website',
                'description' => '',
                'required' => false,
                'type' => AttributeDefinition::TYPE_URL,
                'interface' => AttributeValue::UI_URL,
                'order_index' => 22,
                'is_displayed_publicly' => false,
            ],
            [ //TODO: TYPE_URL and UI_URL
                'name' => 'facebook',
                'label' => 'Facebook Page',
                'description' => 'ex: https://www.facebook.com/happybottoms/',
                'required' => false,
                'type' => AttributeDefinition::TYPE_URL,
                'interface' => AttributeValue::UI_URL,
                'order_index' => 23,
                'is_displayed_publicly' => false,
            ],
            [
                'name' => 'twitter',
                'label' => 'Twitter Account',
                'description' => 'ex. @happybottomsorg',
                'required' => false,
                'type' => AttributeDefinition::TYPE_STRING,
                'interface' => AttributeValue::UI_TEXT,
                'order_index' => 24,
                'is_displayed_publicly' => false,
            ],
            [
                'name' => 'founded_year',
                'label' => 'Year Agency Founded',
                'description' => '',
                'required' => true,
                'type' => AttributeDefinition::TYPE_INTEGER,
                'interface' => AttributeValue::UI_NUMBER,
                'order_index' => 25,
                'is_displayed_publicly' => false,
            ],
            [
                'name' => 'applicant_first_and_last',
                'label' => 'Applicant First And Last Name',
                'description' => '',
                'required' => false,
                'type' => AttributeDefinition::TYPE_STRING,
                'interface' => AttributeValue::UI_TEXT,
                'order_index' => 26,
                'is_displayed_publicly' => true,
            ],
            [
                'name' => 'relationship_to_the_child',
                'label' => 'Relationship to the child',
                'description' => '',
                'required' => true,
                'type' => AttributeDefinition::TYPE_OPTION_LIST,
                'interface' => AttributeValue::UI_SELECT_SINGLE,
                'options' => [
                    'mother' => 'Mother',
                    'father' => 'Father',
                    'grandparent' => 'Grandparent',
                    'foster _prent' => 'Foster Parent',
                    'guardian' => 'Guardian',
                    'other' => 'Other',
                ],
                'order_index' => 27,
                'is_displayed_publicly' => true,
            ],
        ];
    }
}
