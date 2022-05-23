<?php

namespace App\Entity\EAV;

use App\Entity\CoreEntity;
use App\Entity\EAV\Type\AddressAttributeValue;
use App\Entity\EAV\Type\BooleanAttributeValue;
use App\Entity\EAV\Type\DatetimeAttributeValue;
use App\Entity\EAV\Type\FloatAttributeValue;
use App\Entity\EAV\Type\IntegerAttributeValue;
use App\Entity\EAV\Type\OptionListAttributeValue;
use App\Entity\EAV\Type\StringAttributeValue;
use App\Entity\EAV\Type\TextAttributeValue;
use App\Entity\EAV\Type\ZipCountyAttributeValue;
use App\Repository\AttributeDefinitionPermissionRepository;
use App\Service\AttributePermissionProcessor;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\EAV\AttributeDefinitionPermission;

/**
 * Based on: https://github.com/Padam87/AttributeBundle
 *
 * @ORM\Entity(repositoryClass="App\Repository\DefinitionRepository")
 * @ORM\Table(name="attribute_definition", indexes={
 *      @ORM\Index(name="name_idx", columns={"name"})
 * })
 * @ORM\InheritanceType("SINGLE_TABLE")
 */
abstract class AttributeDefinition extends CoreEntity
{
    public const TYPE_STRING = "STRING";
    public const TYPE_INTEGER = "INTEGER";
    public const TYPE_FLOAT = "FLOAT";
    public const TYPE_DATETIME = "DATETIME";
    public const TYPE_OPTION_LIST = "OPTION_LIST";
    public const TYPE_TEXT = "TEXT";
    public const TYPE_FILE = "FILE";
    public const TYPE_ADDRESS = "ADDRESS";
    public const TYPE_URL = "URL";
    public const TYPE_BOOLEAN = "BOOLEAN";
    public const TYPE_ZIPCODE = "ZIPCODE";

    public const CLIENT_TYPE = 'client_type';
    public const GUARDIAN_ZIP = 'guardian_zip';
    public const GUARDIAN_EMAIL_ADDRESS = 'guardian_email_address';
    public const GUARDIAN_HOME_PHONE = 'guardian_home_phone';
    public const GUARDIAN_MOBILE_PHONE = 'guardian_mobile_phone';
    public const CLIENT_DATE_OF_BIRTH = 'client_date_of_birth';
    public const CLIENT_GENDER = 'client_gender';
    public const CLIENT_LIVES_WITH = 'client_lives_with';
    public const CLIENT_RACE = 'client_race';
    public const ALTERNATE_PICKUP_FIRST_NAME = 'alternate_pickup_first_name';
    public const ALTERNATE_PICKUP_LAST_NAME = 'alternate_pickup_last_name';
    public const ADULTS_IN_HOME = 'adults_in_home';
    public const OLDER_CHILDREN_IN_HOME = 'older_children_in_home';
    public const YOUNG_CHILDREN_IN_HOME = 'young_children_in_home';
    public const SOURCES_OF_INCOME = 'sources_of_income';
    public const INCOME_QUALIFIER = 'income_qualifier';
    public const INCOME_QUALIFIER_OTHER = 'income_qualifier_other';
    public const GUARDIAN_EMPLOYMENT = 'guardian_employment';
    public const GUARDIAN_TIME = 'guardian_time';
    public const MONTHLY_TAKE_HOME_PAY = 'monthly_take_home_pay';
    public const OTHER_EMPLOYMENT = 'other_employment';
    public const OTHER_TIME = 'other_time';
    public const OTHER_MONTHLY_TAKE_HOME = 'other_monthly_take_home';
    public const PARENT_HEALTH_INSURANCE = 'parent_health_insurance';
    public const CLIENT_HEALTH_INSURANCE = 'client_health_insurance';
    public const CLIENT_DIAPER_SIZE = 'client_diaper_size';
    public const PREFERRED_LOCATION = 'preferred_location';
    public const DIRECT_DIST_REFERRAL = 'direct_dist_referral';
    public const PROGRAM_REFERRAL_HOSPITAL = 'program_referral_hospital';
    public const CLIENT_TRANSPORTATION = 'client_transportation';
    public const CLIENT_AGREEMENT = 'client_agreement';
    public const APPLICANT_NAME = 'applicant_name';
    public const APPLICANT_RELATIONSHIP = 'applicant_relationship';
    public const DIAPER_MOBILE_ROUTE = 'diaper_mobile_route';
    public const SHORTNAME = 'shortname';
    public const DESIGNATION = 'designation';
    public const DESIGNATION_UPLOAD = 'designation_upload';
    public const MISSION = 'mission';
    public const WEBSITE = 'website';
    public const FACEBOOK = 'facebook';
    public const TWITTER = 'twitter';
    public const FOUNDED_YEAR = 'founded_year';
    public const IS_990 = 'is_990';
    public const FILE_990 = '990_file';
    public const PROGRAM_NAME = 'program_name';
    public const PROGRAM_DESCRIPTION = 'program_description';
    public const PROGRAM_LENGTH = 'program_length';
    public const PROGRAM_HAS_CASE_MANAGEMENT = 'program_has_case_management';
    public const PROGRAM_IS_EVIDENCE_BASED = 'program_is_evidence_based';
    public const PROGRAM_EVIDENCE_BASED_DESCRIPTION = 'program_evidence_based_description';
    public const PROGRAM_IMPROVE_CLIENT = 'program_improve_client';
    public const PROGRAM_DIAPER_USE = 'program_diaper_use';
    public const PROGRAM_DIAPER_USE_OTHER = 'program_diaper_use_other';
    public const PROGRAM_ALREADY_DISTRIBUTE = 'program_already_distribute';
    public const PROGRAM_TURN_AWAY = 'program_turn_away';
    public const PROGRAM_ADDRESS = 'program_address';
    public const MAX_SERVE = 'max_serve';
    public const INCORPORATE_SERVICES = 'incorporate_services';
    public const HAS_DESIGNATED_STAFF = 'has_designated_staff';
    public const HAS_DESIGNATED_STAFF_POSITION = 'has_designated_staff_position';
    public const INTERNET_ACCESS = 'internet_access';
    public const SECURE_AREA = 'secure_area';
    public const STORAGE_SPACE = 'storage_space';
    public const CAN_PICKUP = 'can_pickup';
    public const MAX_INCOME_REQUIREMENT = 'max_income_requirement';
    public const MAX_INCOME_REQUIREMENT_DESCRIPTION = 'max_income_requirement_description';
    public const SERVE_OVER_2X_FPL = 'serve_over_2x_FPL';
    public const IS_INCOME_VERIFIED = 'is_income_verified';
    public const INCOME_VERIFY_DOCS = 'income_verify_docs';
    public const HAS_INTERNAL_DB = 'has_internal_db';
    public const IS_MAAC = 'is_maac';
    public const ETHNIC_BLACK = 'ethnic_black';
    public const ETHNIC_WHITE = 'ethnic_white';
    public const ETHNIC_HISPANIC = 'ethnic_hispanic';
    public const ETHNIC_ASIAN = 'ethnic_asian';
    public const ETHNIC_AMERICAN_INDIAN = 'ethnic_american_indian';
    public const ETHNIC_ISLAND = 'ethnic_island';
    public const ETHNIC_MULTI = 'ethnic_multi';
    public const ETHNIC_OTHER = 'ethnic_other';
    public const ZIPCODES = 'zipcodes';
    public const FPL_BELOW = 'fpl_below';
    public const FPL_1_2 = 'fpl_1_2';
    public const FPL_GT_2X = 'fpl_gt_2x';
    public const FPL_UNKNOWN = 'fpl_unknown';
    public const AGES_SERVED = 'ages_served';
    public const OTHER_SERVED = 'other_served';
    public const PICKUP_METHOD = 'pickup_method';
    public const DISTRIBUTE_TIMES = 'distribute_times';
    public const NEW_CLIENT_TIMES = 'new_client_times';
    public const EXTRA_CLIENT_DOCUMENTATION = 'extra_client_documentation';
    public const FUNDING_SOURCES = 'funding_sources';
    public const IS_HARVESTERS = 'is_harvesters';
    public const IS_UNITED_WAY = 'is_united_way';
    public const CURRENT_DIAPER_SOURCE = 'current_diaper_source';
    public const HAS_DIAPER_BUDGET = 'has_diaper_budget';
    public const DIAPER_FUNDING_SOURCE = 'diaper_funding_source';
    public const DRUPAL_I = 'drupal_id';

    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * Machine name for the field. Must be lowercase letters, numbers, or underscores.
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     * @Assert\Regex("/^[a-z0-9_]+$/")
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $label;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $labelEs;

    /**
     * @var string|null
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @var string|null
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $descriptionEs;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=100)
     */
    private $type;

    /**
     * @var string|null
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $helpText;

    /**
     * @var string|null
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $helpTextEs;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=100)
     */
    private $displayInterface;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean")
     */
    private $required = false;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $orderIndex;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $isMultivalued;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_displayed_publicly", type="boolean", options={"default" : false})
     */
    private $isDisplayedPublicly = false;

    /**
     * @var AttributeOption[]|ArrayCollection
     *
     * @ORM\OneToMany(
     *     targetEntity="AttributeOption",
     *     mappedBy="definition",
     *     orphanRemoval=true,
     *     cascade={"persist", "remove"},
     *     fetch="EXTRA_LAZY"
     * )
     * @ORM\OrderBy({"id" = "ASC"})
     */
    private $options;

    /**
     * @var AttributeOption[]|ArrayCollection
     *
     * @ORM\OneToMany(
     *     targetEntity="AttributeDefinitionPermission",
     *     mappedBy="definition",
     *     orphanRemoval=true,
     *     cascade={"persist", "remove"},
     *     fetch="EXTRA_LAZY"
     * )
     * @ORM\OrderBy({"id" = "ASC"})
     */
    private $permissions;

    public function __construct()
    {
        $this->options = new ArrayCollection();
        $this->permissions = new ArrayCollection();
        $this->isMultivalued = false;
        $this->orderIndex = 0;
    }

    /**
     * @return mixed
     */
    public function __toString()
    {
        return $this->name;
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @param string $label
     */
    public function setLabel(string $label): void
    {
        $this->label = $label;
    }

    /**
     * @return string
     */
    public function getLabelEs(): ?string
    {
        return $this->labelEs;
    }

    /**
     * @param string $labelEs
     */
    public function setLabelEs(?string $labelEs): void
    {
        $this->labelEs = $labelEs;
    }

    /**
     * @param string $description
     *
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string $description
     *
     * @return $this
     */
    public function setDescriptionEs($descriptionEs)
    {
        $this->descriptionEs = $descriptionEs;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescriptionEs(): ?string
    {
        return $this->descriptionEs;
    }

    public function setType(string $type): AttributeDefinition
    {
        $this->type = $type;

        // If not set, use the default interface of the attribute type.
        if (!$this->displayInterface) {
            $this->displayInterface = Attribute::getDefaultDisplayInterface($this);
        }

        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string|null
     */
    public function getHelpText(): ?string
    {
        return $this->helpText;
    }

    public function setHelpText(?string $helpText): AttributeDefinition
    {
        $this->helpText = $helpText;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getHelpTextEs(): ?string
    {
        return $this->helpTextEs;
    }

    public function setHelpTextEs(?string $helpTextEs): AttributeDefinition
    {
        $this->helpTextEs = $helpTextEs;

        return $this;
    }

    public function getDisplayInterface(): string
    {
        return $this->displayInterface;
    }

    public function setDisplayInterface(string $displayInterface): void
    {
        $this->displayInterface = $displayInterface;
    }

    /**
     * @param boolean $required
     *
     * @return $this
     */
    public function setRequired($required)
    {
        $this->required = $required;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getRequired()
    {
        return $this->required;
    }

    /**
     * @param integer $orderIndex
     *
     * @return $this
     */
    public function setOrderIndex($orderIndex)
    {
        $this->orderIndex = $orderIndex;

        return $this;
    }

    /**
     * @return integer
     */
    public function getOrderIndex()
    {
        return $this->orderIndex;
    }

    /**
     * @param boolean $orderIndex
     *
     * @return $this
     */
    public function setIsDisplayedPublicly(bool $isDisplayedPublicly)
    {
        $this->isDisplayedPublicly = $isDisplayedPublicly;

        return $this;
    }

    public function getIsDisplayedPublicly()
    {
        return $this->isDisplayedPublicly;
    }

    public function isMultivalued(): bool
    {
        return in_array($this->getDisplayInterface(), [
                OptionListAttributeValue::UI_CHECKBOX_GROUP,
                OptionListAttributeValue::UI_SELECT_MULTI,
                OptionListAttributeValue::UI_ZIPCODE_MULTI
            ]) || !!$this->isMultivalued;
    }

    public function setIsMultivalued(bool $isMultivalued): void
    {
        $this->isMultivalued = $isMultivalued;
    }

    public function addPermission(AttributeDefinitionPermission $permission)
    {
        $this->permissions[] = $permission;
        $permission->setDefinition($this);

        return $this;
    }

    public function removePermission(AttributeDefinitionPermission  $permission): void
    {
        $this->permissions->removeElement($permission);
    }

    public function getPermissions()
    {
        return $this->permissions;
    }

    public function getPermission(int $id): AttributeDefinitionPermission
    {
        return $this->permissions->filter(function (AttributeDefinitionPermission  $permission) use ($id) {
            return $permission->getId() == $id;
        })->first();
    }

    /**
     * @param AttributeOption $option
     *
     * @return $this
     */
    public function addOption(AttributeOption $option)
    {
        $this->options[] = $option;
        $option->setDefinition($this);

        return $this;
    }

    public function removeOption(AttributeOption $option): void
    {
        $this->options->removeElement($option);
    }

    /**
     * @return ArrayCollection
     */
    public function getOptions()
    {
        return $this->options;
    }

    public function getOption(int $id): AttributeOption
    {
        return $this->options->filter(function (AttributeOption $option) use ($id) {
            return $option->getId() == $id;
        })->first();
    }

    public static function getAttributeTypes(): array
    {
        return [
            self::TYPE_DATETIME,
            self::TYPE_FLOAT,
            self::TYPE_INTEGER,
            self::TYPE_STRING,
            self::TYPE_OPTION_LIST,
            self::TYPE_TEXT,
            self::TYPE_BOOLEAN,
            self::TYPE_ADDRESS,
            self::TYPE_URL,
            self::TYPE_ZIPCODE,
        ];
    }

    public function applyChangesFromArray(array $changes): void
    {
        if (isset($changes['options'])) {
            foreach ($changes['options'] as $changedOption) {
                if (isset($changedOption['id'])) {
                    $option = $this->getOption($changedOption['id']);
                } elseif (!isset($changedOption['isDeleted']) || !$changedOption['isDeleted']) {
                    $option = new AttributeOption();
                    $this->addOption($option);
                } else {
                    continue;
                }
                $option->applyChangesFromArray($changedOption);

                if (isset($changedOption['isDeleted']) && $changedOption['isDeleted']) {
                    $this->removeOption($option);
                }
            }
            unset($changes['options']);
        }

        parent::applyChangesFromArray($changes);
    }
}
